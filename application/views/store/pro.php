<main id="mainContent" class="main-content">
    <!-- Page Container -->
    <div class="page-container ptb-60">
        <div class="container">
            <?php if ($this->config->item('demo') == true && $this->config->item('auth_IP') != $_SERVER['REMOTE_ADDR']) : ?>
                <div class="alert alert-warning">
                    <i class="fa fa-lock"></i> In this DEMO mode, you can't DELETE, change deals places or modify any admin configuration ;)
                </div>
            <?php endif; ?>
            <div class="row row-rl-10 row-tb-20">
                <div class="page-sidebar col-sm-4 col-md-3">
                    <aside class="store-header-area panel t-center">
                        <div class="row">
                            <div class="col-xs-12">
                                <figure>
                                    <a href="#" data-toggle="modal" data-target="#chooseLogo">
                                        <img id="logo_brand" src="<?php echo base_url('assets/images/brands/' . (!empty($pro->logo) ? $pro->logo : 'boutique.png')); ?>" alt="">
                                    </a>
                                    <ul class="deal-actions top-15 right-10">
                                        <li class="like-deal" data-placement="bottom" data-toggle="tooltip" title="<?php echo lang('store_pro_l1'); ?>">
                                            <span>
                                                <a href="#" data-toggle="modal" data-target="#chooseLogo"><i class="fa fa-edit"></i></a>
                                            </span>
                                        </li>
                                    </ul>
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
                                    <div>
                                        <a href="<?php echo base_url('deals/add') ?>" class='btn btn-block mt-10'><i class='fa fa-plus'></i> <?php echo lang('store_pro_l2'); ?></a>
                                        <?php if (isset($this->config->item('admin')['active_boost']) && $this->config->item('admin')['active_boost'] == 1) : ?>
                                            <a href="#boost" href_mobile='<?php echo base_url('store/pro?tab=boost#boost') ?>' aria-controls="boost" role="tab" data-toggle="tab" aria-expanded="false" class='btn btn-warning btn-block' onclick="$('li[role=presentation]').removeClass('active');$('#boost-tab').addClass('active')"><i class='fa fa-rocket'></i> <?php echo lang('store_pro_l3'); ?></a>
                                        <?php endif; ?>
                                        <a href="#profil" href_mobile='<?php echo base_url('store/pro?tab=profil#profil') ?>' aria-controls="profil" role="tab" data-toggle="tab" aria-expanded="false" class='btn btn-pro btn-xs btn-block'><i class='fa fa-edit'></i> <?php echo lang('store_pro_l4'); ?></a>
                                    </div>

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
                                            if (!is_dir($path)) :
                                                ?>
                                                <div class="col-md-6 col-sm-4 col-xs-6">
                                                    <a href="#addPics" data-toggle="modal">
                                                        <img src="<?php echo base_url() ?>assets/images/brands/no_pic.png" alt="">
                                                    </a>
                                                </div>
                                                <div class="col-md-6 col-sm-4 col-xs-6">
                                                    <a href="#addPics" data-toggle="modal">
                                                        <img src="<?php echo base_url() ?>assets/images/brands/no_pic.png" alt="">
                                                    </a>
                                                </div>
                                                <div class="col-md-6 col-sm-4 col-xs-6">
                                                    <a href="#addPics" data-toggle="modal">
                                                        <img src="<?php echo base_url() ?>assets/images/brands/no_pic.png" alt="">
                                                    </a>
                                                </div>
                                                <div class="col-md-6 col-sm-4 col-xs-6">
                                                    <a href="#addPics" data-toggle="modal">
                                                        <img src="<?php echo base_url() ?>assets/images/brands/no_pic.png" alt="">
                                                    </a>
                                                </div>
                                            <?php else : ?>
                                                <?php $files = array_diff(scandir($path), array('.', '..')); ?>
                                                <?php $compt = 0; ?>
                                                <?php if ($files) : ?>
                                                    <?php foreach ($files as $file) : ?>
                                                        <?php if (strpos($file, 'thumb')) : ?>
                                                            <?php $compt++; ?>
                                                            <div class="col-md-6 col-sm-4 col-xs-6">
                                                                <a href="#addPics" data-toggle="modal">
                                                                    <img alt="<?php echo $file; ?>" src="<?php echo base_url('assets/images/store/' . $pro->id . '/' . $file) ?>">
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                                <?php for ($i = $compt; $i < 4; $i++) : ?>
                                                    <div class="col-md-6 col-sm-4 col-xs-6">
                                                        <a href="#addPics" data-toggle="modal">
                                                            <img src="<?php echo base_url() ?>assets/images/brands/no_pic.png" alt="">
                                                        </a>
                                                    </div>
                                                <?php endfor; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class='col-xs-12'></div>
                                    </div>
                                    <footer class="left-splitter-social prl-20 ptb-20 col-xs-12">
                                        <ul class="list-inline social-icons social-icons--colored t-center">
                                            <li class="social-icons__item">
                                                <a href="#" onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo base_url('boutique/' . strtolower(url_title($pro->company)) . '/' . $pro->id) ?>', '_blank', 'width=500,height=300')"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li class="social-icons__item">
                                                <a href="#" onclick="window.open('http://twitter.com/intent/tweet?status=<?php echo base_url('boutique/' . strtolower(url_title($pro->company)) . '/' . $pro->id) ?>', '_blank', 'width=500,height=300')"><i class="fa fa-twitter"></i></a>
                                            </li>
                                            <li class="social-icons__item">
                                                <a href="#" onclick="window.open('https://plus.google.com/share?url=<?php echo base_url('boutique/' . strtolower(url_title($pro->company)) . '/' . $pro->id) ?>', '_blank', 'width=500,height=300')"><i class="fa fa-pinterest"></i></a>
                                            </li>
                                        </ul>
                                        <div class="col-md-12 text-center mt-30 mb-10">
                                            <a href="<?php echo base_url('users/logout') ?>" class="btn btn-info btn-xs"><i class="fa fa-unlock"></i> <?php echo lang('store_pro_l5'); ?></a>
                                        </div>
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="page-content col-sm-8 col-md-9" id='top'>

                    <!-- Store Tabs Area -->
                    <div class="section store-tabs-area">
                        <div class="tabs tabs-v1">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs panel" role="tablist">
                                <li role="presentation" class="<?php echo!isset($_GET['tab']) ? 'active' : '' ?>">
                                    <a href="#deals" aria-controls="deals" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-tags mr-10"></i><?php echo lang('store_pro_l7'); ?></a>
                                </li>
                                <li role="presentation"  class="<?php echo isset($_GET['tab']) && $_GET['tab'] == 'reviews' ? 'active' : '' ?>">
                                    <a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-user mr-10"></i><?php echo lang('store_pro_l8'); ?></a>
                                </li>
                                <li role="presentation" class="<?php echo isset($_GET['tab']) && $_GET['tab'] == 'stats' ? 'active' : '' ?>">
                                    <a href="#stats" aria-controls="stats" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-line-chart mr-10"></i><?php echo lang('store_pro_l9'); ?></a>
                                </li>
                                <li role="presentation" class="<?php echo isset($_GET['tab']) && $_GET['tab'] == 'sales' ? 'active' : '' ?>">
                                    <a href="#sales" aria-controls="sales" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-calculator mr-10"></i><?php echo lang('store_pro_l10'); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('store/inbox') ?>"><i class="fa fa-commenting mr-10"></i><?php echo lang('store_pro_l11'); ?></a>
                                </li>
                                <?php if (isset($this->config->item('admin')['active_boost']) && $this->config->item('admin')['active_boost'] == 1) : ?>
                                    <li role="presentation" id="boost-tab" class="<?php echo isset($_GET['tab']) && $_GET['tab'] == 'boost' ? 'active' : '' ?>">
                                        <a href="#boost" aria-controls="boost" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-rocket mr-10"></i><?php echo lang('store_pro_l12'); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- DEALS -->
                                <div role="tabpanel" class="tab-pane ptb-20 <?php echo!isset($_GET['tab']) ? 'active' : '' ?>" id="deals">
                                    <section class="section deals-area">
                                        <h3 class="mb-10"><?php echo lang('store_pro_l13'); ?></h3>
                                        <div class="row row-masnory row-tb-20">
                                            <?php if ($deals) : ?>
                                                <?php foreach ($deals as $deal) : ?>
                                                    <div class="col-sm-12 col-lg-6">
                                                        <div class="deal-single panel">
                                                            <figure class="deal-thumbnail embed-responsive embed-responsive-16by9 <?php echo ($deal->statut == 'draft') ? 'deal-draft' : '' ?>" <?php echo ($deal->statut == 'draft') ? 'style="-webkit-filter: grayscale(100%);filter: gray;"' : '' ?> data-bg-img="<?php echo base_url('assets/images/' . $deal->cover) ?>">
                                                                <div class='hover-img-link' onclick='window.location.href = "<?php echo routeDeal($deal->deal_id, $deal->title); ?>"'></div>
                                                                <div class='hover-img-link-left' onclick='window.location.href = "<?php echo routeDeal($deal->deal_id, $deal->title); ?>"'></div>
                                                                <?php if ($deal->promo_discount > 0) : ?>
                                                                    <div class="label-discount left-20 top-15">-<?php echo $deal->promo_discount; ?>%</div>
                                                                <?php endif; ?>
                                                                <ul class="deal-actions top-15 right-20">
                                                                    <li class="like-deal" data-placement="bottom" data-toggle="tooltip" title="<?php echo ($deal->statut == 'publish') ? lang('store_pro_l14') : lang('store_pro_l15') ?>">
                                                                        <span>
                                                                            <?php if ($deal->statut == 'publish') : ?>
                                                                                <i class="fa fa-flash"></i> 
                                                                            <?php else : ?>
                                                                                <i class="fa fa-lock"></i>
                                                                            <?php endif; ?>
                                                                        </span>
                                                                    </li>
                                                                </ul>
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
                                                                <?php if ($deal->type_deal == 'bon-de-réduction' && $deal->coupons == 0) : ?>
                                                                    <div class="text-center mb-10">
                                                                        <strong class='color-danger'><?php echo lang('store_pro_l16'); ?></strong>
                                                                        <p class='color-danger'><?php echo lang('store_pro_l17'); ?></p>
                                                                        <a href="<?php echo routeDeal($deal->deal_id, $deal->title) ?>" class='btn btn-block'><i class="fa fa-edit"></i> <?php echo lang('store_pro_l18'); ?></a>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php if ($deal->type_deal == 'bon-plan' && $deal->price_type == 'quotation' && $deal->coupons == 0) : ?>
                                                                    <div class="text-center mb-10">
                                                                        <strong class='color-danger'><?php echo lang('store_pro_l19'); ?></strong>
                                                                        <p class='color-danger'><?php echo lang('store_pro_l20'); ?></p>
                                                                        <a href="<?php echo routeDeal($deal->deal_id, $deal->title) ?>" class='btn btn-block'><i class="fa fa-edit"></i> <?php echo lang('store_pro_l21'); ?></a>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <?php if (isset($this->config->item('admin')['active_boost']) && $this->config->item('admin')['active_boost'] == 1) : ?>
                                                                    <div class="text-center mb-10">
                                                                        <a href="#boost" aria-controls="boost" role="tab" data-toggle="tab" aria-expanded="false" class='btn btn-warning btn-block' onclick="$('li[role=presentation]').removeClass('active');$('#boost-tab').addClass('active')" class="btn btn-sm btn-xs"><i class="fa fa-rocket"></i> <?php echo lang('store_pro_l22'); ?></a>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <div class="col-xs-12">
                                                    <div class='alert alert-info text-center'>
                                                        <h3><i class='fa fa-shopping-cart'></i> <?php echo lang('store_pro_l23'); ?></h3>
                                                        <p>
                                                            <?php echo lang('store_pro_l24'); ?>
                                                        </p>
                                                    </div>
                                                    <div class="text-center">
                                                        <a href="<?php echo base_url('deals/add') ?>" class='btn mt-10'><i class='fa fa-plus'></i> <?php echo lang('store_pro_l25'); ?></a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </section>
                                </div>
                                <!-- REVIEWS -->
                                <div role="tabpanel" class="tab-pane ptb-20" id="reviews">
                                    <?php $this->load->view('store/partial/reviews', array('prod_id' => $pro->id, 'pro' => true, 'pro_company' => $pro->company)); ?>
                                </div>
                                <!-- STATS -->
                                <div role="tabpanel" class="tab-pane ptb-20 <?php echo isset($_GET['tab']) && $_GET['tab'] == 'stats' ? 'active' : '' ?>" id="stats">
                                    <div class="posted-review panel p-30 contact-area">
                                        <h3 class="h-title"><?php echo lang('store_pro_l26'); ?></h3>
                                        <div class="review-single pt-30">
                                            <div class="row row-tb-30">
                                                <div class="col-xs-12">
                                                    <div class="row">
                                                        <h3><?php echo lang('store_pro_l27'); ?></h3>
                                                        <div class='col-md-12'>
                                                            <div class="col-xs-4 btn-info text-center">
                                                                <h2><?php echo $this->orders->getForUsersPro(); ?></h2>
                                                                <p><?php echo lang('store_pro_l28'); ?></p>
                                                            </div>
                                                            <div class="col-xs-4 btn-danger text-center">
                                                                <h2><?php echo $this->coupons_printed->getForUsersPro(); ?></h2>
                                                                <p><?php echo lang('store_pro_l29'); ?></p>
                                                            </div>
                                                            <div class="col-xs-4 btn-warning text-center">
                                                                <h2><?php echo $this->stats_views_details->getForUsersPro(); ?></h2>
                                                                <p><?php echo lang('store_pro_l30'); ?></p>
                                                            </div>
                                                        </div>
                                                        <div class='col-md-12 mt-20'>
                                                            <hr />
                                                            <h3><?php echo lang('store_pro_l31'); ?></h3>
                                                            <p><?php echo lang('store_pro_l32'); ?></p>
                                                            <hr />


                                                            <?php
                                                            $statsPerDay = $this->stats_views_details->getPerDay();
                                                            if ($statsPerDay) :
                                                                ?>
                                                                <?php foreach ($statsPerDay as $stat) : ?>
                                                                    <input type="hidden" class="stats_view_data" data-day="<?php echo dateBDD_to_FR($stat->stat_date); ?>" data-count="<?php echo $stat->stat_count; ?>" />
                                                                <?php endforeach; ?>
                                                                <div id="stats_views" style="height: 250px; width: 100%; display: block"></div>
                                                            <?php else : ?>
                                                                <div class='alert alert-info text-center mt-10'>
                                                                    <h3><i class='fa fa-line-chart'></i> <?php echo lang('store_pro_l33'); ?></h3>
                                                                    <?php if (isset($this->config->item('admin')['active_boost']) && $this->config->item('admin')['active_boost'] == 1) : ?>
                                                                        <p>
                                                                            <?php echo lang('store_pro_l34'); ?> <a href="#boost" aria-controls="boost" role="tab" data-toggle="tab" aria-expanded="false"><?php echo lang('store_pro_l35'); ?></a>.
                                                                        </p>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class='col-md-12 mt-20'>
                                                            <hr />
                                                            <h3><?php echo lang('store_pro_l36'); ?></h3>
                                                            <p><?php echo lang('store_pro_l37'); ?></p>
                                                            <hr />
                                                            <?php
                                                            $statsPerDay = $this->orders->getPerDay();
                                                            if ($statsPerDay) :
                                                                ?>
                                                                <?php foreach ($statsPerDay as $stat) : ?>
                                                                    <input type="hidden" class="stats_sales_data" data-day="<?php echo dateBDD_to_FR($stat->stat_date); ?>" data-count="<?php echo $stat->stat_count; ?>" />
                                                                <?php endforeach; ?>
                                                                <div id="stats_sales" style="height: 250px; width: 100%; display: block"></div>
                                                            <?php else : ?>
                                                                <div class='alert alert-info text-center mt-10'>
                                                                    <h3><i class='fa fa-line-chart'></i> <?php echo lang('store_pro_l38'); ?></h3>
                                                                    <?php if (isset($this->config->item('admin')['active_boost']) && $this->config->item('admin')['active_boost'] == 1) : ?>
                                                                        <p>
                                                                            <?php echo lang('store_pro_l39'); ?> <a href="#boost" aria-controls="boost" role="tab" data-toggle="tab" aria-expanded="false"><?php echo lang('store_pro_l40'); ?></a>.
                                                                        </p>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- SALES -->
                                <div role="tabpanel" class="tab-pane ptb-20 <?php echo isset($_GET['tab']) && $_GET['tab'] == 'sales' ? 'active' : '' ?>" id="sales">
                                    <div class="posted-review panel p-30 contact-area">
                                        <h3 class="h-title"><?php echo lang('store_pro_l41'); ?></h3>
                                        <div class="review-single pt-30">
                                            <div class="row row-tb-30">
                                                <div class="col-xs-12">
                                                    <div class="row">
                                                        <div class='col-md-12'>
                                                            <div class="text-center">
                                                                <hr />
                                                                <h3><?php echo lang('store_pro_l42'); ?></h3>
                                                                <?php if (isset($coupon_validation)) : ?>
                                                                    <?php if ($coupon_validation == true) : ?>
                                                                        <div class="alert alert-success">
                                                                            <?php echo lang('store_pro_l43'); ?>
                                                                        </div>
                                                                    <?php else : ?>
                                                                        <div class="alert alert-danger">
                                                                            <?php echo lang('store_pro_l44'); ?>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                                <hr />
                                                                <p><?php echo lang('store_pro_l45'); ?></p>
                                                                <form method="post" action="?tab=sales">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" name="coupon_code" placeholder="<?php echo lang('store_pro_l46'); ?>" />
                                                                    </div>
                                                                    <button type="submit" class="btn"><i class='fa fa-check'></i> <?php echo lang('store_pro_l47'); ?></button>
                                                                </form>
                                                            </div>
                                                            <hr  class="mt-40 mb-20"/>
                                                        </div>
                                                        <div class='col-md-12'>
                                                            <?php $totalSales = 0; ?>
                                                            <h3 class="text-center"><?php echo lang('store_pro_l48'); ?></h3>
                                                            <hr />
                                                            <?php if ($orders) : ?>
                                                                <div class='alert alert-info text-center mt-10'><?php echo lang('store_pro_l49'); ?></div>
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <th><?php echo lang('store_pro_l50'); ?></th>
                                                                    <th><?php echo lang('store_pro_l51'); ?></th>
                                                                    <th><?php echo lang('store_pro_l52'); ?></th>
                                                                    <th><?php echo lang('store_pro_l53'); ?></th>
                                                                    <th><?php echo lang('store_pro_l54'); ?></th>
                                                                    <th><?php echo lang('store_pro_l55'); ?></th>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php $sumSales = 0; ?>
                                                                        <?php foreach ($orders as $order) : ?>
                                                                            <?php $sumSales += $order->order_amount; ?>
                                                                            <tr>
                                                                                <td><?php echo $order->order_id ?></td>
                                                                                <td><a href="<?php echo routeDeal($order->id, $order->title); ?>"><?php echo $order->title ?></a></td>
                                                                                <td><?php echo priceToShow($order->order_amount) ?></td>
                                                                                <td><?php echo $order->order_firstname . ' ' . $order->order_lastname ?></td>
                                                                                <td><?php echo $order->order_created_at ?></td>
                                                                                <td><?php echo $order->validated == 1 ? 'Oui' : 'Non' ?></td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                        <?php $totalSales += $sumSales; ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr class="warning">
                                                                            <td colspan="2">
                                                                                <?php echo lang('store_pro_l56'); ?>
                                                                            </td>
                                                                            <td colspan="5">
                                                                                <?php echo priceToShow($sumSales); ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="success">
                                                                            <td colspan="2">
                                                                                <?php echo lang('store_pro_l57'); ?>
                                                                            </td>
                                                                            <td colspan="5">
                                                                                <?php echo priceToShow(number_format($sumSales - ($sumSales * $this->config->item('admin')['coef_deals']), 2)); ?>
                                                                            </td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            <?php else : ?>
                                                                <div class='alert alert-info text-center mt-10'>
                                                                    <h3><i class='fa fa-line-chart'></i> <?php echo lang('store_pro_l58'); ?></h3>
                                                                    <?php if (isset($this->config->item('admin')['active_boost']) && $this->config->item('admin')['active_boost'] == 1) : ?>
                                                                        <p>
                                                                            <?php echo lang('store_pro_l59'); ?> <a href="#boost" aria-controls="boost" role="tab" data-toggle="tab" aria-expanded="false"><?php echo lang('store_pro_l60'); ?></a>.
                                                                        </p>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>



                                                        </div>
                                                        <div class='col-md-12 mt-20'>
                                                            <hr />
                                                            <h3 class="text-center"><?php echo lang('store_pro_l61'); ?></h3>
                                                            <hr />
                                                            <div class='alert alert-info text-center mt-10'><?php echo lang('store_pro_l62'); ?></div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- BOOST -->
                                <?php if (isset($this->config->item('admin')['active_boost']) && $this->config->item('admin')['active_boost'] == 1) : ?>
                                    <div role="tabpanel" class="tab-pane ptb-20 <?php echo isset($_GET['tab']) && $_GET['tab'] == 'boost' ? 'active' : '' ?>" id="boost">
                                        <div class="posted-review panel p-30 contact-area">
                                            <h1 class='text-center'><i class='fa fa-rocket'></i> <?php echo lang('store_pro_l63'); ?></h1>
                                            <h2 class="h-title text-center"><small><?php echo lang('store_pro_l64'); ?></small></h2>
                                            <div class="review-single pt-30">
                                                <div class="row row-tb-30">
                                                    <div class="col-xs-12">
                                                        <h3 class='text-center mt-30 mb-20'><?php echo lang('store_pro_l65'); ?></h3>
                                                        <p>
                                                            <?php echo lang('store_pro_l66'); ?>
                                                        </p>
                                                        <p class='text-center'>
                                                            <a href="<?php echo base_url('deals/add') ?>" class='btn mt-10'><i class='fa fa-plus'></i> <?php echo lang('store_pro_l67'); ?></a>
                                                        </p>
                                                        <hr />
                                                        <h3 class='text-center mt-30 mb-20'><?php echo lang('store_pro_l68'); ?></h3>
                                                        <p>
                                                            <?php echo lang('store_pro_l69'); ?>
                                                        </p>
                                                        <p class='text-center hidden-xs'>
                                                            <a href="#boost_photo" aria-controls="boost_photo" role="tab" data-toggle="tab" aria-expanded="false" class='btn btn-pro mt-10'><i class='fa fa-photo'></i> <?php echo lang('store_pro_l70'); ?></a>
                                                        </p>
                                                        <p class='text-center hidden-xs'>
                                                            <a href="#boost_logo" aria-controls="boost_logo" role="tab" data-toggle="tab" aria-expanded="false" class='btn btn-info mt-10'><i class='fa fa-desktop'></i> <?php echo lang('store_pro_l71'); ?></a>
                                                        </p>
                                                        <p class='text-center hidden-lg hidden-md hidden-sm'>
                                                            <a href="#boost_logo" aria-controls="boost_logo" role="tab" data-toggle="tab" aria-expanded="false" class='btn btn-info mt-10'><i class='fa fa-desktop'></i> <?php echo lang('store_pro_l72'); ?></a>
                                                            <a href="#boost_photo" aria-controls="boost_photo" role="tab" data-toggle="tab" aria-expanded="false" class='btn btn-pro mt-10'><i class='fa fa-photo'></i> <?php echo lang('store_pro_l73'); ?></a>
                                                        </p>
                                                        <hr />
                                                        <h3 class='text-center mt-30 mb-20'><?php echo lang('store_pro_l74'); ?></h3>
                                                        <p>
                                                            <?php echo lang('store_pro_l75'); ?>
                                                        </p>
                                                        <p class='text-center hidden-xs'>
                                                            <a href="#boost_social" aria-controls="boost_social" role="tab" data-toggle="tab" aria-expanded="false" class='btn btn-facebook mt-10'><i class='fa fa-facebook'></i> <?php echo lang('store_pro_l76'); ?></a>
                                                        </p>
                                                        <p class='text-center hidden-xs'>
                                                            <a href="#boost_newsletter" aria-controls="boost_social" role="tab" data-toggle="tab" aria-expanded="false" class='btn btn-info mt-10'><i class='fa fa-envelope'></i> <?php echo lang('store_pro_l77'); ?></a>
                                                        </p>
                                                        <p class='text-center hidden-xs'>
                                                            <a href="#boost_zotdeal" aria-controls="boost_zotdeal" role="tab" data-toggle="tab" aria-expanded="false" class='btn mt-10'><i class='fa fa-arrow-up'></i> <?php echo lang('store_pro_l78'); ?></a>
                                                        </p>
                                                        <p class='text-center hidden-lg hidden-md hidden-sm'>
                                                            <a href="#boost_social" aria-controls="boost_social" role="tab" data-toggle="tab" aria-expanded="false" class='btn btn-facebook mt-10'><i class='fa fa-facebook'></i> <?php echo lang('store_pro_l79'); ?></a>
                                                            <a href="#boost_newsletter" aria-controls="boost_newsletter" role="tab" data-toggle="tab" aria-expanded="false" class='btn btn-info mt-10'><i class='fa fa-envelope'></i> <?php echo lang('store_pro_l80'); ?></a>
                                                            <a href="#boost_zotdeal" aria-controls="boost_zotdeal" role="tab" data-toggle="tab" aria-expanded="false" class='btn mt-10'><i class='fa fa-arrow-up'></i> <?php echo lang('store_pro_l81'); ?></a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <!-- BOOST > logo -->
                                <div role="tabpanel" class="tab-pane ptb-20 <?php echo isset($_GET['tab']) && $_GET['tab'] == 'boost_logo' ? 'active' : '' ?>" id="boost_logo">
                                    <div class="posted-review panel p-30 contact-area">
                                        <h3 class="h-title"><i class='fa fa-rocket'></i> <?php echo lang('store_pro_l82'); ?></h3>
                                        <div class="review-single pt-30">
                                            <div class="row row-tb-30">
                                                <div class="col-xs-12 text-right pb-0">
                                                    <a href="#boost" aria-controls="boost" role="tab" data-toggle="tab" aria-expanded="false" class='btn btn-warning btn-xs' onclick="$('li[role=presentation]').removeClass('active');$('#boost-tab').addClass('active')"><i class='fa fa-arrow-left'></i> <?php echo lang('back') ?></a>
                                                </div>
                                                <div class="col-xs-12">
                                                    <?php if ($this->boosts_logo->asked()) : ?>
                                                        <div class="alert alert-success text-center">
                                                            <h3><i class="fa fa-check"></i> <?php echo lang('store_pro_l84'); ?></h3>
                                                            <p>
                                                                <?php echo lang('store_pro_l85'); ?>
                                                            </p>
                                                        </div>
                                                    <?php else : ?>
                                                        <form method="post" action='<?php echo base_url('store/boost_irl'); ?>'>
                                                            <h3><?php echo lang('store_pro_l86'); ?></h3>
                                                            <p>
                                                                <?php echo lang('store_pro_l87'); ?>
                                                            </p>
                                                            <p>
                                                                <?php echo lang('store_pro_l88'); ?>
                                                            </p>
                                                            <p class='text-center'>
                                                                <button type="submit" class='btn mt-10'><i class='fa fa-check'></i> <?php echo lang('store_pro_l89'); ?></button>
                                                            </p>
                                                            <input type='hidden' name='boost_type' id='boost_type' value='logo' />
                                                        </form>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- BOOST > Photo -->
                                <div role="tabpanel" class="tab-pane ptb-20 <?php echo isset($_GET['tab']) && $_GET['tab'] == 'boost_photo' ? 'active' : '' ?>" id="boost_photo">
                                    <div class="posted-review panel p-30 contact-area">
                                        <h3 class="h-title"><i class='fa fa-rocket'></i> <?php echo lang('store_pro_l90'); ?></h3>
                                        <div class="review-single pt-30">
                                            <div class="row row-tb-30">
                                                <div class="col-xs-12 text-right pb-0">
                                                    <a href="#boost" aria-controls="boost" role="tab" data-toggle="tab" aria-expanded="false" class='btn btn-warning btn-xs' onclick="$('li[role=presentation]').removeClass('active');$('#boost-tab').addClass('active')"><i class='fa fa-arrow-left'></i> <?php echo lang('back') ?></a>
                                                </div>
                                                <div class="col-xs-12">
                                                    <?php if ($this->boosts_photo->asked()) : ?>
                                                        <div class="alert alert-success text-center">
                                                            <h3><i class="fa fa-check"></i> <?php echo lang('store_pro_l90_1'); ?></h3>
                                                            <p>
                                                                <?php echo lang('store_pro_l91'); ?>
                                                            </p>
                                                        </div>
                                                    <?php else : ?>
                                                        <form method='post' action='<?php echo base_url('store/boost_irl'); ?>'>
                                                            <h3><?php echo lang('store_pro_l92'); ?></h3>
                                                            <p>
                                                                <?php echo lang('store_pro_l93'); ?>
                                                            </p>
                                                            <p>
                                                            <ul>
                                                                <li><?php echo lang('store_pro_l94'); ?></li>
                                                                <li><?php echo lang('store_pro_l95'); ?></li>
                                                                <li><?php echo lang('store_pro_l96'); ?></li>
                                                            </ul>
                                                            </p>
                                                            <p class='text-center'>
                                                                <button type="submit" class='btn mt-10'><i class='fa fa-check'></i> <?php echo lang('store_pro_l97'); ?></button>
                                                            </p>
                                                            <input type='hidden' name='boost_type' id='boost_type' value='photo' />
                                                        </form>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- BOOST > Social -->
                                <div role="tabpanel" class="tab-pane ptb-20 <?php echo isset($_GET['tab']) && $_GET['tab'] == 'boost_social' ? 'active' : '' ?>" id="boost_social">
                                    <div class="posted-review panel p-30 contact-area">
                                        <h1 class="h-title text-center"><i class='fa fa-rocket'></i> <?php echo lang('store_pro_l98'); ?></h1>
                                        <div class="review-single pt-30">
                                            <div class="row row-tb-30">
                                                <div class="col-xs-12 text-right pb-0">
                                                    <a href="#boost" aria-controls="boost" role="tab" data-toggle="tab" aria-expanded="false" class='btn btn-warning btn-xs' onclick="$('li[role=presentation]').removeClass('active');$('#boost-tab').addClass('active')"><i class='fa fa-arrow-left'></i> <?php echo lang('back') ?></a>
                                                </div>
                                                <div class="col-xs-12">
                                                    <form method='post' action='<?php echo base_url('store/boost_online'); ?>' <?php echo ($deals) ? '' : 'onsubmit="return false;"' ?>>
                                                        <h2 class='text-center mt-30 mb-20'><?php echo lang('store_pro_l99'); ?></h2>
                                                        <p>
                                                            <?php echo lang('store_pro_l100'); ?>
                                                        </p>
                                                        <h4 class='text-center mt-30 mb-30'><?php echo lang('store_pro_l101'); ?></h4>
                                                        <p class='text-center'>
                                                            <?php if ($deals) : ?>
                                                                <select class='form-control' name='deals_id'>
                                                                    <?php foreach ($deals as $deal) : ?>
                                                                        <option value='<?php echo $deal->deal_id ?>'><?php echo $deal->title ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            <?php else : ?>
                                                            <div class='alert alert-info text-center'>
                                                                <?php echo lang('store_pro_l102'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        </p>
                                                        <h4 class='text-center mt-30 mb-30'><?php echo lang('store_pro_l103'); ?></h4>
                                                        <p>
                                                            <?php echo lang('store_pro_l104'); ?>
                                                            <input type='hidden' name='boost_target' value='1' />
                                                        </p>
                                                        <h4 class='text-center mt-30 mb-30'><?php echo lang('store_pro_l105'); ?></h4>
                                                        <p> 
                                                            <?php echo lang('store_pro_l106'); ?>
                                                        </p>
                                                        <p class='text-center mtb-20'>
                                                            <a class='btn btn-info social_choose' num='20'><?php echo priceToShow(20); ?>(<span><?php echo lang('store_pro_l107'); ?></span> <?php echo lang('store_pro_l110'); ?>)</a>
                                                            <a class='btn social_choose' num='50'><?php echo priceToShow(50); ?> (<span><?php echo lang('store_pro_l108'); ?></span> <?php echo lang('store_pro_l110'); ?>)</a>
                                                            <a class='btn social_choose' num='100'><?php echo priceToShow(100); ?> (<span><?php echo lang('store_pro_l109'); ?></span> <?php echo lang('store_pro_l110'); ?>)</a>
                                                        </p>
                                                        <p class='mt-20 text-right'>
                                                            <button type='<?php echo ($deals) ? 'submit' : 'button' ?>' class='btn btn-warning'><i class='fa fa-rocket'></i> <?php echo lang('store_pro_l111'); ?></button>
                                                        </p>
                                                        <input type='hidden' name='social_amount' id='social_amount' value='50' />
                                                        <input type='hidden' name='boost_type' id='boost_type' value='social' />
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- BOOST > Newsletter -->
                                <div role="tabpanel" class="tab-pane ptb-20 <?php echo isset($_GET['tab']) && $_GET['tab'] == 'boost_newsletter' ? 'active' : '' ?>" id="boost_newsletter">
                                    <div class="posted-review panel p-30 contact-area">
                                        <h3 class="h-title"><i class='fa fa-rocket'></i> <?php echo lang('store_pro_l112'); ?></h3>
                                        <div class="review-single pt-30">
                                            <div class="row row-tb-30">
                                                <div class="col-xs-12 text-right pb-0">
                                                    <a href="#boost" aria-controls="boost" role="tab" data-toggle="tab" aria-expanded="false" class='btn btn-warning btn-xs' onclick="$('li[role=presentation]').removeClass('active');$('#boost-tab').addClass('active')"><i class='fa fa-arrow-left'></i> <?php echo lang('back'); ?></a>
                                                </div>
                                                <div class="col-xs-12">
                                                    <form method='post'>
                                                        <h3><?php echo lang('store_pro_l113'); ?></h3>
                                                        <p>
                                                            <?php echo lang('store_pro_l114'); ?>
                                                        </p>
                                                        <div class='alert alert-info text-center'>
                                                            <h4><i class='fa fa-clock-o'></i> <?php echo lang('store_pro_l115'); ?></h4>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- BOOST > Zotdeal -->
                                <div role="tabpanel" class="tab-pane ptb-20 <?php echo isset($_GET['tab']) && $_GET['tab'] == 'boost_zotdeal' ? 'active' : '' ?>" id="boost_zotdeal">
                                    <div class="posted-review panel p-30 contact-area">
                                        <h1 class="h-title text-center"><i class='fa fa-rocket'></i> <?php echo lang('store_pro_l116'); ?></h1>
                                        <div class="review-single pt-30">
                                            <div class="row row-tb-30">
                                                <div class="col-xs-12 text-right pb-0">
                                                    <a href="#boost" aria-controls="boost" role="tab" data-toggle="tab" aria-expanded="false" class='btn btn-warning btn-xs' onclick="$('li[role=presentation]').removeClass('active');$('#boost-tab').addClass('active')"><i class='fa fa-arrow-left'></i> <?php echo lang('back'); ?></a>
                                                </div>
                                                <div class="col-xs-12">
                                                    <form method='post' action='<?php echo base_url('store/boost_online'); ?>' <?php echo ($deals) ? '' : 'onsubmit="return false;"' ?>>
                                                        <h2 class='mt-30 mb-20 text-center'><?php echo lang('store_pro_l116_1'); ?></h2>
                                                        <p>
                                                            <?php echo lang('store_pro_l117'); ?>
                                                        </p>
                                                        <h4 class='mt-30 mb-30 text-center'><?php echo lang('store_pro_l118'); ?></h4>
                                                        <p class='text-center'>
                                                            <?php if ($deals) : ?>
                                                                <select class='form-control' name='deals_id'>
                                                                    <?php foreach ($deals as $deal) : ?>
                                                                        <option value='<?php echo $deal->deal_id ?>'><?php echo $deal->title ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            <?php else : ?>
                                                            <div class='alert alert-info text-center'>
                                                                <?php echo lang('store_pro_l119'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        </p>
                                                        <h4 class='mt-30 mb-30 text-center'><?php echo lang('store_pro_l120'); ?></h4>
                                                        <p>
                                                            <?php echo lang('store_pro_l121'); ?>
                                                        </p>
                                                        <p> 
                                                            <select class="form-control input-lg search-select" name="boost_top" id='boost_top'>
                                                                <option value='0'>0 <?php echo lang('store_pro_l122'); ?></option>
                                                                <option value='1'>1 <?php echo lang('store_pro_l122'); ?></option>
                                                                <option value='2'>2 <?php echo lang('store_pro_l122'); ?></option>
                                                                <option value='3'>3 <?php echo lang('store_pro_l122'); ?></option>
                                                                <option value='4'>4 <?php echo lang('store_pro_l122'); ?></option>
                                                                <option value='5'>5 <?php echo lang('store_pro_l122'); ?></option>
                                                                <option value='6'>6 <?php echo lang('store_pro_l122'); ?></option>
                                                                <option value='7'>7 <?php echo lang('store_pro_l122'); ?></option>
                                                            </select>
                                                        </p>
                                                        <h4 class='mt-30 mb-30 text-center'><?php echo lang('store_pro_l123'); ?></h4>
                                                        <p>
                                                            <?php echo lang('store_pro_l124'); ?>
                                                        </p>
                                                        <p class='text-center mtb-20'>
                                                            <select class="form-control input-lg search-select" name="boost_slider" id='boost_slider'> 
                                                                <option value='0'>0 <?php echo lang('store_pro_l122'); ?></option>
                                                                <option value='1'>1 <?php echo lang('store_pro_l122'); ?></option>
                                                                <option value='2'>2 <?php echo lang('store_pro_l122'); ?></option>
                                                                <option value='3'>3 <?php echo lang('store_pro_l122'); ?></option>
                                                                <option value='4'>4 <?php echo lang('store_pro_l122'); ?></option>
                                                                <option value='5'>5 <?php echo lang('store_pro_l122'); ?></option>
                                                                <option value='6'>6 <?php echo lang('store_pro_l122'); ?></option>
                                                                <option value='7'>7 <?php echo lang('store_pro_l122'); ?></option>
                                                            </select>
                                                        </p>
                                                        <div class='col-md-12 color-green text-center' id='boost_zotdeal_calcul'>
                                                            <h4><?php echo lang('store_pro_l125'); ?></h4>
                                                            <h4><small><em><?php echo lang('store_pro_l126'); ?></em></small></h4>
                                                            <h4><?php echo priceToShow(0); ?></h4>
                                                        </div>
                                                        <p class='mt-20 text-right' id='valid_boost_zotdeal' style='display: none'>
                                                            <button type='<?php echo ($deals) ? 'submit' : 'button' ?>' class='btn btn-warning'><i class='fa fa-rocket'></i> <?php echo lang('store_pro_l127'); ?></button>
                                                        </p>
                                                        <input type='hidden' name='boost_type' id='boost_type' value='zotdeal' />
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- PERSONNAL INFORMATIONS -->
                                <div role="tabpanel" class="tab-pane ptb-20 <?php echo isset($_GET['tab']) && $_GET['tab'] == 'profil' ? 'active' : '' ?>" id="profil">
                                    <div class="posted-review panel p-30 contact-area">
                                        <h3 class="h-title"><i class='fa fa-user'></i> <?php echo lang('store_pro_l127_1'); ?></h3>
                                        <form method='post' enctype='multipart/form-data' action='?tab=profil'>
                                            <input type="hidden" name="latitude" id="latitude" value="<?php echo empty($_POST) ? $pro->latitude : set_value('latitude'); ?>" />
                                            <input type="hidden" name="longitude" id="longitude" value="<?php echo empty($_POST) ? $pro->longitude : set_value('longitude'); ?>" />
                                            <input type="hidden" name="email" id="email" value="<?php echo empty($_POST) ? $pro->email : set_value('email'); ?>" />
                                            <?php if (isset($errors) || isset($error_logo)) : ?>
                                                <div class='alert alert-danger mt-10 mb-0'>
                                                    <?php echo $errors; ?>
                                                    <?php if (isset($error_logo)) : ?>
                                                        <?php echo $error_logo; ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($_POST) && !isset($errors) && !isset($error_logo)) : ?>
                                                <div class='alert alert-success mt-10 mb-0'>
                                                    <i class='fa fa-check'></i> <?php echo lang('store_pro_l128'); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="review-single pt-30">
                                                <div class="row row-tb-30">
                                                    <div class="col-xs-12">
                                                        <div class="col-md-12 form-group">
                                                            <label for="exampleInputFile"><?php echo lang('store_pro_l129'); ?></label> 
                                                            <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name='logo'>
                                                            <?php if (isset($this->config->item('admin')['active_boost']) && $this->config->item('admin')['active_boost'] == 1) : ?>
                                                                <small id="fileHelp" class="form-text text-muted"><?php echo lang('store_pro_l130'); ?></small>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label><?php echo lang('store_pro_l131'); ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                                                <input type="text" class="form-control" required="required" placeholder='<?php echo lang('store_pro_l131'); ?>' name="company" id="company" data-validation="required" value="<?php echo empty($_POST) ? $pro->company : set_value('company'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label><?php echo lang('store_pro_l132'); ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                                <input type="text" class="form-control" required="required" placeholder='<?php echo lang('names') ?>' name="name_dealer" id="name_dealer" data-validation="required" value="<?php echo empty($_POST) ? $pro->name_dealer : set_value('name_dealer'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label><?php echo lang('store_pro_l133'); ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                                                <input type="text" class="form-control" required="required" placeholder='<?php echo lang('store_pro_l133'); ?>' name="address" id="address" data-validation="required" value="<?php echo empty($_POST) ? $pro->address : set_value('address'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label><?php echo lang('zipcode') ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                                                <input type="text" class="form-control" required="required" placeholder='<?php echo lang('zipcode') ?>' name="zipcode" id="zipcode" data-validation="required" value="<?php echo empty($_POST) ? $pro->zipcode : set_value('zipcode'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label><?php echo lang('city') ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                                                <?php $_GET['city'] = empty($_POST) ? $pro->city : set_value('city'); ?>
                                                                <input type="text" class="form-control" maxlength="5" required="required" value='<?php echo $_GET['city']; ?>' name="city" id="city" data-validation="required">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label><?php echo lang('phone') ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                                                <input type="text" class="form-control" required="required" placeholder='<?php echo lang('phone') ?>' name="phone" id="phone" data-validation="required" value="<?php echo empty($_POST) ? $pro->phone : set_value('phone'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 form-group">
                                                            <label><?php echo lang('email') ?></label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">@</span>
                                                                <input type="text" class="form-control" required="required" placeholder='<?php echo lang('email') ?>' data-validation="required" value="<?php echo empty($_POST) ? $pro->email : set_value('email'); ?>" disabled="disabled">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 form-group">
                                                            <label><?php echo lang('store_pro_l134'); ?></label>
                                                            <textarea maxlength="300" rows="5" class="form-control" required="required" data-validation="required" name="informations" id="informations"><?php echo empty($_POST) ? $pro->informations : set_value('informations'); ?></textarea>
                                                        </div>
                                                        <!--Update V1.1.0-->
                                                        <hr />
                                                        <label><?php echo lang('store_pro_bank_informations') ?></label>
                                                        <hr />
                                                        <div class="row">
                                                            <div class="col-md-6 form-group">
                                                                <label><?php echo lang('store_pro_bank_company') ?></label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class='fa fa-user'></i></span>
                                                                    <input type="text" name='bank_company' class="form-control" placeholder='<?php echo lang('store_pro_bank_company') ?>' value="<?php echo empty($_POST) ? $pro->bank_company : set_value('bank_company'); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label><?php echo lang('store_pro_bank_name') ?></label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class='fa fa-building'></i></span>
                                                                    <input type="text" name='bank_name' class="form-control" placeholder='<?php echo lang('store_pro_bank_name') ?>' value="<?php echo empty($_POST) ? $pro->bank_name : set_value('bank_name'); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label><?php echo lang('store_pro_bank_address') ?></label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class='fa fa-building'></i></span>
                                                                    <input type="text" name='bank_address' class="form-control" placeholder='<?php echo lang('store_pro_bank_address') ?>' value="<?php echo empty($_POST) ? $pro->bank_address : set_value('bank_address'); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label><?php echo lang('store_pro_bank_iban') ?></label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><?php echo $this->config->item('currency') ?></span>
                                                                    <input type="text" name='bank_iban' class="form-control" placeholder='<?php echo lang('store_pro_bank_iban') ?>' value="<?php echo empty($_POST) ? $pro->bank_iban : set_value('bank_iban'); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 form-group">
                                                                <label><?php echo lang('store_pro_bank_bic') ?></label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><?php echo $this->config->item('currency') ?></span>
                                                                    <input type="text" name='bank_bic' class="form-control" placeholder='<?php echo lang('store_pro_bank_bic') ?>' value="<?php echo empty($_POST) ? $pro->bank_bic : set_value('bank_bic'); ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr />
                                                        <label><?php echo lang('store_pro_paypal_account') ?></label>
                                                        <hr />
                                                        <div class="row">
                                                            <div class="col-md-6 form-group">
                                                                <label><?php echo lang('store_pro_paypal_email') ?></label>
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><?php echo $this->config->item('currency') ?></span>
                                                                    <input type="text" name='paypal_account' class="form-control" placeholder='<?php echo lang('store_pro_paypal_email') ?>' value="<?php echo empty($_POST) ? $pro->paypal_account : set_value('paypal_account'); ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr />
                                                        <!--End Update V1.1.0-->
                                                        <div class="col-md-12 form-group">
                                                            <a href="#" class="btn btn-info btn-xs" id="changePass"><?php echo lang('store_pro_l135'); ?></a>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group col-md-6 changePass" style="<?php echo!isset($_POST['password']) ? 'display: none' : '' ?>">
                                                                <label class="sr-only"><?php echo lang('store_pro_l136'); ?></label>
                                                                <input type="password" class="form-control input-lg" placeholder="<?php echo lang('store_pro_l136'); ?>" name="password">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group col-md-6 changePass" style="<?php echo!isset($_POST['password_new']) ? 'display: none' : '' ?>">
                                                                <label class="sr-only"><?php echo lang('store_pro_l137'); ?></label>
                                                                <input type="password" class="form-control input-lg" placeholder="<?php echo lang('store_pro_l137'); ?>" name="password_new">
                                                            </div>
                                                            <div class="form-group col-md-6 changePass" style="<?php echo!isset($_POST['password_new_confirm']) ? 'display: none' : '' ?>">
                                                                <label class="sr-only"><?php echo lang('store_pro_l138'); ?></label>
                                                                <input type="password" class="form-control input-lg" placeholder="<?php echo lang('store_pro_l138'); ?>" name="password_new_confirm">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 form-group">
                                                            <button type="submit" class="btn"><i class="fa fa-check"></i> <?php echo lang('store_pro_l139'); ?></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
<!--MODALS-->
<div id="wait" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body covers">
                <div class="alert alert-info">
                    <h3><i class="fa fa-clock-o"></i> <?php echo lang('store_pro_l140'); ?></h3>
                    <p>
                        <?php echo lang('store_pro_l141'); ?>
                    </p>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<div id="chooseLogo" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo lang('store_pro_l142'); ?></h4>
                <p><?php echo lang('store_pro_l143'); ?></p>
            </div>
            <div class="modal-body logos">

            </div>
            <div class="modal-footer"></div>
        </div>

    </div>
</div>
<?php if ($pro->legal < 2) : ?>
    <div id="legalConfirm" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center"><?php echo lang('store_pro_l144'); ?></h4>
                    <p class='mt-10'><?php echo lang('store_pro_l145'); ?></p>
                </div>
                <div class="modal-body text-center">
                    <form method="post">
                        <div class="custom-checkbox mb-20">
                            <input type="checkbox" id="legal" name="legal" value="2" <?php echo set_value('legal') == 2 ? 'checked' : '' ?>>
                            <label class="color-mid"><?php echo lang('store_pro_l146'); ?></label>
                        </div>
                        <button type="submit" class="btn btn-lg"><i class="fa fa-check"></i> <?php echo lang('validate') ?></button>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>

        </div>
    </div>
<?php endif; ?>

<div id="addPics"  class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo lang('store_pro_l147'); ?></h4>
            </div>
            <div class="modal-body text-center">
                <p><?php echo lang('store_pro_l148'); ?></p>
                <div action="" class="dropzone" id="addMyPics"></div>
            </div>
            <div class="modal-footer">
                <button class="btn" onclick="window.location.reload()"><i class="fa fa-check"></i> <?php echo lang('validate') ?></button>
            </div>
        </div>
    </div>
</div>