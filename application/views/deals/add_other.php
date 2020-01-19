<main id="mainContent" class="main-content">
    <div class="page-container ptb-60">
        <div class="container">
            <section class="sign-area panel p-40">
                <h3 class="sign-title text-center bg-warning pt-10 pr-10 pl-10">
                    <i class='fa fa-comments'></i> <?php echo $this->lang->line('add_other_l1'); ?> <br />
                    <small><?php echo $this->lang->line('add_other_l2'); ?>
                        
                    </small></h3>
                <?php $this->load->view('deals/add_process', array('type' => 'bon plan')); ?>
            </section>
        </div>
    </div>
</main>