
    <meta charset="UTF-8">
    <title>ADMIN</title>
    <meta name="description" content="...">

    <meta name="viewport" content="width=device-width, maximum-scale=5, initial-scale=1, user-scalable=0">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    <!-- up to 10% speed up for external res -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com/">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com/">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <!-- preloading icon font is helping to speed up a little bit -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

    <!-- non block rendering : page speed : js = polyfill for old browsers missing `preload` -->

    <?php if($_SESSION['language']=='AR'){ ?>

        <link rel="stylesheet" href="<?php echo $server?>html/SEED_PROJECT/RTL/assets/css/core.min.css">
           <link rel="stylesheet" href="<?php echo $server?>html/SEED_PROJECT/RTL/assets/css/vendor_bundle.min.css">


    <?php }else{ ?>

        <link rel="stylesheet" href="<?php echo $server?>html/html_admin/layout_1/assets/css/core.min.css">
        <link rel="stylesheet" href="<?php echo $server?>html/html_admin/layout_1/assets/css/vendor_bundle.min.css">

    <?php } ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap">

    <!-- favicon -->
    <link rel="shortcut icon" href="<?php echo $server?>html/html_admin/layout_1/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo $server?>html/html_admin/layout_1/demo.files/logo/icon_512x512.png">

    <link rel="manifest" href="<?php echo $server?>html/html_admin/layout_1/assets/images/manifest/manifest.json">
    <meta name="theme-color" content="#377dff">
