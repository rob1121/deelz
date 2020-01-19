<?php
switch ($action) {
    // VENTE PARTICULIER
    case 'Purchase' :
        ?>
        <?php if ($this->config->item('google_pixel_id_Purchase') != '') : ?>
            <!-- Google Code for Zotdeal Vente Conversion Page -->
            <script type="text/javascript">
                /* <![CDATA[ */
                var google_conversion_id = <?php echo $this->config->item('google_conversion_id'); ?>;
                var google_conversion_language = "en";
                var google_conversion_format = "3";
                var google_conversion_color = "ffffff";
                var google_conversion_label = "<?php echo $this->config->item('google_pixel_id_Purchase'); ?>";
                var google_remarketing_only = false;
                /* ]]> */
            </script>
            <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
            </script>
            <noscript>
            <div style="display:inline;">
                <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/853379664/?label=<?php echo $this->config->item('google_pixel_id_Purchase'); ?>&amp;guid=ON&amp;script=0"/>
            </div>
            </noscript>
        <?php endif; ?>
        <?php break; ?>
        <!-- INSCRIPTION PARTICULIER -->
    <?php case 'CompleteRegistration' : ?>
        <?php if ($this->config->item('google_pixel_id_CompleteRegistration') != '') : ?>
            <!-- Google Code for Zotdeal Inscription Particulier Conversion Page -->
            <script type="text/javascript">
                /* <![CDATA[ */
                var google_conversion_id = <?php echo $this->config->item('google_conversion_id'); ?>;
                var google_conversion_language = "en";
                var google_conversion_format = "3";
                var google_conversion_color = "ffffff";
                var google_conversion_label = "<?php echo $this->config->item('google_pixel_id_CompleteRegistration'); ?>";
                var google_remarketing_only = false;
                /* ]]> */
            </script>
            <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
            </script>
            <noscript>
            <div style="display:inline;">
                <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/853379664/?label=<?php echo $this->config->item('google_pixel_id_CompleteRegistration'); ?>&amp;guid=ON&amp;script=0"/>
            </div>
            </noscript>
        <?php endif; ?>
        <?php break; ?>    
        <!-- VENTE PRO -->
    <?php case 'PurchasePro' : ?>
        <?php if ($this->config->item('google_pixel_id_PurchasePro') != '') : ?>
            <!-- Google Code for Zotdeal Vente PRO Conversion Page -->
            <script type="text/javascript">
                /* <![CDATA[ */
                var google_conversion_id = <?php echo $this->config->item('google_conversion_id'); ?>;
                var google_conversion_language = "en";
                var google_conversion_format = "3";
                var google_conversion_color = "ffffff";
                var google_conversion_label = "<?php echo $this->config->item('google_pixel_id_PurchasePro'); ?>";
                var google_remarketing_only = false;
                /* ]]> */
            </script>
            <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
            </script>
            <noscript>
            <div style="display:inline;">
                <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/853379664/?label=<?php echo $this->config->item('google_pixel_id_PurchasePro'); ?>&amp;guid=ON&amp;script=0"/>
            </div>
            </noscript>
        <?php endif; ?>
        <?php break; ?>   
<?php } ?>