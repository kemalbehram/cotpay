
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                </span>
                                </div>
                            </li>
                            <li>
                                <a href="
                                    @if(Auth::user()->level == 1)
                                        {{ route('customer.index') }}
                                    @elseif(Auth::user()->level == 2)
                                        {{ route('merchant.index') }}
                                    @elseif(Auth::user()->level == 3)
                                        {{ route('business.index') }}
                                    @endif
                                " class="@yield('index')"><i class="fa fa-dashboard fa-fw"></i> Tổng quan</a>
                            </li>
                            <li>
                                <a href="
                                    @if(Auth::user()->level == 1)
                                        {{ route('customer.shopping.proposal') }}
                                    @elseif(Auth::user()->level == 2)
                                        {{ route('merchant.shopping.proposal') }}
                                    @elseif(Auth::user()->level == 3)
                                        {{ route('business.shopping.proposal') }}
                                    @endif
                                " class="@yield('shopping')"><i class="fa fa-edit fa-fw"></i> Các đề nghị mua hàng</a>
                            </li>
                            <li>
                                <a class="@yield('sell')" href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Tạo giao dịch<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level @yield('in')">
                                    <li>
                                        <a href=" 
                                            @if(Auth::user()->level == 1)
                                                {{ route('customer.sell') }}
                                            @elseif(Auth::user()->level == 2)
                                                {{ route('merchant.sell') }}
                                            @elseif(Auth::user()->level == 3)
                                                {{ route('business.sell') }}
                                            @endif
                                        " class="@yield('sell')">Tạo giao dịch bán</a>
                                    </li>
                                    <li>
                                        <a href="
                                            @if(Auth::user()->level == 1)
                                            {{ route('customer.buy') }}
                                            @elseif(Auth::user()->level == 2)
                                                {{ route('merchant.buy') }}
                                            @elseif(Auth::user()->level == 3)
                                                {{ route('business.buy') }}
                                            @endif
                                        " class="@yield('buy')">Tạo giao dịch mua</a>
                                    </li>
                                </ul>
                                
                            </li>
                            <li>
                                <a class="@yield('management.sell')" href="#"><i class="fa fa-wrench fa-fw"></i> Quản lý giao dịch<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level @yield('management.in')">
                                    <li>
                                        <a href="
                                            @if(Auth::user()->level == 1)
                                            {{ route('customer.management.sell') }}
                                            @elseif(Auth::user()->level == 2)
                                                {{ route('merchant.management.sell') }}
                                            @elseif(Auth::user()->level == 3)
                                                {{ route('business.management.sell') }}
                                            @endif
                                        " class="@yield('management.sell')">Quản lý giao dịch bán</a>
                                    </li>
                                    <li>
                                        <a href="
                                            @if(Auth::user()->level == 1)
                                            {{ route('customer.management.buy') }}
                                            @elseif(Auth::user()->level == 2)
                                                {{ route('merchant.management.buy') }}
                                            @elseif(Auth::user()->level == 3)
                                                {{ route('business.management.buy') }}
                                            @endif
                                            " class="@yield('management.buy')">Quản lý giao dịch mua</a>
                                    </li>                                
                                </ul>
                                
                            </li>
                            {{-- <li>
                                <a class="@yield('confirmed.order')" href="#"><i class="fa fa-check-square-o fa-fw"></i>Quản lý giao dịch đã xác nhận<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level @yield('confirmed.in')">
                                    <li>
                                        <a href="
                                            @if(Auth::user()->level == 1)
                                            {{ route('customer.confirmed.sell') }}
                                            @elseif(Auth::user()->level == 2)
                                                {{ route('merchant.confirmed.sell') }}
                                            @elseif(Auth::user()->level == 3)
                                                {{ route('business.confirmed.sell') }}
                                            @endif
                                            " class="@yield('confirmed.sell')">Giao dịch bán</a>
                                    </li>
                                    <li>
                                        <a href="
                                            @if(Auth::user()->level == 1)
                                            {{ route('customer.confirmed.buy') }}
                                            @elseif(Auth::user()->level == 2)
                                                {{ route('merchant.confirmed.buy') }}
                                            @elseif(Auth::user()->level == 3)
                                                {{ route('business.confirmed.buy') }}
                                            @endif
                                            " class="@yield('confirmed.buy')">Giao dịch mua</a>
                                    </li>
                                
                                </ul>
                                
                            </li> --}}
                            <li>
                                <a href="#"><i class="fa fa-table fa-fw"></i> Quản lý ví bonus<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="
                                            @if(Auth::user()->level == 1)
                                            {{ route('customer.recharge') }}
                                            @elseif(Auth::user()->level == 2)
                                                {{ route('merchant.recharge') }}
                                            @elseif(Auth::user()->level == 3)
                                                {{ route('business.recharge') }}
                                            @endif
                                        " class="@yield('recharge')">Nạp tiền ví bonus</a>
                                    </li>
                                    {{-- <li>
                                        <a href="
                                            @if(Auth::user()->level == 1)
                                                {{ route('customer.withdraw') }}
                                            @elseif(Auth::user()->level == 2)
                                                {{ route('merchant.withdraw') }}
                                            @elseif(Auth::user()->level == 3)
                                                {{ route('business.withdraw') }}
                                            @endif
                                        " class="@yield('withdraw')">Rút tiền ví bonus</a>
                                    </li> --}}
                                </ul>
                                
                            </li>
                            
                          
                            {{-- <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#">Second Level Item</a>
                                    </li>
                                    <li>
                                        <a href="#">Second Level Item</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="#">Third Level Item</a>
                                            </li>
                                            <li>
                                                <a href="#">Third Level Item</a>
                                            </li>
                                            <li>
                                                <a href="#">Third Level Item</a>
                                            </li>
                                            <li>
                                                <a href="#">Third Level Item</a>
                                            </li>
                                        </ul>
                                        <!-- /.nav-third-level -->
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="blank.html">Blank Page</a>
                                    </li>
                                    <li>
                                        <a href="login.html">Login Page</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="page-wrapper">
                <div class="container-fluid">