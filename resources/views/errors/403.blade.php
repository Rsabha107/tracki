<!DOCTYPE html>
<html data-navigation-type="default" data-navbar-horizontal-shape="default" lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>404 Page</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset ('assets/img/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset ('assets/img/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset ('assets/img/favicons/favicon-16x16.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset ('assets/img/favicons/favicon.ico')}}">
    <link rel="manifest" href="{{asset ('assets/img/favicons/manifest.json')}}">
    <meta name="msapplication-TileImage" content="{{asset ('assets/img/favicons/mstile-150x150.png')}}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset ('assets/vendors/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{ asset ('assets/vendors/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset ('assets/js/config.js')}}"></script>


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="{{ asset ('assets/vendors/simplebar/simplebar.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="{{ asset ('assets/css/theme-rtl.min.css')}}" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="{{ asset ('assets/css/theme.min.css')}}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{ asset ('assets/css/user-rtl.min.css')}}" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset ('assets/css/user.min.css')}}" type="text/css" rel="stylesheet" id="user-style-default">
    <script>
      var phoenixIsRTL = window.config.config.phoenixIsRTL;
      if (phoenixIsRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
      } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
      }
    </script>
  </head>


  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="px-3">
        <div class="row min-vh-100 flex-center p-5">
          <div class="col-12 col-xl-10 col-xxl-8">
            <div class="row justify-content-center align-items-center g-5">
              <div class="col-12 col-lg-6 text-center order-lg-1"><img class="img-fluid w-lg-100 d-dark-none" src="{{asset('assets/img/spot-illustrations/403-illustration.png')}}" alt="" width="400" /><img class="img-fluid w-md-50 w-lg-100 d-light-none" src="../../assets/img/spot-illustrations/dark_404-illustration.png" alt="" width="540" /></div>
              <div class="col-12 col-lg-6 text-center text-lg-start"><img class="img-fluid mb-6 w-50 w-lg-75 d-dark-none" src="{{asset('assets/img/spot-illustrations/403.png')}}" alt="" /><img class="img-fluid mb-6 w-50 w-lg-75 d-light-none" src="../../assets/img/spot-illustrations/dark_404.png" alt="" />
                <h2 class="text-body-secondary fw-bolder mb-3">Access Forbidden!</h2>
                <p class="text-body mb-5">Halt! Thou art endeavouring to trespass upon a realm not granted unto thee. <br class="d-none d-sm-block" />go home. </p><a class="btn btn-lg btn-primary" href="{{route('tracki.employee.dashboard')}}">Go Home</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
        var navbarTopStyle = window.config.config.phoenixNavbarTopStyle;
        var navbarTop = document.querySelector('.navbar-top');
        if (navbarTopStyle === 'darker') {
          navbarTop.setAttribute('data-navbar-appearance', 'darker');
        }

        var navbarVerticalStyle = window.config.config.phoenixNavbarVerticalStyle;
        var navbarVertical = document.querySelector('.navbar-vertical');
        if (navbarVertical && navbarVerticalStyle === 'darker') {
          navbarVertical.setAttribute('data-navbar-appearance', 'darker');
        }
      </script>

    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->





    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{ asset ('assets/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset ('assets/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('assets/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset ('assets/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset ('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset ('assets/vendors/lodash/lodash.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset ('assets/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset ('assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset ('assets/vendors/dayjs/dayjs.min.js') }}"></script>
    <script src="{{ asset ('assets/assets/js/phoenix.js') }}"></script>

  </body>

</html>