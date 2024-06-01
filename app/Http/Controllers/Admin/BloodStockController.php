<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BloodStock;
use App\Models\BloodGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BloodStockController extends Controller
{

    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $user = $request->user();
        $sort = $request->get('id');
        $direction = $request->get('direction', 'asc');
        $sort = !empty($sort) ? $sort : 'id';

        // Query blood stocks with their related blood types
        $query = BloodStock::with('bloodType')
            ->join('blood_groups', 'blood_stocks.blood_type_id', '=', 'blood_groups.id')
            ->select('blood_stocks.*', 'blood_groups.group')
            ->orderBy($sort, $direction);

        if (!empty($filter)) {
            // Filter by blood type group
            $query->where('blood_groups.group', 'like', '%' . $filter . '%');
        }

        // Filter blood stocks based on user's institute ID
        $query->where('blood_stocks.hospital_id', $user->hospital_id);

        $stocks = $query->paginate(10);

        return view('admin.stock.index', compact('stocks', 'sort', 'direction', 'filter'));
    }

    public function create(Request $request)
    {

        $user = $request->user();
        // $bloodTypes = BloodGroup::orderBy('id', 'asc')->where('hospital_id', $user->hospital_id)->get();
        $query = BloodGroup::orderBy('id', 'asc');
        $query->whereHas('hospitals', function ($q) use ($user) {
            $q->where('hospitals.id', $user->hospital_id);
        });

        $bloodTypes = $query->paginate(100);


        return view('admin.stock.create', compact('bloodTypes'));
    }

    public function store(Request $request)

    {
        $validatedData = $request->validate([
            'volume' => 'required',
            'blood_type_id' => 'required',
        ]);

        try {
            $userHospitalId = $request->user()->hospital_id;
            $bloodTypeId = $validatedData['blood_type_id'];
            $volumeToAdd = $validatedData['volume'];

            // Check if blood stock already exists for the given blood type and hospital
            $bloodStock = BloodStock::where('blood_type_id', $bloodTypeId)
                ->where('hospital_id', $userHospitalId)
                ->first();

            if ($bloodStock) {
                // Blood stock exists, update the volume by adding the provided volume
                $bloodStock->increment('volume', $volumeToAdd);
            } else {
                // Blood stock does not exist, create a new entry
                $bloodStock = BloodStock::create([
                    'volume' => $volumeToAdd,
                    'blood_type_id' => $bloodTypeId,
                    'hospital_id' => $userHospitalId,
                ]);
            }

            return redirect()->route('stock.stocks')->with(['message' => 'Blood Stock has been updated/created successfully.', 'alert-type' => 'success']);
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error('Error occurred while saving blood stock: ' . $e->getMessage());

            // Provide a more detailed error message to the user
            return back()->withErrors(['error' => 'An error occurred while processing your request. Please try again later. Error details: ' . $e->getMessage()])
                ->withInput()
                ->with(['message' =>  $e->getMessage(), 'alert-type' => 'error']);
        }
    }
}
