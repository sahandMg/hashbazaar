<header class="navbar-header">
    <div class="d-flex justify-content-between header-top">
        <div class="pl-4 mt-3" style="text-align: left;">
            <span class="mt-4" style="color: black;"><strong>021-22410477</strong></span>
        </div>
        <div class="d-flex justify-content-between pr-md-4 py-2 authButtons">
          @if(Auth::guard('user')->check())
            <a class="btn-auth" href="{{route('remoteDashboard',['locale'=>session('locale')])}}" >{{__('Dashboard')}}</a>
          @else
            <a href="{{route('signup',['locale'=> App::getLocale()])}}" class="btn-auth">ثبت نام</a>
            <a href="{{route('login',['locale'=> App::getLocale()])}}" class="btn-auth">ورود</a>
          @endif
        </div>
    </div>
    <div class="d-flex justify-content-between header-bottom">
      <a class="pl-4 py-2" href="http://hashbazaar.com">
         <img class="hashbazaar-logo" src="{{asset('img/Logo_header.svg')}}" alt="Logo">
      </a>
      <button class="navbar-toggler" id="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
       </button>
      <div class="navBar-List-container pr-4">
        <ul class="d-flex justify-content-center" id="navBarList">
            <li class="{{Request::route()->getName() == 'customerService'?'navbar-item navbar-active':'navbar-item'}}">
                <a href="{{route('customerService',['locale'=>session('locale')])}}">{{__('FAQ')}}</a>
            </li>
            <li class="{{Request::route()->getName() == 'aboutUs'?'navbar-item navbar-active':'navbar-item'}}">
                <a  href="{{route('aboutUs',['locale'=>session('locale')])}}">{{__('About')}}</a>
            </li>
            <li class="{{Request::route()->getName() == 'Blog'||Request::route()->getName() == 'showPost'?'navbar-item navbar-active':'navbar-item'}}">
                <a href="{{route('Blog',['locale'=>session('locale')])}}">{{__('Blog')}}</a>
            </li>
            <li class="navbar-item">
                <a href="{{url('/cooperation')}}">همکاری سازمانی</a>
            </li>
           <!--  <li class="navbar-item">
                <a href="https://farmyarapp.ir/landing/">فارم یار</a>
            </li> -->
            <li class="{{Request::route()->getName() == 'index'?'navbar-item navbar-active':'navbar-item'}}">
                <a href="{{route('index',['locale'=>session('locale')])}}">{{__('Home')}}<span class="sr-only">(current)</span></a>
            </li>
        </ul>
       </div> 
    </div>
    <div class="mobile-navBar-container" style="display: none;">
        <ul class="d-flex flex-column justify-content-center" id="navBarList">
            <li class="{{Request::route()->getName() == 'index'?'navbar-item navbar-active':'navbar-item'}}">
                <a href="{{route('index',['locale'=>session('locale')])}}">{{__('Home')}}<span class="sr-only">(current)</span></a>
            </li>
            <li class="{{Request::route()->getName() == 'customerService'?'navbar-item navbar-active':'navbar-item'}}">
                <a href="{{route('customerService',['locale'=>session('locale')])}}">{{__('FAQ')}}</a>
            </li>
            <li class="{{Request::route()->getName() == 'aboutUs'?'navbar-item navbar-active':'navbar-item'}}">
                <a  href="{{route('aboutUs',['locale'=>session('locale')])}}">{{__('About')}}</a>
            </li>
            <li class="{{Request::route()->getName() == 'Blog'||Request::route()->getName() == 'showPost'?'navbar-item navbar-active':'navbar-item'}}">
                <a href="{{route('Blog',['locale'=>session('locale')])}}">{{__('Blog')}}</a>
            </li>
            <li class="navbar-item">
                <a href="{{url('/cooperation')}}">همکاری سازمانی</a>
            </li>
          <!--   <li class="navbar-item">
                <a href="https://farmyarapp.ir/landing/">فارم یار</a>
            </li> -->
        </ul>
    </div>
</header>
<style type="text/css">
    .navbar-header {background-color: black;}
    .hashbazaar-logo {
        height: 40px;
    }
    .header-top {
        background-color: #8B8B8B;
        background-color: white;
        /*color: white;*/
    }
    /*.header-bottom {
        background-color: #8B8B8B;
    }*/
    .header-bottom ul{
        margin-bottom: 0px;
    }
    .navbar-item {
        color: black;
        
        margin-left: 5px;
    }
    .navbar-item a{
        color: white;
        display: block;
        padding: 16px 16px;
        height: 100%; /* Missing from other answers */
    }
    .navbar-item:hover {
        background-color: #ff9100;
        color: white;
    }
    .navbar-active {
       background-color: #ff9100;   
       color: white;
    }
    .btn-auth {
        height: 40px;
        background-color: #e8ad2c;
        cursor: pointer;
        border-radius: 20px;
        color: white;
        padding: 8px 32px;
        margin-left: 4px;
    }

    .btn-auth:hover {
        background-color: #815903;
        color: white;
    }
    .navbar-toggler{display: none;}
    @media screen and (max-width:769px){
        .navBar-List-container {display: none;}
        .navbar-toggler{display: inline-block;}
        .navbar-item {
          text-align: center;
          padding: 16px 16px;
           margin-left: 0;
        }
    }
    @media screen and (max-width:420px){
        .authButtons {
           padding-right: 0.5rem;
        }
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
             var isOpen = false;
             $('#navbar-toggler').click(function(){
                console.log("navigation test");
                if(isOpen) {
                  $('.mobile-navBar-container').hide();
                    isOpen = false;
                } else {
                  $('.mobile-navBar-container').show();
                    isOpen = true;
                }
            });
    });
</script>
<!-- 
<header class="navbar-header">
    <div class="d-flex justify-content-between header-top">
        <a class="pl-4 py-2" href="http://hashbazaar.com">
            <img class="hashbazaar-logo" src="{{asset('img/Logo_footer.png')}}" alt="Logo">
        </a>
        <div class="d-flex justify-content-between pr-4 py-2">
          @if(Auth::guard('user')->check())
            <a class="btn-auth" href="{{route('remoteDashboard',['locale'=>session('locale')])}}" >{{__('Dashboard')}}</a>
          @else
            <a href="{{route('signup',['locale'=>session('locale')]).'?plan=classic'}}" class="btn-auth">تبت نام</a>
            <a href="{{route('login',['locale'=>session('locale')]).'?plan=classic'}}" class="btn-auth">ورود</a>
          @endif
        </div>
    </div>
    <div class="header-bottom">
        <ul class="d-flex justify-content-center">
            <li class="{{Request::route()->getName() == 'customerService'?'navbar-item navbar-active':'navbar-item'}}">
                <a href="{{route('customerService',['locale'=>session('locale')])}}">{{__('FAQ')}}</a>
            </li>
            <li class="{{Request::route()->getName() == 'aboutUs'?'navbar-item navbar-active':'navbar-item'}}">
                <a  href="{{route('aboutUs',['locale'=>session('locale')])}}">{{__('About')}}</a>
            </li>
            <li class="{{Request::route()->getName() == 'Blog'||Request::route()->getName() == 'showPost'?'navbar-item navbar-active':'navbar-item'}}">
                <a href="{{route('Blog',['locale'=>session('locale')])}}">{{__('Blog')}}</a>
            </li>
            <li class="navbar-item">
                <a href="{{url('/cooperation')}}">همکاری سازمانی</a>
            </li>
            <li class="navbar-item">
                <a href="{{url('/farmyar')}}">فارم یار</a>
            </li>
            <li class="{{Request::route()->getName() == 'index'?'navbar-item navbar-active':'navbar-item'}}">
                <a href="{{route('index',['locale'=>session('locale')])}}">{{__('Home')}}<span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</header>
<style type="text/css">
    .navbar-header {background-color: black;}
    .hashbazaar-logo {
        height: 40px;
    }
    .header-top {
        background-color: #8B8B8B;
        background-color: white;
    }

    .header-bottom ul{
        margin-bottom: 0px;
    }
    .navbar-item {
        color: black;
        padding: 8px 16px;
        margin: 0 5px;
    }
    .navbar-item a{
        color: white;
    }
    .navbar-item:hover {
        background-color: #ff9100;
        color: white;
    }
    .navbar-active {
       background-color: #ff9100;   
       color: white;
    }
    .btn-auth {
        height: 40px;
        background-color: #e8ad2c;
        cursor: pointer;
        border-radius: 20px;
        color: white;
        padding: 8px 32px;
        margin-right: 4px;
    }

    .btn-auth:hover {
        background-color: #815903;
        color: white;
    }
</style>
 -->

<!-- <header id="header" class="">
    <div class="header-navbar">
     <nav class="navbar navbar-expand-lg w-100 p-md-0">
        <a class="navbar-brand p-md-2" href="http://hashbazaar.com">
            <img class="navbar-small-logo" src="{{asset('img/Logo_header.svg')}}" alt="Logo">
        </a>
        <button class="navbar-toggler p-md-2 " type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse w-100" id="navbarNav">
            <ul class="navbar-nav text-center justify-content-between">
                @if(Config::get('app.locale') == 'fa')

                    <li class="{{Request::route()->getName() == 'customerService'?'nav-item active navHover':'nav-item navHover'}}">
                        <a class="nav-link" href="{{route('customerService',['locale'=>session('locale')])}}">{{__('FAQ')}}</a>
                    </li>
                    <li class="{{Request::route()->getName() == 'aboutUs'?'nav-item active navHover':'nav-item navHover'}}">
                        <a class="nav-link" href="{{route('aboutUs',['locale'=>session('locale')])}}">{{__('About')}}</a>
                    </li>
                    <li class="{{Request::route()->getName() == 'Blog'||Request::route()->getName() == 'showPost'?'nav-item active navHover':'nav-item navHover'}}">
                        <a class="nav-link" href="{{route('Blog',['locale'=>session('locale')])}}">{{__('Blog')}}</a>
                    </li>

                    <li class="nav-item navHover">
                        <a class="nav-link" href="{{url('/cooperation')}}">همکاری سازمانی</a>
                    </li>
                    <li class="nav-item navHover">
                        <a class="nav-link" href="{{url('/farmyar')}}">فارم یار</a>
                    </li>
                    <li class="{{Request::route()->getName() == 'index'?'nav-item active navHover':'nav-item navHover'}}">
                        <a class="nav-link" href="{{route('index',['locale'=>session('locale')])}}">{{__('Home')}}<span class="sr-only">(current)</span></a>
                    </li>

                @else
                    <li class="{{Request::route()->getName() == 'index'?'nav-item active navHover':'nav-item navHover'}}">
                        <a class="nav-link" href="{{route('index',['locale'=>session('locale')])}}">{{__('Home')}}<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="{{Request::route()->getName() == 'aboutUs'?'nav-item active navHover':'nav-item navHover'}}">
                        <a class="nav-link" href="{{route('aboutUs',['locale'=>session('locale')])}}">{{__('About')}}</a>
                    </li>
                    <li class="{{Request::route()->getName() == 'customerService'?'nav-item active navHover':'nav-item navHover'}}">
                        <a class="nav-link" href="{{route('customerService',['locale'=>session('locale')])}}">{{__('FAQ')}}</a>
                    </li>
                    <li class="{{Request::route()->getName() == 'affiliate'?'nav-item active navHover':'nav-item navHover'}}">
                        <a class="nav-link" href="{{route('affiliate',['locale'=>session('locale')])}}">{{__('Affiliate')}}</a>
                    </li>
                    <li class="{{Request::route()->getName() == 'Blog'?'nav-item active navHover':'nav-item navHover'}}">
                        <a class="nav-link" href="{{route('Blog',['locale'=>session('locale')])}}">{{__('Blog')}}</a>
                    </li>

                @endif
                @if(Auth::guard('user')->check())
                        <li class="nav-item navHover">
                            <a class="nav-link" href="{{route('dashboard',['locale'=>session('locale')])}}" >{{__('Dashboard')}}</a>
                        </li>
                @elseif(Auth::guard('remote')->check())
                        <li class="nav-item navHover">
                            <a class="nav-link" href="{{route('remoteDashboard',['locale'=>session('locale')])}}" >{{__('Dashboard')}}</a>
                        </li>

                    @elseif(Auth::guard('admin')->check())
                            <li class="nav-item navHover">
                                <a class="nav-link" href="{{route('adminHome',['locale'=>session('locale')])}}" >{{__('Dashboard')}}</a>
                            </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('signup',['locale'=>session('locale')]).'?plan=classic'}}" id="sg" >{{__('Sign Up')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login',['locale'=>session('locale')])}}" id="lg" >{{__('Log In')}}</a>
                        </li>
                @endif

                    <!-- <li class="nav-item flags">
                        <a class="nav-link" href="{{route('locale',['locale'=>'fa'])}}" id="persianFA"><img src="{{URL::asset('flags/ir.svg')}}" alt="Persian (FA)"></a>
                        <a class="nav-link" href="{{route('locale',['locale'=>'en'])}}" id="engUK"><img src="{{URL::asset('flags/uk.svg')}}" alt="English (UK)"></a>

                    </li> -->
      <!--               {{--<li class="nav-item flags">--}}
                    {{--</li>--}}
            </ul>


        </div>

        {{--<div class="navigation-menu">--}}
            {{--<div class="bar1"></div>--}}
            {{--<div class="bar2"></div>--}}
            {{--<div class="bar3"></div>--}}

        {{--</div>--}}
    </nav>
</div>
</header> --> 