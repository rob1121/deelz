<main id="mainContent" class="main-content">
    <div class="page-container ptb-10">
        <div class="container">
            <section class="section deals-area ptb-30">
                <!-- Page Control -->
                <header class="page-control panel ptb-15 prl-20 pos-r mb-30">
                    <h1><i class='<?php echo $category->icon; ?>'></i> <?php echo $this->lang->line('list_deal_l1'); ?> <?php echo $category->name; ?> <?php echo $this->lang->line('list_deal_l2'); ?></h1>
                 
                    <!--<div class="right-10 pos-tb-center hidden-xs hidden-sm">
                        <select class="form-control input-sm">
                            <option>Trier par</option>
                            <option>Nouveaux</option>
                            <option>Les plus regardés</option>
                            <option>Moins cher au plus cher</option>
                            <option>Plus cher au moins cher</option>
                        </select>
                    </div>-->
                </header>
                <!-- End Page Control -->
                <div class="row row-masnory row-tb-20">
                    <?php if ($deals) : ?>
                        <?php foreach ($deals as $deal) : ?>
                            <div class="col-sm-6 col-lg-4">
                                <div class="deal-single panel">
                                    <figure class="deal-thumbnail embed-responsive embed-responsive-16by9" data-bg-img="<?php echo base_url('assets/images/'.$deal->cover)?>">
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
                                            <a title="<?php echo $deal->company; ?>" data-toggle="tooltip" href="<?php echo base_url('boutique/'.strtolower(url_title($deal->company).'/'.$deal->pro_id)) ?>"><img src="<?php echo base_url('assets/images/brands/' . (!empty($deal->logo) ? $deal->logo : 'boutique.png')); ?>" alt=""></a>
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
                                            <p class="text-muted mb-20"><a href="<?php echo routeDeal($deal->deal_id, $deal->title) ?>"><?php echo substr($deal->excerpt, 0, 85); ?></a></p>
                                        </div>
                                        <div class="deal-price pos-r mb-15">
                                            <h3 class="price ptb-5 text-right"><span class="price-sale"><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_base) : ''; ?></span><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_promo) : ($deal->price_base > 0 ? priceToShow($deal->price_base) : ($deal->promo_discount > 0 ? '-'.$deal->promo_discount.'%': ($deal->price_type == 'quotation' ? $this->lang->line('on_quotation') : strtoupper($this->lang->line('free'))))); ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                    <div class="col-md-12">
                        <div class="alert alert-info text-center"><?php echo $this->lang->line('list_deal_l3'); ?></div> 
                    </div>
                    <?php endif; ?>
                </div>


                <!-- Page Pagination -->
                <div class="page-pagination text-center mt-30 p-10 panel">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
                <!-- End Page Pagination -->

            </section>

        </div>
    </div>


</main>