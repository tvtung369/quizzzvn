<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">


  <title>{{ $title }} | Quizzz - Hệ thống thi trắc nghiệm online</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
  <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">

  <!-- PLUGINS CSS STYLE -->
  <link href="{{ asset('teacher/assets/plugins/nprogress/nprogress.css')}}" rel="stylesheet" />

  <link href="{{ asset('teacher/assets/plugins/toastr/toastr.min.css')}}" rel="stylesheet" />

  <!-- Custom styles for this page -->
  @yield('css')


  <!-- SLEEK CSS -->
  <link rel="stylesheet" href="{{ asset('teacher/assets/css/sleek.css')}}" />

  <!-- FAVICON -->
  <link href="{{ asset('teacher/assets/img/favicon.png')}}" rel="shortcut icon" />

  <script src="{{ asset('teacher/assets/plugins/nprogress/nprogress.js')}}"></script>
</head>


<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">

  <script>
    NProgress.configure({
      showSpinner: false
    });
    NProgress.start();
  </script>


  <div id="toaster"></div>


  <div class="wrapper">
    <!--
          ====================================
          ——— LEFT SIDEBAR WITH FOOTER
          =====================================
        -->
    @include('teacher.layouts.left_sidebar')


    <div class="page-wrapper">
      <!-- Header -->
      @include('teacher.layouts.header')


      @yield('content')

      @include('teacher.layouts.right_sidebar')

      @include('teacher.layouts.footer')

    </div>
  </div>

  <script src="{{asset('teacher/assets/plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('teacher/assets/plugins/slimscrollbar/jquery.slimscroll.min.js')}}"></script>
  <script src="{{asset('teacher/assets/plugins/jekyll-search.min.js')}}"></script>


  <script src="{{ asset('teacher/assets/js/quizzz.js')}}"></script>

  <script src="{{ asset('teacher/assets/plugins/toastr/toastr.min.js')}}"></script>

  <script>
    /*======== 5. TOASTER ========*/

    let toaster = $('#toaster');

    function callToaster(positionClass, message, level) {
      toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: true,
        positionClass: positionClass,
        preventDuplicates: false,
        onclick: null,
        showDuration: "1000",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
      };
      switch (level) {
        case 'error':
          toastr.error(message, 'LỗiLỗi');
          break;
        case 'warning':
          toastr.warning(message, 'Cảnh báo');
          break;
        case 'info':
          toastr.info(message, 'Thông báo');
          break;
        case 'success':
          toastr.success(message, 'Thông báo');
          break;
        default:
          throw level + ' does not exist in ["error", "success", "info", "warning"]';
      }
    }
  </script>

  @yield('js')

  <script src="{{ asset('teacher/assets/js/sleek.bundle.js')}}"></script>

</body>

</html>