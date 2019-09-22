 <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="{{URL::asset('img/Logo_header.svg')}}" alt="HashBazaar" style="height: 50px;" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="{{route('dashboard',['locale'=>App::getLocale()])}}">
                                <i class="fas fa-tachometer-alt"></i>{{__("Dashboard")}}</a>
                        </li>
                        <li class="{{Request::route()->getName() == 'dashboard'?'active has-sub':null}}">
                            <a class="js-arrow" href="{{route('activity',['locale'=>App::getLocale()])}}">
                                <img src="{{URL::asset('img/Activity.svg')}}" style="height: 20px;">{{__("Activity")}}</a>
                        </li>
                        <li>
                            <a href="{{route('setting',['locale'=>App::getLocale()])}}">
                                <img src="{{URL::asset('img/Setting.svg')}}">{{__("Setting")}}</a>
                        </li>
                        <li class="{{Request::route()->getName() == 'contact'?'active has-sub':null}}">
                            <a href="{{route('contact',['locale'=>App::getLocale()])}}">
                                <img src="{{URL::asset('img/contact.svg')}}">{{__("Contact")}}</a>
                        </li>
<!--
                        <li class="{{Request::route()->getName() == 'tutorials'?'active has-sub':null}}">
                            <a href="{{route('tutorials',['locale'=>App::getLocale()])}}">
                                <i class="far fa-check-square"></i>آموزش ها</a>
                        </li> -->

                     <!--    <li class="{{Request::route()->getName() == 'tutorials'?'active has-sub':null}}">
                            <a href="{{route('TransactionsList',['locale'=>App::getLocale()])}}">
                                <i class="far fa-check-square"></i>{{__("Log Out")}}</a>
                        </li> -->

                        <li><a href="{{route('logout',['locale'=>App::getLocale()])}}"><i class="zmdi zmdi-power"></i>{{__("Log Out")}}</a></li>
                    </ul>
                </div>
            </nav>
        </header>