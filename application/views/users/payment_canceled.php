<main id="mainContent" class="main-content">
    <!-- Page Container -->
    <div class="page-container ptb-60">
        <div class="container">
            <div class="row row-rl-10 row-tb-20">
                <div class="page-content col-md-12">
                    <div class="alert alert-info text-center">
                        <h3><i class="fa fa-credit-card"></i> <?php echo lang('users_payment_canceled_l1'); ?></h3>
                        <p>
                            <?php echo lang('users_payment_canceled_l2'); ?>
                        </p>
                    </div>
                    <div class='text-center'>
                        <a href='<?php echo base_url('users/payment/'.$orders_id)?>' class='btn'><i class='fa fa-check'></i> <?php echo lang('users_payment_canceled_l3'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Container -->
</main>