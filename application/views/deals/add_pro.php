<main id="mainContent" class="main-content">
    <div class="page-container ptb-60">
        <div class="container">
            <section class="sign-area panel p-40"> 
                <h3 class="sign-title text-center bg-blue pt-10 color-white">
                    <i class='fa fa-building'></i> <?php echo $this->lang->line('add_pro_l1'); ?> <br />
                    <small class="color-white"><?php echo $this->lang->line('add_pro_l2'); ?></small>
                </h3>
                <?php $this->load->view('deals/add_process', array('type' => 'boutique')); ?>  
            </section>
        </div>
    </div>
</main>   