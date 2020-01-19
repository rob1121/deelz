<form class="horizontal-form pt-30" action="<?php echo base_url('store/addUsersProRating') ?>" method="post">
    <?php $errors_rating = $this->session->flashdata('errors_rating'); ?>
    <?php $rating_datas = $this->session->flashdata('rating_datas'); ?>
    <?php if (isset($errors_rating)): ?>
        <div class="alert alert-danger">
            <?php echo $errors_rating; ?>
        </div>
    <?php endif; ?>
    <input type="hidden" name="redirect" value="<?php echo current_url(); ?>" />
    <input type="hidden" name="rating" class="rating_keep" value="<?php echo $rating_datas ? $rating_datas['rating'] : '5'?>" />
    <input type="hidden" name="users_pro_id" value="<?php echo $users_pro_id; ?>" />
    <div class="row row-v-10">
        <?php if (!$this->users->isLogged()) : ?>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('lastname'); ?>" required name="guest_name" value="<?php echo $rating_datas ? $rating_datas['guest_name'] : ''?>">
            </div>
            <div class="col-sm-6 pb-20">
                <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('email'); ?>" name="guest_email" value="<?php echo $rating_datas ? $rating_datas['guest_email'] : ''?>">
            </div>
        <?php endif; ?>
        <div class="col-xs-12">
            <ul class="select-rate list-inline pb-20">
                <li><span><?php echo $this->lang->line('your_rating'); ?></span>
                </li>
                <li class="rating">
                    <span class="rating-stars rate-allow" role="button" data-rating="5">
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o star-active"></i>
                    </span>
                </li>
            </ul>
        </div>
        <div class="col-xs-12">
            <textarea maxlength="1000" class="form-control" placeholder="<?php echo $this->lang->line('your_rating_text'); ?>" rows="6" name="review"><?php echo $rating_datas ? $rating_datas['review'] : ''?></textarea>
        </div>
        <div class="col-xs-12 text-right">
            <button type="submit" class="btn mt-20"><?php echo $this->lang->line('save'); ?></button>
        </div>
    </div>
</form>