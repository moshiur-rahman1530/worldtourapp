<div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item "> <a class="nav-link nav-toggler  hidden-md-up  waves-effect waves-dark" href="javascript:void(0)"><i class="fas  fa-bars"></i></a></li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="fas fa-bars"></i></a> </li>
                       
                     <li class="nav-item mt-3">Site Name</li>
					</ul>


                    
                    <div class="dropdown">
                    

                   <button class="btn btn-secondary dropdown-toggle dropbtn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}<i class="fas fa-angle-down ml-1"></i> 
                    </button>
                    <ul class="dropdown-menu me-4" aria-labelledby="dropdownMenuButton1" id="myDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                    </div>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                    <li class="nav-devider mt-0" style="margin-bottom: 5px"></li>
                    <li>
                    <a href="{{ url('/') }}">
                        <span>
                        <i class="fas fa-angle-double-left"></i>
                        </span>
                        <span class="hide-menu">Visit Client Area</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/admin/home') }}">
                        <span>
                        <i class="fas fa-home"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/category') }}">
                        <span>
                        <i class="fas fa-desktop"></i>
                        <!-- <i class="fab fa-cuttlefish"></i> -->
                        </span>
                        <span class="hide-menu">Category</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/admin/tour') }}">
                        <span>
                        <i class="fas fa-car"></i>
                        <!-- <i class="fab fa-cuttlefish"></i> -->
                        </span>
                        <span class="hide-menu">Tour</span>
                    </a>
                    </li>
                    <li>
                    <a href="{{ url('/admin/manage-tour') }}">
                        <span>
                        <i class="fas fa-plane"></i>
                        <!-- <i class="fab fa-cuttlefish"></i> -->
                        </span>
                        <span class="hide-menu">Manage Booking</span>
                    </a>
                    </li>
                     
					</ul>
                </nav>
            </div>
        </aside>
<div class="page-wrapper">
