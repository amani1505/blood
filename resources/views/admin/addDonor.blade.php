@extends('layouts.app')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 mb-0 text-gray-800">Donors</h1>
</div>
<div class="container  bg-white rounded p-4">
    <h4 class="mb-3">Donor Registration</h4>
    <!-- Form -->
    <form>
        <div class="row">
        <div class="mb-3 col-md-6">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" placeholder="Enter your first name">
        </div>
        <div class="mb-3 col-md-6">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" placeholder="Enter your last name">
        </div>
        <div class="mb-3 col-md-6">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your email">
        </div>
        <div class="mb-3 col-md-6">
            <label for="password" class="form-label">Mobile Number</label>
            <input type="password" class="form-control" id="password" placeholder="Enter your password">
        </div>
        <div class="mb-3 col-md-6">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" placeholder="Enter Quantity">
        </div>
        <div class="mb-3 col-md-6">
            <label for="role" class="form-label">Blood Type</label>
            <select class="custom-select" aria-label="Default select example">
                <option selected>Open this select blood type</option>
                <option value="A+">A+</option>
                <option value="B+">B+</option>
                <option value="O+">O+</option>
              </select>
        </div>
        <div class="mb-3 col-md-6">
            <label for="role" class="form-label">Gender</label>
            <select class="custom-select" aria-label="Default select example">
                <option selected>Open this select gender </option>
                <option value="male">Male</option>
                <option value="female">Female</option>
               
              </select>
        </div>
      
       
    </div>
    <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
</div>
@endsection