<main id="mainContent" class="main-content">
    <div class="page-container">
        <div class="container">
            <div class="cart-area ptb-60">
                <div class="container">
                    <div class="cart-wrapper">
                        <h3 class="h-title mb-30 t-uppercase"><i class="fa fa-envelope"></i> <?php echo lang('users_messages_l1'); ?></h3>
                        <?php if ($inbox) : ?>
                            <table id="cart_list" class="wishlist">
                                <tbody>
                                    <?php foreach ($inbox as $message) : ?>
                                        <tr class="panel alert">
                                            <td class="col-sm-12 col-md-12">
                                                <div class="media-left is-hidden-sm-down">
                                                    <figure class="product-thumb text-center">
                                                        <?php if ($message->inbox_from_users_pro_id != NULL) : ?>
                                                            <a href="<?php echo base_url('boutique/' . strtolower(url_title($pro->company) . '/' . $pro->id)) ?>">
                                                                <img src="<?php echo base_url('assets/images/brands/' . (!empty($pro->logo) ? $pro->logo : 'boutique.png')); ?>" alt="product">
                                                            </a>
                                                            <h5><?php echo $pro->company; ?></h5>
                                                        <?php else : ?>
                                                            <h1><i class="fa fa-user"></i></h1>
                                                            <h5><?php echo lang('users_messages_l2'); ?></h5>
                                                        <?php endif; ?>
                                                    </figure>
                                                </div>
                                                <div class="media-body valign-middle">
                                                    <div class='text-right'><?php echo lang('users_messages_l3'); ?> <?php echo str_replace(' ', ' : ', $message->inbox_created_at); ?></div>
                                                    <p>
                                                        <?php echo $message->inbox_content; ?>
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <div class="alert alert-info">
                                <h3 class="text-center"><i class="fa fa-envelope"></i> <?php echo lang('users_messages_l4'); ?></h3>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-12 bg-white mt-30 pt-30" id='sendMessage'>
                        <h3><i class='fa fa-envelope'></i> <span class="hidden-xs"><?php echo lang('users_messages_l5'); ?></span></h3>
                        <form action="#sendMessage" method="post">
                            <input type='hidden' name='store_id' value='<?php echo $pro->id; ?>' />
                            <?php if (validation_errors() || isset($captchaOk)) : ?>
                                <div class='alert alert-danger'>
                                    <?php echo validation_errors(); ?>
                                    <?php if ($captchaOk == false) : ?>
                                        <p><?php echo lang('users_messages_l6'); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($message_sended)) : ?>
                                <div class='alert alert-success'>
                                    <h3><i class='fa fa-check'></i> <?php echo lang('users_messages_l7'); ?></h3>
                                </div>
                            <?php else : ?>
                                <div class="form-group">
                                    <textarea rows="5" class="form-control" required="required" name='message'><?php echo!isset($message_sended) ? set_value('message') : ''; ?></textarea>
                                </div>
                                <div class='form-group'>
                                    <div class="g-recaptcha mb-10" data-sitekey="<?php echo $this->config->item('recaptcha_key_site') ?>"></div>
                                </div>
                                <button class="btn mb-20" type='submit'><i class='fa fa-check'></i> <?php echo lang('users_messages_l8'); ?></button>
                            <?php endif; ?>
                            <p>
                                <a href="<?php echo base_url('users/inbox') ?>" class="btn btn-info btn-xs"><i class="fa fa-arrow-left"></i> <?php echo lang('users_messages_l9'); ?></a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>