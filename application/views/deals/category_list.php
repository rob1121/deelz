<main id="mainContent" class="main-content">
    <div class="page-container pt-40 pt-10">
        <div class="container">
            <div class='col-md-12'>
                <h1 class="hidden-xs"><i class='<?php echo $category->icon; ?>'></i> <?php echo $this->lang->line('categorylist_title_l1'); ?> <?php echo $category->name; ?> <?php echo $this->lang->line('categorylist_title_l2'); ?></h1>
                <h3 class="hidden-lg hidden-md hidden-sm"><i class='<?php echo $category->icon; ?>'></i> <?php echo $category->name; ?></h3>
                <hr />
            </div>
            <div class="col-md-12 categories">
                <?php if ($sub_categories) : ?>
                    <?php foreach ($sub_categories as $sub_category) : ?>
                        <div class="latest-deals__item item col-md-6 mb-10">
                            <figure class="deal-thumbnail embed-responsive embed-responsive-4by3 cursor-pointer" onclick="<?php echo $sub_category->partner != null ? '$(\'#'.$sub_category->partner.'\').modal(\'show\')' : 'window.location.href = \''.base_url($sub_category->route) . (isset($_GET['type']) ? '?type=' . $_GET['type'] : '')."'" ?>" data-bg-img="<?php echo base_url('assets/images/' . checkImageExtension($sub_category->image, $category_id)) ?>" style="background-image: url(<?php echo base_url('assets/images/' . checkImageExtension($sub_category->image, $category_id)) ?>);">
                                <?php if ($sub_category->deals) : ?>
                                    <div class="label-discount top-10 right-10">-<?php echo $sub_category->deals[0]->promo_discount; ?>%</div>
                                <?php endif; ?>
                                <div class="deal-about p-10 pos-a bottom-0 left-0">

                                    <h5 class="deal-title mb-10">
                                        <a href="<?php echo $sub_category->partner != null ? '#' . $sub_category->partner . '" data-toggle="modal' : base_url($sub_category->route) . (isset($_GET['type']) ? '?type=' . $_GET['type'] : ''); ?>" class="color-lighter"><?php echo $sub_category->name; ?></a>
                                    </h5>
                                </div>
                            </figure>
                        </div>
                        <?php if ($sub_category->partner != null) : ?>
                            <?php $this->load->view('scripts/partner_'.$sub_category->partner); ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div> 
    </div>
</main>
