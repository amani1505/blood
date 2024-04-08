@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Blood Stock</h1>
    </div>
    <div class="container  bg-white rounded p-4">
        <div class="pull-right mb-1">
            <a class="btn btn-light" href="{{ route('stock.stocks') }}" enctype="multipart/form-data">
                <i class="fas fa-angle-left"></i>
            </a>
        </div>
        <h4 class="mb-3">Stock Registration</h4>
        <!-- Form -->
        <form action="{{ route('stock.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')



            <div class="mb-3 ">
                <label for="volume" class="form-label">Volume</label>
                <input type="number" class="form-control" id="volume" placeholder="Enter Volume" name="volume">
            </div>
            <div class="mb-3 ">
                <label for="role" class="form-label">Blood Type</label>
                <select class="custom-select" aria-label="Default select example" name="blood_type_id">
                  
                    <option selected disabled>Open this select blood type</option>
                    @foreach ($bloodTypes as $bloodType)
                        <option value="{{ $bloodType->id }}">{{ $bloodType->group }}</option>
                    @endforeach

                </select>
            </div>



            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
@endsection
