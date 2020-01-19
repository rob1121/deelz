<?php
$categorys = $this->categories->getAll();
?>
<ul class="<?php echo isset($class) ? $class : '' ?>">
    <?php if ($categorys) : ?>
        <?php foreach ($categorys as $category) : ?>
            <li category_id='<?php echo $category->id; ?>' class="<?php echo isset($add_class) ? $add_class : ''?>"><a href="<?php echo !isset($no_link) ? base_url($category->route).(isset($add_link) ? $add_link : '') : '#'; ?>">
                    <?php if ($show_icons) : ?>
                        <i class="<?php echo $category->icon ?> mr-5"></i>
                    <?php endif; ?>
                    <?php echo $category->name; ?>
                    <?php if (isset($show_count) && $show_count == true) : ?>    
                        <span class='ml5'>40</span>
                    <?php endif; ?>
                </a>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>