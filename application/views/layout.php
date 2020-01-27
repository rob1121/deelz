<!DOCTYPE html>
<!--[if lt IE 9 ]> <html lang="zxx" dir="ltr" class="no-js ie-old"> <![endif]-->
<!--[if IE 9 ]> <html lang="zxx" dir="ltr" class="no-js ie9"> <![endif]-->
<!--[if IE 10 ]> <html lang="zxx" dir="ltr" class="no-js ie10"> <![endif]-->
<!--[if (gt IE 10)|!(IE)]><!-->
<html lang="zxx" dir="ltr" class="no-js">
    <!--<![endif]-->

    <head>
        <?php if (!isset($img_fb)) : ?>
            <link rel="image_src" href="<?php echo base_url(); ?>assets/images/social/launch.png" />
            <meta property="og:image" content="<?php echo base_url(); ?>assets/images/social/launch.png" />
        <?php else : ?>
            <link rel="image_src" href="<?php echo $img_fb; ?>" />
            <meta property="og:image" content="<?php echo $img_fb; ?>" />
        <?php endif; ?>
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <!-- META TAGS                                 -->
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <meta charset="utf-8">
        <!-- Always force latest IE rendering engine -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Mobile specific meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <!-- PAGE TITLE                                -->
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <title><?php echo $title; ?></title>

        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <!-- SEO METAS                                 -->
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <meta name="description" content="<?php echo!isset($meta_description) ? 'Zotdeal, le nouveau réseau de commerçants de la Réunion. Promos et bons plans tout autour de l\'île.' : $meta_description ?>">
        <meta name="keywords" content="bon plan,promo,deal,réunion,974,run,commercant,réseau,zotdeal,zotcommerce">
        <meta name="robots" content="index, follow">

        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <!-- PAGE FAVICON                              -->
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/images/favicon/apple-touch-icon.png">
        <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon/favicon.ico">

        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <!-- GOOGLE FONTS                              -->
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">

        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <!-- Include CSS Filess                        -->
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->

		<link href="<?php echo base_url(); ?>assets/css/normalize.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

        <!-- Linearicons -->
        <link href="<?php echo base_url(); ?>assets/vendors/linearicons/css/linearicons.css" rel="stylesheet">

        <!-- Owl Carousel -->
        <link href="<?php echo base_url(); ?>assets/vendors/owl-carousel/owl.carousel.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/vendors/owl-carousel/owl.theme.min.css" rel="stylesheet">

        <!-- Flex Slider -->
        <link href="<?php echo base_url(); ?>assets/vendors/flexslider/flexslider.css" rel="stylesheet">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <!-- Template Stylesheet -->
        <style type="text/css">
            :root {
                --color_1: #<?php echo $this->config->item('admin')['color_1']; ?>;
                --color_2: #<?php echo $this->config->item('admin')['color_2']; ?>;
                --color_3: #<?php echo $this->config->item('admin')['color_3']; ?>;
                --color_4: #<?php echo $this->config->item('admin')['color_4']; ?>;
            }
        </style>
		<link href="<?php echo base_url(); ?>assets/css/demo.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/component.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/css/base_v1.0.1.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
        <!-- ReCaptcha Google -->
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>

    <body id="body" class="wide-layout preloader-active">

        <!--[if lt IE 9]>
            <p class="browserupgrade alert-error">
                    You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
            </p>
        <![endif]-->

        <noscript>
        <div class="noscript alert-error">
            For full functionality of this site it is necessary to enable JavaScript. Here are the <a href="http://www.enable-javascript.com/" target="_blank">
                instructions how to enable JavaScript in your web browser</a>.
        </div>
        </noscript>

        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <!-- PRELOADER                                 -->
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <!-- Preloader -->
        <div id="preloader" class="preloader">
            <div class="loader-cube">
                <div class="loader-cube__item1 loader-cube__item"></div>
                <div class="loader-cube__item2 loader-cube__item"></div>
                <div class="loader-cube__item4 loader-cube__item"></div>
                <div class="loader-cube__item3 loader-cube__item"></div>
            </div>
        </div>
        <!-- End Preloader -->
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <!-- WRAPPER                                   -->
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <div id="pageWrapper" class="page-wrapper">

            <?php if (isset($has_banner)) : ?>
                <?php $this->load->view('partial/banner'); ?>
            <?php endif; ?>
            <?php if (!isset($no_header)) : ?>
                <?php $this->load->view('partial/header'); ?>
            <?php endif; ?>

            <!-- Notifications -->
            <?php $this->load->view('scripts/notifications'); ?>

            <!-- End Notifications -->
            <!-- –––––––––––––––[ PAGE CONTENT ]––––––––––––––– -->
            <?php echo $content; ?>

            <?php if (!isset($no_footer)) : ?>
                <?php $this->load->view('partial/footer'); ?>
            <?php endif; ?>
        </div>
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <!-- END WRAPPER                               -->
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->


        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <!-- BACK TO TOP                               -->
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <div id="backTop" class="back-top is-hidden-sm-down">
            <i class="fa fa-angle-up" aria-hidden="true"></i>
        </div>

        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <!-- SCRIPTS                                   -->
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->

        <!-- (!) Placed at the end of the document so the pages load faster -->

        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <!-- Initialize jQuery library                 -->
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.12.3.min.js"></script>

        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <!-- Latest compiled and minified Bootstrap    -->
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <!-- JavaScript Plugins                        -->
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <!-- (!) Include all compiled plugins (below), or include individual files as needed -->

        <!-- Modernizer JS -->
        <script src="<?php echo base_url(); ?>assets/vendors/modernizr/modernizr-2.6.2.min.js"></script>

        <!-- Owl Carousel -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/owl-carousel/owl.carousel.min.js"></script>

        <!-- FlexSlider -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/flexslider/jquery.flexslider-min.js"></script>

        <!-- Coutdown -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/countdown/jquery.countdown.js"></script>

        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <!-- Custom Template JavaScript                   -->
        <!-- ––––––––––––––––––––––––––––––––––––––––– -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main_v1.1.0<?php echo MIN_FILE; ?>.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom/partial/header<?php echo MIN_FILE; ?>.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom/deals/favorites<?php echo MIN_FILE; ?>.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/classie.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dynamics.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/main.js"></script>
		<script>
			(function() {
				document.documentElement.className = 'js';
				var slideshow = new CircleSlideshow(document.getElementById('slideshow'));

                AOS.init({
                    delay: 500,
                    duration: 500,
                    once: true
                });

                var stickyOffset = $('.header-menu').offset().top;

                $(window).scroll(function(){
                var sticky = $('.header-menu'),
                    scroll = $(window).scrollTop();

                if (scroll >= stickyOffset) sticky.addClass('fixed');
                else sticky.removeClass('fixed');
                });
			})();
        </script>
        <!-- Confirmation cookies -->
        <?php $this->load->view('scripts/cookies_banner'); ?>
        <!-- Google Map -->
        <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=<?php echo $this->config->item('google_map_api_key'); ?>"></script>

        <!-- Google Map Api -->
        <!--<script type='text/javascript' src="http://maps.google.com/maps/api/js?sensor=false&amp;libraries=places&language=fr&key=<?php echo $this->config->item('google_api_key') ?>"></script>
        -->

        <?php
        // CSS PROPRE A LA PAGE
        if (isset($styles_to_load)) :
            foreach ($styles_to_load as $css):
                ?>
                <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/<?php echo $css; ?>.css" media="screen" />
                <?php
            endforeach;
        endif;
        ?>
        <?php
        // JS PROPRE A LA PAGE
        if (isset($scripts_to_load)) :
            foreach ($scripts_to_load as $script):
                ?>
                <script type='text/javascript' src = '<?php echo base_url(); ?>assets/js/custom/<?php echo $script; ?>.js'></script>
                <?php
            endforeach;
        endif;
        ?>
        <!-- Analytics -->
        <?php $this->load->view('scripts/analytics'); ?>
    </body>

</html>