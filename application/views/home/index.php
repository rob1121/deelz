<main id="mainContent" class="main-content">
    <div class="page-container ptb-10">
        <div class="container">
            <div class="section deals-header-area ptb-30">
                <div class="row row-tb-20">
                    <!--CATEGORIES-->
                    <div class="col-xs-12 col-md-4 col-lg-3 hidden-xs hidden-sm">
                        <aside>
                            <?php $this->load->view('partial/categories', array('class' => 'nav-coupon-category panel', 'show_icons' => true, 'show_count' => false)); ?>
                            <a href='<?php echo base_url('deals/search?search=&city=0') ?>' class='btn btn-xs mt-10 btn-block'><i class='fa fa-list'></i> <?php echo $this->lang->line('all_deals'); ?></a>
                        </aside>
                    </div>

                    <!--SLIDER-->
                    <div class="col-xs-12 col-md-8 col-lg-9">
                        <div class="header-deals-slider owl-slider" data-loop="true" data-autoplay="true" data-autoplay-timeout="10000" data-smart-speed="1000" data-nav-speed="false" data-nav="true" data-xxs-items="1" data-xxs-nav="true" data-xs-items="1" data-xs-nav="true" data-sm-items="1" data-sm-nav="true" data-md-items="1" data-md-nav="true" data-lg-items="1" data-lg-nav="true">
                            <?php if ($deals_slider) : ?>
                                <?php foreach ($deals_slider as $deal) : ?>
                                    <div class="deal-single panel item">
                                        <figure class="deal-thumbnail embed-responsive embed-responsive-16by9 cursor-pointer" data-bg-img="<?php echo base_url('assets/images/' . $deal->cover); ?>">
                                            <div class='hover-img-link' onclick='window.location.href = "<?php echo routeDeal($deal->deal_id, $deal->title); ?>"'></div>
                                            <div class='hover-img-link-right' onclick='window.location.href = "<?php echo routeDeal($deal->deal_id, $deal->title); ?>"'></div>
                                            <?php if ($deal->promo_discount > 0) : ?>
                                                <div class="label-discount top-10 right-10">-<?php echo $deal->promo_discount; ?>%</div>
                                            <?php endif; ?>
                                            <?php $this->load->view('deals/partial/actions', array('deal_id' => $deal->deal_id, 'position' => 'left-20', 'deal_link' => routeDeal($deal->deal_id, $deal->title))); ?>
                                            <h3 class='deal-title mt-10 color-white text-center'><i class="ico fa <?php echo getDealTypeIcon($deal->type_deal); ?> mr-10"></i><?php echo getDealType($deal->type_deal); ?></h3>
                                            <div class="deal-store-logo mb-30 hidden-xs">
                                                <a title="<?php echo $deal->company; ?>" data-toggle="tooltip" href="<?php echo base_url('boutique/' . strtolower(url_title($deal->company) . '/' . $deal->pro_id)) ?>"><img src="<?php echo base_url('assets/images/brands/' . (!empty($deal->logo) ? $deal->logo : 'boutique.png')); ?>" alt=""></a>
                                            </div>
                                            <div class="deal-about p-10 pos-a bottom-0 left-0">


                                                <div class="color-white mt-10">
                                                    <h3 class="deal-title">
                                                        <a href="<?php routeDeal($deal->id, $deal->title) ?>" class="color-light color-h-lighter"><?php echo $deal->title; ?> <!--<small class="color-white">- <i class='<?php echo getDealTypeIcon($deal->type_deal); ?> mr-5'></i></span><span class='deal-title'><?php echo getDealType($deal->type_deal); ?></small>--></a>
                                                        <span class='color-white ml-10'><span class="price-sale"><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_base) : ''; ?></span><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_promo) : ($deal->price_base > 0 ? priceToShow($deal->price_base) : ($deal->price_type == 'quotation' ? 'Sur devis' : 'GRATUIT')); ?></span>
                                                    </h3>
                                                    <span class='hidden-lg hidden-md hidden-sm'>
                                                        <i class="ico fa fa-clock-o mr-10"></i>
                                                        <span class="deal-title t-uppercase" data-countdown="<?php echo dateBDD_to_FR($deal->end, 3, false, true, true) ?>"></span>
                                                    </span>
                                                    <span class='deal-title'></span>
                                                </div> 
                                            </div>

                                            <div class="time-left bottom-15 right-20 font-md-14 hidden-xs">
                                                <span>
                                                    <i class="ico fa fa-clock-o mr-10"></i>
                                                    <span class="deal-title t-uppercase" data-countdown="<?php echo dateBDD_to_FR($deal->end, 3, false, true, true) ?>"></span>
                                                </span>
                                            </div>
                                        </figure>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4 col-lg-3 hidden-lg hidden-md">
                        <h1 class="hidden-xs"><?php echo $this->lang->line('home_line_1'); ?></h1>
                        <h3 class="hidden-lg hidden-md hidden-sm"><?php echo $this->lang->line('home_line_2'); ?></h3>
                        <aside class='mt-20'>
                            <?php $this->load->view('partial/categories', array('class' => 'nav-coupon-category panel', 'show_icons' => true, 'show_count' => false)); ?>
                        </aside>
                    </div>
                </div>
            </div>

            <!--VIDEO / IMAGE MODULE-->
            <section class="section latest-news-area blog-area blog-grid blog-3-col ptb-30">
                <header class="panel ptb-15 prl-20 pos-r mb-30">
                    <h3 class="section-title font-18"><?php echo $this->lang->line('more_infos'); ?></h3>
                </header>

                <div class="row row-tb-20">
                    <div class="blog-post col-xs-12 col-sm-6 col-md-4">
                        <article class="entry panel">
                            <figure class="entry-media embed-responsive embed-responsive-16by9">
                                <iframe src="<?php echo $this->lang->line('more_infos_video_1'); ?>" webkitallowfullscreen mozallowfullscreen allowfullscreen  style='border:none'></iframe>
                            </figure>
                            <div class="entry-wrapper pt-20 pb-10 prl-20">
                                <header class="entry-header">
                                    <h4 class="entry-title mb-10 mb-md-15 font-xs-16 font-sm-18 font-md-16 font-lg-16">
                                        <a href="<?php echo $this->lang->line('more_infos_link_1'); ?>"><?php echo $this->lang->line('more_infos_title_1'); ?></a>
                                    </h4>
                                </header>
                                <div class="entry-content">
                                    <p class="entry-summary"><?php echo $this->lang->line('more_infos_text_1'); ?></p>
                                </div>
                                <footer class="entry-footer text-right">
                                    <a href="<?php echo $this->lang->line('more_infos_link_1'); ?>" class="more-link btn btn-link"><?php echo $this->lang->line('more_infos_link_t_1'); ?></a>
                                </footer>
                            </div>
                        </article>
                    </div>
                    <div class="blog-post col-xs-12 col-sm-6 col-md-4">
                        <article class="entry panel">
                            <figure class="entry-media post-thumbnail embed-responsive embed-responsive-16by9" data-bg-img="<?php echo $this->lang->line('more_infos_image_2'); ?>">
                            </figure>
                            <div class="entry-wrapper pt-20 pb-10 prl-20">
                                <header class="entry-header">
                                    <h4 class="entry-title mb-10 mb-md-15 font-xs-16 font-sm-18 font-md-16 font-lg-16">
                                        <a href="<?php echo $this->lang->line('more_infos_link_2'); ?>"><?php echo $this->lang->line('more_infos_title_2'); ?></a>
                                    </h4>
                                </header>
                                <div class="entry-content">
                                    <p class="entry-summary"><?php echo $this->lang->line('more_infos_text_2'); ?></p>
                                </div>
                                <footer class="entry-footer text-right">
                                    <a href="<?php echo $this->lang->line('more_infos_link_2'); ?>" class="more-link btn btn-link"><?php echo $this->lang->line('more_infos_link_t_2'); ?></a>
                                </footer>
                            </div>
                        </article>
                    </div>
                    <div class="blog-post col-xs-12 col-sm-6 col-md-4">
                        <article class="entry panel">
                            <figure class="entry-media embed-responsive embed-responsive-16by9">
                                <iframe src="<?php echo $this->lang->line('more_infos_video_3'); ?>" webkitallowfullscreen mozallowfullscreen allowfullscreen  style='border:none'></iframe>
                            </figure>
                            <div class="entry-wrapper pt-20 pb-10 prl-20">
                                <header class="entry-header">
                                    <h4 class="entry-title mb-10 mb-md-15 font-xs-16 font-sm-18 font-md-16 font-lg-16">
                                        <a href="<?php echo $this->lang->line('more_infos_link_3'); ?>"><?php echo $this->lang->line('more_infos_title_3'); ?></a>
                                    </h4>
                                </header>
                                <div class="entry-content">
                                    <p class="entry-summary"><?php echo $this->lang->line('more_infos_text_3'); ?></p>
                                </div>
                                <footer class="entry-footer text-right">
                                    <a href="<?php echo $this->lang->line('more_infos_link_3'); ?>" class="more-link btn btn-link"><?php echo $this->lang->line('more_infos_link_t_3'); ?></a>
                                </footer>
                            </div>
                        </article>
                    </div>

                </div>
            </section>

            <!--A LA UNE MODULE-->
            <section class="section latest-deals-area ptb-30">
                <header class="panel ptb-15 prl-20 pos-r mb-30">
                    <h3 class="section-title font-18"><?php echo $this->lang->line('a_la_une'); ?></h3>
                </header>

                <div class="row row-masnory row-tb-20">
                    <?php if ($deals_top) : ?>
                        <?php foreach ($deals_top as $deal) : ?>
                            <div class="col-sm-6 col-lg-4">
                                <div class="deal-single panel">
                                    <figure class="deal-thumbnail embed-responsive embed-responsive-16by9" data-bg-img="<?php echo base_url('assets/images/' . $deal->cover); ?>">
                                        <div class='hover-img-link' onclick='window.location.href = "<?php echo routeDeal($deal->deal_id, $deal->title); ?>"'></div>
                                        <div class='hover-img-link-left' onclick='window.location.href = "<?php echo routeDeal($deal->deal_id, $deal->title); ?>"'></div>
                                        <?php if ($deal->promo_discount > 0) : ?>
                                            <div class="label-discount left-20 top-15"><?php echo '-' . $deal->promo_discount . '%'; ?></div>
                                        <?php endif; ?>
                                        <?php $this->load->view('deals/partial/actions', array('deal_id' => $deal->deal_id, 'position' => 'right-20', 'deal_link' => routeDeal($deal->deal_id, $deal->title))); ?>
                                        <div class="time-left bottom-15 right-20 font-md-14">
                                            <span>
                                                <i class="ico fa fa-clock-o mr-10"></i>
                                                <span class="t-uppercase" data-countdown="<?php echo dateBDD_to_FR($deal->end, 3, false, true, true) ?>"></span>
                                            </span>
                                        </div>
                                        <div class="deal-store-logo">
                                            <a title="<?php echo $deal->company; ?>" data-toggle="tooltip" href="<?php echo base_url('boutique/' . strtolower(url_title($deal->company) . '/' . $deal->pro_id)) ?>"><img src="<?php echo base_url('assets/images/brands/' . (!empty($deal->logo) ? $deal->logo : 'boutique.png')); ?>" alt=""></a>
                                        </div>
                                    </figure>
                                    <div class="bg-white pt-20 pl-20 pr-15">
                                        <div class="pr-md-10">
                                            <h3 class="deal-title mb-10">
                                                <a href="<?php echo routeDeal($deal->deal_id, $deal->title); ?>"><?php echo $deal->title; ?></a>
                                            </h3>
                                            <ul class="deal-meta list-inline mb-10 color-mid">
                                                <li><i class="ico fa fa-map-marker mr-10"></i><?php echo $deal->city; ?></li>
                                                <li><i class="ico fa <?php echo getDealTypeIcon($deal->type_deal); ?> mr-10"></i><?php echo getDealType($deal->type_deal); ?></li>
                                            </ul>
                                            <p class="text-muted mb-20"><?php echo $deal->excerpt; ?></p>
                                        </div>
                                        <div class="deal-price pos-r mb-15">
                                            <h3 class="price ptb-5 text-right"><span class="price-sale"><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_base) : ''; ?></span><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_promo) : ($deal->price_base > 0 ? priceToShow($deal->price_base) : ($deal->promo_discount > 0 ? '-' . $deal->promo_discount . '%' : ($deal->price_type == 'quotation' ? 'Sur devis' : 'GRATUIT'))); ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>

            <!--HOW IT WORKS MODULE-->
            <section class="section latest-coupons-area ptb-30">
                <header class="panel ptb-15 prl-20 pos-r mb-30">
                    <h3 class="section-title font-18"><?php echo $this->lang->line('explain_title'); ?></h3>
                </header>

                <div class="section explain-process-area pt-30">
                    <div class="row row-rl-10">
                        <div class="col-md-4">
                            <div class="item panel prl-15 ptb-20">
                                <div class="row row-rl-5 row-xs-cell">
                                    <div class="col-xs-4 valign-middle">
                                        <img class="pr-10" src="<?php echo base_url(); ?>assets/images/icons/tablet.png" alt="">
                                    </div>
                                    <div class="col-xs-8">
                                        <h5 class="mb-10 pt-5"><?php echo $this->lang->line('explain_title_1'); ?></h5>
                                        <p class="color-mid"><?php echo $this->lang->line('explain_text_1'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="item panel prl-15 ptb-20">
                                <div class="row row-rl-5 row-xs-cell">
                                    <div class="col-xs-4 valign-middle">
                                        <img class="pr-10" src="<?php echo base_url(); ?>assets/images/icons/online-shop-6.png" alt="">
                                    </div>
                                    <div class="col-xs-8">
                                        <h5 class="mb-10 pt-5"><?php echo $this->lang->line('explain_title_2'); ?></h5>
                                        <p class="color-mid"><?php echo $this->lang->line('explain_text_2'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="item panel prl-15 ptb-20">
                                <div class="row row-rl-5 row-xs-cell">
                                    <div class="col-xs-4 valign-middle">
                                        <img class="pr-10" src="<?php echo base_url(); ?>assets/images/icons/money.png" alt="">
                                    </div>
                                    <div class="col-xs-8">
                                        <h5 class="mb-10 pt-5"><?php echo $this->lang->line('explain_title_3'); ?></h5>
                                        <p class="color-mid"><?php echo $this->lang->line('explain_text_3'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-rl-10 text-center">
                        <a href='<?php echo base_url('comment-ca-marche') ?>' class='btn btn-lg btn-rounded mt-10'><i class='fa fa-info'></i> <?php echo $this->lang->line('how_it_works'); ?></a>
                    </div>
                </div>
            </section>


            <!--LAST DEALS MODULE-->
            <section class="section latest-coupons-area ptb-30">
                <header class="panel ptb-15 prl-20 pos-r mb-30">
                    <h3 class="section-title font-18"><?php echo $this->lang->line('last_deals'); ?></h3>
                    <a href="<?php echo base_url('deals/search?search=&city=0') ?>" class="btn btn-o btn-xs pos-a right-10 pos-tb-center"><?php echo $this->lang->line('last_deals'); ?></a>
                </header>

                <div class="latest-coupons-slider owl-slider" data-autoplay-hover-pause="true" data-loop="true" data-nav="true" data-autoplay="true" data-smart-speed="1000" data-autoplay-timeout="10000" data-margin="30" data-nav-speed="false" data-items="1" data-xxs-items="1" data-xs-items="2" data-sm-items="2" data-md-items="3" data-lg-items="4">
                    <?php if ($last_deals) : ?>
                        <?php foreach ($last_deals as $deal) : ?>
                            <div class="coupon-item">
                                <div class="coupon-single panel t-center">
                                    <?php if ($deal->hp_top == 1) : ?>
                                        <div class="ribbon-wrapper is-hidden-xs-down">
                                            <div class="ribbon">à la une !</div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="text-center p-20">
                                                <a href='<?php echo routeDeal($deal->deal_id, $deal->title); ?>'>
                                                    <img class="store-logo" src="<?php echo base_url('assets/images/' . $deal->cover); ?>" alt="">
                                                </a>
                                            </div>
                                            <!-- end media -->
                                        </div>
                                        <!-- end col -->

                                        <div class="col-xs-12">
                                            <div class="panel-body">
                                                <ul class="deal-meta list-inline mb-10">
                                                    <li class="color-green"><i class="ico <?php echo getDealTypeIcon($deal->type_deal); ?> mr-5"></i><?php echo getDealType($deal->type_deal, true); ?></li>
                                                    <li class="color-muted"><i class="ico fa fa-map-marker mr-5"></i><?php echo $deal->city; ?></li>
                                                </ul>
                                                <h4 class="color-green mb-10 t-uppercase"><span class="price-sale"><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_base) : ''; ?></span><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_promo) : ($deal->price_base > 0 ? priceToShow($deal->price_base) : ($deal->promo_discount > 0 ? '-' . $deal->promo_discount . '%' : ($deal->price_type == 'quotation' ? 'Sur devis' : 'GRATUIT'))); ?></h4>
                                                <h5 class="deal-title mb-10">
                                                    <a href="#"><?php echo $deal->title; ?></a>
                                                </h5>
                                                <p class="mb-15 color-muted mb-20 font-12"><i class="lnr lnr-clock mr-10"></i><?php echo lang('end')?> : <?php echo substr($deal->end, 0, 10); ?></p>
                                                <div>
                                                    <a class="btn btn-sm btn-block" href='<?php echo routeDeal($deal->deal_id, $deal->title); ?>'>Voir</a>
                                                </div>
                                                <div class='clear clearfix'></div>
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

            <!--STORES MODULE-->
            <section class="section stores-area stores-area-v1 ptb-30">
                <header class="panel ptb-15 prl-20 pos-r mb-30">
                    <h3 class="section-title font-18"><?php echo $this->lang->line('all_stores'); ?></h3>
                    <a href="<?php echo base_url('les-commerces'); ?>" class="btn btn-o btn-xs pos-a right-10 pos-tb-center hidden-xs"><?php echo $this->lang->line('show_all_stores'); ?></a>
                </header>
                <div class="popular-stores-slider owl-slider" data-loop="true" data-autoplay="true" data-smart-speed="1000" data-nav="true" data-autoplay-timeout="10000" data-margin="20" data-items="2" data-xxs-items="2" data-xs-items="2" data-sm-items="3" data-md-items="5" data-lg-items="6">
                    <?php if ($pros) : ?>
                        <?php foreach ($pros as $pro) : ?>
                            <div class="store-item t-center">
                                <a href="<?php echo base_url('boutique/' . strtolower(url_title($pro->company)) . '/' . $pro->id); ?>" class="panel is-block">
                                    <div class="embed-responsive embed-responsive-4by3">
                                        <div class="store-logo">
                                            <img src="<?php echo base_url('assets/images/brands/' . (!empty($pro->logo) ? $pro->logo : 'boutique.png')); ?>" alt="">
                                        </div>
                                    </div>
                                    <h6 class="store-name ptb-10"><?php echo $pro->company; ?></h6>
                                    <ul class="deal-meta list-inline mb-10">
                                        <li class="color-muted"><i class="ico fa fa-map-marker mr-5"></i><?php echo $pro->city; ?></li>
                                    </ul>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>

            <!--NEWSLETTER MODULE-->
            <?php if ($this->config->item('key_sendinblue') != '' && $this->config->item('key_sendinblue') != 'false') : ?>
                <section class="section subscribe-area ptb-40 t-center">
                    <div class="newsletter-form">
                        <h4 class="mb-20"><i class="fa fa-envelope-o color-green mr-10"></i><?php echo $this->lang->line('newsletter_subscribe'); ?></h4>
                        <p class="mb-20 color-mid"><?php echo $this->lang->line('newsletter_line_1'); ?></p>
                        <form method="post" action="<?php echo base_url('users/newsletter'); ?>">
                            <div class="input-group mb-10">
                                <input type="email" class="form-control bg-white" placeholder="<?php echo $this->lang->line('my_email'); ?>" required="required" name="email">
                                <span class="input-group-btn">
                                    <button class="btn" type="submit"><?php echo $this->lang->line('signup'); ?></button>
                                </span>
                            </div>
                        </form>
                        <p class="color-muted"><?php echo $this->lang->line('newsletter_line_2'); ?></p>
                    </div>
                </section>
            <?php endif; ?>
        </div>
    </div>
</main>