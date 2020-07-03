
  <div class="site-menubar">
    <ul class="site-menu">
      <li class="site-menu-item {{ Request::is('/') ? 'active' : '' }}">
        <a class="animsition-link" href="{{ route('home') }}">
          <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
          <span class="site-menu-title">Home</span>
        </a>
      </li>
      <li class="site-menu-item has-sub">
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
        </ul>
      </li>
    </ul>
  </div>