<?php
//// include config script ////
include('includes/config.php');
//// end of config script ////

//// Include Language ////
include('includes/languages/language_switch.php');

if ($_SESSION['language'] == 'EN') {
    include('includes/languages/english.php');
} else {
    include('includes/languages/arabic.php');
}
//// End Language ////

?>

<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php
    include('includes/header-script.php');
    ?>
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
</head>

<!--

    Layout Admin
        .layout-admin 	(required)

        .aside-sticky  					- sidebar : fixed and push header
        .header-sticky  				- header : always visible on top (acting as old .header-focus)


    ****************************************************************************************************

        NOTES

            1. 	LOGO TO REPLACE
                    - logo_light.svg 	: sidebar
                    - logo_dark.svg 	: header navbar

    ****************************************************************************************************


    ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++

    SCROLL TO TOP BUTTON [optional styling]

        data-s2t-disable="true"
        data-s2t-position="start|end"
        data-s2t-class="btn-secondary btn-sm" 	(default)
        data-s2t-class="btn-secondary rounded-circle"
        data-s2t-class="btn-warning rounded-circle"

    ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++ ++

-->

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['account_name'];
    $pass = $_POST['account_password'];
//    $hashedPass = sha1($pass);


    mysqli_select_db($website, $database_website);
    $stmt = mysqli_query($website, "SELECT * FROM user WHERE username = '$name' AND password = '$pass' ") or die(mysqli_error($website));
    $row = mysqli_fetch_assoc($stmt);
    $count = mysqli_num_rows($stmt);
    $_SESSION['user_id'] = $row['user_id'];
    if ($count != 0) {
        if ($row['user_perm'] == '1') {
            header("Location: application/check_in/");
        } else {
            header("Location: application/scan_in/");
        }
    } else { ?>

        <div class="hide toast-on-load"
             data-toast-type="danger"
             data-toast-title="ERROR"
             data-toast-body="please check your name or password"
             data-toast-pos="top-center"
             data-toast-delay="2000"
             data-toast-fill="true"></div>
    <?php }
}

?>

<body class="layout-admin aside-sticky header-sticky"
      data-s2t-class="btn-primary btn-sm bg-gradient-default rounded-circle b-0">

<div id="wrapper" class="d-flex align-items-stretch flex-column">


    <!--        Start page content-->

    <!-- light logo -->
    <a aria-label="go back" href="<?php echo $server ?>"
       class="position-absolute top-0 start-0 my-2 mx-4 z-index-3 h--70 d-inline-flex align-items-center">
        <img src="<?php echo $server ?>uploads/logo.jpg" width="110" alt="...">
    </a>


    <div class="d-lg-flex text-white min-h-100vh" style="background-color: transparent">

        <div class="col-12 col-lg-5 d-lg-flex">
            <div class="w-100 align-self-center">


<!--                <div class="py-7" style="color: #6d1313;">-->
                <div class="py-7" style="color: #9ccd7c;">
                    <h1 class="d-inline-block text-align-end text-center-md text-center-xs display-4 h2-xs w-100 max-w-600 w-100-md w-100-xs">
                        Sign in
                        <span class="display-3 h1-xs d-block font-weight-medium">
									Attendance
								</span>
                    </h1>
                </div>


            </div>
        </div>


        <div class="col-12 col-lg-7 d-lg-flex">
            <div class="w-100 align-self-center text-center-md text-center-xs py-2">


                <!-- optional class: .form-control-pill -->
                <form novalidate action="index.php" method="post"
                      class="bs-validate p-5 py-6 rounded d-inline-block bg-white text-dark w-100 max-w-600">

                    <div class="form-label-group mb-3">
                        <input required placeholder="Name" id="account_name" name="account_name" type="text"
                               class="form-control">
                        <label for="account_name">Name</label>
                    </div>

                    <div class="input-group-over">
                        <div class="form-label-group mb-3">
                            <input required placeholder="Password" id="account_password" name="account_password"
                                   type="password" class="form-control">
                            <label for="account_password">Password</label>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-12 col-md-6 mt-4">
                            <button type="submit" class="btn btn-primary btn-block transition-hover-top">
                                Sign In
                            </button>
                        </div>
                        <div class="col-12 col-md-6 mt-4 text-align-end text-center-xs" hidden>
                            <a href="<?php echo $server ?>admin/html/html_admin/layout_1/account-signup.html"
                               class="btn px-0">
                                Don't have an account yet?
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--           End page content-->

    <!-- /MIDDLE -->


    <!--Start footer -->
    <?php
    include('includes/footer.php');
    ?>
    <!--End footer script-->


</div>
<!-- /#wrapper -->


<!--Start footer script-->
<?php
include('includes/footer-script.php');
?>
<!--End footer script-->
</body>
</html>