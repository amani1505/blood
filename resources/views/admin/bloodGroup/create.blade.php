@extends('layouts.app')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 mb-0 text-gray-800">Blood Type</h1>
</div>
<div class="container  bg-white rounded p-4">
    <h4 class="mb-3">Blood Type Registration</h4>
    <!-- Form -->
    <form>
       
        <div class="mb-3">
            <label for="first_name" class="form-label">Type</label>
            <input type="text" class="form-control" id="first_name" placeholder="Enter your blood type">
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
       
      
       
    
    <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
</div>
@endsection