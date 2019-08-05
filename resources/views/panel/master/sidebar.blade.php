

<!-- Container -->
<div class="mainContainer">


    <nav class="container1">
        <ul class="mainList">
            <li class="navbar"> <a href="{{route('index',['locale'=>session('locale')])}}"><img class="Logo_In_NavBar" src="{{URL::asset('img/Logo_In_NavBar.svg')}}" alt="Logo_In_NavBar"></a>
                <a href="" id="welcome">Welcome User</a> </li>
            <li class="sub dashboard"> <a href="{{route('dashboard',['locale'=>session('locale')])}}" id="dashboard">Dashboard</a></li>
            <li class="sub"> <a href="{{route('activity',['locale'=>session('locale')])}}" id="activity">Activity</a></li>
            <li class="sub"> <a href="{{route('referral',['locale'=>session('locale')])}}" id="referral">Referral</a> </li>
            <li class="sub"> <a href="{{route('setting',['locale'=>session('locale')])}}" id="setting">Setting</a></li>
            <li class="sub"> <a href="{{route('contact',['locale'=>session('locale')])}}" id="contact1">Contact</a></li>
            <li class="sub"><a href="{{route('logout',['locale'=>session('locale')])}}">Log Out</a></li>

        </ul>



    </nav>




</div>