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
    
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
    
        $query = BloodGroup::orderBy($sort, $direction);
    
        if (!empty($filter)) {
            $query->where('group', 'like', '%' . $filter . '%');
        }

        // Filter blood types based on user's hospital
        $query->whereHas('hospitals', function ($q) use ($user) {
            $q->where('hospitals.id', $user->hospital_id);
        });
    
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
            // Create a new BloodGroup instance
            $bloodGroup = BloodGroup::create([
                'group' => $validatedData['group'],
                'description' => $validatedData['description'],
                'hospital_id' => $request->user()->hospital_id, // Assign current user's hospital ID
            ]);

            // Attach the hospital of the current user to the blood group
            $bloodGroup->hospitals()->attach($request->user()->hospital_id);

            return redirect()->route('bloodType.index')->with(['message' => 'Blood Type has been created successfully.', 'alert-type' => 'success']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while processing your request. Please try again later.'])->withInput()->with(['message' => 'Error occurred while saving data.', 'alert-type' => 'error']);
        }
    }

    public function edit($id)
    {
        $bloodGroup = BloodGroup::findOrFail($id);
        return view('admin.bloodGroup.edit', compact('bloodGroup'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'group' => 'required',
            'description' => 'required',
        ]);

        try {
            $bloodGroup = BloodGroup::findOrFail($id);
            $bloodGroup->update([
                'group' => $validatedData['group'],
                'description' => $validatedData['description'],
            ]);

            // Sync the hospital of the current user with the blood group
            $bloodGroup->hospitals()->sync([$request->user()->hospital_id]);

            return redirect()->route('bloodType.index')->with(['message' => 'Blood Type has been updated successfully.', 'alert-type' => 'success']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while processing your request. Please try again later.'])->withInput()->with(['message' => 'Error occurred while updating data.', 'alert-type' => 'error']);
        }
    }

    public function destroy($id)
    {
        try {
            $bloodGroup = BloodGroup::findOrFail($id);
            $bloodGroup->hospitals()->detach();
            $bloodGroup->delete();

            return redirect()->route('bloodType.index')->with(['message' => 'Blood Type has been deleted successfully.', 'alert-type' => 'success']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while processing your request. Please try again later.'])->with(['message' => 'Error occurred while deleting data.', 'alert-type' => 'error']);
        }
    }
}
