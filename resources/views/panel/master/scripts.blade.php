@if(Config::get('app.locale') == 'fa')
  <!-- Jquery JS-->
    <script src="{{URL::asset('miningDashboard/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{URL::asset('miningDashboard/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{URL::asset('miningDashboard/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{URL::asset('miningDashboard/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{URL::asset('miningDashboard/vendor/wow/wow.min.js')}}"></script>
    <script src="{{URL::asset('miningDashboard/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{URL::asset('miningDashboard/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{URL::asset('miningDashboard/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{URL::asset('miningDashboard/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{URL::asset('miningDashboard/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{URL::asset('miningDashboard/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{URL::asset('miningDashboard/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{URL::asset('miningDashboard/vendor/select2/select2.min.js')}}">
    </script>
    <script src="{{URL::asset('js/chartist.min.js')}}"></script> 
    <!-- Main JS-->
    <script src="{{URL::asset('miningDashboard/js/main.js')}}"></script>

    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="792f282f-edde-46b8-8b02-d38ca5cb92c2";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
    <script>
      (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1240497,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
      })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
   </script>
@else

<script src="{{URL::asset('js/jquery-3.3.1.js')}}"></script>
    <script src="{{URL::asset('js/chartist.min.js')}}"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="{{URL::asset('js/utils.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{URL::asset('js/alertify.min.js')}}"></script>
    <script>
      (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1240497,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
      })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>

@endif