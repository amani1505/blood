<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalsController extends Controller
{
    //
    public function index()
    {
        $hospitals = Hospital::orderBy('id','desc')->paginate(5);
        return view('admin.hospital.index',compact('hospitals'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
          
        ]);
        
        Hospital::create($request->post());

        return redirect()->route('hospital.index')->with('success','Hospital has been created successfully.');
    }
}
