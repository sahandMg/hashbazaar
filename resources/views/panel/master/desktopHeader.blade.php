<header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="{{URL::asset('img/avatar.png')}}" alt="user" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="{{route('dashboard',['locale'=>App::getLocale()])}}">{{Auth::guard('user')->user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="{{URL::asset('img/avatar.png')}}" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="{{route('dashboard',['locale'=>App::getLocale()])}}">{{Auth::guard('user')->user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::guard('user')->user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('dashboard',['locale'=>App::getLocale()])}}">
                                                        <i class="zmdi zmdi-account"></i>حساب کاربری</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('activity',['locale'=>App::getLocale()])}}">
                                                        <i class="zmdi zmdi-money-box"></i>پرداخت ها</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="{{route('logout',['locale'=>App::getLocale()])}}">
                                                    <i class="zmdi zmdi-power"></i>خروج</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>