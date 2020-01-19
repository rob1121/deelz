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
                                        <?php if ($deal->type_deal != 'pass') : ?>
                                            <li><i class="ico fa fa-user mr-10"></i><a href="#" class="color-mid"><?php echo $deal->company ?></a></li>
                                            <li><i class="ico fa fa-map-marker mr-10"></i><?php echo $deal->city ?></li>
                                            <li><i class="ico <?php echo getDealTypeIcon($deal->type_deal); ?> mr-10"></i><?php echo getDealType($deal->type_deal); ?></li>
                                        <?php else : ?>
                                            <li><i class="ico fa fa-map-marker mr-10"></i><?php echo $deal->city_deal ?></li>
                                            <li><i class="ico <?php echo getDealTypeIcon($deal->type_deal); ?> mr-10"></i><?php echo getDealType($deal->type_deal); ?></li>
                                        <?php endif; ?>
                                    </ul>
                                    <div class="price mb-20">
                                        <?php if ($deal->price_promo > 0) : ?>
                                            <div class="label-discount label-discount-deal top-10 right-10">-<?php echo $deal->promo_discount; ?>%</div>
                                            <h2 class="price"><span class="price-sale"><?php echo priceToShow($deal->price_base) ?></span> <?php echo priceToShow($deal->price_promo) ?></h2>
                                        <?php else : ?>
                                            <?php if ($deal->price_base > 0) : ?>
                                                <h2 class="price"><?php echo priceToShow($deal->price_base) ?></h2>
                                            <?php else : ?>
                                                <?php if ($deal->promo_discount > 0) : ?>
                                                    <h2 class="price">-<?php echo $deal->promo_discount; ?>%</h2>
                                                <?php else : ?>
                                                    <h2 class="price"><?php echo $deal->price_type == 'quotation' ? $this->lang->line('on_quotation') : strtoupper($this->lang->line('free')) ?></h2>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="deal-deatails panel">
                                <div class="deal-slider">
                                    <?php if ($deal->cover) : ?>
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
                                                                    <span class='illustrative'><?php echo $this->lang->line('deal_store_pic'); ?></span>
                                                                </li>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
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
                                            <?php if ($deal->promo_discount > 0) : ?>
                                                <h2 class="price mb-15">-<?php echo $deal->promo_discount; ?>%</h2>
                                            <?php else : ?>
                                                <h2 class="price mb-15"><?php echo $deal->price_type == 'quotation' ? $this->lang->line('on_quotation') : strtoupper($this->lang->line('free')) ?></h2>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    
                                    <?php if ($deal->type_deal != 'pass') : ?>
                                        <h3 class='text-center mb-20 mt-30'><?php echo $this->lang->line('deal_offer_description'); ?></h3>
                                    <?php endif; ?>
                                    <p>
                                        <?php echo $deal->content; ?>
                                    </p>

                                    <?php if ($deal->type_deal != 'pass') : ?>
                                        <h3 class='text-center mb-20 mt-30'><?php echo $this->lang->line('deal_offer_public'); ?></h3>
                                        <p>
                                            <?php echo getTarget($deal->target); ?>
                                        </p>
                                        <h3 class='text-center mb-20 mt-30'><?php echo $this->lang->line('deal_offer_condition'); ?></h3>
                                        <p>
                                            <strong><?php echo $this->lang->line('deal_offer_validity'); ?> : </strong> <?php echo getValidity($deal->validity, $deal->date_valid); ?><br />
                                            <strong><?php echo $this->lang->line('deal_offer_rdv'); ?> : </strong> <?php echo getAppointement($deal->use); ?><br />
                                            <strong><?php echo $this->lang->line('deal_offer_cancel'); ?> :</strong> <?php echo $this->lang->line('deal_offer_cancel_conditions'); ?><br />
                                            <?php if ($deal->type_deal != 'bon-plan') : ?>
                                                <strong><?php echo $this->lang->line('deal_coupon_title'); ?> :</strong> <?php echo $this->lang->line('deal_coupon_description'); ?>
                                            <?php endif; ?>
                                        </p>
                                        <h3 class='text-center mb-20 mt-30'><?php echo $this->lang->line('deal_contacts_title'); ?></h3>
                                        <p>
                                            <strong><?php echo $this->lang->line('phone'); ?> :</strong> <?php echo $deal->phone; ?><br />
                                            <strong><?php echo $this->lang->line('email'); ?> :</strong> <a href='<?php echo base_url('boutique/' . strtolower(url_title($deal->company) . '/' . $deal->users_pro_id)) ?>'><?php echo $this->lang->line('deal_send_email'); ?></a>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 hidden-lg hidden-md hidden-sm">
                            <div class="widget single-deal-widget panel ptb-30 prl-20">
                                <div class="widget-body text-center">
                                    <div class="buy-now mb-40">
                                        <?php if (getDealTypeAction($deal->type_deal)) : ?>
                                            <?php if ($deal->type_deal != 'pass' && ($deal->type_deal == 'deal' && $stock > 0 || ($deal->type_deal == 'bon-de-réduction' && $this->coupons_printed->getRemaining($deal->deal_id) > 0)) && strtotime($deal->end) > time()) : ?>
                                                <a href="#<?php echo $deal->type_deal == 'bon-plan' ? 'doQuotation" data-toggle="modal"' : '' ?>" class="btn btn-block btn-lg <?php echo $deal->type_deal == 'deal' ? 'addToCart' : ($deal->type_deal == 'bon-plan' ? '' : 'printCoupon') ?>" deals_id="<?php echo $deal->deal_id; ?>">
                                                    <i class="fa fa-shopping-cart font-16 mr-10"></i> <?php echo getDealTypeAction($deal->type_deal); ?>
                                                </a>
                                            <?php elseif ($deal->type_deal != 'bon-plan') : ?>
                                                <?php $promoEnded = true; ?>
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
                        <?php if ($deal->type_deal != 'pass') : ?>
                            <?php if (!$ratings) : ?>
                                <div class="col-xs-12 hidden-xs hidden-sm">
                                    <div class="post-review panel p-20">
                                        <h3 class="h-title"><?php echo $this->lang->line('deal_review_title'); ?></h3>
                                        <?php $this->load->view('deals/partial/add_rating', array('users_pro_id' => $deal->id)); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
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
                                            <?php if ($deal->type_deal != 'pass') : ?>
                                                <li><i class="ico fa fa-user mr-10"></i><a href="#" class="color-mid"><?php echo $deal->company ?></a></li>
                                                <li><i class="ico fa fa-map-marker mr-10"></i><?php echo $deal->city ?></li>
                                                <li><i class="ico <?php echo getDealTypeIcon($deal->type_deal); ?> mr-10"></i><?php echo getDealType($deal->type_deal); ?></li>
                                            <?php else : ?>
                                                <li><i class="ico fa fa-map-marker mr-10"></i><?php echo $deal->city_deal ?></li>
                                                <li><i class="ico <?php echo getDealTypeIcon($deal->type_deal); ?> mr-10"></i><?php echo getDealType($deal->type_deal); ?></li>
                                            <?php endif; ?>
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
                                                    <?php if ($deal->promo_discount > 0) : ?>
                                                        <h2 class="price">-<?php echo $deal->promo_discount; ?>%</h2>
                                                    <?php else : ?>
                                                        <h2 class="price"><?php echo $deal->price_type == 'quotation' ? $this->lang->line('on_quotation') : strtoupper($this->lang->line('free')) ?></h2>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="buy-now mb-40">
                                            <?php if ($deal->type_deal != 'pass' && (getDealTypeAction($deal->type_deal) && !isset($promoEnded) && $stock > 0) && strtotime($deal->end) > time()) : ?>
                                                <a href="#<?php echo $deal->type_deal == 'bon-plan' ? 'doQuotation" data-toggle="modal"' : '' ?>" class="btn btn-block btn-lg <?php echo $deal->type_deal == 'deal' ? 'addToCart' : ($deal->type_deal == 'bon-plan' ? '' : 'printCoupon') ?>" deals_id="<?php echo $deal->deal_id; ?>">
                                                    <i class="fa fa-shopping-cart font-16 mr-10"></i> <?php echo getDealTypeAction($deal->type_deal); ?>
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
                                    <h3 class="widget-title h-title"><?php echo $this->lang->line('deal_store_about'); ?> <?php echo $deal->providers_id != 0 ? $this->lang->line('deal_store_partner') : $this->lang->line('deal_store_normal') ?></h3>
                                    <div class="widget-body t-center">
                                        <figure class="mt-20 pb-10">
                                                <img src="<?php echo base_url('assets/images/brands/' . (!empty($deal->logo) ? $deal->logo : 'boutique.png')); ?>" alt="">
                                        </figure>
                                        <div class="store-about mb-20">
                                            <?php if ($deal->providers_id == 0) : ?>
                                                <h3 class="mb-10"><?php echo $deal->company; ?></h3>
                                                <ul class="deal-meta list-inline mb-10 color-mid">
                                                    <?php if ($deal->phone) : ?>
                                                        <li><i class="ico fa fa-phone mr-10"></i><a href="<?php echo base_url('boutique/' . strtolower(url_title($deal->company) . '/' . $deal->users_pro_id)) ?>" class="color-mid"><?php echo $deal->phone ?></a>
                                                        </li>
                                                    <?php endif; ?>
                                                    <li><i class="ico fa fa-envelope mr-10"></i><a href='<?php echo base_url('boutique/' . strtolower(url_title($deal->company) . '/' . $deal->users_pro_id)) ?>?tab=contact'><?php echo $this->lang->line('deal_store_contact'); ?></a></li>
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
                                                <p class="mb-15"><?php echo $deal->informations != $this->lang->line('deal_store_infos') ? $deal->informations : ''; ?></p>
                                                <a class="btn btn-info" href="<?php echo base_url('boutique/' . strtolower(url_title($deal->company) . '/' . $deal->users_pro_id)) ?>"><?php echo $this->lang->line('deal_store_view'); ?></a>
                                            <?php elseif ($deal->url) : ?>
                                                <h3 class="mb-10"><a href="http://www.bouche-a-oreille.re"><?php echo $deal->company; ?></a></h3>
                                                <p class="mb-15"><?php echo $deal->informations != $this->lang->line('deal_store_infos') ? $deal->informations : ''; ?></p>
                                                <!--<p class='text-center'><a href='<?php echo $deal->url; ?>' target='_blank'><?php echo $deal->title; ?></a></p>-->
                                            <?php else : ?>
                                                <h3 class="mb-10"><a href="http://www.bouche-a-oreille.re"><?php echo $deal->company; ?></a></h3>
                                                <p class="mb-15"><?php echo $deal->informations != $this->lang->line('deal_store_infos') ? $deal->informations : ''; ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Recent Posts -->
                            </div>
                            <?php if ($deal->type_deal != 'pass') : ?>
                                <?php if ($ratings) : ?>
                                    <div class="col-xs-12 hidden-xs hidden-sm">
                                        <div class="post-review panel p-20">
                                            <h3 class="h-title"><?php echo $this->lang->line('deal_review_title'); ?></h3>
                                            <?php $this->load->view('deals/partial/add_rating', array('users_pro_id' => $deal->id)); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if ($deal->type_deal != 'pass') : ?>
                                <?php if (!$ratings) : ?>
                                    <div class="col-xs-12 hidden-lg hidden-md">
                                        <div class="post-review panel p-20">
                                            <h3 class="h-title"><?php echo $this->lang->line('deal_review_title'); ?></h3>
                                            <?php $this->load->view('deals/partial/add_rating', array('users_pro_id' => $deal->id)); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

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
                <h3><?php echo $this->lang->line('deal_coupon_print'); ?></h3>
                <p>
                    <?php echo $this->lang->line('deal_coupon_print_l1'); ?>
                </p>
                <a href="#" class="btn btn-info btn-xs" onclick="$('#printCouponConfirm').modal('hide');"><i class="fa fa-close"></i> <?php echo $this->lang->line('no'); ?></a> <a href="<?php echo base_url('users/print_promo/' . $deal->deal_id); ?>" class="btn"><i class="fa fa-check"></i> <?php echo $this->lang->line('yes'); ?></a>
                <p>
                    <em><?php echo $this->lang->line('deal_coupon_print_l2'); ?></em>
                </p>
            </div>
            <div class="modal-footer"></div>
        </div>

    </div>
</div>
<div id="doQuotation"  class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3><?php echo $this->lang->line('deal_quotation_title'); ?> <strong><?php echo $deal->company; ?></strong></h3>
                <p class="text-center">
                    <img src="<?php echo base_url('assets/images/brands/' . (!empty($deal->logo) ? $deal->logo : 'boutique.png')); ?>" alt="" style="max-height: 120px">
                </p>
                <p>
                    <?php echo $this->lang->line('deal_quotation_l1'); ?>
                </p>
                <form action="" method="post">
                    <?php if (validation_errors() || isset($captchaOk)) : ?>
                        <div class='alert alert-danger'>
                            <?php echo validation_errors(); ?>
                            <?php if ($captchaOk == false) : ?>
                                <p><?php echo $this->lang->line('deal_quotation_l2'); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <input type='hidden' name='deals_id' value='<?php echo $deal->deal_id ?>' />
                    <input type='hidden' name='users_pro_id' value='<?php echo $deal->id ?>' />
                    <input type='hidden' name='quotation' value='1' />
                    <div class='col-md-12 pl-0 pr-0'>
                        <div class="col-md-6 form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" maxlength="100" required="required" placeholder='<?php echo $this->lang->line('deal_quotation_lastname'); ?>' name="lastname" id="lastname" data-validation="required" value="<?php echo set_value('lastname'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" required="required" placeholder='<?php echo $this->lang->line('deal_quotation_firstname'); ?>' name="firstname" id="firstname" data-validation="required" value="<?php echo set_value('firstname'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            <input type="text" class="form-control" required="required" placeholder='<?php echo $this->lang->line('deal_quotation_address'); ?>' name="address" id="address" data-validation="required" value="<?php echo set_value('address'); ?>">
                        </div>
                    </div>
                    <div class='col-md-12 pl-0 pr-0'>
                        <div class="col-md-6 form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control" maxlength="5" required="required" placeholder='<?php echo $this->lang->line('deal_quotation_zipcode'); ?>' name="zipcode" id="zipcode" data-validation="required" value="<?php echo set_value('zipcode'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control" required="required" placeholder='<?php echo $this->lang->line('deal_quotation_city'); ?>' name="city" id="city" data-validation="required" value="<?php echo set_value('city'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class='col-md-12 pl-0 pr-0'>
                        <div class="col-md-6 form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control" required="required" placeholder='<?php echo $this->lang->line('deal_quotation_phone'); ?>' name="phone" id="phone" data-validation="required" value="<?php echo set_value('phone'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input type="text" class="form-control" required="required" placeholder='<?php echo $this->lang->line('deal_quotation_email'); ?>' name="email" id="email" data-validation="required" value="<?php echo set_value('email'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <textarea maxlength="300" rows="8" class="form-control" required="required" data-validation="required" name="informations" id="informations"><?php echo isset($_POST['quotation']) ? $this->input->post('informations') : $this->lang->line('deal_quotation_description') ?></textarea>
                    </div>
                    <div class="text-center">
                        <button class="btn"><i class="fa fa-check"></i> <?php echo $this->lang->line('deal_quotation_validate'); ?></button>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<?php if (isset($_POST['quotation'])) : ?>
    <input type='hidden' name='quotation_sended' id='quotation_sended' value='1' />
<?php endif; ?>