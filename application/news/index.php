<?php
//// include config script ////
include('../../../includes/config.php');
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
<body class="layout-admin aside-sticky header-sticky"
      data-s2t-class="btn-primary btn-sm bg-gradient-default rounded-circle b-0">

<div id="wrapper" class="d-flex align-items-stretch flex-column">
    <?php
    if (isset($_GET['delete']) &&!empty($_GET['delete'])) {
        $news = $_GET['delete'];
        mysqli_select_db($website, $database_website);
        $stmt_update = mysqli_query($website, "DELETE FROM news WHERE news_id= '$news' ") or die(mysqli_error($website));
        echo "<script type='text/javascript'> setTimeout(function() {window.location.href = '".$server."admin/application/news/'}, 1000)</script>";

    }

    ?>

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
                <div class="row">
                <div class="col-6">

                <h1 class="h2 mt--10 mb--10  font-weight-normal">
                    News
                </h1>
                </div>
                    <div class="col-6 text-align-end">
                        <a class="d btn btn-outline-primary btn-pill m--10" href="<?php echo $server?>admin/application/news/?add">
                            <i class="fi fi-plus"></i>
                            Add
                        </a>
                    </div>
                </div>
            </div>

            <!--        Start page content-->
            <!--Add-->

            <?php if (isset($_GET['add'])) {


            if ($_SERVER['REQUEST_METHOD'] == 'POST') {


                // Upload Variables Avatar
                $avatarname = $_FILES['avatar']['name'];
                $avatarsize = $_FILES['avatar']['size'];
                $avatartmp = $_FILES['avatar']['tmp_name'];
                $avatartype = $_FILES['avatar']['type'];

                //List Of Allowed File Type To Upload
                $avatarallowedextension = array("jpeg", "jpg", "png", "gif");
                // Get Avatar Allowed Extension
                $avatarextension = strtolower(end(explode('.', $avatarname)));


                if (empty($avatarname) && !in_array($avatarextension, $avatarallowedextension)) {
                    $avatar=$_POST['avatar1'];
                } elseif ($avatarsize > 8388608) {
                    echo 'error size';
                } else {
                    $avatar = rand(0, 1000000) . '_' . $avatarname;
                    move_uploaded_file($avatartmp, "../../../uploads/admin/news/" . $avatar);


                }

                $avatar = !empty($avatar) ? $avatar : $_POST['avatar1'];


                $news_title_en = $_POST['news_title_en'];
                $news_title_ar = $_POST['news_title_ar'];
                $news_description_en = $_POST['news_description_en'];
                $news_description_ar = $_POST['news_description_ar'];
                $company_id = $_POST['company_id'];
                $date=date("Y-m-d H:i:s",time());

                if (isset($_POST['news_id']) && !empty($_POST['news_id'])) {
                    $id = $_POST['news_id'];


                    $avatar = !empty($avatar)?$avatar:'male.png';

                    mysqli_select_db($website, $database_website);
                    $stmt = mysqli_query($website, "UPDATE news set
                     news_title_en = '$news_title_en' ,  
                     news_title_ar = '$news_title_ar' ,  
                      news_description_en = '$news_description_en',
                      news_description_ar = '$news_description_ar',
                      company_id = '$company_id' ,
                      news_date= '$date',
                      news_photo= '$avatar'
                      WHERE news_id = '$id' ") or die(mysqli_error($website));

                } else {

                $stmt = mysqli_query($website, "INSERT INTO news ( news_title_en, news_title_ar, news_description_en , news_description_ar ,news_photo,news_date ,company_id )
                                                          VALUES 
                                                          ('$news_title_en','$news_title_ar','$news_description_en','$news_description_ar','$avatar','$date','$company_id' )") or die(mysqli_error($website));
                $row = mysqli_fetch_assoc($stmt);
                }
                echo "<script type='text/javascript'> setTimeout(function() {window.location.href = '".$server."admin/application/news/'}, 1000)</script>";

            }


            ?>

            <form novalidate class="bs-validate d-block mb-7" method="post" action="?add" enctype="multipart/form-data">

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

                                    <div class="col-12 col-md-6">

                                        <div class="form-label-group">
                                            <input required placeholder="News Title in English" id="news_title_en" name="news_title_en" type="text" value="" class="form-control">
                                            <label for="news_title_en">News Title  in English</label>
                                        </div>

                                    </div>

                                    <div class="col-12 col-md-6">

                                        <div class="form-label-group">
                                            <input required placeholder="News Title in Arabic" id="news_title_ar" name="news_title_ar" type="text" value="" class="form-control">
                                            <label for="news_title_ar">News Title  in Arabic</label>
                                        </div>

                                    </div>

                                    <div class="col-12 col-md-12 mt--20">
                                        <div class="form-label-group ">
                                            <select required id="select_options" class="form-control bs-select" name="company_id" title="Choose Company">
                                                <?php
                                                $stmt_campany = mysqli_query($website, "SELECT * FROM product_company ") or die(mysqli_error($website));
                                                $row_campany= mysqli_fetch_assoc($stmt_campany);
                                                do {
                                                    ?>
                                                    <option value="<?php echo $row_campany['company_id'] ?>"><?php echo $row_campany['company'] ?></option>
                                                    <?php
                                                }while ($row_campany= mysqli_fetch_assoc($stmt_campany));
                                                ?>
                                            </select>
                                            <label for="select_options" hidden>Choose Company</label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-12 mt--20">

                                        <div class="form-label-group mb-3">
                                            <textarea required placeholder="News Description in English" id="news_description_en" name="news_description_en"class="form-control" rows="3"></textarea>
                                            <label for="news_description_en">News Description in English</label>
                                        </div>
                                    </div>


                                    <div class="col-12 col-md-12 mt--20">

                                        <div class="form-label-group mb-3">
                                            <textarea required placeholder="News Description in Arabic" id="news_description_ar" name="news_description_ar"class="form-control" rows="3"></textarea>
                                            <label for="news_description_ar">News Description in Arabic</label>
                                        </div>
                                    </div>


                                    <div class="col-12 col-md-12 mt--20">


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
                                                <input 	name="avatar" required
                                                          type="file"

                                                          data-file-ext="jpg, png, gif, mp3"
                                                          data-file-max-size-kb-per-file="30000"
                                                          data-file-ext-err-msg="Allowed:"
                                                          data-file-size-err-item-msg="File too large!"
                                                          data-file-size-err-total-msg="Total allowed size exceeded!"
                                                          data-file-toast-position="bottom-center"
                                                          data-file-preview-container=".js-file-input-preview-single-container2"
                                                          data-file-preview-img-height="40"
                                                          data-file-preview-show-info="false"
                                                          data-file-btn-clear="a.js-ajax_file_upload"

                                                          class="custom-file-input"
                                                          id="inputGroupFile02">

                                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>

                                            </div>
                                        </div>


                                        <div class="js-file-input-preview-single-container2 ml--n6 mr--n6 mt-4 hide-empty"><!-- preview container --></div>

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

                            </div>
                            <!-- /portlet : body -->

                        </div>
                        <!-- /portlet -->

                    </div>


                <button type="submit" class="btn btn-primary">
                    <i class="fi fi-check"></i>
                    Save Changes
                </button>

            </form>

            <?php } ?>

<!--/Add-->


<!--Edit-->
            <?php if (isset($_GET['edit'])) {

            $id = $_GET['news_id'];

            mysqli_select_db($website, $database_website);
            $stmt_news = mysqli_query($website, "SELECT * FROM news WHERE news_id ='$id' ") or die(mysqli_error($website));
            $row_news = mysqli_fetch_assoc($stmt_news);

            ?>
            <form novalidate class="bs-validate d-block mb-7" method="post" action="?add" enctype="multipart/form-data">

                <div class="row gutters-sm mb-3">

                    <div class="col-12 col-xl-12 mb-3">

                        <!-- portlet -->
                        <div class="portlet">

                            <!-- portlet : header -->
                            <div class="portlet-header">
										<span class="d-block text-dark text-truncate font-weight-medium">
											Edit
										</span>
                            </div>
                            <!-- /portlet : header -->


                            <!-- portlet : body -->
                            <div class="portlet-body">

                                <div class="row gutters-sm d-flex align-items-center">

                                    <div class="col-12 col-md-6">
                                        <div class="form-label-group">
                                            <input required placeholder="News Title in English" id="news_title_en" name="news_title_en" type="text" value="<?php echo $row_news['news_title_en']?>" class="form-control">
                                            <label for="news_title_en">News Title in English</label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="form-label-group">
                                            <input required placeholder="News Title  in Arabic" id="news_title_ar" name="news_title_ar" type="text" value="<?php echo $row_news['news_title_ar']?>" class="form-control">
                                            <label for="news_title_ar">News Title in Arabic</label>
                                        </div>
                                    </div>

                                    <input hidden value="<?php echo $row_news['news_id']; ?>" name="news_id">

                                    <div class="col-12 col-md-12 mt--20">
                                        <div class="form-label-group ">
                                            <select id="select_options" class="form-control bs-select" name="company_id" title="Choose Company">
                                                <?php
                                                $stmt_campany = mysqli_query($website, "SELECT * FROM product_company ") or die(mysqli_error($website));
                                                $row_campany= mysqli_fetch_assoc($stmt_campany);
                                                do {
                                                    ?>
                                                    <option value="<?php echo $row_campany['company_id'] ?>" <?php echo ($row_campany['company_id']==$row_news['company_id'])?'selected':'';?>><?php echo $row_campany['company'] ?></option>
                                                    <?php
                                                }while ($row_campany= mysqli_fetch_assoc($stmt_campany));
                                                ?>
                                            </select>
                                            <label for="select_options" ><?php echo $vSelect;?></label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-12 mt--20">
                                        <div class="form-label-group mb-3">
                                            <textarea required placeholder="News Description in English" id="news_description_en" name="news_description_en"class="form-control" rows="3"> <?php echo $row_news['news_description_en']?></textarea>
                                            <label for="news_description_en">News Description in English</label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-12 mt--20">
                                        <div class="form-label-group mb-3">
                                            <textarea required placeholder="News Description in Arabic" id="news_description_ar" name="news_description_ar"class="form-control" rows="3"> <?php echo $row_news['news_description_ar']?></textarea>
                                            <label for="news_description_ar">News Description in Arabic</label>
                                        </div>
                                    </div>


                                    <div class="col-12 col-md-12 mt--20">


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
                                                <input 	name="avatar"
                                                          type="file"
                                                          data-file-ext="jpg, png, gif, mp3"
                                                          data-file-max-size-kb-per-file="30000"
                                                          data-file-ext-err-msg="Allowed:"
                                                          data-file-size-err-item-msg="File too large!"
                                                          data-file-size-err-total-msg="Total allowed size exceeded!"
                                                          data-file-toast-position="bottom-center"
                                                          data-file-preview-container=".js-file-input-preview-single-container2"
                                                          data-file-preview-img-height="40"
                                                          data-file-preview-show-info="true"
                                                          data-file-btn-clear="a.js-file-upload-clear2"

                                                          class="custom-file-input"
                                                          id="inputGroupFile02">

                                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>

                                            </div>
                                        </div>


                                        <div class="js-file-input-preview-single-container2  ml--n6 mr--n6 mt-4 hide-empty"><img src="../../../uploads/admin/news/<?php echo $row_news['news_photo']?>"width='100' height='100'  ><!-- preview container --></div>

                                        <!--
                                            clear files button
                                            hidden by default
                                        -->
                                        <div class="mt-1">
                                            <a href="#" class="hide js-file-upload-clear2  btn btn-light btn-sm">
                                                Remove Image
                                            </a>
                                        </div>


                                    </div>


                                    <div class="col-12 col-md-12 mt--20" hidden="hidden">


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
                                                <input 	name="avatar1"
                                                          type="text" value="<?php echo $row_news['news_photo']?> ">

                                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>

                                            </div>
                                        </div>


                                        <div class="js-file-input-preview-single-container2  ml--n6 mr--n6 mt-4 hide-empty"><img src="../../../uploads/admin/news/<?php echo $row_news['news_photo']?>"width='100' height='100'  ><!-- preview container --></div>

                                        <!--
                                            clear files button
                                            hidden by default
                                        -->
                                        <div class="mt-1">
                                            <a href="#" class="hide js-file-upload-clear2  btn btn-light btn-sm">
                                                Remove Image
                                            </a>
                                        </div>


                                    </div>

                                </div>

                            </div>

                        </div>
                        <!-- /portlet : body -->

                    </div>
                    <!-- /portlet -->

                </div>


                <button type="submit" class="btn btn-primary">
                    <i class="fi fi-check"></i>
                    Save Editing
                </button>

            </form>
            <?php } ?>

            <!-- start:row -->
                <div class="row gutters-sm">

                    <!-- start:col: -->
                    <div class="col-12 mb-3">

                        <!-- start:portlet -->
                        <div class="portlet">
                            <div class="portlet-body">
                                <div class="container py-2">

                                    <!--

                                        data-autofill="false|hover|click"
                                        data-enable-paging="true" 			false = show all, no pagination
                                        data-items-per-page="10|15|30|50|100"

                                    -->
                                    <table class="table-datatable table table-bordered table-hover table-striped"
                                           data-lng-empty="No data available in table"
                                           data-lng-page-info="Showing _START_ to _END_ of _TOTAL_ entries"
                                           data-lng-filtered="(filtered from _MAX_ total entries)"
                                           data-lng-loading="Loading..."
                                           data-lng-processing="Processing..."
                                           data-lng-search="Search..."
                                           data-lng-norecords="No matching records found"
                                           data-lng-sort-ascending=": activate to sort column ascending"
                                           data-lng-sort-descending=": activate to sort column descending"

                                           data-lng-column-visibility="Column Visibility"
                                           data-lng-csv="CSV"
                                           data-lng-pdf="PDF"
                                           data-lng-xls="XLS"
                                           data-lng-copy="Copy"
                                           data-lng-print="Print"
                                           data-lng-all="All"

                                           data-main-search="true"
                                           data-column-search="false"
                                           data-row-reorder="false"
                                           data-col-reorder="true"
                                           data-responsive="true"
                                           data-header-fixed="true"
                                           data-select-onclick="false"
                                           data-enable-paging="true"
                                           data-enable-col-sorting="true"
                                           data-autofill="false"
                                           data-group="false"
                                           data-items-per-page="10"

                                           data-lng-export="<i class='fi fi-squared-dots fs--18 line-height-1'></i>"
                                           dara-export-pdf-disable-mobile="true"
                                           data-export='["csv", "pdf", "xls"]'
                                           data-options='["copy", "print"]'
                                    >
                                        <?php

                                        $stmt = mysqli_query($website,

                                            "SELECT * FROM news INNER JOIN  product_company
                                            ON  news.company_id = product_company.company_id ")
                                        or die(mysqli_error($website));

                                        $row_news1 = mysqli_fetch_assoc($stmt);
                                        ?>
                                        <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Company</th>
                                            <th>Tittle</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (!empty($row_news1)){
                                        do{
                                        ?>
                                        <tr>
                                            <td><img src='<?php echo $server ?>uploads/admin/news/<?php echo $row_news1['news_photo']?>' width='50' height='50' ></td>

                                            <td><?php echo $row_news1['company']; ?></td>
                                            <td><?php if ($_SESSION['language'] == 'EN'){
                                                    echo $row_news1['news_title_en'];
                                                }else{
                                                    echo $row_news1['news_title_ar'];
                                                }
                                                ?>
                                            </td>
                                            <td><?php if ($_SESSION['language'] == 'EN'){
                                                    echo $row_news1['news_description_en'];
                                                }else{
                                                    echo $row_news1['news_description_ar'];
                                                     }
                                                ?>
                                            </td>
                                            <td><?php echo $row_news1['news_date']; ?></td>
                                            <td class="text-align-end">

                                                    <div class="clearfix">
                                                        <!-- using .dropdown, autowidth not working -->

                                                        <a href="#" class="btn btn-sm btn-light rounded-circle"
                                                           data-toggle="dropdown" aria-expanded="false"
                                                           aria-haspopup="true">
																		<span class="group-icon">
																			<i class="fi fi-dots-vertical-full"></i>
																			<i class="fi fi-close"></i>
																		</span>
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-clean dropdown-click-ignore max-w-220">

                                                            <div class="scrollable-vertical max-h-50vh">


                                                                <a class="dropdown-item text-truncate" href="<?php echo $server?>admin/application/news/?edit&news_id=<?php echo $row_news1['news_id'] ?>">
                                                                    <i class="fi fi-pencil"></i>
                                                                    Edit
                                                                </a>

                                                                <!--

                                                                    The request is sent by ajax to data-href="..."
                                                                    To change to regular submit, change:
                                                                        data-ajax-confirm-mode="regular" 	(or simply remove this param)

                                                                -->
                                                                <a
                                                                        class="dropdown-item text-truncate js-ajax-confirm"
                                                                        data-href="?delete=<?php echo $row_news1['news_id'] ?>"
                                                                        data-ajax-confirm-method="GET"
                                                                        data-ajax-confirm-mode=""
                                                                        data-ajax-confirm-size="modal-md"
                                                                        data-ajax-confirm-centered="false"
                                                                        data-ajax-confirm-callback-function=""
                                                                        data-ajax-confirm-title="Please Confirm"
                                                                        data-ajax-confirm-body="Are you sure? Delete this Account?"
                                                                        data-ajax-confirm-btn-yes-text="Confirm"
                                                                        data-ajax-confirm-btn-yes-class="btn-sm btn-danger"
                                                                        data-ajax-confirm-btn-yes-icon="fi fi-check"
                                                                        data-ajax-confirm-btn-no-text="Cancel"
                                                                        data-ajax-confirm-btn-no-class="btn-sm btn-light"
                                                                        data-ajax-confirm-btn-no-icon="fi fi-close">
                                                                    <i class="fi fi-thrash text-danger"></i>
                                                                    Delete
                                                                </a>


                                                            </div>

                                                        </div>

                                                    </div>

                                                </td>


                                        </tr>
                                            <?php
                                        } while ($row_news1 = mysqli_fetch_assoc($stmt));
                                        }
                                        ?>

                                        </tbody>

                                    </table>

                                </div>
                            </div>

                        </div>
                        <!-- end:portlet -->

                    </div>
                    <!-- end:col: -->

                </div>
                <!-- end:row: -->

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