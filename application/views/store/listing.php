<main id="mainContent" class="main-content">
    <!-- Page Container -->
    <div class="page-container pb-60 pt-40">
        <div class="container">
            <section class="stores-area stores-area-v1">
                <h1 class="mb-20 t-uppercase mt-0 text-center"><?php echo lang('store_listing_l1') ?></h1>
                <h4 class='text-center'><?php echo lang('store_listing_l2') ?></h4>
                <p class='text-center'>
                    <a href='#' class='btn btn-xs btn-info mt-5' id='show_stores'><i class='fa fa-building'></i> <?php echo lang('store_listing_l3') ?></a> <a href='#' class='btn btn-xs mt-5' id='show_deals'><i class='fa fa-tags'></i> <?php echo lang('store_listing_l4') ?></a>
                </p>
                <div class="text-center custom-checkbox mt-10">
                    <input type="checkbox" id="geoloc" value="1">
                    <label class="color-mid"><?php echo lang('store_listing_l5') ?></label>
                </div>
                <div class="text-center custom-checkbox mt-10" id="selectCategories">
                    <?php $categories = $this->categories->getAll(); ?>
                    <?php if ($categories) : ?>
                        <?php $compt = 0; ?>
                        <?php foreach ($categories as $category) : ?>
                            <span data-toggle="tooltip" title="<?php echo $category->name; ?>">
                                <input type="checkbox" checked value="<?php echo $category->id; ?>" class="change_category" /> <label class="color-mid pl-10"><i class="<?php echo $category->icon; ?>"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label> 
                            </span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="row row-rl-15 row-tb-15 t-center">
                    <div class="col-xs-12">
                        <div class="">
                            <div id="store-map" class="map" data-latitude="<?php echo $this->config->item('admin')['map_latitude']; ?>" data-longitude="<?php echo $this->config->item('admin')['map_longitude']; ?>" data-zoom="<?php echo $this->config->item('admin')['map_zoom']; ?>" style='width: 100%;height: 600px'></div>
                            <div id="deals-map" class="map" data-latitude="<?php echo $this->config->item('admin')['map_latitude']; ?>" data-longitude="<?php echo $this->config->item('admin')['map_longitude']; ?>" data-zoom="<?php echo $this->config->item('admin')['map_zoom']; ?>" style='width: 100%;height: 600px'></div>
                        </div>
                    </div>
                    <div class='col-md-12 text-center mt-20'>
                        <a href='<?php echo base_url('deals/add') ?>' class='btn' id='storeListing'><i class='fa fa-plus'></i> <?php echo lang('store_listing_l6') ?></a>
                    </div>
                    <?php if ($prosPagined) : ?>
                        <?php foreach ($prosPagined as $pro) : ?>
                            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2" style="height: 185px">
                                <a href="<?php echo base_url('boutique/' . strtolower(url_title($pro->company) . '/' . $pro->id)) ?>" class="panel is-block">
                                    <div class="embed-responsive embed-responsive-4by3">
                                        <div class="store-logo">
                                            <img src="<?php echo base_url('assets/images/brands/' . (!empty($pro->logo) ? $pro->logo : 'boutique.png')); ?>" alt="">
                                        </div>
                                    </div>
                                    <h6 class="store-name ptb-10"><?php echo $pro->company; ?></h6>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Page Pagination -->
                <div class="page-pagination text-center mt-30 p-10 panel">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
                <div class='col-md-12 text-center mt-20'>
                    <a href='<?php echo base_url('deals/add') ?>' class='btn'><i class='fa fa-plus'></i> <?php echo lang('store_listing_l6') ?></a>
                </div>
                <!--<div class="page-pagination text-center mt-30 p-10 panel">
                   
                </div>-->
            </section>
        </div>
    </div>
    <!-- End Page Container -->
</main>
<!--MODALS-->
<div id="acceptGeoloc" class="modal fade mt-40" role="dialog">
    <div class="modal-dialog mt-40">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body covers">
                <div class="alert alert-info mt40">
                    <h3><i class="fa fa-arrow-up"></i> <?php echo lang('store_listing_l7') ?> <i class="fa fa-arrow-up"></i></h3>
                    <p><?php echo lang('store_listing_l8') ?></p>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<div id="wait" class="modal fade mt-40" role="dialog">
    <div class="modal-dialog mt-40">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class='modal-title'><i class="fa fa-clock-o"></i> <?php echo lang('store_listing_l9') ?></h4>
            </div>
            <div class="modal-body covers">
                <div class="alert alert-warning mt40">
                    <h3><i class="fa fa-clock-o"></i> <?php echo lang('store_listing_l10') ?></h3>
                    <p><?php echo lang('store_listing_l11') ?></p>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<!--POUR JS-->
<?php if ($pros) : ?>
    <?php foreach ($pros as $pro) : ?>
        <input type='hidden' class="store-localization" data-category="<?php echo $pro->users_pro_categories_id; ?>" data-image="<?php echo base_url('assets/images/brands/' . (!empty($pro->logo) ? $pro->logo : 'boutique.png')); ?>"  data-title="<?php echo $pro->company; ?>" data-category="<?php echo $pro->users_pro_categories_id; ?>" data-address="<?php echo $pro->address . ', ' . $pro->zipcode . ' ' . $pro->city; ?>" data-link="<?php echo base_url('boutique/' . strtolower(url_title($pro->company) . '/' . $pro->id)) ?>" data-latitude="<?php echo $pro->latitude; ?>" data-longitude="<?php echo $pro->longitude; ?>" />
    <?php endforeach; ?>
<?php endif; ?>
<?php if ($deals) : ?>
    <?php foreach ($deals as $deal) : ?>
        <input type='hidden' class="deals-localization" data-category="<?php echo $deal->categories_id; ?>" data-company="<?php echo $deal->company; ?>" data-image="<?php echo $deal->cover ? base_url('assets/images/' . $deal->cover) : base_url(isset($this->config->item('admin')['logo']) ? 'assets/uploads/logo.png' : 'assets/images/logo.png'); ?>" data-title="<?php echo $deal->title; ?> (<?php echo $deal->price_promo > 0 ? priceToShow($deal->price_promo) : ($deal->price_base > 0 ? priceToShow($deal->price_base) : ($deal->promo_discount > 0 ? '-'.$deal->promo_discount.'%': ($deal->price_type == 'quotation' ? 'Sur devis' : 'GRATUIT'))); ?>)" data-address="<?php echo $deal->address . ', ' . $deal->zipcode . ' ' . $deal->city; ?>" data-link-company="<?php echo base_url('boutique/' . strtolower(url_title($deal->company) . '/' . $deal->pro_id)) ?>" data-link="<?php echo routeDeal($deal->deal_id, strtolower(url_title($deal->title))); ?>" data-latitude="<?php echo $deal->latitude; ?>" data-longitude="<?php echo $deal->longitude; ?>" />
    <?php endforeach; ?>
<?php endif; ?>