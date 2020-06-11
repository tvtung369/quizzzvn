<aside class="left-sidebar bg-sidebar">
  <div id="sidebar" class="sidebar sidebar-with-footer">
    <!-- Aplication Brand -->
    <div class="app-brand">
      <a href="{{ url('teacher-panel/dashboard') }}" title="Quizzz Dashboard">
        <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33"
          viewBox="0 0 30 33">
          <g fill="none" fill-rule="evenodd">
            <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
            <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
          </g>
        </svg>
        <span class="brand-name text-truncate">Quizzz Dashboard</span>
      </a>
    </div>
    <!-- begin sidebar scrollbar -->
    <div class="sidebar-scrollbar">

      <!-- sidebar menu -->
      <ul class="nav sidebar-inner" id="sidebar-menu">



        <li class="active">
          <a class="sidenav-item-link" href="{{url('teacher-panel/dashboard')}}">
            <i class="mdi mdi-view-dashboard-outline"></i>
            <span class="nav-text">Dashboard</span>
          </a>
        </li>

        <li class="has-sub active expand">
          <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#components"
            aria-expanded="false" aria-controls="components">
            <i class="mdi mdi-folder-account"></i>
            <span class="nav-text">Người dùng</span> <b class="caret"></b>
          </a>
          <ul class="collapse show" id="components" data-parent="#sidebar-menu">
            <div class="sub-menu">
              <li class="active">
                <a class="sidenav-item-link" href="{{ url('teacher-panel/teachers') }}">
                  <span class="nav-text">Giáo viên</span>

                </a>
              </li>
              <li>
                <a class="sidenav-item-link" href="{{ url('teacher-panel/students') }}">
                  <span class="nav-text">Học sinh</span>

                </a>
              </li>
            </div>
          </ul>
        </li>

        <li class="has-sub">
          <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#icons"
            aria-expanded="false" aria-controls="icons">
            <i class="mdi mdi-chart-bar-stacked"></i>
            <span class="nav-text">Thống kê</span> <b class="caret"></b>
          </a>
          <ul class="collapse" id="icons" data-parent="#sidebar-menu">
            <div class="sub-menu">
              <li>
                <a class="sidenav-item-link" href="material-icon.html">
                  <span class="nav-text">Material Icon</span>

                </a>
              </li>
              <li>
                <a class="sidenav-item-link" href="flag-icon.html">
                  <span class="nav-text">Flag Icon</span>

                </a>
              </li>
            </div>
          </ul>
        </li>
      </ul>
    </div>

    <div class="sidebar-footer">
      <hr class="separator mb-0" />
      <div class="sidebar-footer-content">
        <h6 class="text-uppercase">
          Cpu Uses <span class="float-right">40%</span>
        </h6>
        <div class="progress progress-xs">
          <div class="progress-bar active" style="width: 40%;" role="progressbar"></div>
        </div>
        <h6 class="text-uppercase">
          Memory Uses <span class="float-right">65%</span>
        </h6>
        <div class="progress progress-xs">
          <div class="progress-bar progress-bar-warning" style="width: 65%;" role="progressbar"></div>
        </div>
      </div>
    </div>
  </div>
</aside>