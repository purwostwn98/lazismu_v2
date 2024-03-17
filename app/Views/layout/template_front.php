<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <base href="<?= base_url(); ?>" />

    <title>Lazismu Universitas Muhammadiyah Surakarta</title>

    <!-- include common vendor stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/node_modules/bootstrap/dist/css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/node_modules/@fortawesome/fontawesome-free/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/node_modules/@fortawesome/fontawesome-free/css/regular.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/node_modules/@fortawesome/fontawesome-free/css/brands.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/node_modules/@fortawesome/fontawesome-free/css/solid.css">

    <!-- chosen -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/node_modules/select2/dist/css/select2.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/node_modules/chosen-js/chosen.css">

    <!-- include vendor stylesheets used in "Landing Page 1" page. see "application/views/default/pages/partials/landing-page-1/@vendor-stylesheets.hbs" -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/node_modules/aos/dist/aos.css">


    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/dist/css/ace-font.css">



    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/dist/css/ace.css">


    <link rel="icon" type="image/png" href="<?= base_url(); ?>/assets/favicon.png" />

    <!-- "Landing Page 1" page styles specific to this page for demo purposes -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/application/views/default/pages/partials/landing-page-1/@page-style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/dist/css/ace-themes.css">

</head>

<body>
    <div class="body-container">
        <div class="pos-abs" id="scroll-down"></div>
        <div class="pos-abs" id="scroll-up"></div>

        <nav class="navbar border-b-2 navbar-expand-lg navbar-white">
            <div class="navbar-inner brc-warning-l1">
                <div class="container">


                    <button type="button" class="navbar-toggler btn btn-burger burger-times static collapsed d-flex d-lg-none ml-2" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navbar menu">
                        <span class="bars text-dark-tp3"></span>
                    </button><!-- mobile navbar toggler button -->


                    <div class="navbar-intro w-auto justify-content-xl-between border-0">
                        <a class="navbar-brand text-dark-tp3 text-180" href="/">
                            <!-- <i class="fa fa-leaf text-105 text-success mr-1"></i>
              <span>ACE</span>
              <span class="text-70">Application</span> -->
                            <img class="w-auto py-2" style="max-height: 70px;" src="<?= base_url(); ?>/assets/favicon.png" alt="Logo Lazismu UMS">
                        </a><!-- /.navbar-brand -->
                    </div><!-- /.navbar-intro -->



                    <button type="button" class="d-style mr-2 px-4 navbar-toggler btn btn-burger static collapsed d-flex d-lg-none" data-toggle="collapse" data-target="#navbarMenu2" aria-controls="navbarMenu2" aria-expanded="false" aria-label="Toggle navbar menu">
                        <i class="fa fa-caret-down d-collapsed text-grey-m1 text-80"></i>
                        <i class="fa fa-caret-up d-n-collapsed text-grey-m1 text-80"></i>

                        <i class="fa fa-user text-orange-d1 ml-2"></i>
                    </button><!-- mobile navbar toggler button -->

                    <div class="navbar-menu collapse navbar-collapse navbar-backdrop " id="navbarMenu2">
                        <div class="navbar-nav">
                            <ul class="nav">
                                <li class="nav-item px-3">
                                    <span class="d-flex h-100 align-items-center text-grey-d1 py-3">
                                        <i class="fa fa-phone fa-flip-horizontal text-125 text-warning-m1 mr-1"></i>
                                        <span class="ml-1 text-600 text-grey-d3 letter-spacing-1 d-lg-none d-xl-inline-block">
                                            085363766667
                                        </span>
                                    </span>
                                </li>
                                <li class="nav-item dropdown px-lg-2 d-lg-flex flex-column justify-content-center">
                                    <a class="d-none d-lg-block h-auto btn btn-outline-warning btn-bold radius-round border-2 dropdown-toggle px-2 px-xl-3" href="/iniauth/index">
                                        Login
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div><!-- /.navbar-inner -->
        </nav>
        <div class="main-container">

            <div role="main" class="main-content">
                <div class="page-content p-0">
                    <!-- This is CONTENT -->
                    <?= $this->renderSection("konten"); ?>

                    <div class="text-center py-4 mt-5 bgc-black-l4 border-t-1 brc-black-l3">
                        <span class="text-dark-tp3">
                            Copyright &copy; 2022 Lazismu Universitas Muhammadiyah Surakarta
                        </span>
                    </div>

                    <div class="footer-tools">
                        <a id="btn-scroll-up" href="#" class="btn-scroll-up btn btn-dark btn-smd border-2 radius-round mb-2 mr-2">
                            <i class="fa fa-arrow-up w-2 h-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div><!-- /main -->

    </div><!-- /.main-container -->

    <!-- include common vendor scripts used in demo pages -->
    <script type="text/javascript" src="<?= base_url(); ?>/node_modules/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/node_modules/popper.js/dist/umd/popper.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/node_modules/bootstrap/dist/js/bootstrap.js"></script>


    <!-- include vendor scripts used in "Landing Page 1" page. see "application/views/default/pages/partials/landing-page-1/@vendor-scripts.hbs" -->
    <script type="text/javascript" src="<?= base_url(); ?>/node_modules/aos/dist/aos.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/node_modules/holderjs/holder.js"></script>


    <!-- include Ace script -->
    <script type="text/javascript" src="<?= base_url(); ?>/dist/js/ace.js"></script>


    <script type="text/javascript" src="<?= base_url(); ?>/assets/js/demo.js"></script>
    <!-- this is only for Ace's demo and you don't need it -->

    <!-- "Landing Page 1" page script to enable its demo functionality -->
    <script type="text/javascript" src="<?= base_url(); ?>/application/views/default/pages/partials/landing-page-1/@page-script.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Chosen -->
    <script type="text/javascript" src="<?= base_url(); ?>/node_modules/select2/dist/js/select2.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>/node_modules/chosen-js/chosen.jquery.js"></script>
    </div><!-- /.body-container -->
</body>

</html>