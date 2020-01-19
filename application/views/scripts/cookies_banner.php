<script src="<?php echo base_url(); ?>assets/js/custom/plugins/cookiechoices.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function (event) {
        cookieChoices.showCookieConsentBar('<?php echo lang('cookie_banner_l1') ?>',
                '<?php echo lang('cookie_banner_l2') ?>', '<?php echo lang('cookie_banner_l3') ?>', '<?php echo base_url(); ?>home/legal#cookies');
    });
</script>