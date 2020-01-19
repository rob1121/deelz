<?php
$is_favorite = $this->users_favorites->isFavorite($deal->deal_id);
?>
<main id="mainContent" class="main-content">
    <!-- Page Container -->
    <div class="page-container">
        <div class="container">
            <div class="row row-rl-10 row-tb-20">
                <div class="page-content col-xs-12">

                    <div class="row row-tb-20">
                        <div class="brand col-xs-12 t-xs-center mt-0 pb-0">
                            <div class="widget single-deal-widget panel pt-10 prl-20">
                                <img src="<?php echo base_url(isset($this->config->item('admin')['logo']) ? 'assets/uploads/logo.png' : 'assets/images/logo.png'); ?>" alt="" width="250">
                            </div>
                        </div>
                        <div class="col-xs-12 pt-0">
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
                                            <div class="label-discount">-<?php echo $deal->promo_discount; ?>%</div>
                                            <h2 class="price"><span class="price-sale"><?php echo priceToShow($deal->price_base) ?></span> <?php echo priceToShow($deal->price_promo) ?></h2>
                                        <?php else : ?>
                                            <h2 class="price"><?php echo priceToShow($deal->price_base) ?></h2>
                                        <?php endif; ?>
                                    </div>
                                    <h2 class="text-center">
                                        <small><?php echo lang('users_print_promo_l1'); ?> : <?php echo date('d/m/Y'); ?></small>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="deal-deatails panel">
                                <div class="deal-slider col-xs-4">
                                    <div id="product_slider" class="flexslider">
                                        <ul class="slides">
                                            <li>
                                                <img alt="" src="<?php echo base_url('assets/images/' . $deal->cover) ?>">
                                            </li>
                                        </ul>
                                        <span><?php echo lang('users_print_promo_l2'); ?></span>
                                    </div>
                                    <h3 class="mb-10"><?php echo substr($deal->excerpt, 0, 85); ?></h3>
                                </div>
                                <div class="deal-body p-20  col-xs-8">
                                    
                                    <p class="mb-15"><?php echo $deal->content; ?></p>
                                    <h3 class='text-center mb-20 mt-30'><?php echo lang('users_print_promo_l3'); ?></h3>
                                    <p>
                                        <?php echo getTarget($deal->target); ?>
                                    </p>
                                    <h3 class='text-center mb-20 mt-30'><?php echo lang('users_print_promo_l4'); ?></h3>
                                    <p>
                                        <strong><?php echo lang('users_print_promo_l5'); ?> : </strong> <?php echo getValidity($deal->validity, $deal->date_valid); ?><br />
                                        <strong><?php echo lang('users_print_promo_l6'); ?> : </strong> <?php echo getAppointement($deal->use); ?><br />
                                        <strong><?php echo lang('users_print_promo_l7'); ?> :</strong> <?php echo lang('users_print_promo_l8'); ?><br />
                                        <?php if ($deal->type_deal != 'bon-plan') : ?>
                                            <strong><?php echo lang('users_print_promo_l9'); ?> :</strong> <?php echo lang('users_print_promo_l10'); ?>
                                        <?php endif; ?>
                                    </p>
                                    <h3 class='text-center mb-20 mt-30'><?php echo lang('users_print_promo_l11'); ?></h3>
                                    <p>
                                        <strong><?php echo lang('phone'); ?> :</strong> <?php echo $deal->phone; ?><br />
                                        <strong><?php echo lang('email'); ?> :</strong> <a href='<?php echo base_url('boutique/' . strtolower(url_title($deal->company) . '/' . $deal->users_pro_id)) ?>'><?php echo lang('users_print_promo_l12'); ?></a>
                                    </p> 
                                </div>
                            </div>

                            <div class='col-xs-12 text-center mt-20 mb-30'>
                                <a href='#' onclick='window.print();' class='btn btn-xs'><i class='fa fa-print'></i> <?php echo lang('users_print_promo_l13'); ?></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Container -->


</main>