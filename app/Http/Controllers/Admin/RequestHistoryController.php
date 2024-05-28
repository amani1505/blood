<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RequestHistory;
use Illuminate\Http\Request;
use App\Models\BloodGroup;
use App\Models\BloodStock;
use App\Models\Hospital;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class RequestHistoryController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $user = $request->user();
        $sort = $request->get('id');
        $direction = $request->get('direction', 'asc');
        $sort = !empty($sort) ? $sort : 'id';

        // Query request histories with their related blood types and hospitals
        $query = RequestHistory::with(['bloodType', 'hospital']);


        if (!empty($filter)) {
            // You can filter by blood type group or hospital name if needed
            $query->whereHas('bloodType', function ($q) use ($filter) {
                $q->where('group', 'like', '%' . $filter . '%');
            });
            // Add similar logic for filtering by hospital if needed
        }

        // Filter request histories based on user's institute ID
        $query->where('user_hospital_id', $user->hospital_id);
        $query->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->orderBy($sort, $direction);

        $histories = $query->paginate(10);

        return view('admin.history.index', compact('histories', 'sort', 'direction', 'filter'));
    }
    public function create(Request $request)

    {

        $user = $request->user();
        $bloodTypes = BloodGroup::orderBy('id', 'asc')
            ->where('hospital_id', '=', $user->hospital_id)->distinct('group')
            ->get();

        return view('admin.history.create', compact('bloodTypes'));
    }
    public function checkVolumeAndBloodType(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'volume' => 'required|numeric|min:1',
            'blood_group' => 'required|exists:blood_groups,group',
        ]);

        $bloodTypes = BloodGroup::where('hospital_id', '!=', $user->hospital_id)
            ->where('group', $request->input('blood_group')) // Assuming 'blood_group' is the name of the input field
            ->pluck('id');


        $bloodType = BloodGroup::where('hospital_id', '!=', $user->hospital_id)
            ->where('group', $request->input('blood_group')) // Assuming 'blood_group' is the name of the input field
            ->pluck('id')->first();


        // Get the input volume and blood type ID
        $volume = $request->input('volume');

        $bloodStocks = BloodStock::with('hospital')
            ->whereIn('blood_type_id', $bloodTypes) // Use whereIn to match blood types
            ->where('volume', '>=', $volume)
            ->where('hospital_id', '!=', auth()->user()->hospital_id)
            ->get();

            $bloodStock = BloodStock::with('hospital')
            ->whereIn('blood_type_id', $bloodTypes) // Use whereIn to match blood types
            ->where('volume', '<', $volume)
            ->where('hospital_id', '!=', auth()->user()->hospital_id)
            ->get();
      

        if ($bloodStocks->isNotEmpty()) {
            // Blood stock is available, render the view with blood stock data
            $html = View::make('admin.history.request_form', [
                'bloodStocks' => $bloodStocks,
                'volume' => $volume,
                'bloodTypeId' => $bloodTypes,
            ])->render();

            return response()->json(['success' => true, 'html' => $html]);
        } else {
          
    
            // If no blood stock is found, return error response
            $html = View::make('admin.history.central_form', [
                'bloodStocks' => $bloodStock,
                'volume' => $volume,
                'bloodTypeId' => $bloodTypes->first(),
            ])->render();

            return response()->json(['success' => false, 'message' => "No blood stock"]);
        }
    }

    public function store(Request $request)
    {

        // Validate the form input
        $validatedData = $request->validate([
            'volume' => 'required',
            'blood_type_id' => 'required',
            'hospital_id' => 'required',
        ]);

        try {
            $requestHistory = new RequestHistory();
            $requestHistory->volume = $validatedData['volume'];
            $requestHistory->blood_type_id = $validatedData['blood_type_id'];
            $requestHistory->hospital_id = $validatedData['hospital_id'];
            $requestHistory->user_hospital_id = $request->user()->hospital_id;
            $requestHistory->save();



            return redirect()->route('requestHistory.histories')->with(['message' => 'Request has been stored successfully.', 'alert-type' => 'success']);
        } catch (\Exception $e) {
            error_log('Error occurred while storing request : ' . $e->getMessage());
            // Handle other exceptions
            return redirect()->back()->withErrors(['message' => 'An error occurred while processing your request.', 'alert-type' => 'error'])->withInput();
        }
    }
}
