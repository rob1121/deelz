<?php if ($deal->hp_top == 1) : ?>
    <a href="<?php echo base_url('admin/changeTop/' . $deal->deal_id . '/0') ?>" class="btn btn-danger btn-xs mt-5"><i class="fa fa-close"></i> <?php echo lang('store_admin_actions_top') ?></a>
<?php else : ?>
    <a href="<?php echo base_url('admin/changeTop/' . $deal->deal_id) . '/1' ?>" class="btn btn-info btn-xs mt-5"><i class="fa fa-check"></i> <?php echo lang('store_admin_actions_top') ?></a>
<?php endif; ?>
<?php if ($deal->hp_slider > 0) : ?>
    <a href="<?php echo base_url('admin/changeSlider/' . $deal->deal_id . '/0') ?>" class="btn btn-danger btn-xs mt-5"><i class="fa fa-close"></i> <?php echo lang('store_admin_actions_slider') ?></a>
<?php else : ?>
    <a href="<?php echo base_url('admin/changeSlider/' . $deal->deal_id) . '/1' ?>" class="btn btn-warning btn-xs mt-5"><i class="fa fa-check"></i> <?php echo lang('store_admin_actions_pos1') ?></a>
    <a href="<?php echo base_url('admin/changeSlider/' . $deal->deal_id) . '/2' ?>" class="btn btn-xs mt-5"><i class="fa fa-check"></i> <?php echo lang('store_admin_actions_pos2') ?></a>
    <a href="<?php echo base_url('admin/changeSlider/' . $deal->deal_id) . '/3' ?>" class="btn btn-xs mt-5"><i class="fa fa-check"></i> <?php echo lang('store_admin_actions_pos3') ?></a>
<?php endif; ?>
<?php if ($deal->statut == 'draft') : ?>
    <a href="<?php echo base_url('admin/changeStatut/' . $deal->deal_id . '/publish') ?>" class="btn btn-info btn-xs mt-5"><i class="fa fa-check"></i> <?php echo lang('store_admin_actions_publish') ?></a>
<?php else : ?>
    <a href="<?php echo base_url('admin/changeStatut/' . $deal->deal_id) . '/draft' ?>" class="btn btn-danger btn-xs mt-5"><i class="fa fa-close"></i> <?php echo lang('store_admin_actions_desactive') ?></a>
<?php endif; ?> 