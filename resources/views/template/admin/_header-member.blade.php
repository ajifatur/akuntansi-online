<header class="app-header align-items-center">
  <a class="app-sidebar__toggle menu-btn-primary d-block" href="#" data-toggle="sidebar"></a>

<!--   <ul class="app-nav d-block"><li class="app-nav__item" style="line-height: 15px">
    <h5 class="d-inline-block text-truncate m-0" style="max-width: 150px; color: var(--primary)">Dashboard</h5>
    <p class="m-0 text-muted"><small><i class="fa fa-home"></i> > Dashboard</small></p>
  </li></ul> -->
  <ul class="app-nav ml-auto ml-md">
    @if(Auth::user()->status == 1)
    <li class="dropdown">
      <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications">
        <i class="fa fa-bell fa-lg" data-toggle="tooltip" title="Notifikasi"></i>
        @if(count_notif_member() > 0)
        <span class="badge badge-info">{{ count_notif_member() }}</span>
        @endif
      </a>
      <ul class="app-notification dropdown-menu dropdown-menu-right">
        <div class="card">
          <div class="card-header">
            <p class="m-0 font-weight-bold">Notifikasi</p>  
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6 border-right border-bottom">
                <a class="dropdown-item" href="{{ route('member.filemanager.index', ['kategori' => 'e-course']) }}">
                  <span class="app-notification__icon p-0"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-video-camera fa-stack-1x fa-inverse"></i></span>
                  </span>
                  <span class="badge badge-pill badge-danger position-absolute">{{ count_notif_file('e-course') }}</span>
                  <p class="app-notification__message">E-Course<br>Terbaru</p>
                </a>
              </div>
              <div class="col-6 border-bottom">
                <a class="dropdown-item" href="{{ route('member.filemanager.index', ['kategori' => 'e-learning']) }}">
                  <span class="app-notification__icon p-0"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-warning"></i><i class="fa fa-folder-open fa-stack-1x fa-inverse"></i></span></span>
                  <span class="badge badge-pill badge-danger position-absolute">{{ count_notif_file('e-learning') }}</span>
                  <div>
                    <p class="app-notification__message">E-Learning<br>Terbaru</p>
                  </div>
                </a>
              </div>
              <div class="col-6 border-right border-bottom">
                <a class="dropdown-item" href="{{ route('member.filemanager.index', ['kategori' => 'e-library']) }}">
                  <span class="app-notification__icon p-0"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-folder-open fa-stack-1x fa-inverse"></i></span></span>
                  <span class="badge badge-pill badge-danger position-absolute">{{ count_notif_file('e-library') }}</span>
                  <div>
                    <p class="app-notification__message">E-Library<br>Terbaru</p>
                  </div>
                </a>
              </div>
              <div class="col-6 border-bottom">
                <a class="dropdown-item" href="{{ route('member.filemanager.index', ['kategori' => 'e-competence']) }}">
                  <span class="app-notification__icon p-0"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-info"></i><i class="fa fa-folder-open fa-stack-1x fa-inverse"></i></span></span>
                  <span class="badge badge-pill badge-danger position-absolute">{{ count_notif_file('e-competence') }}</span>
                  <div>
                    <p class="app-notification__message">E-Competence<br>Terbaru</p>
                  </div>
                </a>
              </div>
              <div class="col-6 border-right">
                <a class="dropdown-item" href="{{ route('member.pelatihan.index') }}">
                  <span class="app-notification__icon p-0"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-secondary"></i><i class="fa fa-graduation-cap fa-stack-1x fa-inverse"></i></span></span>
                  <span class="badge badge-pill badge-danger position-absolute">{{ count_notif_pelatihan_member() }}</span>
                  <div>
                    <p class="app-notification__message">Pelatihan<br>Terbaru</p>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </ul>
    </li>
    @endif
    <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown"><i class="fa fa-user fa-lg" data-toggle="tooltip" title="Akun"></i></a>
      <ul class="dropdown-menu settings-menu dropdown-menu-right">
        <div class="card">
          <div class="card-header">
            <div class="media">
              <img width="50" height="50" class="rounded mr-3" src="{{ image('assets/images/user/'.Auth::user()->foto, 'user') }}">
              <div class="media-body">
                <p class="m-0 font-weight-bold">{{ Auth::user()->nama_user }}</p>
                <p class="m-0"><small><i class="fa fa-bookmark mr-2"></i>{{ role(Auth::user()->role) }}</small></p>
              </div>
            </div>  
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6 border-right">
                <a class="dropdown-item" href="{{ route('member.profile') }}">
                  <span class="app-notification__icon p-0"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-cog fa-stack-1x fa-inverse"></i></span></span>
                  <p class="m-0">Profil</p>
                </a>
              </div>
              <div class="col-6">
                <a class="dropdown-item" href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                  <span class="app-notification__icon p-0"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-sign-out fa-stack-1x fa-inverse"></i></span></span>
                  <p class="m-0">Keluar</p>
                </a>
                <form id="form-logout" method="post" action="{{ route('member.logout') }}">
                    {{ csrf_field() }}
                </form>
              </div>
            </div>
          </div>
        </div>
      </ul>
    </li>
  </ul>
</header>