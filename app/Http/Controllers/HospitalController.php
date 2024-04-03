<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    //
    public function index()
    {
        $companies = Hospital::orderBy('id','desc')->paginate(5);
        return view('hospital.index', compact('hospitals'));
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
