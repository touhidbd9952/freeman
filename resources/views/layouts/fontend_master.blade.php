<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>
    <!-- Site Title-->
    <title>Free Man Service</title>
    <meta name="format-detection" content="telephone=no">
    {{-- <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"> --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">

    <meta name="description" content="A Site for Equipment Dealers! The Newest and Fastest Search Site! 24/7/365 Net Auction Service">
    <meta name="Keywords" content="WOODY,ウッディ,検索,オークション,盗難車,リクルート,求人,ノリ,トラック,海外,スケジュール,ニュース,建設機械,建機,中古,中古建設機械,WOODY,SEARCH,WOODY AUCTION,TRUCK,SCHEDULE,NEWS,WOODY NETWORK,HEAVY EQUIPMENT,EXCAVATOR,WHEEL LOADER,TRACTOR,LOADER, CRANE,ROLLER,MISCELLANEOUS,CATERPILLAR,KOMATSU,HITACHI"> 
    
    <!--Cache clear-->
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="cache-control" content="no-store" />
    <meta http-equiv="cache-control" content="must-revalidate" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <!---->

    <link rel="icon" href="https://woodyengineering.com/quran//fontend/images/woodyfavicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto+Mono:300,400,500,700">
    <link rel="stylesheet" href="{{ asset('fontend') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('fontend') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('fontend') }}/css/toastr.css">

    <script>
      var base_url = '';  //https://woodyengineering.com/freeman
    </script>

		<!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="{{ asset('fontend') }}/images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="{{ asset('fontend') }}/js/html5shiv.min.js"></script>
		<![endif]-->
    <style>
      body {color: #373636 !important;}
      * {margin: 0;padding: 0;font-family: Arial, "メイリオ", Meiryo, sans-serif;font-style: normal;list-style: none;vertical-align: top;font-size: 13px;}
      .btn-primary {color: #fff;background-color: #f5a63f;border-color: #f5a63f;}
      .btn-primary:hover {color: #fff;background-color: #424242;border-color: #424242;}
      #product_details td{text-align: left;text-align: left;padding-left:10px;}
      #product_details th {
    padding: 5px 10px;
    border-bottom: 1px solid #FFFFFF;
    width: 150px;
    color: #3F3F3F;
    background: #F3F3F3;
}
.section__header-element{display: none;}
.table .table {color: #1a1818;}

#main_contents {margin-left: 240px;min-width: 700px;}

#side_menus {float: left;width: 220px;padding-bottom: 24px;padding: 15px 0px;}
#side_menus ul{list-style-type: circle;}
#side_menus ul li{background: #f4f4f4;margin-bottom: 3px;}
#side_menus ul li a{padding: 2px 15px;width: 220px;display:inline-block;font-size:13px;}
.menutitle{padding-left: 15px;background: #ccc;width: 100%;display: block;color:#fff;font-weight:bold;font-size:16px;}
.menutitle:hover, .menutitle:focus {
    color: #fff !important;
    text-decoration: none;
    outline: none;
}
footer a,footer p{color: #fff !important;}

/* top menu */
.rd-navbar-fixed .rd-navbar-nav-wrap {
  transform: translateX(0) !important;
  position: relative !important;
  z-index: 100;
  top: 0px;
  left: 0;
  width: 100% !important;
  padding: 5px 0px !important;
  bottom: 0px;
 margin-top: -45px;

}
.rd-navbar-fixed .rd-navbar-brand{left: 5px !important; top:10px;}
.rd-navbar-fixed .rd-navbar-toggle {
  display: none !important;
}
.rd-navbar-panel{max-width: 150px !important;}
.rd-navbar-fixed .rd-navbar-nav li {text-align: left;float: left;}
.rd-navbar-fixed .rd-navbar-nav {display: block;margin: 0px 0 0 250px;height: auto;text-align: left;}
.rd-navbar-fullwidth .rd-navbar-nav {display: inline-block;}
.brand{padding-right: 100px}

@media (min-width:992px)
{
  /* .section-md {padding: 50px 0;} */
}

@media (max-width:767px)
{
  .container{margin: 0px !important;}
  
  #main_contents {margin-left: 225px !important;width: 95% !important;}
  #side_menus {float: left;width: 220px;padding-bottom: 24px;border: 1px solid #ccc;padding: 15px 0;}
}

.lan ul #jp {background: url(../fontend/images/lang_ja.png) no-repeat center;}
.lan ul #en {background: url(../fontend/images/lang_en.png) no-repeat center;}
.lan ul li a {
  height: 30px;
  width: 100px;
  display: block;
}
.lan ul li {
  text-indent: -9999px;
  list-style-type: none;
  display: inline-block;
}

    </style>
  </head>
  <body>
    <!-- Page Loader-->
    <div id="page-loader">
      <div class="page-loader-logo">
        <div class="brand">
          <div class="brand__name"><img src="{{ asset('fontend') }}/images/woody-logo.png" alt="" width="123" height="47"/>
          </div>
        </div>
      </div>
      <div class="page-loader-body">
        <div id="loadingProgressG">
          <div class="loadingProgressG" id="loadingProgressG_1"></div>
        </div>
      </div>
    </div>
    <!-- Page-->
    <div class="page">
      



  

  @yield('content')





 
  <!--======== Page Footer ==========-->
  <footer class="footer-corporate" style="background-color: #f5a63f;">
    <div class="footer-corporate__aside bg-gray-8 text-center" style="background-color: #f5a63f;">
      <div class="shell shell-fluid shell-condensed">
        <div class="range range-20 range_xl-ten footer-corporate__range">
          <div class="cell-sm-8 cell-xl-6 footer-corporate__aside-column text-sm-left">
            <!-- Rights-->
            <p class="rights">
              <span>Copyright © Woody Co. Ltd.</span>
              <span>&nbsp;&copy;&nbsp;</span>
              <span>2023</span>, All rights  Reserved.&nbsp;
              <br class="veil-xs">
            </p>
          </div>
          <div class="cell-sm-4 cell-xl-4 footer-corporate__aside-column text-sm-right"> 
            <div  class="icon-list-social mb-5">

              <a href="javascript:" target="_blank" rel="noopener" title="Twitter" class="icon-list-social-link">
              <fa-icon  class="ng-fa-icon"><svg style="max-width: 20px;" role="img" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter" class="svg-inline--fa fa-twitter fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
                </svg></fa-icon>
              </a>

              <a href="javascript:" target="_blank" rel="noopener" title="GitHub" class="icon-list-social-link">
              <fa-icon  class="ng-fa-icon"><svg style="max-width: 20px;" role="img" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="github" class="svg-inline--fa fa-github fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                <path fill="currentColor" d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"></path>
                </svg></fa-icon>
              </a>

              <a href="javascript:" target="_blank" rel="noopener" title="Facebook" class="icon-list-social-link">
              <fa-icon  class="ng-fa-icon"><svg style="max-width: 20px;" role="img" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook" class="svg-inline--fa fa-facebook fa-w-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor" d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path>
                </svg></fa-icon>
              </a>

            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</div>

<!-- Modal start -->
<style>
  .forget {
            max-width: 400px;
            min-height: 250px;
            margin: 0 auto;
        }
        
        input#email {
            min-height: 30px;
            line-height: 30px;
            width: 250px;
            float: left;
            border: 1px solid #f5a63f;
            padding-left: 5px;
            color: #000;
        }
        .ml{margin-left: 10px}
        .modal-body p{color:#000;}
</style>

<div class="modal fade" id="forgetPasswordForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Inquiry of Password

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="font-size: 24px;">&times;</span>
          </button>
        </h5>
        
      </div>
      <div class="modal-body">

        <p>If you forget your password, put your e-mail address in the box below and click "Send" button. We will send you password change link by e-mail after confirming your information. Check your e-mail account after a while. </p>

        <form action="" method="POST" style="min-height: 50px;" class="from-prevent-multiple-submits">
          @csrf
            <input type="email" name="email" id="email" value="" autocomplete="off">
            <button type="submit" class="btn btn-primary ml from-prevent-multiple-submits">Send</button>
            
          </form>
      </div>
      <div class="modal-footer">
        
      </div>

    </div>
  </div>
</div>
<!-- Modal end -->




<!-- Global Mailform Output-->
<div class="snackbars" id="form-output-global"></div>


<!-- Javascript-->
<script src="{{ asset('fontend') }}/js/core.min.js"></script>
<script src="{{ asset('fontend') }}/js/script.js"></script>

<script type="text/javascript" src="{{ asset('fontend') }}/js/toastr.min.js"></script>
<script>
  @if(Session::has('message'))
    var type ="{{Session::get('alert-type','info')}}"
    switch(type){
        case 'info':
            toastr.info(" {{Session::get('message')}} ");
            break;
        case 'success':
            toastr.success(" {{Session::get('message')}} ");
            break;
        case 'warning':
            toastr.warning(" {{Session::get('message')}} ");
            break;
        case 'error':
            toastr.error(" {{Session::get('message')}} ");
            break;
    }
@endif
</script>


<script>
  function change_language(lan)
  { 
    let baseurl = '{{route('/')}}';
    $.ajax({
          type:'GET',
          url: baseurl+'/change_language/'+lan,
          dataType:'json',
          success:function(response){ 
            location.reload();
          }
      })
  }
</script>





<style>
.form-input {
    color: #1c1b1b;
}
</style>  

{{-- Design Changer --}}


<!-- google translate api start ---->
<div id="google_translate_element"><b style="color: #fff;font-size: 10px;">Language:</b></div>
 
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement(
                {pageLanguage: 'en'},
                'google_translate_element'
            );
        }
    </script>
 
<script type="text/javascript"src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<style>
  .goog-te-banner, .goog-te-banner-frame{display: none !important;}
  body{top:0 !important}
  #google_translate_element{position: absolute;top: 5px;right: 70px;}
  .goog-te-gadget{color: #f5a63f;border: none;margin-top: -10px;}
  #google_translate_element span{display: none;}
  #google_translate_element select{width: 100px;border: none;background:#ec9b01;color: #fff; height: 20px;}
  .lan{display: none;}
  h1 font{font-size: 36px !important;font-family: 'Roboto';}
</style>
<!-- google translate api end---->

</body>
</html>