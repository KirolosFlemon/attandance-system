<?php
//if(!isset($_SERVER['HTTP_REFERER'])){
//    // redirect them to your desired location
//    header('location:'.$server.'admin/');
//    exit;
//}
$user_id = $_SESSION['user_id'];

mysqli_select_db($website, $database_website);
$stmt = mysqli_query($website, "SELECT * FROM user WHERE user_id ='$user_id' ") or die(mysqli_error($website));
$row = mysqli_fetch_assoc($stmt);
?>
<!-- NAVBAR -->
<div class="container-fluid position-relative">

    <nav class="navbar navbar-expand-lg navbar-light justify-content-lg-between justify-content-md-inherit h--70">

        <div class="align-items-start">

            <!--
                sidebar toggler
            -->
            <a href="<?php echo $server ?>html_admin/layout_1/#aside-main"
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
            <a class="navbar-brand d-inline-block d-lg-none"
               href="<?php echo $server ?>uploads/logo.png">
                <img src="<?php echo $server ?>uploads/logo.png" width="110"
                     height="60" alt="...">
            </a>


        </div>


        <!-- NAVIGATION -->
        <div class="collapse navbar-collapse" id="navbarMainNav">


            <!-- MOBILE MENU NAVBAR -->
            <div class="navbar-xs d-none">

                <!-- mobile menu button : close -->
                <button class="navbar-toggler pt-0" type="button" data-toggle="collapse"
                        data-target="#navbarMainNav" aria-controls="navbarMainNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <svg width="20" viewBox="0 0 20 20">
                        <path d="M 20.7895 0.977 L 19.3752 -0.4364 L 10.081 8.8522 L 0.7869 -0.4364 L -0.6274 0.977 L 8.6668 10.2656 L -0.6274 19.5542 L 0.7869 20.9676 L 10.081 11.679 L 19.3752 20.9676 L 20.7895 19.5542 L 11.4953 10.2656 L 20.7895 0.977 Z"></path>
                    </svg>
                </button>

                <!--
                    Optional Mobile Menu Logo
                    Logo : height: 70px max
                -->
                <a class="navbar-brand px-4 w-auto" href="<?php echo $server ?>uploads/logo.png">
                    <img src="<?php echo $server ?>uploads/logo.png"
                         width="110"
                         height="70" alt="...">
                </a>

            </div>
            <!-- /MOBILE MENU NAVBAR -->


            <!-- Dropdowns -->
            <ul class="navbar-nav align-items-center">

                <!--  -->
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false" id="mainNavHome">
                        Shortcuts
                    </a>

                    <ul class="dropdown-menu dropdown-menu-clean" aria-labelledby="mainNavHome">

                        <li class="dropdown-item dropdown">
                            <a class="dropdown-link" href="#!" data-toggle="dropdown">
                                <i class="fi fi-cart-1"></i>
                                Orders
                            </a>

                            <ul class="dropdown-menu dropdown-menu-hover shadow-lg b-0 m-0">
                                <li class="dropdown-item">
                                    <a class="dropdown-link" href="#!">
                                        <i class="fi fi-plus"></i>
                                        Create Order
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a class="dropdown-link" href="#!">
                                        <i class="fi fi-list-checked"></i>
                                        List Orders
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a class="dropdown-link" href="#!">
                                        <i class="fi fi-box"></i>
                                        Archived Orders
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a class="dropdown-link" href="#!">
                                        <i class="fi fi-close"></i>
                                        Canceled Orders
                                    </a>
                                </li>
                            </ul>

                        </li>
                        <li class="dropdown-item">
                            <a class="dropdown-link" href="#!">
                                <i class="fi fi-user-plus"></i>
                                Create Account
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a class="dropdown-link" href="#!">
                                <i class="fi fi-users"></i>
                                Manage Users
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a class="dropdown-link" href="#!">
                                <i class="fi fi-graph"></i>
                                Reports
                            </a>
                        </li>
                        <li class="dropdown-item">
                            <a class="dropdown-link" href="#!">
                                <i class="fi fi-task-list"></i>
                                Tasks
                            </a>
                        </li>
                    </ul>

                </li>

                <li class="nav-item dropdown dropdown-mega">

                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false" id="mainMegaNav">
                        Mega
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="mainMegaNav">
                        <li class="dropdown-item bg-transparent">

                            <!--
                                for 5 columns:
                                .col-md-5th   -instead of-   .col-md-3
                            -->
                            <div class="row col-border-md">

                                <div class="col-12 col-md-3">

                                    <h3 class="h6 text-muted text-uppercase fs--14 mb-3">ACCOUNT OPTIONS</h3>
                                    <ul>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 1</a>
                                        </li>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 2</a>
                                        </li>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 3</a>
                                        </li>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 4</a>
                                        </li>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 5</a>
                                        </li>

                                    </ul>

                                </div>

                                <div class="col-12 col-md-3">

                                    <h3 class="h6 text-muted text-uppercase fs--14 mb-3">ECOMMERCE SETTINGS</h3>
                                    <ul>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 1</a>
                                        </li>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 2</a>
                                        </li>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 3</a>
                                        </li>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 4</a>
                                        </li>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 5</a>
                                        </li>

                                    </ul>

                                </div>

                                <div class="col-12 col-md-3">

                                    <h3 class="h6 text-muted text-uppercase fs--14 mb-3">QUICK TOOLS</h3>
                                    <ul>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 1</a>
                                        </li>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 2</a>
                                        </li>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 3</a>
                                        </li>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 4</a>
                                        </li>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 5</a>
                                        </li>

                                    </ul>

                                </div>

                                <div class="col-12 col-md-3">

                                    <h3 class="h6 text-muted text-uppercase fs--14 mb-3">ACCOUNT OPTIONS</h3>
                                    <ul>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 1</a>
                                        </li>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 2</a>
                                        </li>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 3</a>
                                        </li>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 4</a>
                                        </li>

                                        <li class="dropdown-item">
                                            <a class="dropdown-link" href="#!">Option 5</a>
                                        </li>

                                    </ul>

                                </div>

                            </div>

                        </li>
                    </ul>

                </li>


                <!--  -->
                <li class="nav-item">

                    <a class="nav-link px-1" href="#!">
										<span class="py-2 px-3 rounded">
											<i class="fi fi-squared-dots"></i>
											<span>Apps</span>
										</span>
                    </a>

                </li>


            </ul>
            <!-- /Dropdowns -->

        </div>
        <!-- /NAVIGATION -->


        <!-- OPTIONS -->
        <ul class="list-inline list-unstyled mb-0 d-flex align-items-end">

            <!-- notifications -->
            <?php /*
            <li class="list-inline-item ml--6 mr--6 dropdown">

                <a href="#" id="dropdownNotificationOptions"
                   class="btn btn-sm rounded-circle btn-light dropdown-toggle" data-toggle="dropdown"
                   aria-expanded="false" aria-haspopup="true">

                    <!-- badge -->
                    <span class="badge badge-danger fs--10 p--3 mt--n3 position-absolute end-0">2</span>

                    <span class="group-icon">
										<i class="fi fi-bell-full"></i>
                        <!-- <i class="fi fi-bell-full-active"></i> -->
										<i class="fi fi-close"></i>
									</span>

                </a>

                <div aria-labelledby="dropdownNotificationOptions"
                     class="dropdown-menu dropdown-menu-clean dropdown-menu-navbar-autopos dropdown-menu-invert dropdown-click-ignore p-0 mt--18 fs--15 w--300">

                    <div class="dropdown-header fs--14 py-3">

                        2 UNREAD NOTIFICATIONS

                    </div>

                    <div class="dropdown-divider"></div>

                    <div class="max-h-50vh scrollable-vertical">

                        <!-- NOTIFICATION -->
                        <a href="#!"
                           class="clearfix dropdown-item font-weight-medium p-3 border-bottom border-light overflow-hidden shadow-md-hover bg-theme-color-light">

                            <!-- badge -->
                            <span class="badge badge-success float-end font-weight-normal mt-1">new</span>

                            <!-- icon -->
                            <i class="fi fi-cart-1 d-middle float-start fs--20 bg-light w--40 h--40 rounded-circle text-center"></i>

                            <!-- NOTIFICATION -->
                            <p class="fs--14 m-0 text-truncate font-weight-normal">
                                2 new orders
                            </p>

                            <!-- date -->
                            <small class="d-block fs--11 text-muted">
                                Oct 22, 2019 / 02:21:46pm
                            </small>

                        </a>
                        <!-- /NOTIFICATION -->


                        <!-- NOTIFICATION -->
                        <a href="#!"
                           class="clearfix dropdown-item font-weight-medium p-3 border-bottom border-light overflow-hidden shadow-md-hover bg-theme-color-light">

                            <!-- badge -->
                            <span class="badge badge-success float-end font-weight-normal mt-1">new</span>
                            <span class="badge badge-danger float-end font-weight-normal mt-1">urgent</span>

                            <!-- icon -->
                            <i class="fi fi-round-close d-middle text-danger float-start fs--20 bg-light w--40 h--40 rounded-circle text-center"></i>

                            <!-- NOTIFICATION -->
                            <p class="fs--14 m-0 text-truncate font-weight-normal">
                                CRM API update required!
                            </p>

                            <!-- date -->
                            <small class="d-block fs--11 text-muted">
                                Oct 22, 2019 / 02:21:46pm
                            </small>

                        </a>
                        <!-- /NOTIFICATION -->


                        <!-- NOTIFICATION -->
                        <a href="#!"
                           class="clearfix dropdown-item font-weight-medium p-3 border-bottom border-light overflow-hidden shadow-md-hover">

                            <!-- badge -->
                            <span class="badge badge-warning float-end font-weight-normal mt-1">system</span>

                            <!-- icon -->
                            <i class="fi fi-shield-ok d-middle text-success float-start fs--20 bg-light w--40 h--40 rounded-circle text-center"></i>

                            <!-- NOTIFICATION -->
                            <p class="fs--14 m-0 text-truncate font-weight-normal">
                                AI self repair success!
                            </p>

                            <!-- date -->
                            <small class="d-block fs--11 text-muted">
                                Oct 22, 2019 / 02:21:46pm
                            </small>

                        </a>
                        <!-- /NOTIFICATION -->


                        <!-- NOTIFICATION -->
                        <a href="#!"
                           class="clearfix dropdown-item font-weight-medium p-3 border-bottom border-light overflow-hidden shadow-md-hover">

                            <!-- icon -->
                            <i class="fi fi-check d-middle text-success float-start fs--18 bg-light w--40 h--40 rounded-circle text-center"></i>

                            <!-- NOTIFICATION -->
                            <p class="fs--14 m-0 text-truncate font-weight-normal">
                                Not really a heaven but good!
                            </p>

                            <!-- date -->
                            <small class="d-block fs--11 text-muted">
                                Oct 22, 2019 / 02:21:46pm
                            </small>

                        </a>
                        <!-- /NOTIFICATION -->


                        <!-- NOTIFICATION -->
                        <a href="#!"
                           class="clearfix dropdown-item font-weight-medium p-3 border-bottom border-light overflow-hidden shadow-md-hover">

                            <!-- icon -->
                            <i class="fi fi-close d-middle text-danger float-start fs--18 bg-light w--40 h--40 rounded-circle text-center"></i>

                            <!-- NOTIFICATION -->
                            <p class="fs--14 m-0 text-truncate font-weight-normal">
                                Not the end of the world!
                            </p>

                            <!-- date -->
                            <small class="d-block fs--11 text-muted">
                                Oct 22, 2019 / 02:21:46pm
                            </small>

                        </a>
                        <!-- /NOTIFICATION -->


                        <!-- NOTIFICATION -->
                        <a href="#!"
                           class="clearfix dropdown-item font-weight-medium p-3 border-bottom border-light overflow-hidden shadow-md-hover">

                            <!-- icon -->
                            <i class="fi fi-check d-middle text-white float-start fs--18 bg-success w--40 h--40 rounded-circle text-center"></i>

                            <!-- NOTIFICATION -->
                            <p class="fs--14 m-0 text-truncate font-weight-normal">
                                This is good! Very good!
                            </p>

                            <!-- date -->
                            <small class="d-block fs--11 text-muted">
                                Oct 22, 2019 / 02:21:46pm
                            </small>

                        </a>
                        <!-- /NOTIFICATION -->


                        <!-- NOTIFICATION -->
                        <a href="#!"
                           class="clearfix dropdown-item font-weight-medium p-3 border-bottom border-light overflow-hidden shadow-md-hover">

                            <!-- icon -->
                            <i class="fi fi-close d-middle text-white float-start fs--18 bg-danger w--40 h--40 rounded-circle text-center"></i>

                            <!-- NOTIFICATION -->
                            <p class="fs--14 m-0 text-truncate font-weight-normal">
                                The end of the world is here!
                            </p>

                            <!-- date -->
                            <small class="d-block fs--11 text-muted">
                                Oct 22, 2019 / 02:21:46pm
                            </small>

                        </a>
                        <!-- /NOTIFICATION -->


                        <!-- NOTIFICATION -->
                        <a href="#!"
                           class="clearfix dropdown-item font-weight-medium p-3 border-bottom border-light overflow-hidden shadow-md-hover">

                            <!-- icon -->
                            <i class="fi fi-user-male d-middle float-start fs--18 bg-light w--40 h--40 rounded-circle text-center"></i>

                            <!-- NOTIFICATION -->
                            <p class="fs--14 m-0 text-truncate font-weight-normal">
                                A Spartan joined the team!
                            </p>

                            <!-- date -->
                            <small class="d-block fs--11 text-muted">
                                Oct 22, 2019 / 02:21:46pm
                            </small>

                        </a>
                        <!-- /NOTIFICATION -->


                        <!-- NOTIFICATION -->
                        <a href="#!"
                           class="clearfix dropdown-item font-weight-medium p-3 border-bottom border-light overflow-hidden shadow-md-hover">

                            <!-- icon -->
                            <i class="fi fi-user-female d-middle float-start fs--18 bg-light w--40 h--40 rounded-circle text-center"></i>

                            <!-- NOTIFICATION -->
                            <p class="fs--14 m-0 text-truncate font-weight-normal">
                                Pssst! We have girls in our team!
                            </p>

                            <!-- date -->
                            <small class="d-block fs--11 text-muted">
                                Oct 22, 2019 / 02:21:46pm
                            </small>

                        </a>
                        <!-- /NOTIFICATION -->


                        <!-- NOTIFICATION -->
                        <a href="#!"
                           class="clearfix dropdown-item font-weight-medium p-3 border-bottom border-light overflow-hidden shadow-md-hover">

                            <!-- icon -->
                            <i class="fi fi-star text-warning d-middle float-start fs--18 bg-light w--40 h--40 rounded-circle text-center"></i>

                            <!-- NOTIFICATION -->
                            <p class="fs--14 m-0 text-truncate font-weight-normal">
                                This is something good?
                            </p>

                            <!-- date -->
                            <small class="d-block fs--11 text-muted">
                                Oct 22, 2019 / 02:21:46pm
                            </small>

                        </a>
                        <!-- /NOTIFICATION -->


                        <!-- NOTIFICATION -->
                        <a href="#!"
                           class="clearfix dropdown-item font-weight-medium p-3 border-bottom border-light overflow-hidden shadow-md-hover">

                            <!-- icon -->
                            <i class="fi fi-star-full text-warning d-middle float-start fs--18 bg-light w--40 h--40 rounded-circle text-center"></i>

                            <!-- NOTIFICATION -->
                            <p class="fs--14 m-0 text-truncate font-weight-normal">
                                Or maybe this?
                            </p>

                            <!-- date -->
                            <small class="d-block fs--11 text-muted">
                                Oct 22, 2019 / 02:21:46pm
                            </small>

                        </a>
                        <!-- /NOTIFICATION -->


                        <!-- NOTIFICATION -->
                        <a href="#!"
                           class="clearfix dropdown-item font-weight-medium p-3 border-bottom border-light overflow-hidden shadow-md-hover">

                            <!-- icon -->
                            <i class="fi fi-round-info-full text-muted d-middle float-start fs--18 bg-light w--40 h--40 rounded-circle text-center"></i>

                            <!-- NOTIFICATION -->
                            <p class="fs--14 m-0 text-truncate font-weight-normal">
                                Simple short information...
                            </p>

                            <!-- date -->
                            <small class="d-block fs--11 text-muted">
                                Oct 22, 2019 / 02:21:46pm
                            </small>

                        </a>
                        <!-- /NOTIFICATION -->


                        <!-- NOTIFICATION -->
                        <a href="#!"
                           class="clearfix dropdown-item font-weight-medium p-3 border-bottom border-light overflow-hidden shadow-md-hover">

                            <!-- icon -->
                            <i class="fi fi-database text-muted d-middle float-start fs--18 bg-light w--40 h--40 rounded-circle text-center"></i>

                            <!-- NOTIFICATION -->
                            <p class="fs--14 m-0 text-truncate font-weight-normal">
                                Database related
                            </p>

                            <!-- date -->
                            <small class="d-block fs--11 text-muted">
                                Oct 22, 2019 / 02:21:46pm
                            </small>

                        </a>
                        <!-- /NOTIFICATION -->


                        <!-- NOTIFICATION -->
                        <a href="#!"
                           class="clearfix dropdown-item font-weight-medium p-3 border-bottom border-light overflow-hidden shadow-md-hover">

                            <!-- icon -->
                            <i class="fi fi-chat text-muted d-middle float-start fs--18 bg-light w--40 h--40 rounded-circle text-center"></i>

                            <!-- NOTIFICATION -->
                            <p class="fs--14 m-0 text-truncate font-weight-normal">
                                Customer chat lost...
                            </p>

                            <!-- date -->
                            <small class="d-block fs--11 text-muted">
                                Oct 22, 2019 / 02:21:46pm
                            </small>

                        </a>
                        <!-- /NOTIFICATION -->


                        <!-- NOTIFICATION -->
                        <a href="#!"
                           class="clearfix dropdown-item font-weight-medium p-3 border-bottom border-light overflow-hidden shadow-md-hover">

                            <!-- icon -->
                            <i class="fi fi-hourglass text-muted d-middle float-start fs--18 bg-light w--40 h--40 rounded-circle text-center"></i>

                            <!-- NOTIFICATION -->
                            <p class="fs--14 m-0 text-truncate font-weight-normal">
                                Pending approval
                            </p>

                            <!-- date -->
                            <small class="d-block fs--11 text-muted">
                                Oct 22, 2019 / 02:21:46pm
                            </small>

                        </a>
                        <!-- /NOTIFICATION -->


                        <!-- NOTIFICATION -->
                        <a href="#!"
                           class="clearfix dropdown-item font-weight-medium p-3 border-bottom border-light overflow-hidden shadow-md-hover">

                            <!-- icon -->
                            <i class="fi fi-shape-abstract-dots text-muted d-middle float-start fs--18 bg-light w--40 h--40 rounded-circle text-center"></i>

                            <!-- NOTIFICATION -->
                            <p class="fs--14 m-0 text-truncate font-weight-normal">
                                Various notifications...
                            </p>

                            <!-- date -->
                            <small class="d-block fs--11 text-muted">
                                Oct 22, 2019 / 02:21:46pm
                            </small>

                        </a>
                        <!-- /NOTIFICATION -->


                        <!-- NOTIFICATION -->
                        <a href="https://wrapbootstrap.com/theme/smarty-website-admin-rtl-WB02DSN1B"
                           target="wrapbootstrap"
                           class="clearfix dropdown-item font-weight-medium px-3 rounded overflow-hidden shadow-md-hover">

                            <!-- badge -->
                            <span class="badge badge-pink float-end font-weight-normal mt-1">{wrapbootstrap}</span>

                            <!-- icon -->
                            <i class="fi fi-emoji-evil text-pink d-middle float-start fs--18 bg-light w--40 h--40 rounded-circle text-center"></i>

                            <!-- NOTIFICATION -->
                            <p class="fs--14 m-0 text-truncate font-weight-normal">
                                THIS IS
                                <del>Spar..</del>
                                Smarty!
                            </p>

                            <!-- date -->
                            <small class="d-block fs--11 text-muted">
                                Oct 22, 2019 / 02:21:46pm
                            </small>

                        </a>
                        <!-- /NOTIFICATION -->


                    </div>

                    <div class="dropdown-divider mb-0"></div>

                    <a href="#!"
                       class="prefix-icon-ignore dropdown-footer dropdown-custom-ignore font-weight-medium pt-3 pb-3">
                        <i class="fi fi-arrow-end fs--11"></i>
                        <span class="d-inline-block pl-2 pr-2">View all</span>
                    </a>
                </div>

            </li>
            */ ?>

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
                    <span class="fs--14 d-none d-sm-inline-block font-weight-medium">
                        <?php
                            echo $row['username'];
                        ?>
                    </span>
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
                        <div class="w--60 h--60 rounded-circle bg-light bg-cover float-start"
                             style="background-image:url('<?php echo $server ?>uploads/logo.png');width: 100%"></div>

                        <!-- initials - no image -->
                        <!--
                        <div data-initials="John Doe" data-assign-color="true" class="sow-util-initials bg-light rounded h5 w--60 h--60 d-inline-flex justify-content-center align-items-center rounded-circle float-start">
                            <i class="fi fi-circle-spin fi-spin"></i>
                        </div>
                        -->

                        <!-- user detail -->
                        <span class="d-block font-weight-medium text-truncate fs--16">
                                 <?php echo $row['username'];?>
                        </span>
                        <span class="d-block text-muted font-weight-medium text-truncate"><?php echo $row['email']?></span>
                        <small class="d-block text-muted" hidden="hidden"><b>Phone:</b><?php echo $row['mobile']?></small>

                    </div>

                    <div class="dropdown-divider"></div>

                    <a href="#!" class="dropdown-item text-truncate font-weight-medium">
                        Account Settings
                        <small class="d-block text-muted">profile, password and more...</small>
                    </a>

                    <a href="#!" class="dropdown-item text-truncate font-weight-medium">
                        Upgrade
                        <small class="d-block text-muted">upgrade your account</small>
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


    <!-- TOP NAVIGATION TOGGLER -->
    <button class="navbar-toggler shadow-xs h-auto w-auto m-0 btn btn-sm bg-white rounded-circle position-absolute end-0 mt-1 mb-1 ml-2 mr-2 z-index-2 d-none d-inline-block d-lg-none"
            type="button" data-toggle="collapse" data-target="#navbarMainNav" aria-controls="navbarMainNav"
            aria-expanded="false" aria-label="Toggle navigation">
        <i class="fi fi-bars"></i>
    </button>
    <!-- /TOP NAVIGATION TOGGLER -->

</div>
<!-- /NAVBAR -->