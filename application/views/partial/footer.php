<!-- –––––––––––––––[ END PAGE CONTENT ]––––––––––––––– -->
<section class="footer-top-area pt-70 pb-30 pos-r bg-blue">
    <div class="container">
        <div class="row row-tb-20">
            <div class="col-sm-12 col-md-6">
                <div class="row row-tb-20">
                    <div class="footer-col col-sm-4"></div>
                    <div class="footer-col col-sm-6">
                        <div class="footer-about">
                            <img class="mb-40" src="<?php echo base_url(isset($this->config->item('admin')['logo']) ? 'assets/uploads/logo.png' : 'assets/images/logo_light.png'); ?>" width="250" alt="">
                            <p class="color-light">
                                <?php echo $this->lang->line('footer_line_1'); ?>
                            </p>
                            <p class="color-light mt-10">
                                <em>
                                    <?php echo $this->lang->line('footer_line_2'); ?>
                                </em>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="row row-tb-20">
                    <div class="footer-col col-sm-2"></div>
                    <div class="footer-col col-sm-6">
                        <div class="footer-links">
                            <h2 class="color-lighter"><?php echo $this->lang->line('footer_quick_access'); ?></h2>
                            <ul>
                                <?php if($this->users_pro->isLogged()) : ?>
                                <li><a href="<?php echo base_url('store/pro') ?>"><?php echo $this->lang->line('my_store'); ?></a>
                                </li>
                                <?php else : ?>
                                <li><a href="<?php echo base_url('store/signin') ?>"><?php echo $this->lang->line('pro_login'); ?></a>
                                </li>
                                <?php endif; ?>
                                <li><a href="<?php echo base_url('comment-ca-marche') ?>"><?php echo $this->lang->line('about'); ?></a>
                                </li>
                                <li><a href="<?php echo base_url('home/legal') ?>"><?php echo $this->lang->line('cgv'); ?></a>
                                </li>
                                <li><a href="<?php echo base_url('store/legal') ?>"><?php echo $this->lang->line('cgv_pro'); ?></a>
                                </li>
                                <li><a href="<?php echo base_url('home/legal#mentions') ?>"><?php echo $this->lang->line('legal'); ?></a>
                                </li>
                                <li><a href="<?php echo base_url('home/invest') ?>"><?php echo $this->lang->line('invest'); ?></a>
                                </li>
                                <li><a href="<?php echo base_url('home/contact') ?>"><?php echo $this->lang->line('contact'); ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-xs-12">
                <div class="payment-methods t-center">
                    <span><img src="<?php echo base_url(); ?>assets/images/icons/payment/paypal.jpg" alt=""></span>
                    <span><img src="<?php echo base_url(); ?>assets/images/icons/payment/visa.jpg" alt=""></span>
                    <span><img src="<?php echo base_url(); ?>assets/images/icons/payment/mastercard.jpg" alt=""></span>
                    <span><img src="<?php echo base_url(); ?>assets/images/icons/payment/discover.jpg" alt=""></span>
                    <span><img src="<?php echo base_url(); ?>assets/images/icons/payment/american.jpg" alt=""></span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- –––––––––––––––[ FOOTER ]––––––––––––––– -->
<footer id="mainFooter" class="main-footer">
    <div class="container">
        <div class="row">
            <p><?php echo $this->lang->line('footer_line_3'); ?></p>
        </div>
    </div>
</footer>
<!-- –––––––––––––––[ END FOOTER ]––––––––––––––– -->

<!-- –––––––––––––––[ CONSTANTES JS ]––––––––––––––– -->
<input type="hidden" id="base_url" value="<?php echo base_url() ?>" />
<input type="hidden" id="total_favorites" value="<?php echo $this->users_favorites->countFavorites(); ?>" />
<input type="hidden" id="coef_deals" value="<?php echo $this->config->item('admin')['coef_deals']; ?>" />
<input type="hidden" id="coef_coupons" value="<?php echo $this->config->item('admin')['coef_coupons']; ?>" />
<input type="hidden" id="coef_quotation" value="<?php echo $this->config->item('admin')['coef_quotation']; ?>" />
<input type="hidden" id="currency" value="<?php echo $this->config->item('currency'); ?>" />
<input type="hidden" id="currency_position" value="<?php echo $this->config->item('currency_position'); ?>" />
<!-- –––––––––––––––[ END CONSTANTES JS ]––––––––––––––– -->
