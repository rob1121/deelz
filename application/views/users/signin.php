<main id="mainContent" class="main-content">
    <div class="page-container ptb-60">
        <div class="container">
            <section class="sign-area panel p-40">
                <h3 class="sign-title"><?php echo lang('users_signin_l1'); ?></h3>
                <div class="row row-rl-0">
                    <div class="col-sm-12 col-md-12 col-left">
                        <form class="p-40" action="" method="post">
                            <?php if(isset($error)) : ?> 
                            <div class="alert alert-danger">
                                <p><?php echo lang('users_signin_l2'); ?></p>
                            </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label class="sr-only"><?php echo lang('email') ?></label>
                                <input type="text" class="form-control input-lg" placeholder="<?php echo lang('email') ?>" name="email">
                            </div>
                            <div class="form-group">
                                <label class="sr-only"><?php echo lang('password') ?></label>
                                <input type="password" class="form-control input-lg" placeholder="<?php echo lang('password') ?>" name="password">
                            </div>
                            <div class="form-group">
                                <a href="<?php echo base_url('users/renew_password'); ?>" class="forgot-pass-link color-green"><?php echo lang('users_signin_l3'); ?></a>
                            </div>
                            <div class="custom-checkbox mb-20">
                                <input type="checkbox" id="sess_expiration" name="sess_expiration" value="1" checked>
                                <label class="color-mid"><?php echo lang('users_signin_l4'); ?></label>
                            </div>
                            <button type="submit" class="btn btn-block btn-lg"><?php echo lang('users_signin_l5'); ?></button>
                        </form>
                        <div class="text-center color-mid">
                            <?php echo lang('users_signin_l6'); ?>
                        </div>
                        <div class="text-center color-mid">
                            <a href="<?php echo base_url('users/signin') ?>" class="color-red"><?php echo lang('users_signin_l7'); ?></a>
                        </div>
                    <!--<span class="or">Or</span>-->
                    </div>
                    <!--<div class="col-sm-6 col-md-5 col-right">
                        <div class="social-login p-40">
                            <div class="mb-20">
                                <button class="btn btn-lg btn-block btn-social btn-facebook"><i class="fa fa-facebook-square"></i>Sign In with Facebook</button>
                            </div>
                            <div class="mb-20">
                                <button class="btn btn-lg btn-block btn-social btn-twitter"><i class="fa fa-twitter"></i>Sign In with Twitter</button>
                            </div>
                            <div class="mb-20">
                                <button class="btn btn-lg btn-block btn-social btn-google-plus"><i class="fa fa-google-plus"></i>Sign In with Google</button>
                            </div>
                            <div class="custom-checkbox mb-20">
                                <input type="checkbox" id="remember_social" checked>
                                <label class="color-mid" for="remember_social">Keep me signed in on this computer.</label>
                            </div>
                            <div class="text-center color-mid">
                                Need an Account ? <a href="signup.html" class="color-green">Create Account</a>
                            </div>
                        </div>
                    </div>-->
                </div>
            </section>
        </div>
    </div>


</main>