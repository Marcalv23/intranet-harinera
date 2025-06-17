<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Registro</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x190" href="../Views/Resources/assets/img/favicons/apple-touch-icon.png">

    <link rel="icon" type="image/png" sizes="40x32" href="../Views/Resources/assets/img/favicons/harinera-de-oriente.png">
    <link rel="icon" type="image/png" sizes="20x16" href="../Views/Resources/assets/img/favicons/harinera-de-oriente.png">
    <link rel="shortcut icon" type="image/x-icon" href="../Views/Resources/assets/img/favicons/harinera-de-oriente.png">
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
                <div class="col-lg-8 col-xxl-5 py-3 position-relative">
                    <img class="bg-auth-circle-shape" src="../Views/Resources/assets/img/icons/spot-illustrations/bg-shape.png" alt="" width="250">
                    <img class="bg-auth-circle-shape-2" src="../Views/Resources/assets/img/icons/spot-illustrations/shape-1.png" alt="" width="150">
                    <div class="card overflow-hidden z-1">
                        <div class="card-body p-0">
                            <div class="row g-0 h-100">
                                <div class="col-md-5 text-center bg-card-gradient">
                                    <div class="position-relative p-4 pt-md-5 pb-md-7" data-bs-theme="light">
                                        <div class="bg-holder bg-auth-card-shape" style="background-image:url(../Views/Resources/assets/img/icons/spot-illustrations/half-circle.png);">
                                        </div>
                                        <div class="z-1 position-relative">
                                            <img src="../Views/Resources/img/200X200.png" alt="HO" class="mb-4">
                                        </div>
                                    </div>
                                    <div class="mt-3 mb-4 mt-md-4 mb-md-5" data-bs-theme="light">
                                        <p class="pt-3 text-white">¿Tienes cuenta?<br><a class="btn btn-outline-light mt-2 px-4" href="../Views/login.php">Ingresar</a></p>
                                    </div>
                                </div>
                                <div class="col-md-7 d-flex flex-center">
                                    <div class="p-4 p-md-5 flex-grow-1">
                                        <h3>Registro</h3>
                                        <?php
                                                include '../Controllers/AuthenticationController.php';

                                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                                    // Capturar datos del formulario
                                                    $nombre = $_POST['nombre'] ?? '';
                                                    $email = $_POST['email'] ?? '';
                                                    $password = $_POST['password'] ?? '';
                                                    $confirm_password = $_POST['confirm_password'] ?? '';

                                                    // Llamar a la función para registrar el usuario
                                                    $controller = AuthenticationController::registerUser($email, $nombre, $password);

                                                    // Validar que todos los campos necesarios estén completos
                                                    if (empty($nombre) || empty($email) || empty($password) || empty($confirm_password)) {
                                                        echo '<div class="alert alert-danger" role="alert">Todos los campos son obligatorios.</div>';
                                                    } elseif ($password !== $confirm_password) {
                                                        echo '<div class="alert alert-danger" role="alert">Las contraseñas no coinciden.</div>';
                                                    } else {
                                                        // Mostrar el resultado de la función registerUser
                                                        echo '<div class="alert alert-success" role="alert">' . $controller . '</div>';
                                                    }
                                                }
                                                ?>

                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                            <div class="mb-3">
                                                <label class="form-label" for="card-name">Nombre</label>
                                                <input class="form-control" type="text" autocomplete="on" id="card-name" name="nombre" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="card-email">Correo electrónico</label>
                                                <input class="form-control" type="email" autocomplete="on" id="card-email" name="email" />
                                            </div>
                                            <div class="row gx-2">
                                                <div class="mb-3 col-sm-6">
                                                    <label class="form-label" for="card-password">Contraseña</label>
                                                    <input class="form-control" type="password" autocomplete="on" id="card-password" name="password" />
                                                </div>
                                                <div class="mb-3 col-sm-6">
                                                    <label class="form-label" for="card-confirm-password">Confirmar contraseña</label>
                                                    <input class="form-control" type="password" autocomplete="on" id="card-confirm-password" name="confirm_password" />
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="card-register-checkbox" />
                                                <label class="form-label" for="card-register-checkbox">I accept the <a href="#!">terms </a>and <a class="white-space-nowrap" href="#!">privacy policy</a></label>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Registrarse</button>
                                            </div>
                                        </form>
                                        <div class="position-relative mt-4">
                                            <hr />
                                            <div class="divider-content-center">or register with</div>
                                        </div>
                                        <div class="row g-2 mt-2">
                                            <div class="col-sm-6"><a class="btn btn-outline-google-plus btn-sm d-block w-100" href="#"><span class="fab fa-google-plus-g me-2" data-fa-transform="grow-8"></span> google</a></div>
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
    <!--    End of Main Content-->
    <!-- ===============================================-->

        <div class="card-body d-flex align-items-center py-md-2 px-2 py-1">
            <div class="bg-primary-subtle position-relative rounded-start" style="height:34px;width:28px">
                <div class="settings-popover"><span class="ripple"><span class="fa-spin position-absolute all-0 d-flex flex-center"><span class="icon-spin position-absolute all-0 d-flex flex-center">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.7369 12.3941L19.1989 12.1065C18.4459 11.7041 18.0843 10.8487 18.0843 9.99495C18.0843 9.14118 18.4459 8.28582 19.1989 7.88336L19.7369 7.59581C19.9474 7.47484 20.0316 7.23291 19.9474 7.03131C19.4842 5.57973 18.6843 4.28943 17.6738 3.20075C17.5053 3.03946 17.2527 2.99914 17.0422 3.12011L16.393 3.46714C15.6883 3.84379 14.8377 3.74529 14.1476 3.3427C14.0988 3.31422 14.0496 3.28621 14.0002 3.25868C13.2568 2.84453 12.7055 2.10629 12.7055 1.25525V0.70081C12.7055 0.499202 12.5371 0.297594 12.2845 0.257272C10.7266 -0.105622 9.16879 -0.0653007 7.69516 0.257272C7.44254 0.297594 7.31623 0.499202 7.31623 0.70081V1.23474C7.31623 2.09575 6.74999 2.8362 5.99824 3.25599C5.95774 3.27861 5.91747 3.30159 5.87744 3.32493C5.15643 3.74527 4.26453 3.85902 3.53534 3.45302L2.93743 3.12011C2.72691 2.99914 2.47429 3.03946 2.30587 3.20075C1.29538 4.28943 0.495411 5.57973 0.0322686 7.03131C-0.051939 7.23291 0.0322686 7.47484 0.242788 7.59581L0.784376 7.8853C1.54166 8.29007 1.92694 9.13627 1.92694 9.99495C1.92694 10.8536 1.54166 11.6998 0.784375 12.1046L0.242788 12.3941C0.0322686 12.515 -0.051939 12.757 0.0322686 12.9586C0.495411 14.4102 1.29538 15.7005 2.30587 16.7891C2.47429 16.9504 2.72691 16.9907 2.93743 16.8698L3.58669 16.5227C4.29133 16.1461 5.14131 16.2457 5.8331 16.6455C5.88713 16.6767 5.94159 16.7074 5.99648 16.7375C6.75162 17.1511 7.31623 17.8941 7.31623 18.7552V19.2891C7.31623 19.4425 7.41373 19.5959 7.55309 19.696C7.64066 19.7589 7.74815 19.7843 7.85406 19.8046C9.35884 20.0925 10.8609 20.0456 12.2845 19.7729C12.5371 19.6923 12.7055 19.4907 12.7055 19.2891V18.7346C12.7055 17.8836 13.2568 17.1454 14.0002 16.7312C14.0496 16.7037 14.0988 16.6757 14.1476 16.6472C14.8377 16.2446 15.6883 16.1461 16.393 16.5227L17.0422 16.8698C17.2527 16.9907 17.5053 16.9504 17.6738 16.7891C18.7264 15.7005 19.4842 14.4102 19.9895 12.9586C20.0316 12.757 19.9474 12.515 19.7369 12.3941ZM10.0109 13.2005C8.1162 13.2005 6.64257 11.7893 6.64257 9.97478C6.64257 8.20063 8.1162 6.74905 10.0109 6.74905C11.8634 6.74905 13.3792 8.20063 13.3792 9.97478C13.3792 11.7893 11.8634 13.2005 10.0109 13.2005Z" fill="#2A7BE4"></path>
                                </svg></span></span></span></div>
            </div><small class="text-uppercase text-primary fw-bold bg-primary-subtle py-2 pe-2 ps-1 rounded-end">customize</small>
        </div>
    </a>


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