<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>Form Masks | Remark Admin Template</title>
  <link rel="apple-touch-icon" href="{{ asset('sample/assets/images/apple-touch-icon.png') }}">
  <link rel="shortcut icon" href="{{ asset('sample/assets/images/favicon.ico') }}">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('sample/global/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/global/css/bootstrap-extend.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/assets/css/site.css') }}">
  <!-- Plugins -->
  <link rel="stylesheet" href="{{ asset('sample/global/vendor/animsition/animsition.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/global/vendor/asscrollable/asScrollable.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/global/vendor/switchery/switchery.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/global/vendor/intro-js/introjs.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/global/vendor/slidepanel/slidePanel.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/global/vendor/jquery-mmenu/jquery-mmenu.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/global/vendor/flag-icon-css/flag-icon.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/global/vendor/waves/waves.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/global/vendor/jquery-mmenu/jquery-mmenu.css') }}">
  <link rel="stylesheet" href="{{ asset('sample/assets/examples/css/forms/masks.css') }}">
  <link rel="stylesheet" href="https://www.google.com/fonts/specimen/Roboto+Mono">
  <!-- Fonts -->
  <link rel="stylesheet" href="{{ asset('sample/global/fonts/material-design/material-design.min.css') }}">
  <link rel="stylesheet" href="{{ asset( 'sample/global/fonts/web-icons/web-icons.min.css' ) }}">
  <link rel="stylesheet" href="{{ asset('sample/global/fonts/brand-icons/brand-icons.min.css') }}">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
  <!--[if lt IE 9]>
    <script src="{{ asset('sample/global/vendor/html5shiv/html5shiv.min.js') }}"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="{{ asset('sample/global/vendor/media-match/media.match.min.js') }}"></script>
    <script src="../../../global/vendor/respond/respond.min.js"></script>
    <![endif]-->
  <!-- Scripts -->
  <script src="{{ asset('sample/global/vendor/breakpoints/breakpoints.js') }}"></script>
  <script>
  Breakpoints();
  </script>
</head>
<body class="animsition site-navbar-small ">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
      data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
      data-toggle="collapse">
        <i class="icon md-more" aria-hidden="true"></i>
      </button>
      <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
        <img class="navbar-brand-logo" src="{{ asset('sample/assets/images/logo.png') }}" title="Remark">
        <span class="navbar-brand-text hidden-xs-down"> Remark</span>
      </div>
      <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
      data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon md-search" aria-hidden="true"></i>
      </button>
    </div>
    <div class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
        <!-- Navbar Toolbar -->
        <ul class="nav navbar-toolbar">
          <li class="nav-item hidden-float" id="toggleMenubar">
            <a class="nav-link" data-toggle="menubar" href="#" role="button">
              <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar"></span>
                </i>
            </a>
          </li>
        </ul>
        <!-- End Navbar Toolbar -->
        <!-- Navbar Toolbar Right -->
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
          <li class="nav-item dropdown">
            <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
            data-animation="scale-up" role="button">
              <span class="avatar avatar-online">
                <img src="{{ asset('sample/global/portraits/5.jpg') }}" alt="...">
                <i></i>
              </span>
            </a>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Profile</a>
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-card" aria-hidden="true"></i> Billing</a>
              <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-settings" aria-hidden="true"></i> Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}" 
                onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                <i class="icon md-power" aria-hidden="true"></i> {{ __('Logout') }}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </div>
          </li>
          <li class="nav-item" id="toggleChat">
            <a class="nav-link" data-toggle="site-sidebar" href="javascript:void(0)" title="Chat"
            data-url="../site-sidebar.tpl">
              <i class="icon md-comment" aria-hidden="true"></i>
            </a>
          </li>
        </ul>
        <!-- End Navbar Toolbar Right -->
      </div>
    </div>
  </nav>
  <div class="site-menubar">
    <ul class="site-menu">
      <li class="site-menu-item">
        <a class="animsition-link" href="../index.html">
          <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
          <span class="site-menu-title">Dashboard</span>
        </a>
      </li>
      <li class="site-menu-item has-sub active">
        <a href="javascript:void(0)">
          <i class="site-menu-icon md-comment-alt-text" aria-hidden="true"></i>
          <span class="site-menu-title">Forms</span>
          <span class="site-menu-arrow"></span>
        </a>
        <ul class="site-menu-sub">
          <li class="site-menu-item">
            <a class="animsition-link" href="../forms/general.html">
              <span class="site-menu-title">General Elements</span>
            </a>
          </li>
          <li class="site-menu-item">
            <a class="animsition-link" href="../forms/material.html">
              <span class="site-menu-title">Material Elements</span>
            </a>
          </li>
          <li class="site-menu-item">
            <a class="animsition-link" href="../forms/advanced.html">
              <span class="site-menu-title">Advanced Elements</span>
            </a>
          </li>
          <li class="site-menu-item">
            <a class="animsition-link" href="../forms/layouts.html">
              <span class="site-menu-title">Form Layouts</span>
            </a>
          </li>
          <li class="site-menu-item">
            <a class="animsition-link" href="../forms/wizard.html">
              <span class="site-menu-title">Form Wizard</span>
            </a>
          </li>
          <li class="site-menu-item">
            <a class="animsition-link" href="../forms/validation.html">
              <span class="site-menu-title">Form Validation</span>
            </a>
          </li>
          <li class="site-menu-item active">
            <a class="animsition-link" href="../forms/masks.html">
              <span class="site-menu-title">Form Masks</span>
            </a>
          </li>
    </ul>
  </div>
  <div class="site-gridmenu">
    <div>
      <div>
        <ul>
          <li>
            <a href="../apps/mailbox/mailbox.html">
              <i class="icon md-email"></i>
              <span>Mailbox</span>
            </a>
          </li>
          <li>
            <a href="../apps/calendar/calendar.html">
              <i class="icon md-calendar"></i>
              <span>Calendar</span>
            </a>
          </li>
          <li>
            <a href="../apps/contacts/contacts.html">
              <i class="icon md-account"></i>
              <span>Contacts</span>
            </a>
          </li>
          <li>
            <a href="../apps/media/overview.html">
              <i class="icon md-videocam"></i>
              <span>Media</span>
            </a>
          </li>
          <li>
            <a href="../apps/documents/categories.html">
              <i class="icon md-receipt"></i>
              <span>Documents</span>
            </a>
          </li>
          <li>
            <a href="../apps/projects/projects.html">
              <i class="icon md-image"></i>
              <span>Project</span>
            </a>
          </li>
          <li>
            <a href="../apps/forum/forum.html">
              <i class="icon md-comments"></i>
              <span>Forum</span>
            </a>
          </li>
          <li>
            <a href="../index.html">
              <i class="icon md-view-dashboard"></i>
              <span>Dashboard</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Page -->
  <div class="page">
    <div class="page-header">
      <h1 class="page-title">Form Masks</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Forms</a></li>
        <li class="breadcrumb-item active">Masks</li>
      </ol>
      <div class="page-header-actions">
        <a class="btn btn-sm btn-primary btn-round" href="https://github.com/firstopinion/formatter.js"
        target="_blank">
          <i class="icon md-link" aria-hidden="true"></i>
          <span class="hidden-sm-down">Official Website</span>
        </a>
      </div>
    </div>
    <div class="page-content container-fluid">
      @yield('content')
    </div>
  </div>
  <!-- End Page -->
  <!-- Footer -->
  <footer class="site-footer">
    <div class="site-footer-legal">© 2017 <a href="http://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202">Remark</a></div>
    <div class="site-footer-right">
      Crafted with <i class="red-600 icon md-favorite"></i> by <a href="http://themeforest.net/user/amazingSurge">amazingSurge</a>
    </div>
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
  <script src="{{ asset('sample/global/vendor/waves/waves.js') }}"></script>
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