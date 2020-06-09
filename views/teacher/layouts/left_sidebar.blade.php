<aside class="left-sidebar bg-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">
            <a href="/index.html">
                <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30"
                    height="33" viewBox="0 0 30 33">
                    <g fill="none" fill-rule="evenodd">
                        <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                        <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                    </g>
                </svg>
                <span class="brand-name">Qizzz Dashboard</span>
            </a>
        </div>
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-scrollbar">
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <li class="has-sub active expand">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#dashboard" aria-expanded="false" aria-controls="dashboard">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Trang tổng quan</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#ui-elements" aria-expanded="false" aria-controls="ui-elements">
                        <i class="mdi mdi-folder-multiple-outline"></i>
                        <span class="nav-text">Danh mục</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="ui-elements" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li class="has-sub">
                                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                    data-target="#components" aria-expanded="false" aria-controls="components">
                                    <span class="nav-text">Người dùng</span> <b class="caret"></b>
                                </a>
                                <ul class="collapse" id="components">
                                    <div class="sub-menu">
                                        <li>
                                            <a href="alert.html">Giáo Viên</a>
                                        </li>
                                        <li>
                                            <a href="badge.html">Học Sinh</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                    data-target="#icons" aria-expanded="false" aria-controls="icons">
                                    <span class="nav-text">Trường Học</span> <b class="caret"></b>
                                </a>
                                <ul class="collapse" id="icons">
                                    <div class="sub-menu">
                                        <li>
                                            <a href="material-icon.html">Khối</a>
                                        </li>
                                        <li>
                                            <a href="flag-icon.html">Lớp Học</a>
                                        </li>
                                        <li>
                                            <a href="flag-icon.html">Môn Học</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                    data-target="#forms" aria-expanded="false" aria-controls="forms">
                                    <span class="nav-text">Quản Lý Thi</span> <b class="caret"></b>
                                </a>
                                <ul class="collapse" id="forms">
                                    <div class="sub-menu">
                                        <li>
                                            <a href="basic-input.html">Đề thi</a>
                                        </li>
                                        <li>
                                            <a href="input-group.html">Câu hỏi</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </div>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#charts"
                        aria-expanded="false" aria-controls="charts">
                        <i class="mdi mdi-chart-areaspline"></i>
                        <span class="nav-text">Thống Kê</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="charts" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li>
                                <a class="sidenav-item-link" href="chartjs.html">
                                    <span class="nav-text">Điểm thi</span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
        <hr class="separator" />
    </div>
</aside>