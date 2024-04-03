@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
    $url = Request::getRequestUri();
@endphp


@extends('layouts.app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Request History</h1>
    </div>

    <!-- Content Row -->
    <div class="container-fluid  bg-white py-3">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('requestHistory.createRequest') }}" class="btn btn-info ">
                <i class="fas fa-plus"></i>
                Add Request</a>

        </div> 
     
        <!-- Search Box -->
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Search...">
        </div>
        <!-- Table -->
        <table class="table table-bordered table-hover">
            <thead class="table-dark text-capitalize text-center">
                <tr>
                    <th>#</th>
                    <th>Hospital</th>
                    <th>Blood Type</th>
                    <th>Volume (ml)</th>
                    <th>Gender</th>
                    <th>Status</th>
                 
              
                    

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Muhimbili</td>
                    <td>A+</td>
                    <td>1 Litre</td>
                    <td>female</td>
                 
                        <td class="text-center ">  
                            <div class="bg-warning rounded text-white ">pending</div>
                        </td>
                   
                
                </tr>
                <tr>
                    <td>2</td>
                    <td>Aga Khan Hospital</td>
                    <td>B+</td>
                    <td>2 Litre</td>
                    <td>male</td>
                    <td class="text-center ">  
                        <div class="bg-success rounded text-white ">approved</div>
                    </td>
                 
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
        <!-- Pagination -->
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item active" aria-current="page">
                <a class="page-link" href="#">1 </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </div>

@endsection
