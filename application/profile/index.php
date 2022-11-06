<?php
//// include config script ////
include('../../includes/config.php');
//// end of config script ////

//// Include Language ////
include('../../includes/languages/language_switch.php');

if ($_SESSION['language'] == 'AR') {
    include('../../includes/languages/arabic.php');
} else {
    include('../../includes/languages/english.php');
}
//// End Language ////


?>


<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php
    include('../../includes/header-script.php');
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


    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
    }else{
        $password = $_POST['old_pass'];
    }

    $id = $_SESSION['user_id'];

    $stmt_update = mysqli_query($website, "UPDATE user set password = '$password' WHERE user_id = '$id' ") or die(mysqli_error($website));
    ?>
    <div class="hide toast-on-load"
         data-toast-type="success"
         data-toast-title="Password Changed"
         data-toast-body="Your password has been changed"
         data-toast-pos="top-center"
         data-toast-delay="5000"
         data-toast-fill="true"
    ></div>
<?php
    echo "<script type='text/javascript'> setTimeout(function() {window.location.href = '" . $server . "logout.php'}, 1000)</script>";

}


?>
<body class="layout-admin aside-sticky header-sticky"
      data-s2t-class="btn-primary btn-sm bg-gradient-default rounded-circle b-0">

<div id="wrapper" class="d-flex align-items-stretch flex-column">


    <!--
        HEADER

        .header-match-aside-primary
    -->
    <header id="header">

        <!-- NAVBAR -->
        <?php
        include '../../includes/navbar.php'
        ?>
        <!-- /NAVBAR -->

    </header>
    <!-- /HEADER -->


    <div id="wrapper_content" class="d-flex flex-fill">

        <!-- NAVBAR -->
        <?php
        include '../../includes/sidebar.php'
        ?>
        <!-- /NAVBAR -->

        <!-- MIDDLE -->
        <div id="middle" class="flex-fill" style="padding-top: 10px !important;">

            <!--PAGE TITLE -->
            <div class="page-title shadow-xs">

                <h1 class="h5 mt--10 mb--10 font-weight-normal">
                    Profile
                </h1>

            </div>

            <!--        Start page content-->
            <form novalidate class="bs-validate d-block mb-7" method="post" action="index.php"
                  enctype="multipart/form-data">

                <div class="row gutters-sm mb-3">

                    <div class="col-12 col-xl-12 mb-3">

                        <!-- portlet -->
                        <div class="portlet">

                            <!-- portlet : header -->
                            <div class="portlet-header">
										<span class="d-block text-dark text-truncate font-weight-medium">
											Change Your Password
										</span>
                            </div>
                            <!-- /portlet : header -->


                            <!-- portlet : body -->
                            <div class="portlet-body">

                                <div class="row gutters-sm d-flex align-items-center">
                                    <?php
                                    $id = $_SESSION['user_id'];
                                    $stmt_emp = mysqli_query($website, "SELECT * FROM user WHERE user_id ='$id' ") or die(mysqli_error($website));
                                    $row_emp = mysqli_fetch_assoc($stmt_emp);

                                    ?>
                                    <div class="col-12 col-md-12">
                                        <div class="form-label-group">
                                            <input readonly required placeholder="<?php if ($_SESSION['language'] == 'EN') {
                                                echo 'Your Password Now is:';
                                            } else {
                                                echo 'رقمك السرى الحالى:';
                                            } ?>" id="employ_no" name="old_pass" type="text" value="<?php echo $row_emp['password']?>"
                                                   class="form-control">
                                            <label for="Name">
                                                <?php if ($_SESSION['language'] == 'EN') {
                                                    echo 'Your Password Now is :';
                                                } else {
                                                    echo 'رقمك السرى الحالى:';
                                                } ?>
                                            </label>
                                        </div>
                                    </div>


                                    <div class="col-12 col-md-12 mt--20">
                                        <div class="form-label-group">
                                            <input placeholder="<?php if ($_SESSION['language'] == 'EN') {
                                                echo 'Your New Password is :';
                                            } else {
                                                echo 'كلمة السرالجديدة';
                                            } ?>" id="password" name="password" type="password"
                                                   class="form-control">
                                            <label for="password">
                                                <?php if ($_SESSION['language'] == 'EN') {
                                                    echo 'Your New Password is :';
                                                } else {
                                                    echo 'كلمة السر الجديدة';
                                                } ?>
                                            </label>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <!-- /portlet : body -->

                    </div>
                    <!-- /portlet -->

                </div>

                <button type="submit" class="btn btn-primary d-block m-auto" >
                    <i class="fi fi-check"></i>
                    Save Changes
                </button>

            </form>

            <!--           End page content-->

        </div>
        <!-- /MIDDLE -->

    </div>


    <!--Start footer -->
    <?php
//    include('../../includes/footer.php');
    ?>
    <!--End footer script-->


</div>
<!-- /#wrapper -->


<!--Start footer script-->
<?php
include('../../includes/footer-script.php');
?>

<!--End footer script-->
</body>
</html>