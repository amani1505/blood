@extends('layouts.app')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 mb-0 text-gray-800">Blood Type</h1>
</div>
<div class="container  bg-white rounded p-4">
    <div class="pull-right mb-1">
        <a class="btn btn-light" href="{{ route('bloodType.bloodTypies') }}" enctype="multipart/form-data">
            <i class="fas fa-angle-left"></i>
        </a>
    </div>
    <h4 class="mb-3">Update Blood Type</h4>
    
    <!-- Form -->
    <form action="{{ route('bloodType.update', $bloodType ->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        <div class="mb-3">
            <label for="group" class="form-label">Type</label>
            <input type="text" class="form-control" id="" placeholder="Enter your blood type" name='group' value={{$bloodType -> group}}>
            @error('group')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="descripition" class="form-label">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name='description' >{{$bloodType -> description}}</textarea>
            @error('description')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 d-none">
            <label for="last_name" class="form-label">Description</label>
            <input class="form-control" id="exampleFormControlTextarea1" name='hospital_id' value={{auth()->user()->hospital_id}} >
            @error('name')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
       
      
       
    
    <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
</div>
@endsection