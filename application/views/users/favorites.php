<main id="mainContent" class="main-content">
    <div class="page-container ptb-20">
        <div class="container">
            <section class="wishlist-area ptb-30">
                <div class="container">
                    <div class="wishlist-wrapper">
                        <h3 class="h-title mb-40 t-uppercase"><i class="fa fa-heart"></i> <?php echo lang('users_favorites_l1'); ?></h3>
                        <?php if ($deals) : ?>
                            <table id="cart_list" class="wishlist">
                                <tbody>
                                    <?php foreach ($deals as $deal) : ?>
                                        <tr class="panel alert">
                                            <td class="col-sm-8 col-md-9">
                                                <div class="media-left is-hidden-sm-down">
                                                    <figure class="product-thumb">
                                                        <a href="<?php echo routeDeal($deal->id, $deal->title) ?>">
                                                            <img src="<?php echo base_url('assets/images/' . $deal->cover) ?>" alt="product">
                                                        </a>
                                                    </figure>
                                                </div>
                                                <div class="media-body valign-middle">
                                                    <h5 class="title mb-5 t-uppercase"><a href="<?php echo routeDeal($deal->id, $deal->title) ?>"><?php echo $deal->title; ?></a></h5>
                                                    <!--<div class="rating mb-10">
                                                        <span class="rating-stars rate-allow" data-rating="2">
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o"></i>
                                                            <i class="fa fa-star-o star-active"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </span>
                                                        <span class="rating-reviews">
                                                            ( <span class="rating-count">100</span> rates )
                                                        </span>
                                                    </div>-->
                                                    <h4 class="price color-green"><span class="price-sale"><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_base) : ''; ?></span><?php echo $deal->price_promo > 0 ? priceToShow($deal->price_promo) : priceToShow($deal->price_base); ?></h4>
                                                    <a href="<?php echo routeDeal($deal->id, $deal->title) ?>" class="btn btn-rounded btn-sm mt-15 is-hidden-sm-up"><i class="<?php echo getDealTypeIcon($deal->type_deal) ?>"></i> <?php echo lang('users_favorites_l2'); ?><?php echo getDealType($deal->type_deal) ?>)</a>
                                                </div>
                                            </td>
                                            <td class="col-sm-3 col-md-2 is-hidden-xs-down">
                                                <a href="<?php echo routeDeal($deal->id, $deal->title) ?>" class="btn btn-rounded btn-sm"><i class="<?php echo getDealTypeIcon($deal->type_deal) ?>"></i> <?php echo lang('users_favorites_l2'); ?><?php echo getDealType($deal->type_deal) ?>)</a> 
                                            </td>
                                            <td class="col-sm-1">
                                                <button type="button" class="close pr-xs-0 pr-sm-10 deleteDeal" deals_id="<?php echo $deal->id; ?>" aria-hidden="true" total_deals="<?php echo count($deals); ?>">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <div class="alert alert-info">
                                <h3 class="text-center"><i class="fa fa-heart"></i> <?php echo lang('users_favorites_l3'); ?></h3>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-12 text-center mt-30">
                            <a href="<?php echo base_url('users/logout') ?>" class="btn btn-info btn-xs"><i class="fa fa-unlock"></i> <?php echo lang('users_favorites_l4'); ?></a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


</main>