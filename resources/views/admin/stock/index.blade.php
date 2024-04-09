@extends('layouts.app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Blood Stock</h1>
    </div>

    <!-- Content Row -->
    <div class="container-fluid bg-white py-3">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('stock.create') }}" class="btn btn-info ">
                <i class="fas fa-plus"></i>
            </a>

        </div>
        <!-- Search Box -->
        {{-- <div class="mb-3">
            <input type="text" class="form-control" placeholder="Search...">
        </div> --}}
        <!-- Table -->
        @if($stocks -> count() >0 )
        <table class="table table-bordered table-hover">
            <thead class="text-capitalize text-center">
                <tr>
                    <th>#</th>
                    <th> @sortablelink('blood_type_id', 'Blood Type')</th>
                    <th>@sortablelink('volume') (ml)</th>
                    {{-- <th>action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($stocks as $index => $stock)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $stock->bloodType->group }}</td>
                        <td>{{ $stock->volume }}</td>
                        {{-- <td class="text-center ">
                            <a href=""  class="btn btn-outline-info  rounded ">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#confirmDeleteModal">
                                <i class="fas fa-trash"></i>
                            </button>
                        
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center align-items-center">
            {{ $stocks->links() }}
            <p class="mx-2 text-info">
                {{ $stocks->count() }} of {{ $stocks->total() }} 
            </p>

        </div>
        @else
        <div class="alert alert-info" role="alert">
            No blood types found.
        </div>
    @endif
    </div>
@endsection
