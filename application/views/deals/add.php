<main id="mainContent" class="main-content">
    <!-- Page Container -->
    <div class="page-container ptb-60">
        <div class="container">
            <div class="row row-rl-10 row-tb-20">
                <div class="page-content col-xs-12 col-sm-12 col-md-12">
                    <!-- Type de deal -->
                    <section class="section checkout-area panel prl-30 pt-20 pb-40 text-center">
                        <?php if ($this->users_pro->isLogged()) : ?>
                            <h2 class="h3 mb-20"><?php echo $this->lang->line('connected_line_1'); ?></h2>
                            <hr />
                            <p class="mb-20"><?php echo $this->lang->line('connected_line_2'); ?></p>
                            <p>
                                <?php if (isset($this->config->item('admin')['active_deal']) && $this->config->item('admin')['active_deal'] == 1) : ?>
                                    <a href="<?php echo base_url('deals/add_online'); ?>" class="btn btn-lg btn-rounded mr-10 mb-10" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_add_online'); ?>"><span style="position:relative; width: 200px; top: -10px"><i class='fa fa-credit-card'></i> <?php echo $this->lang->line('tooltip_add_online_l1'); ?><br /><small style="margin-left: 15px;"><?php echo $this->lang->line('tooltip_add_online_l2'); ?></small></span></a>
                                <?php endif; ?>
                                <?php if (isset($this->config->item('admin')['active_coupon']) && $this->config->item('admin')['active_coupon'] == 1) : ?>
                                    <a href="<?php echo base_url('deals/add_coupon'); ?>" class="btn btn-lg btn-info btn-rounded mr-10 mb-10" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_add_coupon'); ?>"><span style="position:relative; width: 200px; top: -10px"><i class='fa fa-tags'></i> <?php echo $this->lang->line('tooltip_add_coupon_l1'); ?><br /><small style="margin-left: 15px;"><?php echo $this->lang->line('tooltip_add_coupon_l2'); ?></small></span></a>
                                <?php endif; ?>
                                <?php if (isset($this->config->item('admin')['active_bon-plan']) && $this->config->item('admin')['active_bon-plan'] == 1) : ?>
                                    <a href="<?php echo base_url('deals/add_other'); ?>" class="btn btn-lg btn-rounded btn-warning mb-10" data-toggle="tooltip" title="<?php echo $this->lang->line('tooltip_add_other'); ?>"><span style="position:relative; width: 200px; top: -10px"><i class='fa fa-comments'></i> <?php echo $this->lang->line('tooltip_add_other_l1'); ?><br /><small style="margin-left: 15px;"><?php echo $this->lang->line('tooltip_add_other_l2'); ?></small></span></a>
                                <?php endif; ?>
                            </p>
                        <?php else : ?>
                            <?php if (isset($this->config->item('admin')['active_pro']) && $this->config->item('admin')['active_pro'] == 1) : ?>
                                <h1 class="h-title mb-30 text-center"><?php echo $this->lang->line('line_1'); ?></h1>
                                <h2 class="h3 mb-20"><?php echo $this->lang->line('line_2'); ?></h2>
                                <p>
                                    <a href="<?php echo $this->lang->line('button_l'); ?>" class="btn btn-lg btn-rounded btn-lg mb-10"><?php echo $this->lang->line('button_t'); ?></a>
                                </p> 
                                <p class="text-center">
                                    <?php echo $this->lang->line('line_3'); ?>
                                </p> 
                            <?php endif; ?>
                        <?php endif; ?>  

                        <?php if ($this->config->item('call_me_back') == true) : ?>
                            <a href="#" class="btn btn-info btn-xs mb-10" onclick="$('#callbackPro').slideDown(); return false;"><i class="fa fa-phone"></i> <?php echo $this->lang->line('call_back'); ?></a>
                            <?php $errors = validation_errors(); ?>
                            <div id="callbackPro" style="<?php echo empty($errors) ? 'display: none' : '' ?>" class="mt-20">
                                <form method="post" action="<?php echo current_url(); ?>#callbackPro">
                                    <?php if (validation_errors()) : ?>
                                        <div class='alert alert-danger'> 
                                            <?php echo validation_errors(); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label class="sr-only"><?php echo $this->lang->line('names'); ?></label>
                                        <input type="text" class="form-control input-lg" placeholder="<?php echo $this->lang->line('names'); ?>" name="name" value="<?php echo set_value('name') ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only"><?php echo $this->lang->line('phone'); ?></label>
                                        <input type="text" class="form-control input-lg" placeholder="<?php echo $this->lang->line('phone'); ?>" name="phone" value="<?php echo set_value('phone') ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only"><?php echo $this->lang->line('call_back_time'); ?></label>
                                        <select name="time" class="form-control">
                                            <option value="08h-12h" <?php echo isset($_POST['time']) && $_POST['time'] == '08h-12h' ? 'selected' : '' ?>>08h - 12h</option>
                                            <option value="12h-14h" <?php echo isset($_POST['time']) && $_POST['time'] == '12h-14h' ? 'selected' : '' ?>>12h - 14h</option>
                                            <option value="14h-18h" <?php echo isset($_POST['time']) && $_POST['time'] == '14h-18h' ? 'selected' : '' ?>>14h - 18h</option>
                                            <option value="18h-21h" <?php echo isset($_POST['time']) && $_POST['time'] == '18h-21h' ? 'selected' : '' ?>>18h - 21h</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only"><?php echo $this->lang->line('your_company'); ?></label>
                                        <input type="text" class="form-control input-lg" placeholder="<?php echo $this->lang->line('your_company'); ?>" name="company" value="<?php echo set_value('company') ?>">
                                    </div>
                                    <button type="submit" class="btn"><?php echo $this->lang->line('ask_callback'); ?></button>
                                </form>
                            </div>
                        <?php endif; ?>

                        <?php echo $this->cms->show('deals', 'add'); ?>
                </div>

                <?php if (!$this->users_pro->isLogged()) : ?>
                    <p class="text-right pt-30"> 
                        <a class='btn btn-xs' href="<?php echo base_url('store/signin'); ?>"><i class='fa fa-lock'></i> <?php echo $this->lang->line('already_pro'); ?></a>
                    </p>
                <?php endif; ?>
                </section>
                <!-- End Type de deal -->
            </div>

        </div>
    </div>
</div>
<!-- End Page Container -->


</main>