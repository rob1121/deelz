<main id="mainContent" class="main-content">
    <!-- Page Container -->
    <div class="page-container ptb-60">
        <div class="container">
            <div class="row row-rl-10 row-tb-20">
                <div class="page-content col-xs-12 col-sm-8 col-md-9">

                    <!-- Checkout Area -->
                    <section class="section checkout-area panel prl-30 pt-20 pb-40">
                        <?php if($this->config->item('order_open') == true) : ?>
                        <h2 class="h2 mb-20 h-title" id='infoPerso'><?php echo lang('users_billing_l1'); ?></h2>
                        <form class="mb-30" method="post">
                            <?php if (validation_errors()) : ?>
                                <div class='alert alert-danger'>
                                    <?php echo validation_errors(); ?>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-6 form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" required="required" placeholder='<?php echo lang('firstname') ?>' name="firstname" id="firstname" data-validation="required" value="<?php echo!empty($_POST) ? set_value('firstname') : ($this->users->isLogged() ? current(explode(' ', $this->session->userdata('name'))) : '') ?>">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" required="required" placeholder='<?php echo lang('lastname') ?>' name="lastname" id="lastname" data-validation="required" value="<?php echo!empty($_POST) ? set_value('lastname') : ($this->users->isLogged() ? explode(' ', $this->session->userdata('name'))[1] : '') ?>">
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" class="form-control" required="required" placeholder='<?php echo lang('address') ?>' name="address" id="address" data-validation="required" value="<?php echo set_value('address') ?>">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" class="form-control" required="required" placeholder='<?php echo lang('zipcode') ?>' name="zipcode" id="zipcode" data-validation="required" minlength="5" maxlength="5" value="<?php echo set_value('zipcode') ?>">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    <input type="text" class="form-control" required="required" placeholder='<?php echo lang('city') ?>' name="city" id="city" data-validation="required" value="<?php echo set_value('city') ?>">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input type="text" class="form-control" required="required" placeholder='<?php echo lang('phone') ?>' name="phone" id="phone" data-validation="required" minlength="10" maxlength="10" value="<?php echo set_value('phone') ?>">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="text" class="form-control" required="required" placeholder='<?php echo lang('email') ?>' name="email" id="email" data-validation="required" <?php echo $this->users->isLogged() ? 'disabled' : ''?> value="<?php echo!empty($_POST) ? set_value('email') : ($this->users->isLogged() ? $this->session->userdata('email') : '') ?>">
                                    <?php if($this->users->isLogged()) : ?>
                                    <input type="hidden" name="email" value="<?php echo $this->session->userdata('email'); ?>" />
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea rows="5" maxlength="1000" class="form-control" required="required" data-validation="required" name="informations" id="informations"><?php echo!empty($_POST) ? set_value('informations') : lang('add_p_infos_title') ?></textarea>
                            </div>
                            <?php if (!$this->users->isLogged()) : ?>
                                <div class='col-md-12'>
                                    <div class="custom-checkbox mb-20">
                                        <input type="checkbox" id="newsletter" name="newsletter" value="1" checked>
                                        <label class="color-mid"><?php echo lang('users_billing_l2'); ?></label>
                                    </div>
                                    <div class="custom-checkbox mb-20">
                                        <input type="checkbox" id="legal" name="legal" value="1" <?php echo set_value('legal') == 1 ? 'checked' : '' ?>>
                                        <label class="color-mid"><?php echo lang('users_billing_l3'); ?></label>
                                    </div>
                                </div>
                            <?php else : ?>
                                <input type='hidden' name='legal' value='1' />
                            <?php endif; ?>

                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-lg btn-rounded mr-10"><i class="fa fa-check"></i> <?php echo lang('users_billing_l4'); ?></button>
                            </div>
                                <?php else : ?>
                                <div class='alert alert-danger text-center'>
                                    <h3><i class='fa fa-exclamation-triangle'></i> <?php echo lang('users_billing_l5'); ?></h3>
                                    <p>
                                        <?php echo lang('users_billing_l6'); ?>
                                    </p>
                                </div>
                                <?php endif; ?>
                        </form>
                    </section>
                    <!-- End Checkout Area -->

                </div>
                <div class="page-sidebar col-xs-12 col-sm-4 col-md-3">

                    <!-- Blog Sidebar -->
                    <aside class="sidebar blog-sidebar">
                        <div class="row row-tb-10">
                            <div class="col-xs-12">
                                <!-- Recent Posts -->
                                <div class="widget checkout-widget panel p-20">
                                    <div class="widget-body">
                                        <table class="table mb-15">
                                            <tbody>
                                                <tr>
                                                    <td class="color-mid"><?php echo lang('users_billing_l7'); ?></td>
                                                    <td><?php echo count($deals); ?></td>
                                                </tr>
                                                <tr class="font-15">
                                                    <td class="color-mid"><?php echo lang('users_billing_l8'); ?></td>
                                                    <td class="color-green">
                                                        <?php $total = 0; ?>
                                                        <?php foreach ($deals as $deal) : ?>
                                                            <?php $total += $deal->price_promo; ?>
                                                        <?php endforeach; ?>
                                                        <?php echo priceToShow($total); ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <a href="<?php echo base_url('users/cart') ?>" class="btn btn-info btn-block btn-xs"><i class="fa fa-shopping-cart"></i> <?php echo lang('users_billing_l9'); ?></a>
                                    </div>
                                </div>
                                <!-- End Recent Posts -->
                            </div>
                        </div>
                    </aside>
                    <!-- End Blog Sidebar -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Container -->
</main>
<?php $this->load->view('scripts/facebook_pixel', array('action' => 'InitiateCheckout', 'value' => $total)); ?> 