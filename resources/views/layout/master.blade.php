<!DOCTYPE html>
<html class="" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="limas">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="base_url" content="{{ url('/') }}">
  <title>@yield('title') | {{ config('app.name','Limas') }}</title>
  <!-- <link rel="apple-touch-icon" href="{{ asset('sample/assets/images/apple-touch-icon.png') }}"> -->
  <!-- <link rel="shortcut icon" href="{{ asset('sample/assets/images/favicon.ico') }}"> -->
  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('sample/global/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/global/css/bootstrap-extend.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/assets/css/site.css') }}">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  <!-- Plugins -->
  <link rel="stylesheet" href="{{ asset('sample/global/vendor/animsition/animsition.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/global/vendor/asscrollable/asScrollable.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/global/vendor/switchery/switchery.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/global/vendor/intro-js/introjs.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/global/vendor/slidepanel/slidePanel.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/global/vendor/jquery-mmenu/jquery-mmenu.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/global/vendor/flag-icon-css/flag-icon.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('sample/global/vendor/waves/waves.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('sample/global/vendor/jquery-mmenu/jquery-mmenu.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/assets/examples/css/forms/masks.css') }}">
  <!-- <link rel="stylesheet" href="https://www.google.com/fonts/specimen/Roboto+Mono"> -->
  <!-- Fonts -->
  <link rel="stylesheet" href="{{ asset('sample/global/fonts/material-design/material-design.min.css') }}">
  <link rel="stylesheet" href="{{ asset( 'sample/global/fonts/web-icons/web-icons.min.css' ) }}">
  <link rel="stylesheet" href="{{ asset('sample/global/fonts/brand-icons/brand-icons.min.css') }}">
  <link href="{{ asset('css/fontawesome/css/all.css') }}" rel="stylesheet">
  <!-- Color -->
  <link rel="stylesheet" href="{{ asset('sample/assets/examples/css/uikit/colors.css') }}">
  <!--Toastr Plugin-->
  <link href="{{ asset('plugins/toastr/toastr.min.css') }}" rel="stylesheet">
  <!-- Page level plugin CSS-->
  <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <!-- dropify -->
  <link href="{{ asset('js/dropify/css/dropify.css') }}" rel="stylesheet">
  <!-- dropzone -->
  <link href="{{ asset('js/dropzone/dropzone.css') }}" rel="stylesheet">
  <!-- select2 -->
  <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">
  <!-- <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'> -->
  <!-- Scripts -->
  <script src="{{ asset('sample/global/vendor/breakpoints/breakpoints.js') }}"></script>
  <script>csrf_token = '{{ csrf_token() }}';</script>
  <script>
  Breakpoints();
  </script>
</head>
<body class="animsition site-navbar-small ">
  @include('layout.header')
  @include('layout.sidebar')
  
  
  <!-- Page -->
  <div class="page">
    <div class="page-content container-fluid">
      @include('layout.message')
      @yield('content')
    </div>
  </div>
  <!-- End Page -->
  <!-- Footer -->
  <footer class="site-footer">
    @include('layout.footer')  
  </footer>

  <!-- Core  -->
  <script src="{{ asset('sample/global/vendor/babel-external-helpers/babel-external-helpers.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/jquery/jquery.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/tether/tether.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/bootstrap/bootstrap.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/animsition/animsition.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/mousewheel/jquery.mousewheel.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/asscrollbar/jquery-asScrollbar.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/asscrollable/jquery-asScrollable.js') }}"></script>
  <!-- <script src="{{ asset('sample/global/vendor/waves/waves.js') }}"></script> -->
  <!-- Plugins -->
  <script src="{{ asset('sample/global/vendor/jquery-mmenu/jquery.mmenu.min.all.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/switchery/switchery.min.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/intro-js/intro.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/screenfull/screenfull.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/slidepanel/jquery-slidePanel.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/formatter/jquery.formatter.js') }}"></script>
  <!-- Scripts -->
  <script src="{{ asset('sample/global/js/State.js') }}"></script>
  <script src="{{ asset('sample/global/js/Component.js') }}"></script>
  <script src="{{ asset('sample/global/js/Plugin.js') }}"></script>
  <script src="{{ asset('sample/global/js/Base.js') }}"></script>
  <script src="{{ asset('sample/global/js/Config.js') }}"></script>
  <script src="{{ asset('sample/assets/js/Section/Menubar.js') }}"></script>
  <script src="{{ asset('sample/assets/js/Section/Sidebar.js') }}"></script>
  <script src="{{ asset('sample/assets/js/Section/PageAside.js') }}"></script>
  <script src="{{ asset('sample/assets/js/Section/GridMenu.js') }}"></script>
  <!-- Config -->
  <script src="{{ asset('sample/global/js/config/colors.js') }}"></script>
  <script src="{{ asset('sample/assets/js/config/tour.js') }}"></script>
  <script>
  // Config.set('assets', '../../assets');
  </script>
  <!-- Page -->
  <script src="{{ asset('sample/assets/js/Site.js') }}"></script>
  <script src="{{ asset('sample/global/js/Plugin/asscrollable.js') }}"></script>
  <script src="{{ asset('sample/global/js/Plugin/slidepanel.js') }}"></script>
  <script src="{{ asset('sample/global/js/Plugin/switchery.js') }}"></script>
  <script src="{{ asset('sample/global/js/Plugin/formatter.js') }}"></script>
  <script src="{{ asset('sample/global/js/Plugin/responsive-tabs.js') }}"></script>
  <script src="{{ asset('sample/global/js/Plugin/closeable-tabs.js') }}"></script>
  <script src="{{ asset('sample/global/js/Plugin/tabs.js') }}"></script>

  <!-- Datatables -->
  <script src="{{asset('plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{asset('plugins/datatables/dataTables.bootstrap4.js') }}"></script>
  <script src="{{asset('plugins/datatables-buttons/dataTables.buttons.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/buttons.flash.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/buttons.print.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/buttons.html5.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/buttons.bootstrap4.js')}}"></script>

  <!--Toastr Plugin-->
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
  
  <!-- dropify -->
  <script src="{{ asset('js/dropify/js/dropify.js') }}"></script>

  <!-- dropzone -->
  <script src="{{ asset('js/dropzone/dropzone.js') }}"></script>
  
  <!-- select2 -->
  <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>

  <!-- custom -->
  <script src="{{ asset('js/custom.js') }}"></script>
  @yield('scripts')
  <script>
  (function(document, window, $) {
    'use strict';
    var Site = window.Site;
    $(document).ready(function() {
      Site.run();
    });
  })(document, window, jQuery);
  </script>
</body>
</html>