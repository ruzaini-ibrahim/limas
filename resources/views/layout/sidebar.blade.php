
  <div class="site-menubar">
    <ul class="site-menu">

      <li class="site-menu-item {{ Request::is('/') ? 'active' : '' }}">
        <a class="animsition-link" href="{{ route('admin.dashboard') }}">
          <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
          <span class="site-menu-title">Dashboard</span>
        </a>
      </li>

      <li class="site-menu-item has-sub {{ Request::is('admin/user*') ? 'active' : '' }}">
        <a href="javascript:void(0)">
          <i class="site-menu-icon fa fa-users" aria-hidden="true"></i>
          <span class="site-menu-title">User Management</span>
          <span class="site-menu-arrow"></span>
        </a>
        <ul class="site-menu-sub">
          <li class="site-menu-item {{ Request::is('admin/user*') ? 'active' : '' }}">
            <a class="animsition-link" href="{{ route('user.index') }}">
              <span class="site-menu-title">Member</span>
            </a>
          </li>
          <li class="site-menu-item {{ Request::is('admin/administrator*') ? 'active' : '' }}">
            <a class="animsition-link" href="{{ route('administrator.index') }}">
              <span class="site-menu-title">Admin</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="site-menu-item has-sub {{ Request::is('admin/category*') ? 'active' : '' }}">
        <a href="javascript:void(0)">
          <i class="site-menu-icon fas fa-book" aria-hidden="true"></i>
          <span class="site-menu-title">Book Management</span>
          <span class="site-menu-arrow"></span>
        </a>
        <ul class="site-menu-sub">
          <li class="site-menu-item {{ Request::is('admin/book*') ? 'active' : '' }}">
            <a class="animsition-link" href="{{ route('book.index') }}">
              <span class="site-menu-title">Books</span>
            </a>
          </li>
          <li class="site-menu-item {{ Request::is('admin/administrator*') ? 'active' : '' }}">
            <a class="animsition-link" href="{{ route('administrator.index') }}">
              <span class="site-menu-title">Checkout</span>
            </a>
          </li>
          <li class="site-menu-item {{ Request::is('admin/administrator*') ? 'active' : '' }}">
            <a class="animsition-link" href="{{ route('administrator.index') }}">
              <span class="site-menu-title">Return</span>
            </a>
          </li>
          <li class="site-menu-item {{ Request::is('admin/category*') ? 'active' : '' }}">
            <a class="animsition-link" href="{{ route('category.index') }}">
              <span class="site-menu-title">Categories</span>
            </a>
          </li>
        </ul>
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