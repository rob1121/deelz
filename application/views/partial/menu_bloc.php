<?php if ($infos->partner == null) : ?>
    <figure class="deal-thumbnail embed-responsive embed-responsive-4by3 cursor-pointer" onclick="<?php echo $infos->partner != null ? '$(\'#' . $infos->partner . '\').modal(\'show\')' : 'window.location.href = \'' . base_url($infos->route) . (isset($add_link) ? $add_link : '') . "'" ?>" data-bg-img="<?php echo base_url('assets/images/' . checkImageExtension($infos->image, $infos->categories_id)) ?>">
        <div class="deal-about p-10 pos-a bottom-0 left-0">
            <h6 class="deal-title mb-10">
                <a href="<?php echo $infos->partner != null ? '#' . $infos->partner . '" data-toggle="modal' : base_url($infos->route) . (isset($add_link) ? $add_link : ''); ?>" class="color-lighter"><?php echo $infos->name; ?></a>
            </h6>
        </div>
    </figure>
    <?php if ($infos->partner != null) : ?>
        <?php $this->load->view('scripts/partner_' . $infos->partner); ?>
    <?php endif; ?>
<?php endif; ?>