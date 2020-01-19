<main id="mainContent" class="main-content">
    <div class="page-container ptb-60">
        <div class="container">
            <section class="sign-area panel p-40">
                <h3 class="sign-title text-center bg-green color-white pt-10 pr-10 pl-10"><i class='fa fa-credit-card'></i> <?php echo $this->lang->line('add_online_l1'); ?> <br />
                    <small class='color-white'><?php echo $this->lang->line('add_online_l2'); ?></small></h3>
                <?php $this->load->view('deals/add_process', array('type' => 'deal')); ?>
            </section>
        </div>
    </div>


</main>