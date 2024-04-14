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
            <a href="{{ route('requestHistory.create') }}" class="btn btn-info ">
                <i class="fas fa-plus"></i>
                </a>

        </div> 
     
        <!-- Search Box -->
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Search...">
        </div>
        <!-- Table -->
        @if($histories -> count() >0 )
        <table class="table table-bordered table-hover">
            <thead class=" text-capitalize text-center">
                <tr>
                    <th>#</th>
                    <th>@sortablelink('hospital_id','Hospital')</th>
                    <th>@sortablelink('blood_type_id','Blood Type')</th>
                    <th>@sortablelink('volume')(ml)</th>
                  
                   
                 
              
                    

                </tr>
            </thead>
            <tbody>
                @foreach ($histories as $index => $history)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{$history -> hospital -> name}}</td>
                    <td>{{$history -> bloodType -> group}}</td>
                    <td>{{$history -> volume}}</td>
                
                </tr>
                

                @endforeach
               
                <!-- Add more rows as needed -->
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="pagination justify-content-center align-items-center">
            {{ $histories->links() }}
            <p class="mx-2 text-info">
                {{ $histories->count() }} of {{ $histories->total() }} 
            </p>

        </div>
        @else
        <div class="alert alert-info" role="alert">
            No request history found.
        </div>
    @endif
    </div>

@endsection
