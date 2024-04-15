@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
    $url = Request::getRequestUri();
@endphp
@extends('layouts.app')
@section('content')
    <!-- Page Heading -->
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div> --}}

    <!-- Content Row -->
    @if ($bloodStocks->count() > 0)
    <div class="row">
        @foreach ($bloodStocks as $index => $bloodStock)
        <div class="col-md-3">
            <a href="" style="text-decoration:none;">
                <div class="mb-4">
                    <div class="card h-auto">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center justify-content-end" >
                                <div class="text-dark mx-2">
                                    <h4>{{$bloodStock->bloodType->group}}</h4>
                                </div>
                                <div class="">
                                    <i class="fas fa-tint fa-2x text-danger "></i>
                                </div>
                            </div>
                                <div class="col">
                                    {{-- <div class="text-xs font-weight-bold text-secondary text-uppercase mb-2">
                                        Admins
                                    </div> --}}
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                                        {{$bloodStock->volume}}
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach


    </div>
    <hr>
@endif

    <div class="row">
  

        <div class="col-md-3">
          
                <div class="mb-4">
                    <div class="card h-auto">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center justify-content-end" >
                            
                                <div class="">
                                   
                                    <i class="fas fa-bullhorn fa-2x text-primary"></i>
                                </div>
                            </div>
                                <div class="col">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-2">
                                        Total Requests
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{$totalRequests}}
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
          
        </div>

  

   
        <div class="col-md-3">
           
                <div class="mb-4">
                    <div class="card h-auto">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center justify-content-end" >
                             
                                <div class="">
                                    <i class="fas fa-check-circle fa-2x text-success"></i>
                                </div>
                            </div>
                                <div class="col">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-2">
                                      Approved Requests
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                      {{$totalApprovedRequests}}
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            
        </div>

        <div class="col-md-3">
           
                <div class="mb-4">
                    <div class="card h-auto">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center justify-content-end" >
                             
                                <div class="">
                                  
                                    <i class="fas fa-window-close fa-2x text-danger"></i>
                                </div>
                            </div>
                                <div class="col">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-2">
                                      Rejected Requests
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                      {{$totalRejectedRequests}}
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
          
        </div>


        <div class="col-md-3">
           
                <div class="mb-4">
                    <div class="card h-auto">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center justify-content-end" >
                             
                                <div class="">
                                    <i class="fas fa-spinner fa-2x text-warning"></i>
                                </div>
                            </div>
                                <div class="col">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-2">
                                      Pending Requests
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                      {{$totalPendingRequests}}
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
           
        </div>

  

   
    



    </div>
@endsection
