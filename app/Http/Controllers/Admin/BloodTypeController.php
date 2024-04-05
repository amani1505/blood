<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BloodGroup;
use App\Models\Hospital;
use Illuminate\Http\Request;

class BloodTypeController extends Controller
{

    

    public function index(Request $request)
    {
        $filter = $request->query('filter');   
        $sort = $request->get('id');
        $direction = $request->get('direction', 'asc');
        $sort = !empty($sort) ? $sort : 'id';
    
        if (!empty($filter)) {
         
            $bloodTypes =  BloodGroup::orderBy($sort, $direction)->where('blood_groups.group', 'like', '%'.$filter.'%')->paginate(2);
             
        } else {
          
            $bloodTypes = BloodGroup::orderBy($sort, $direction)->paginate(2);
        
        }
       
        return view('admin.bloodGroup.index', compact('bloodTypes', 'sort', 'direction','filter'));
    }

    public function addBloodType()
    {
        return view('admin.bloodGroup.create');
    }
    public function create(Request $request)
    {
        $request->validate([
            'group' => 'required',
            'description' => 'required',
            'hospital_id' => 'required'

        ]);
        BloodGroup::create($request->post());
        return redirect()->route('admin.bloodGroup.index')->with('success', 'Blood Type has been created successfully.');
    }
}
