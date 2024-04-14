<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RequestHistory;
use Illuminate\Http\Request;
use App\Models\BloodGroup;
use App\Models\BloodStock;
use App\Models\Hospital;
use Illuminate\Support\Facades\View;

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
        $query = RequestHistory::with(['bloodType', 'hospital'])
            ->orderBy($sort, $direction);

        if (!empty($filter)) {
            // You can filter by blood type group or hospital name if needed
            $query->whereHas('bloodType', function ($q) use ($filter) {
                $q->where('group', 'like', '%' . $filter . '%');
            });
            // Add similar logic for filtering by hospital if needed
        }

        // Filter request histories based on user's institute ID
        $query->where('user_hospital_id', $user->hospital_id);

        $histories = $query->paginate(10);

        return view('admin.history.index', compact('histories', 'sort', 'direction', 'filter'));
    }
    public function create(Request $request)

    {

        $user = $request->user();
        $bloodTypes = BloodGroup::orderBy('id', 'asc')
            ->where('hospital_id', '!=', $user->hospital_id)
            ->get();

        return view('admin.history.create', compact('bloodTypes'));
    }
    public function checkVolumeAndBloodType(Request $request)
    {
        $request->validate([
            'volume' => 'required|numeric|min:1',
            'blood_type_id' => 'required|exists:blood_groups,id',
        ]);
    
        // Get the input volume and blood type
        $volume = $request->input('volume');
        $bloodTypeId = $request->input('blood_type_id');
       
    
        // Find blood stocks matching the blood type and volume
        $bloodStocks = BloodStock::with('hospital')->where('blood_type_id', $bloodTypeId)
            ->where('volume', '>=', $volume)
            ->get();
    
        if ($bloodStocks->isNotEmpty()) {
            $request->session()->put('volume', $volume);
            $request->session()->put('blood_type_id', $bloodTypeId);
    
            // Render the view with blood stock data
            $html = View::make('admin.history.request_form', ['bloodStocks' => $bloodStocks,'volume' => $volume,
            'bloodTypeId' => $bloodTypeId,])->render();
    
            return response()->json(['success' => true, 'html' => $html]);
        } else {
            // If no blood stock is found, return error response
            return response()->json(['success' => false, 'message' => 'No blood stock available for the specified volume and blood type.']);
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
            error_log('Request history saved successfully.');

    
            return redirect()->route('requestHistory.histories')->with(['message' => 'Request history has been stored successfully.', 'alert-type' => 'success']);

    
        } catch (\Exception $e) {
            error_log('Error occurred while storing request history: ' . $e->getMessage());
            // Handle other exceptions
            return redirect()->back()->withErrors(['message' => 'An error occurred while processing your request.','alert-type' => 'error'])->withInput();
        }
    }
}
