<?php
$is_favorite = $this->users_favorites->isFavorite($deal->deal_id);
?>
<main id="mainContent" class="main-content">
    <!-- Page Container -->
    <div class="page-container ptb-60">
        <div class="container">
            <div class="row row-rl-10 row-tb-20">
                <div class="page-content col-xs-12 col-sm-7 col-md-8">
                    <div class="row row-tb-20">
                        <div class="col-xs-12 hidden-lg hidden-md hidden-sm">
                            <div class="widget single-deal-widget panel pt-10 prl-20">
                                <div class="widget-body text-center">
                                    <h2 class="mb-20 h3">
                                        <?php echo $deal->title ?>
                                    </h2>
                                    <ul class="deal-meta list-inline mb-10 color-mid">
                                        <li><i class="ico fa fa-user mr-10"></i><a href="#" class="color-mid"><?php echo $deal->company ?></a>
                                        </li>
                                        <li><i class="ico fa fa-map-marker mr-10"></i><?php echo $deal->city ?></li>
                                        <li><i class="ico <?php echo getDealTypeIcon($deal->type_deal); ?> mr-10"></i><?php echo getDealType($deal->type_deal); ?></li>
                                    </ul>
                                    <div class="price mb-20">
                                        <?php if ($deal->price_promo > 0) : ?>
                                            <div class="label-discount label-discount-deal top-10 right-10">-<?php echo $deal->promo_discount; ?>%</div>
                                            <h2 class="price"><span class="price-sale"><?php echo priceToShow($deal->price_base) ?></span> <?php echo priceToShow($deal->price_promo) ?></h2>
                                        <?php else : ?>
                                            <?php if ($deal->price_base > 0) : ?>
                                                <h2 class="price"><?php echo priceToShow($deal->price_base) ?></h2>
                                            <?php else : ?>
                                                <h2 class="price"><?php echo $deal->price_type == 'quotation' ? $this->lang->line('on_quotation') : strtoupper($this->lang->line('free')) ?></h2>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="deal-deatails panel">
                                <div class="deal-slider">
                                    <div id="product_slider" class="flexslider">
                                        <ul class="slides">
                                            <li>
                                                <img alt="" src="<?php echo base_url('assets/images/') . urldecode($deal->cover) ?>">
                                                <span class='illustrative'><?php echo $this->lang->line('deal_illustrate_pic'); ?></span>
                                            </li>
                                            <?php
                                            $files = false;
                                            $path = $this->config->item('base_path') . 'assets/images/products/' . $deal->deal_id;
                                            ?>
                                            <?php if (is_dir($path)) : ?>
                                                <?php $files = array_diff(scandir($path), array('.', '..')); ?>
                                                <?php if ($files) : ?>
                                                    <?php foreach ($files as $file) : ?>
                                                        <?php if (strpos($file, 'thumb') && urldecode($deal->cover) != 'products/' . $deal->deal_id . '/' . urldecode($file)) : ?>
                                                            <li>
                                                                <img alt="" src="<?php echo base_url('assets/images/products/' . $deal->deal_id . '/') . urldecode($file) ?>">
                                                                <?php if ($this->session->userdata('role') == 'admin') : ?>
                                                                    <span class='illustrative'>
                                                                        <div class="custom-checkbox mb-20">
                                                                            <input type="checkbox" class='selectCouv' value="<?php echo 'products/' . $deal->deal_id . '/' . urlencode($file) ?>">
                                                                            <label class="color-mid"><?php echo $this->lang->line('deal_e_cover'); ?></label>
                                                                        </div>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <?php if ($files) : ?>
                                        <div id="product_slider_nav" class="flexslider flexslider-nav">
                                            <ul class="slides">
                                                <li>
                                                    <img alt="" src="<?php echo base_url('assets/images/' . $deal->cover) ?>">
                                                </li>
                                                <?php foreach ($files as $file) : ?>
                                                    <?php if (strpos($file, 'thumb') && urldecode($deal->cover) != 'products/' . $deal->deal_id . '/' . urldecode($file)) : ?>
                                                        <li>
                                                            <img alt="" src="<?php echo base_url('assets/images/products/' . $deal->deal_id . '/' . $file) ?>">
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="deal-body p-20">
                                    <h3 class="mb-10"><?php echo substr($deal->excerpt, 0, 85); ?></h3>
                                    <!--<div class="rating mb-10">
                                        <span class="rating-stars" data-rating="3">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </span>
                                    </div>-->
                                    <?php if ($deal->price_promo > 0) : ?>
                                        <h2 class="price mb-15"><?php echo priceToShow($deal->price_promo); ?></h2>
                                    <?php else : ?>
                                        <?php if ($deal->price_base > 0) : ?>
                                            <h2 class="price mb-15"><?php echo priceToShow($deal->price_base) ?></h2>
                                        <?php else : ?>
                                            <h2 class="price mb-15"><?php echo $deal->price_type == 'quotation' ? $this->lang->line('on_quotation') : strtoupper($this->lang->line('free')) ?></h2>
                                        <?php endif; ?>
                                    <?php endif; ?>


                                    <form method="post" action="<?php echo base_url('deals/deal_update') ?>">
                                        <div class="col-md-6 form-group">
                                            <label>Catégorie</label>
                                            <select name="categories_id" id="categories_id" class="form-control">
                                                <?php $categories = $this->categories->getAll(); ?>
                                                <?php if ($categories) : ?>
                                                    <?php foreach ($categories as $category) : ?>
                                                        <option value="<?php echo $category->id; ?>" <?php echo $category->id == $deal->categories_id ? 'selected' : '' ?>><?php echo $category->name; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div> 
                                        <div class="col-md-6 form-group">
                                            <label>Sous-catégorie</label>
                                            <select name="sub_categories_id" id="sub_categories_id" class="form-control">
                                                <?php $sub_categories = $this->sub_categories->getAll(); ?>
                                                <?php if ($sub_categories) : ?>
                                                    <?php foreach ($sub_categories as $sub_category) : ?>
                                                        <option value="<?php echo $sub_category->id; ?>" <?php echo $sub_category->id == $deal->sub_categories_id ? 'selected' : '' ?>>
                                                            <?php
                                                            foreach ($categories as $category) {
                                                                if ($category->id == $sub_category->categories_id) {
                                                                    echo $category->name . ' > ';
                                                                }
                                                            }
                                                            ?>
                                                            <?php echo $sub_category->name; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div> 
                                        <div class="col-md-12 form-group">
                                            <label><?php echo $this->lang->line('add_p_title_l1'); ?> <?php echo $deal->type_deal_full; ?>  <?php echo $this->lang->line('add_p_title_l2'); ?></label>
                                            <input type="text" class="form-control" maxlength="25" required="required" name="title" id="title" placeholder='<?php echo $this->lang->line('add_p_title_input'); ?> <?php echo $deal->type_deal_full; ?>' value="<?php echo $deal->title; ?>">
                                            <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_title_error'); ?></div>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label><?php echo $this->lang->line('add_p_desc_l1'); ?> <?php echo $deal->type_deal_full; ?> <?php echo $this->lang->line('add_p_desc_l2'); ?></label>
                                            <input type="text" class="form-control" required="required" name="excerpt" id="excerpt" maxlength="85" placeholder='<?php echo $this->lang->line('add_p_desc_input'); ?> <?php echo $deal->type_deal_full; ?>' value="<?php echo $deal->excerpt; ?>">
                                            <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_desc_error'); ?></div>
                                        </div>
                                        <div class="col-md-6 form-group">

                                            <label><?php echo $this->lang->line('add_p_date1_l1'); ?> <?php echo $deal->type_deal_full; ?> <?php echo $this->lang->line('add_p_date1_l2'); ?></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control" required="required" name="start" id="start" placeholder='<?php echo $this->lang->line('add_p_date1_input'); ?>' data-validation="required" value="<?php echo dateBDD_to_FR($deal->start); ?>">
                                            </div>
                                            <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_date1_error'); ?> <?php echo $deal->type_deal_full; ?>.</div>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label><?php echo $this->lang->line('add_p_date2_l1'); ?> <?php echo $deal->type_deal_full; ?> <?php echo $this->lang->line('add_p_date2_l2'); ?></label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control" required="required" name="end" id="end" placeholder='<?php echo $this->lang->line('add_p_date2_input'); ?>' data-validation="required" value="<?php echo dateBDD_to_FR($deal->end); ?>">
                                            </div>
                                            <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_date2_error'); ?> <?php echo $deal->type_deal_full; ?>.</div>
                                        </div>
                                        <?php if ($deal->type_deal == 'bon-plan') : ?> 
                                            <div class="col-md-12 form-group">
                                                <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_info_tooltip'); ?>"><?php echo $this->lang->line('add_p_info_title'); ?> <i class='fa fa-info'></i></label>
                                                <select name='price_type' id='price_type' class='form-control'>
                                                    <option value='price' <?php echo $deal->price_type == 'price' ? 'selected' : '' ?>><?php echo $this->lang->line('add_p_info_fixed_price'); ?></option>
                                                    <option value='quotation' <?php echo $deal->price_type == 'quotation' ? 'selected' : '' ?>><?php echo $this->lang->line('on_quotation'); ?></option>
                                                    <option value='free' <?php echo $deal->price_type == 'free' ? 'selected' : '' ?>><?php echo $this->lang->line('free'); ?></option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 form-group quotation_onlineField" <?php echo $deal->price_type == 'quotation' ? '' : 'style="display: none"' ?>>
                                                <div class="custom-checkbox mb-20">
                                                    <input type="checkbox" id="quotation_online" name="quotation_online" value="1" <?php echo $deal->quotation_online == 1 ? 'checked' : '' ?>>
                                                    <label class="<?php echo $deal->price_type == 'quotation' && $deal->coupons == 0 ? 'color-danger' : 'color-mid' ?>"><?php echo $this->lang->line('add_p_online_quotation'); ?></label>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <input type='hidden' name="price_type" id="price_type" value="price" />
                                        <?php endif; ?>
                                        <div class="col-md-12 form-group" <?php echo $deal->price_type != 'quotation' || $deal->type_deal != 'bon-plan' ? '' : 'style="display: none"' ?>>
                                            <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_price_tooltip'); ?>"><?php echo $this->lang->line('add_p_price_title_l1'); ?> <?php echo ($deal->type_deal_full == 'bon plan' ? $this->lang->line('add_p_price_title_l2') : $this->lang->line('add_p_price_title_l2_2')) ?> <i class='fa fa-info'></i></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" required="required" name="price_base" id="price_base" placeholder='<?php echo $this->lang->line('add_p_price_input_l1'); ?> <?php echo ($deal->type_deal_full == 'bon plan' ? $this->lang->line('add_p_price_input_l2') : $this->lang->line('add_p_price_input_l2_2')) ?>' data-validation="required" value="<?php echo $deal->price_base; ?>">
                                                <span class="input-group-addon"><?php echo $this->config->item('currency'); ?></span>
                                            </div>
                                            <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_price_error_l1'); ?> <?php echo $deal->type_deal_full; ?> <?php echo $this->lang->line('add_p_price_error_l2'); ?></div>
                                        </div>   
                                        <?php if ($deal->type_deal == 'bon-plan') : ?>
                                            <input type='hidden' name="price_promo" id="price_promo" value="0" />
                                            <input type='hidden' name="promo_amount" id="promo_amount" value="0" />
                                            <input type='hidden' name="promo_discount" id="promo_discount" value="0" />
                                        <?php else : ?>
                                            <div class="col-md-6 form-group">
                                                <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_pricepromo_tooltip'); ?>"><?php echo $this->lang->line('add_p_pricepromo_title'); ?> <i class='fa fa-info'></i></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" required="required" name="price_promo" id="price_promo" value="<?php echo $deal->price_promo; ?>" placeholder='<?php echo $this->lang->line('add_p_pricepromo_input'); ?>' data-validation="required">
                                                    <span class="input-group-addon"><?php echo $this->config->item('currency'); ?></span>
                                                </div>
                                                <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_pricepromo_error_l1'); ?> <?php echo $deal->type_deal_full; ?> <?php echo $this->lang->line('add_p_pricepromo_error_l2'); ?></div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_pricepromo_info'); ?>"><?php echo $this->lang->line('add_p_promoamount_tooltip'); ?> <i class='fa fa-info'></i></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" required="required" name="promo_amount" id="promo_amount" value="<?php echo $deal->promo_amount; ?>" placeholder='<?php echo $this->lang->line('add_p_promoamount_input'); ?>' data-validation="required">
                                                    <span class="input-group-addon"><?php echo $this->config->item('currency'); ?></span>
                                                </div>
                                                <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_promoamount_error'); ?></div>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_promop_tooltip'); ?>"><?php echo $this->lang->line('add_p_promop_title'); ?> <i class='fa fa-info'></i></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" required="required" name="promo_discount" id="promo_discount" value="<?php echo $deal->promo_discount; ?>" placeholder='<?php echo $this->lang->line('add_p_promop_input'); ?>' data-validation="required">
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
                                        <div class='col-md-12 color-green text-center mb-20' id='coupon' <?php echo $deal->type_deal == 'bon-de-réduction' ? '' : 'style="display: none"' ?>>
                                            <h4><?php echo $this->lang->line('deal_e_prints_l1'); ?><?php echo $deal->coupons ?> <?php echo $this->lang->line('deal_e_prints_l2'); ?></h4>
                                            <a class='btn coupon_choose' num='10'>10 <?php echo $this->lang->line('coupons'); ?> = <span><?php echo priceToShow(number_format(((float)$deal->price_promo)*($this->config->item('admin')['coef_coupons']/100)*10, 2)); ?></span><?php echo $this->config->item('excluding_taxe'); ?></a>
                                            <a class='btn coupon_choose' num='50'>50 <?php echo $this->lang->line('coupons'); ?> = <span><?php echo priceToShow(number_format(((float)$deal->price_promo)*($this->config->item('admin')['coef_coupons']/100)*50, 2)); ?></span><?php echo $this->config->item('excluding_taxe'); ?></a>
                                            <a class='btn coupon_choose' num='100'>100 <?php echo $this->lang->line('coupons'); ?> = <span><?php echo priceToShow(number_format(((float)$deal->price_promo)*($this->config->item('admin')['coef_coupons']/100)*100, 2)); ?></span><?php echo $this->config->item('excluding_taxe'); ?></a>
                                            <h4><small><em><?php echo $this->lang->line('deal_e_prints_l3'); ?></em></small></h4>
                                        </div>
                                        <div class='col-md-12 color-green text-center' id='plan' style='display: none'>
                                            <h4><?php echo $this->lang->line('add_p_quotation_l1'); ?></h4>
                                            <h4><?php echo $this->lang->line('add_p_quotation_free'); ?></h4>
                                        </div>     
                                        <div class='col-md-12 color-green text-center mb-20' id='plan_quotation' <?php echo $deal->quotation_online == 1 ? '' : 'style="display: none"' ?>>
                                            <h4><?php echo $this->lang->line('deal_e_quotations_l1'); ?><?php echo $deal->coupons ?> <?php echo $this->lang->line('deal_e_quotations_l2'); ?></h4>
                                            <a class='btn  <?php echo $deal->quotation_online == 1 ? '' : 'btn-info' ?> coupon_choose' num='10'><?php echo $this->lang->line('quotation'); ?> = <span><?php echo priceToShow(10*$this->config->item('admin')['coef_quotation']); ?><?php echo $this->config->item('excluding_taxe'); ?></span></a>
                                            <a class='btn coupon_choose' num='50'>50 <?php echo $this->lang->line('quotation'); ?> = <span><?php echo priceToShow(50*$this->config->item('admin')['coef_quotation']); ?><?php echo $this->config->item('excluding_taxe'); ?></span></a>
                                            <a class='btn coupon_choose' num='100'>100 <?php echo $this->lang->line('quotation'); ?> = <span><?php echo priceToShow(250*$this->config->item('admin')['coef_quotation']); ?><?php echo $this->config->item('excluding_taxe'); ?></span></a>
                                            <h4>
                                                <small>
                                                    <em><?php echo $this->lang->line('add_p_quotation_l3'); ?></em>
                                                </small>
                                            </h4>
                                        </div>    
                                        <h3 class='text-center mb-20 mt-30'><?php echo $this->lang->line('deal_offer_description'); ?></h3>
                                        <p>
                                            <textarea rows="20" class="form-control" required="required" name="content" id="content" data-validation="required"><?php echo $deal->content; ?></textarea>
                                        </p>
                                        <h3 class='text-center mb-20 mt-30'><?php echo $this->lang->line('deal_offer_public'); ?></h3>
                                        <p>
                                            <select class="form-control" name='target'>
                                                <option value='1' <?php echo $deal->target == 1 ? 'selected' : '' ?>><?php echo $this->lang->line('add_p_public_opt2'); ?></option>
                                                <option value='2' <?php echo $deal->target == 2 ? 'selected' : '' ?>><?php echo $this->lang->line('add_p_public_opt3'); ?></option>
                                                <option value='3' <?php echo $deal->target == 3 ? 'selected' : '' ?>><?php echo $this->lang->line('add_p_public_opt4'); ?></option>
                                                <option value='4' <?php echo $deal->target == 4 ? 'selected' : '' ?>><?php echo $this->lang->line('add_p_public_opt5'); ?></option>
                                                <option value='5' <?php echo $deal->target == 5 ? 'selected' : '' ?>><?php echo $this->lang->line('add_p_public_opt6'); ?></option>
                                            </select>
                                        </p>
                                        <h3 class='text-center mb-20 mt-30'><?php echo $this->lang->line('deal_e_offer_condition'); ?></h3>
                                        <div>
                                            <?php if ($deal->type_deal == 'deal' || $deal->type_deal == 'bon-de-réduction') : ?>
                                                <div class="col-md-6 form-group" >
                                                    <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_use_tooltip'); ?>"><?php echo $this->lang->line('add_p_use_opt1'); ?> <i class='fa fa-info'></i></label>
                                                    <select class="form-control" id='validite' name='validity'>
                                                        <option value='1'><?php echo $this->lang->line('add_p_use_opt2'); ?></option>
                                                        <option value='2'><?php echo $this->lang->line('add_p_use_opt3'); ?></option>
                                                        <option value='3'><?php echo $this->lang->line('add_p_use_opt4'); ?></option>
                                                        <option value='4'><?php echo $this->lang->line('add_p_use_opt5'); ?></option>
                                                    </select>
                                                </div>
                                            <?php elseif ($deal->type_deal == 'bon plan') : ?>
                                                <div class="col-md-6 form-group" >
                                                    <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_validity_tooltip'); ?>"><?php echo $this->lang->line('add_p_validity_opt1'); ?> <i class='fa fa-info'></i></label>
                                                    <select class="form-control" id='validite' name='validity'>
                                                        <option value='5'><?php echo $this->lang->line('add_p_validity_opt2'); ?></option>
                                                        <option value='4'><?php echo $this->lang->line('add_p_validity_opt3'); ?></option>
                                                    </select>
                                                </div>
                                            <?php endif; ?>
                                            <div class="col-md-6 form-group col-md-push-6" style='display: none' id='date_valid_group'>
                                                <label><?php echo $this->lang->line('add_p_validitydate_title'); ?> <?php echo $type; ?></label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input type="text" class="form-control" name="date_valid" id="date_valid" placeholder='<?php echo $this->lang->line('add_p_validitydate_input'); ?>' data-validation="required">
                                                </div>
                                                <div class="alert alert-danger mb-0 mt-5" style="display: none"><?php echo $this->lang->line('add_p_validitydate_error'); ?> <?php echo $type; ?>.</div>
                                            </div>
                                            <div class="col-md-6 form-group" >
                                                <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_rdv_tooltip'); ?>"><?php echo $this->lang->line('add_p_rdv_title'); ?> <i class='fa fa-info'></i></label>
                                                <select class="form-control" id='use' name='use'>
                                                    <option value='1' <?php echo $deal->use == 1 ? 'selected' : '' ?>><?php echo $this->lang->line('add_p_rdv_opt1'); ?></option>
                                                    <option value='2' <?php echo $deal->use == 2 ? 'selected' : '' ?>><?php echo $this->lang->line('add_p_rdv_opt2'); ?></option>
                                                    <option value='3' <?php echo $deal->use == 3 ? 'selected' : '' ?>><?php echo $this->lang->line('add_p_rdv_opt3'); ?></option>
                                                </select>
                                            </div>
                                            <?php if ($deal->type_deal == 'deal') : ?>
                                                <div class="col-md-6 form-group" >
                                                    <label data-toggle='tooltip' title="<?php echo $this->lang->line('add_p_couponsnum_tooltip'); ?>"><?php echo $this->lang->line('add_p_couponsnum_title'); ?> <i class='fa fa-info'></i></label>
                                                    <select class="form-control" id='quantity' name='quantity'>
                                                        <option value="1000" <?php echo $deal->quantity == 1000 ? 'selected' : '' ?>>1000</option>
                                                        <option value="500" <?php echo $deal->quantity == 500 ? 'selected' : '' ?>>500</option>
                                                        <option value="100" <?php echo $deal->quantity == 100 ? 'selected' : '' ?>>100</option> 
                                                        <option value="50" <?php echo $deal->quantity == 50 ? 'selected' : '' ?>>50</option>
                                                        <?php for ($i = 25; $i >= 1; $i--) : ?>
                                                            <option value='<?php echo $i; ?>'  <?php echo $deal->quantity == $i ? 'selected' : '' ?>><?php echo $i; ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            <?php else : ?>
                                                <input type="hidden" id='quantity' name='quantity' value="0" />
                                            <?php endif; ?>
                                            <div class="col-md-12 form-group">
                                                <label><strong><?php echo $this->lang->line('deal_e_deal_address'); ?></strong></label>
                                                <p><em><?php echo $this->lang->line('deal_e_deal_address_l1'); ?></em></p>
                                                <input type="text" class="form-control" placeholder='<?php echo $deal->address_deal ? $deal->address_deal : $this->lang->line('deal_e_deal_address_l2'); ?>' name="address" id="address">
                                                <p class='mt-10 ml-10'>Ville : <span class="city_deal"><?php echo $deal->city_deal; ?></span></p>
                                                <?php if ($this->session->userdata('role') == 'admin') : ?>
                                                    <input type="text" class="city_deal" id='city' name='city' value="<?php echo $deal->city_deal; ?>" />
                                                <?php else : ?>
                                                    <input type="hidden" class="city_deal" id='city' name='city' value="<?php echo $deal->city_deal; ?>" />
                                                <?php endif; ?>
                                                <?php if ($this->session->userdata('role') == 'admin') : ?>
                                                    <input type="text" id='latitude' name='latitude' value="<?php echo $deal->latitude; ?>" />
                                                    <input type="text" id='longitude' name='longitude' value="<?php echo $deal->longitude; ?>" />
                                                <?php else : ?>
                                                    <input type="hidden" id='latitude' name='latitude' value="<?php echo $deal->latitude; ?>" />
                                                    <input type="hidden" id='longitude' name='longitude' value="<?php echo $deal->longitude; ?>" />
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-12 text-center mb-10">
                                                <a href="#" class="btn btn-facebook" data-toggle="modal" data-target="#chooseCover"><i class="fa fa-photo"></i> <?php echo $this->lang->line('choose_cover'); ?></a>
                                                <div class="alert alert-danger mb-0 mt-5 errorCover" style="display: none"><?php echo $this->lang->line('choose_cover_l1'); ?> <?php echo $deal->type_deal_full; ?>.</div>
                                                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addPics"><i class="fa fa-photo"></i> <?php echo $this->lang->line('add_pics'); ?></a>
                                            </div>
                                            <div class="col-md-12 form-group text-center">
                                                <button type="submit" class="btn"><i class="fa fa-check"></i> <?php echo $this->lang->line('deal_e_edit_validate'); ?></button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="type_deal_full" id="type_deal_full" value="<?php echo $deal->type_deal; ?>" />
                                        <input type="hidden" name="type_deal" id="type_deal" value="<?php echo url_title($deal->type_deal); ?>" />
                                        <input type="hidden" name="deals_id" id="deals_id" value="<?php echo $deal->deal_id; ?>" />
                                        <input type="hidden" name="cover" id="cover" value="<?php echo $deal->cover; ?>" />
                                        <input type="hidden" name="coupons" id="coupons" value="0" />
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php if ($this->session->userdata('role') == 'admin') : ?>
                            <div class="col-md-12 bg-white mt-30 pt-30" id='sendMessage'>
                                <h3><i class='fa fa-envelope'></i> <span class="hidden-xs"><?php echo $this->lang->line('deal_e_send_message_to_store'); ?> (<?php echo $deal->name_dealer; ?>)</span></h3>
                                <h5 class='text-center'><?php echo $deal->company . ' (' . $deal->siret . ')'; ?>) - <?php echo $deal->email; ?> - <?php echo $deal->phone; ?></h5>
                                <form action="#sendMessage" method="post">
                                    <input type='hidden' name='store_id' value='<?php echo $deal->users_pro_id; ?>' />
                                    <?php if (validation_errors() || isset($captchaOk)) : ?>
                                        <div class='alert alert-danger'>
                                            <?php echo validation_errors(); ?>
                                            <?php if ($captchaOk == false) : ?>
                                                <p><?php echo $this->lang->line('deal_quotation_l2'); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (isset($message_sended)) : ?>
                                        <div class='alert alert-success'>
                                            <h3><i class='fa fa-check'></i> <?php echo $this->lang->line('deal_e_message_sended'); ?></h3>
                                        </div>
                                    <?php else : ?>
                                        <div class="form-group">
                                            <textarea rows="5" class="form-control" required="required" name='message'><?php echo!isset($message_sended) ? set_value('message') : ''; ?></textarea>
                                        </div>
                                        <div class='form-group'>
                                            <div class="g-recaptcha mb-10" data-sitekey="<?php echo $this->config->item('recaptcha_key_site') ?>"></div>
                                        </div>
                                        <button class="btn" type='submit'><i class='fa fa-check'></i> <?php echo $this->lang->line('deal_e_send_message'); ?></button>
                                    <?php endif; ?>
                                </form>
                            </div>
                        <?php endif; ?> 
                        <div class="col-xs-12 hidden-lg hidden-md hidden-sm">
                            <div class="widget single-deal-widget panel ptb-30 prl-20">
                                <div class="widget-body text-center">
                                    <div class="buy-now mb-40">
                                        <?php if (getDealTypeAction($deal->type_deal)) : ?>
                                            <?php if (($deal->type_deal == 'deal' && $stock > 0 || ($deal->type_deal == 'bon-de-réduction' && $this->coupons_printed->getRemaining($deal->deal_id) > 0) || ($deal->type_deal == 'bon-plan' && $deal->quotation_online == 1 && $deal->coupons > 0)) && strtotime($deal->end) > time()) : ?>
                                                <a href="#<?php echo $deal->type_deal == 'bon-plan' ? 'doQuotation" data-toggle="modal"' : '' ?>" class="btn btn-block btn-lg <?php echo $deal->type_deal == 'deal' ? 'addToCart' : ($deal->type_deal == 'bon-plan' ? '' : 'printCoupon') ?>" deals_id="<?php echo $deal->deal_id; ?>">
                                                    <i class="<?php echo getDealTypeActionIcon($deal->type_deal); ?> font-16 mr-10"></i> <?php echo getDealTypeAction($deal->type_deal); ?>
                                                </a>
                                            <?php elseif ($deal->type_deal != 'bon-plan') : ?>
                                                <p class="t-uppercase color-danger">
                                                    <?php echo $this->lang->line('deal_ended'); ?>
                                                </p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if ($is_favorite) : ?>
                                            <a href='#' class='btn btn-favorite btn-xs mt-5' onclick="return false"><i class='fa fa-heart'></i> <?php echo $this->lang->line('deal_in_favorite'); ?></a>
                                        <?php else : ?>
                                            <a href='#' class='btn btn-favorite btn-xs mt-5 addToFavorites' deals_id="<?php echo $deal->deal_id; ?>" type="btn"><i class='fa fa-heart'></i> <?php echo $this->lang->line('deal_to_favorite'); ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($deal->type_deal == 'bon-plan') : ?>
                                        <?php if ($deal->date_valid != '0000-00-00 00:00:00') : ?>
                                            <div class="time-left mb-30">
                                                <p class="t-uppercase color-muted">
                                                    <?php echo $this->lang->line('deal_date_l1'); ?>
                                                </p>
                                                <div class="color-mid font-14 font-lg-16">
                                                    <i class="ico fa fa-calendar mr-10"></i>
                                                    <span><?php echo dateBDD_to_FR($deal->date_valid); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php elseif (!isset($promoEnded)) : ?>
                                        <div class="time-left mb-30">
                                            <p class="t-uppercase color-muted">
                                                <?php echo $this->lang->line('deal_date_l2'); ?>
                                            </p>
                                            <div class="color-mid font-14 font-lg-16">
                                                <i class="ico fa fa-clock-o mr-10"></i>
                                                <span data-countdown="<?php echo dateBDD_to_FR($deal->end, 3, false, true, true) ?>"></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <ul class="list-inline social-icons social-icons--colored t-center">
                                        <li class="social-icons__item">
                                            <a href="#" onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo routeDeal($deal->deal_id, $deal->title) ?>', '_blank', 'width=500,height=300')"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li class="social-icons__item">
                                            <a href="#" onclick="window.open('http://twitter.com/intent/tweet?status=<?php echo routeDeal($deal->deal_id, $deal->title) ?>', '_blank', 'width=500,height=300')"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li class="social-icons__item">
                                            <a href="#" onclick="window.open('https://plus.google.com/share?url=<?php echo routeDeal($deal->deal_id, $deal->title) ?>', '_blank', 'width=500,height=300')"><i class="fa fa-pinterest"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php $this->load->view('store/partial/reviews', array('prod_id' => $deal->id)); ?>
                        <?php $ratings = $this->users_pro_rating->getForStore($deal->id); ?>
                    </div>
                </div>
                <div class="page-sidebar col-md-4 col-sm-5 col-xs-12">
                    <!-- Blog Sidebar -->
                    <aside class="sidebar blog-sidebar">
                        <div class="row row-tb-10">
                            <div class="col-xs-12 hidden-xs">
                                <div class="widget single-deal-widget panel ptb-30 prl-20">
                                    <div class="widget-body text-center">
                                        <h2 class="mb-20 h3">
                                            <?php echo $deal->title ?>
                                        </h2>
                                        <ul class="deal-meta list-inline mb-10 color-mid">
                                            <li><i class="ico fa fa-user mr-10"></i><a href="#" class="color-mid"><?php echo $deal->company ?></a>
                                            </li>
                                            <li><i class="ico fa fa-map-marker mr-10"></i><?php echo $deal->city ?></li>
                                            <li><i class="ico <?php echo getDealTypeIcon($deal->type_deal); ?> mr-10"></i><?php echo getDealType($deal->type_deal); ?></li>
                                        </ul>
                                        <p class="color-muted">
                                            <?php echo substr($deal->excerpt, 0, 85); ?>
                                        </p>
                                        <div class="price mb-20">
                                            <?php if ($deal->price_promo > 0) : ?>
                                                <div class="label-discount label-discount-deal top-10 right-10">-<?php echo $deal->promo_discount; ?>%</div>
                                                <h2 class="price"><span class="price-sale"><?php echo priceToShow($deal->price_base) ?></span> <?php echo priceToShow($deal->price_promo) ?></h2>
                                            <?php else : ?>
                                                <?php if ($deal->price_base > 0) : ?>
                                                    <h2 class="price"><?php echo priceToShow($deal->price_base) ?></h2>
                                                <?php else : ?>
                                                    <h2 class="price"><?php echo $deal->price_type == 'quotation' ? $this->lang->line('on_quotation') : strtoupper($this->lang->line('free')) ?></h2>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="buy-now mb-40">
                                            <?php if (($deal->type_deal == 'deal' && $stock > 0 || ($deal->type_deal == 'bon-de-réduction' && $this->coupons_printed->getRemaining($deal->deal_id) > 0) || ($deal->type_deal == 'bon-plan' && $deal->quotation_online == 1 && $deal->coupons > 0)) && strtotime($deal->end) > time()) : ?>
                                                <a href="#<?php echo $deal->type_deal == 'bon-plan' ? 'doQuotation" data-toggle="modal"' : '' ?>" class="btn btn-block btn-lg <?php echo $deal->type_deal == 'deal' ? 'addToCart' : ($deal->type_deal == 'bon-plan' ? '' : 'printCoupon') ?>" deals_id="<?php echo $deal->deal_id; ?>">
                                                    <i class="<?php echo getDealTypeActionIcon($deal->type_deal); ?> font-16 mr-10"></i> <?php echo getDealTypeAction($deal->type_deal); ?>
                                                </a>
                                            <?php elseif ($deal->type_deal != 'bon-plan') : ?>
                                                <p class="t-uppercase color-danger">
                                                    <?php echo $this->lang->line('deal_ended'); ?>
                                                </p>
                                            <?php endif; ?>
                                            <?php if ($is_favorite) : ?>
                                                <a href='#' class='btn btn-favorite btn-xs mt-5' onclick="return false"><i class='fa fa-heart'></i> <?php echo $this->lang->line('deal_in_favorite'); ?></a>
                                            <?php else : ?>
                                                <a href='#' class='btn btn-favorite btn-xs mt-5 addToFavorites' deals_id="<?php echo $deal->deal_id; ?>" type="btn"><i class='fa fa-heart'></i> <?php echo $this->lang->line('deal_to_favorite'); ?></a>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($deal->type_deal == 'bon-plan') : ?>
                                            <?php if ($deal->date_valid != '0000-00-00 00:00:00') : ?>
                                                <div class="time-left mb-30">
                                                    <p class="t-uppercase color-muted">
                                                        <?php echo $this->lang->line('deal_date_l1'); ?>
                                                    </p>
                                                    <div class="color-mid font-14 font-lg-16">
                                                        <i class="ico fa fa-calendar mr-10"></i>
                                                        <span><?php echo dateBDD_to_FR($deal->date_valid); ?></span>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php elseif (!isset($promoEnded)) : ?>
                                            <div class="time-left mb-30">
                                                <p class="t-uppercase color-muted">
                                                    <?php echo $this->lang->line('deal_date_l2'); ?>
                                                </p>
                                                <div class="color-mid font-14 font-lg-16">
                                                    <i class="ico fa fa-clock-o mr-10"></i>
                                                    <span data-countdown="<?php echo dateBDD_to_FR($deal->end, 3, false, true, true) ?>"></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <ul class="list-inline social-icons social-icons--colored t-center">
                                            <li class="social-icons__item">
                                                <a href="#" onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo routeDeal($deal->deal_id, $deal->title) ?>', '_blank', 'width=500,height=300')"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li class="social-icons__item">
                                                <a href="#" onclick="window.open('http://twitter.com/intent/tweet?status=<?php echo routeDeal($deal->deal_id, $deal->title) ?>', '_blank', 'width=500,height=300')"><i class="fa fa-twitter"></i></a>
                                            </li>
                                            <li class="social-icons__item">
                                                <a href="#" onclick="window.open('https://plus.google.com/share?url=<?php echo routeDeal($deal->deal_id, $deal->title) ?>', '_blank', 'width=500,height=300')"><i class="fa fa-pinterest"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <!-- Recent Posts -->
                                <div class="widget about-seller-widget panel ptb-30 prl-20">
                                    <h3 class="widget-title h-title"><?php echo $this->lang->line('deal_e_store_about'); ?></h3>
                                    <div class="widget-body t-center">
                                        <figure class="mt-20 pb-10">
                                            <a href='<?php echo base_url('boutique/' . strtolower(url_title($deal->company) . '/' . $deal->users_pro_id)) ?>'>
                                                <img src="<?php echo base_url('assets/images/brands/' . (!empty($deal->logo) ? $deal->logo : 'boutique.png')); ?>" alt="">
                                            </a>
                                        </figure>
                                        <div class="store-about mb-20">
                                            <h3 class="mb-10"><?php echo $deal->company; ?></h3>
                                            <ul class="deal-meta list-inline mb-10 color-mid">
                                                <li><i class="ico fa fa-phone mr-10"></i><a href="<?php echo base_url('boutique/' . strtolower(url_title($deal->company) . '/' . $deal->users_pro_id)) ?>" class="color-mid"><?php echo $deal->phone ?></a>
                                                </li>
                                                <li><i class="ico fa fa-envelope mr-10"></i><a href='<?php echo base_url('boutique/' . strtolower(url_title($deal->company) . '/' . $deal->users_pro_id)) ?>?tab=contact'><?php echo $this->lang->line('deal_store_contact'); ?></a></li>
                                                <li><i class="ico fa fa-map-marker mr-10"></i><?php echo $deal->city ?></li>
                                            </ul>
                                            <div class="rating mb-10">
                                                <?php $ratingMoy = $this->users_pro_rating->getStoreMoy($deal->id); ?>
                                                <span class="rating-stars" data-rating="<?php echo (int) $ratingMoy; ?>">
                                                    <i class="fa fa-star-o <?php echo $ratingMoy > 0 && $ratingMoy < 2 ? 'star-active' : ''; ?>"></i>
                                                    <i class="fa fa-star-o <?php echo $ratingMoy >= 2 && $ratingMoy < 3 ? 'star-active' : ''; ?>"></i>
                                                    <i class="fa fa-star-o <?php echo $ratingMoy >= 3 && $ratingMoy < 4 ? 'star-active' : ''; ?>"></i>
                                                    <i class="fa fa-star-o <?php echo $ratingMoy >= 4 && $ratingMoy < 5 ? 'star-active' : ''; ?>"></i>
                                                    <i class="fa fa-star-o <?php echo $ratingMoy >= 5 ? 'star-active' : ''; ?>"></i>
                                                </span>
                                                <span class="rating-reviews">
                                                    <?php $ratings = $this->users_pro_rating->getForStore($deal->id); ?>
                                                    ( <span class="rating-count"><?php echo count($ratings); ?></span> note<?php echo count($ratings) > 0 ? 's' : ''; ?>)
                                                </span>
                                            </div>
                                            <p class="mb-15"><?php echo $deal->informations != $this->lang->line('add_p_infos_title') ? $deal->informations : ''; ?></p>
                                            <a class="btn btn-info" href="<?php echo base_url('boutique/' . strtolower(url_title($deal->company) . '/' . $deal->users_pro_id)) ?>"><?php echo $this->lang->line('deal_store_view'); ?></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Recent Posts -->
                            </div>

                            <?php if ($deal->providers_id) : ?>
                                <?php $provider = $this->providers->getProvider($deal->providers_id); ?>
                                <?php if ($provider) : ?>
                                    <div class="col-xs-12">
                                        <div class="post-review panel p-20">
                                            <h3 class="h-title"><?php echo getDealType($deal->type_deal); ?> <small><?php echo $this->lang->line('deal_partner_title'); ?></small> <?php echo $provider->provider_name; ?></h3>
                                            <div class="widget-body t-center">
                                                <figure class="mt-20 pb-10">
                                                    <a href='<?php echo $provider->provider_url; ?>' target="_blank">
                                                        <img alt="" src="<?php echo base_url('assets/images/' . $provider->provider_logo) ?>">
                                                    </a>
                                                </figure>
                                                <div class="clear clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                        </div>
                    </aside>
                    <!-- End Blog Sidebar -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Container -->
</main>
<!-- POPUPS -->
<div id="printCouponConfirm"  class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3><?php echo $this->lang->line('deal_e_not_available'); ?></strong></h3>
            </div>
            <div class="modal-footer"></div>
        </div>

    </div>
</div>
<div id="chooseCover" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->lang->line('add_p_choose_cover_title'); ?> <?php echo $deal->type_deal_full ?></h4>
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

<div id="doQuotation"  class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3><?php echo $this->lang->line('deal_e_not_available'); ?></strong></h3>
            </div>
            <div class="modal-footer"></div>
        </div>

    </div>
</div>
<?php if (isset($_POST['quotation'])) : ?>
    <input type='hidden' name='quotation_sended' id='quotation_sended' value='1' />
<?php endif; ?>