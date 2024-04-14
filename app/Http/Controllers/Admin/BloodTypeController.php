<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BloodGroup;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class BloodTypeController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
    $user = $request->user();
    
    $sort = $request->get('id');
    $direction = $request->get('direction', 'asc');
    $sort = !empty($sort) ? $sort : 'id';

    $query = BloodGroup::orderBy($sort, $direction);

    if (!empty($filter)) {
        $query->where('group', 'like', '%' . $filter . '%');
    }

    // Filter blood types based on user's institute ID
    $query->where('hospital_id', $user->hospital_id);

    $bloodTypes = $query->paginate(10);

    return view('admin.bloodGroup.index', compact('bloodTypes', 'sort', 'direction', 'filter'));
    }

    public function create()
    {
        return view('admin.bloodGroup.create');
    }
    public function store(Request $request)

    {
        $validatedData = $request->validate([
            'group' => 'required',
            'description' => 'required',
        ]);
    
        try {
            // Create a new BloodGroup instance and assign the authenticated user's hospital_id
            $bloodGroup = new BloodGroup();
            $bloodGroup->group = $validatedData['group'];
            $bloodGroup->description = $validatedData['description'];
            $bloodGroup->hospital_id = $request->user()->hospital_id;
            $bloodGroup->save();
    
            return redirect()->route('bloodType.bloodTypies')->with(['message' => 'Blood Type has been created successfully.', 'alert-type' => 'success']);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the data creation process
            return back()->withErrors(['error' => 'An error occurred while processing your request. Please try again later.'])->withInput()->with(['message' => 'Error occurred while saving data.', 'alert-type' => 'error']);
        }
    }

    public function edit($id)
    {
        $bloodType = BloodGroup::findOrFail($id);
        return view('admin.bloodGroup.edit', compact('bloodType'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'group' => 'required',
        'description' => 'required',
        'hospital_id' => 'required'
    ]);

    try {
        $bloodType = BloodGroup::findOrFail($id);
        $bloodType->update($request->all());
        return redirect()->route('bloodType.bloodTypies')->with(['message' => 'Blood Type has been updated successfully.', 'alert-type' => 'success']);
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'An error occurred while processing your request. Please try again later.'])->withInput()->with(['message' => 'Error occurred while updating data.', 'alert-type' => 'error']);
    }
}
public function destroy($id)
{
    $bloodType = BloodGroup::findOrFail($id);
    $bloodType->delete();
    return redirect()->route('bloodType.bloodTypies')->with(['message' => 'Blood Type has been deleted successfully.', 'alert-type' => 'success']);
}
}
