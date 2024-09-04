<div>
    <div class="app-menu navbar-menu">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <!-- Dark Logo-->
            <a href="#" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{asset('assets/images/logo.png')}}" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{asset('assets/images/logo.png')}}" alt="" height="17">
                </span>
            </a>
            <!-- Light Logo-->
            <a href="#" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{asset('assets/images/logo.png')}}" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{asset('assets/images/logo.png')}}" alt="" height="17">
                </span>
            </a>
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                <i class="ri-record-circle-line"></i>
            </button>
        </div>

        <div id="scrollbar">
            <div class="container-fluid">
                <div id="two-column-menu">
                </div>
                <ul class="navbar-nav" id="navbar-nav">
                    @if($links && count($links) > 0)
                        @foreach($links as $link)
                            @if(isset($link->sub_links) && count($link->sub_links) > 0)
                                <li class="nav-item">
                                    <a class="nav-link menu-link {{Route::is($link->route_name) ? 'collapsed active' : ''}}"
                                       href="#sidebarsidebar_{{$link->id}}"
                                       data-bs-toggle="collapse" role="button"
                                       aria-expanded="{{Route::is($link->route_name) ? 'true' : 'false'}}"
                                       aria-controls="sidebarsidebar_{{$link->id}}"
                                    >
                                        <i class="{{$link->icon}}"></i> <span
                                            data-key="t-dashboards">{{$link->name}}</span>
                                    </a>
                                    <div class="collapse menu-dropdown" id="sidebarsidebar_{{$link->id}}">
                                        <ul class="nav nav-sm flex-column">

                                            @foreach($link->sub_links as $sub)
                                                @if(checkPermition($sub->id) == 1)
                                                    <li class="nav-item">
                                                        <a href="{{route($sub->route_name)}}" wire:navigate
                                                           class="nav-link {{Route::is($sub->route_name) ? 'active' : ''}}"
                                                           data-key="t-analytics"> {{$sub->name}} </a>
                                                    </li>
                                                @endif
                                            @endforeach

                                        </ul>
                                    </div>
                                </li>
                            @else
                                @if(checkPermition($link->id) == 1)
                                    <li class="nav-item">
                                        <a class="nav-link menu-link {{Route::is($link->route_name) ? 'active' : ''}}"
                                           wire:navigate href="{{route($link->route_name)}}">
                                            <i class="{{$link->icon}}"></i> <span
                                                data-key="t-widgets">{{$link->name}}</span>
                                        </a>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                    @endif


                </ul>
            </div>
            <!-- Sidebar -->
        </div>
        <div class="sidebar-background"></div>
    </div>
    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>
</div>
