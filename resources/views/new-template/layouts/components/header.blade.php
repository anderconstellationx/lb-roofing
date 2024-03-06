<div class="main-header side-header sticky">
    <div class="main-container container-fluid">
        <div class="main-header-left">
            <a class="main-header-menu-icon" href="javascript:void(0);" id="mainSidebarToggle"><span></span></a>
            <div class="hor-logo">
                <a class="main-logo" href="index.php">
                    <img src="{{ asset('') }}assets/img/brand/logo.png" class="header-brand-img desktop-logo"
                         alt="logo">

                    <img src="{{ asset('') }}assets/img/brand/logo-light.png" class="header-brand-img desktop-logo-dark"
                         alt="logo">
                </a>
            </div>
        </div>
        <div class="main-header-center">
            <div class="responsive-logo">
                <a href="index.php"><img src="{{ asset('') }}assets/img/brand/logo.png" class="mobile-logo" alt="logo"></a>
                <a href="index.php"><img src="{{ asset('') }}assets/img/brand/logo-light.png" class="mobile-logo-dark"
                                         alt="logo"></a>
            </div>
        </div>
        <div class="main-header-right">
            <button class="navbar-toggler navresponsive-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4"
                    aria-expanded="false" aria-label="Toggle navigation">
                <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
            </button><!-- Navresponsive closed -->
            <div class="navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                    <div class="d-flex order-lg-2 ms-auto" style="align-items: center;">
                        <!-- Search -->
                        <div class="dropdown header-search">
                            <a class="nav-link icon header-search">
                                <i class="fe fe-search header-icons"></i>
                            </a>
                            <div class="dropdown-menu">
                                <div class="main-form-search p-2">
                                    <div class="input-group">
                                        <div class="input-group-btn search-panel">
                                            <select class="form-control select2">
                                                <option label="All categories">
                                                </option>
                                                <option value="IT Projects">
                                                    IT Projects
                                                </option>
                                                <option value="Business Case">
                                                    Business Case
                                                </option>
                                                <option value="Microsoft Project">
                                                    Microsoft Project
                                                </option>
                                                <option value="Risk Management">
                                                    Risk Management
                                                </option>
                                                <option value="Team Building">
                                                    Team Building
                                                </option>
                                            </select>
                                        </div>
                                        <input type="search" class="form-control" placeholder="Search for anything...">
                                        <button class="btn search-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-search">
                                                <circle cx="11" cy="11" r="8"></circle>
                                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Search -->

                        <!-- Theme-Layout -->
                        <div class="dropdown main-header-theme">
                            <a class="nav-link icon layout-setting">
                                        <span class="dark-layout">
                                            <i class="fe fe-sun header-icons"></i>
                                        </span>
                                <span class="light-layout">
                                            <i class="fe fe-moon header-icons"></i>
                                        </span>
                            </a>
                        </div>
                        <!-- Theme-Layout -->

                        <!-- Conutry -->

                        <!-- Conutry -->

                        <!-- Full screen -->
                        <div class="dropdown ">
                            <a class="nav-link icon full-screen-link">
                                <i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
                                <i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
                            </a>
                        </div>
                        <!-- Full screen -->

                        <!-- Profile -->
                        <div class="dropdown main-profile-menu">
                            <a class="d-flex" href="javascript:void(0);">
                                <form method="POST" action="{{ route('logout') }}">
                                    <a class="dropdown-item" href="route('logout')"
                                       onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="fe fe-power"></i>{{__('lang.logout')}}
                                    </a>
                                    @csrf
                                </form>
                            </a>
                        </div>
                        <!-- Profile -->

                        <!-- Sidebar -->
                        <div class="dropdown  header-settings" hidden>
                            <a href="javascript:void(0);" class="nav-link icon" data-bs-toggle="sidebar-right"
                               data-bs-target=".sidebar-right">
                                <i class="fe fe-align-right header-icons"></i>
                            </a>
                        </div>
                        <!-- Sidebar -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
