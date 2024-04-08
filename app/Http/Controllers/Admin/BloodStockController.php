<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BloodStock;
use App\Models\BloodGroup;
use Illuminate\Http\Request;

class BloodStockController extends Controller
{
    
    public function index(Request $request)
    {
        {
            $filter = $request->query('filter');
            $user = $request->user();
            $sort = $request->get('id');
            $direction = $request->get('direction', 'asc');
            $sort = !empty($sort) ? $sort : 'id';
    
            // Query blood stocks with their related blood types
            $query = BloodStock::with('bloodType')->orderBy($sort, $direction);
    
            if (!empty($filter)) {
                // Filter by blood type group
                $query->whereHas('bloodType', function ($q) use ($filter) {
                    $q->where('group', 'like', '%' . $filter . '%');
                });
            }
    
            // Filter blood stocks based on user's institute ID
            $query->where('hospital_id', $user->hospital_id);
    
            $stocks = $query->paginate(10);
    
            return view('admin.stock.index', compact('stocks', 'sort', 'direction', 'filter'));
        }
    }
    
    public function create(Request $request)
    {

    $user = $request->user(); 
    $bloodTypes = BloodGroup::orderBy('id','asc')->where('hospital_id', $user->hospital_id)->get();
  
        return view('admin.stock.create',compact('bloodTypes'));
    }

    public function store(Request $request)

    {
        $validatedData = $request->validate([
            'volume' => 'required',
            'blood_type_id' => 'required',
        ]);
    
        try {
            // Create a new BloodGroup instance and assign the authenticated user's hospital_id
            $bloodStock = new BloodStock();
            $bloodStock->volume = $validatedData['volume'];
            $bloodStock->blood_type_id = $validatedData['blood_type_id'];
            $bloodStock->hospital_id = $request->user()->hospital_id;
            $bloodStock->save();
    
            return redirect()->route('stock.stocks')->with(['message' => 'Blood Stock has been created successfully.', 'alert-type' => 'success']);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the data creation process
            return back()->withErrors(['error' => 'An error occurred while processing your request. Please try again later.'])->withInput()->with(['message' => 'Error occurred while saving data.', 'alert-type' => 'error']);
        }
    }

}
