<main id="mainContent" class="main-content">
    <div class="page-container">
        <div class="container">
            <div class="cart-area ptb-60">
                <div class="container">
                    <div class="cart-wrapper">
                        <h3 class="h-title mb-30 t-uppercase"><i class="fa fa-envelope"></i> <?php echo lang('store_inbox_l1') ?></h3>
                        <?php if ($inbox) : ?>
                            <table id="cart_list" class="wishlist">
                                <tbody>
                                    <?php foreach ($inbox as $message) : ?>
                                        <tr class="panel alert mt-10" <?php echo $message->inbox_readed == 0 ? 'style="border-left: 2px dashed #FA3D70;"' : '' ?>>
                                            <td class="col-sm-8 col-md-9">
                                                <div class="media-left is-hidden-sm-down">
                                                    <?php if ($message->type_user == 'users') : ?>
                                                        <figure class="product-thumb text-center">
                                                            <h1><i class="fa fa-user"></i></h1>
                                                        </figure>
                                                    <?php else : ?>
                                                        <figure class="product-thumb">
                                                            <img src="<?php echo base_url('assets/images/brands/' . (!empty($message->logo) ? $message->logo : 'boutique.png')); ?>" alt="product">
                                                        </figure>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="media-body valign-middle">
                                                    <h5 class="title mb-5 t-uppercase"><?php echo $message->name; ?></h5>
                                                    <?php if ($message->inbox_readed == 0) : ?>
                                                        <h4 class="price color-green"><?php echo lang('store_inbox_l2') ?></h4>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td class="col-sm-4 col-md-3 is-hidden-xs-down">
                                                <a href="<?php echo base_url('store/messages/' . $message->users_id.($message->type_user == 'admin' ? '/admin' : '')) ?>" class="btn btn-rounded btn-sm"><i class="fa fa-envelope"></i> <?php echo lang('store_inbox_l3') ?></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <div class="alert alert-info">
                                <h3 class="text-center"><i class="fa fa-envelope"></i> <?php echo lang('store_inbox_l4') ?><br /><small><?php echo lang('store_inbox_l5') ?></small></h3>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>