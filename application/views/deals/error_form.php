<main id="mainContent" class="main-content">
    <!-- Page Container -->
    <div class="page-container ptb-60">
        <div class="container">
            <div class="row row-rl-10 row-tb-20">
                <div class="page-content col-xs-12 col-sm-12 col-md-12">
                    <!-- Type de deal -->
                    <section class="section checkout-area panel prl-30 pt-20 pb-40 text-center">
                        <div class='alert alert-danger'>
                            <h1><i class='fa fa-exclamation-triangle'></i> <?php echo $this->lang->line('error_form_l1'); ?></h1>
                            <p class='mt-20'>
                                <?php echo $this->lang->line('error_form_l2'); ?>
                            </p>
                        </div>
                        <a href='<?php echo base_url('deals/add') ?>' class='btn'><?php echo $this->lang->line('error_form_l3'); ?></a>
                    </section>
                    <!-- End Type de deal -->
                </div>

            </div>
        </div>
    </div>
    <!-- End Page Container -->


</main>