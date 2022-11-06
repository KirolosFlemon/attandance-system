<!-- SIDEBAR
        Example gradients:
            .aside-primary
            .bg-gradient-default
            .bg-gradient-purple
            etc * Footer should also match -->
<aside id="aside-main"
       class="aside-start aside-primary font-weight-light aside-hide-xs d-flex flex-column h-auto">


    <!--
        LOGO
        visibility : desktop only
    -->
    <div class="d-none d-sm-block">
        <div class="clearfix d-flex justify-content-between">

            <!-- Logo : height: 60px max -->
            <a class="w-100 align-self-center navbar-brand p-3" href="<?php echo $server?>html_admin/layout_1/index.html">
                <img src="<?php echo $server?>html_admin/layout_1/assets/images/logo/logo_light.svg" width="110" height="60" alt="...">
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

                <li class="nav-item active">
                    <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/index.html">
                        <i class="fi fi-menu-dots"></i>
                        <b>Dashboard</b>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="#">
										<span class="group-icon float-end">
											<i class="fi fi-arrow-end-slim"></i>
											<i class="fi fi-arrow-down-slim"></i>
										</span>
                        <i class="fi fi-code"></i>
                        <span class="badge badge-warning float-end fs--11 mt-1">new</span>
                        Components
                    </a>

                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-alerts.html">
                                Alerts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-accordions.html">
                                Accordions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-badges.html">
                                Badges
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-breadcrumbs.html">
                                Breadcrumbs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-buttons.html">
                                Buttons
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-cards.html">
                                Cards
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-carousel.html">
                                Carousel
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-collapse.html">
                                Collapse
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-dropdowns.html">
                                Dropdowns
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-forms.html">
                                Forms
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-icons.html">
                                Icons
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-lists.html">
                                Lists
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-media.html">
                                Media
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-modals.html">
                                Modals
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-navs.html">
                                Navs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-navigation.html">
                                Navigation
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-pagination.html">
                                Pagination
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-progress.html">
                                Progress
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-popover.html">
                                Popover
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-scrollspy.html">
                                Scrollspy
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-spinners.html">
                                Spinners
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-tabs.html">
                                Tabs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-tables.html">
                                Tables
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-timeline.html">
                                Timeline
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-thumbnails.html">
                                Thumbnails
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-tooltip.html">
                                Tooltip
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-typography.html">
                                Typography
                            </a>
                        </li>

                    </ul>


                <li class="nav-item">
                    <a class="nav-link" href="#">
											<span class="group-icon float-end">
												<i class="fi fi-arrow-end-slim"></i>
												<i class="fi fi-arrow-down-slim"></i>
											</span>
                        <i class="fi fi-shape-3dots"></i>
                        Utilities
                    </a>

                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/util-text-backgrounds.html">
                                Text &amp; Backgrouns
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/util-borders.html">
                                Borders
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/util-shadows.html">
                                Box Shadows
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/util-font.html">
                                Font Size / Weight
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/util-width-height.html">
                                Width / Height
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/util-padding-margin.html">
                                Paddings / Margins
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/util-transition.html">
                                Transitions / Transforms
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/util-position.html">
                                Position
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/util-visibility.html">
                                Visibility
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/util-overlays.html">
                                Overlays &amp; Opacity
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/util-scroll.html">
                                Scroll &amp; Scrollbar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/util-misc.html">
                                Miscellaneous
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/util-responsive.html">
                                Responsive
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/util-rtl.html">
                                RTL
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="#">
											<span class="group-icon float-end">
												<i class="fi fi-arrow-end-slim"></i>
												<i class="fi fi-arrow-down-slim"></i>
											</span>
                        <i class="fi fi-mollecules"></i>
                        SOW : Core Plugins
                    </a>

                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-search-suggest.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">9Kb</span>
                                SOW : Search Suggest
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-ajax-navigation.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">10Kb</span>
                                SOW : Ajax : Navigation
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-ajax-forms.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">4Kb</span>
                                SOW : Ajax : Forms
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-ajax-content.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">4Kb</span>
                                SOW : Ajax : Content
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-ajax-modal.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">3Kb</span>
                                SOW : Ajax : Modals
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-ajax-confirm.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">6Kb</span>
                                SOW : Ajax : Confirm
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-ajax-select.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">4.5Kb</span>
                                SOW : Ajax : Select
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-form-validation.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">2Kb</span>
                                SOW : Form Validation
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-form-advanced.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">7Kb</span>
                                SOW : Form Advanced
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-file-upload.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">24Kb</span>
                                SOW : File Upload
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-checkall.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">1Kb</span>
                                SOW : Check All
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-toasts.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">4Kb</span>
                                SOW : Toasts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-gdpr.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">2Kb</span>
                                SOW : GDPR Cookies
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-inline-search.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">1Kb</span>
                                SOW : Inline Search
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-dropdown.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">3Kb</span>
                                SOW : Dropdowns
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-deep-navigation.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">2Kb</span>
                                SOW : Deep Navigation
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-btn-toggle.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">2.5Kb</span>
                                SOW : Button Toggle
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-scroll-to.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">1Kb</span>
                                SOW : Scroll To
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-timer-autohide.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">1Kb</span>
                                SOW : Timer Autohide
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-timer-countdown.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">2Kb</span>
                                SOW : Timer Countdown
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-gfont.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">1.5Kb</span>
                                SOW : Google Font
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-lazyload.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">1Kb</span>
                                SOW : Lazyload
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-count-animate.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">4.1Kb</span>
                                SOW : Count Animate
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-sow-service-worker.html">
                                <span class="badge float-end font-weight-light mt--3 text-gray-400">1Kb</span>
                                SOW : Service Worker!
                            </a>
                        </li>
                        <li class="nav-item pl--15 pr--15">
                            <div class="bg-diff text-gray-500 fs--13 p-2 rounded">
                                SOW Core plugins are developed from scratch.
                                You can remove, disable or use your own!
                            </div>
                        </li>

                    </ul>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="#">
											<span class="group-icon float-end">
												<i class="fi fi-arrow-end-slim"></i>
												<i class="fi fi-arrow-down-slim"></i>
											</span>
                        <i class="fi fi-layers"></i>
                        Vendor Plugins
                    </a>

                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-bootstrap-select.html">
                                Vendor : Bootstrap Select
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-flickity.html">
                                Vendor : Flickity Slider
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-swiper.html">
                                Vendor : Swiper Slider
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-jarallax.html">
                                Vendor : Jaxallax
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-sticky-kit.html">
                                Vendor : Sticky Kit
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-fancybox.html">
                                Vendor : Fancybox
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-photoswipe.html">
                                Vendor : Photoswipe
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/components-map.html">
                                Vendor : Map
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-slimscroll.html">
                                Vendor : Slimscroll
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-nestable.html">
                                Vendor : Nestable
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="#">
													<span class="group-icon float-end">
														<i class="fi fi-arrow-end-slim"></i>
														<i class="fi fi-arrow-down-slim"></i>
													</span>
                                Vendor : Pickers
                            </a>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-datepicker.html">
                                        Datepicker
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-rangepicker.html">
                                        Rangepicker
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-colorpicker.html">
                                        Colorpicker
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="#">
													<span class="group-icon float-end">
														<i class="fi fi-arrow-end-slim"></i>
														<i class="fi fi-arrow-down-slim"></i>
													</span>
                                Vendor : Charts
                            </a>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-chartjs.html">
                                        Chart.js
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-flot.html">
                                        Flot Chart
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-easypie.html">
                                        Easy Pie Chart
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-sparkline.html">
                                        Sparkline Charts
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="#">
													<span class="group-icon float-end">
														<i class="fi fi-arrow-end-slim"></i>
														<i class="fi fi-arrow-down-slim"></i>
													</span>
                                Vendor : Editors
                            </a>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-medium-editor.html">
                                        Medium Editor
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-markdown.html">
                                        Markdown Editor
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-summernote.html">
                                        Summernote
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-datatable.html">
                                Vendor : Datatable
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-fullcalendar.html">
                                Vendor : Fullcalendar
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-prismjs.html">
                                Vendor : Prismjs (Highlighter)
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-aos.html">
                                Vendor : AOS
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-typed.html">
                                Vendor : Typed
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="<?php echo $server?>html_admin/layout_1/plugins-vendor-sortablejs.html">
                                Vendor : Sortablejs
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="#">
											<span class="group-icon float-end">
												<i class="fi fi-arrow-end-slim"></i>
												<i class="fi fi-arrow-down-slim"></i>
											</span>
                        <i class="fi fi-eq-vertical"></i>
                        Layout : Variants
                    </a>

                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="#">
													<span class="group-icon float-end">
														<i class="fi fi-arrow-end-slim"></i>
														<i class="fi fi-arrow-down-slim"></i>
													</span>
                                Sidebar
                            </a>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/layout-sidebar-dark.html">
                                        Sidebar : Dark
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/layout-sidebar-light.html">
                                        Sidebar : Light
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link js-ajax" href="#">
													<span class="group-icon float-end">
														<i class="fi fi-arrow-end-slim"></i>
														<i class="fi fi-arrow-down-slim"></i>
													</span>
                                Header
                            </a>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/layout-header-dark.html">
                                        Header : Dark
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/layout-header-light.html">
                                        Header : Light
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/layout-defaults-1.html">
                                Defaults : 1
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/layout-defaults-2.html">
                                Defaults : 2
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/layout-defaults-3.html">
                                Defaults : 3
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/layout-defaults-4.html">
                                Defaults : 4
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/layout-defaults-5.html">
                                Defaults : 5
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/layout-defaults-6.html">
                                Defaults : 6
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/layout-defaults-7.html">
                                Defaults : 7
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/layout-header-sticky.html">
                                Header : Sticky
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/layout-sidebar-sticky.html">
                                Sidebar : Sticky
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-title mt-5">
                    <h6 class="fs--15 mb-1 text-white font-weight-normal">Pages</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-ajax" href="#">
                        <i class="nav-icon fi fi-database"><!-- main icon --></i>
                        <span class="group-icon float-end">
											<i class="fi fi-arrow-end-slim"></i>
											<i class="fi fi-arrow-down-slim"></i>
										</span>
                        System
                    </a>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/account-signin.html">
                                Sign In/Up
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/forum-index.html">
                                Forum Pages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/account-settings.html">
                                Account Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/admin-staff.html">
                                Admin Staff
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/message-inbox.html">
                                Message Inbox
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/404.html">
                                404 Error
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-title mt-5">
                    <h6 class="fs--15 mb-1 text-white font-weight-normal">Admin Layouts</h6>
                </li>

                <li class="nav-item">

                    <a class="nav-link text-white" href="<?php echo $server?>html_admin/layout_1/../layout_1/index.html">
                        <i class="nav-icon fi fi-check text-success"><!-- main icon --></i>
                        <span class="badge opacity-2 font-weight-light float-end fs--11 mt-1">layout_1</span>
                        Smarty SaaS
                    </a>

                </li>

                <li class="nav-item">

                    <a class="nav-link" href="<?php echo $server?>html_admin/layout_1/../layout_2/index.html">
                        <i class="nav-icon fi fi-shape-star"><!-- main icon --></i>
                        <span class="badge opacity-2 font-weight-light float-end fs--11 mt-1">layout_2</span>
                        Smarty Fancy
                    </a>

                </li>

            </ul>
        </nav>

    </div>
</aside>
<!-- /SIDEBAR -->
