<nav class="navbar navbar-light">
    <div class="navbar-left">
        <div class="logo-area">
            <a class="navbar-brand" href="">
                <img class="dark" src="{{ asset('assets/img/logo-dark.svg') }}" alt="svg">
                <img class="light" src="{{ asset('assets/img/logo-white.svg') }}" alt="img">
            </a>
            <a href="#" class="sidebar-toggle">
                <img class="svg" src="{{ asset('assets/img/svg/align-center-alt.svg') }}" alt="img"></a>
        </div>

    </div>
    <div class="navbar-right">
        <ul class="navbar-right__menu">
            <li class="nav-search">

                <form action="/" class="search-form-topMenu">
                    <span class="search-icon uil uil-search"></span>
                    <input class="form-control me-sm-2 box-shadow-none" type="search" placeholder="Search..."
                        aria-label="Search">
                </form>
            </li>
            <li class="nav-notification">
                <a href="" class="nav-item-toggle icon-active">
                    <span class="search-icon uil material-icons" style="color: #666d92">notifications_active</span>
                </a>
            </li>
            <li class="nav-author">
                <div class="dropdown-custom">
                    <a href="javascript:;" class="nav-item-toggle"><img src=""
                            onerror="this.src='{{ asset('assets/img/author-nav.jpg') }}'" alt=""
                            class="rounded-circle">
                        @if (Auth::check())
                            <span class="nav-item__title">{{ Auth::user()->name }}<i
                                    class="las la-angle-down nav-item__arrow"></i></span>
                        @endif
                    </a>
                    <div class="dropdown-wrapper">
                        <div class="d-flex align-items-center gap-3" style="padding: 9px 25px;">
                            <div class="author-img ">
                                <img src="" alt=""
                                    onerror="this.src='{{ asset('assets/img/author-nav.jpg') }}'"
                                    class="rounded-circle ">
                            </div>
                            <div>
                                @if (Auth::check())
                                    <h6 class="text-capitalize">{{ Auth::user()->name }}</h6>
                                @else
                                    <span>User Name</span>
                                @endif
                            </div>
                        </div>
                        <div class="nav-author__options">
                            <ul>
                                <li style="border-top: 1px solid #E4EBEF;">
                                    <a href="" class="d-flex align-items-center gap-1">
                                        <span class="nav-icon nav  material-icons">manage_accounts</span> Profile</a>
                                </li>
                                <li style="border-top: 1px solid #E4EBEF;">
                                    <a href="" class="d-flex align-items-center gap-1">
                                        <span class="nav-icon nav  material-icons">settings</span>
                                        Settings</a>
                                </li>
                                <li style="border-top: 1px solid #E4EBEF;"
                                    onclick="event.preventDefault();document.getElementById('logout').submit();">
                                    <a class="d-flex align-items-center gap-1">
                                        <span class="nav-icon nav  material-icons">logout</span>Sign Out</a>
                                    <form style="display:none;" id="logout" action="" method="POST">
                                        @csrf
                                        @method('post')
                                    </form>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="navbar-right__mobileAction d-md-none">
            <a href="#" class="btn-search">
                <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg feather-search">
                <img src="{{ asset('assets/img/svg/x.svg') }}" alt="x" class="svg feather-x">
            </a>
            <a href="#" class="btn-author-action">
                <img src="{{ asset('assets/img/svg/more-vertical.svg') }}" alt="more-vertical" class="svg"></a>
        </div>
    </div>
</nav>
