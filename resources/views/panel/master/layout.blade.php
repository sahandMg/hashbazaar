<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('title')
    @include('panel.master.stylesheet')
    <style>
        .activeLink a{
            color:white !important;
        }
    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
         @include('panel/master/mobileHeader')
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
         @include('panel/master/sidebarMenu')
        <!-- END MENU SIDEBAR-->
        <!-- PAGE CONTAINER-->
        <div class="page-container">
         <!-- HEADER DESKTOP-->
            @include('panel/master/desktopHeader')
          <!-- HEADER DESKTOP-->   
         <!-- MAIN CONTENT-->  
         <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid"> 
                      @include('panel.master.scripts') 
                       @yield('content')
                      
                     </div>
                </div>
        </div>   
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
       </div>

    </div>

  
    <script type="text/javascript">
        if(screen.width<920) {
           $('.header-desktop').hide();
        }
    </script>
 </body>

</html>
