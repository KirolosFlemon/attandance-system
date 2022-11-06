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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

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
$date = date("Y-m-d H:i:s");
$title = 'Checked-in';


$user_id = $_SESSION['user_id'];
$date1 = date("Y-m-d");

$stmt = mysqli_query($website, "SELECT * FROM checked WHERE check_date='$date1' AND user_id='$user_id' ");
$row = mysqli_fetch_assoc($stmt);

if (isset($row['check_in']) && !empty($row['check_in'])) {
    echo '<div class="container py-6">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title">Checked-in</h5>
												<p class="card-text">
													You Are Aleardy Checked-in
												</p>
												<a href=" ' . $server . 'application/scan_out/ " class="btn btn-primary btn-soft">Go to Check-out</a>
											</div>
										</div>
									</div>';
} else {

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
        <div id="middle" class="flex-fill">

            <!--PAGE TITLE -->
            <div class="page-title shadow-xs">
                <h1 class="h5 mt--10 mb--10 font-weight-normal">
                    Check-in
                </h1>
            </div>

            <!--        Start page content-->
            <div class="row clearfix" id="refresh">

                <div class="col-lg-12">
                    <img id='barcode' style="display: block;margin: auto"
                         src="https://api.qrserver.com/v1/create-qr-code/?data=Checked-in=<?php echo $date ?>&amp;size=500x500"
                         alt=""
                         title="<?php echo $title; ?>"
                         width="300"
                         height="300">
                </div>

            </div>

            <!--           End page content-->

        </div>
        <!-- /MIDDLE -->

    </div>
    <?php
    }
    ?>

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
<script>
    var auto_refresh = setInterval(
        function () {
            $('#refresh').load('code.php');
        }, 60000);
</script>

<!--End footer script-->
</body>
</html>