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

    @if($user == 'ADMIN')
        <li class="nav-item {{ str_contains($route, 'dashboard')  ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        {{-- <li class="nav-item {{ str_contains($route, 'donors')  ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('donor.donors') }}">
                <i class="fas fa-user  "></i>
                <span>Donors</span>
            </a>
        </li> --}}
        <li class="nav-item {{ str_contains($route, 'stocks')  ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('stock.stocks') }}">
                <i class="fas fa-hand-holding-heart"></i>
                <span>Blood Stock</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <li class="nav-item {{ str_contains($route, 'hospitals')  ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('hospital.hospitals') }}">
                <i class="fas fa-building"></i>
                <span>Hospitals</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <li class="nav-item {{ str_contains($route, 'requests')  ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('request.requests') }}">
                <i class="fas fa-bullhorn"></i>
                <span>Blood Requests</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <li class="nav-item {{ str_contains($route, 'history')  ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('requestHistory.history') }}">
                <i class="fas fa-history"></i>
                <span>Request History</span>
            </a>
        </li>
        {{-- <hr class="sidebar-divider"> --}}
    
      
        {{-- <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-file"></i>
                <span>Menu</span>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="#">
                        Option 1
                    </a>
                    <a class="collapse-item" href="#">
                        Option 2
                    </a>
                </div>
            </div>
        </li> --}}
        {{-- <hr class="sidebar-divider">
        <li class="nav-item {{ str_contains($route, 'dashboard')  ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-user-circle"></i>
                <span>Profile</span>
            </a>
        </li> --}}
      
@endif

<!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
