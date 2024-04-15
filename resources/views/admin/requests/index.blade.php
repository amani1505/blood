@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
    $url = Request::getRequestUri();
@endphp


@extends('layouts.app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Requests</h1>
    </div>

    <!-- Content Row -->
    <div class="container-fluid  bg-white py-3">
        {{-- <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('requestHistory.create') }}" class="btn btn-info ">
                <i class="fas fa-plus"></i>
            </a>

        </div> --}}

        <!-- Search Box -->
        {{-- <div class="mb-3">
            <input type="text" class="form-control" placeholder="Search...">
        </div> --}}
        <!-- Table -->
        @if ($histories->count() > 0)
            <table class="table table-bordered table-hover">
                <thead class=" text-capitalize text-center">
                    <tr>
                        <th>#</th>
                        <th>@sortablelink('hospital_id', 'Hospital')</th>
                        <th>@sortablelink('blood_type_id', 'Blood Type')</th>
                        <th>@sortablelink('volume')(ml)</th>
                        <th>@sortablelink('status')</th>
                        <th>action</th>







                    </tr>
                </thead>
                <tbody>
                    @foreach ($histories as $index => $history)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $history->userHospital->name }}</td>
                            <td>{{ $history->bloodType->group }}</td>
                            <td>{{ $history->volume }}</td>
                            <td class="text-center"> <span class="badge badge-{{ getStatusBadgeClass($history->status) }}">
                                    {{ $history->status }}
                                </span></td>
                                <td class="text-center ">
                                    <button class="btn btn-outline-info  rounded " data-toggle="modal" data-target="#confirmApproveModal">
                                        <i class="fas fa-thumbs-up"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#confirmRejectModal">
                                        <i class="fas fa-window-close"></i>
                                    </button>
                                
                                </td>

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
            <div class="modal fade" id="confirmApproveModal" tabindex="-1" aria-labelledby="confirmApproveModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmApproveModalLabel">Confirm Approve</h5>
                            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to approve this blood stock?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <form action="{{ route('request.update', $history->id) }}"  method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="approve">
                                <button type="submit" class="btn btn-success">Reject</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="confirmRejectModal" tabindex="-1" aria-labelledby="confirmApproveModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmRejectModalLabel">Confirm Reject</h5>
                            <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to reject this blood stock?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <form action="{{ route('request.update', $history->id) }}"  method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="reject">
                                <button type="submit" class="btn btn-danger">Approve</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info" role="alert">
                No request found.
            </div>
        @endif
    </div>


    

@endsection
@php
    function getStatusBadgeClass($status)
    {
        switch ($status) {
            case 'pending':
                return 'warning';
            case 'approved':
                return 'success';
            case 'rejected':
                return 'danger';
            default:
                return 'secondary';
        }
    }
@endphp
