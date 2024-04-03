@extends('layouts.app')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 mb-0 text-gray-800">Blood Stock</h1>
</div>
<div class="container  bg-white rounded p-4">
    <h4 class="mb-3">Stock Registration</h4>
    <!-- Form -->
    <form>
        <div class="">
           
    
        <div class="mb-3 ">
            <label for="quantity" class="form-label">Volume</label>
            <input type="number" class="form-control" id="quantity" placeholder="Enter Volume">
        </div>
        <div class="mb-3 ">
            <label for="role" class="form-label">Blood Type</label>
            <select class="custom-select" aria-label="Default select example">
                <option selected>Open this select blood type</option>
                <option value="A+">A+</option>
                <option value="B+">B+</option>
                <option value="O+">O+</option>
              </select>
        </div>
     
       
    </div>
    <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
</div>
@endsection