<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('sample/assets/css/site.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome/css/all.css') }}" rel="stylesheet">
</head>
<body>
    <style>
        .login-main{
            background: -webkit-linear-gradient(#a635ab, #3f51b5);
            background: -o-linear-gradient(#a635ab, #3f51b5);
            background: linear-gradient(#a635ab, #3f51b5);
        }
    </style>
    <div class="login-main row p-4 h-100">
        <div class="col-md-6 text-white align-self-center text-center">
            @include('auth._cover')
        </div>
        <div class="col-md-6 align-self-center">

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>
    <!-- Core  -->
  <script src="{{ asset('sample/global/vendor/babel-external-helpers/babel-external-helpers.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/jquery/jquery.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/tether/tether.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/bootstrap/bootstrap.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/animsition/animsition.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/mousewheel/jquery.mousewheel.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/asscrollbar/jquery-asScrollbar.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/asscrollable/jquery-asScrollable.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/waves/waves.js') }}"></script>
    <!-- Plugins -->
  <script src="{{ asset('sample/global/vendor/jquery-mmenu/jquery.mmenu.min.all.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/switchery/switchery.min.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/intro-js/intro.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/screenfull/screenfull.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/slidepanel/jquery-slidePanel.js') }}"></script>
  <script src="{{ asset('sample/global/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
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
    <!-- Page -->
  <script src="{{ asset('sample/assets/js/Site.js') }}"></script>
  <script src="{{ asset('sample/global/js/Plugin/asscrollable.js') }}"></script>
  <script src="{{ asset('sample/global/js/Plugin/slidepanel.js') }}"></script>
  <script src="{{ asset('sample/global/js/Plugin/switchery.js') }}"></script>
  <script src="{{ asset('sample/global/js/Plugin/jquery-placeholder.js') }}"></script>
  <script src="{{ asset('sample/global/js/Plugin/material.js') }}"></script>

  <!-- custom -->
  <script src="{{ asset('js/custom.js') }}"></script>
  <!-- <script src="{{ asset('js/tilt.jquery.js') }}"></script> -->
  <script src="{{ asset('js/jquery/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('js/tilt/tilt.jquery.min.js') }}"></script>

  <!-- turbo link -->
  <script src="http://unpkg.com/turbolinks"></script>

  @yield('scripts')
  <script>
    $('.js-tilt').tilt({
        // scale: 1.2
    });    
  </script>
</body>
</html>
