<main id="mainContent" class="main-content">
    <div class="page-container ptb-60">
        <div class="container">
            <section class="sign-area panel p-40">
                <h3 class="sign-title"><?php echo lang('users_signup_l1'); ?></h3>
                <div class="row row-rl-0">
                    <div class="col-sm-12 col-md-12 col-left">
                        <form class="p-40" action="#" method="post">
                        <?=$test_1;?>
                            <?php if (validation_errors() || isset($captchaOk)) : ?>
                                <div class='alert alert-danger'>
                                    <?php echo validation_errors(); ?>
                                    <?php if($captchaOk == false) : ?>
                                    <p><?php echo lang('users_signup_l2'); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label class="sr-only"><?php echo lang('names') ?></label>
                                <input type="text" class="form-control input-lg" placeholder="<?php echo lang('names') ?>" name="name" value="<?php echo set_value('name') ?>">
                            </div>
                            <div class="form-group">
                                <label class="sr-only"><?php echo lang('email') ?></label>
                                <input type="text" class="form-control input-lg" placeholder="<?php echo lang('email') ?>" name="email" value="<?php echo set_value('email') ?>">
                            </div>
                            <div class="form-group" id="phoneGroup" style="<?php echo !isset($_POST['phone']) ? 'display: none' : ''?>">
                                <label class="sr-only"><?php echo lang('phone') ?></label>
                                <input type="text" class="form-control input-lg" placeholder="<?php echo lang('phone') ?>" name="phone" value="<?php echo set_value('phone') ?>">
                            </div>
                            <div class="form-group">
                                <label class="sr-only"><?php echo lang('password') ?></label>
                                <input type="password" class="form-control input-lg" placeholder="<?php echo lang('password') ?>" name="password">
                            </div>
                            <div class="form-group">
                                <label class="sr-only"><?php echo lang('users_signup_l3'); ?></label>
                                <input type="password" class="form-control input-lg" placeholder="<?php echo lang('users_signup_l3'); ?>" name="password_confirm">
                            </div>
                            <div class='col-md-6'>
                                <div class="custom-checkbox mb-20">
                                    <input type="checkbox" id="newsletter" name="newsletter" value="1" checked>
                                    <label class="color-mid" for="newsletter"><?php echo lang('users_signup_l4'); ?></label>
                                </div>
                                <div class="custom-checkbox mb-20">
                                    <input type="checkbox" id="legal" name="legal" value="1" <?php echo set_value('legal') == 1 ? 'checked' : '' ?>>
                                    <label class="color-mid"><?php echo lang('users_signup_l5'); ?></label>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class="g-recaptcha mb-10" data-sitekey="<?php echo $this->config->item('recaptcha_key_site') ?>"></div>
                            </div>
                            <button type="submit" class="btn btn-block btn-lg"><?php echo lang('users_signup_l6'); ?></button>
                        </form>
                        <div class="text-center color-mid">
                            Déjà inscrit ? <a href="<?php echo base_url('users/signin') ?>" class="color-green"><?php echo lang('users_signup_l7'); ?></a>
                        </div>
                        <!--<span class="or">Or</span>-->
                    </div>
                    <!--<div class="col-sm-6 col-md-5 col-right">
                        <div class="social-login p-40">
                            <div class="mb-20">
                                <button class="btn btn-lg btn-block btn-social btn-facebook"><i class="fa fa-facebook-square"></i>Sign Up with Facebook</button>
                            </div>
                            <div class="mb-20">
                                <button class="btn btn-lg btn-block btn-social btn-twitter"><i class="fa fa-twitter"></i>Sign Up with Twitter</button>
                            </div>
                            <div class="mb-20">
                                <button class="btn btn-lg btn-block btn-social btn-google-plus"><i class="fa fa-google-plus"></i>Sign Up with Google</button>
                            </div>
                            <div class="custom-checkbox mb-20">
                                <input type="checkbox" id="remember_social" checked>
                                <label class="color-mid" for="remember_social">Keep me signed in on this computer.</label>
                            </div>
                            <div class="text-center color-mid">
                                Already have an Account ? <a href="signin.html" class="color-green">Login</a>
                            </div>
                        </div>
                    </div>-->
                </div>
            </section>
        </div>
    </div>


</main>