<?php
// include config script ////
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

//?>

<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php
    include('../../includes/header-script.php');
    ?>
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    <style>
        #preview {
            width: 100%;
            height: 100%;
            margin: 0px auto;
        }

        #myDIV {
            display: none;
        }

        #test {
            display: none;
        }
    </style>
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
$date = date("Y-m-d");

$user_id = $_SESSION['user_id'];

$stmt_check_out = mysqli_query($website, "SELECT * FROM checked WHERE check_date = '$date' AND user_id='$user_id' ");
$row_check_out = mysqli_fetch_assoc($stmt_check_out);
$id = $row_check_out['check_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $date = date("Y-m-d");
    $user_id = $_SESSION['user_id'];
    $check = $_POST['check'];
    $check1 = explode("=", $check)[0];
    $check2 = explode("=", $check)[1];
    $check3 = explode(" ", $check2)[0];
    $check4 = explode(" ", $check2)[1];

    if ($check1 == 'Checked-out') {
        if (!empty($row_check_out['check_out'])) {
            echo '<div class="container py-6">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title">Checked-out</h5>
												<p class="card-text">
													You Are Aleardy Checked-in
												</p>
												<a href=" ' . $server . 'logout.php " class="btn btn-primary btn-soft">logout</a>
											</div>
										</div>
									</div>';
            exit();
        } else {
            $stmt_out = mysqli_query($website, "UPDATE checked set
                     check_out = '$check4' WHERE check_date = '$check3' AND user_id = '$user_id'")
            or die(mysqli_error($website));
            echo "<script type='text/javascript'> setTimeout(function() {window.location.href = '" . $server . "application/scan_out/'}, 1000)</script>";

        }

    }else{
        echo '<div class="container py-6">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title">Checked-out</h5>
												<p class="card-text">
													You should scan check-out page
												</p>
											</div>
										</div>
									</div>';
    }
}

?>
<body class="layout-admin aside-sticky header-sticky"
      data-s2t-class="btn-primary btn-sm bg-gradient-default rounded-circle b-0">

<div id="wrapper">
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
                    Scan-out
                </h1>
            </div>
            <?php
//            print_r($row);exit();
            if (!empty($row_check_out['check_in']) && empty($row_check_out['check_out'])){ ?>
                <div id="test">
                    <form novalidate action="index.php" method="post"
                          class="bs-validate  p-5 py-6 rounded d-inline-block bg-white text-dark w-100 ">


                        <div class="input-group-over">
                            <div class="form-label-group mb-3">
                                <input required placeholder="Checked" id="qr" name="check" readonly
                                       type="text" class="form-control">
                                <!--                        <label for="qr">Checked</label>-->
                                <div class="alert alert-info" id="qrDIV">Please scan-in first</div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-12 col-md-6 mt-4" style="display: block;margin: auto">
                                <button type="submit" class="btn btn-primary btn-block transition-hover-top">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


                <!--        Start page content-->
                <div class="row">
                    <div class="col-12 col-md-12 mt-4">
                        <div id="myDIV" style="width: 100%;">
                            <video id="preview"></video>

                            <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons" hidden="hidden">

                                <label class="btn btn-secondary">
                                    <input type="radio" name="options" value="2" autocomplete="off" checked> Back Camera
                                </label>
                            </div>

                        </div>
                        <button class="btn btn-outline-primary btn-pill mb-1 d-block m-auto" id="show"
                                onclick="myFunction()">
                            Open Camera
                        </button>


                    </div>
                </div>

                <?php
            }elseif (!empty($row_check_out['check_in']) && !empty($row_check_out['check_out'])) {
                echo '<div class="container py-6">
										<div class="card">
											<div class="card-body">
												<h5 class="card-title">Checked-out</h5>
												<p class="card-text">
													You Are Aleardy Checked-out
												</p>
												<a href=" ' . $server . 'logout.php " class="btn btn-primary btn-soft">logout</a>
											</div>
										</div>
									</div>';
            }
            ?>
        </div>
        <!--           End page content-->

        <!-- /MIDDLE -->


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
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=">
    </script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript">


        var scanner = new Instascan.Scanner({video: document.getElementById('preview'), scanPeriod: 5, mirror: false});
        scanner.addListener('scan', function (content) {
            alert(content);
            document.getElementById('qr').value = content;
            document.getElementById('qrDIV').innerHTML = content;
            document.getElementById("myDIV").style.display = 'none';
            document.getElementById("test").style.display = 'block';

        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[1]);
            } else {
                console.error('No cameras found.');
                alert('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
            alert(e);
        });
    </script>

    <script>
        function myFunction() {
            var x = document.getElementById("myDIV");
            var f = document.getElementById("test");

            if (x.style.display === "block") {
                x.style.display = "none";
                f.style.display = "block";
                document.getElementById("show").innerHTML = "Scan Again"

            } else {
                x.style.display = "block";
                f.style.display = "none";
//                document.getElementById("show").innerHTML="Close Camera"
            }

        }

    </script>
    <!--End footer script-->
</body>
</html>