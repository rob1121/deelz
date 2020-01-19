<main id="mainContent" class="main-content">
    <!-- Page Container -->
    <div class="page-container ptb-60">
        <div class="container">

            <?php if ($this->config->item('demo') && $this->config->item('auth_IP') != $_SERVER['REMOTE_ADDR']) : ?>
                <div class="alert alert-warning">
                    <i class="fa fa-lock"></i> In this DEMO mode, you can't DELETE, change deals places or modify any admin configuration ;)
                </div>
            <?php endif; ?>
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


                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="store-splitter-left">
                                    <header class="left-splitter-header prl-10 ptb-20 bg-lighter">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <h2><?php echo count($deals_online); ?></h2>
                                                <p><?php echo lang('deals'); ?></p>
                                            </div>
                                            <div class="col-xs-6">
                                                <h2><?php echo count($coupons); ?></h2>
                                                <p><?php echo lang('coupons'); ?></p>
                                            </div>
                                            <div class="col-xs-12">
                                                <h2><?php echo count($plans); ?></h2>
                                                <p><?php echo lang('bonplans'); ?></p>
                                            </div>
                                        </div>
                                    </header>
                                    <!--<div class='col-xs-12'>
                                        <div class='col-xs-12 text-center'>Vue PRO :</div>
                                        <form method='post'>
                                            <div class='col-xs-8'>
                                                <select name='admin_show' class='form-control'>
                                                    <option value='11'>Admin</option>
                                    <?php if ($all_pros) : ?>
                                        <?php foreach ($all_pros as $pro_list) : ?>
                                                                                                                                                                                    <option value='<?php echo $pro_list->id; ?>'><?php echo $pro_list->company; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class='col-xs-4'>
                                                <button class='btn' type='submit'>Ok</button>
                                            </div>
                                        </form>
                                    </div>-->
                                    <footer class="left-splitter-social prl-20 ptb-20">
                                        <div class="col-md-12 text-center mt-30 mb-10">
                                            <a href="<?php echo base_url('users/logout') ?>" class="btn btn-info btn-xs"><i class="fa fa-unlock"></i> <?php echo lang('store_admin_l1'); ?></a>
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
                                    <a href="#all_deals" aria-controls="deals" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-tags mr-10"></i><?php echo lang('store_admin_l2'); ?></a>
                                </li>
                                <li role="presentation"  class="<?php echo isset($_GET['tab']) && $_GET['tab'] == 'reviews' ? 'active' : '' ?>">
                                    <a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-user mr-10"></i><?php echo lang('store_admin_l3'); ?></a>
                                </li>
                                <li role="presentation" class="<?php echo isset($_GET['tab']) && $_GET['tab'] == 'stats' ? 'active' : '' ?>">
                                    <a href="#stats" aria-controls="stats" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-line-chart mr-10"></i><?php echo lang('store_admin_l4'); ?></a>
                                </li>
                                <li role="presentation" class="<?php echo isset($_GET['tab']) && $_GET['tab'] == 'sales' ? 'active' : '' ?>">
                                    <a href="#sales" aria-controls="sales" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-calculator mr-10"></i><?php echo lang('store_admin_l5'); ?></a>
                                </li>
                                <li role="presentation" id="boost-tab" class="<?php echo isset($_GET['tab']) && $_GET['tab'] == 'boost' ? 'active' : '' ?>">
                                    <a href="#boost" aria-controls="boost" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-rocket mr-10"></i><?php echo lang('store_admin_l6'); ?></a>
                                </li>
                                <li role="presentation" id="boost-tab" class="<?php echo isset($_GET['tab']) && $_GET['tab'] == 'admin' ? 'active' : '' ?>">
                                    <a href="#admin" aria-controls="boost" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-desktop mr-10"></i><?php echo lang('store_admin_l7'); ?></a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- ALL DEALS -->
                                <div role="tabpanel" class="tab-pane ptb-20 <?php echo!isset($_GET['tab']) ? 'active' : '' ?>" id="all_deals">
                                    <div class="posted-review panel p-30 contact-area">
                                        <h1 class="text-center"><i class="fa fa-tags mr-10"></i> <?php echo lang('store_admin_l8'); ?></h1>
                                        <hr />
                                        <ul class="nav nav-tabs panel" role="tablist">
                                            <li role="deals" class="<?php echo (isset($_GET['sub_tab']) && $_GET['tab'] != 'all_deals') || (!isset($_GET['sub_tab']) || $_GET['sub_tab'] == 'deals') ? 'active' : '' ?>">
                                                <a href="#deals" aria-controls="deals" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-tags mr-10"></i><?php echo lang('deals_full') ?></a>
                                            </li>
                                            <li role="deals" class="<?php echo (isset($_GET['sub_tab']) && $_GET['tab'] == 'all_deals') && (isset($_GET['sub_tab']) && $_GET['sub_tab'] == 'coupons') ? 'active' : '' ?>">
                                                <a href="#coupons" aria-controls="coupons" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-tags mr-10"></i><?php echo lang('coupons_full') ?></a>
                                            </li>
                                            <li role="deals" class="<?php echo (isset($_GET['sub_tab']) && $_GET['tab'] == 'all_deals') && (isset($_GET['sub_tab']) && $_GET['sub_tab'] == 'bons-plans') ? 'active' : '' ?>">
                                                <a href="#bons-plans" aria-controls="bons-plans" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-comments mr-10"></i><?php echo lang('bonplans') ?></a>
                                            </li>
                                        </ul>
                                        <hr />
                                        <div class="tab-content">
                                            <!-- DEALS -->
                                            <div role="tabpanel" class="tab-pane ptb-20 <?php echo (isset($_GET['sub_tab']) && $_GET['tab'] != 'all_deals') || (!isset($_GET['sub_tab']) || $_GET['sub_tab'] == 'deals') ? 'active' : '' ?>" id="deals">
                                                <h3 class="mb-10 text-center"><?php echo lang('store_admin_l9'); ?></h3>
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
                                                                            <li class="like-deal" data-placement="bottom" data-toggle="tooltip" title="<?php echo ($deal->statut == 'publish') ? lang('store_admin_l11') : lang('store_admin_l12') ?>">
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
                                                                            <?php if ($deal->hp_top == 1 || $deal->hp_slider == 1) : ?>
                                                                                <div class='col-md-12'>
                                                                                    <?php if ($deal->hp_top == 1) : ?>
                                                                                        <div class='col-md-6 btn-danger text-center'><?php echo lang('store_admin_l13'); ?></div>
                                                                                    <?php endif; ?>
                                                                                    <?php if ($deal->hp_slider > 0) : ?>
                                                                                        <div class='col-md-6 btn-warning text-center'><?php echo lang('store_admin_l14'); ?> (<?php echo $deal->hp_slider; ?>)</div>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                            <h3 class="deal-title mb-10">
                                                                                <a href="<?php echo routeDeal($deal->deal_id, $deal->title) ?>"><?php echo $deal->title; ?></a>
                                                                            </h3>
                                                                            <ul class="deal-meta list-inline mb-10 color-mid">
                                                                                <li><i class="ico fa fa-building-o mr-10"></i><?php echo $deal->company; ?></li>
                                                                                <li><i class="ico fa fa-map-marker mr-10"></i><?php echo $deal->city; ?></li>
                                                                                <li><i class="ico <?php echo getDealTypeIcon($deal->type_deal); ?> mr-10"></i><?php echo getDealType($deal->type_deal); ?></li>
                                                                            </ul>
                                                                            <p class="text-muted mb-20"><?php echo $deal->excerpt; ?></p>
                                                                        </div>
                                                                        <div class="deal-price pos-r mb-15">
                                                                            <h3 class="price ptb-5 text-right"><span class="price-sale"><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_base) : ''; ?></span><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_promo) : priceToShow($deal->price_base); ?></h3>
                                                                        </div>
                                                                        <div class="text-center mb-10"> 
                                                                            <?php $this->load->view('store/partial/admin_actions', array('deal' => $deal)) ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <div class="col-xs-12">
                                                            <div class='alert alert-info text-center'>
                                                                <h3><i class='fa fa-shopping-cart'></i> <?php echo lang('store_admin_l15'); ?></h3>
                                                            </div>
                                                            <div class="text-center">
                                                                <a href="<?php echo base_url('store/pro?tab=admin&sub_tab=admin_stores') ?>" class='btn mt-10'><i class='fa fa-plus'></i> <?php echo lang('store_admin_l16'); ?></a>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <!-- COUPONS -->
                                            <div role="tabpanel" class="tab-pane ptb-20 <?php echo (isset($_GET['sub_tab']) && $_GET['tab'] == 'all_deals') && (isset($_GET['sub_tab']) && $_GET['sub_tab'] == 'coupons') ? 'active' : '' ?>" id="coupons">
                                                <h3 class="mb-10 text-center"><?php echo lang('store_admin_l17'); ?></h3>
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
                                                                                <?php if ($deal->hp_top == 1 || $deal->hp_slider == 1) : ?>
                                                                                    <div class='col-md-12'>
                                                                                        <?php if ($deal->hp_top == 1) : ?>
                                                                                            <div class='col-md-6 btn-danger text-center'><?php echo lang('store_admin_l13'); ?></div>
                                                                                        <?php endif; ?>
                                                                                        <?php if ($deal->hp_slider > 0) : ?>
                                                                                            <div class='col-md-6 btn-warning text-center'><?php echo lang('store_admin_l14'); ?> (<?php echo $deal->hp_slider; ?>)</div>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                                <ul class="deal-meta list-inline mb-10">
                                                                                    <li><i class="ico fa fa-building-o mr-10"></i><?php echo $deal->company; ?></li>
                                                                                    <li class="color-green"><i class="ico <?php echo getDealTypeIcon($deal->type_deal); ?> mr-10"></i><?php echo getDealType($deal->type_deal); ?></li>
                                                                                    <li class="color-muted"><i class="ico lnr lnr-map mr-5"></i><?php echo $deal->city; ?></li>
                                                                                </ul>
                                                                                <h4 class="color-green mb-10 t-uppercase">-<?php echo $deal->promo_discount; ?>%</h4>
                                                                                <h5 class="deal-title mb-10">
                                                                                    <a href="<?php echo routeDeal($deal->deal_id, $deal->title); ?>"><?php echo $deal->title; ?></a>
                                                                                </h5>
                                                                                <p class="mb-15 color-muted mb-20 font-12"><i class="lnr lnr-tags mr-10"></i><?php echo $deal->coupons ?> coupon<?php echo $deal->coupons > 1 ? 's' : '' ?></p>
                                                                                <p class="mb-15 color-muted mb-20 font-12"><i class="lnr lnr-clock mr-10"></i><?php echo lang('end')?> : <?php echo substr($deal->end, 0, 10) ?></p>
                                                                                <div>
                                                                                    <a class="btn btn-sm btn-block mb-10" href="<?php echo routeDeal($deal->deal_id, $deal->title) ?>"><?php echo lang('store_admin_l18'); ?></a>
                                                                                    <div class='clear clearfix'></div>
                                                                                </div>
                                                                                <div class="text-center mb-10"> 
                                                                                    <?php $this->load->view('store/partial/admin_actions', array('deal' => $deal)) ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- end col -->
                                                                    </div>
                                                                    <!-- end row -->
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <div class="col-xs-12">
                                                            <div class='alert alert-info text-center'>
                                                                <h3><i class='fa fa-shopping-cart'></i> <?php echo lang('store_admin_l15'); ?></h3>
                                                            </div>
                                                            <div class="text-center">
                                                                <a href="<?php echo base_url('store/pro?tab=admin&sub_tab=admin_stores') ?>" class='btn mt-10'><i class='fa fa-plus'></i> <?php echo lang('store_admin_l16'); ?></a>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <!-- PLANS -->
                                            <div role="tabpanel" class="tab-pane ptb-20 <?php echo (isset($_GET['sub_tab']) && $_GET['tab'] == 'all_deals') && (isset($_GET['sub_tab']) && $_GET['sub_tab'] == 'bons-plans') ? 'active' : '' ?>" id="bons-plans">
                                                <h3 class="mb-10 text-center"><?php echo lang('store_admin_l19'); ?></h3>
                                                <?php if ($plans) : ?>
                                                    <?php foreach ($plans as $deal) : ?>
                                                        <div class="review-single pt-30">
                                                            <div class="media">
                                                                <div class="media-left">
                                                                    <a href="<?php echo routeDeal($deal->deal_id, $deal->title); ?>">
                                                                        <img class="media-object mr-10 radius-4" src="<?php echo base_url('assets/images/' . $deal->cover) ?>" width="90" alt="">
                                                                    </a>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div class="review-wrapper clearfix">
                                                                        <?php if ($deal->hp_top == 1 || $deal->hp_slider == 1) : ?>
                                                                            <div class='col-md-12'>
                                                                                <?php if ($deal->hp_top == 1) : ?>
                                                                                    <div class='col-md-6 btn-danger text-center'><?php echo lang('store_admin_l13'); ?></div>
                                                                                <?php endif; ?>
                                                                                <?php if ($deal->hp_slider > 0) : ?>
                                                                                    <div class='col-md-6 btn-warning text-center'><?php echo lang('store_admin_l14'); ?> (<?php echo $deal->hp_slider; ?>)</div>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <ul class="list-inline">
                                                                            <li>
                                                                                <a href="<?php echo routeDeal($deal->deal_id, $deal->title); ?>">
                                                                                    <span class="review-holder-name h5"><?php echo $deal->title; ?></span>
                                                                                </a>
                                                                            </li>
                                                                            <li><i class="ico fa fa-building-o mr-10"></i><?php echo $deal->company; ?></li>
                                                                            <li>
                                                                                <span class="color-green mb-10 t-uppercase"><?php echo priceToShow($deal->price_base); ?></span>
                                                                            </li>
                                                                        </ul>
                                                                        <p class="review-date mb-5"><i class="lnr lnr-edit mr-10"></i> <?php echo lang('store_admin_l20'); ?> <?php echo $deal->quotation_online == 1 ? lang('yes') : lang('no') ?></p>
                                                                        <p class="review-date mb-5"><i class="lnr lnr-edit mr-10"></i><?php echo $deal->coupons ?> devis</p>
                                                                        <p class="review-date mb-5"><?php echo $deal->start != $deal->end ? $deal->start . ' <i class="fa fa-arrow-right"></i> ' . $deal->end : $deal->start; ?></p>
                                                                        <p class="copy"><?php echo $deal->excerpt; ?></p>
                                                                        <div class="text-center mb-10"> 
                                                                            <?php $this->load->view('store/partial/admin_actions', array('deal' => $deal)) ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <div class="col-xs-12">
                                                        <div class='alert alert-info text-center'>
                                                            <h3><i class='fa fa-shopping-cart'></i> <?php echo lang('store_admin_l15'); ?></h3>
                                                        </div>
                                                        <div class="text-center">
                                                            <a href="<?php echo base_url('store/pro?tab=admin&sub_tab=admin_stores') ?>" class='btn mt-10'><i class='fa fa-plus'></i> <?php echo lang('store_admin_l16'); ?></a>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- REVIEWS -->
                                <div role="tabpanel" class="tab-pane ptb-20" id="reviews">
                                    <?php $this->load->view('store/partial/reviews', array('prod_id' => $pro->id, 'pro' => true, 'pro_company' => $pro->company)); ?>
                                </div>
                                <!-- STATS -->
                                <div role="tabpanel" class="tab-pane ptb-20 <?php echo isset($_GET['tab']) && $_GET['tab'] == 'stats' ? 'active' : '' ?>" id="stats">
                                    <div class="posted-review panel p-30 contact-area">
                                        <h1 class="text-center"><i class="fa fa-line-chart mr-10"></i> <?php echo lang('store_admin_l21'); ?></h1>
                                        <div class="review-single pt-30">
                                            <div class="row row-tb-30">
                                                <div class="col-xs-12">
                                                    <div class="row">
                                                        <h3><?php echo lang('store_admin_l22'); ?></h3>
                                                        <div class='col-md-12'>
                                                            <div class="col-xs-4 btn-info text-center">
                                                                <h2><?php echo $this->orders->getForUsersPro(); ?></h2>
                                                                <p><?php echo lang('store_admin_l23'); ?></p>
                                                            </div>
                                                            <div class="col-xs-4 btn-danger text-center">
                                                                <h2><?php echo $this->coupons_printed->getForUsersPro(); ?></h2>
                                                                <p><?php echo lang('store_admin_l24'); ?></p>
                                                            </div>
                                                            <div class="col-xs-4 btn-warning text-center">
                                                                <h2><?php echo $this->stats_views_details->getForUsersPro(); ?></h2>
                                                                <p><?php echo lang('store_admin_l25'); ?></p>
                                                            </div>
                                                            <div class="col-xs-4 btn-facebook text-center text-white color-white">
                                                                <h2><?php echo count($this->users->getAll()); ?></h2>
                                                                <p><?php echo lang('store_admin_l25_1'); ?></p>
                                                            </div>
                                                            <div class="col-xs-4 btn-success text-center text-white color-white">
                                                                <h2><?php echo count($this->users_cart->getAll()); ?></h2>
                                                                <p><?php echo lang('store_admin_l26'); ?></p>
                                                            </div>
                                                            <div class="col-xs-4 btn-danger text-center text-white color-white">
                                                                <h2><?php echo count($this->users_favorites->getAll()); ?></h2>
                                                                <p><?php echo lang('store_admin_l27'); ?></p>
                                                            </div>
                                                        </div>
                                                        <div class='col-md-12 mt-20'>
                                                            <hr />
                                                            <h3><?php echo lang('store_admin_l28'); ?></h3>
                                                            <p><?php echo lang('store_admin_l29'); ?></p>
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
                                                                    <h3><i class='fa fa-line-chart'></i> <?php echo lang('store_admin_l30'); ?></h3>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class='col-md-12 mt-20'>
                                                            <hr />
                                                            <h3><?php echo lang('store_admin_l31'); ?></h3>
                                                            <p><?php echo lang('store_admin_l32'); ?></p>
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
                                                                    <h3><i class='fa fa-line-chart'></i> <?php echo lang('store_admin_l33'); ?></h3>
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
                                        <h1 class="text-center"><i class="fa fa-calculator mr-10"></i> <?php echo lang('store_admin_l34'); ?></h1>
                                        <div class="review-single pt-30">
                                            <div class="row row-tb-30">
                                                <div class="col-xs-12">
                                                    <div class="row">
                                                        <div class='col-md-12'>
                                                            <?php $totalSales = 0; ?>
                                                            <h3 class="text-center"><?php echo lang('store_admin_l35'); ?></h3>
                                                            <hr />
                                                            <h5 class="text-center"><?php echo lang('deals_full') ?></h5>
                                                            <hr />
                                                            <?php if ($orders) : ?>
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <th><?php echo lang('store_admin_l36'); ?></th>
                                                                    <th><?php echo lang('store_admin_l37'); ?></th>
                                                                    <th><?php echo lang('store_admin_l38'); ?></th>
                                                                    <th><?php echo lang('store_admin_l39'); ?></th>
                                                                    <th><?php echo lang('store_admin_l40'); ?></th>
                                                                    <th><?php echo lang('store_admin_l41'); ?></th>
                                                                    <th><?php echo lang('store_admin_l42'); ?></th>
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
                                                                                <td><?php echo $order->company . '<br /> ' . $order->address . '<br /> ' . $order->zipcode . ' ' . $order->city . '<br /> <a href="mailto:' . $order->email . '">' . $order->email . '</a>' ?></td>
                                                                                <td><?php echo $order->order_created_at ?></td>
                                                                                <td><?php echo $order->validated ?></td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                        <?php $totalSales += $sumSales; ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr class="success">
                                                                            <td colspan="2">
                                                                                <?php echo lang('store_admin_l43'); ?>
                                                                            </td>
                                                                            <td colspan="5">
                                                                                <?php echo priceToShow($sumSales); ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="info">
                                                                            <td colspan="2">
                                                                                <?php echo lang('store_admin_l44'); ?>
                                                                            </td>
                                                                            <td colspan="5">
                                                                                <?php echo priceToShow(number_format($sumSales * ($this->config->item('admin')['coef_deals'] / 100), 2)); ?>
                                                                            </td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            <?php else : ?>
                                                                <div class='alert alert-info text-center mt-10'>
                                                                    <h3><i class='fa fa-line-chart'></i> <?php echo lang('store_admin_l46'); ?></h3>
                                                                </div>
                                                            <?php endif; ?>

                                                            <h5 class="text-center"><?php echo lang('coupons_full'); ?></h5>
                                                            <hr />
                                                            <?php if ($coupons) : ?>
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <th><?php echo lang('store_admin_l36'); ?></th>
                                                                    <th><?php echo lang('store_admin_l37'); ?></th>
                                                                    <th><?php echo lang('store_admin_l38'); ?></th>
                                                                    <th><?php echo lang('store_admin_l40'); ?></th>
                                                                    <th><?php echo lang('store_admin_l41'); ?></th>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php $sumSales = 0; ?>
                                                                        <?php foreach ($coupons as $deal) : ?>
                                                                            <?php if ($deal->paid == 1) : ?>
                                                                                <?php $sumSales += $deal->price_promo * ($this->config->item('admin')['coef_coupons'] / 100) * $deal->coupons; ?>
                                                                                <tr>
                                                                                    <td><?php echo $deal->id ?></td>
                                                                                    <td><a href="<?php echo routeDeal($deal->id, $deal->title); ?>"><?php echo $deal->title ?></a></td>
                                                                                    <td><?php echo priceToShow($deal->price_promo * ($this->config->item('admin')['coef_coupons'] / 100) * $deal->coupons) ?></td>
                                                                                    <td><?php echo $deal->company . '<br /> ' . $deal->address . '<br /> ' . $deal->zipcode . ' ' . $deal->city ?></td>
                                                                                    <td><?php echo $deal->created_at ?></td>
                                                                                </tr>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                        <?php $totalSales += $sumSales; ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr class="success">
                                                                            <td colspan="2">
                                                                                Total 
                                                                            </td>
                                                                            <td colspan="3">
                                                                                <?php echo priceToShow($sumSales); ?>
                                                                            </td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            <?php else : ?>
                                                                <div class='alert alert-info text-center mt-10'>
                                                                    <h3><i class='fa fa-line-chart'></i> <?php echo lang('store_admin_l46'); ?></h3>
                                                                </div>
                                                            <?php endif; ?>

                                                            <h5 class="text-center"><?php echo lang('store_admin_l47'); ?></h5>
                                                            <hr />
                                                            <?php if ($boosts_social) : ?>
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <th><?php echo lang('store_admin_l36'); ?></th>
                                                                    <th><?php echo lang('store_admin_l37'); ?></th>
                                                                    <th><?php echo lang('store_admin_l38'); ?></th>
                                                                    <th><?php echo lang('store_admin_l39'); ?></th>
                                                                    <th><?php echo lang('store_admin_l41'); ?></th>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php $sumSales = 0; ?>
                                                                        <?php foreach ($boosts_social as $deal) : ?>
                                                                            <?php if ($deal->boost_social_paid == 1) : ?>
                                                                                <?php $sumSales += $deal->boost_social_amount; ?>
                                                                                <tr>
                                                                                    <td><?php echo $deal->id ?></td>
                                                                                    <td><a href="<?php echo routeDeal($deal->id, $deal->title); ?>"><?php echo $deal->title ?></a></td>
                                                                                    <td><?php echo priceToShow($deal->boost_social_amount) ?></td>
                                                                                    <td></td>
                                                                                    <td><?php echo $deal->boost_social_created_at ?></td>
                                                                                </tr>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                        <?php $totalSales += $sumSales; ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr class="success">
                                                                            <td colspan="2">
                                                                                <?php echo lang('store_admin_l49'); ?> 
                                                                            </td>
                                                                            <td colspan="3">
                                                                                <?php echo priceToShow($sumSales); ?>
                                                                            </td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            <?php else : ?>
                                                                <div class='alert alert-info text-center mt-10'>
                                                                    <h3><i class='fa fa-line-chart'></i> <?php echo lang('store_admin_l46'); ?></h3>
                                                                </div>
                                                            <?php endif; ?>

                                                            <h5 class="text-center"><?php echo lang('store_admin_l48'); ?></h5>
                                                            <hr />
                                                            <?php if ($boosts_zotdeal) : ?>
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <th><?php echo lang('store_admin_l36'); ?></th>
                                                                    <th><?php echo lang('store_admin_l37'); ?></th>
                                                                    <th><?php echo lang('store_admin_l38'); ?></th>
                                                                    <th><?php echo lang('store_admin_l39'); ?></th>
                                                                    <th><?php echo lang('store_admin_l41'); ?></th>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php $sumSales = 0; ?>
                                                                        <?php foreach ($boosts_zotdeal as $deal) : ?>
                                                                            <?php if ($deal->boost_zotdeal_paid == 1) : ?>
                                                                                <?php $sumSales += $deal->boost_zotdeal_amount; ?>
                                                                                <tr>
                                                                                    <td><?php echo $deal->id ?></td>
                                                                                    <td><a href="<?php echo routeDeal($deal->id, $deal->title); ?>"><?php echo $deal->title ?></a></td>
                                                                                    <td><?php echo priceToShow($deal->boost_zotdeal_amount) ?></td>
                                                                                    <td></td>
                                                                                    <td><?php echo $deal->boost_zotdeal_created_at ?></td>
                                                                                </tr>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                        <?php $totalSales += $sumSales; ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr class="success">
                                                                            <td colspan="2">
                                                                                <?php echo lang('store_admin_l49'); ?> 
                                                                            </td>
                                                                            <td colspan="3">
                                                                                <?php echo priceToShow($sumSales); ?>
                                                                            </td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            <?php else : ?>
                                                                <div class='alert alert-info text-center mt-10'>
                                                                    <h3><i class='fa fa-line-chart'></i> <?php echo lang('store_admin_l46'); ?></h3>
                                                                </div>
                                                            <?php endif; ?>

                                                            <h1 class="alert alert-success text-center"><?php echo lang('store_admin_l49'); ?> : <?php echo priceToShow($totalSales); ?></h1>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- BOOST -->
                                <div role="tabpanel" class="tab-pane ptb-20 <?php echo isset($_GET['tab']) && $_GET['tab'] == 'boost' ? 'active' : '' ?>" id="boost">
                                    <div class="posted-review panel p-30 contact-area">
                                        <h1 class='text-center'><i class='fa fa-rocket'></i> <?php echo lang('store_admin_l52'); ?></h1>
                                        <div class="review-single pt-30">
                                            <div class="row row-tb-30">
                                                <div class="col-xs-12">
                                                    <hr />
                                                    <ul class="nav nav-tabs panel" role="tablist">
                                                        <li role="boosts_type" class="active">
                                                            <a href="#boost_social" aria-controls="boost_social" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-facebook mr-10"></i><?php echo lang('store_admin_l53'); ?></a>
                                                        </li>
                                                        <li role="boosts_type">
                                                            <a href="#boost_zotdeal" aria-controls="boost_zotdeal" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-desktop mr-10"></i><?php echo lang('store_admin_l54'); ?></a>
                                                        </li>
                                                        <li role="boosts_type">
                                                            <a href="#boost_newsletter" aria-controls="boost_newsletter" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-envelope mr-10"></i><?php echo lang('store_admin_l55'); ?></a>
                                                        </li>
                                                        <li role="boosts_type" >
                                                            <a href="#boost_photo" aria-controls="boost_photo" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-photo mr-10"></i><?php echo lang('store_admin_l56'); ?></a>
                                                        </li>
                                                        <li role="boosts_type">
                                                            <a href="#boost_logo" aria-controls="boost_logo" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-paw mr-10"></i><?php echo lang('store_admin_l57'); ?></a>
                                                        </li>
                                                    </ul>
                                                    <hr />

                                                    <div class="tab-content">
                                                        <!-- BOOST SOCIAL -->
                                                        <div role="tabpanel" class="tab-pane ptb-20 active" id="boost_social">
                                                            <?php if ($boosts_social) : ?>
                                                                <?php foreach ($boosts_social as $deal) : ?>
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
                                                                                    <div>
                                                                                        <strong><?php echo lang('store_admin_l58'); ?> : </strong>
                                                                                        <span>Budget : <?php echo priceToShow($deal->boost_social_amount); ?></span>
                                                                                    </div>
                                                                                    <div class="text-center mb-10"> 
                                                                                        <?php $deal->deal_id = $deal->deals_id; ?>
                                                                                        <?php $this->load->view('store/partial/admin_actions', array('deal' => $deal)) ?>
                                                                                    </div>
                                                                                    <div class="text-center mb-10"> 
                                                                                        <?php if ($deal->boost_social_treated == 0) : ?>
                                                                                            <a class="btn" href="<?php echo base_url('admin/boostTreated/' . $deal->boost_social_id . '/boosts_social/1') ?>"><?php echo lang('store_admin_l59'); ?></a>
                                                                                        <?php else : ?>
                                                                                            <strong><?php echo lang('store_admin_l59_1'); ?></strong>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>

                                                        <!-- BOOST ZOTDEAL -->
                                                        <div role="tabpanel" class="tab-pane ptb-20" id="boost_zotdeal">
                                                            <?php if ($boosts_zotdeal) : ?>
                                                                <?php foreach ($boosts_zotdeal as $deal) : ?>
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
                                                                                    <div>
                                                                                        <strong><?php echo lang('store_admin_l60'); ?> : </strong>
                                                                                        <span><?php echo lang('store_admin_l61'); ?> : <?php echo $deal->boost_zotdeal_top; ?> / <?php echo lang('store_admin_l62'); ?> : <?php echo $deal->boost_zotdeal_slider; ?></span>
                                                                                    </div>
                                                                                    <div class="text-center mb-10"> 
                                                                                        <?php $deal->deal_id = $deal->deals_id; ?>
                                                                                        <?php $this->load->view('store/partial/admin_actions', array('deal' => $deal)) ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>

                                                        <!-- BOOST NEWSLETTER -->
                                                        <div role="tabpanel" class="tab-pane ptb-20" id="boost_newsletter">
                                                            <?php if ($boosts_newsletter) : ?>
                                                                <?php foreach ($boosts_newsletter as $deal) : ?>
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
                                                                                    <div>
                                                                                        <strong><?php echo lang('store_admin_l63'); ?> : </strong>
                                                                                        <span></span>
                                                                                    </div>
                                                                                    <div class="text-center mb-10"> 
                                                                                        <?php $deal->deal_id = $deal->deals_id; ?>
                                                                                        <?php $this->load->view('store/partial/admin_actions', array('deal' => $deal)) ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>

                                                        <!-- BOOST PHOTO -->
                                                        <div role="tabpanel" class="tab-pane ptb-20" id="boost_photo">
                                                            <?php if ($boosts_photo) : ?>
                                                                <?php foreach ($boosts_photo as $pro) : ?>
                                                                    <div class="review-single pt-30">
                                                                        <div class="media">
                                                                            <div class="media-left">
                                                                                <img class="media-object mr-10 radius-4" src="<?php echo base_url('assets/images/brands/' . (!empty($pro->logo) ? $pro->logo : 'boutique.png')); ?>" width="90" alt="">
                                                                            </div>
                                                                            <div class="media-body">
                                                                                <div class="review-wrapper clearfix">
                                                                                    <ul class="list-inline">
                                                                                        <li>
                                                                                            <span class="review-holder-name h5"><?php echo $pro->company; ?></span>
                                                                                        </li>
                                                                                    </ul>
                                                                                    <p class="review-date mb-5">
                                                                                    <ul>
                                                                                        <li><i class="fa fa-phone"></i> <?php echo $pro->phone; ?></li>
                                                                                        <li><i class="fa fa-map-marker"></i> <?php echo $pro->address . ' ' . $pro->zipcode . ' ' . $pro->city; ?></li>
                                                                                    </ul>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>

                                                        <!-- BOOST LOGO -->
                                                        <div role="tabpanel" class="tab-pane ptb-20" id="boost_logo">
                                                            <?php if ($boosts_logo) : ?>
                                                                <?php foreach ($boosts_logo as $pro) : ?>
                                                                    <div class="review-single pt-30">
                                                                        <div class="media">
                                                                            <div class="media-left">
                                                                                <img class="media-object mr-10 radius-4" src="<?php echo base_url('assets/images/brands/' . (!empty($pro->logo) ? $pro->logo : 'boutique.png')); ?>" width="90" alt="">
                                                                            </div>
                                                                            <div class="media-body">
                                                                                <div class="review-wrapper clearfix">
                                                                                    <ul class="list-inline">
                                                                                        <li>
                                                                                            <span class="review-holder-name h5"><?php echo $pro->company; ?></span>
                                                                                        </li>
                                                                                    </ul>
                                                                                    <p class="review-date mb-5">
                                                                                    <ul>
                                                                                        <li><i class="fa fa-phone"></i> <?php echo $pro->phone; ?></li>
                                                                                        <li><i class="fa fa-map-marker"></i> <?php echo $pro->address . ' ' . $pro->zipcode . ' ' . $pro->city; ?></li>
                                                                                    </ul>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ADMIN -->
                                <div role="tabpanel" class="tab-pane ptb-20 <?php echo isset($_GET['tab']) && $_GET['tab'] == 'admin' ? 'active' : '' ?>" id="admin">
                                    <div class="posted-review panel p-30 contact-area">
                                        <h1 class='text-center'><i class='fa fa-rocket'></i> <?php echo lang('store_admin_l64'); ?></h1>
                                        <div class="review-single pt-30">
                                            <div class="row row-tb-30">
                                                <div class="col-xs-12">
                                                    <hr />
                                                    <ul class="nav nav-tabs panel" role="tablist">
                                                        <li role="admin_opt" class="<?php echo!isset($_GET['sub_tab']) || $_GET['sub_tab'] == 'admin_config' ? 'active' : '' ?>">
                                                            <a href="#admin_config" aria-controls="admin_config" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-desktop mr-10"></i><?php echo lang('store_admin_l65'); ?></a>
                                                        </li>
                                                        <li role="admin_opt" class="<?php echo isset($_GET['sub_tab']) && $_GET['sub_tab'] == 'admin_medias' ? 'active' : '' ?>">
                                                            <a href="#admin_medias" aria-controls="admin_medias" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-photo mr-10"></i><?php echo lang('store_admin_l66'); ?></a>
                                                        </li>
                                                        <li role="admin_opt" class="<?php echo isset($_GET['sub_tab']) && $_GET['sub_tab'] == 'admin_categories' ? 'active' : '' ?>">
                                                            <a href="#admin_categories" aria-controls="admin_categories" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-asterisk mr-10"></i><?php echo lang('store_admin_l67'); ?></a>
                                                        </li>
                                                        <li role="admin_opt" class="<?php echo isset($_GET['sub_tab']) && $_GET['sub_tab'] == 'admin_stores' ? 'active' : '' ?>">
                                                            <a href="#admin_stores" aria-controls="admin_stores" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-building-o mr-10"></i><?php echo lang('store_admin_l68'); ?></a>
                                                        </li>
                                                        <li role="admin_opt" class="<?php echo isset($_GET['sub_tab']) && $_GET['sub_tab'] == 'admin_CMS' ? 'active' : '' ?>">
                                                            <a href="#admin_CMS" aria-controls="admin_CMS" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-edit mr-10"></i><?php echo lang('store_admin_l69'); ?></a>
                                                        </li>
                                                    </ul>
                                                    <hr />

                                                    <div class="tab-content">
                                                        <!-- ADMIN CONFIG -->
                                                        <div role="tabpanel" class="tab-pane ptb-20 <?php echo!isset($_GET['sub_tab']) || $_GET['sub_tab'] == 'admin_config' ? 'active' : '' ?>" id="admin_config">
                                                            <h3 class="text-center"><?php echo lang('store_admin_l70'); ?></h3>
                                                   
                                                            <p class="text-center"><?php echo lang('store_admin_l71'); ?></p>
                                                         
                                                            <form method='post' enctype='multipart/form-data' action='?tab=admin'>
                                                                <?php if (isset($errors) || isset($error_logo)) : ?>
                                                                    <div class='alert alert-danger mt-10 mb-0'>
                                                                        <?php echo $errors; ?>
                                                                        <?php if (isset($error_logo)) : ?>
                                                                            <?php echo $error_logo; ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <hr />
                                                                <h5 class="text-center"><?php echo lang('store_admin_l72'); ?></h5>
                                                                <hr />
                                                                <div class="col-md-12 form-group">
                                                                    <label for="changeLogo"><?php echo lang('store_admin_l73'); ?></label>
                                                                    <input type="file" class="form-control-file" id="changeLogo" aria-describedby="fileHelp" name='logo'>
                                                                </div>
                                                                <?php if (isset($config['logo']) && $config['logo'] == 1) : ?>
                                                                    <!--TEMPLATE-->
                                                                    <div class="col-md-12 form-group">
                                                                        <img src="<?php echo base_url('assets/uploads/logo.png'); ?>" />
                                                                    </div>
                                                                <?php endif; ?>
                                                                <div class="col-md-12 form-group">
                                                                    <label><?php echo lang('store_admin_site_name'); ?></label>
                                                                    <input type="text" class="form-control" required="required" name="site_name" id="site_name" data-validation="required" value="<?php echo empty($_POST['site_name']) ? $config['site_name'] : set_value('site_name'); ?>">
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label><?php echo lang('store_admin_l74'); ?></label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">#</span>
                                                                        <input type="text" class="form-control" required="required" name="color_1" id="color_1" data-validation="required" value="<?php echo empty($_POST['color_1']) ? $config['color_1'] : set_value('color_1'); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label><?php echo lang('store_admin_l75'); ?></label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">#</span>
                                                                        <input type="text" class="form-control" required="required" name="color_2" id="color_2" data-validation="required" value="<?php echo empty($_POST['color_1']) ? $config['color_2'] : set_value('color_2'); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label><?php echo lang('store_admin_l76'); ?></label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">#</span>
                                                                        <input type="text" class="form-control" required="required" name="color_3" id="color_3" data-validation="required" value="<?php echo empty($_POST['color_1']) ? $config['color_3'] : set_value('color_3'); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group">
                                                                    <label><?php echo lang('store_admin_l77'); ?></label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">#</span>
                                                                        <input type="text" class="form-control" required="required" name="color_4" id="color_4" data-validation="required" value="<?php echo empty($_POST['color_1']) ? $config['color_4'] : set_value('color_4'); ?>">
                                                                    </div>
                                                                </div>
                                                                <!--ACTIVATION PRO SECTION-->
                                                                <div class="col-xs-12 mt-30">
                                                                    <hr />
                                                                    <h5 class="text-center"><?php echo lang('store_admin_l78'); ?></h5>
                                                                    <hr />
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <div class="custom-checkbox mb-20">
                                                                        <input type="checkbox" id="newsletter" name="active_pro" value="1" <?php echo empty($_POST['color_1']) ? ($config['active_pro'] == '1' ? 'checked' : '') : (set_value('active_pro') == '1' ? 'checked' : ''); ?>>
                                                                        <label class="color-mid"><?php echo lang('store_admin_l79'); ?></label>
                                                                    </div>
                                                                </div>
                                                                <!--ACTIVATION DEALS, COUPONS, PLANS, BOOSTS-->
                                                                <div class="col-xs-12 mt-30">
                                                                    <hr />
                                                                    <h5 class="text-center"><?php echo lang('store_admin_l80'); ?></h5>
                                                                    <hr />
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <div class="custom-checkbox mb-20">
                                                                        <input type="checkbox" id="newsletter" name="active_deal" value="1" <?php echo empty($_POST['color_1']) ? ($config['active_deal'] == '1' ? 'checked' : '') : (set_value('active_deal') == '1' ? 'checked' : ''); ?>>
                                                                        <label class="color-mid"><?php echo lang('store_admin_l81'); ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <div class="custom-checkbox mb-20">
                                                                        <input type="checkbox" id="newsletter" name="active_coupon" value="1"  <?php echo empty($_POST['color_1']) ? ($config['active_coupon'] == '1' ? 'checked' : '') : (set_value('active_coupon') == '1' ? 'checked' : ''); ?>>
                                                                        <label class="color-mid"><?php echo lang('store_admin_l82'); ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <div class="custom-checkbox mb-20">
                                                                        <input type="checkbox" id="newsletter" name="active_bon-plan" value="1"  <?php echo empty($_POST['color_1']) ? ($config['active_bon-plan'] == '1' ? 'checked' : '') : (set_value('active_bon-plan') == '1' ? 'checked' : ''); ?>>
                                                                        <label class="color-mid"><?php echo lang('store_admin_l83'); ?></label>
                                                                    </div> 
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <div class="custom-checkbox mb-20">
                                                                        <input type="checkbox" id="newsletter" name="active_boost" value="1"  <?php echo empty($_POST['color_1']) ? ($config['active_boost'] == '1' ? 'checked' : '') : (set_value('active_boost') == '1' ? 'checked' : ''); ?>>
                                                                        <label class="color-mid"><?php echo lang('store_admin_active_boost'); ?></label>
                                                                    </div> 
                                                                </div>
                                                                <!--COMMISSIONS COEF DEALS, COUPONS, QUOTATION-->
                                                                <div class="col-xs-12 mt-30">
                                                                    <hr />
                                                                    <h5 class="text-center"><?php echo lang('store_admin_l84'); ?></h5>
                                                                    <hr />
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <div class="col-md-12 form-group">
                                                                        <label><?php echo lang('store_admin_l85'); ?></label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" required="required" name="coef_deals" id="coef_deals" data-validation="required" value="<?php echo empty($_POST['color_1']) ? $config['coef_deals'] : set_value('coef_deals'); ?>">
                                                                            <span class="input-group-addon">%</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <div class="col-md-12 form-group">
                                                                        <label><?php echo lang('store_admin_l86'); ?></label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" required="required" name="coef_coupons" id="coef_coupons" data-validation="required" value="<?php echo empty($_POST['color_1']) ? $config['coef_coupons'] : set_value('coef_coupons'); ?>">
                                                                            <span class="input-group-addon">%</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <div class="col-md-12 form-group">
                                                                        <label><?php echo lang('store_admin_l87'); ?></label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" required="required" name="coef_quotation" id="coef_quotation" data-validation="required" value="<?php echo empty($_POST['color_1']) ? $config['coef_quotation'] : set_value('coef_quotation'); ?>">
                                                                            <span class="input-group-addon"><?php echo $this->config->item('currency'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <div class="col-md-12 form-group">
                                                                        <label><?php echo lang('store_admin_l88'); ?></label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" required="required" name="coef_taxe" id="coef_quotation" data-validation="required" value="<?php echo empty($_POST['color_1']) ? $config['coef_taxe'] : set_value('coef_taxe'); ?>">
                                                                            <span class="input-group-addon">%</span>
                                                                        </div>
                                                                        <p><?php echo lang('store_admin_l89'); ?></p>
                                                                    </div>
                                                                </div>
                                                                <!--MAP CONFIGURATION-->
                                                                <div class="col-xs-12 mt-30">
                                                                    <hr />
                                                                    <h5 class="text-center"><?php echo lang('store_admin_map_config'); ?></h5>
                                                                    <hr />
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <div class="col-md-12 form-group">
                                                                        <label><?php echo lang('store_admin_map_latitude'); ?></label>
                                                                        <input type="text" class="form-control" required="required" name="map_latitude" id="map_latitude" data-validation="required" value="<?php echo empty($_POST['color_1']) ? $config['map_latitude'] : set_value('map_latitude'); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <div class="col-md-12 form-group">
                                                                        <label><?php echo lang('store_admin_map_longitude'); ?></label>
                                                                        <input type="text" class="form-control" required="required" name="map_longitude" id="map_longitude" data-validation="required" value="<?php echo empty($_POST['color_1']) ? $config['map_longitude'] : set_value('map_longitude'); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 form-group">
                                                                    <div class="col-md-12 form-group">
                                                                        <label><?php echo lang('store_admin_map_zoom'); ?></label>
                                                                        <select name='map_zoom' id='map_zoom' class='form-control input-lg search-select'>
                                                                            <?php for ($i = 19; $i > 0; $i--) : ?>
                                                                                <option value='<?php echo $i; ?>' <?php echo empty($_POST['color_1']) ? ($config['map_zoom'] == $i ? 'selected' : '') : (set_value('map_zoom') == $i ? 'selected' : ''); ?>><?php echo $i; ?></option>
                                                                            <?php endfor; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="text-right">
                                                                    <button class="btn"><?php echo lang('validate') ?></button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <!-- ADMIN MEDIAS -->
                                                        <div role="tabpanel" class="tab-pane ptb-20 <?php echo isset($_GET['sub_tab']) && $_GET['sub_tab'] == 'admin_medias' ? 'active' : '' ?>" id="admin_medias">
                                                            <h3 class="text-center"><?php echo lang('store_admin_l90'); ?></h3>
                                                            <p class="text-center"><?php echo lang('store_admin_l91'); ?></p>
                                                            <div action="" class="dropzone" id="addPicsCategories"></div>
                                                        </div>

                                                        <!-- ADMIN CATEGORIES -->
                                                        <div role="tabpanel" class="tab-pane ptb-20 <?php echo isset($_GET['sub_tab']) && $_GET['sub_tab'] == 'admin_categories' ? 'active' : '' ?>" id="admin_categories">
                                                            <h3 class="text-center"><?php echo lang('store_admin_l92'); ?></h3>
                                                            <p class="text-center"><?php echo lang('store_admin_l93'); ?></p>
                                                            <!--Add/delete-->
                                                            <div class="col-md-12 mb-30">
                                                                <div class="col-md-6">
                                                                    <a href="#" data-toggle="modal" data-target="#add-category" class="btn btn-info mb-10"><i class="fa fa-plus"></i> <?php echo lang('store_admin_l94'); ?></a>
                                                                    <br />
                                                                    <a href="#" data-toggle="modal" data-target="#delete-category" class="btn btn-danger btn-xs"><i class="fa fa-minus"></i> <?php echo lang('store_admin_l95'); ?></a>
                                                                </div>
                                                                <div class="col-md-6 text-right">
                                                                    <a href="#" data-toggle="modal" data-target="#add-subcategory" class="btn btn-info mb-10"><i class="fa fa-plus"></i> <?php echo lang('store_admin_l96'); ?></a><br /><a href="#" data-toggle="modal" data-target="#delete-subcategory" class="btn btn-danger btn-xs"><i class="fa fa-minus"></i> <?php echo lang('store_admin_l97'); ?></a>
                                                                </div>
                                                            </div>
                                                            <!--Listing-->
                                                            <div class="col-md-12">
                                                                <div id="categoriesList"></div>
                                                            </div>
                                                        </div>

                                                        <!-- ADMIN STORES -->
                                                        <div role="tabpanel" class="tab-pane ptb-20 <?php echo isset($_GET['sub_tab']) && $_GET['sub_tab'] == 'admin_stores' ? 'active' : '' ?>" id="admin_stores">
                                                            <h3 class="text-center"><?php echo lang('store_admin_l98'); ?></h3>
                                                            <p class="text-center"><?php echo lang('store_admin_l99'); ?></p>
                                                            <div class="text-center">
                                                                <a href="<?php echo base_url('deals/add_pro') ?>" class="btn" target="_blank"><i class="fa fa-plus"></i> <?php echo lang('store_admin_l100'); ?></a>
                                                            </div>
                                                            <!-- STORES -->
                                                            <?php if ($all_pros) : ?>
                                                                <?php foreach ($all_pros as $boutique) : ?>
                                                                    <div class="review-single pt-30">
                                                                        <!--Update V1.1.0-->
                                                                        <input type='hidden' id='store_company_<?php echo $boutique->id; ?>' value='<?php echo $boutique->company; ?>' />
                                                                        <input type='hidden' id='store_name_dealer_<?php echo $boutique->id; ?>' value='<?php echo $boutique->firstname . ' ' . $boutique->lastname; ?>' />
                                                                        <input type='hidden' id='store_address_<?php echo $boutique->id; ?>' value='<?php echo $boutique->address; ?>' />
                                                                        <input type='hidden' id='store_zipcode_<?php echo $boutique->id; ?>' value='<?php echo $boutique->zipcode; ?>' />
                                                                        <input type='hidden' id='store_city_<?php echo $boutique->id; ?>' value='<?php echo $boutique->city; ?>' />
                                                                        <input type='hidden' id='store_phone_<?php echo $boutique->id; ?>' value='<?php echo $boutique->phone; ?>' />
                                                                        <input type='hidden' id='store_email_<?php echo $boutique->id; ?>' value='<?php echo $boutique->email; ?>' />
                                                                        <input type='hidden' id='store_informations_<?php echo $boutique->id; ?>' value='<?php echo $boutique->informations; ?>' />
                                                                        <input type='hidden' id='store_bank_company_<?php echo $boutique->id; ?>' value='<?php echo $boutique->bank_company; ?>' />
                                                                        <input type='hidden' id='store_bank_name_<?php echo $boutique->id; ?>' value='<?php echo $boutique->bank_name; ?>' />
                                                                        <input type='hidden' id='store_bank_address_<?php echo $boutique->id; ?>' value='<?php echo $boutique->bank_address; ?>' />
                                                                        <input type='hidden' id='store_bank_iban_<?php echo $boutique->id; ?>' value='<?php echo $boutique->bank_iban; ?>' />
                                                                        <input type='hidden' id='store_bank_bic_<?php echo $boutique->id; ?>' value='<?php echo $boutique->bank_bic; ?>' />
                                                                        <input type='hidden' id='store_paypal_email_<?php echo $boutique->id; ?>' value='<?php echo $boutique->paypal_account; ?>' />
                                                                        <!--End Update V1.1.0-->
                                                                        <div class="media">
                                                                            <div class="media-left">
                                                                                <a href="<?php echo base_url('boutique/' . strtolower(url_title($boutique->company) . '/' . $boutique->id)) ?>" target="_blank">
                                                                                    <img class="media-object mr-10 radius-4" src="<?php echo base_url('assets/images/brands/' . (!empty($boutique->logo) ? $boutique->logo : 'boutique.png')) ?>" width="90" alt="">
                                                                                </a>
                                                                            </div>
                                                                            <div class="media-body">
                                                                                <div class="review-wrapper clearfix">
                                                                                    <ul class="list-inline">
                                                                                        <li>
                                                                                            <a href="<?php echo base_url('boutique/' . strtolower(url_title($boutique->company) . '/' . $boutique->id)) ?>" target="_blank">
                                                                                                <span class="review-holder-name h5"><?php echo $boutique->company; ?></span>
                                                                                            </a>
                                                                                        </li>
                                                                                    </ul>
                                                                                    <p class="copy"><?php echo $boutique->informations != lang('store_pro_l134') ? $boutique->informations : ''; ?></p>
                                                                                    <div class="text-center mb-10"> 
                                                                                        <a href="<?php echo base_url('deals/add?pro=' . $boutique->id) ?>" class="btn btn-xs btn-info" target="_blank"><i class="fa fa-plus"></i> <?php echo lang('store_admin_l101'); ?></a>
                                                                                        <!--Update V1.1.0-->
                                                                                        <a href="#" company_id='<?php echo $boutique->id; ?>' class="btn btn-xs btn-facebook companyDatas" data-toggle="modal" data-target="#storeInformations"><i class="fa fa-eye"></i> <?php echo lang('store_admin_popup_store'); ?></a>
                                                                                        <!--End Update V1.1.0-->
                                                                                        <form method="post">
                                                                                            <input type="hidden" name="admin_show" value="<?php echo $boutique->id; ?>" />
                                                                                            <button type="submit" class="btn btn-xs mt-10"><i class="fa fa-key"></i> <?php echo lang('store_admin_l102'); ?></button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class='text-right'>
                                                                            <a href='<?php echo base_url('admin/deleteStore/' . $boutique->id) ?>' onclick='if (!confirm("<?php echo lang('store_admin_delete_store_confirm') ?>")) {
                                                                                                return false;
                                                                                            }'><i class='fa fa-close'></i> <?php echo lang('store_admin_delete_store') ?></a>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </div>

                                                        <!-- ADMIN CMS -->
                                                        <div role="tabpanel" class="tab-pane ptb-20 <?php echo isset($_GET['sub_tab']) && $_GET['sub_tab'] == 'admin_CMS' ? 'active' : '' ?>" id="admin_CMS">
                                                            <h3 class="text-center"><?php echo lang('store_admin_l103'); ?></h3>
                                                            <p class="text-center"><?php echo lang('store_admin_l104'); ?></p>
                                                            <form method="post" action="<?php echo base_url('store/pro?notif=action_ok&tab=admin&sub_tab=admin_CMS') ?>">
                                                                <div class='col-xs-12'>
                                                                    <select class="form-control" name="page" id="cms_page">
                                                                        <option value="home+concept">Home > concept</option>
                                                                        <option value="home+invest">Home > invest</option>
                                                                        <option value="home+legal">Home > legal</option>
                                                                        <option value="home+notice">Home > notice</option>
                                                                        <option value="deals+add">Deals > add</option>
                                                                        <option value="store+legal">Store > legal</option>
                                                                    </select>
                                                                </div>
                                                                <div class='col-xs-12 mt-30'>
                                                                    <textarea name="content_cms" id="content_cms" cols="20"></textarea>
                                                                </div>
                                                                <div class='col-xs-12 mt-30 text-right'>
                                                                    <button type="submit" class="btn"><?php echo lang('save') ?></button>
                                                                </div>
                                                            </form>
                                                        </div>
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


<!--MODALS-->
<!--Add Category-->
<div id="add-category"  class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo lang('store_admin_l105'); ?></h4>
            </div>
            <div class="modal-footer text-center" style="text-align: center">
                <form method="post" action="<?php echo base_url('admin/addCategory') ?>">
                    <div class="form-group">
                        <input type="text" class="form-control requitred" name="name" placeholder="<?php echo lang('store_admin_l106'); ?>" required />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control required" name="icon" placeholder="<?php echo lang('store_admin_l107'); ?>" required />
                        <p class='text-right'>
                            <a href="http://fontawesome.io/icons/" target="_blank"><?php echo lang('store_admin_l108'); ?></a>
                        </p>
                    </div>
                    <div class="form-group">
                        <a href="#" class="btn btn-facebook" data-toggle="modal" data-target="#chooseCover"><i class="fa fa-photo"></i> <?php echo lang('store_admin_l109'); ?></a>
                    </div>
                    <input type="hidden" class="form-control coverInput" name="image" />
                    <button class="btn" type="submit"><?php echo lang('validate'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Add SubCategory-->
<div id="add-subcategory"  class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo lang('store_admin_l110'); ?></h4>
            </div>
            <div class="modal-footer text-center" style="text-align: center">
                <form method="post" action="<?php echo base_url('admin/addSubCategory') ?>">
                    <div class="form-group">
                        <select name="category_id" class="form-control">
                            <option value=""><?php echo lang('store_admin_l111'); ?></option>
                            <?php if ($categories) : ?>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control requitred" name="name" placeholder="<?php echo lang('store_admin_l112'); ?>" required />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control required" name="icon" placeholder="<?php echo lang('store_admin_l113'); ?>" required />
                        <p class='text-right'>
                            <a href="http://fontawesome.io/icons/" target="_blank"><?php echo lang('store_admin_l114'); ?></a>
                        </p>
                    </div>
                    <div class="form-group">
                        <a href="#" class="btn btn-facebook" data-toggle="modal" data-target="#chooseCover"><i class="fa fa-photo"></i> <?php echo lang('store_admin_l115'); ?></a>
                    </div>
                    <input type="hidden" class="form-control coverInput" name="image" />
                    <button class="btn" type="submit"><?php echo lang('validate') ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Delete Category-->
<div id="delete-category"  class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo lang('store_admin_l116'); ?></h4>
            </div>
            <div class="modal-footer text-center" style="text-align: center">
                <form method="post" action="<?php echo base_url('admin/deleteCategory') ?>">
                    <div class="form-group">
                        <select name="category_id" class="form-control">
                            <option value=""><?php echo lang('store_admin_l117'); ?></option>
                            <?php if ($categories) : ?>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <button class="btn btn-danger" type="submit" onclick="if (!confirm('<?php echo lang('store_admin_l118'); ?>')) {
                                return false;
                            }"><?php echo lang('store_admin_l119'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Delete SubCategory-->
<div id="delete-subcategory"  class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo lang('store_admin_l120'); ?></h4>
            </div>
            <div class="modal-footer text-center" style="text-align: center">
                <form method="post" action="<?php echo base_url('admin/deleteSubCategory') ?>">
                    <div class="form-group">
                        <select name="sub_category_id" class="form-control">
                            <option value=""><?php echo lang('store_admin_l121'); ?></option>
                            <?php if ($sub_categories) : ?>
                                <?php foreach ($sub_categories as $sub_category) : ?>
                                    <option value="<?php echo $sub_category->id; ?>"><?php echo $sub_category->name; ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <button class="btn btn-danger" type="submit" onclick="if (!confirm('<?php echo lang('store_admin_l122'); ?>')) {
                                return false;
                            }"><?php echo lang('store_admin_l123'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Cover-->
<div id="chooseCover" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo lang('store_admin_l124'); ?></h4>
            </div>
            <div class="modal-body covers">
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<!--Update V1.1.0-->
<!--Admin store Infos-->
<div id="storeInformations" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo lang('store_admin_popup_store'); ?></h4>
            </div>
            <div class="modal-body storeInfo">
                <div class="review-single pt-30">
                    <div class="row row-tb-30">
                        <div class="col-xs-12">
                            <div class="col-md-6 form-group">
                                <label><?php echo lang('store_pro_l131'); ?></label>
                                <div class="input-group text-info" id='store_company'></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label><?php echo lang('store_pro_l132'); ?></label>
                                <div class="input-group text-info" id='store_name_dealer'></div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label><?php echo lang('store_pro_l133'); ?></label>
                                <div class="input-group text-info" id='store_address'></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label><?php echo lang('zipcode') ?></label>
                                <div class="input-group text-info" id='store_zipcode'></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label><?php echo lang('city') ?></label>
                                <div class="input-group text-info" id='store_city'></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label><?php echo lang('phone') ?></label>
                                <div class="input-group text-info" id='store_phone'></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label><?php echo lang('email') ?></label>
                                <div class="input-group text-info" id='store_email'></div>
                            </div>
                            <div class="col-md-12 form-group">
                                <label><?php echo lang('store_pro_l134'); ?></label>
                                <div class="input-group text-info" id='store_informations'></div>
                            </div>
                            <hr />
                            <label><?php echo lang('store_pro_bank_informations') ?></label>
                            <hr />
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label><?php echo lang('store_pro_bank_company') ?></label>
                                    <div class="input-group text-info" id='store_bank_company'></div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label><?php echo lang('store_pro_bank_name') ?></label>
                                    <div class="input-group text-info" id='store_bank_name'></div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label><?php echo lang('store_pro_bank_address') ?></label>
                                    <div class="input-group text-info" id='store_bank_address'></div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label><?php echo lang('store_pro_bank_iban') ?></label>
                                    <div class="input-group text-info" id='store_bank_iban'></div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label><?php echo lang('store_pro_bank_bic') ?></label>
                                    <div class="input-group text-info" id='store_bank_bic'></div>
                                </div>
                            </div>
                            <hr />
                            <label><?php echo lang('store_pro_paypal_account') ?></label>
                            <hr />
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label><?php echo lang('store_pro_paypal_email') ?></label>
                                    <div class="input-group text-info" id='store_paypal_email'></div>
                                </div>
                            </div>
                            <hr />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<!--End Update V1.1.0-->