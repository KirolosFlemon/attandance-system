<!-- SIDEBAR
        Example gradients:
            .aside-primary
            .bg-gradient-default
            .bg-gradient-purple
            etc * Footer should also match -->
<aside id="aside-main"
       class="aside-start aside-primary font-weight-light aside-hide-xs d-flex flex-column h-auto">


    <!--LOGO visibility : desktop only -->
    <div class="d-block">
        <div class="clearfix d-flex justify-content-between">

            <!-- Logo : height: 60px max -->
            <a class="w-100 align-self-center navbar-brand p-3"
               style="color: #ffffff;font-weight: bold;font-size: xx-large ">
                Dashboard
            </a>

        </div>
    </div>
    <!-- /LOGO -->


    <div class="aside-wrapper scrollable-vertical scrollable-styled-light align-self-baseline h-100 w-100">

        <!--

            All parent open navs are closed on click!
            To ignore this feature, add .js-ignore to .nav-deep

            Links height (paddings):
                .nav-deep-xs
                .nav-deep-sm
                .nav-deep-md  	(default, ununsed class)

            .nav-deep-hover 	hover background slightly different
            .nav-deep-bordered	bordered links


            ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            IMPORTANT NOTE:
                Curently using ajax navigation!
                remove .js-ajax class to have regular links!
            ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        -->
        <nav class="nav-deep nav-deep-dark nav-deep-hover fs--15 pb-5">
            <ul class="nav flex-column">
                <?php
                $user_id = $_SESSION['user_id'];

                mysqli_select_db($website, $database_website);
                $stmt_user = mysqli_query($website, "SELECT * FROM user WHERE user_id ='$user_id' ") or die(mysqli_error($website));
                $row_user = mysqli_fetch_assoc($stmt_user);
                if ($row_user['user_perm'] == '1') {


                $httpCheck = (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") ? 'http://' : 'https://';
                $host = $httpCheck . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                //                $host = parse_url($server, PHP_URL_HOST);
                ?>
                <li class="nav-item <?php echo ($host == $server . 'application/check_in/') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo $server ?>application/check_in">
                        <i class="fas fa-barcode"></i>
                        <b>check-in</b>
                    </a>
                </li>

            </ul>

            <ul class="nav flex-column">

                <li class="nav-item <?php echo ($host == $server . 'application/check_out/') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo $server ?>application/check_out">
                        <i class="fas fa-barcode"></i>
                        <b>check-out</b>
                    </a>
                </li>

                <li class="nav-item <?php echo ($host == $server . 'application/employ/') ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?php echo $server ?>application/employ">
                        <i class="fas fa-users"></i>
                        <b>Employ</b>
                    </a>
                </li>

            </ul>
            <?php
            }
            ?>

            <ul class="nav flex-column">
                <?php
//                $user_id = $_SESSION['user_id'];
//
//                mysqli_select_db($website, $database_website);
//                $stmt = mysqli_query($website, "SELECT * FROM user WHERE user_id ='$user_id' ") or die(mysqli_error($website));
//                $row = mysqli_fetch_assoc($stmt);
                if ($row_user['user_perm'] == '2') {
                    ?>

                    <li class="nav-item <?php echo ($host == $server . 'application/scan_in/') ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?php echo $server ?>application/scan_in">
                            <i class="fas fa-qrcode"></i>
                            <b>scan-in</b>
                        </a>
                    </li>

                    <li class="nav-item <?php echo ($host == $server . 'application/scan_out/') ? 'active' : ''; ?>">
                        <a class="nav-link" href="<?php echo $server ?>application/scan_out">
                            <i class="fas fa-qrcode"></i>
                            <b>scan-out</b>
                        </a>
                    </li>

                    <?php
                }
                ?>

            </ul>


        </nav>

    </div>
</aside>
<!-- /SIDEBAR -->
