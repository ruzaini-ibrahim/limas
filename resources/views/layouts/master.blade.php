<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>@yield('title') | {{ config('app.name', 'Expense Tracker') }} </title>
  <link rel="apple-touch-icon" href="{{ asset( 'sample/assets/images/apple-touch-icon.png') }}">
  <link rel="shortcut icon" href="{{ asset( 'sample/assets/images/favicon.ico') }}">


  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset( 'sample/global/css/bootstrap.min.css' ) }}">
  <link rel="stylesheet" href="{{ asset( 'sample/global/css/bootstrap-extend.min.css' ) }}">
  <link rel="stylesheet" href="{{ asset( 'sample/assets/css/site.min.css' ) }}">


  <!-- Plugins -->
  <link rel="stylesheet" href="{{ asset( 'sample/global/vendor/animsition/animsition.css' ) }}">
  <link rel="stylesheet" href="{{ asset( 'sample/global/vendor/asscrollable/asScrollable.css' ) }}">
  <link rel="stylesheet" href="{{ asset( 'sample/global/vendor/switchery/switchery.css' ) }}">
  <link rel="stylesheet" href="{{ asset( 'sample/global/vendor/intro-js/introjs.css' ) }}">
  <link rel="stylesheet" href="{{ asset( 'sample/global/vendor/slidepanel/slidePanel.css' ) }}">
  <link rel="stylesheet" href="{{ asset( 'sample/global/vendor/jquery-mmenu/jquery-mmenu.css' ) }}">
  <link rel="stylesheet" href="{{ asset( 'sample/global/vendor/flag-icon-css/flag-icon.css' ) }}">
  <link rel="stylesheet" href="{{ asset( 'sample/global/vendor/jquery-mmenu/jquery-mmenu.css' ) }}">
  <!-- <link rel="stylesheet" href="{{ asset( 'sample/global/vendor/chartist/chartist.css' ) }}"> -->
  <link rel="stylesheet" href="{{ asset( 'sample/global/vendor/jvectormap/jquery-jvectormap.css' ) }}">
  <!-- <link rel="stylesheet" href="{{ asset( 'sample/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css' ) }}"> -->
  <link rel="stylesheet" href="{{ asset( 'sample/assets/examples/css/dashboard/v1.css' ) }}">

  <!-- <link rel="stylesheet" href="{{ asset('globalv3/vendor/bootstrap-datepicker/bootstrap-datepicker.css') }}"> -->
  
  <!-- DATATABLE -->
<!--   <link rel="stylesheet" href="{{ asset('globalv3/vendor/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet"
        href="{{ asset('globalv3/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css') }}">
  <link rel="stylesheet"
        href="{{ asset('globalv3/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css') }}">
  <link rel="stylesheet"
        href="{{ asset('globalv3/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css') }}">
  <link rel="stylesheet"
        href="{{ asset('globalv3/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css') }}">
  <link rel="stylesheet"
        href="{{ asset('globalv3/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css') }}">
  <link rel="stylesheet"
        href="{{ asset('globalv3/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css') }}">
  <link rel="stylesheet"
        href="{{ asset('globalv3/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css') }}"> -->

  <!-- <link rel="stylesheet" href="{{asset('globalv3/vendor/bootstrap-sweetalert/sweetalert.css')}}">
  <link rel="stylesheet" href="{{asset('globalv3/vendor/ladda/ladda.css')}}">
  <link rel="stylesheet" href="{{asset('globalv3/vendor/toastr/toastr.css')}}"> -->
  <link rel="stylesheet" href="{{asset('assetsv3/examples/css/advanced/toastr.css')}}">

  <!-- <link rel="stylesheet" href="{{asset('globalv3/vendor/formvalidation/formValidation.css')}}"> -->
  <link rel="stylesheet" href="{{asset('assetsv3/examples/css/forms/validation.css')}}">

  <!-- Fonts -->
  <!-- <link rel="stylesheet" href="{{ asset('globalv3/fonts/material-design/material-design.min.css')}}"> -->
  <link rel="stylesheet" href="{{ asset( 'sample/global/fonts/weather-icons/weather-icons.css' ) }}">
  <link rel="stylesheet" href="{{ asset( 'sample/global/fonts/web-icons/web-icons.min.css' ) }}">
  <link rel="stylesheet" href="{{ asset( 'sample/global/fonts/brand-icons/brand-icons.min.css' ) }}">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

  @stack('style')

  <!-- Scripts -->
  <script src="{{ asset( 'sample/global/vendor/breakpoints/breakpoints.js' ) }}"></script>
  <script>
  Breakpoints();
  </script>
</head>

<body class="animsition site-navbar-small dashboard">
  
  @include('layout.header')
  @include('layout.sidebar')

  <div class="page">
    @if(session('info'))
        <div class="alert dark alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {{ session('info') }}
        </div>
    @endif
    @if(session('message'))
        <div class="alert dark alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {{ session('message') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert dark alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {{ session('success') }}
        </div>
    @endif
    @if(session('danger'))
        <div class="alert dark alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {{ session('danger') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert dark alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {{ session('error') }}
        </div>
    @endif
    @if(session('warning'))
        <div class="alert dark alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {{ session('warning') }}
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
      @yield('content')    
  </div>
  
  <!-- End Page -->
  <!-- Footer -->
  @include('layout.footer')


  <!-- Core  -->
  <script src="{{ asset( 'sample/global/vendor/babel-external-helpers/babel-external-helpers.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/vendor/jquery/jquery.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/vendor/tether/tether.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/vendor/bootstrap/bootstrap.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/vendor/animsition/animsition.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/vendor/mousewheel/jquery.mousewheel.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/vendor/asscrollbar/jquery-asScrollbar.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/vendor/asscrollable/jquery-asScrollable.js' ) }}"></script>


  <!-- Plugins -->
  <script src="{{ asset( 'sample/global/vendor/jquery-mmenu/jquery.mmenu.min.all.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/vendor/switchery/switchery.min.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/vendor/intro-js/intro.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/vendor/screenfull/screenfull.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/vendor/slidepanel/jquery-slidePanel.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/vendor/skycons/skycons.js' ) }}"></script>
  <!-- <script src="{{ asset( 'sample/global/vendor/chartist/chartist.min.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js' ) }}"></script> -->
  <script src="{{ asset( 'sample/global/vendor/aspieprogress/jquery-asPieProgress.min.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/vendor/jvectormap/jquery-jvectormap.min.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/vendor/jvectormap/maps/jquery-jvectormap-au-mill-en.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/vendor/matchheight/jquery.matchHeight-min.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/vendor/chart-js/Chart.js' ) }}"></script>

  <!-- <script src="{{ asset('globalv3/vendor/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script> -->

  <!-- DATATABLE -->
<!--   <script src="{{ asset('globalv3/vendor/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('globalv3/vendor/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('globalv3/vendor/datatables.net-fixedheader/dataTables.fixedHeader.js') }}"></script>
  <script src="{{ asset('globalv3/vendor/datatables.net-fixedcolumns/dataTables.fixedColumns.js') }}"></script>
  <script src="{{ asset('globalv3/vendor/datatables.net-rowgroup/dataTables.rowGroup.js') }}"></script>
  <script src="{{ asset('globalv3/vendor/datatables.net-scroller/dataTables.scroller.js') }}"></script>
  <script src="{{ asset('globalv3/vendor/datatables.net-responsive/dataTables.responsive.js') }}"></script>
  <script src="{{ asset('globalv3/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.js') }}"></script>
  <script src="{{ asset('globalv3/vendor/datatables.net-buttons/dataTables.buttons.js') }}"></script>
  <script src="{{ asset('globalv3/vendor/datatables.net-buttons/buttons.html5.js') }}"></script>
  <script src="{{ asset('globalv3/vendor/datatables.net-buttons/buttons.flash.js') }}"></script>
  <script src="{{ asset('globalv3/vendor/datatables.net-buttons/buttons.print.js') }}"></script>
  <script src="{{ asset('globalv3/vendor/datatables.net-buttons/buttons.colVis.js') }}"></script>
  <script src="{{ asset('globalv3/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.js') }}"></script>
  <script src="{{ asset('globalv3/vendor/asrange/jquery-asRange.min.js') }}"></script>

  <script src="{{asset('globalv3/vendor/bootstrap-sweetalert/sweetalert.js')}}"></script>
  <script src="{{asset('globalv3/vendor/ladda/spin.min.js')}}"></script>
  <script src="{{asset('globalv3/vendor/ladda/ladda.min.js')}}"></script>
  <script src="{{asset('globalv3/vendor/toastr/toastr.js')}}"></script>
  <script src="{{asset('globalv3/vendor/formvalidation/formValidation.min.js')}}"></script>
  <script src="{{asset('globalv3/vendor/formvalidation/framework/bootstrap4.min.js')}}"></script> -->
  
  <!-- Scripts -->
  <script src="{{ asset( 'sample/global/js/State.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/js/Component.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/js/Plugin.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/js/Base.js' ) }}"></script>
  <script src="{{ asset( 'sample/global/js/Config.js' ) }}"></script>
  <script src="{{ asset( 'sample/assets/js/Section/Menubar.js' ) }}"></script>
  <script src="{{ asset( 'sample/assets/js/Section/Sidebar.js' ) }}"></script>
  <script src="{{ asset( 'sample/assets/js/Section/PageAside.js' ) }}"></script>
  <script src="{{ asset( 'sample/assets/js/Section/GridMenu.js' ) }}"></script>
  <!-- Config -->
  <script src="{{ asset( 'sample/global/js/config/colors.js' ) }}"></script>
  <script src="{{ asset( 'sample/assets/js/config/tour.js' ) }}"></script>
  <script>
  // Config.set('assets', "{{ asset( 'sample/assets') }}");
  </script>
  <!-- Page -->
  <script src="{{ asset( 'sample/assets/js/Site.js') }}"></script>
  <script src="{{ asset( 'sample/global/js/Plugin/asscrollable.js') }}"></script>
  <script src="{{ asset( 'sample/global/js/Plugin/slidepanel.js') }}"></script>
  <script src="{{ asset( 'sample/global/js/Plugin/switchery.js') }}"></script>
  <script src="{{ asset( 'sample/global/js/Plugin/matchheight.js') }}"></script>
  <script src="{{ asset( 'sample/global/js/Plugin/jvectormap.js') }}"></script>
  <script src="{{ asset( 'sample/assets/examples/js/dashboard/v1.js') }}"></script>
  <!-- <script src="{{ asset('globalv3/js/Plugin/bootstrap-datepicker.js') }}"></script> -->
  
  @stack('scripts')
</body>
</html>