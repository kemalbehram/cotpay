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
                <a href="{{ route('index.admin') }}" class=""><i class="fa fa-dashboard fa-fw"></i> Tổng quan</a>
            </li>
            
            <li>
                <a href="#" class="@yield('deal')"><i class="fa fa-wrench fa-fw"></i> Quản lý giao dịch<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level @yield('in_deal')">
                    @if (Auth::guard('admin')->user()->hasAnyPermission(['C12','C00'], 'admin'))                  
                        <li>
                            <a href="{{ route('list.deal.under.10t') }}" class="@yield('deal_down10t')">Danh sách giao dịch < 10 triệu</a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasAnyPermission(['C13','C00'], 'admin'))                  
                        <li>
                            <a href="{{ route('list.deal.than.10t') }}" class="@yield('deal_up10t')">Danh sách giao dịch > 10 triệu</a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->hasAnyPermission(['C14','C00'], 'admin'))                  
                        <li>
                            <a href="{{ route('list.business') }}" class="@yield('deal_business')">Danh sách giao dịch doanh nghiệp</a>
                        </li>
                    @endif
                </ul>

            </li>
            @if (Auth::guard('admin')->user()->hasPermissionTo('C15', 'admin'))
                <li>
                    <a href="#" class="@yield('bonus')" ><i class="fa fa-cc-discover"></i> Quản lý ví Bonus <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level @yield('bonus_in')">
                        <li>
                            <a class="@yield('bonus')" href="{{ route('get.bonus') }}" >Ví Bonus</a>
                        </li>
                    </ul>
                </li>
            @endif
            <li>
                <a href="#" class="{{-- @yield('contact') @yield('contact_process') --}}"><i class="fa fa-phone-square"></i> Liên hệ<span class="fa arrow"></span></a>
                 <ul class="nav nav-second-level @yield('inn') @yield('in_contact')" >
                    <li>
                        <a href="{{ route('list.contact') }} "  class="@yield('contact')">Danh sách liên hệ</a>
                    </li>
                    <li>
                        <a href="{{ route('list.processed.contact') }} " class="@yield('contact_process')">Danh sách liên hệ đã xử lý</a>
                    </li>
                </ul>
            </li>
            @if (Auth::guard('admin')->user()->hasAnyPermission(['C11', 'C18'], 'admin'))
                <li>
                    <a href="#" class="@yield('account') @yield('account_admin')"><i class="fa fa-sitemap fa-fw"></i> Quản lý tài khoản<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level @yield('in') @yield('in_admin')">
                        @if (Auth::guard('admin')->user()->hasPermissionTo('C18', 'admin'))
                            <li>
                                <a href="{{ route('list.account.admin') }}" class="@yield('account_admin')">Quản lý tài khoản admin</a>
                            </li>
                        @endif
                        @if (Auth::guard('admin')->user()->hasPermissionTo('C11', 'admin'))
                        <li>
                            <a href="#" class="@yield('account')">Quản lý tài khoản user <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level @yield('in')">
                                <li>
                                    <a class="@yield('account_customer')" href="{{ route('list.account.customer') }}">Quản lý tài khoản customer</a>
                                </li>
                                <li>
                                    <a class="@yield('account_merchant')" href="{{ route('list.account.merchant') }}">Quản lý tài khoản merchant</a>
                                </li>
                                <li>
                                    <a class="@yield('account_business')" href="{{ route('list.account.business') }}">Quản lý tài khoản business</a>
                                </li>
                            </ul>
                        </li>
                       @endif
                    </ul>
                </li>
            @endif
            @role('supper-admin','admin')
                <li>
                    <a class="@yield('role')" href="#"><i class="fa fa-user"></i> Phân quyền<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level @yield('in_role')">
                        <li>
                            <a class="@yield('role')" href="{{ route('get.list.role') }}" >Vai trò</a>
                        </li>
                    </ul>
                </li>
            @endrole

            <li>
                <a href="#"><i class="fa fa-info"></i> Giới thiệu<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin/about" >Sửa danh mục</a>
                    </li>
                    {{-- <li>
                        <a href="#">Sửa ảnh Logo đối tác</a>
                    </li>
                     --}}
                </ul>

            </li>
            @if (Auth::guard('admin')->user()->hasPermissionTo('C11', 'admin'))
                <li>
                    <a href="{{route('get.wallet')}}"><i class="fa fa-google-wallet"></i> Quản lý ví</a>
                </li>
            @endif
            <li>
                <a href="{{route('get.delivery.unit')}}"><i class="fa fa-automobile"></i> Quản lý đơn vị giao nhận</a>
            </li>
            <li>
                <a href=" {{route('admin.get.order')}} "><i class="fa fa-subway fa-fw"></i> Giao hàng</a>
            </li>
        </ul>
    </div>
</div>
</nav>

<div id="page-wrapper">
<div class="container-fluid">
