<form method="post" id="addDealProcess" action="<?php echo base_url('deals/save_deal') ?>"> 
    <!-- STEP 1 -->
    <div class="row row-rl-0 step_1">
        <div class="col-xs-12 text-right">
            <a href="<?php echo base_url('deals/add') ?>" class="btn btn-warning btn-xs changeCategory">< <?php echo $this->lang->line('back'); ?></a>
        </div>
        <div class="col-sm-6 col-md-6 col-left">
            <div class="mb-20">
                <h3 class='text-center' data-toggle='tooltip' title="<?php echo $this->lang->line('tooltip_category_choice_l1'); ?><?php echo $type; ?><?php echo $this->lang->line('tooltip_category_choice_l2'); ?>"><?php echo $this->lang->line('category_choice'); ?> <i class='fa fa-info'></i></h3>
                <hr />
                <?php $this->load->view('partial/categories', array('class' => 'nav-coupon-category panel', 'show_icons' => true, 'add_class' => 'categorieChoosed', 'no_link' => true)); ?>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-right">
            <div class="mb-20 subCategoriesChoosed" style="display: none">
                <h3 class='text-center' data-toggle='tooltip' title="<?php echo $this->lang->line('tooltip_subsactegory_choice_l1'); ?><?php echo $type; ?><?php echo $this->lang->line('tooltip_subsactegory_choice_l2'); ?>"><?php echo $this->lang->line('subsactegory_choice'); ?> <i class='fa fa-info'></i></h3>
                <hr />
                <ul class='nav-coupon-category panel subCategories'>

                </ul>
                <div class='subCategoryError alert alert-danger' style='display: none'>
                    <?php echo $this->lang->line('error_global'); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- STEP 2 -->
    <div class="row row-rl-0 step_2" style='display: none'>
        <div class="col-sm-12 col-md-12 col-left">
            <div class="mb-20">
                <div class="col-md-6 text-left">
                    <span class="categoryChoosed"></span> <span class="subCategoryChoosed"></span>
                </div>
                <div class="col-md-6 text-right">
                    <a href="#" class="btn btn-warning btn-xs changeCategory">< <?php echo $this->lang->line('change_category'); ?></a>
                </div>
                <h3 class='text-center'><?php echo $this->lang->line('deal_creation'); ?> <?php echo $type; ?></h3>
                <hr />

                <div class="col-md-12 text-center">
                    <p>
                        <a href="#" class="btn btn-facebook" data-toggle="modal" data-target="#chooseCover"><i class="fa fa-photo"></i> <?php echo $this->lang->line('choose_cover'); ?></a>
                    <div class="alert alert-danger mb-0 mt-5 errorCover" style="display: none"><?php echo $this->lang->line('choose_cover_l1'); ?><?php echo $type; ?><?php echo $this->lang->line('choose_cover_l2'); ?><?php echo $type; ?>.</div>
                    </p>
                    <p>
                        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addPics"><i class="fa fa-photo"></i> <?php echo $this->lang->line('add_pics'); ?></a>
                    </p>
                </div>
                <div class="col-md-12 form-group">
                    <label><?php echo $this->lang->line('add_p_title_l1'); ?> <?php echo $type; ?> <?php echo $this->lang->line('add_p_title_l2'); ?></label>
                    <input type="text" class="form-control" maxlength="25" required="required" name="title" id="title" placeholder='<?php echo $this->lang->line('add_p_title_input'); ?> <?php echo $type; ?>'>
                    <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_title_error'); ?></div>
                </div>
                <div class="col-md-12 form-group">
                    <label><?php echo $this->lang->line('add_p_desc_l1'); ?> <?php echo $type; ?> <?php echo $this->lang->line('add_p_desc_l2'); ?></label>
                    <input type="text" class="form-control" required="required" name="excerpt" id="excerpt" maxlength="85" placeholder='<?php echo $this->lang->line('add_p_desc_input'); ?> <?php echo $type; ?>'>
                    <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_desc_error'); ?></div>
                </div>
                <div class="col-md-6 form-group">

                    <label><?php echo $this->lang->line('add_p_date1_l1'); ?> <?php echo $type; ?> <?php echo $this->lang->line('add_p_date1_l2'); ?></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control" required="required" name="start" id="start" placeholder='<?php echo $this->lang->line('add_p_date1_input'); ?>' data-validation="required">
                    </div>
                    <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_date1_error'); ?> <?php echo $type; ?>.</div>
                </div>
                <div class="col-md-6 form-group">
                    <label><?php echo $this->lang->line('add_p_date2_l1'); ?> <?php echo $type; ?> <?php echo $this->lang->line('add_p_date2_l2'); ?></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control" required="required" name="end" id="end" placeholder='<?php echo $this->lang->line('add_p_date2_input'); ?>' data-validation="required">
                    </div>
                    <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_date2_error'); ?> <?php echo $type; ?>.</div>
                </div>
                <?php if ($type == 'bon plan') : ?>
                    <div class="col-md-12 form-group">
                        <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_info_tooltip'); ?>"><?php echo $this->lang->line('add_p_info_title'); ?> <i class='fa fa-info'></i></label>
                        <select name='price_type' id='price_type' class='form-control'>
                            <option value='price'><?php echo $this->lang->line('add_p_info_fixed_price'); ?></option>
                            <option value='quotation'><?php echo $this->lang->line('on_quotation'); ?></option>
                            <option value='free'><?php echo $this->lang->line('free'); ?></option>
                        </select>
                    </div>
                    <div class="col-md-12 form-group quotation_onlineField" style="display: none">
                        <div class="custom-checkbox mb-20">
                            <input type="checkbox" id="quotation_online" name="quotation_online" value="1">
                            <label class="color-mid"><?php echo $this->lang->line('add_p_online_quotation'); ?></label>
                        </div>
                    </div>
                <?php else : ?>
                    <input type='hidden' name="price_type" id="price_type" value="price" />
                <?php endif; ?>
                <div class="col-md-6 form-group price_baseField">
                    <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_price_tooltip'); ?>"><?php echo $this->lang->line('add_p_price_title_l1'); ?> <?php echo ($type == 'bon plan' ? $this->lang->line('add_p_price_title_l2') : $this->lang->line('add_p_price_title_l2_2')) ?> <i class='fa fa-info'></i></label>
                    <div class="input-group"> 
                        <input type="text" class="form-control" required="required" name="price_base" id="price_base" placeholder='<?php echo $this->lang->line('add_p_price_input_l1'); ?> <?php echo ($type == 'bon plan' ? $this->lang->line('add_p_price_input_l2') : $this->lang->line('add_p_price_input_l2_2')) ?>' data-validation="required">
                        <span class="input-group-addon"><?php echo $this->config->item('currency'); ?></span>
                    </div>
                    <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_price_error_l1'); ?><?php echo $type; ?> <?php echo $this->lang->line('add_p_price_error_l2'); ?></div>
                </div>
                <?php if ($type == 'bon plan') : ?>
                    <input type='hidden' name="price_promo" id="price_promo" value="0" />
                    <input type='hidden' name="promo_amount" id="promo_amount" value="0" />
                    <input type='hidden' name="promo_discount" id="promo_discount" value="0" />
                <?php else : ?>
                    <div class="col-md-6 form-group">
                        <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_pricepromo_tooltip'); ?>"><?php echo $this->lang->line('add_p_pricepromo_title'); ?> <i class='fa fa-info'></i></label>
                        <div class="input-group">
                            <input type="text" class="form-control" required="required" name="price_promo" id="price_promo" placeholder='<?php echo $this->lang->line('add_p_pricepromo_input'); ?>' data-validation="required">
                            <span class="input-group-addon"><?php echo $this->config->item('currency'); ?></span>
                        </div>
                        <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_pricepromo_error_l1'); ?> <?php echo $type; ?> <?php echo $this->lang->line('add_p_pricepromo_error_l2'); ?></div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_pricepromo_info'); ?>"><?php echo $this->lang->line('add_p_promoamount_tooltip'); ?> <i class='fa fa-info'></i></label>
                        <div class="input-group">
                            <input type="text" class="form-control" required="required" name="promo_amount" id="promo_amount" placeholder='<?php echo $this->lang->line('add_p_promoamount_input'); ?>' data-validation="required">
                            <span class="input-group-addon"><?php echo $this->config->item('currency'); ?></span>
                        </div>
                        <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_promoamount_error'); ?></div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_promop_tooltip'); ?>"><?php echo $this->lang->line('add_p_promop_title'); ?> <i class='fa fa-info'></i></label>
                        <div class="input-group">
                            <input type="text" class="form-control" required="required" name="promo_discount" id="promo_discount" placeholder='<?php echo $this->lang->line('add_p_promop_input'); ?>' data-validation="required">
                            <span class="input-group-addon">%</span>
                        </div>
                        <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_promop_error'); ?></div>
                    </div>
                <?php endif; ?>
                <div class='col-md-12 color-green text-center' id='commission' style='display: none'>
                    <h4><?php echo $this->lang->line('add_p_salecalc_l1'); ?></h4>
                    <h4><small><em><?php echo $this->lang->line('add_p_salecalc_l2'); ?></em></small></h4>
                    <h4>XXX<?php echo $this->config->item('currency'); ?></h4>
                </div>
                <div class='col-md-12 color-green text-center mb-20' id='coupon' style='display: none'>
                    <h4><?php echo $this->lang->line('add_p_coupon_l1'); ?></h4>
                    <a class='btn btn-info coupon_choose' num='10'>10 <?php echo $this->lang->line('coupons'); ?> = <span>X<?php echo $this->config->item('currency'); ?></span><?php echo $this->config->item('excluding_taxe'); ?></a>
                    <a class='btn coupon_choose' num='50'>50 <?php echo $this->lang->line('coupons'); ?> = <span>X<?php echo $this->config->item('currency'); ?></span><?php echo $this->config->item('excluding_taxe'); ?></a>
                    <a class='btn coupon_choose' num='100'>100 <?php echo $this->lang->line('coupons'); ?> = <span>X<?php echo $this->config->item('currency'); ?></span><?php echo $this->config->item('excluding_taxe'); ?></a>
                    <h4><small><em><?php echo $this->lang->line('add_p_coupon_l2'); ?></em></small></h4>
                </div>
                <div class='col-md-12 color-green text-center' id='plan' style='display: none'>
                    <h4><?php echo $this->lang->line('add_p_quotation_l1'); ?></h4>
                    <h4><?php echo $this->lang->line('add_p_quotation_free'); ?></h4>
                </div>
                <div class='col-md-12 color-green text-center mb-20' id='plan_quotation' style='display: none'>
                    <h4><?php echo $this->lang->line('add_p_quotation_l2'); ?></h4>
                    <a class='btn btn-info coupon_choose' num='10'>10 <?php echo $this->lang->line('quotation'); ?> = <span><?php echo priceToShow(10 * $this->config->item('admin')['coef_quotation']); ?></span><?php echo $this->config->item('excluding_taxe'); ?></a>
                    <a class='btn coupon_choose' num='50'>50 <?php echo $this->lang->line('quotation'); ?> = <span><?php echo priceToShow(50 * $this->config->item('admin')['coef_quotation']); ?>/span><?php echo $this->config->item('excluding_taxe'); ?></a>
                    <a class='btn coupon_choose' num='100'>100 <?php echo $this->lang->line('quotation'); ?> = <span><?php echo priceToShow(250 * $this->config->item('admin')['coef_quotation']); ?></span><?php echo $this->config->item('excluding_taxe'); ?></a>
                    <h4>
                        <small>
                            <em><?php echo $this->lang->line('add_p_quotation_l3'); ?></em>
                        </small>
                    </h4>
                </div> 
                <div class="col-md-12 pl-0 pr-0">
                    <div class="col-md-<?php echo $type == 'bon de réduction' ? '12' : '6' ?> form-group">
                        <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_public_tooltip'); ?>"><?php echo $this->lang->line('add_p_public_opt1'); ?> <i class='fa fa-info'></i></label>
                        <select class="form-control" name='target'>
                            <option value='1'><?php echo $this->lang->line('add_p_public_opt2'); ?></option>
                            <option value='2'><?php echo $this->lang->line('add_p_public_opt3'); ?></option>
                            <option value='3'><?php echo $this->lang->line('add_p_public_opt4'); ?></option>
                            <option value='4'><?php echo $this->lang->line('add_p_public_opt5'); ?></option>
                            <option value='5'><?php echo $this->lang->line('add_p_public_opt6'); ?></option>
                        </select>
                    </div>
                    <?php if ($type == 'deal' || $type == 'bon de réduction') : ?>
                        <div class="col-md-6 form-group" >
                            <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_use_tooltip'); ?>"><?php echo $this->lang->line('add_p_use_opt1'); ?> <i class='fa fa-info'></i></label>
                            <select class="form-control" id='validite' name='validity'>
                                <option value='1'><?php echo $this->lang->line('add_p_use_opt2'); ?></option>
                                <option value='2'><?php echo $this->lang->line('add_p_use_opt3'); ?></option>
                                <option value='3'><?php echo $this->lang->line('add_p_use_opt4'); ?></option>
                                <option value='4'><?php echo $this->lang->line('add_p_use_opt5'); ?></option>
                            </select>
                        </div>
                    <?php elseif ($type == 'bon plan') : ?>
                        <div class="col-md-6 form-group" >
                            <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_validity_tooltip'); ?>"><?php echo $this->lang->line('add_p_validity_opt1'); ?> <i class='fa fa-info'></i></label>
                            <select class="form-control" id='validite' name='validity'>
                                <option value='5'><?php echo $this->lang->line('add_p_validity_opt2'); ?></option>
                                <option value='4'><?php echo $this->lang->line('add_p_validity_opt3'); ?></option>
                            </select>
                        </div> 
                    <?php endif; ?>
                    <div class="col-md-6 form-group <?php echo $type != 'bon de réduction' ? 'col-md-push-6' : '' ?>" style='display: none' id='date_valid_group'>
                        <label><?php echo $this->lang->line('add_p_validitydate_title'); ?> <?php echo $type; ?></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control" name="date_valid" id="date_valid" placeholder='<?php echo $this->lang->line('add_p_validitydate_input'); ?>' data-validation="required">
                        </div>
                        <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_validitydate_error'); ?> <?php echo $type; ?>.</div>
                    </div>
                </div>
                <div class="col-md-<?php echo $type == 'deal' ? '6' : '12'; ?> form-group" >
                    <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_rdv_tooltip'); ?>"><?php echo $this->lang->line('add_p_rdv_title'); ?> <i class='fa fa-info'></i></label>
                    <select class="form-control" id='use' name='use'>
                        <option value='1'><?php echo $this->lang->line('add_p_rdv_opt1'); ?></option>
                        <option value='2'><?php echo $this->lang->line('add_p_rdv_opt2'); ?></option>
                        <option value='3'><?php echo $this->lang->line('add_p_rdv_opt3'); ?></option>
                    </select>
                </div>
                <?php if ($type == 'deal') : ?>
                    <div class="col-md-6 form-group" >
                        <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_couponsnum_tooltip'); ?>"><?php echo $this->lang->line('add_p_couponsnum_title'); ?> <i class='fa fa-info'></i></label>
                        <select class="form-control" id='quantity' name='quantity'>
                            <option value="1000">1000</option>
                            <option value="500">500</option>
                            <option value="100" selected>100</option> 
                            <option value="50">50</option>
                            <?php for ($i = 25; $i >= 1; $i--) : ?>
                                <option value='<?php echo $i; ?>'><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                <?php else : ?>
                    <input type="hidden" id='quantity' name='quantity' value="0" />
                <?php endif; ?>

                <div class="col-md-12 form-group">
                    <label><?php echo $this->lang->line('add_p_description_title_l1'); ?> <?php echo $type; ?> <?php echo $this->lang->line('add_p_description_title_l2'); ?> <br class='hidden-xs' /><em class='hidden-xs'><?php echo $this->lang->line('add_p_description_title_l3'); ?></em></label>
                    <textarea rows="5" class="form-control" required="required" name="content" id="content" data-validation="required"></textarea>
                    <div class="text-right" id="charNum"></div>
                    <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_description_error_l1'); ?> <?php echo $type; ?> <?php echo $this->lang->line('add_p_description_error_l2'); ?></div>
                </div>
                <div class="col-md-12 text-right">
                    <p>&nbsp;</p>
                    <p>
                        <a href="#" class="btn btn-success goStep3"><i class="fa fa-arrow-right"></i> <?php echo $this->lang->line('add_p_next_step'); ?></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- STEP 3 -->
    <div class="row row-rl-0 step_3" style='display: none'>
        <div class="col-sm-12 col-md-12 col-left">
            <div class="mb-20">
                <div class="col-md-6 text-left">
                    <span class="categoryChoosed"></span> <span class="subCategoryChoosed"></span>
                </div>
                <?php if ($type == 'boutique') : ?>
                    <div class="col-md-6 text-right">
                        <a href="<?php echo base_url('deals/add') ?>" class="btn btn-warning btn-xs">< <?php echo $this->lang->line('change_category'); ?></a>
                    </div>
                <?php else : ?>
                    <div class="col-md-6 text-right">
                        <a href="#" class="btn btn-warning btn-xs modifyDeal">< <?php echo $this->lang->line('add_p_modify'); ?> <?php echo $type; ?></a>
                    </div>
                <?php endif; ?>
                <h3 class='text-center'><?php echo $this->lang->line('add_p_companyinfo_title'); ?></h3>
                <hr />
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-building"></i></span>
                        <input type="text" maxlength="30" class="form-control" required="required" placeholder='<?php echo $this->lang->line('add_p_companyinfo_input'); ?>' name="company" id="company" data-validation="required">
                    </div>
                    <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_companyinfo_error_l1'); ?> <?php echo $type == 'boutique' ? $this->lang->line('add_p_companyinfo_title_l2') : $this->lang->line('add_p_companyinfo_title_l2_2'); ?> <?php echo $type; ?>.</div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-building"></i></span>
                        <input type="text" class="form-control" required="required" placeholder='<?php echo $this->lang->line('add_p_companynum_title'); ?>' name="siret" id="siret" data-validation="required">
                    </div>
                    <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_companynum_error'); ?></div>
                </div>
                <div class="col-md-12 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" required="required" placeholder='<?php echo $this->lang->line('add_p_names_title'); ?>' name="name_dealer" id="name_dealer" data-validation="required">
                    </div>
                    <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_names_error'); ?></div>
                </div>
                <div class="col-md-12 form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                        <input type="text" class="form-control" required="required" placeholder='<?php echo $this->lang->line('add_p_address_title'); ?>' name="address" id="address" data-validation="required">
                    </div>
                    <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_address_error'); ?></div>
                </div>
                <div class='col-md-12 pl-0 pr-0'>
                    <div class="col-md-6 form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            <input type="text" class="form-control" maxlength="5" required="required" placeholder='<?php echo $this->lang->line('add_p_zipcode_title'); ?>' name="zipcode" id="zipcode" data-validation="required">
                        </div>
                        <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_zipcode_error'); ?></div>
                    </div>
                    <div class="col-md-6 form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            <input type="text" class="form-control" maxlength="5" required="required" placeholder='<?php echo $this->lang->line('add_p_city_input'); ?>' name="city" id="city" data-validation="required">
                        </div>
                        <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_city_error'); ?></div>
                    </div>
                </div>
                <div class='col-md-12 pl-0 pr-0'>
                    <div class="col-md-6 form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="text" class="form-control" required="required" placeholder='<?php echo $this->lang->line('add_p_phone_title'); ?>' name="phone" id="phone" data-validation="required">
                        </div>
                        <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_phone_error'); ?></div>
                    </div>
                    <div class="col-md-6 form-group">
                        <div class="input-group">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" required="required" placeholder='<?php echo $this->lang->line('add_p_email_title'); ?>' name="email" id="email" data-validation="required">
                        </div>
                        <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_email_error'); ?></div>
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <textarea maxlength="300" rows="5" class="form-control" required="required" data-validation="required" name="informations" id="informations"><?php echo $this->lang->line('add_p_infos_title'); ?></textarea>
                </div>
                <div class='col-md-12'>
                    <div class="custom-checkbox mb-20">
                        <input type="checkbox" id="legal" name="legal" value="2">
                        <label class="color-mid"><?php echo $this->lang->line('add_p_legal_title'); ?></label>
                        <?php if (isset($_GET['error']) && $_GET['error'] == 'legal') : ?>
                            <div class="alert alert-danger mb-0 mt-5"><?php echo $this->lang->line('add_p_checkbox_error'); ?></div>
                        <?php endif; ?>
                        <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_legal_error'); ?></div>
                    </div>
                </div>
                <?php if ($type == 'boutique') : ?>
                    <div class='col-md-12'>
                        <div class="g-recaptcha mb-10" data-sitekey="<?php echo $this->config->item('recaptcha_key_site') ?>"></div>
                        <?php if (isset($_GET['error']) && $_GET['error'] == 'captcha') : ?>
                            <div class="alert alert-danger mb-0 mt-5"><?php echo $this->lang->line('add_p_checkbox_error'); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="col-md-12 text-right">
                    <p>&nbsp;</p>
                    <p>
                        <a href="#" class="btn btn-success validDeal"><i class="fa fa-check"></i> <?php echo $type == 'boutique' ? $this->lang->line('add_p_add_company') : $this->lang->line('add_p_valid_deal') . ' ' . $type; ?></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="type_deal_full" id="type_deal_full" value="<?php echo $type; ?>" />
    <input type="hidden" name="type_deal" id="type_deal" value="<?php echo url_title($type); ?>" />
    <input type="hidden" name="cover" id="cover" value="" />
    <input type="hidden" name="latitude" id="latitude" value="" />
    <input type="hidden" name="longitude" id="longitude" value="" />
    <input type="hidden" name="category_id" id="category_id" value="" />
    <input type="hidden" name="subcategory_id" id="subcategory_id" value="" />
    <input type="hidden" name="coupons" id="coupons" value="<?php echo url_title($type) == 'bon-de-réduction' ? 10 : 0 ?>" />
    <input type="hidden" name="pro_id" id="pro_id" value="<?php echo $this->session->userdata('pro_id'); ?>" />
</form>

<!--MODALS-->
<div id="chooseCover" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('add_p_choose_cover_title'); ?> <?php echo $type ?></h4>
                <p><?php echo $this->lang->line('add_p_choose_cover_l1'); ?> <?php echo $type ?> <?php echo $this->lang->line('add_p_choose_cover_l2'); ?> <?php echo $type ?><?php echo $this->lang->line('add_p_choose_cover_l3'); ?></p>
            </div>
            <div class="modal-body covers">
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<div id="addPics"  class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('add_p_add_pic_title'); ?></h4>
            </div>
            <div class="modal-body text-center">
                <div action="" class="dropzone" id="addMyPics"></div>
            </div>
            <div class="modal-footer">
                <button class="btn" onclick="$('#addPics').modal('hide')"><i class="fa fa-check"></i> <?php echo $this->lang->line('validate'); ?></button>
            </div>
        </div>
    </div>
</div>