<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XCMG ARC</title>

    <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/vendors/puse-icons-feather/feather.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/vendors/jquery-bar-rating/css-stars.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/vendors/lightgallery/css/lightgallery.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>backend/assets/css/custom.css">



    <link rel="shortcut icon" href="<?php echo base_url() ?>backend/assets/images/favicon.png" />

    <script src="<?php echo base_url() ?>backend/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        #loader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.75) url('<?php echo base_url(); ?>/assets/load.gif') no-repeat center center;
            z-index: 10000;
        }

        .sup {
            color: red;
            font-size: 20px;
        }

        .error {
            color: red;
            font-size: 15px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 10px !important;
        }
    </style>
    <!--<script src="https://code.jquery.com/jquery-3.5.1.js"></script>-->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                "aaSorting": [
                    [0, "desc"]
                ]
            });
        })
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

</head>
<script>

</script>

<body>
    <?php $segment = $this->uri->segment(2);

    ?>
    <div class="container-scroller">

        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo d-lg-none" href="<?php echo base_url("superadmin")?>">
                    <img src="<?php echo base_url() ?>backend/assets/images/logo.png" alt="">
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="navbar-nav">
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link">
                            <i class="fa fa-arrows-alt" id="fullscreen-button"></i>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item">
                        <a href="<?php echo base_url('superadmin/unauthenticate'); ?>">
                            <i class="fa fa-sign-out mr-2"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>

        <div class="container-fluid page-body-wrapper">

            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item d-none d-lg-block logo-img_sec">
                        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                            <a class="navbar-brand brand-logo" href="<?php echo base_url("superadmin")?>">
                                <img src="<?php echo base_url() ?>backend/assets/images/logo.png" alt="">
                            </a>
                            <a class="navbar-brand brand-logo-mini" href="<?php echo base_url("superadmin")?>">
                                <img src="<?php echo base_url() ?>backend/assets/images/logo.png" alt="">
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('superadmin/dashboard') ?>">
                            <span class="nav_link_icon">
                                <i class="fa fa-home" style="font-size: 20px !important;"></i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link " href="<?php echo base_url('superadmin/user/user_list'); ?>">
                            <span class="nav_link_icon">
                                <i class="fa fa-cogs menu-icon"></i>
                            </span>
                            <span class="menu-title">Users</span>
                        </a>
                    </li>

                    <!-- Permit section  -->
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#permit" aria-controls="permit" aria-expanded="false">
                            <span class="nav_link_icon">
                                <i class="fa fa-edit menu-icon"></i>
                            </span>
                            <span class="menu-title">Permit</span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="collapse" id="permit">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item ">
                                    <a class="nav-link " href="<?php echo base_url('superadmin/permit/state') ?>">State</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link " href="<?php echo base_url('superadmin/permit/permit_type') ?>">Permit Type </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link " href="<?php echo base_url('superadmin/permit/permit_calculation') ?>">Permit Calculation</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- end permit section -->

                    <?php if ($segment == "slider" || $segment == "home_page_setting" || $segment == "footer_setting" || $segment != "setting") {
                        $active = "active";
                    } else {
                        $active = "";
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#frontend" aria-controls="frontend" aria-expanded="false">
                            <span class="nav_link_icon">
                                <i class="fa fa-edit menu-icon"></i>
                            </span>
                            <span class="menu-title">Front End </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="collapse" id="frontend">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item ">
                                    <a class="nav-link " href="<?php echo base_url('superadmin/slider') ?>">Slider</a>
                                </li>
                                <!-- <li class="nav-item ">
                                    <a class="nav-link " href="<?php echo base_url('superadmin/home_page_setting') ?>">Home page setting</a>
                                </li> -->
                                <li class="nav-item ">
                                    <a class="nav-link " href="<?php echo base_url('superadmin/footer_setting') ?>">Footer setting</a>
                                </li>
                            </ul>
                        </div>
                    </li>




                    <li class="nav-item ">
                        <a class="nav-link " href="<?php echo base_url('superadmin/edit-profile'); ?>">
                            <span class="nav_link_icon">
                                <i class="fa fa-cogs menu-icon"></i>
                            </span>
                            <span class="menu-title">Settings</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item ">
                        <a class="nav-link " href="<?php echo base_url('superadmin/user/user_list'); ?>">
                            <span class="nav_link_icon">
                                <i class="fa fa-cogs menu-icon"></i>
                            </span>
                            <span class="menu-title">Help && Support</span>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('superadmin/unauthenticate'); ?>">
                            <span class="nav_link_icon">
                                <i class="fa fa-sign-out menu-icon"></i>
                            </span>
                            <span class="menu-title">Sign Out</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="main-panel">