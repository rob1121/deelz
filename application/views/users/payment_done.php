<main id="mainContent" class="main-content">
    <!-- Page Container -->
    <div class="page-container ptb-60">
        <div class="container">
            <div class="row row-rl-10 row-tb-20">
                <div class="page-content col-md-12">
                    <div class="alert alert-success text-center">
                        <h3><i class="fa fa-check"></i> <?php echo lang('users_payment_done_l1'); ?></h3>
                        <p>
                            <?php echo lang('users_payment_done_l2'); ?>
                        </p>
                    </div>
                    <div class='text-center'>
                        <a href='<?php echo base_url(); ?>' class='btn btn-info'><i class='fa fa-eye'></i> <?php echo lang('users_payment_done_l3'); ?></a>
                        <a href='<?php echo base_url('users/coupons'); ?>' class='btn'><i class='fa fa-arrow-right'></i> <?php echo lang('users_payment_done_l4'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Container -->
</main>
<!-- Pixel FB -->
<?php $this->load->view('scripts/facebook_pixel', array('action' => 'Purchase', 'value' => $order->order_amount)); ?>
<!-- Pixel Google -->
<?php $this->load->view('scripts/adwords_pixel', array('action' => 'Purchase', 'value' => $order->order_amount)); ?>
