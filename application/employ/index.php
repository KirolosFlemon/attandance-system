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

<style>

    div.dataTables_wrapper div.dataTables_filter input {
        width: 100% !important;
    }
</style>
<body class="layout-admin aside-sticky header-sticky"
      data-s2t-class="btn-primary btn-sm bg-gradient-default rounded-circle b-0">

<div id="wrapper" class="d-flex align-items-stretch flex-column">
    <?php
    if (isset($_GET['delete']) && !empty($_GET['delete'])) {
        $user = $_GET['delete'];
        mysqli_select_db($website, $database_website);
        $stmt_update = mysqli_query($website, "DELETE FROM checked WHERE check_id= '$user' ") or die(mysqli_error($website));
        echo "<script type='text/javascript'> setTimeout(function() {window.location.href = '" . $server . "admin/application/event/'}, 1000)</script>";

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
                            Employ
                        </h1>
                    </div>
                    <div class="col-6 text-align-end">
                        <button type="button" class="d btn btn-outline-primary btn-pill m--10" data-toggle="modal" data-target="#exampleModalMd">
                            <i class="fi fi-plus"></i>
                            Add
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalMd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelMd" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabelMd">ADD</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span class="fi fi-close fs--18" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12 col-md-6 mt--20">
                                                <a class="d btn btn-outline-primary btn-pill  float-start d-block m-auto"
                                                   href="<?php echo $server ?>application/employ/?add" style="width: 100%">
                                                    <i class="fi fi-plus"></i>
                                                    Add Person
                                                </a>
                                            </div>

                                            <div class="col-12 col-md-6 mt--20">
                                                <a class="d btn btn-outline-primary btn-pill  float-end d-block m-auto"
                                                   href="<?php echo $server ?>application/employ/add/" style="width: 100%">
                                                    <i class="fi fi-plus"></i>
                                                    Add file
                                                </a>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!--Start page content-->

            <!--Add-->

            <?php if (isset($_GET['add'])) {


                if ($_SERVER['REQUEST_METHOD'] == 'POST') {



                    // Upload Variables Avatar
//                $avatarname = $_FILES['avatar']['name'];
//                $avatarsize = $_FILES['avatar']['size'];
//                $avatartmp = $_FILES['avatar']['tmp_name'];
//                $avatartype = $_FILES['avatar']['type'];

                    //List Of Allowed File Type To Upload
//                $avatarallowedextension = array("jpeg", "jpg", "png", "gif");
                    // Get Avatar Allowed Extension
//                $avatarextension = strtolower(end(explode('.', $avatarname)));
//
//
//                if (empty($avatarname) && !in_array($avatarextension, $avatarallowedextension)) {
//                    $avatar=$_POST['avatar1'];
//                } elseif ($avatarsize > 8388608) {
//                    echo 'error size';
//                } else {
//                    $avatar = rand(0, 1000000) . '_' . $avatarname;
//                    move_uploaded_file($avatartmp, "../../../uploads/admin/event/" . $avatar);
//
//
//                }

//                $avatar = !empty($avatar) ? $avatar : $_POST['avatar1'];


                    $employ_no = $_POST['employ_no'];
                    $name = $_POST['name'];
                    $username = $_POST['username'];
                    if (!empty($_POST['password'])) {
                        $password = $_POST['password'];
                    }else{
                        $password = $_POST['old_pass'];
                    }
                    if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
                        $id = $_POST['user_id'];




//                    $avatar = !empty($avatar) ? $avatar : $_POST['avatar1'];

                        mysqli_select_db($website, $database_website);
                        $stmt_update = mysqli_query($website, "UPDATE user set
                     user_emp_id = '$employ_no' ,  
                     name = '$name' ,  
                     username = '$username',
                     password = '$password'
                      WHERE user_id = '$id' ") or die(mysqli_error($website));

                    } else {

                        $stmt_emp = mysqli_query($website, "INSERT INTO user ( user_emp_id, name , username , password)
                                                          VALUES 
                                                          ('$employ_no' , '$name' , '$username' , '$password' )") or die(mysqli_error($website));
                    };

                    echo "<script type='text/javascript'> setTimeout(function() {window.location.href = '" . $server . "application/employ/'}, 1000)</script>";

                }


                ?>

                <form novalidate class="bs-validate d-block mb-7" method="post" action="?add"
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


                                        <div class="col-12 col-md-6">
                                            <div class="form-label-group">
                                                <input required placeholder="<?php if ($_SESSION['language'] == 'EN') {
                                                    echo 'Employ No';
                                                } else {
                                                    echo 'رقم الموظف';
                                                } ?>" id="employ_no" name="employ_no" type="text" value=""
                                                       class="form-control">
                                                <label for="employ_no">
                                                    <?php if ($_SESSION['language'] == 'EN') {
                                                        echo 'Employ No';
                                                    } else {
                                                        echo 'رقم الموظف';
                                                    } ?>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-label-group">
                                                <input required placeholder="
                                            <?php if ($_SESSION['language'] == 'EN') {
                                                    echo 'Name';
                                                } else {
                                                    echo 'الاسم';
                                                } ?>" id="name" name="name" type="text" value="" class="form-control">
                                                <label for="name"><?php if ($_SESSION['language'] == 'EN') {
                                                        echo 'Full Name';
                                                    } else {
                                                        echo 'الاسم بالكامل';
                                                    } ?>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mt--20">
                                            <div class="form-label-group">
                                                <input required placeholder="<?php if ($_SESSION['language'] == 'EN') {
                                                    echo 'UserName';
                                                } else {
                                                    echo 'اسم المستخدم';
                                                } ?>" id="username" name="username" type="text" value=""
                                                       class="form-control">
                                                <label for="username">
                                                    <?php if ($_SESSION['language'] == 'EN') {
                                                        echo 'User-Name';
                                                    } else {
                                                        echo 'اسم المستخدم';
                                                    } ?>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mt--20">
                                            <div class="form-label-group">
                                                <input required placeholder="<?php if ($_SESSION['language'] == 'EN') {
                                                    echo 'Password';
                                                } else {
                                                    echo 'كلمة السر';
                                                } ?>" id="password" name="password" type="password"
                                                       class="form-control">
                                                <label for="password">
                                                    <?php if ($_SESSION['language'] == 'EN') {
                                                        echo 'Password';
                                                    } else {
                                                        echo 'كلمة السر';
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


                    <button type="submit" class="btn btn-primary">
                        <i class="fi fi-check"></i>
                        Save Changes
                    </button>

                </form>

            <?php } ?>

            <!--/Add-->


            <!--Edit-->
            <?php if (isset($_GET['edit'])) {

                $id = $_GET['user_id'];
                $stmt_edit_emp = mysqli_query($website, "SELECT * FROM user WHERE user_id ='$id' ") or die(mysqli_error($website));
                $row_edit_emp = mysqli_fetch_assoc($stmt_edit_emp);

                ?>
                <form novalidate class="bs-validate d-block mb-7" method="post" action="?add"
                      enctype="multipart/form-data">

                    <div class="row gutters-sm mb-3">


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
                                        <input hidden value="<?php echo $row_edit_emp['user_id']; ?>" name="user_id">
                                        <input hidden value="<?php echo $row_edit_emp['password']; ?>" name="old_pass">

                                        <div class="col-12 col-md-6">
                                            <div class="form-label-group">
                                                <input required placeholder="<?php if ($_SESSION['language'] == 'EN') {
                                                    echo 'Employ No';
                                                } else {
                                                    echo 'رقم الموظف';
                                                } ?>" id="employ_no" name="employ_no" type="text" value="<?php echo $row_edit_emp['user_emp_id'] ?>"
                                                       class="form-control">
                                                <label for="employ_no">
                                                    <?php if ($_SESSION['language'] == 'EN') {
                                                        echo 'Employ No';
                                                    } else {
                                                        echo 'رقم الموظف';
                                                    } ?>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-label-group">
                                                <input required placeholder="
                                            <?php if ($_SESSION['language'] == 'EN') {
                                                    echo 'Name';
                                                } else {
                                                    echo 'الاسم بالكامل';
                                                } ?>" id="name" name="name" type="text" value="<?php echo $row_edit_emp['name']?>" class="form-control">
                                                <label for="name"><?php if ($_SESSION['language'] == 'EN') {
                                                        echo 'Full Name';
                                                    } else {
                                                        echo 'الاسم بالكامل';
                                                    } ?>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mt--20">
                                            <div class="form-label-group">
                                                <input required placeholder="<?php if ($_SESSION['language'] == 'EN') {
                                                    echo 'UserName';
                                                } else {
                                                    echo 'اسم المستخدم';
                                                } ?>" id="username" name="username" type="text" value="<?php echo $row_edit_emp['username'] ?>"
                                                       class="form-control">
                                                <label for="username">
                                                    <?php if ($_SESSION['language'] == 'EN') {
                                                        echo 'User-Name';
                                                    } else {
                                                        echo 'اسم المستخدم';
                                                    } ?>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 mt--20">
                                            <div class="form-label-group">
                                                <input required placeholder="<?php if ($_SESSION['language'] == 'EN') {
                                                    echo 'Password';
                                                } else {
                                                    echo 'كلمة السر';
                                                } ?>" id="password" name="password" type="password" value="<?php echo $row_edit_emp['password'] ?>"
                                                       class="form-control">
                                                <label for="password">
                                                    <?php if ($_SESSION['language'] == 'EN') {
                                                        echo 'Password';
                                                    } else {
                                                        echo 'كلمة السر';
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

                    <div class="col-12 col-xl-12">


                    <button type="submit" class="btn btn-primary d-block m-auto">
                        <i class="fi fi-check"></i>
                        Save Editing
                    </button>
                    </div>
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

                                    $stmt_emp1 = mysqli_query($website,

                                        "SELECT * FROM user INNER JOIN  checked
                                            ON  checked.user_id = user.user_id ")
                                    or die(mysqli_error($website));

                                    $row_emp1 = mysqli_fetch_assoc($stmt_emp1);
                                    ?>
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Checked-in</th>
                                        <th>Checked-out</th>
                                        <th>Date</th>

                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (!empty($row_emp1)) {
                                        do {
                                            ?>
                                            <tr>
                                                <td><?php echo $row_emp1['user_emp_id'] ?></td>
                                                <td><?php echo $row_emp1['name'] ?></td>
                                                <td><?php echo $row_emp1['check_in'] ?></td>
                                                <td><?php echo $row_emp1['check_out'] ?></td>
                                                <td><?php echo $row_emp1['check_date'] ?></td>

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


                                                                <a class="dropdown-item text-truncate"
                                                                   href="<?php echo $server ?>application/employ/?edit&user_id=<?php echo $row_emp1['user_id'] ?>">
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
                                                                        data-href="?delete=<?php echo $row_emp1['user_id'] ?>"
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
                                        } while ($row_emp1 = mysqli_fetch_assoc($stmt_emp1));
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
    include('../../includes/footer.php');
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