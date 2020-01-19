<!DOCTYPE HTML>
<html class="full">

    <head>
        <title>ZotDeal.re - Coming soon</title>


        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta name="keywords" content="Réunion, Zotdeal, Zotcommerce, bon plan, deal" />
        <meta name="description" content="ZotDeal.re, c'est la nouvelle génération du commerce de proximité à La Réunion. Un outil simple et intuitif, permettant aux commerçants de développer leur clientèle à La Réunion grâce à Internet.">
        <meta name="author" content="Zotdeal">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="image_src" href="<?php echo base_url(); ?>assets/images/social/launch.png" />
        <meta property="og:image" content="<?php echo base_url(); ?>assets/images/social/launch.png" />
    
        <!-- GOOGLE FONTS -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600' rel='stylesheet' type='text/css'>
        <!-- /GOOGLE FONTS -->
        <link rel="stylesheet" href="https://www.commingsoon.zotdeal.re/css/bootstrap.css">
        <link rel="stylesheet" href="https://www.zotdeal.re/assets/css/font-awesome.css">
        <link rel="stylesheet" href="https://www.commingsoon.zotdeal.re/css/icomoon.css">
        <link rel="stylesheet" href="https://www.commingsoon.zotdeal.re/css/styles.css">
        <link rel="stylesheet" href="https://www.commingsoon.zotdeal.re/css/mystyles.css">
        <script src="https://www.commingsoon.zotdeal.re/js/modernizr.js"></script>


        <script src="https://www.commingsoon.zotdeal.re/js/jquery.js"></script>
        <!-- Hotjar Tracking Code for www.zotdeal.re -->
        <script>
            (function (h, o, t, j, a, r) {
                h.hj = h.hj || function () {
                    (h.hj.q = h.hj.q || []).push(arguments)
                };
                h._hjSettings = {hjid: 480508, hjsv: 5};
                a = o.getElementsByTagName('head')[0];
                r = o.createElement('script');
                r.async = 1;
                r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
                a.appendChild(r);
            })(window, document, '//static.hotjar.com/c/hotjar-', '.js?sv=');
        </script>
    </head>

    <body class="full">

        <!-- FACEBOOK WIDGET -->
        <div id="fb-root"></div>
        <script>
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <!-- /FACEBOOK WIDGET -->
        <div class="global-wrap">

            <div class="full-page text-center">
                <div class="bg-holder full">
                    <div class="bg-mask-darken"></div>  
                    <div class="bg-img" style="background-image:url(https://www.commingsoon.zotdeal.re/img/shopping.jpg);"></div>
                    <div class="bg-holder-content full text-center text-white">
                        <a class="logo-holder text-center" href="https://www.commingsoon.zotdeal.re">
                            <img src="https://www.commingsoon.zotdeal.re/img/logo_mini.png" alt="Image Alternative text" title="Image Title" />
                        </a>
                        <div class="full-center">
                            <div class="container">
                                <!--<iframe id="video" src="https://player.vimeo.com/video/214371730?title=0&byline=0&portrait=0" style="border: 0" class="hidden-xs"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                -->
                                <h2>Bientôt !</h2>
                                <h3>Du nouveau à la Réunion...</h3>
                                <h5>&nbsp;&nbsp;<em>Notre mission :<br class='hidden-lg hidden-sm hidden-md'/> Rapprocher Réunionnais et commerçants grâce à Internet.</em></h5>
                                <div class="countdown countdown-lg hidden-xs" inline_comment="countdown" data-countdown="May 4, 2017 07:00:00" id="countdown"></div>
                                <div class="countdown countdown-xs hidden-lg hidden-md hidden-sm" inline_comment="countdown" data-countdown="May 4, 2017 07:00:00" id="countdown"></div>
                                <div class="gap"></div>
                                <!--SIGNUP-->
                                <div id='signup' style="<?php echo!isset($errorSignup) ? 'display: none' : '' ?>">
                                    <p>Pré-inscription PRO :</p>
                                    <div class="row"> 
                                        <div class="col-md-4 col-md-offset-4">  
                                            <form method='post' action=''>
                                                <?php if (isset($errorSignup)) : ?>
                                                    <div class='alert alert-info text-center'>
                                                        <?php echo validation_errors(); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="form-group form-group-ghost form-group-lg">
                                                    <input class="form-control required" placeholder="Nom / Prénom" type="text" name='name' value="<?php echo set_value('name'); ?>" required />
                                                </div>
                                                <div class="form-group form-group-ghost form-group-lg">
                                                    <input class="form-control required" placeholder="Mon email" type="text" name='email' value="<?php echo set_value('email'); ?>" required />
                                                </div>
                                                <div class="form-group form-group-ghost form-group-lg">
                                                    <input class="form-control required" placeholder="Nom de ma société" type="text" name='company' value="<?php echo set_value('company'); ?>" required />
                                                    * Accès réservé aux professionnels jusqu'à ouverture
                                                </div>
                                                <button class='btn btn-primary' type='submit'><i class='fa fa-unlock'></i> Entrer sur le site</button>
                                            </form>
                                        </div>
                                    </div>
                                    <br />
                                    <a href="#" class="mt20" onclick="$('#signup').slideUp(); $('#codepro').show();"><em>J'ai un code d'accès PRO</em></a>
                                </div>
                                <!--CODE PRO-->
                                <div class="row" id="codepro"> 
                                    <div class="col-md-4 col-md-offset-4">  
                                        <form method='post' action=''>
                                            <?php if (isset($error)) : ?>
                                                <div class='alert alert-info text-center'>
                                                    <i class='fa fa-exclamation-triangle'></i> Votre code d'accès n'est pas bon
                                                </div>
                                            <?php endif; ?>
                                            <div class="form-group form-group-ghost form-group-lg">
                                                <input class="form-control" placeholder="Vous avez un code d'accès PRO ?" type="text" name='access' />
                                            </div>
                                            <button class='btn btn-primary' type='submit'><i class='fa fa-unlock'></i> Entrer sur le site</button>
                                        </form>
                                        <br />
                                        <a href="#" class="mt10" onclick="$('#codepro').slideUp(); $('#signup').show();"><em>Obtenir un accès PRO ?</em></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="footer-social text-center hidden">
                            <a href='mailto:contact@zotdeal.re'><i class='fa fa-envelope'></i> Demander un code d'accès PRO par email</a>
                            <p class="hidden"><em>Merci de nous envoyer un email avec votre nom / prénom et le nom de votre société pour accéder en avant première à Zotdeal.re</em></p>
                        </div>
                    </div>
                </div>
            </div>



            <script>
                $(document).ready(function () {
                    if ($(document).height() < 700) {
                        $('#video').hide();
                    }
                });
            </script>
            <script src="https://www.commingsoon.zotdeal.re/js/bootstrap.js"></script>
            <script src="https://www.commingsoon.zotdeal.re/js/slimmenu.js"></script>
            <script src="https://www.commingsoon.zotdeal.re/js/bootstrap-datepicker.js"></script>
            <script src="https://www.commingsoon.zotdeal.re/js/bootstrap-timepicker.js"></script>
            <script src="https://www.commingsoon.zotdeal.re/js/nicescroll.js"></script>
            <script src="https://www.commingsoon.zotdeal.re/js/dropit.js"></script>
            <script src="https://www.commingsoon.zotdeal.re/js/ionrangeslider.js"></script>
            <script src="https://www.commingsoon.zotdeal.re/js/icheck.js"></script>
            <script src="https://www.commingsoon.zotdeal.re/js/fotorama.js"></script>
            <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
            <script src="https://www.commingsoon.zotdeal.re/js/typeahead.js"></script>
            <script src="https://www.commingsoon.zotdeal.re/js/card-payment.js"></script>
            <script src="https://www.commingsoon.zotdeal.re/js/magnific.js"></script>
            <script src="https://www.commingsoon.zotdeal.re/js/owl-carousel.js"></script>
            <script src="https://www.commingsoon.zotdeal.re/js/fitvids.js"></script>
            <script src="https://www.commingsoon.zotdeal.re/js/tweet.js"></script>
            <script src="https://www.commingsoon.zotdeal.re/js/countdown.js"></script>
            <script src="https://www.commingsoon.zotdeal.re/js/gridrotator.js"></script>
            <script src="https://www.commingsoon.zotdeal.re/js/custom.js"></script>
        </div>
    </body>

</html>


