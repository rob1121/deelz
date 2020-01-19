<?php

/**
 * Functions helper
 */
function paginationConfig() {
    $config['full_tag_open'] = '<nav>';
    $config['full_tag_close'] = '</nav>';
    $config['cur_tag_open'] = '<li><span class="page-numbers current">';
    $config['cur_tag_close'] = '</span></li>';
    $config['first_tag_open'] = $config['last_tag_open'] = $config['prev_tag_open'] = $config['next_tag_open'] = $config['num_tag_open'] = '<li class="page-numbers">';
    $config['first_tag_close'] = $config['last_tag_close'] = $config['prev_tag_close'] = $config['next_tag_close'] = $config['num_tag_close'] = '</li>';
    $config['first_link'] = '<<';
    $config['last_link'] = '>>';
    return $config;
}

/**
 * Créé la route d'un deal
 * @param int $id
 * @param string $title
 * @return type
 */
function routeDeal($id, $title) {
    return base_url(strtolower(url_title($title)) . '/bon-plan-reunion/' . $id);
}

/**
 * Retourne le wording pour les types de deal
 * @param string $type
 * @return string
 */
function getDealType($type, $small = false) {
    switch ($type) {
        case 'deal' :
            return lang('help_deal');
            break;
        case 'bon-de-réduction' :
            if ($small == true) {
                return lang('help_coupon');
            } else {
                return lang('help_coupon_full');
            }
            break;
        case 'bon-plan' :
            return lang('help_bon_plan');
            break;
    }
}

/**
 * Retourne l'icone pour les types de deal
 * 
 * @param string $type
 * @return string
 */
function getDealTypeIcon($type) {
    switch ($type) {
        case 'deal' :
            return 'fa fa-credit-card';
            break;
        case 'bon-de-réduction' :
            return 'fa fa-tags';
            break;
        case 'bon-plan' :
            return 'fa fa-comments';
            break;
    }
}

/**
 * Retourne le nom de l'action pour un type de deal
 * 
 * @param string $type
 * @return string
 */
function getDealTypeAction($type) {
    switch ($type) {
        case 'deal' :
            return lang('help_buy_online');
            break;
        case 'bon-de-réduction' :
            return lang('help_print_coupon');
            break;
        case 'bon-plan' :
            return lang('help_quotation');
            break;
    }
}

/**
 * Retourne l'icon de l'action pour un type de deal
 * 
 * @param string $type
 * @return string
 */
function getDealTypeActionIcon($type) {
    switch ($type) {
        case 'deal' :
        case 'pass' :
            return 'fa fa-shopping-cart';
            break;
        case 'bon-de-réduction' :
            return 'fa fa-print';
            break;
        case 'bon-plan' :
            return 'fa fa-edit';
            break;
    }
}

/**
 * Target
 * 
 * @param int $target_id
 */
function getTarget($target_id) {
    switch ($target_id) {
        case 1 :
            return lang('help_target_1');
            break;
        case 2 :
            return lang('help_target_2');
            break;
        case 3 :
            return lang('help_target_3');
            break;
        case 4 :
            return lang('help_target_4');
            break;
        case 5 :
            return lang('help_target_5');
            break;
        default :
            return lang('help_target_6');
            break;
    }
}

/**
 * Validity
 * 
 * @param int $validity_id
 */
function getValidity($validity_id, $date) {
    switch ($validity_id) {
        case 1 :
            return lang('help_validity_1');
            break;
        case 2 :
            return lang('help_validity_2');
            break;
        case 3 :
            return lang('help_validity_3');
            break;
        case 4 :
            return lang('help_validity_4') . ' : ' . $date;
            break;
        case 5 :
            return lang('help_validity_5');
            break;
        default :
            return lang('help_validity_6');
            break;
    }
}

/**
 * Validity
 * 
 * @param int $appointment_id
 */
function getAppointement($appointment_id) {
    switch ($appointment_id) {
        case 1 :
            return lang('help_appointment_1');
            break;
        case 2 :
            return lang('help_appointment_2');
            break;
        case 3 :
            return lang('help_appointment_3');
            break;
        default :
            return lang('help_appointment_4');
            break;
    }
}

/**
 * Check image file in BDD, before without .jpg, now with the extension to expand possibilities
 * 
 * @param string $image
 * @param string $category_id
 * @return string
 */
function checkImageExtension($image, $category_id = false) {
    if (strpos(strtolower($image), '.png') || strpos(strtolower($image), '.gif') || strpos(strtolower($image), '.jpg') || strpos(strtolower($image), '.bmp')) {
        return $image;
    } else {
        return 'categories/' . $category_id . '/' . $image . '.jpg';
    }
}

/**
 * Gestion des notifications 
 * 
 * @param string $notif
 * @return array
 */
function getNotif($notif, $url = false) {
    $ci = get_instance();
    switch ($notif) {
        case 'account_created' :
            return array(
                'text' => lang('help_notif_account_created') . $ci->load->view('scripts/facebook_pixel', array('action' => 'CompleteRegistration'), true) . $ci->load->view('scripts/adwords_pixel', array('action' => 'CompleteRegistration'), true),
                'class' => 'success'
            );
            break;
        case 'connected' :
            return array(
                'text' => lang('help_notif_connected'),
                'class' => 'success'
            );
            break;
        case 'logout_complete' :
            return array(
                'text' => lang('help_notif_logout_complete'),
                'class' => 'danger'
            );
            break;
        case 'newsletter_bad' :
            return array(
                'text' => lang('help_notif_newsletter_bad'),
                'class' => 'danger'
            );
            break;
        case 'newsletter_ok' :
            return array(
                'text' => lang('help_notif_newsletter_ok'),
                'class' => 'success'
            );
            break;
        case'message_sended' :
            return array(
                'text' => lang('help_notif_message_sended'),
                'class' => 'success'
            );
            break;
        case'message_sended' :
            return array(
                'text' => lang('help_notif_message_sended'),
                'class' => 'success'
            );
            break;
        case 'bad_favorite' :
            return array(
                'text' => lang('help_notif_bad_favorite'),
                'class' => 'danger'
            );
            break;
        case 'favorite_access_required' :
            return array(
                'text' => lang('help_notif_favorite_access_required'),
                'class' => 'danger'
            );
            break;
        case 'store_exists' :
            return array(
                'text' => lang('help_notif_store_exists'),
                'class' => 'danger'
            );
            break;
        case 'bad_store' :
            return array(
                'text' => lang('help_notif_bad_store'),
                'class' => 'danger'
            );
            break;
        case 'unknown' :
            return array(
                'text' => lang('help_notif_unknown'),
                'class' => 'danger'
            );
            break;
        case 'review_added' :
            return array(
                'text' => lang('help_notif_review_added'),
                'class' => 'success'
            );
            break;
        case 'coupon_connect' :
            return array(
                'text' => lang('help_notif_coupon_connect'),
                'class' => 'danger'
            );
            break;
        case 'access_required' :
            return array(
                'text' => lang('help_notif_access_required'),
                'class' => 'danger'
            );
            break;
        case 'boost_paid' :
            return array(
                'text' => lang('help_notif_boost_paid') . $ci->load->view('scripts/facebook_pro_pixel', array('action' => 'Purchase', 'value' => $_GET['amount']), true) . $ci->load->view('scripts/adwords_pixel', array('action' => 'PurchasePro', 'value' => $_GET['amount']), true),
                'class' => 'success'
            );
            break;
        case 'payment_canceled' :
            return array(
                'text' => lang('help_notif_payment_canceled'),
                'class' => 'info'
            );
            break;
        case 'deal_paid' :
            return array(
                'text' => lang('help_notif_deal_paid') . $ci->load->view('scripts/facebook_pro_pixel', array('action' => 'Purchase', 'value' => $_GET['amount']), true) . $ci->load->view('scripts/adwords_pixel', array('action' => 'PurchasePro', 'value' => $_GET['amount']), true),
                'class' => 'success'
            );
            break;
        case 'print_blocked' :
            return array(
                'text' => lang('help_notif_print_blocked'),
                'class' => 'danger'
            );
            break;
        case 'deal_ended' :
            return array(
                'text' => lang('help_notif_deal_ended'),
                'class' => 'danger'
            );
            break;
        case 'action_ok' :
            return array(
                'text' => lang('help_notif_action_ok'),
                'class' => 'success'
            );
            break;
        case 'product_added' :
            return array(
                'text' => lang('help_notif_product_added'),
                'class' => 'success'
            );
            break;
        case 'phone_ok' :
            return array(
                'text' => lang('help_notif_phone_ok'),
                'class' => 'success'
            );
            break;
        case 'quotation_sended' :
            return array(
                'text' => lang('help_notif_quotation_sended'),
                'class' => 'success'
            );
            break;
        case 'error_form' :
            return array(
                'text' => lang('help_notif_error_form'),
                'class' => 'danger'
            );
            break;
        default :
            return false;
            break;
    }
}

/**
 * Check the currency position before / after 190E / $190
 * @param int $price
 * @return string
 */
function priceToShow($price) {
    $ci =& get_instance();
    if ($ci->config->item('currency_position') == 'before') {
        return $ci->config->item('currency') . $price;
    } else {
        return $price . $ci->config->item('currency');
    }
}

?>