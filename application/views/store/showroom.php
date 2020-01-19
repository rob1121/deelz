<main id="mainContent" class="main-content">
    <!-- Page Container -->
    <div class="page-container ptb-60">
        <div class="container">
            <div class="row row-rl-10 row-tb-20">
                <div class="page-sidebar col-sm-4 col-md-3">
                    <aside class="store-header-area panel t-center">
                        <div class="row">
                            <div class="col-xs-12">
                                <figure class="pt-10 pl-10">
                                    <img src="<?php echo base_url('assets/images/brands/' . (!empty($pro->logo) ? $pro->logo : 'boutique.png')); ?>" alt="">
                                </figure>
                            </div>
                            <div class="col-xs-12">
                                <div class="store-about ptb-30 prl-10">
                                    <h3 class="mb-10"><?php echo $pro->company; ?></h3>
                                    <div class="rating mb-10">
                                        <?php $ratingMoy = $this->users_pro_rating->getStoreMoy($pro->id); ?>
                                        <span class="rating-stars" data-rating="<?php echo (int) $ratingMoy; ?>">
                                            <i class="fa fa-star-o <?php echo $ratingMoy > 0 && $ratingMoy < 2 ? 'star-active' : ''; ?>"></i>
                                            <i class="fa fa-star-o <?php echo $ratingMoy >= 2 && $ratingMoy < 3 ? 'star-active' : ''; ?>"></i>
                                            <i class="fa fa-star-o <?php echo $ratingMoy >= 3 && $ratingMoy < 4 ? 'star-active' : ''; ?>"></i>
                                            <i class="fa fa-star-o <?php echo $ratingMoy >= 4 && $ratingMoy < 5 ? 'star-active' : ''; ?>"></i>
                                            <i class="fa fa-star-o <?php echo $ratingMoy >= 5 ? 'star-active' : ''; ?>"></i>
                                        </span>
                                        <span class="rating-reviews">
                                            <?php $ratings = $this->users_pro_rating->getForStore($pro->id); ?>
                                            ( <span class="rating-count"><?php echo count($ratings); ?></span> note<?php echo count($ratings) > 0 ? 's' : ''; ?>)
                                        </span>
                                    </div>
                                    <p class="mb-15"><?php echo $pro->informations == lang('add_p_infos_title') ? '' : $pro->informations; ?></p>

                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="store-splitter-left">
                                    <header class="left-splitter-header prl-10 ptb-20 bg-lighter">
                                        <div class="row">
                                            <?php if (isset($this->config->item('admin')['active_deal']) && $this->config->item('admin')['active_deal'] == 1) : ?>
                                                <div class="col-xs-6">
                                                    <h2><?php echo count($deals_online); ?></h2>
                                                    <p><?php echo lang('deals') ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (isset($this->config->item('admin')['active_coupon']) && $this->config->item('admin')['active_coupon'] == 1) : ?>
                                                <div class="col-xs-6">
                                                    <h2><?php echo count($coupons); ?></h2>
                                                    <p><?php echo lang('coupons') ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (isset($this->config->item('admin')['active_bon-plan']) && $this->config->item('admin')['active_bon-plan'] == 1) : ?>
                                                <?php if ($this->config->item('admin')['active_deal'] == 1 && $this->config->item('admin')['active_coupon'] == 1) : ?>
                                                    <div class="col-xs-12">
                                                    <?php else : ?>
                                                        <div class="col-xs-6">
                                                        <?php endif; ?>
                                                        <h2><?php echo count($plans); ?></h2>
                                                        <p><?php echo lang('bonplans') ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                    </header>
                                    <div class="left-splitter-body prl-20 ptb-20">
                                        <div class="row row-rl-10 row-tb-10">
                                            <?php
                                            $path = $this->config->item('base_path') . 'assets/images/store/' . $pro->id;
                                            if (is_dir($path)) :
                                                ?>
                                                <?php $files = array_diff(scandir($path), array('.', '..')); ?>
                                                <?php $compt = 0; ?>
                                                <?php if ($files) : ?>
                                                    <?php foreach ($files as $file) : ?>
                                                        <?php if (strpos($file, 'thumb')) : ?>
                                                            <?php $compt++; ?>
                                                            <div class="col-md-6 col-sm-4 col-xs-6">
                                                                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="" data-caption="" data-image="<?php echo base_url('assets/images/store/' . $pro->id . '/' . $file) ?>" data-target="#image-gallery">
                                                                    <img alt="<?php echo $file; ?>" src="<?php echo base_url('assets/images/store/' . $pro->id . '/' . $file) ?>">
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <div class='col-xs-12'></div>
                                        </div>
                                    </div>
                                    <footer class="left-splitter-social prl-20 ptb-20 col-xs-12">
                                        <ul class="list-inline social-icons social-icons--colored t-center">
                                            <li class="social-icons__item">
                                                <a href="#" onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo current_url() ?>', '_blank', 'width=500,height=300')"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li class="social-icons__item">
                                                <a href="#" onclick="window.open('http://twitter.com/intent/tweet?status=<?php echo current_url() ?>', '_blank', 'width=500,height=300')"><i class="fa fa-twitter"></i></a>
                                            </li>
                                            <li class="social-icons__item">
                                                <a href="#" onclick="window.open('https://plus.google.com/share?url=<?php echo current_url() ?>', '_blank', 'width=500,height=300')"><i class="fa fa-pinterest"></i></a>
                                            </li>
                                        </ul>
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="page-content col-sm-8 col-md-9">

                    <!-- Store Tabs Area -->
                    <div class="section store-tabs-area">
                        <div class="tabs tabs-v1">
                            <?php
                            $chooseTab = false;
                            if (count($deals) == 0) {
                                if (count($coupons) > 0) {
                                    $chooseTab = 'coupons';
                                } elseif (count($plans) > 0) {
                                    $chooseTab = 'plans';
                                }
                            }
                            ?>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs panel" role="tablist">
                                <?php if (isset($this->config->item('admin')['active_deal']) && $this->config->item('admin')['active_deal'] == 1) : ?>
                                    <li role="presentation" class="<?php echo!isset($_GET['tab']) && $chooseTab == false ? 'active' : '' ?>">
                                        <a href="#deals" aria-controls="deals" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-credit-card mr-10"></i><?php echo lang('deals_full'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (isset($this->config->item('admin')['active_coupon']) && $this->config->item('admin')['active_coupon'] == 1) : ?>
                                    <li role="presentation" <?php echo $chooseTab == 'coupons' ? 'class="active"' : '' ?>>
                                        <a href="#coupons" aria-controls="coupons" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-tags mr-10"></i><?php echo lang('coupons_full'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (isset($this->config->item('admin')['active_bon-plan']) && $this->config->item('admin')['active_bon-plan'] == 1) : ?>
                                    <li role="presentation" <?php echo $chooseTab == 'plans' ? 'class="active"' : '' ?>>
                                        <a href="#bons-plans" aria-controls="bons-plans" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-comments mr-10"></i><?php echo lang('bonplans'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <li role="presentation" class="">
                                    <a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-user mr-10"></i><?php echo lang('store_showroom_l1') ?></a>
                                </li>
                                <li role="presentation" class="<?php echo isset($_GET['tab']) && $_GET['tab'] == 'contact' ? 'active' : '' ?>">
                                    <a href="#contacts" aria-controls="contacts" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-map-marker mr-10"></i><?php echo lang('store_showroom_l2') ?></a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- DEALS -->
                                <div role="tabpanel" class="tab-pane ptb-20 <?php echo!isset($_GET['tab']) && $chooseTab == false ? 'active' : '' ?>" id="deals">
                                    <section class="section deals-area">
                                        <h3 class="mb-10"><?php echo count($deals); ?> <?php echo lang('deals_full'); ?></h3>
                                        <div class="row row-masnory row-tb-20">
                                            <?php if ($deals) : ?>
                                                <?php foreach ($deals as $deal) : ?>
                                                    <div class="col-sm-12 col-lg-6">
                                                        <div class="deal-single panel">
                                                            <figure class="deal-thumbnail embed-responsive embed-responsive-16by9" data-bg-img="<?php echo base_url('assets/images/' . $deal->cover) ?>">
                                                                <div class='hover-img-link' onclick='window.location.href = "<?php echo routeDeal($deal->deal_id, $deal->title); ?>"'></div>
                                                                <div class='hover-img-link-left' onclick='window.location.href = "<?php echo routeDeal($deal->deal_id, $deal->title); ?>"'></div>
                                                                <div class="label-discount left-20 top-15">-<?php echo $deal->promo_discount; ?>%</div>
                                                                <?php $this->load->view('deals/partial/actions', array('deal_id' => $deal->deal_id, 'deal_link' => routeDeal($deal->deal_id, $deal->title))); ?>
                                                                <div class="time-left bottom-15 right-20 font-md-14">
                                                                    <span>
                                                                        <i class="ico fa fa-clock-o mr-10"></i>
                                                                        <span class="t-uppercase" data-countdown="<?php echo dateBDD_to_FR($deal->end, 3, false, true, true) ?>"></span>
                                                                    </span>
                                                                </div>
                                                                <div class="deal-store-logo">
                                                                    <a title="<?php echo $deal->company; ?>" data-toggle="tooltip" href="<?php echo base_url('boutique/' . strtolower(url_title($deal->company) . '/' . $deal->pro_id)) ?>"><img src="<?php echo base_url('assets/images/brands/' . (!empty($pro->logo) ? $pro->logo : 'boutique.png')); ?>" alt=""></a>
                                                                </div>
                                                            </figure>
                                                            <div class="bg-white pt-20 pl-20 pr-15">
                                                                <div class="pr-md-10">
                                                                    <h3 class="deal-title mb-10">
                                                                        <a href="<?php echo routeDeal($deal->deal_id, $deal->title) ?>"><?php echo $deal->title; ?></a>
                                                                    </h3>
                                                                    <ul class="deal-meta list-inline mb-10 color-mid">
                                                                        <li><i class="ico fa fa-map-marker mr-10"></i><?php echo $deal->city; ?></li>
                                                                        <li><i class="ico <?php echo getDealTypeIcon($deal->type_deal); ?> mr-10"></i><?php echo getDealType($deal->type_deal); ?></li>
                                                                    </ul>
                                                                    <p class="text-muted mb-20"><?php echo $deal->excerpt; ?></p>
                                                                </div>
                                                                <div class="deal-price pos-r mb-15">
                                                                    <h3 class="price ptb-5 text-right"><span class="price-sale"><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_base) : ''; ?></span><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_promo) : priceToShow($deal->price_base); ?></h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </section>
                                </div>
                                <!-- COUPONS -->
                                <div role="tabpanel" class="tab-pane ptb-20 <?php echo $chooseTab == 'coupons' ? 'active' : '' ?>" id="coupons">
                                    <section class="section coupons-area coupons-area-grid">
                                        <h3 class="mb-10"><?php echo count($coupons); ?> <?php echo lang('coupons_full'); ?></h3>
                                        <div class="row row-masnory row-tb-20">
                                            <?php if ($coupons) : ?>
                                                <?php foreach ($coupons as $deal) : ?>
                                                    <div class="col-sm-6">
                                                        <div class="coupon-single panel t-center">
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <div class="text-center p-20">
                                                                        <a href="<?php echo routeDeal($deal->deal_id, $deal->title); ?>">
                                                                            <img class="store-logo" src="<?php echo base_url('assets/images/' . $deal->cover) ?>" alt="">
                                                                        </a>
                                                                    </div>
                                                                    <!-- end media -->
                                                                </div>
                                                                <!-- end col -->

                                                                <div class="col-xs-12">
                                                                    <div class="panel-body">
                                                                        <ul class="deal-meta list-inline mb-10">
                                                                            <li class="color-green"><i class="ico <?php echo getDealTypeIcon($deal->type_deal); ?> mr-10"></i><?php echo getDealType($deal->type_deal); ?></li>
                                                                            <li class="color-muted"><i class="ico lnr lnr-map mr-5"></i><?php echo $deal->city; ?></li>
                                                                        </ul>
                                                                        <h4 class="color-green mb-10 t-uppercase">-<?php echo $deal->promo_discount; ?>%</h4>
                                                                        <h5 class="deal-title mb-10">
                                                                            <a href="<?php echo routeDeal($deal->deal_id, $deal->title); ?>"><?php echo $deal->title; ?></a>
                                                                        </h5>
                                                                        <p class="mb-15 color-muted mb-20 font-12"><i class="lnr lnr-clock mr-10"></i><?php echo lang('store_showroom_l3') ?> <?php echo $deal->end ?></p>
                                                                        <div>
                                                                            <a class="btn btn-sm btn-block" href="<?php echo routeDeal($deal->deal_id, $deal->title) ?>"><?php echo lang('store_showroom_l4') ?></a>
                                                                            <div class='clear clearfix'></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end col -->
                                                            </div>
                                                            <!-- end row -->
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </section>
                                </div>
                                <!-- BONS PLANS -->
                                <div role="tabpanel" class="tab-pane ptb-20 <?php echo $chooseTab == 'plans' ? 'active' : '' ?>" id="bons-plans">
                                    <div class="posted-review panel p-30">
                                        <h3 class="h-title"><?php echo count($plans); ?> <?php echo lang('bonplans'); ?></h3>
                                        <?php if ($plans) : ?>
                                            <?php foreach ($plans as $deal) : ?>
                                                <div class="review-single pt-30">
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <img class="media-object mr-10 radius-4" src="<?php echo base_url('assets/images/' . $deal->cover) ?>" width="90" alt="">
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="review-wrapper clearfix">
                                                                <ul class="list-inline">
                                                                    <li>
                                                                        <span class="review-holder-name h5"><?php echo $deal->title; ?></span>
                                                                    </li>
                                                                    <li>
                                                                        <span class="color-green mb-10 t-uppercase"><?php echo priceToShow($deal->price_base); ?></span>
                                                                    </li>
                                                                </ul>
                                                                <p class="review-date mb-5"><?php echo $deal->start != $deal->end ? $deal->start . ' <i class="fa fa-arrow-right"></i> ' . $deal->end : $deal->start; ?></p>
                                                                <p class="copy"><?php echo $deal->excerpt; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- REVIEWS -->
                                <div role="tabpanel" class="tab-pane ptb-20" id="reviews">
                                    <?php $this->load->view('store/partial/reviews', array('prod_id' => $pro->id)); ?>
                                    <div class="col-xs-12">
                                        <div class="post-review panel p-20">
                                            <h3 class="h-title"><?php echo lang('store_showroom_l5') ?></h3>
                                            <?php $this->load->view('deals/partial/add_rating', array('users_pro_id' => $pro->id)); ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- CONTACTS -->
                                <div role="tabpanel" class="tab-pane ptb-20 <?php echo isset($_GET['tab']) && $_GET['tab'] == 'contact' ? 'active' : '' ?>" id="contacts">
                                    <div class="posted-review panel p-30 contact-area">
                                        <h3 class="h-title"><?php echo lang('store_showroom_l6') ?></h3>
                                        <div class="review-single pt-30">
                                            <div class="row row-tb-30">
                                                <?php if (!empty($pro->latitude) && !empty($pro->longitude)) : ?>
                                                    <div class="col-xs-12">
                                                        <div class="embed-responsive embed-responsive-16by9">
                                                            <iframe class="embed-responsive-item" src="https://maps.google.com/maps?q=<?php echo $pro->latitude ?>,<?php echo $pro->longitude ?>&amp;z=10&amp;output=embed"></iframe>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="col-xs-12">
                                                    <div class="contact-area-col contact-info">
                                                        <div class="contact-info">
                                                            <ul class="contact-list mb-10">
                                                                <li>
                                                                    <span class="icon lnr lnr-map-marker"></span>
                                                                    <h5><?php echo lang('address') ?></h5>
                                                                    <p class="color-mid"><?php echo $pro->address . ' ' . $pro->zipcode . ' ' . $pro->city; ?></p>
                                                                </li>
                                                                <li>
                                                                    <span class="icon lnr lnr-phone-handset"></span>
                                                                    <h5><?php echo lang('phone') ?></h5>
                                                                    <p class="color-mid"><?php echo $pro->phone; ?></p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="contact-area-col contact-form">
                                                        <h3 class="t-uppercase h-title mb-20" id='sendMessage'><?php echo lang('store_showroom_l7') ?></h3>
                                                        <?php if ($this->users->isLogged()) : ?>
                                                            <form action="?tab=contact#sendMessage" method="post">
                                                                <input type='hidden' name='store_id' value='<?php echo $pro->id; ?>' />
                                                                <?php if (validation_errors() || isset($captchaOk)) : ?>
                                                                    <div class='alert alert-danger'>
                                                                        <?php echo validation_errors(); ?>
                                                                        <?php if ($captchaOk == false) : ?>
                                                                            <p><?php echo lang('store_showroom_l8') ?></p>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php if (isset($message_sended)) : ?>
                                                                    <div class='alert alert-success'>
                                                                        <h3><i class='fa fa-check'></i> <?php echo lang('store_showroom_l9') ?></h3>
                                                                    </div>
                                                                <?php else : ?>
                                                                    <div class="form-group">
                                                                        <label><?php echo lang('store_showroom_l10') ?></label>
                                                                        <textarea rows="5" class="form-control" required="required" name='message'><?php echo!isset($message_sended) ? set_value('message') : ''; ?></textarea>
                                                                    </div>
                                                                    <div class='form-group'>
                                                                        <div class="g-recaptcha mb-10" data-sitekey="<?php echo $this->config->item('recaptcha_key_site') ?>"></div>
                                                                    </div>
                                                                    <button class="btn" type='submit'><?php echo lang('store_showroom_l11') ?></button>
                                                                <?php endif; ?>
                                                            </form>
                                                        <?php else : ?>
                                                            <div class="alert alert-info text-center">
                                                                <h3><?php echo lang('store_showroom_l12') ?></h3>
                                                                <a href="<?php echo base_url('users/signin') ?>"><?php echo lang('store_showroom_l13') ?></a>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Store Tabs Area -->

                </div>
            </div>
        </div>
    </div>
    <!-- End Page Container -->
</main>
