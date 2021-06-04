
    <!-- Sidebar Menu -->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <ul class="app-menu">
      
        <li class="my-3 d-flex align-items-center justify-content-between justify-content-lg-center">
          <a class="app-nav__item menu-btn-green d-block d-lg-none" href="#" data-toggle="sidebar" style=><i class="fa fa-times" style="font-size: 1.5em"></i></a>
          <a class="h4 text-uppercase" href="{{ route('site.home') }}" target="_blank">
            <img class="a-app_logo" src="{{asset('assets/images/logo/'.setting('site.logo'))}}">
            <div class="wrap-b-app_logo menu-bg-primary rounded-1 p-2"><img class="b-app_logo" src="{{asset('assets/images/icon/'.setting('site.icon'))}}"></div>
          </a>
          <a class="d-block d-lg-none" href="#"></a>
        </li>
        <hr>

        <li><a class="app-menu__item {{ Request::path() == 'member' ? 'active' : '' }}" href="{{ route('member.dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

        <li><a class="app-menu__item {{ is_int(strpos(Request::url(), route('member.profile'))) ? 'active' : '' }}" href="{{ route('member.profile') }}"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Profil</span></a></li>

      </ul>
    </aside>