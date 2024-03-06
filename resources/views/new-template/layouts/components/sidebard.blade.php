<div class="sticky">
    <div class="main-menu main-sidebar main-sidebar-sticky side-menu">
        <div class="main-sidebar-header main-container-1 active">
            <div class="sidemenu-logo">
                <a class="main-logo" href="/">
                    <img src="{{ asset('assets/img/logo/LB-Roofing-LLC.png') }}" alt=""
                         class="wd-40 header-brand-img desktop-logo">
                    <img src="{{ asset('assets/img/logo/LB-Roofing-LLC.png') }}" alt=""
                         class="header-brand-img desktop-logo theme-logo">

                    <img src="{{ asset('') }}assets/img/logo/LB-Roofing-LLC.png" style="max-width: 45px;"
                         class="header-brand-img icon-logo" alt="logo">
                    <img src="{{ asset('') }}assets/img/logo/LB-Roofing-LLC.png" style="max-width: 45px;"
                         class="header-brand-img icon-logo theme-logo" alt="logo">
                </a>
            </div>
            <div class="main-sidebar-body main-body-1">
                <div class="slide-left disabled" id="slide-left"><i class="fe fe-chevron-left"></i></div>
                <ul class="menu-nav nav">
                @if(auth()->user()->accessAllowed())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="ti-home sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">{{ __('lang.home') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products') }}">
                            <i class="ti-package sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">{{ __('lang.product.products') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('providers') }}">
                            <i class="mdi mdi-truck sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">{{ __('lang.sidebar.providers') }}</span>
                        </a>
                    </li>
                @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('projects') }}">
                            <i class="ti-write sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">{{ __('lang.projects') }}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('all-quotes') }}">
                            <i class="ti-wallet sidemenu-icon menu-icon "></i>
                            <span class="sidemenu-label">{{ __('lang.sidebar.quotes') }}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('all-invoices') }}">
                            <i class="ti-shopping-cart-full sidemenu-icon menu-icon"></i>
                            <span class="sidemenu-label">{{ __('lang.sidebar.invoices') }}</span>
                        </a>
                    </li>
                    @if(auth()->user()->accessAllowed())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('clients') }}">
                                <i class="ion-briefcase sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">{{__('lang.sidebar.customers')}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link with-sub" href="javascript:void(0);">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ion-person-stalker sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">{{__('lang.sidebar.staff')}}</span>
                                <i class="angle fe fe-chevron-right"></i>
                            </a>
                            <ul class="nav-sub" style="display: none;">
                                <li class="side-menu-label1"><a href="javascript:void(0);"></a></li>
                                <li class="nav-sub-item">
                                    <a class="nav-sub-link"
                                       href="{{ route('administrators') }}">{{__('lang.sidebar.administrators')}}</a>
                                </li>
                                <li class="nav-sub-item">
                                    <a class="nav-sub-link"
                                       href="{{ route('sellers') }}">{{__('lang.sidebar.sellers')}}</a>
                                </li>
                                <li class="nav-sub-item">
                                    <a class="nav-sub-link"
                                       href="{{ route('accountants') }}">{{__('lang.sidebar.accountants')}}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('show-report-gallery') }}">
                                <i class="ion-briefcase sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">{{__('lang.sidebar.report_gallery')}}</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link with-sub" href="javascript:void(0);">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="fa-solid fa-file-signature sidemenu-icon menu-icon"></i>
                                <span class="sidemenu-label">{{__('lang.templates')}}</span>
                                <i class="angle fe fe-chevron-right"></i>
                            </a>
                            <ul class="nav-sub" style="display: none;">
                                <li class="side-menu-label1"><a href="javascript:void(0);"></a></li>
                                <li class="nav-sub-item">
                                    <a class="nav-sub-link"
                                       href="{{ route('quote-template-list') }}">{{__('lang.quote.quote')}}</a>
                                </li>
                                <li class="nav-sub-item">
                                    <a class="nav-sub-link"
                                       href="{{ route('template-message') }}">{{__('lang.quote.message_client')}}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reports') }}">
                                <i class="fa-solid fa-chart-simple sidemenu-icon menu-icon"></i>
                                <span class="sidemenu-label">{{__('lang.reports')}}</span>
                            </a>
                        </li>
                    @endif

                </ul>
                <div class="slide-right" id="slide-right"><i class="fe fe-chevron-right"></i></div>
            </div>
        </div>
    </div>
</div>
