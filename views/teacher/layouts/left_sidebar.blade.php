<aside class="left-sidebar bg-sidebar">
  <div id="sidebar" class="sidebar">
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
        <span class="brand-name text-truncate">Quizzz</span>
      </a>
    </div>
    <!-- begin sidebar scrollbar -->
    <div class="sidebar-scrollbar">

      <!-- sidebar menu -->
      <ul class="nav sidebar-inner" id="sidebar-menu">
        <li class="{{($active == 'dashboard') ? 'active' : ''}}">
          <a class="sidenav-item-link" href="{{url('teacher-panel/dashboard')}}">
            <i class="mdi mdi-view-dashboard-outline"></i>
            <span class="nav-text">Tổng quan</span>
          </a>
        </li>

        <li class="has-sub {{($active == 'student' || $active == 'teacher') ? 'active expand' : ''}}">
          <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#user"
            aria-expanded="false" aria-controls="user">
            <i class="mdi mdi-folder-account"></i>
            <span class="nav-text">Người dùng</span> <b class="caret"></b>
          </a>
          <ul class="collapse {{($active == 'student' || $active == 'teacher') ? 'show' : ''}}" id="user" data-parent="#sidebar-menu">
            <div class="sub-menu">
              <li class="{{($active == 'teacher') ? 'active' : ''}}">
                <a class="sidenav-item-link" href="{{ url('teacher-panel/teachers') }}">
                  <span class="nav-text">Giáo viên</span>

                </a>
              </li>
              <li class="{{($active == 'student') ? 'active' : ''}}">
                <a class="sidenav-item-link" href="{{ url('teacher-panel/students') }}">
                  <span class="nav-text">Học sinh</span>

                </a>
              </li>
            </div>
          </ul>
        </li>

        <li class="has-sub {{($active == 'class' || $active == 'subject') ? 'active expand' : ''}}">
          <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#category"
            aria-expanded="false" aria-controls="category">
            <i class="mdi mdi-folder-multiple-outline"></i>
            <span class="nav-text">Danh mục</span> <b class="caret"></b>
          </a>
          <ul class="collapse {{($active == 'class' || $active == 'subject') ? 'show' : ''}}" id="category" data-parent="#sidebar-menu">
            <div class="sub-menu">
              <li class="{{($active == 'class') ? 'active' : ''}}">
                <a class="sidenav-item-link" href="{{ url('teacher-panel/classes') }}">
                  <span class="nav-text">Lớp học</span>
                </a>
              </li>
              <li class="{{($active == 'subject') ? 'active' : ''}}">
                <a class="sidenav-item-link" href="{{ url('teacher-panel/subjects') }}">
                  <span class="nav-text">Môn học</span>
                </a>
              </li>
            </div>
          </ul>
        </li>

        <li class="{{($active == 'question') ? 'active' : ''}}">
          <a class="sidenav-item-link" href="{{url('teacher-panel/questions')}}">
            <i class="far fa-question-circle"></i>
            <span class="nav-text">Câu hỏi</span>
          </a>
        </li>

        <li class="{{($active == 'test') ? 'active' : ''}}">
          <a class="sidenav-item-link" href="{{url('teacher-panel/tests')}}">
            <i class='far fa-file-alt'></i>
            <span class="nav-text">Bài kiểm tra</span>
          </a>
        </li>

        <li class="has-sub">
          <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#statistics"
            aria-expanded="false" aria-controls="statistics">
            <i class="mdi mdi-chart-bar-stacked"></i>
            <span class="nav-text">Thống kê</span> <b class="caret"></b>
          </a>
          <ul class="collapse" id="statistics" data-parent="#sidebar-menu">
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

  </div>
</aside>