@php
    $contact   = app('AboutUs')->getContact();
@endphp
<footer class="footer-area ">
    <div class="footer-top-section pt-100 black-bg">
        <div class="container">
            <div class="row">
                <div class="widget-wrapper">
                    <div class="col-md-3 col-sm-6">
                        <div class="widget-item">
                            <!-- <h1 class="footer-logo">Tradeasy<span></span></h1> -->
                            <img src="{{ url('Frontend/img/logo.png') }}" alt="">
                            <ul class="social-bookmarks footer-social">
                                <li><a href="{{ @$contact->data->fb }}"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="{{ @$contact->data->wechat }}"><i class="fa fa-weixin"></i></a></li>
                                <li><a href="{{ @$contact->data->whatsap }}"><i class="fa fa-whatsapp"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4">
                        <div class="widget-item">
                            <h2>{{ trans('fe_menu.about_us') }}</h2>
                            <ul class="widget-link">
                                <li><a href="{{ route('fe.about_us') }}"> <i aria-hidden="true" class="fa fa-long-arrow-right"></i>{{ trans('fe_menu.about_us') }}</a></li>
                                <li><a href="#"><i aria-hidden="true" class="fa fa-long-arrow-right"></i>{{ trans('fe_menu.recruit') }}</a></li>
                                <li><a href="{{ route('fe.contact') }}"><i aria-hidden="true" class="fa fa-long-arrow-right"></i>
                                {{ trans('fe_menu.contact') }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4">
                        <div class="widget-item">
                            <h2>{{ trans('fe_menu.buy_business') }}</h2>
                            <ul class="widget-link">
                                <li><a href="{{ route('fe.business') }}"> <i aria-hidden="true" class="fa fa-long-arrow-right"></i>{{ trans('fe_menu.business') }}</a></li>
                                <li><a href="{{ route('fe.franchise') }}"><i aria-hidden="true" class="fa fa-long-arrow-right"></i>{{ trans('fe_menu.franchise') }}</a></li>
                                <li><a href="{{ route('fe.buy') }}"><i aria-hidden="true" class="fa fa-long-arrow-right"></i>{{ trans('fe_menu.register_buy_business') }}
                                </a></li>
                                <li><a href="{{ route('fe.buy_business_process') }}"><i aria-hidden="true" class="fa fa-long-arrow-right"></i>{{ trans('fe_menu.buy_process') }}
                                </a></li>
                                <li><a href="{{ route('fe.buy_guard') }}"><i aria-hidden="true" class="fa fa-long-arrow-right"></i>{{ trans('fe_menu.safeguard') }}
                                </a></li>
                                <li><a href="{{ route('fe.buy_qa') }}"><i aria-hidden="true" class="fa fa-long-arrow-right"></i>{{ trans('fe_menu.buy_qa') }}
                                </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4">
                        <div class="widget-item">
                            <h2>{{ trans('fe_menu.transfer_business') }} </h2>
                            <ul class="widget-link">
                                <li><a href="{{ route('fe.sell_business') }}"> <i aria-hidden="true" class="fa fa-long-arrow-right"></i>{{ trans('fe_menu.sell_business') }}</a></li>
                                <li><a href="{{ route('fe.sell_business_process') }}"><i aria-hidden="true" class="fa fa-long-arrow-right"></i>{{ trans('fe_menu.sell_business_process') }}</a></li>
                                <li><a href="{{ route('fe.sell_criteria') }}"><i aria-hidden="true" class="fa fa-long-arrow-right"></i>{{ trans('fe_menu.sell_criteria') }}
                                </a></li>
                                <li><a href="{{ route('fe.sell_business_qa') }}"><i aria-hidden="true" class="fa fa-long-arrow-right"></i>{{ trans('fe_menu.sell_business_qa') }}
                                </a></li>
                                <li><a href="{{ route('fe.sell_valuation') }}"><i aria-hidden="true" class="fa fa-long-arrow-right"></i>{{ trans('fe_menu.sell_valuation') }}
                                </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="widget-item">
                            <h2>聯絡資訊</h2>
                            <ul class="widget-address">
                                <li><a href="#"><i class="fa fa-map-marker m-5"></i> {{ @$contact->data->address }}</a></li>
                                <li><a href="#"><i class="fa fa-phone m-5"></i> {{ @$contact->data->phone }}</a></li>
                                <li><a href="#"><i class="fa fa-envelope m-5"></i> {{ @$contact->data->email }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright">
                        <p>Copyright 2018 &copy; Design and code by cloud tech</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>