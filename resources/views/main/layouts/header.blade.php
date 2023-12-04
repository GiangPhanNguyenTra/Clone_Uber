<div class="header">
    <!-- header unfixed-->
    <div class="header-unfixed container header-container">
        <div class="header__menu">
            <ul class="header__menu-main">
                <li><a href="/">Home</a></li>
                <li><a href="/customer/booking-ride">ride</a></li>
                <li><a href="/home/driver">Drive</a></li>
                <li><a href="#">About</a>
                    <ul class="header__menu-subone">
                        <li><a href="#">Questions</a></li>
                        <li><a href="#">Locations</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="header__logo">
            <a href="/">
                Uber
            </a>
        </div>
        <div class="header__right">
            <div class="header__right-notifier">
                <i class="fa-regular fa-bell"></i>
                <span class="cart-count">(0)</span>
            </div>
            <div class="header__right-login">
                @php
                    if (Auth::guard('customer')->check()) {
                        $guard_name = 'customer';
                    } else if (Auth::guard('driver')->check()) {
                        $guard_name = 'driver';
                    } else {
                        $guard_name = '';
                    }
                @endphp
                @if (Auth::guard($guard_name)->check())
                    <span class="user-tie"><i class="fa-solid fa-user"></i></span>
                    <div class="user-dropdown-menu-contain">
                        <div class="user-dropdown-menu">
                            <ul>
                                <li class="user-dropdown-item">
                                    <div class="user-highlight">
                                        @if (Auth::guard($guard_name)->user()->avata !== null)
                                            <img src="{{asset('upload/images/'.$guard_name.'-avata/'.Auth::guard($guard_name)->user()->avata)}}" alt="">
                                        @else
                                            <img src="https://pbs.twimg.com/media/EbNX_erVcAUlwIx.jpg:large" alt="">
                                        @endif
                                    </div>
                                    <div class="user-detail">
                                        <div class="user-detail-name">{{Auth::guard($guard_name)->user()->name}}</div>
                                        <div class="user-detail-role">
                                            <small class="text-muted">{{ucfirst(Auth::guard($guard_name)->user()->getRoleNames()->first())}}</small>
                                        </div>
                                </li>
                                <li class="line"></li>
                                @if (Auth::guard($guard_name)->user()->getRoleNames()->first() == 'customer' || Auth::guard($guard_name)->user()->getRoleNames()->first() == 'driver')
                                    <li class="user-dropdown-item">
                                        <a href="/{{$guard_name}}/account" class="user-menu-link">
                                            <i class="fa-regular fa-user"></i>
                                            <span>Tài khoản của tôi</span>
                                        </a>
                                    </li>
                                    @if (Auth::guard($guard_name)->user()->getRoleNames()->first() == 'driver')
                                        <li class="line"></li>
                                        <li class="user-dropdown-item">
                                            <a href="/driver/identification-documents" class="user-menu-link">
                                                <i class="fa-solid fa-address-card"></i>
                                                <span>Giấy tờ</span>
                                            </a>
                                        </li>
                                        <li class="line"></li>
                                        <li class="user-dropdown-item">
                                            <a href="/driver/vehicle" class="user-menu-link">
                                                <i class="fa-solid fa-motorcycle"></i>
                                                <span>Phương tiện</span>
                                            </a>
                                        </li>
                                        <li class="line"></li>
                                        <li class="user-dropdown-item">
                                            <a href="/driver/landing-booking-ride" class="user-menu-link">
                                                <i class="fa-solid fa-file-invoice"></i>
                                                <span>Cuốc xe</span>
                                            </a>
                                        </li>
                                        <li class="line"></li>
                                    @else
                                        <li class="line"></li>
                                        <li class="user-dropdown-item">
                                            <a href="/customer/booking-ride" class="user-menu-link">
                                                <i class="fa-solid fa-file-invoice"></i>
                                                <span>Đặt xe</span>
                                            </a>
                                        </li>
                                        <li class="line"></li>
                                    @endif
                                @endif
                                <li class="user-dropdown-item">
                                    <a href="/{{Auth::guard($guard_name)->user()->getRoleNames()->first()}}/logout" class="user-menu-link">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                        <span>Đăng xuất</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="user-layout"></div>    
                @else
                    <a href="/customer/register">
                        <p>Đăng kí</p>
                        <svg width="32" height="32" viewBox="0 0 32 32" style="fill: #fff;height: 20px;">
                            <path d="M 4,15C 4,15.552, 4.448,16, 5,16l 19.586,0 l-4.292,4.292c-0.39,0.39-0.39,1.024,0,1.414 c 0.39,0.39, 1.024,0.39, 1.414,0l 6-6c 0.092-0.092, 0.166-0.202, 0.216-0.324C 27.972,15.26, 28,15.132, 28,15.004c0-0.002,0-0.002,0-0.004 l0,0c0-0.13-0.026-0.26-0.078-0.382c-0.050-0.122-0.124-0.232-0.216-0.324l-6-6c-0.39-0.39-1.024-0.39-1.414,0 c-0.39,0.39-0.39,1.024,0,1.414L 24.586,14L 5,14 C 4.448,14, 4,14.448, 4,15z"/>
                        </svg>
                    </a>
                @endif  
            </div>
        </div>
    </div>
    <!-- header fixed -->
    <div class="header-wrapper-fixed">
        <div class="header-fixed container header-container">
            <div class="header__menu header__menu-fixed">
                <ul class="header__menu-main header__menu-main-fixed">
                    <li><a href="/">Home</a></li>
                    <li><a href="/customer/booking-ride">ride</a></li>
                    <li><a href="/home/driver">Drive</a></li>
                    <li><a href="#">About</a>
                        <ul class="header__menu-subone header__menu-subone-fixed">
                            <li><a href="#">Questions</a></li>
                            <li><a href="#">Locations</a></li>
                            <li><a href="#">Blog</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="header__logo header__logo-fixed">
                <a href="/">
                    Uber
                </a>
            </div>
            <div class="header__right">
                <div class="header__right-notifier header__right-notifier-fixed">
                    <i class="fa-regular fa-bell"></i>
                    <span class="cart-count">(0)</span>
                </div>
                <div class="header__right-login header__right-login-fixed">
                    @if (Auth::guard($guard_name)->check())
                        <span class="user-tie"><i class="fa-solid fa-user"></i></span>
                        <div class="user-dropdown-menu-contain">
                            <div class="user-dropdown-menu">
                                <ul>
                                    <li class="user-dropdown-item">
                                        <div class="user-highlight">
                                            @if (Auth::guard($guard_name)->user()->avata !== null)
                                                <img src="{{asset('upload/images/'.$guard_name.'-avata/'.Auth::guard($guard_name)->user()->avata)}}" alt="">
                                            @else
                                                <img src="https://pbs.twimg.com/media/EbNX_erVcAUlwIx.jpg:large" alt="">
                                            @endif
                                        </div>
                                        <div class="user-detail">
                                            <div class="user-detail-name">{{Auth::guard($guard_name)->user()->name}}</div>
                                            <div class="user-detail-role">
                                                <small class="text-muted">{{ucfirst(Auth::guard($guard_name)->user()->getRoleNames()->first())}}</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="line"></li>
                                    @if (Auth::guard($guard_name)->user()->getRoleNames()->first() == 'customer' || Auth::guard($guard_name)->user()->getRoleNames()->first() == 'driver')
                                        <li class="user-dropdown-item">
                                            <a href="/{{$guard_name}}/account" class="user-menu-link">
                                                <i class="fa-regular fa-user"></i>
                                                <span>Tài khoản của tôi</span>
                                            </a>
                                        </li>
                                        @if (Auth::guard($guard_name)->user()->getRoleNames()->first() == 'driver')
                                            <li class="line"></li>
                                            <li class="user-dropdown-item">
                                                <a href="/driver/identification-documents" class="user-menu-link">
                                                    <i class="fa-solid fa-address-card"></i>
                                                    <span>Giấy tờ</span>
                                                </a>
                                            </li>
                                            <li class="line"></li>
                                            <li class="user-dropdown-item">
                                                <a href="/driver/vehicle" class="user-menu-link">
                                                    <i class="fa-solid fa-motorcycle"></i>
                                                    <span>Phương tiện</span>
                                                </a>
                                            </li>
                                            <li class="line"></li>
                                            <li class="user-dropdown-item">
                                                <a href="/driver/landing-booking-ride" class="user-menu-link">
                                                    <i class="fa-solid fa-file-invoice"></i>
                                                    <span>Cuốc xe</span>
                                                </a>
                                            </li>
                                            <li class="line"></li>
                                        @else
                                            <li class="line"></li>
                                            <li class="user-dropdown-item">
                                                <a href="/customer/booking-ride" class="user-menu-link">
                                                    <i class="fa-solid fa-file-invoice"></i>
                                                    <span>Đặt xe</span>
                                                </a>
                                            </li>
                                            <li class="line"></li>
                                        @endif
                                    @endif
                                    <li class="user-dropdown-item">
                                        <a href="/{{Auth::guard($guard_name)->user()->getRoleNames()->first()}}/logout" class="user-menu-link">
                                            <i class="fa-solid fa-right-from-bracket"></i>
                                            <span>Đăng xuất</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="user-layout"></div>    
                    @else
                        <a href="/customer/register">
                            <p>Đăng kí</p>
                            <svg width="32" height="32" viewBox="0 0 32 32" style="fill: rgb(0, 0, 0);height: 20px;">
                                <path d="M 4,15C 4,15.552, 4.448,16, 5,16l 19.586,0 l-4.292,4.292c-0.39,0.39-0.39,1.024,0,1.414 c 0.39,0.39, 1.024,0.39, 1.414,0l 6-6c 0.092-0.092, 0.166-0.202, 0.216-0.324C 27.972,15.26, 28,15.132, 28,15.004c0-0.002,0-0.002,0-0.004 l0,0c0-0.13-0.026-0.26-0.078-0.382c-0.050-0.122-0.124-0.232-0.216-0.324l-6-6c-0.39-0.39-1.024-0.39-1.414,0 c-0.39,0.39-0.39,1.024,0,1.414L 24.586,14L 5,14 C 4.448,14, 4,14.448, 4,15z"/>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- header responosivbe --}}
    <div class="header-responesive">
        <div class="header-inner">
            <a href="/" class="header-logo-mobile">
                Uber
            </a>
            <div class="header-right-mobile">
                <div class="header__right-notifier header__right-notifier-fixed">
                   <i class="fa-regular fa-bell"></i>
                    <span class="cart-count">(0)</span>
                </div>

                <div class="nav-icon-btn">
                    <div class="nav-icon-line"></div>
                    <div class="nav-icon-line"></div>
                    <div class="nav-icon-line"></div>
                </div>
            </div>
        </div>
        <nav>
            <ul class="header-nav">
                <li>
                    <div class="header-inner-sub">
                        <a href="/">home</a>
                    </div>
                <li> 
                    <div class="header-inner-sub">
                        <a href="/home/driver">Ride</a>
                    </div>
                </li>
                <li>
                    <div class="header-inner-sub">
                        <a href="/">Drive</a>
                    </div>
                </li>
                </li>
                <li>
                    <div class="header-inner-sub">
                        <a href="/">About</a>
                        <svg class="qodef-svg--menu-arrow qodef-menu-item-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="12" height="8" viewBox="0 0 12.09 8.5" enable-background="new 0 0 12.09 8.5" xml:space="preserve"><g><path d="M11.98,4.02c0.06,0.06,0.09,0.14,0.09,0.23c0,0.09-0.03,0.17-0.09,0.23l-3.9,3.9C8.05,8.41,8.02,8.44,7.97,8.45
                            C7.94,8.47,7.89,8.48,7.85,8.48S7.77,8.47,7.73,8.45C7.69,8.44,7.65,8.41,7.62,8.38c-0.06-0.06-0.1-0.14-0.1-0.23
                            s0.03-0.17,0.1-0.23l3.35-3.35H0.38c-0.09,0-0.17-0.03-0.23-0.09s-0.1-0.14-0.1-0.23c0-0.09,0.03-0.17,0.1-0.24
                            c0.06-0.06,0.14-0.09,0.23-0.09h10.59L7.62,0.58c-0.06-0.06-0.1-0.14-0.1-0.23s0.03-0.17,0.1-0.23c0.06-0.06,0.14-0.1,0.23-0.1
                            c0.09,0,0.16,0.03,0.23,0.1L11.98,4.02z"></path></g></svg>
                    </div>
                    <nav>
                        <ul class="nav-sub-mobile">
                            <li><a href="#">Questions</a></li>
                            <li><a href="#">Locations</a></li>
                            <li><a href="#">Blog</a></li>
                        </ul>
                    </nav>
                </li>
                <li>
                    @if (Auth::guard($guard_name)->check())
                        <div class="header-inner-sub">
                            <a href="/">My Account</a>
                            <svg class="qodef-svg--menu-arrow qodef-menu-item-arrow" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="12" height="8" viewBox="0 0 12.09 8.5" enable-background="new 0 0 12.09 8.5" xml:space="preserve"><g><path d="M11.98,4.02c0.06,0.06,0.09,0.14,0.09,0.23c0,0.09-0.03,0.17-0.09,0.23l-3.9,3.9C8.05,8.41,8.02,8.44,7.97,8.45
                                C7.94,8.47,7.89,8.48,7.85,8.48S7.77,8.47,7.73,8.45C7.69,8.44,7.65,8.41,7.62,8.38c-0.06-0.06-0.1-0.14-0.1-0.23
                                s0.03-0.17,0.1-0.23l3.35-3.35H0.38c-0.09,0-0.17-0.03-0.23-0.09s-0.1-0.14-0.1-0.23c0-0.09,0.03-0.17,0.1-0.24
                                c0.06-0.06,0.14-0.09,0.23-0.09h10.59L7.62,0.58c-0.06-0.06-0.1-0.14-0.1-0.23s0.03-0.17,0.1-0.23c0.06-0.06,0.14-0.1,0.23-0.1
                                c0.09,0,0.16,0.03,0.23,0.1L11.98,4.02z"></path></g></svg>
                        </div>

                        <nav>
                            <ul class="nav-sub-mobile">
                               <li>
                                    <a href="/{{$guard_name}}/account" class="user-menu-link">
                                        <span>Tài khoản của tôi</span>
                                    </a>
                                </li>
                                @if (Auth::guard($guard_name)->user()->getRoleNames()->first() == 'driver')
                                    <li>
                                        <a href="/driver/identification-documents" class="user-menu-link">
                                            <span>Giấy tờ</span>
                                        </a>
                                    </li>
                                @endif
                                <li class="user-dropdown-item">
                                            <a href="/driver/vehicle" class="user-menu-link">
                                                <i class="fa-solid fa-motorcycle"></i>
                                                <span>Phương tiện</span>
                                            </a>
                                        </li>
                                        <li class="line"></li>
                               <li>
                                    <a href="/order" class="user-menu-link">
                                        <span>Đơn hàng của tôi</span>
                                    </a>
                               </li>
                               <li>
                                    <a href="/logout" class="user-menu-link">
                                        <span>Đăng xuất</span>
                                    </a>
                               </li>
                            </ul>
                        </nav>
                    @else
                        <div class="header-inner-sub">
                            <a href="/customer/register">Register</a>
                        </div>
                    @endif                   
                </li>
            </ul>
        </nav>
    </div>

</div>