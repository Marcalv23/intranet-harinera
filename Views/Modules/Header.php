<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Harinera de oriente</title>

    <link rel="apple-touch-icon" sizes="180x180" href="Views/Resources/assets/img/favicons/harinera-de-oriente.png">
    <link rel="icon" type="image/png" sizes="32x32" href="Views/Resources/assets/img/favicons/harinera-de-oriente.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Views/Resources/assets/img/favicons/harinera-de-oriente.png">
    <link rel="shortcut icon" type="image/x-icon" href="Views/Resources/assets/img/favicons/harinera-de-oriente.png">
    <link rel="manifest" href="Views/Resources/assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="Views/Resources/assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="Views/Resources/assets/js/config.js"></script>
    <script src="Views/Resources/vendors/simplebar/simplebar.min.js"></script>

    <link href="Views/Resources/vendors/glightbox/glightbox.min.css" rel="stylesheet">
    <link href="Views/Resources/vendors/leaflet/leaflet.css" rel="stylesheet">
    <link href="Views/Resources/vendors/leaflet.markercluster/MarkerCluster.css" rel="stylesheet">
    <link href="Views/Resources/vendors/leaflet.markercluster/MarkerCluster.Default.css" rel="stylesheet">
    <link href="Views/Resources/vendors/flatpickr/flatpickr.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="Views/Resources/vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link href="Views/Resources/assets/css/theme-rtl.css" rel="stylesheet" id="style-rtl">
    <link href="Views/Resources/assets/css/theme.css" rel="stylesheet" id="style-default">
    <link href="Views/Resources/assets/css/user-rtl.css" rel="stylesheet" id="user-style-rtl">
    <link href="Views/Resources/assets/css/user.css" rel="stylesheet" id="user-style-default">
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