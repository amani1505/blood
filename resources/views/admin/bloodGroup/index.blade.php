@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
    $url = Request::getRequestUri();
@endphp


@extends('layouts.app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Blood Type</h1>
    </div>

    <!-- Content Row -->
    <div class="container-fluid  bg-white py-3">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('bloodType.createBloodType') }}" class="btn btn-info ">
                <i class="fas fa-plus"></i>
            </a>

        </div>

        <!-- Search Box -->
        <form method="GET">
            <div class="container-fluid p-3">
                <div class="row text-white p-0 ">
                    <div class="col-10 p-0"> <input type="text" class="form-control" id="filter" name="filter"
                            placeholder="Enter Blood Type..." value="{{ $filter }}"></div>
                    <div class="col-2 px-2"> <button type="submit"
                            class="btn btn-success w-100 text-uppercase">search</button></div>
                </div>

            </div>
        </form>

        @if ($bloodTypes->count() > 0)
            <table class="table table-bordered table-hover">
                <thead class="text-dark text-capitalize text-center">
                    <tr>
                        <th> #</th>
                        <th>@sortablelink('group')</th>
                        <th>@sortablelink('description')</th>
                        <th>Action</th>




                    </tr>
                </thead>
                <tbody>
                    @php $counter = 1 @endphp
                    @foreach ($bloodTypes as $bloodType)
                        <tr>
                            <td>{{ $counter}}</td>
                            <td>{{ $bloodType->group }}</td>
                            <td>{{ $bloodType->description }}</td>

                            <td class="text-center ">
                            <div class="row">
                              <div class="col-6">
                                <a href="{{ route('bloodType.edit', $bloodType->id) }}"  class="btn btn-outline-info  rounded ">
                                    <i class="fas fa-edit"></i>
                                </a>
                              </div>
                              <div class="col-6">
                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#confirmDeleteModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                              </div>
                              

                            </div>
                            
                            </td>



                        </tr>
                        @php $counter++ @endphp
                    @endforeach


                    <!-- Add more rows as needed -->
                </tbody>
            </table>


            <!-- Pagination -->
            <div class="pagination justify-content-center align-items-center">
                {{ $bloodTypes->links() }}
                <p class="mx-2 text-info">
                    {{ $bloodTypes->count() }} of {{ $bloodTypes->total() }} 
                </p>

            </div>
        @else
            <div class="alert alert-info" role="alert">
                No blood types found.
            </div>
        @endif
        <!-- Table -->

    </div>


<!-- Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this blood type?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="{{ route('bloodType.delete', $bloodType->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
