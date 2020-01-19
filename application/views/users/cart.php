<?php
// Pas de gestion des quantités pour le moment
$quantity = 1;
?>
<main id="mainContent" class="main-content">
    <div class="page-container">
        <div class="container">
            <div class="cart-area ptb-60">
                <div class="container">
                    <div class="cart-wrapper">
                        <h3 class="h-title mb-30 t-uppercase"><i class="fa fa-shopping-cart"></i> <?php echo lang('users_cart_l1'); ?></h3>
                        <?php if ($deals) : ?>
                            <table id="cart_list" class="cart-list mb-30">
                                <thead class="panel t-uppercase">
                                    <tr>
                                        <th><?php echo lang('users_cart_l2'); ?></th>
                                        <th class='hidden-xs'><?php echo lang('users_cart_l3'); ?></th>
                                        <th class='hidden-xs'><?php echo lang('users_cart_l4'); ?></th>
                                        <th><?php echo lang('users_cart_l5'); ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($deals as $deal) : ?>
                                        <tr class="panel">
                                            <td>
                                                <div class="media-left is-hidden-sm-down">
                                                    <figure class="product-thumb">
                                                        <a href="<?php echo routeDeal($deal->deal_id, $deal->title); ?>">
                                                            <img src="<?php echo base_url('assets/images/' . $deal->cover) ?>" alt="product">
                                                        </a>
                                                    </figure>
                                                </div>
                                                <div class="media-body valign-middle">
                                                    <h6 class="title mb-15 t-uppercase"><a href="#"><?php echo $deal->title; ?></a></h6>
                                                    <!-- TODO : Category > Subcategory
                                                    <div class="type font-12"><span class="t-uppercase">Type : </span>Women's Cloths</div>-->
                                                </div>
                                            </td>
                                            <td class='hidden-xs'><?php echo priceToShow($deal->price_promo); ?></td>
                                            <td class='hidden-xs'>
                                                <input class="quantity-label" type="number" value="<?php echo $quantity; ?>">
                                            </td>
                                            <td>
                                                <div class="sub-total"><?php echo priceToShow($deal->price_promo * $quantity); ?></div>
                                            </td>
                                            <td>
                                                <a href="#" class="close deleteInCart" deals_id="<?php echo $deal->id ?>">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="cart-price">
                                <h5 class="t-uppercase mb-20"><?php echo lang('users_cart_l6'); ?></h5>
                                <ul class="panel mb-20">
                                    <li>
                                        <div class="item-name">
                                            <strong class="t-uppercase"><?php echo lang('users_cart_l7'); ?></strong>
                                        </div>
                                        <div class="price">
                                            <span>
                                                <?php $total = 0; ?>
                                                <?php foreach ($deals as $deal) : ?>
                                                    <?php $total += $deal->price_promo; ?>
                                                <?php endforeach; ?>
                                                <?php echo priceToShow($total); ?>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="t-right">
                                    <a href="<?php echo base_url('users/billing')?> " class="btn btn-rounded btn-lg"><?php echo lang('users_cart_l8'); ?> <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="alert alert-info">
                                <h3 class="text-center"><i class="fa fa-shopping-cart"></i> <?php echo lang('users_cart_l9'); ?></h3>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if($this->users->isLogged()) : ?>
                    <div class="col-md-12 text-center mt-30">
                        <a href="<?php echo base_url('users/logout') ?>" class="btn btn-info btn-xs"><i class="fa fa-unlock"></i> <?php echo lang('users_cart_l10'); ?></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php if(isset($_GET['notif']) && $_GET['notif'] == 'product_added') : ?>
<?php $this->load->view('scripts/facebook_pixel', array('action' => 'AddToCart', 'value' => $total)); ?> 
<?php endif; ?>
