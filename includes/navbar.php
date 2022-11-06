
<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    // redirect them to your desired location
    header('location:' . $server);
    exit;
}
$user_id = $_SESSION['user_id'];

mysqli_select_db($website, $database_website);
$stmt_user = mysqli_query($website, "SELECT * FROM user WHERE user_id ='$user_id' ") or die(mysqli_error($website));
$row_user = mysqli_fetch_assoc($stmt_user);
////?>

<!-- NAVBAR -->
<div class="container-fluid position-relative">

    <nav class="navbar navbar-expand-lg navbar-light justify-content-lg-between justify-content-md-inherit h--70">

        <div class="align-items-start">

            <!--
                sidebar toggler
            -->
            <a href="#aside-main"
               class="btn-sidebar-toggle h-100 d-inline-block d-lg-none justify-content-center align-items-center p-2">
								<span class="group-icon">
									<i>
										<svg width="25" viewBox="0 0 20 20">
											<path d="M 19.9876 1.998 L -0.0108 1.998 L -0.0108 -0.0019 L 19.9876 -0.0019 L 19.9876 1.998 Z"></path>
											<path d="M 19.9876 7.9979 L -0.0108 7.9979 L -0.0108 5.9979 L 19.9876 5.9979 L 19.9876 7.9979 Z"></path>
											<path d="M 19.9876 13.9977 L -0.0108 13.9977 L -0.0108 11.9978 L 19.9876 11.9978 L 19.9876 13.9977 Z"></path>
											<path d="M 19.9876 19.9976 L -0.0108 19.9976 L -0.0108 17.9976 L 19.9876 17.9976 L 19.9876 19.9976 Z"></path>
										</svg>
									</i>

									<i>
										<svg width="25" viewBox="0 0 47.971 47.971">
											<path d="M28.228,23.986L47.092,5.122c1.172-1.171,1.172-3.071,0-4.242c-1.172-1.172-3.07-1.172-4.242,0L23.986,19.744L5.121,0.88c-1.172-1.172-3.07-1.172-4.242,0c-1.172,1.171-1.172,3.071,0,4.242l18.865,18.864L0.879,42.85c-1.172,1.171-1.172,3.071,0,4.242C1.465,47.677,2.233,47.97,3,47.97s1.535-0.293,2.121-0.879l18.865-18.864L42.85,47.091c0.586,0.586,1.354,0.879,2.121,0.879s1.535-0.293,2.121-0.879c1.172-1.171,1.172-3.071,0-4.242L28.228,23.986z"/>
										</svg>
									</i>
								</span>
            </a>


            <!--
                Logo : height: 60px max
                visibility : mobile only
            -->
            <!--            <a class="navbar-brand aside-width border border-light bb--0 bt--0 b--0-xs h-100 d-lg-flex align-lg-items-center"-->
            <!--               href="--><?php //echo $server ?><!--application/dashboard/" >-->
            <!--            -->
            <a class="navbar-brand aside-width border border-light bb--0 bt--0 b--0-xs h-100 d-lg-flex align-lg-items-center">
                <img src="<?php echo $server ?>uploads/logo.jpg" width="200" height="60" alt="...">
            </a>


        </div>


        <!-- OPTIONS -->
        <ul class="list-inline list-unstyled mb-0 d-flex align-items-end">


            <li class="list-inline-item mx-1 dropdown">

                <?php if ($_SESSION['language'] == 'AR') { ?>

                    <a href="<?php echo $english_link ?>"
                       class="btn-sow-search-toggler btn btn-sm rounded-circle btn-primary btn-soft-static">
                        <i class="flag flag-us" style="right: 11px;"></i>

                    </a>
                <?php } else { ?>
                    <a href="<?php echo $arabic_link ?>"
                       class="btn-sow-search-toggler btn btn-sm rounded-circle btn-primary btn-soft-static">
                        <i class="flag flag-eg" style="left: 11px;"></i>
                    </a>

                <?php } ?>

            </li>


            <!-- account -->
            <li class="list-inline-item ml--6 mr--6 dropdown">

                <a href="#" id="dropdownAccountOptions"
                   class="btn btn-sm btn-light dropdown-toggle btn-pill pl--12 pr--12" data-toggle="dropdown"
                   aria-expanded="false" aria-haspopup="true">

									<span class="group-icon m-0">
										<!-- <i class="fi fi-user-female"></i> -->
										<i class="fi w--15 fi-user-male"></i>
										<i class="fi w--15 fi-close"></i>
									</span>

                    <span class="fs--14 d-none d-sm-inline-block font-weight-medium"><?php echo $row_user['name'];?></span>
                </a>


                <!--

                    Dropdown Classes
                        .dropdown-menu-dark 		- dark dropdown (desktop only, will be white on mobile)
                        .dropdown-menu-hover 		- open on hover
                        .dropdown-menu-clean 		- no background color on hover
                        .dropdown-menu-invert 		- open dropdown in oposite direction (left|right, according to RTL|LTR)
                        .dropdown-click-ignore 		- keep dropdown open on inside click (useful on forms inside dropdown)

                        Dropdown prefix icon (optional, if enabled in variables.scss)
                            .prefix-link-icon .prefix-icon-dot 		- link prefix
                            .prefix-link-icon .prefix-icon-line 	- link prefix
                            .prefix-link-icon .prefix-icon-ico 		- link prefix
                            .prefix-link-icon .prefix-icon-arrow 	- link prefix

                            .prefix-icon-ignore 					- ignore, do not use on a specific link

                -->
                <div aria-labelledby="dropdownAccountOptions"
                     class="prefix-link-icon prefix-icon-dot dropdown-menu dropdown-menu-clean dropdown-menu-navbar-autopos dropdown-menu-invert dropdown-click-ignore p-0 mt--18 fs--15 w--300">

                    <div class="dropdown-header fs--14 py-4">

                        <!-- profile image -->
                        <div class="row">
                            <div class="col-6 col-md-6">
                                <div class="w--60  rounded-circle bg-light bg-cover " style="background-image:url('<?php echo $server ?>uploads/logo.jpg');width: 100%;height: 100%;background-repeat:no-repeat!important;background-size:contain!important;">
                                </div>
                                <!-- initials - no image -->
                            </div>
                            <div class="col-6 col-md-6">

                                <!-- user detail -->
                                <span class="d-block font-weight-medium text-truncate fs--16 m-auto ">
                                 Name :<?php echo $row_user['name']; ?>
                        </span>
                            </div>
                        </div>

                    </div>

                    <div class="dropdown-divider"></div>

                    <a href="<?php echo $server ?>application/profile/"
                       class="prefix-icon-ignore dropdown-footer dropdown-custom-ignore font-weight-medium pt-3 pb-3">
                        <i class="fa fa-user"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider mb-0"></div>

                    <a href="<?php echo $server ?>logout.php"
                       class="prefix-icon-ignore dropdown-footer dropdown-custom-ignore font-weight-medium pt-3 pb-3">
                        <i class="fi fi-power float-start"></i>
                        Log Out
                    </a>
                </div>

            </li>

        </ul>
        <!-- /OPTIONS -->


    </nav>


</div>
<!-- /NAVBAR -->
