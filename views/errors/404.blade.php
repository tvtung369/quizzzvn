<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>404 Error</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
    rel="stylesheet" />
  <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

  <!-- SLEEK CSS -->
  <link id="sleek-css" rel="stylesheet" href="{{asset('assets/css/sleek.css')}}" />

  <!-- FAVICON -->
  <link href="{{asset('assets/img/favicon.png')}}" rel="shortcut icon" />
</head>


<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
      <div class="error-wrapper rounded border bg-white px-5">
        <div class="row justify-content-center">
          <div class="col-xl-4">
            <h1 class="text-primary bold error-title">404</h1>
            <p class="pt-4 pb-5 error-subtitle">Looks like something went wrong.</p>
            <a href="{{ url('teacher-panel/dashboard') }}" class="btn btn-primary btn-pill">Back to Home</a>
          </div>
          <div class="col-xl-6 pt-5 pt-xl-0 text-center">
            <img src="{{ asset('assets/img/lightenning.png')}}" class="img-responsive" alt="Error Page Image">
          </div>
        </div>
      </div>
</body>

</html>