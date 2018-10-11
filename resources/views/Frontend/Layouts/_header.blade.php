@php
    $contact   = app('AboutUs')->getContact();
@endphp

<header>
    <div class="header-area">
        <!-- start header top area -->
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <ul class="header-top-left">
                            <li><a href="#"><i class="fa fa-envelope-o"></i>{{ @$contact->data->email }} </a></li>
                            <li><a href="#"><i class="fa fa-phone"></i> {{ @$contact->data->phone }}</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <ul class="social-bookmarks">
                            <li><a href="{{ @$contact->data->fb }}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{ @$contact->data->wechat }}"><i class="fa fa-weixin"></i></a></li>
                            <li><a href="{{ @$contact->data->whatsap }}"><i class="fa fa-whatsapp"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End header top area -->
        <div class="main-header">
            <div id="sticky-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-2">
                            <div class="logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ url('Frontend/img/logo.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-10 hidden-xs hidden-sm mainmenu-main-wrapper">
                            <div class="menu-area add-search">
                                <nav>
                                    <ul class="main-menu hover-style-one clearfix ">
                                        <li class="{{ request()->is('/') ? 'active': '' }}">
                                            <a href="{{ route('home') }}"><i class="fa fa-home"></i></a>
                                        </li>
                                        <li>
                                            <a href="{{ route('fe.about_us') }}">{{ trans('fe_menu.about_us') }}</a>
                                        </li>
                                        <li class="{{ request()->is('business/') || request()->is('business/*') ? 'active': '' }}">
                                            <a href="{{ route('fe.business') }}">{{ trans('fe_menu.business') }}</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('fe.franchise') }}">{{ trans('fe_menu.franchise') }}</a>
                                        </li>
                                        <li class="{{ request()->is('buy-business/') || request()->is('buy-business/*') ? 'active': '' }}">
                                            <a href="#">{{ trans('fe_menu.buy_business') }}
                                                <span><i class="fa fa-sort-desc" aria-hidden="true"></i></span>
                                            </a>
                                            <ul class="dropdown">
                                                
                                                <li>
                                                    <a href="{{ route('fe.buy') }}">
                                                        <i class="fa fa-caret-right"></i>{{ trans('fe_menu.register_buy_business') }}
                                                    </a>
                                                </li>
                                                <li class="{{ request()->is('buy-business/process') || request()->is('buy-business/process/*') ? 'active-li': '' }}">
                                                    <a href="{{ route('fe.buy_business_process') }}">
                                                        <i class="fa fa-caret-right"></i>{{ trans('fe_menu.buy_process') }}
                                                    </a>
                                                </li>
                                                <li class="{{ request()->is('/buy-business/safeguard') || request()->is('/buy-business/safeguard/*') ? 'active-li': '' }}">
                                                    <a href="{{ route('fe.buy_guard') }}">
                                                        <i class="fa fa-caret-right"></i>{{ trans('fe_menu.safeguard') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('fe.buy_qa') }}"><i class="fa fa-caret-right"></i>{{ trans('fe_menu.buy_qa') }}</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li 
                                        class="">
                                            <a href="#">{{ trans('fe_menu.transfer_business') }} 
                                                <span><i class="fa fa-sort-desc" aria-hidden="true"></i></span>
                                            </a>
                                            <ul class="dropdown">
                                                <li><a href="{{ route('fe.sell_business') }}"><i class="fa fa-caret-right"></i>{{ trans('fe_menu.sell_business') }} </a></li>
                                                <li><a href="{{ route('fe.sell_business_process') }}"><i class="fa fa-caret-right"></i>{{ trans('fe_menu.sell_business_process') }}</a></li>
                                                <li><a href="{{ route('fe.sell_criteria') }}"><i class="fa fa-caret-right"></i>{{ trans('fe_menu.sell_criteria') }}</a></li>
                                                <li><a href="{{ route('fe.sell_business_qa') }}"><i class="fa fa-caret-right"></i>{{ trans('fe_menu.sell_business_qa') }}</a></li>
                                                <li><a href="{{ route('fe.sell_valuation') }}"><i class="fa fa-caret-right"></i>{{ trans('fe_menu.sell_valuation') }}</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('fe.start_up') }}">{{ trans('fe_menu.start_up') }}</a></li>
                                        <li><a href="{{ route('fe.recruits') }}">{{ trans('fe_menu.recruit') }}</a></li>
                                        <li><a href="{{ route('fe.contact') }}">{{ trans('fe_menu.contact') }}</a></li>
                                    </ul>
                                    <ul class="header-action">
                                        <li class="search-icon">
                                            <i class="fa fa-search"></i>
                                        </li>
                                        <li class="search-box">
                                            <form action="http://purehostbd.com/html/rumi-preview/Post">
                                                <input type="text" class="search-option" placeholder="SEARCH HARE">
                                            </form>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="mobile-menu-area">
                            <div class="mobile-menu-custom">
                                <ul>
                                    <li class="active"><a href="#">Home</a></li>
                                    <li><a href="{{ route('fe.about_us') }}">{{ trans('fe_menu.about_us') }}</a></li>
                                    <li><a href="{{ route('fe.business') }}">{{ trans('fe_menu.business') }}</a></li>
                                    <li><a href="{{ route('fe.franchise') }}">{{ trans('fe_menu.franchise') }}</a></li>
                                    <li><a href="{{ route('home') }}">{{ trans('fe_menu.buy_business') }} <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                        <ul>
                                            <li><a href="{{ route('fe.buy') }}">{{ trans('fe_menu.register_buy_business') }}</a></li>
                                            <li><a href="{{ route('fe.buy_business_process') }}">{{ trans('fe_menu.buy_process') }}</a></li>
                                            <li><a href="{{ route('fe.buy_guard') }}">{{ trans('fe_menu.safeguard') }}</a></li>
                                            <li><a href="{{ route('fe.buy_qa') }}">{{ trans('fe_menu.buy_qa') }}</a></li>

                                        </ul>
                                    </li>
                                    <li><a href="#">{{ trans('fe_menu.transfer_business') }} <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                        <ul>
                                            <li><a href="{{ route('fe.sell_business') }}">{{ trans('fe_menu.sell_business') }}</a></li>
                                            <li><a href="{{ route('fe.sell_business_process') }}">{{ trans('fe_menu.sell_business_process') }}</a></li>
                                            <li><a href="{{ route('fe.sell_criteria') }}">{{ trans('fe_menu.sell_criteria') }}</a></li>
                                            <li><a href="{{ route('fe.sell_business_qa') }}">{{ trans('fe_menu.sell_business_qa') }}</a></li>
                                            <li><a href="{{ route('fe.sell_valuation') }}">{{ trans('fe_menu.sell_valuation') }}</a></li>
                                            
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('fe.start_up') }}">{{ trans('fe_menu.start_up') }}</a></li>
                                    <li><a href="{{ route('fe.recruits') }}">{{ trans('fe_menu.contact') }}</a></li>
                                    <li><a href="{{ route('fe.contact') }}">{{ trans('fe_menu.contact') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>