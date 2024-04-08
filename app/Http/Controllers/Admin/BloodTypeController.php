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
        $sort = $request->get('id');
        $direction = $request->get('direction', 'asc');
        $sort = !empty($sort) ? $sort : 'id';

        if (!empty($filter)) {

            $bloodTypes =  BloodGroup::orderBy($sort, $direction)->where('blood_groups.group', 'like', '%' . $filter . '%')->paginate(10);
        } else {

            $bloodTypes = BloodGroup::orderBy($sort, $direction)->paginate(10);
        }

        return view('admin.bloodGroup.index', compact('bloodTypes', 'sort', 'direction', 'filter'));
    }

    public function create()
    {
        return view('admin.bloodGroup.create');
    }
    public function store(Request $request)

    {
        $request->validate([
            'group' => 'required',
            'description' => 'required',
            'hospital_id' => 'required'

        ]);
        try {
            BloodGroup::create($request->post());
            return redirect()->route('bloodType.bloodTypies')->with(['message' => 'Blood Type has been created successfully.', 'alert-type' => 'success']);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1062) { // Duplicate entry error code
                return back()->withErrors(['group' => 'Blood type already exists.'])->withInput()->with(['message' => 'Blood type already exists', 'alert-type' => 'error']);;
            } else {
                return back()->withErrors(['error' => 'An error occurred while processing your request. Please try again later.'])->withInput()->with(['message' => 'Error occurred while saving data.', 'alert-type' => 'error']);
            
    
            }
        }
    }
}
