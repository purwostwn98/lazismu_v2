<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <base href="<?= base_url(); ?>" />

    <title>Login - Lazismu UMS</title>

    <!-- include common vendor stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/node_modules/bootstrap/dist/css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/node_modules/@fortawesome/fontawesome-free/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/node_modules/@fortawesome/fontawesome-free/css/regular.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/node_modules/@fortawesome/fontawesome-free/css/brands.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/node_modules/@fortawesome/fontawesome-free/css/solid.css">



    <!-- include vendor stylesheets used in "Login" page. see "application/views/default/pages/partials/page-login/@vendor-stylesheets.hbs" -->


    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/dist/css/ace-font.css">



    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/dist/css/ace.css">


    <link rel="icon" type="image/png" href="<?= base_url(); ?>/assets/image/logo_pemkot.png" />

    <!-- "Login" page styles specific to this page for demo purposes -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/application/views/default/pages/partials/page-login/@page-style.css">
</head>

<body>
    <div class="body-container">

        <div class="main-container container">

            <div role="main" class="main-content minh-50 justify-content-center">
                <div class="p-2 p-md-4">
                    <div class="row justify-content-center">
                        <div class="shadow radius-1 overflow-hidden bg-white col-12 col-lg-5 offset-lg-1">
                            <div class="row">
                                <div class="col-12 col-lg-12 py-lg-3 bgc-white px-0">
                                    <div class="tab-content tab-sliding border-0 p-0" data-swipe="right">
                                        <div class="tab-pane active show mh-100 px-3 px-lg-0 pb-3" id="id-tab-login">
                                            <div class="d-none d-lg-block col-md-6 offset-md-3 mt-lg-4 px-0 text-center">
                                                <a href="home/index"><img src="<?= base_url(); ?>/assets/image/logo_lazismu.png" width="65" class="pb-3" /></a>
                                                <h1 class="text-170">
                                                    <span class="text-orange-d1">Lazismu <span class="text-80 text-dark-tp3"></span></span>
                                                </h1>
                                                <span class="text-dark-tp5">Universitas Muhammadiyah Surakarta</span>
                                            </div>

                                            <div class="d-lg-none text-secondary-m1 my-4 text-center">
                                                <a href="home/index"><img src="<?= base_url(); ?>/assets/image/logo_pemkot.png" width="30" /></a>
                                                <h1 class="text-170">
                                                    <span class="text-orange-d1">LAZISMU UMS <span class="text-80 text-dark-tp3">Application</span></span>
                                                </h1>

                                                Welcome back
                                            </div>
                                            <?php
                                            $session = \Config\Services::session();
                                            ?>
                                            <?php if ($alert != false) { ?>
                                                <div class="row">
                                                    <div class="col-md-10 offset-md-1">
                                                        <div class="alert d-flex <?= ($jenisAlert == 'berhasil') ? 'bgc-success-l4' : 'bgc-danger-l4'; ?> text-dark-tp3 radius-0 text-120 <?= ($jenisAlert == 'berhasil') ? 'brc-success-l3' : 'brc-danger-l3'; ?> " role="alert">
                                                            <div class="position-tl h-102 ml-n1px border-l-4 <?= ($jenisAlert == 'berhasil') ? 'brc-success-tp3' : 'brc-danger-tp3'; ?> m-n1px"></div><!-- the big red line on left -->
                                                            <i class="fas fa-exclamation-circle mr-3 fa-2x <?= ($jenisAlert == 'berhasil') ? 'text-success-d2' : ' text-warning-d2'; ?> opacity-1"></i>
                                                            <?php if ($jenisAlert == 'berhasil') { ?>
                                                                <span class="align-self-center"><?= $alert; ?></span>
                                                            <?php } else { ?>
                                                                <span class="align-self-center"><?= $alert; ?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?= form_open("/iniauth/filter_masuk", ['class' => 'form_login form-row mt-4']); ?>
                                            <!-- <form action="mlebetapp/filter_masuk" method="post" class="form-row mt-4"> -->
                                            <div class="form-group col-md-10 offset-md-1">
                                                <div class="d-flex align-items-center input-floating-label text-blue-m1 brc-blue-m2">
                                                    <input type="text" class="form-control form-control-lg pr-4 shadow-none" id="id-login-username" autocomplete="off" name="username" value="<?= old('username'); ?>" />
                                                    <i class=" fa fa-user <?= ($session->getFlashdata('errorUser')) ? 'text-danger-m2' : 'text-grey-m2'; ?> ml-n4"></i>
                                                    <label class="floating-label text-grey-l1 text-100 ml-n3" for="id-login-username">Username</label>
                                                </div>
                                                <?php if ($session->getFlashdata('errorUser')) { ?>
                                                    <small class="text-danger"><?= $session->getFlashdata('errorUser'); ?></small>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-10 offset-md-1 mt-2 mt-md-1">
                                                <div class="d-flex align-items-center input-floating-label text-blue-m1 brc-blue-m2">
                                                    <input type="password" class="form-control form-control-lg pr-4 shadow-none" id="id-login-password" autocomplete="off" name="password" value="<?= old('password'); ?>" />
                                                    <i class=" fa fa-key <?= ($session->getFlashdata('errorPassword')) ? 'text-danger-m2' : 'text-grey-m2'; ?> ml-n4"></i>
                                                    <label class="floating-label text-grey-l1 text-100 ml-n3" for="id-login-password">Password</label>
                                                </div>
                                                <?php if ($session->getFlashdata('errorPassword')) { ?>
                                                    <small class="text-danger"><?= $session->getFlashdata('errorPassword'); ?></small>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-10 offset-md-1 mt-2 mt-md-1">
                                                <div class="d-flex align-items-center input-floating-label text-blue-m1 brc-blue-m2">
                                                    <input type="text" class="form-control form-control-lg pr-4 shadow-none" id="id-captcha" autocomplete="off" name="jawabCpt" />
                                                    <i class="fas fa-angle-double-right <?= ($session->getFlashdata('errorHitung')) ? 'text-danger-m2' : 'text-grey-m2'; ?> ml-n4"></i>
                                                    <label class="floating-label text-grey-l1 text-100 ml-n3" for="id-captcha"><?= $text; ?></label>
                                                </div>
                                                <?php if ($session->getFlashdata('errorHitung')) { ?>
                                                    <small class="text-danger"><?= $session->getFlashdata('errorHitung'); ?></small>
                                                <?php } ?>
                                            </div>
                                            <!-- <div class="col-md-6 offset-md-3 text-right text-md-right mt-n2 mb-2">
                                                    <a href="#" class="text-primary-m2 text-95" data-toggle="tab" data-target="#id-tab-forgot">
                                                        Forgot Password?
                                                    </a>
                                                </div> -->
                                            <input name="hslbenar" type="hidden" value="<?= sha1($hasil); ?>">
                                            <div class="form-group col-md-10 offset-md-1">
                                                <button type="submit" role="button" class="btn btn-warning btn-block btn-md btn-bold mt-2 mb-4">
                                                    Login
                                                </button>
                                            </div>
                                            <!-- </form> -->
                                            <?= form_close(); ?>

                                            <!-- <div class="form-row">
                                                <div class="col-12 col-md-6 offset-md-3 d-flex flex-column align-items-center justify-content-center">

                                                    <hr class="brc-default-m4 mt-0 mb-2 w-100" />

                                                    <div class="p-0 px-md-2 text-dark-tp3 my-3">
                                                        Not a member?
                                                        <a class="text-success-m2 text-600 mx-1" data-toggle="tab" data-target="#id-tab-signup" href="#">
                                                            Signup now
                                                        </a>
                                                    </div>

                                                    <hr class="brc-default-m4 w-100 mb-2" />
                                                    <div class="mt-n4 bgc-white-tp2 px-3 py-1 text-default-d1 text-90">Or Get Started Using</div>

                                                    <div class="my-2">
                                                        <button type="button" class="btn btn-bgc-white btn-lighter-primary btn-h-primary btn-a-primary border-2 radius-round btn-lg mx-1">
                                                            <i class="fab fa-facebook-f text-110"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-bgc-white btn-lighter-blue btn-h-info btn-a-info border-2 radius-round btn-lg px-25 mx-1">
                                                            <i class="fab fa-twitter text-110"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-bgc-white btn-lighter-red btn-h-red btn-a-red border-2 radius-round btn-lg px-25 mx-1">
                                                            <i class="fab fa-google text-110"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                            </div> -->
                                        </div>

                                        <div class="tab-pane mh-100 px-3 px-lg-0 pb-3" id="id-tab-signup" data-swipe-prev="#id-tab-login">
                                            <div class="position-tl ml-3 mt-3 mt-lg-0">
                                                <a href="#" class="btn btn-light-default bg-transparent" data-toggle="tab" data-target="#id-tab-login"><i class="fa fa-arrow-left"></i></a>
                                            </div>

                                            <div class="d-none d-lg-block col-md-6 offset-md-3 mt-lg-4 px-0">
                                                <h4 class="text-dark-tp4 border-b-1 brc-grey-l1 pb-1 text-130">
                                                    <i class="fa fa-user text-purple-m1 mr-1"></i>
                                                    Create an Account
                                                </h4>
                                            </div>

                                            <div class="d-lg-none text-secondary-m1 my-4 text-center">
                                                <i class="fa fa-leaf text-success-m2 text-200 mb-4"></i>
                                                <h1 class="text-170">
                                                    <span class="text-blue-d1">Ace <span class="text-80 text-dark-tp4">Application</span></span>
                                                </h1>
                                                Create an Account
                                            </div>

                                            <!-- Form Registrasi -->
                                            <!-- <form class="form-row mt-4">
                                                <div class="form-group col-md-6 offset-md-3">
                                                    <div class="d-flex align-items-center input-floating-label text-success-m1 brc-success-m2">
                                                        <input type="text" class="form-control form-control-lg pr-4 shadow-none" id="id-signup-email" autocomplete="off" />
                                                        <i class="fa fa-envelope text-grey-m2 ml-n4"></i>
                                                        <label class="floating-label text-grey-l1 text-100 ml-n3" for="id-signup-email">Email</label>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6 offset-md-3 mt-1">
                                                    <div class="d-flex align-items-center input-floating-label text-success-m1 brc-success-m2">
                                                        <input type="text" class="form-control form-control-lg pr-4 shadow-none" id="id-signup-username" autocomplete="off" />
                                                        <i class="fa fa-user text-grey-m2 ml-n4"></i>
                                                        <label class="floating-label text-grey-l1 text-100 ml-n3" for="id-signup-username">Username</label>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6 offset-md-3 mt-1">
                                                    <div class="d-flex align-items-center input-floating-label text-success-m1 brc-success-m2">
                                                        <input type="password" class="form-control form-control-lg pr-4 shadow-none" id="id-signup-password" autocomplete="off" />
                                                        <i class="fa fa-key text-grey-m2 ml-n4"></i>
                                                        <label class="floating-label text-grey-l1 text-100 ml-n3" for="id-signup-password">Password</label>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6 offset-md-3 mt-1">
                                                    <div class="d-flex align-items-center input-floating-label text-success-m1 brc-success-m2">
                                                        <input type="password" class="form-control form-control-lg pr-4 shadow-none" id="id-signup-password2" autocomplete="off" />
                                                        <i class="fas fa-sync-alt text-grey-m2 ml-n4"></i>
                                                        <label class="floating-label text-grey-l1 text-100 ml-n3" for="id-signup-password2">Confirm Password</label>
                                                    </div>
                                                </div>

                                                <div class="d-none form-group col-md-6 offset-md-3 my-2">
                                                    <label class="text-secondary-m3 text-110 mb-25">
                                                        Choose membership type
                                                    </label>
                                                    <div class="row d-flex mx-1 mx-lg-0 btn-group btn-group-toggle" data-toggle="buttons">

                                                        <div class="col-12 offset-sm-2 col-sm-3 px-1">
                                                            <label class="shadow-sm d-style border-1 w-100 my-1 py-3 bgc-white-tp2 btn-brc-tp btn btn-light-secondary btn-h-light-primary btn-a-light-primary radius-3">
                                                                <input type="radio" name="payments" id="payments1" autocomplete="off" class="invisible pos-abs">

                                                                <span class="d-flex flex-column align-items-center">
                                                                    <div class="font-bolder flex-grow-1">
                                                                        Free
                                                                    </div>
                                                                </span>

                                                            </label>
                                                        </div>

                                                        <div class="col-12 col-sm-6 px-1">
                                                            <label class="shadow-sm d-style border-2 w-100 my-1 py-3 bgc-white-tp2 btn-brc-tp btn btn-light-secondary btn-h-light-success btn-a-light-success radius-3">
                                                                <input type="radio" name="payments" id="payments2" autocomplete="off" class="invisible pos-abs">
                                                                <span class="d-flex flex-column align-items-center">

                                                                    <span class="position-tr mr-2">
                                                                        <span class="v-active pos-abs">
                                                                            <i class="fa fa-crown text-orange text-110"></i>
                                                                        </span>
                                                                        <span class="v-n-active">
                                                                            <i class="fa fa-crown text-secondary-l3 text-110"></i>
                                                                        </span>
                                                                    </span>

                                                                    <div class="font-bolder flex-grow-1">
                                                                        Premium
                                                                    </div>
                                                                </span>
                                                            </label>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="form-group col-md-6 offset-md-3 mt-2">
                                                    <label class="d-inline-block mt-3 mb-0 text-secondary-d2">
                                                        <input type="checkbox" class="mr-1" id="id-agree" />
                                                        <span class="text-secondary-d2">I have read and agree to <a href="#" class="text-blue">terms</a></span>
                                                    </label>

                                                    <button type="button" class="btn btn-success btn-block btn-md btn-bold mt-2 mb-3">
                                                        Sign Up
                                                    </button>
                                                </div>
                                            </form> -->


                                            <div class="form-row w-100">
                                                <div class="col-12 col-md-6 offset-md-3 d-flex flex-column align-items-center justify-content-center">

                                                    <hr class="brc-default-m4 mt-0 mb-2 w-100" />

                                                    <div class="p-0 px-md-2 text-dark-tp4 my-3">
                                                        Already a member?
                                                        <a class="text-blue-m2 text-600 mx-1" data-toggle="tab" data-target="#id-tab-login" href="#">
                                                            Login here
                                                        </a>
                                                    </div>

                                                    <hr class="brc-default-m4 w-100 mb-2" />
                                                    <div class="mt-n4 bgc-white-tp2 px-3 py-1 text-default-d1 text-90">Or Register Using</div>

                                                    <div class="mt-2 mb-3">
                                                        <button type="button" class="btn btn-primary border-2 radius-round btn-lg mx-1">
                                                            <i class="fab fa-facebook-f text-110"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-blue border-2 radius-round btn-lg px-25 mx-1">
                                                            <i class="fab fa-twitter text-110"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-danger border-2 radius-round btn-lg px-25 mx-1">
                                                            <i class="fab fa-google text-110"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="tab-pane mh-100 px-3 px-lg-0 pb-3" id="id-tab-forgot" data-swipe-prev="#id-tab-login">
                                            <div class="position-tl ml-3 mt-2">
                                                <a href="#" class="btn btn-light-default bg-transparent" data-toggle="tab" data-target="#id-tab-login"><i class="fa fa-arrow-left"></i></a>
                                            </div>

                                            <div class="col-md-6 offset-md-3 mt-5 px-0">
                                                <h4 class="pt-4 pt-md-0 text-dark-tp4 border-b-1 brc-grey-l1 pb-1 text-130">
                                                    <i class="fa fa-key text-brown-m2 mr-1"></i>
                                                    Recover Password
                                                </h4>
                                            </div>

                                            <form class="form-row mt-4">
                                                <div class="form-group col-md-6 offset-md-3">
                                                    <label class="text-secondary-m1 mb-3">
                                                        Enter your email address and we'll send you the instructions:
                                                    </label>
                                                    <div class="d-flex align-items-center">
                                                        <input type="email" class="form-control form-control-lg pr-4 shadow-none" id="id-recover-email" placeholder="Email" autocomplete="off" />
                                                        <i class="fa fa-envelope text-grey-m2 ml-n4"></i>
                                                    </div>
                                                </div>


                                                <div class="form-group col-md-6 offset-md-3 mt-1">
                                                    <button type="button" class="btn btn-warning btn-block btn-md btn-bold mt-2 mb-4">
                                                        Continue
                                                    </button>
                                                </div>
                                            </form>


                                            <div class="form-row w-100">
                                                <div class="col-12 col-md-6 offset-md-3 d-flex flex-column align-items-center justify-content-center">

                                                    <hr class="brc-default-m4 mt-0 mb-2 w-100" />

                                                    <div class="p-0 px-md-2 text-dark-tp4 my-3">
                                                        <a class="text-blue-m2 text-600" data-toggle="tab" data-target="#id-tab-login" href="#">
                                                            Back to Login
                                                        </a>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>

                                    </div><!-- .tab-content -->
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="d-lg-none my-3 text-white-tp1 text-center">
                        <i class="fa fa-leaf text-success-l3 mr-1 text-110"></i> Lazismu UMS &copy; 2022
                    </div>
                </div>
            </div><!-- /main -->

        </div><!-- /.main-container -->

        <!-- include common vendor scripts used in demo pages -->
        <script type="text/javascript" src="<?= base_url(); ?>/node_modules/jquery/dist/jquery.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>/node_modules/popper.js/dist/umd/popper.js"></script>
        <script type="text/javascript" src="<?= base_url(); ?>/node_modules/bootstrap/dist/js/bootstrap.js"></script>


        <!-- include vendor scripts used in "Login" page. see "application/views/default/pages/partials/page-login/@vendor-scripts.hbs" -->


        <!-- include Ace script -->
        <script type="text/javascript" src="<?= base_url(); ?>/dist/js/ace.js"></script>


        <script type="text/javascript" src="<?= base_url(); ?>/assets/js/demo.js"></script>
        <!-- this is only for Ace's demo and you don't need it -->

        <!-- "Login" page script to enable its demo functionality -->
        <script type="text/javascript" src="<?= base_url(); ?>/application/views/default/pages/partials/page-login/@page-script.js"></script>

        <script>
            //Menghilangkan Alert
            window.setTimeout(function() {
                $('.alert').fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 4000);
        </script>
    </div><!-- /.body-container -->
</body>

</html>