<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Folder application/helpers
 */

// all_helper.php
$lang['help_deal'] = "Deal Online";
$lang['help_coupon'] = "Coupon";
$lang['help_coupon_full'] = "Coupon to print";
$lang['help_bonplan'] = "Offer";

$lang['help_buy_online'] = "Buy online";
$lang['help_print_coupon'] = "Print the coupon";
$lang['help_quotation'] = "Online quote";

$lang['help_target_1'] = "Everybody";
$lang['help_target_2'] = "Men and women";
$lang['help_target_3'] = "Women only";
$lang['help_target_4'] = "Men only";
$lang['help_target_5'] = "Children only";
$lang['help_target_6'] = "For all";

$lang['help_validity_1'] = "maximum 90 days after purchase (online deal) / coupon printing (coupons to be printed)";
$lang['help_validity_2'] = "maximum 60 days after purchase (online deal) / coupon printing (coupons to be printed)";
$lang['help_validity_3'] = "maximum 30 days after purchase (online deal) / coupon printing (coupons to be printed)";
$lang['help_validity_4'] = "specific date";
$lang['help_validity_5'] = "All the time";
$lang['help_validity_6'] = "Unspecified";

$lang['help_appointment_1'] = "Without an appointment";
$lang['help_appointment_2'] = "Required appointment";
$lang['help_appointment_3'] = "Mandatory reservation";
$lang['help_appointment_4'] = "Unspecified";

// NOTIFICATIONS
$lang['help_notif_account_created'] = '<h3><i class="fa fa-user"></i> Your account has been created ! </h3> <p> Now you can add offers to your favorites.</p>';
$lang['help_notif_connected'] = '<h3><i class="fa fa-lock"></i> You are connected !</h3>';
$lang['help_notif_logout_complete'] = '<h3><i class="fa fa-unlock"></i> You have been logged out !</h3>';
$lang['help_notif_newsletter_bad'] = '<h3><i class="fa fa-exclamation-triangle"></i> You are already subscribed to our newsletter !</h3>';
$lang['help_notif_newsletter_ok'] = '<h3><i class="fa fa-envelope"></i> You are now registered in the newsletter !</h3><p>You will soon receive '.SITE_NAME.'\'s best deals</p>';
$lang['help_notif_message_sended'] = '<h3><i class="fa fa-envelope"></i> Your message has been sent !</h3><p>Thank you for your message, we will reply as soon as possible.</p>';
$lang['help_notif_message_sended'] = '<h3><i class="fa fa-envelope"></i> Your message has been sent !</h3><p>Thank you for your message, we will reply as soon as possible.</p>';
$lang['help_notif_bad_favorite'] = '<h3><i class="fa fa-exclamation-triangle"></i> You must create an account to add this tip to your favorites !</h3><p><strong>"Favoris"</strong> area allows you to store various offers on your personal space in order to keep them aside for later and find them easily.</p>';
$lang['help_notif_favorite_access_required'] = '<h3><i class="fa fa-exclamation-triangle"></i> You must create an account to add this tip to your favorites !</h3><p><strong>"Favoris"</strong> area allows you to store various offers on your personal space in order to keep them aside for later and find them easily.</p>';
$lang['help_notif_store_exists'] = '<h3><i class="fa fa-exclamation-triangle"></i> Your shop already exists !</h3><p>The email address entered indicates that your business already exists, <a href="' . base_url('store/signin') . '">please sign in</a> o add new good deals to your store.</p><p><a href="' . base_url('store/signin') . '" class="btn">Go to login</a></p>';
$lang['help_notif_bad_store'] = '<h3><i class="fa fa-exclamation-triangle"></i> The shop does not exist !</h3><p>It is possible that this shop has been removed from '.SITE_NAME.'</p>';
$lang['help_notif_unknown'] = '<h3><i class="fa fa-exclamation-triangle"></i> Unknown error !</h3><p>An error has occurred, please excuse us. You can retry your last action or contact us if the problem persists.</p>';
$lang['help_notif_review_added'] = '<h3><i class="fa fa-check"></i> Comment added !</h3><p>Thank you for your comment. <span class="hidden"> Our team will analyze your appreciation before publishing on the site.</span></p>';
$lang['help_notif_coupon_connect'] = '<h3><i class="fa fa-exclamation-triangle"></i> You must be logged in !</h3><p>Please login to your online account to access your coupon. If you do not remember your credentials, check your emails and your SPAM or unwanted box to find the '.SITE_NAME.' email that tells you that your account has been created. If you do not have an account, <a href="' . base_url('users/signup') . '">click here to sign up</a>.</p>';
$lang['help_notif_access_required'] = '<h3><i class="fa fa-exclamation-triangle"></i> You must be logged in !</h3><p>Please log in to your online account to access this section. If you do not remember your credentials, check your emails and your SPAM or unwanted box to find the '.SITE_NAME.' email that tells you that your account has been created.</p>';
$lang['help_notif_boost_paid'] = '<h3><i class="fa fa-check"></i> Boost paid !</h3><p>Thank you for your payment. Your boost is taken into account, we will process it as soon as possible, you will be informed by email of its taking into account. Monitor your statistics to see the evolution of your visits / sales. You can add another boost if you wish.</p>';
$lang['help_notif_payment_canceled'] = '<h3><i class="fa fa-exclamation-triangle"></i> A problem during the payment ?</h3><p>Payment via Paypal is secure, your bank information is secure.</p>';
$lang['help_notif_deal_paid'] = '<h3><i class="fa fa-check"></i> Payment validated !</h3><p>Thank you for your payment. Your offer / coupon to print is now awaiting validation by our team. You will be informed of its upload by email.</p>';
$lang['help_notif_print_blocked'] = '<h3><i class="fa fa-exclamation-triangle"></i> You must be logged in !</h3><p>In order to be able to print coupons, you must create a FREE '.SITE_NAME.' account or <a href="' . base_url('users/signin') . '">login to your account</a> if you are already registered.</p>';
$lang['help_notif_deal_ended'] = '<h3><i class="fa fa-exclamation-triangle"></i> Offer not available !</h3><p>It is possible that this good plan is no longer available, that it has been deleted by the merchant or that it requires a validation of the '.SITE_NAME.' team.</p>';
$lang['help_notif_action_ok'] = '<h3><i class="fa fa-check"></i> Action validated !</h3><p>Your last action was successfully completed.</p>';
$lang['help_notif_product_added'] = '<h3><i class="fa fa-check"></i> Offer added to cart !</h3><p>Your voucher has been added to your cart. You can either continue your search for great deals on the site, or finalize your order by clicking on "order".</p>';
$lang['help_notif_phone_ok'] = '<h3><i class="fa fa-check"></i> We will call you !</h3><p>Thank you for your request, we will call you in the indicated time slot.</p>';
$lang['help_notif_quotation_sended'] = '<h3><i class="fa fa-check"></i> Request quote sent !</h3><p>Thank you for your quote request, the merchant will come back to you by email or phone quickly.</p>';
$lang['help_notif_error_form'] = '<h3><i class="fa fa-exclamation-triangle"></i> Error on form !</h3><p>An error occurred while validating your form. Thank you for repeating.</p>';

// ALL
$lang['start'] = 'Start';
$lang['end'] = 'End';