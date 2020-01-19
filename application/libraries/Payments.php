<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Payments gateway
 */
class Payments {

    private $ci;
    private $gateway;
    private $data;

    /**
     * Constructor
     * 
     * @param string $gateway "paypal" or "2checkout"
     */
    public function __construct($credentials = array()) {
        $this->ci =& get_instance();
        if (!isset($credentials['gateway'])) {
            die('Specify gateway please !');
        }
        $this->gateway = $credentials['gateway'];
        // Load libs
        switch ($this->gateway) {
            case 'paypal' :
                // Load Lib
                //$this->ci->load->library('paypal', array('sandbox_status' => $this->config->item('paypal_debug')));
                   // die('ok3');
                break;
            case '2checkout' :
                // Load lib
                require_once(APPPATH . 'libraries/twocheckout/Twocheckout.php');
                // Config 2checkout
                if ($this->ci->config->item('2checkout_debug') == true) {
                    // Sandbox mode
                    Twocheckout::sandbox(true);
                    Twocheckout::sellerId($this->ci->config->item('2checkout_dev_seller_id'));
                    Twocheckout::privateKey($this->ci->config->item('2checkout_dev_private_key'));
                } else {
                    Twocheckout::sandbox(false);
                    Twocheckout::sellerId($this->ci->config->item('2checkout_seller_id'));
                    Twocheckout::privateKey($this->ci->config->item('2checkout_private_key'));
                    die;
                }
                break;
        }
    }

    /**
     * Initiate a payment
     * @param array $datas
     */
    public function iniatePayment($datas) {
        switch ($this->gateway) {
            case 'paypal' :
                $this->createLinkPaypal($datas);
                break;
            case '2checkout' :
                $this->createLink2Checkout($datas);
                break;
        }
    }

    /**
     * Validate a payment
     * @param array $datas
     */
    public function validatePayment($datas, $type, $boost_type = false) {
        switch ($this->gateway) {
            case 'paypal' :
                return array($this->validatePaypal($datas, $type, $boost_type), $datas['L_PAYMENTREQUEST_0_NUMBER0'], $datas['PAYMENTREQUEST_0_AMT']);
                break;
            case '2checkout' :
                return array($this->validate2checkout($datas, $type, $boost_type), $datas['li_0_product_id'], $datas['total']);
                break;
        }
    }

    /**
     * Create link for paypal
     * @param array $datas
     */
    private function createLinkPaypal($datas) {
        // Datas
        $to_buy = array(
            'desc' => $datas['title'],
            'currency' => $this->ci->config->item('currency_code'),
            'type' => 'Sole',
            'return_URL' => $datas['return_url'],
            'cancel_URL' => $datas['cancel_url'],
            'landing' => 'Billing',
            'firstname' => $datas['order_firstname'] . ' ' . $datas['order_lastname'],
            'email' => $datas['order_email'],
            'address' => $datas['order_address'],
            'city' => $datas['order_city'],
            'zipcode' => $datas['order_zipcode'],
            'phone' => $datas['order_phone'],
            'country_code' => $this->ci->config->item('country_code'),
            'brandname' => SITE_NAME,
            'logo' => base_url(isset($this->ci->config->item('admin')['logo']) ? 'assets/uploads/logo.png' : 'assets/images/logo.png'),
            'get_shipping' => false);
        if (isset($datas['tax_amount'])) {
            $to_buy['tax_amount'] = $datas['tax_amount'];
        }

        $temp_product = array(
            'name' => $datas['order_firstname'] . ' ' . $datas['order_lastname'],
            'desc' => $datas['order_informations'],
            'number' => $datas['orders_id'],
            'quantity' => 1,
            'amount' => $datas['order_amount']);

        // add product to main $to_buy array
        $to_buy['products'][] = $temp_product;

        // enquire Paypal API for token
        $set_ec_return = $this->ci->paypal->set_ec($to_buy);

        if (isset($set_ec_return['ec_status']) && ($set_ec_return['ec_status'] === true)) {
            // redirect to Paypal
            $this->ci->paypal->redirect_to_paypal($set_ec_return['TOKEN']);
        } else {
            redirect(base_url('?notif=unknown'));
        }
    }

    private function createLink2Checkout($datas) {
        //Setup the checkout parameters
        $args = array(
            'sid' => ($this->ci->config->item('2checkout_debug') == true ? $this->ci->config->item('2checkout_dev_seller_id') : $this->ci->config->item('2checkout_seller_id')),
            'private_key' => ($this->ci->config->item('2checkout_debug') == true ? $this->ci->config->item('2checkout_dev_private_key') : $this->ci->config->item('2checkout_private_key')),
            'mode' => "2CO",
            'li_0_name' => $datas['title'],
            'li_0_price' => $datas['order_amount'],
            'li_0_product_id' => $datas['orders_id'],
            'merchant_order_id' => $datas['orders_id'],
            'x_receipt_link_url' => $datas['return_url'],
            'currency_code' => $this->ci->config->item('currency_code'),
            'street_address' => $datas['order_address'],
            'city' => $datas['order_city'],
            'zip' => $datas['order_zipcode'],
            'phone' => $datas['order_phone'],
            'email' => $datas['order_email'],
            'last_name' => $datas['order_lastname'],
            'first_name' => $datas['order_firstname'],
            'country' => $this->ci->config->item('country_code'),
            'state' => $this->ci->config->item('country_code')
        );
        if (isset($datas['tax_amount'])) {
            $args['li_1_type'] = 'tax';
            $args['li_1_price'] = $datas['tax_amount'];
        }

        // Pass the buyer and the parameters to the checkout
        Twocheckout_Charge::redirect($args);
    }

    /**
     * Validate Paypal Transaction
     * 
     * @param array $datas
     */
    private function validatePaypal($datas, $type, $boost_type) {
        // we are back from Paypal. We need to do GetExpressCheckoutDetails
        // and DoExpressCheckoutPayment to complete.
        $token = $datas['token'];
        $payer_id = $datas['PayerID'];
        // GetExpressCheckoutDetails
        $get_ec_return = $this->ci->paypal->get_ec($token);
        if (isset($get_ec_return['ec_status']) && ($get_ec_return['ec_status'] === true)) {
            $ec_details = array(
                'token' => $token,
                'payer_id' => $payer_id,
                'currency' => $this->ci->config->item('currency_code'),
                'amount' => $get_ec_return['PAYMENTREQUEST_0_AMT'],
                'IPN_URL' => site_url('users/order_confirmed'),
                // in case you want to log the IPN, and you
                // may have to in case of Pending transaction
                'type' => 'Sale');


            // DoExpressCheckoutPayment
            $do_ec_return = $this->ci->paypal->do_ec($ec_details);
            if (isset($do_ec_return['ec_status']) && ($do_ec_return['ec_status'] === true)) {
                // Validation de la commande en DB
                if (isset($get_ec_return['L_PAYMENTREQUEST_0_NUMBER0'])) {
                    switch ($type) {
                        /**
                         * A deal online paid by a customer
                         */
                        case 'deal_online' :
                            // DB Confirm
                            $this->ci->orders->confirmPayment($get_ec_return['L_PAYMENTREQUEST_0_NUMBER0']);

                            // Vide le cart
                            if ($this->ci->users->isLogged()) {
                                $this->ci->users_cart->cleanCart($this->ci->session->userdata('id'));
                            }
                            $this->ci->session->unset_userdata('cart');

                            // Send emails
                            $this->ci->emailDealSold($get_ec_return['L_PAYMENTREQUEST_0_NUMBER0'], $get_ec_return['PAYMENTREQUEST_0_AMT']);
                            break;
                        /**
                         * A deal paid by a pro "bon-de-reduction" / "quotation"
                         */
                        case 'deal' :
                            $this->validateDealPayedByPro($get_ec_return['L_PAYMENTREQUEST_0_NUMBER0'], $get_ec_return['PAYMENTREQUEST_0_AMT']);
                            break;
                        /**
                         * A boost paid by a pro
                         */
                        case 'boost' :
                            $this->validateBoostPayedByPro($boost_type, $get_ec_return['L_PAYMENTREQUEST_0_NUMBER0'], $get_ec_return['PAYMENTREQUEST_0_AMT']);
                            break;
                    }
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Validate 2checkout Transaction
     * 
     * @param array $datas
     */
    private function validate2checkout($datas, $type, $boost_type) {
        //Assign the returned parameters to an array.
        $params = array();
        foreach ($datas as $k => $v) {
            $params[$k] = $v;
        }
        //Check the MD5 Hash to determine the validity of the sale.
        $passback = Twocheckout_Return::check($params, $this->ci->config->item('2checkout_dev_secret_word'), 'array');
    
        // Success
        if ($passback['response_code'] == 'Success' || $passback['code'] == 'Success') {
            $amount = $params['total'];
            $deal_id = $params['li_0_product_id'];

            switch ($type) {
                /**
                 * A deal online paid by a customer
                 */
                case 'deal_online' :
                    // DB Confirm
                    $this->data['order'] = $this->ci->orders->confirmPayment($deal_id);

                    // Empty cart
                    if ($this->ci->users->isLogged()) {
                        $this->ci->users_cart->cleanCart($this->ci->session->userdata('id'));
                    }
                    $this->ci->session->unset_userdata('cart');
                    $this->emailDealSold($deal_id, $amount);
                    break;
                /**
                 * A deal paid by a pro "bon-de-reduction" / "quotation"
                 */
                case 'deal' :
                    $this->validateDealPayedByPro($deal_id, $amount);
                    break;
                /**
                 * A boost paid by a pro
                 */
                case 'boost' :
                    $this->validateBoostPayedByPro($boost_type, $deal_id, $amount);
                    break;
            }

            return true;
        } else {
            return false;
        }
    }

    /**
     * Validate a deal payed by a pro
     * 
     * @param int $deal_id
     * @param int $amount
     */
    private function validateDealPayedByPro($deal_id, $amount) {

        $deal = $this->ci->deals->getDeal($deal_id);
        switch ($deal->type_deal) {
            case 'bon-de-réduction' :
                $coupons = $amount / (($this->ci->config->item('admin')['coef_taxe'] / 100) + 1) / ($deal->price_promo * $this->ci->config->item('admin')['coef_coupons']) * 100;
                $description = $coupons . ' coupons to print';
                break;
            case 'bon-plan' :
                $coupons = $amount / (($this->ci->config->item('admin')['coef_taxe'] / 100) + 1) / $this->ci->config->item('admin')['coef_quotation'] * 100;
                $description = $coupons . ' online quotation';
                break;
        }

        $this->ci->deals->update(array('id' => $deal_id), array('coupons' => $deal->coupons + $coupons));

        $this->ci->deals->confirmPayment($deal_id);

        // Order PRO
        $this->ci->users_pro_orders->add(array(
            'users_pro_id' => $deal->users_pro_id,
            'deals_id' => $deal_id,
            'users_pro_orders_amount' => $amount,
            'users_pro_orders_description' => $description,
            'users_pro_orders_paid' => 1
        ));

        // Envoi du mail
        $this->ci->load->library('mailing');
        // Envoi email notif admin
        $this->ci->mailing->admin_notif(array(
            'notif' => 'PRO bought : ' . $description . ' => ' . $amount . $this->ci->config->item('currency'),
            'content' => '<a href="' . routeDeal($deal->id, $deal->title) . '">' . $deal->title . '</a> => ' . $amount . $this->ci->config->item('currency')
        ));
    }

    private function validateBoostPayedByPro($boost_type, $boost_id, $amount) {
        // Validation de la commande en DB
        if (isset($boost_id)) {
            switch ($boost_type) {
                case 'social' :
                    $this->ci->boosts_social->confirmPayment($boost_id);
                    $description = lang('ctrl_boost_social');
                    break;
                case 'zotdeal' :
                    $this->ci->boosts_zotdeal->confirmPayment($boost_id);
                    $description = lang('ctrl_boost_site');
                    break;
                case 'newsletter' :
                    $this->ci->boosts_newsletter->confirmPayment($boost_id);
                    $description = lang('ctrl_boost_newsletter');
                    break;
            }
            // TODO : Send email
            // Order PRO
            $this->ci->users_pro_orders->add(array(
                'users_pro_id' => $this->ci->session->userdata('pro_id'),
                'users_pro_orders_boost_type' => $boost_type,
                'users_pro_orders_boost_id' => $boost_id,
                'users_pro_orders_amount' => $amount,
                'users_pro_orders_description' => $description,
                'users_pro_orders_paid' => 1
            ));

            // Envoi du mail
            $this->ci->load->library('mailing');
            // Envoi email notif admin
            $this->ci->mailing->admin_notif(array(
                'notif' => 'PRO Bought : ' . $description . ' => ' . $amount . $this->ci->config->item('currency'),
                'content' => $description
            ));
        }
    }

        /**
         * Confirmation email deal sold
         * 
         * @param int $deal_id
         * @param int $amount
         */
        private function emailDealSold($deal_id, $amount) {

            $this->data['order'] = $this->ci->orders->getOrder($deal_id);
            $this->ci->load->library('mailing');
            $this->ci->mailing->coupon(array(
                'email' => $this->data['order']->order_email,
                'order_id' => $this->data['order']->order_id
            ));
            $users_pro = $this->ci->users_pro->getUser(array('id' => $this->data['order']->users_pro_id));
            // Envoi du mail
            $this->ci->load->library('mailing');
            // Envoi email notif PRO
            $this->ci->mailing->new_sale(array(
                'email' => $users_pro->email,
                'order' => $this->data['order']
            ));
            // Envoi email notif admin
            $this->ci->mailing->admin_notif(array(
                'notif' => 'Deal bought : ' . $this->data['order']->title . ' => ' . $amount . $this->ci->config->item('currency'),
                'content' => '<a href="' . routeDeal($this->data['order']->id, $this->data['order']->title) . '">' . $this->data['order']->title . '</a> => ' . $amount . $this->ci->config->item('currency')
            ));
        }

    }
    