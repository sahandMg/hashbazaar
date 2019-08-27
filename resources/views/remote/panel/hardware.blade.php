@extends('remote.layout')
@section('title')

@endsection

@section('content')
   <div class="au-card text-right" style="direction: rtl;">
       <h3 class="m-b-25 text-center">قسمت تهیه سخت افزار</h3>
       <p>اگر در فارم ماینینگ خود کامپیوتری دارید که می توانید 24 ساعته روشن بگذارید، نیازی به تهیه سخت افزار جدا ندارید، می توانید به راحتی نرم افزار را بر روی کامپیوتر خود نصب کنید.برای آموزش نصب نرم افزار به قسمت آموزش ها بروید.</p>
       <img src="{{URL::asset('remoteDashboard/images/orangepizero.png')}}">
       <p>پیشنهاد ما این است، برای کاهش مصرف برق و پایدار بودن سیستم مدیریت ماینیگ سخت افزار بالا را تهیه کنید.</p>
       <p>تمام نرم افزار های مورد نیاز بر روی این سخت افزار نصب شده است، فقط کافی است کابل شبکه و برق را متصل کنید.</p>
       <p>هزینه سخت افزار : 600 هزار تومان است.</p>
       <h4 class="text-center">برای ثبت سفارش فرم زیر را پر کنید.</h4>
       <form action="/action_page.php" class="was-validated" >
          <div class="form-group">
           <label>نام :</label>
           <input type="text" class="form-control">
          </div>
          <div class="form-group">
           <label>شماره تلفن :</label>
           <input type="text" class="form-control">
          </div>
          <div class="form-group">
           <label>آدرس :</label>
           <input type="text" class="form-control">
          </div>
          <div class="form-group">
           <label>کد پستی :</label>
           <input type="text" class="form-control">
          </div>
          <div class="text-center"> 
            <button class="btn btn-success">خرید</button>
          </div>
       </form>
   </div>
   <br/><br/><br/>
 @include('remote/scripts')
   <script type="text/javascript">
    
   </script>
@endsection