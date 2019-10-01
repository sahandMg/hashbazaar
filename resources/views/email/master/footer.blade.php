<footer style="color: white;">
    @if(\Illuminate\Support\Facades\Config::get('app.locale') == 'fa')
        <a  style="color: white;" href="https://www.instagram.com/hashbazaar/" target="_blank">اینستاگرام</a>
        <a  style="color: white;" href="{{route('customerService',['locale'=>session('locale')])}}" target="_blank">سوالات متداول</a>
        <a  style="color: white;" href="{{url('/blog')}}" target="_blank">مجله</a>
        <a  style="color: white;" href="{{route('dashboard',['locale'=>session('locale')])}}" target="_blank">میزکار</a>
        <a  style="color: white;" href="{{route('index',['locale'=>session('locale')])}}" target="_blank">وب سایت</a>
    @else
        <a  style="color: white;" href="{{route('index',['locale'=>session('locale')])}}" target="_blank"> Website</a>
        <a  style="color: white;" href="{{route('dashboard',['locale'=>session('locale')])}}" target="_blank">Dashboard</a>
        <a  style="color: white;" href="{{route('customerService',['locale'=>session('locale')])}}" target="_blank">FAQ</a>
        <a  style="color: white;" href="{{url('/blog')}}" target="_blank">Blog</a>
        <a  style="color: white;" href="https://www.instagram.com/hashbazaar/" target="_blank">Instagram</a>
    @endif
</footer>

