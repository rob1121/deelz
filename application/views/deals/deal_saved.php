<main id="mainContent" class="main-content">
    <!-- Page Container -->
    <div class="page-container ptb-60">
        <div class="container">
            <div class="row row-rl-10 row-tb-20">
                <div class="page-content col-xs-12 col-sm-12 col-md-12">
                    <!-- Type de deal -->
                    <section class="section checkout-area panel prl-30 pt-20 pb-40 text-center">
                        <div class='alert alert-success'>
                            <h1><?php echo $this->lang->line('deal_saved_l1'); ?> <?php echo $_GET['type']; ?> <?php echo $this->lang->line('deal_saved_l2'); ?></h1>
                            <p class='mt-20'>
                                <?php echo $this->lang->line('deal_saved_l3'); ?> <?php echo $_GET['type']; ?> <?php echo $this->lang->line('deal_saved_l4'); ?>
                                <br />
                                <?php echo $this->lang->line('deal_saved_l5'); ?> <?php echo $_GET['type']; ?><?php echo $this->lang->line('deal_saved_l6'); ?>
                                <br />
                                <?php echo $this->lang->line('deal_saved_l7'); ?>
                            </p>
                        </div>
                        <a href='<?php echo base_url('deals/add') ?>' class='btn btn-info'><i class='fa fa-plus'></i> <?php echo $this->lang->line('deal_saved_l8'); ?> <?php echo $_GET['type']; ?></a>
                        <a href='<?php echo base_url('store/pro') ?>' class='btn'><i class='fa fa-eye'></i> <?php echo $this->lang->line('deal_saved_l9'); ?></a>
                    </section>
                    <!-- End Type de deal -->
                </div>

            </div>
        </div>
    </div>
    <!-- End Page Container -->


</main>