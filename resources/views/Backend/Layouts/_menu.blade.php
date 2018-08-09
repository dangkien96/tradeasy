<nav id="mainnav-container">
    <div id="mainnav">
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">
                    <div id="mainnav-profile" class="mainnav-profile">
                        <div class="profile-wrap text-center">
                            <div class="pad-btm">
                                <img class="img-circle img-md" src="@if (Auth::check()) {{ url('') }}/{{Auth::user()->avatar}} @endif" alt="Profile Picture">
                            </div>
                            <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                <p class="mnp-name">@if (Auth::check()) {!! Auth::user()->name !!} @endif</p>
                                <span class="mnp-desc">@if (Auth::check()) {!! Auth::user()->email !!} @endif</span>
                            </a>
                        </div>
                    </div>

                   <!--  <li class="{{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active-sub active': '' }}">
                        <a href="">
                            <i class="demo-pli-male"></i>
                            <span class="menu-title"> Người dùng</span>
                        </a>
                    </li>    -->
                    <ul id="mainnav-menu" class="list-group">
                        <li class="list-divider"></li>
                        <li class="list-header">Manager</li> 
                        <li class="
                                {{ request()->is('admin/users') 
                                || request()->is('admin/users/*')
                                || request()->is('admin/roles') 
                                || request()->is('admin/roles/*')
                                ? 'active-sub active': '' }}">
                            <a href="#">
                                <i class="demo-pli-male"></i>
                                <span class="menu-title">Users</span>
                                <i class="arrow"></i>
                            </a>                    
                            <ul class="collapse">
                                <li class="{{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active-link': '' }}">
                                    <a href="{{ route('users.index') }}"><i class="ti-angle-double-right">
                                    </i>Users</a>
                                </li>
                                <li class="{{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active-link': '' }}">
                                    <a href="{{ route('roles.index') }}"><i class="ti-angle-double-right"></i>Role</a>
                                </li>
                            </ul>
                        </li>

                        <li class="
                                {{ request()->is('admin/sell-business') 
                                || request()->is('admin/sell-business/*')
                                || request()->is('admin/register-sell') 
                                || request()->is('admin/register-sell/*')
                                
                                ? 'active-sub active': '' }}">
                            <a href="#">
                                <i class="ti-package"></i>
                                <span class="menu-title">Selling Business</span>
                                <i class="arrow"></i>
                            </a>                    
                            <ul class="collapse">

                                <li class="{{ request()->is('admin/register-sell') || request()->is('admin/register-sell/*') ? 'active-link': '' }}">
                                    <a href="{{ route('register_sell.index') }}"><i class="ti-angle-double-right">
                                    </i>Register Sell</a>
                                </li>

                                <li class="{{ request()->is('admin/sell-business/process') || request()->is('admin/sell-business/process/*') ? 'active-link': '' }}">
                                    <a href="{{ route('sell_process.index') }}"><i class="ti-angle-double-right">
                                    </i>Sell process</a>
                                </li>

                                <li class="{{ request()->is('admin/sell-business/sell-criteria') || request()->is('admin/sell-business/sell-criteria/*') ? 'active-link': '' }}">
                                    <a href="{{ route('sell_criteria.index') }}"><i class="ti-angle-double-right">
                                    </i>Sell criteria</a>
                                </li>

                                <li class="{{ request()->is('admin/sell-business/sell-qa') || request()->is('admin/sell-business/sell-qa/*') ? 'active-link': '' }}">
                                    <a href="{{ route('sell_qa.index') }}"><i class="ti-angle-double-right">
                                    </i>Sell qa</a>
                                </li>

                                <li class="{{ request()->is('admin/sell-business/sell-valuation') || request()->is('admin/sell-business/sell-valuation/*') ? 'active-link': '' }}">
                                    <a href="{{ route('sell_valuation.index') }}"><i class="ti-angle-double-right">
                                    </i>Sell valuation</a>
                                </li>
                            </ul>
                        </li>

                         <li class="
                                {{ request()->is('admin/purchase-business') 
                                || request()->is('admin/purchase-business/*')
                                || request()->is('admin/register-buy') 
                                || request()->is('admin/register-buy/*')
                                ? 'active-sub active': '' }}">
                            <a href="#">
                                <i class="ti-shopping-cart"></i>
                                <span class="menu-title">Purchase Business</span>
                                <i class="arrow"></i>
                            </a>                    
                            <ul class="collapse">
                                <li class="{{ request()->is('admin/register-buy') || request()->is('admin/register-buy/*') ? 'active-link': '' }}">
                                    <a href="{{ route('register_buy.index') }}">
                                        <i class="ti-angle-double-right"></i>Register Buy</a>
                                </li>
                                <li class="{{ request()->is('admin/purchase-business/process') || request()->is('admin/purchase-business/process/*') ? 'active-link': '' }}">
                                    <a href="{{ route('buy_process.index') }}">
                                        <i class="ti-angle-double-right"></i>Buy process</a>
                                </li>

                                <li class="{{ request()->is('admin/purchase-business/safe-guard') || request()->is('admin/purchase-business/safe-guard/*') ? 'active-link': '' }}">
                                    <a href="{{ route('safe_guard.index') }}">
                                        <i class="ti-angle-double-right"></i>Safe guard</a>
                                </li>

                                <li class="{{ request()->is('admin/purchase-business/buy-qa') || request()->is('admin/purchase-business/buy-qa/*') ? 'active-link': '' }}">
                                    <a href="{{ route('buy_qa.index') }}">
                                        <i class="ti-angle-double-right"></i>Buy Qa</a>
                                </li>
                            </ul>
                        </li>

                        <li class="{{ request()->is('admin/recruits') || request()->is('admin/recruits/*') ? 'active-sub active': '' }}">
                            <a href="{{ route('recruits.index') }}">
                                <i class="ti-arrow-circle-right"></i>
                                <span class="menu-title"> Recruit</span>
                            </a>
                        </li>

                        <li class="{{ request()->is('admin/contact') || request()->is('admin/contact/*') ? 'active-sub active': '' }}">
                            <a href="{{ route('contact.index') }}">
                                <i class="ti-pin-alt"></i>
                                <span class="menu-title"> Contact Us</span>
                            </a>
                        </li>


                        <li class="{{ request()->is('admin/slides') || request()->is('admin/slides/*') ? 'active-sub active': '' }}">
                            <a href="{{ route('slides.index') }}">
                                <i class="ti-gallery"></i>
                                <span class="menu-title"> Slide</span>
                            </a>
                        </li>

                        <li class="{{ request()->is('admin/start-up-page') || request()->is('admin/start-up-page/*') ? 'active-sub active': '' }}">
                            <a href="{{ route('start_up.index') }}">
                                <i class="ti-blackboard"></i>
                                <span class="menu-title"> Startup page</span>
                            </a>
                        </li>
                       
                        <li class="{{ request()->is('admin/setting') || request()->is('admin/setting/*') ? 'active-sub active': '' }}">
                            <a href="{{ route('setting.index') }}">
                                <i class="ti-settings"></i>
                                <span class="menu-title"> Setting</span>
                            </a>
                        </li>
                        <li class="list-divider">
                        </li>
                    </ul>
                    <div class="mainnav-widget">
                        <div class="show-small">
                            <a href="#" data-toggle="menu-widget" data-target="#demo-wg-server">
                                <i class="demo-pli-monitor-2"></i>
                            </a>
                        </div>
                        <div id="demo-wg-server" class="hide-small mainnav-widget-content">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>