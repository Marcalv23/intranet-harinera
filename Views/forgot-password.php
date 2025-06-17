<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Falcon | Dashboard &amp; Web App Template</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="../Views/Resources/assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../Views/Resources/assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../Views/Resources/assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="../Views/Resources/assets/img/favicons/favicon.ico">
    <link rel="manifest" href="../Views/Resources/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="../Views/Resources/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="../Views/Resources/assets/js/config.js"></script>
    <script src="../Views/Resources/vendors/simplebar/simplebar.min.js"></script>


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="../Views/Resources/vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link href="../Views/Resources/assets/css/theme-rtl.css" rel="stylesheet" id="style-rtl">
    <link href="../Views/Resources/assets/css/theme.css" rel="stylesheet" id="style-default">
    <link href="../Views/Resources/assets/css/user-rtl.css" rel="stylesheet" id="user-style-rtl">
    <link href="../Views/Resources/assets/css/user.css" rel="stylesheet" id="user-style-default">
    <script>
      var isRTL = JSON.parse(localStorage.getItem('isRTL'));
      if (isRTL) {
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
      <div class="container-fluid">
        <div class="row min-vh-100 flex-center g-0">
          <div class="col-lg-8 col-xxl-5 py-3 position-relative"><img class="bg-auth-circle-shape" src="../Views/Resources/assets/img/icons/spot-illustrations/bg-shape.png" alt="" width="250"><img class="bg-auth-circle-shape-2" src="../../../assets/img/icons/spot-illustrations/shape-1.png" alt="" width="150">
            <div class="card overflow-hidden z-1">
              <div class="card-body p-0">
                <div class="row g-0 h-100">
                  <div class="col-md-5 text-center bg-card-gradient">
                    <div class="position-relative p-4 pt-md-5 pb-md-7" data-bs-theme="light">
                      <div class="bg-holder bg-auth-card-shape" style="background-image:url(../Views/Resources/assets/img/icons/spot-illustrations/half-circle.png);">
                      </div>
                    </div>
                    <div class="mt-3 mb-4 mt-md-4 mb-md-5" data-bs-theme="light">
                      <p class="mb-0 mt-4 mt-md-5 fs-10 fw-semi-bold text-white opacity-75">Leer nuestros <a class="text-decoration-underline text-white" href="#!">terminos</a> y <a class="text-decoration-underline text-white" href="#!">condiciones </a></p>
                    </div>
                  </div>
                  <div class="col-md-7 d-flex flex-center">
                    <div class="p-4 p-md-5 flex-grow-1">
                      <div class="text-center text-md-start">
                        <h4 class="mb-0"> Olvidaste tu contraseña?</h4>
                        <p class="mb-4">Ingresa tu correo electrónico y te enviaremos un enlace de restablecimiento.</p>
                      </div>
                      <div class="row justify-content-center">
                        <div class="col-sm-8 col-md">
                          <form class="mb-3">
                            <input class="form-control" type="email" placeholder="Correo electrónico" />
                            <div class="mb-3"></div>
                            <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Enviar enlace de restablecimiento</button>
                          </form><a class="fs-10 text-600" href="#!"><span class="d-inline-block ms-1">&rarr;</span></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>


    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="../Views/Resources/vendors/popper/popper.min.js"></script>
    <script src="../Views/Resources/vendors/bootstrap/bootstrap.min.js"></script>
    <script src="../Views/Resources/vendors/anchorjs/anchor.min.js"></script>
    <script src="../Views/Resources/vendors/is/is.min.js"></script>
    <script src="../Views/Resources/vendors/fontawesome/all.min.js"></script>
    <script src="../Views/Resources/vendors/lodash/lodash.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="../Views/Resources/vendors/list.js/list.min.js"></script>
    <script src="../Views/Resources/assets/js/theme.js"></script>

  </body>

</html>