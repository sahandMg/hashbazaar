

<header>

    <a href="http://hashbazaar.com">
        <div id="header-div"> <img class="Logo_header" src="img/Logo_header.svg" alt="Logo_header"> </div>    </a>

    <div class="useraccount">

        <img class="user-img" src="../img/user-circle-solid.svg" alt="">

        <div class="list">

            <ul>

                <a style="text-decoration: none;color: black" href="{{route('setting')}}"> <li class="user-account-list" id="usericon"> {{Auth::guard('user')->user()->name}}</li></a>
                <a style="text-decoration: none;color:black" href="{{route('logout')}}"> <li class="user-account-list" id="logouticon"> Log Out </li></a>

            </ul>
        </div>

    </div>
</header>
