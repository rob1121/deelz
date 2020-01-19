<?php
if ($this->session->userdata('role') == 'admin' && $this->router->fetch_method() == 'pro') {
    $ratings = $this->users_pro_rating->getAll();
} else {
    $ratings = $this->users_pro_rating->getForStore($prod_id);
}
?>
<?php if ($ratings) : ?>
    <div class="col-xs-12">
        <div class="posted-review panel p-30">
            <?php if ($this->session->userdata('role') == 'admin' && $this->router->fetch_method() == 'pro') : ?>
                <h1 class="text-center"><i class="fa fa-envelope mr-10"></i> <?php echo lang('store_reviews_l1') ?></h1>
            <?php else : ?>
                <h1 class="text-center"><i class="fa fa-envelope mr-10"></i><?php echo isset($pro) ? lang('store_reviews_l2').' ' . count($ratings) . ' '.lang('store_reviews_l3') : count($ratings) . ' '.lang('store_reviews_l4') ?></h1>
            <?php endif; ?>
            <?php foreach ($ratings as $rating) : ?>
                <?php
                if ($rating->users_id != 0) {
                    $rating->guest_name = $this->users->getUser($rating->users_id)->name;
                }
                ?>
                <div class="review-single pt-30">
                    <div class="media">
                        <div class="media-left">
                            <h1><i class="fa fa-user"></i></h1>
                            <!--<img class="media-object mr-10 radius-4" src="<?php echo base_url() ?>assets/images/avatars/avatar_01.jpg" width="90" alt="">-->
                        </div>
                        <div class="media-body">
                            <div class="review-wrapper clearfix">
                                <ul class="list-inline">
                                    <?php if ($this->session->userdata('role') == 'admin' && $this->router->fetch_method() == 'pro') : ?>
                                        <span class="review-holder-name h5"><?php echo $rating->company; ?></span>
                                    <?php endif; ?>
                                    <li>
                                        <span class="review-holder-name h5"><?php echo $rating->guest_name; ?></span>
                                    </li>
                                    <li>
                                        <div class="rating">
                                            <span class="rating-stars" data-rating="<?php echo $rating->rating ?>">
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star<?php echo $rating->rating < 2 ? '' : '-o' ?>"></i>
                                                <i class="fa fa-star<?php echo $rating->rating < 3 ? '' : '-o' ?>"></i>
                                                <i class="fa fa-star<?php echo $rating->rating < 4 ? '' : '-o' ?>"></i>
                                                <i class="fa fa-star<?php echo $rating->rating < 5 ? '' : '-o' ?>"></i>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                                <p class="review-date mb-5"><?php echo $rating->created_at; ?></p>
                                <p class="copy"><?php echo $rating->review ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php elseif ($this->users_pro->isLogged() && $prod_id == $this->session->userdata('pro_id') && isset($pro_company)) : ?>
    <div class='alert alert-info text-center'>
        <h3><i class='fa fa-star-o'></i> <?php echo lang('store_reviews_l5') ?></h3>
        <p>
            <?php echo lang('store_reviews_l6') ?>
            <br /><br />
            <?php echo lang('store_reviews_l7') ?> <em><a href="<?php echo base_url('boutique/' . strtolower(url_title($pro_company)) . '/' . $prod_id) ?>" target="_blank"><?php echo base_url('boutique/' . strtolower(url_title($pro_company)) . '/' . $prod_id) ?></a></em>
        </p>
        <ul class="list-inline social-icons social-icons--colored t-center mt-30">
            <li class="social-icons__item">
                <a href="#" onclick="window.open('https://www.facebook.com/sharer.php?u=<?php echo base_url('boutique/' . strtolower(url_title($pro_company)) . '/' . $prod_id) ?>', '_blank', 'width=500,height=300')"><i class="fa fa-facebook"></i></a>
            </li>
            <li class="social-icons__item">
                <a href="#" onclick="window.open('http://twitter.com/intent/tweet?status=<?php echo base_url('boutique/' . strtolower(url_title($pro_company)) . '/' . $prod_id) ?>', '_blank', 'width=500,height=300')"><i class="fa fa-twitter"></i></a>
            </li>
            <li class="social-icons__item">
                <a href="#" onclick="window.open('https://plus.google.com/share?url=<?php echo base_url('boutique/' . strtolower(url_title($pro_company)) . '/' . $prod_id) ?>', '_blank', 'width=500,height=300')"><i class="fa fa-pinterest"></i></a>
            </li>
        </ul>
    </div>
<?php endif; ?>