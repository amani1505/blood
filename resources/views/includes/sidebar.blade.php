@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
    $url = Request::getRequestUri();
    $user = Auth::user()->role;
@endphp

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">

            <i class="fas fa-hand-holding-heart"></i>
        </div>
        <div class="sidebar-brand-text mx-3 uppercase">
            cbms
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if ($user == 'HOSPITAL_ADMIN')
        <li class="nav-item {{ str_contains($route, 'dashboard') ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <li class="nav-item {{ str_contains($route, 'bloodTypies') ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('bloodType.bloodTypies') }}">
                <i class="fas fa-tint "></i>
                <span>Blood Type</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <li class="nav-item {{ str_contains($route, 'stocks') ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('stock.stocks') }}">
                <i class="fas fa-hand-holding-heart"></i>
                <span>Blood Stock</span>
            </a>
        </li>
        <hr class="sidebar-divider">

        <li class="nav-item {{ str_contains($route, 'requests') ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('request.requests') }}">
                <i class="fas fa-bullhorn"></i>
                <span>Blood Requests</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <li class="nav-item {{ str_contains($route, 'histories') ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('requestHistory.histories') }}">
                <i class="fas fa-history"></i>
                <span>Request History</span>
            </a>
        </li>
    @elseif($user == 'CENTRAL_ADMIN')
        {
        <li class="nav-item {{ str_contains($route, 'dashboard') ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <li class="nav-item {{ str_contains($route, 'requests') ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('request.requests') }}">
                <i class="fas fa-bullhorn"></i>
                <span>Blood Requests</span>
            </a>
        </li>
        </li>
    @endif

    <!-- Divider -->

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
