<aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{route('index',['locale'=>App::getLocale()])}}">
                    <img src="{{URL::asset('img/Logo_header.svg')}}" alt="HashBazaar" style="height: 60px;" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="{{Request::route()->getName() == 'dashboard'?'active has-sub':null}}">
                            <a class="js-arrow" href="{{route('dashboard',['locale'=>session('locale')])}}">
                                <i class="fas fa-tachometer-alt"></i> {{__("Dashboard")}}</a>
                        </li>

                        <li class="{{Request::route()->getName() == 'activity'?'active has-sub':null}}">
                            <a class="js-arrow" href="{{route('activity',['locale'=>session('locale')])}}">
                                <img src="{{URL::asset('img/Activity.svg')}}">{{__("Activity")}}</a>
                        </li>
                        <li class="{{Request::route()->getName() == 'setting'?'active has-sub':null}}">
                            <a href="{{route('setting',['locale'=>session('locale')])}}">
                                <img src="{{URL::asset('img/Setting.svg')}}">{{__("Setting")}}</a>
                        </li>

                        <li class="{{Request::route()->getName() == 'contact'?'active has-sub':null}}">
                            <a href="{{route('contact',['locale'=>session('locale')])}}">
                                <img src="{{URL::asset('img/contact.svg')}}">{{__("Contact")}}</a>
                        </li>
<!-- 
                        <li class="{{Request::route()->getName() == 'tutorials'?'active has-sub':null}}">
                            <a href="{{route('tutorials',['locale'=>App::getLocale()])}}">
                                <i class="zmdi zmdi-book"></i>آموزش ها</a>
                        </li> -->
                        <li>
                            <a href="{{route('logout',['locale'=>session('locale')])}}">
                                <i class="zmdi zmdi-power"></i>{{__("Log Out")}}</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>