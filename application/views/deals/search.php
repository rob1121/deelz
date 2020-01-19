<main id="mainContent" class="main-content">
    <div class="page-container ptb-60">
        <div class="container">
            <div class="row row-rl-10 row-tb-20">
                <div class="page-content col-xs-12 col-md-12">
                    <section class="section deals-area">
                        <!-- Page Control -->
                        <header class="page-control panel ptb-15 prl-20 pos-r mb-30">
                            <strong><?php echo $this->lang->line('search_title'); ?></strong> <?php echo (empty($_GET['search']) ? (isset($_GET['type']) && $this->input->get('type') == 'pass' ? $this->lang->line('search_title_l1') : $this->lang->line('search_title_l2')) : '"' . $this->input->get('search') . '"') . ' <i class="fa fa-arrow-right"></i> ' . ($this->input->get('city') == '0' ? $this->lang->line('search_title_l3') : $this->input->get('city')); ?>
                        </header>
                        <!-- End Page Control -->
                        <div class="row row-tb-20">
                            <?php if ($deals) : ?>
                                <?php foreach ($deals as $deal) : ?>
                                    <div class="col-xs-12">
                                        <div class="deal-single panel">
                                            <div class="row row-rl-0 row-sm-cell">
                                                <div class="col-sm-3">
                                                    <figure class="deal-thumbnail embed-responsive embed-responsive-16by9 col-absolute-cell" data-bg-img="<?php echo base_url('assets/images/' . $deal->cover) ?>">
                                                        <div class='hover-img-link' onclick='window.location.href = "<?php echo routeDeal($deal->deal_id, $deal->title); ?>"'></div>
                                                        <div class='hover-img-link-left' onclick='window.location.href = "<?php echo routeDeal($deal->deal_id, $deal->title); ?>"'></div>
                                                        <?php if ($deal->promo_discount > 0) : ?>
                                                            <div class="label-discount left-20 top-15">-<?php echo $deal->promo_discount; ?>%</div>
                                                        <?php endif; ?>
                                                        <?php $this->load->view('deals/partial/actions', array('deal_id' => $deal->deal_id, 'deal_link' => routeDeal($deal->deal_id, $deal->title))); ?>
                                                        <div class="time-left bottom-15 right-20 font-md-14 is-hidden-md-up is-hidden-md-down">
                                                            <span>
                                                                <i class="ico fa fa-clock-o mr-10"></i>
                                                                <span class="t-uppercase" data-countdown="<?php echo dateBDD_to_FR($deal->end, 3, false, true, true) ?>"></span>
                                                            </span>
                                                        </div>
                                                    </figure>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="bg-white pt-20 pl-20 pr-15">
                                                        <div class="pr-md-10">
                                                            <div class="deal-store-logo">
                                                                <a title="<?php echo $deal->company; ?>" data-toggle="tooltip" href="<?php echo base_url('boutique/' . strtolower(url_title($deal->company) . '/' . $deal->pro_id)) ?>"><img src="<?php echo base_url('assets/images/brands/' . (!empty($deal->logo) ? $deal->logo : 'boutique.png')); ?>" alt=""></a>
                                                            </div>
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
                                                            <h3 class="price ptb-5 text-right"><span class="price-sale"><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_base) : ''; ?></span><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_promo) : ($deal->price_base > 0 ? priceToShow($deal->price_base) : ($deal->price_type == 'quotation' ? $this->lang->line('on_quotation') : ($deal->promo_discount > 0 ? '-' . $deal->promo_discount . '%' : $this->lang->line('free')))); ?></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class='col-md-12'>
                                    <div class="alert alert-info text-center"><h3><i class="fa fa-exclamation-triangle"></i> <?php echo $this->lang->line('search_not_found'); ?></h3></div>
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
        </div>
    </div>
</main>