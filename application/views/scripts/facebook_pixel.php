<?php if ($this->config->item('facebook_pixel_id') != '') : ?>
    <!-- Facebook Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq)
                return;
            n = f.fbq = function () {
                n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq)
                f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window,
                document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '<?php echo $this->config->item('facebook_pixel_id'); ?>'); // Insert your pixel ID here.
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=<?php echo $this->config->item('facebook_pixel_id'); ?>&ev=PageView&noscript=1"
                   /></noscript>
    <!-- DO NOT MODIFY -->
    <!-- End Facebook Pixel Code -->
    <?php if (isset($action)) : ?>
        <script>
            fbq('track', '<?php echo $action; ?>'
        <?php if (isset($value)) : ?>
                , {
                value: <?php echo $value; ?>,
                        currency: <?php echo $this->config->item('currency_code'); ?>
                }
        <?php endif; ?>
            );
        </script>
    <?php endif; ?>
<?php endif; ?>