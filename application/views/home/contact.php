<main id="mainContent" class="main-content">
    <!-- Page Container -->
    <div class="page-container ptb-60">
        <div class="container">

            <!-- Contact Us Area -->
            <div class="contact-area contact-area-v1 panel">
                <div class="ptb-30 prl-30">
                    <div class="row row-tb-20">

                        <div class="col-xs-12 col-md-6">
                            <div class="contact-area-col contact-form">
                                <h3 class="t-uppercase h-title mb-20"><?php echo $this->lang->line('send_message_title'); ?></h3>
                                <form action="" method="post">
                                    <?php if (validation_errors() || isset($captchaOk)) : ?>
                                        <div class='alert alert-danger'>
                                            <?php echo validation_errors(); ?>
                                            <?php if ($captchaOk == false) : ?>
                                                <p><?php echo $this->lang->line('error_recaptcha'); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($this->session->userdata('pro_id')) : ?>
                                        <input type='hidden' name='users_pro_id' value='<?php echo $this->session->userdata('pro_id'); ?>' />
                                    <?php elseif ($this->session->userdata('id')) : ?>
                                        <input type='hidden' name='users_id' value='<?php echo $this->session->userdata('id'); ?>' />
                                    <?php else : ?>
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('names'); ?></label>
                                            <input type="text" maxlength="255" class="form-control" required="required" name="name" value="<?php echo set_value('name') ?>">
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('email'); ?></label>
                                            <input type="text" maxlength="255" class="form-control" required="required" name="email" value="<?php echo set_value('email') ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('your_message'); ?></label>
                                        <textarea maxlength="1000" rows="5" class="form-control" required="required" name="content"><?php echo set_value('content') ?></textarea>
                                    </div>
                                    <div class='col-md-12'>
                                        <div class="g-recaptcha mb-10" data-sitekey="<?php echo $this->config->item('recaptcha_key_site') ?>"></div>
                                    </div>
                                    <button class="btn"><?php echo $this->lang->line('send_message'); ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Contact Us Area -->

        </div>
    </div>
    <!-- End Page Container -->


</main>