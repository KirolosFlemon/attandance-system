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
            display: block;
        }
        #preview1 {
            width: 100%;
            height: 100%;
            margin: 0px auto;
        }

        #myDIV1 {
            display: none;
        }

        #test1 {
            display: block;
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

$stmt = mysqli_query($website, "SELECT * FROM checked WHERE check_date='$date' AND user_id='$user_id' ");
$row = mysqli_fetch_assoc($stmt);
$id = $row['check_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $date = date("Y-m-d");
    $user_id = $_SESSION['user_id'];
    $check = $_POST['check'];
    $check1 = explode("=", $check)[0];
    $check2 = explode("=", $check)[1];
    $check3 = explode(" ", $check2)[0];
    $check4 = explode(" ", $check2)[1];


    if ($check1 == 'Checked-in') {

        if (!empty($row['check_in'])) {
            echo 'test';
        } else {

            $stmt_in = mysqli_query($website, "INSERT INTO checked (check_in ,check_out , check_date , user_id	)
                                                          VALUES 
                                                          ('$check4',NULL,'$check3' , '$user_id')") or die(mysqli_error($website));

            echo "<script type='text/javascript'> setTimeout(function() {window.location.href = '" . $server . "application/scan/'}, 1000)</script>";
        }


    } elseif ($check1 == 'Checked-out') {

        $stmt_out = mysqli_query($website, "UPDATE checked set
                     check_out = '$check4' WHERE check_date = '$check3' AND user_id = '$user_id'")
        or die(mysqli_error($website));
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
    <header id="header" style="margin-left: 0!important">

        <!-- NAVBAR -->
        <?php
        include '../../includes/navbar.php'
        ?>
        <!-- /NAVBAR -->

    </header>
    <!-- /HEADER -->


    <div id="wrapper_content" class="d-flex flex-fill" style="margin-left: 0!important">

        <!-- NAVBAR -->
        <?php
        //        include '../../includes/sidebar.php'
        ?>
        <!-- /NAVBAR -->

        <!-- MIDDLE -->
        <div id="middle" class="flex-fill">

            <!--PAGE TITLE -->
            <div class="page-title shadow-xs">
                <h1 class="h5 mt--10 mb--10 font-weight-normal">
                    Scanning
                    <!--                    Scanning --><?php //echo $check1 . ' / date ' . $check3 . ' /time ' . $check4; ?>
                </h1>
            </div>

            <!-- start:col: -->
            <div class="row">
            <div class="col-12 mb-3">

                <!-- start:portlet -->
                <div class="portlet">


                    <div class="portlet-body">

                            <div class="row">
                                <div class="col-6">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                                            data-target="#exampleModalLg" style="width: 100%;">
                                        Check-in
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalLg" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabelLg" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabelLg">Check-in</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span class="fi fi-close fs--18" aria-hidden="true"></span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <?php
                                                    if (!empty($row['check_in']) && empty($row['check_out'])) {
                                                        echo 'test';
                                                    } else { ?>
                                                        <div id="test">
                                                            <form novalidate action="index.php" method="post"
                                                                  class="bs-validate  p-5 py-6 rounded d-inline-block bg-white text-dark w-100 ">


                                                                <div class="input-group-over">
                                                                    <div class="form-label-group mb-3">
                                                                        <input required placeholder="Checked" id="qr"
                                                                               name="check"
                                                                               type="text" class="form-control">
                                                                        <!--                        <label for="qr">Checked</label>-->
                                                                    </div>

                                                                </div>


                                                                <div class="row">
                                                                    <div class="col-12 col-md-6 mt-4"
                                                                         style="display: block;margin: auto">
                                                                        <button type="submit"
                                                                                class="btn btn-primary btn-block transition-hover-top">
                                                                            Save
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>

                                                    <!--        Start page content-->
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 mt-4">
                                                            <div id="myDIV" style="width: 100%;">
                                                                <video id="preview"></video>

                                                                <div class="btn-group btn-group-toggle mb-5"
                                                                     data-toggle="buttons" hidden="hidden">

                                                                    <label class="btn btn-secondary">
                                                                        <input type="radio" name="options" value="2"
                                                                               autocomplete="off" checked> Back Camera
                                                                    </label>
                                                                </div>

                                                            </div>
                                                            <button class="btn btn-outline-primary btn-pill mb-1 d-block m-auto"
                                                                    id="show"
                                                                    onclick="myFunction()">
                                                                Open Camera
                                                            </button>


                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                                            data-target="#exampleModalLg">
                                        Check-out
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalLg" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabelLg" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabelLg">  Check-out</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span class="fi fi-close fs--18" aria-hidden="true"></span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <?php
                                                    if (!empty($row['check_out'])) {
                                                        echo 'test';
                                                    } else { ?>
                                                        <div id="test">
                                                            <form novalidate action="index.php" method="post"
                                                                  class="bs-validate  p-5 py-6 rounded d-inline-block bg-white text-dark w-100 ">


                                                                <div class="input-group-over">
                                                                    <div class="form-label-group mb-3">
                                                                        <input required placeholder="Checked" id="qr"
                                                                               name="check"
                                                                               type="text" class="form-control">
                                                                        <!--                        <label for="qr">Checked</label>-->
                                                                    </div>

                                                                </div>


                                                                <div class="row">
                                                                    <div class="col-12 col-md-6 mt-4"
                                                                         style="display: block;margin: auto">
                                                                        <button type="submit"
                                                                                class="btn btn-primary btn-block transition-hover-top">
                                                                            Save
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>

                                                    <!--        Start page content-->
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 mt-4">
                                                            <div id="myDIV" style="width: 100%;">
                                                                <video id="preview"></video>

                                                                <div class="btn-group btn-group-toggle mb-5"
                                                                     data-toggle="buttons" hidden="hidden">

                                                                    <label class="btn btn-secondary">
                                                                        <input type="radio" name="options" value="2"
                                                                               autocomplete="off" checked> Back Camera
                                                                    </label>
                                                                </div>

                                                            </div>
                                                            <button class="btn btn-outline-primary btn-pill mb-1 d-block m-auto"
                                                                    id="show"
                                                                    onclick="myFunction()">
                                                                Open Camera
                                                            </button>


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
                <!-- end:portlet -->

            </div>
            </div>
            <!-- end:col: -->

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
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
    </script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript">


        var scanner = new Instascan.Scanner({video: document.getElementById('preview'), scanPeriod: 5, mirror: false});
        scanner.addListener('scan', function (content) {
            alert(content);
            document.getElementById('qr').value = content;
            document.getElementById("myDIV").style.display = 'none';
            document.getElementById("test").style.display = 'block';

        });

        var scanner = new Instascan.Scanner({video: document.getElementById('preview1'), scanPeriod: 5, mirror: false});
        scanner.addListener('scan', function (content) {
            alert(content);
            document.getElementById('qr1').value = content;
            document.getElementById("myDIV1").style.display = 'none';
            document.getElementById("test1").style.display = 'block';

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
            var x1 = document.getElementById("myDIV1");
            var f = document.getElementById("test");
            var f1 = document.getElementById("test1");

            if (x.style.display === "block") {
                x.style.display = "none";
                f.style.display = "block";
                document.getElementById("show").innerHTML = "Scan Again"

            } else {
                x.style.display = "block";
                f.style.display = "none";
//                document.getElementById("show").innerHTML="Close Camera"
            }
            if (x1.style.display === "block") {
                x1.style.display = "none";
                f1.style.display = "block";
                document.getElementById("show").innerHTML = "Scan Again"

            } else {
                x1.style.display = "block";
                f1.style.display = "none";
//                document.getElementById("show").innerHTML="Close Camera"
            }

        }

    </script>
    <!--End footer script-->
</body>
</html>