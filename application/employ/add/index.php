<?php
//// include config script ////
include('../../../includes/config.php');
//// end of config script ////

//// Include Language ////
include('../../../includes/languages/language_switch.php');

if ($_SESSION['language'] == 'AR') {
    include('../../../includes/languages/arabic.php');
} else {
    include('../../../includes/languages/english.php');
}
//// End Language ////

?>

<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php
    include('../../../includes/header-script.php');
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

    $filename = $_FILES["file"]["name"];

// The nested array to hold all the arrays
    $the_big_array = [];

// Open the file for reading
    if (($h = fopen("{$filename}", "r")) !== FALSE) {
        // Each line in the file is converted into an individual array that we call $data
        // The items of the array are comma separated
        while (($data = fgetcsv($h, 1000, ",")) !== FALSE) {

            // Each individual array is being pushed into the nested array
            $the_big_array[] = $data;
            $sql = "INSERT into user (user_emp_id,name,username,password) values('$data[0]','$data[1]','$data[2]','$data[3]')";
            mysqli_query($website, $sql);
        }

        // Close the file
        fclose($h);

    }
    echo "<script type='text/javascript'> setTimeout(function() {window.location.href = '" . $server . "application/employ/'}, 1000)</script>";

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
        include '../../../includes/navbar.php'
        ?>
        <!-- /NAVBAR -->

    </header>
    <!-- /HEADER -->


    <div id="wrapper_content" class="d-flex flex-fill">

        <!-- NAVBAR -->
        <?php
        include '../../../includes/sidebar.php'
        ?>
        <!-- /NAVBAR -->

        <!-- MIDDLE -->
        <div id="middle" class="flex-fill">

            <!--PAGE TITLE -->
            <div class="page-title shadow-xs">
                <div class="row">
                    <div class="col-6">

                        <h1 class="h2 mt--10 mb--10  font-weight-normal">
                            Add csv-file
                        </h1>
                    </div>
                </div>
                    <!--Start page content-->
                    <form novalidate class="bs-validate d-block mb-7" method="post" action="index.php"
                          enctype="multipart/form-data">

                        <div class="row gutters-sm mb-3">

                            <div class="col-12 col-xl-12 mb-3">

                                <!-- portlet -->
                                <div class="portlet">

                                    <!-- portlet : header -->
                                    <div class="portlet-header">
										<span class="d-block text-dark text-truncate font-weight-medium">
											Add
										</span>
                                    </div>
                                    <!-- /portlet : header -->


                                    <!-- portlet : body -->
                                    <div class="portlet-body">

                                        <div class="row gutters-sm d-flex align-items-center">
                                            <div class="col-12 col-md-12">

                                                <div class="input-group">
                                                    <div class="custom-file custom-file-primary">

                                                        <!--

                                                            Params for single file
                                                                data-file-ext="jpg, png, gif, mp3"  										file extendion allowed
                                                                data-file-max-size-kb-per-file="100"  										size per file in Kb
                                                                data-file-ext-err-msg="Allowed:"  											file extension error message (default: "Allowed:" )
                                                                data-file-size-err-item-msg="File too large!" 								file too large error message (default: "File too large!")
                                                                data-file-toast-position="bottom-center" 									toastr error position
                                                                data-file-preview-container=".js-file-input-preview-single-container"  	container preview (id or class)
                                                                data-file-preview-img-height="120"  										image preview height in pixels (default: 120)
                                                                data-file-preview-show-info="true"  										true = display image name and size in Kb (default: false)
                                                                data-file-btn-clear="a.js-file-upload-clear" 								clear button (id or class)

                                                            Optional - customize preview item container:
                                                                data-file-preview-class="shadow-md m-2 rounded" 							(default: "shadow-md m-2 rounded")


                                                            AJAX TRANSFORM : JUST ADD:

                                                                    data-file-ajax-upload-enable="true"
                                                                    data-file-ajax-upload-url="../../html_frontend/demo.files/php/demo.ajax_file_upload.php"
                                                                    data-file-ajax-upload-params="['action','upload']['param2','value2']"

                                                                    data-file-ajax-delete-enable="true"
                                                                    data-file-ajax-delete-url="../../html_frontend/demo.files/php/demo.ajax_file_upload.php"
                                                                    data-file-ajax-delete-params="['action','delete_file']"

                                                                    data-file-ajax-toast-success-txt="Successfully Uploaded!"
                                                                    data-file-ajax-toast-error-txt="One or more files not uploaded!"

                                                        -->
                                                        <input name="file"
                                                               type="file" style="width: 100%"

                                                               data-file-ext="csv, docx, pdf, excel"
                                                               data-file-max-size-kb-per-file="100000"
                                                               data-file-ext-err-msg="Allowed:"
                                                               data-file-size-err-item-msg="File too large!"
                                                               data-file-size-err-total-msg="Total allowed size exceeded!"
                                                               data-file-toast-position="bottom-center"
                                                               data-file-preview-container=".js-file-input-preview-single-container2"
                                                               data-file-preview-img-height="auto"
                                                               data-file-preview-show-info="true"
                                                               data-file-btn-clear="a.js-file-upload-clear2"

                                                               class="custom-file-input"
                                                               id="inputGroupFile02">

                                                        <label class="custom-file-label" for="inputGroupFile02">Choose
                                                            file</label>

                                                    </div>
                                                </div>


                                                <div class="js-file-input-preview-single-container2 ml--n6 mr--n6 mt-4 hide-empty">
                                                    <!-- preview container --></div>

                                                <!--
                                                    clear files button
                                                    hidden by default
                                                -->
                                                <div class="mt-1">
                                                    <a href="#" class="hide js-file-upload-clear2 btn btn-light btn-sm">
                                                        Remove Image
                                                    </a>
                                                </div>


                                            </div>
                                        </div>

                                    </div>

                                    <!-- /portlet : body -->

                                </div>
                                <!-- /portlet -->

                            </div>
                            <div class="col-12">

                                <button type="submit" class="btn btn-primary d-block m-auto">
                                    <i class="fi fi-check"></i>
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
                    <!--           End page content-->

                </div>
                <!-- /MIDDLE -->

            </div>

        </div>
    </div>
    <!--Start footer -->
    <?php
    include('../../../includes/footer.php');
    ?>
    <!--End footer script-->


    <!-- /#wrapper -->


    <!--Start footer script-->
    <?php
    include('../../../includes/footer-script.php');
    ?>
    <!--End footer script-->
</body>
</html>