<main id="mainContent" class="main-content">
    <div class="page-container ptb-60">
        <div class="container">
            <section class="sign-area panel p-40">
                <h3 class="sign-title"><?php echo lang('store_renew_password_l1') ?></h3>
                <div class="row row-rl-0">
                    <div class="col-sm-12 col-md-12 col-left">
                        <form class="p-40" action="" method="post">
                            <?php if(isset($error)) : ?> 
                            <div class="alert alert-danger">
                                <p><?php echo lang('store_renew_password_l2') ?></p>
                            </div>
                            <?php endif; ?>
                            <?php if(isset($success)) : ?> 
                            <div class="alert alert-success">
                                <p><i class="fa fa-check"></i> <?php echo lang('store_renew_password_l3') ?></p>
                            </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label class="sr-only"><?php echo lang('email') ?></label>
                                <input type="text" class="form-control input-lg" placeholder="<?php echo lang('store_renew_password_l4') ?>" name="email">
                            </div>
                            <div class="form-group">
                                <a href="<?php echo base_url('store/signin'); ?>" class="forgot-pass-link color-green"><i class='fa fa-arrow-left'></i> <?php echo lang('store_renew_password_l5') ?></a>
                            </div>
                            <button type="submit" class="btn btn-block btn-lg"><?php echo lang('store_renew_password_l6') ?></button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>


</main>