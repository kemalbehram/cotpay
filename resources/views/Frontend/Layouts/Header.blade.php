<section class="page-top header">
    <div class="container">
        <div class="header-img clearfix">
            <div class="btn-mobile mt-4">
                <button><a class="openbtn" onclick="openNav()">☰</a></button>
            </div>
            <div class="header-img-content">
                <a href="">
                    <img src="asset/images/cot2.png" width="120" height="90">
                </a>
            </div>
            <div class="header-img-btn">
                @if (Auth::check())
                    <a href="
                        @if(Auth::user()->level == 1)
                            {{ route('customer.index') }}
                        @elseif(Auth::user()->level == 2)
                            {{ route('merchant.index') }}
                        @elseif(Auth::user()->level == 3)
                            {{ route('business.index') }}
                        @endif
                    " class="btn-a"><i class="fa fa-user-plus"></i> {{ Auth::user()->name }}</a>
                    <a href="{{ route('get.logout') }}" class="btn-a"><i class="fa fa-user-circle"></i> Logout</a>

                @else
                    <a href="{{route('get.login.admin')}}" class="btn-a"><i class="fa fa-user-circle"></i> Login admin</a>
                    <a href="{{route('get.login')}}" class="btn-a"><i class="fa fa-user-circle"></i> Login</a>
                    <a href="{{route('register')}}" class="btn-a"><i class="fa fa-user-plus"></i> Register</a>
                @endif
           
                <div class="dropdown">
                    <button class="dropbtn">
                        <img src="asset/images/vie.png" width="30" height="20"> Vi
                    </button>
                    <div class="dropdown-content">
                        <a href="{{ route('set.lang', ['lang'=>'vi']) }}"><img src="asset/images/vie.png" width="30" height="20"> Vi</a>
                        <a href="{{ route('set.lang', ['lang'=>'en']) }}"><img src="asset/images/us.png" width="30" height="20"> En</a>
                    </div>
                </div>
            </div>
        </div>
        <nav class="nav">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="{{ route('register.merchant.get') }}">Merchant</a></li>
                <li><a href="{{ route('register.customer.get') }}">Customer</a></li>
                <li><a href="{{ route('register.business.get') }}">Business</a></li>
                <li><a href="about">About</a></li>
                <li><a href="contact">Contact</a></li>
            </ul>
        </nav>
        <div class="menu-mobile">
            <div id="mySidepanel" class="sidepanel">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <a href="">Home</a>
                <a href="{{ route('register.merchant.get') }}`">Merchant</a>
                <a href="{{ route('register.customer.get') }}">Customer</a>
                <a href="{{ route('register.business.get') }}">Business</a>
                <a href="about">About</a>
                <a href="contact">Contact</a>

                @if (Auth::check())
                <a href="
                    @if(Auth::user()->level == 1)
                        {{ route('customer.index') }}
                    @elseif(Auth::user()->level == 2)
                        {{ route('merchant.index') }}
                    @elseif(Auth::user()->level == 3)
                        {{ route('business.index') }}
                    @endif
                " class="btn-a"><i class="fa fa-user-plus"></i> {{ Auth::user()->name }}</a>
                <a href="{{ route('get.logout') }}" class="btn-a"><i class="fa fa-user-circle"></i> Logout</a>

                @else
                    <a href="{{route('get.login.admin')}}" class="btn-a"><i class="fa fa-user-circle"></i> Login admin</a>
                    <a href="{{route('get.login')}}" class="btn-a"><i class="fa fa-user-circle"></i> Login</a>
                    <a href="{{route('register')}}" class="btn-a"><i class="fa fa-user-plus"></i> Register</a>
                @endif

                <button class="dropdown-btn"><img src="asset/images/vie.png" width="30" height="20"> Vi</button>
                <div class="dropdown-container">
                    <a href="#"><img src="asset/images/vie.png" width="30" height="20"> Vi</a>
                    <a href="#"><img src="asset/images/us.png" width="30" height="20"> En</a>
                </div>
            </div>
        </div>
    </div>
</section>
