<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    private $data;

    /**
     * Login
     */
    public function signin() {
        if (!empty($_POST)) {
            $logged = $this->login();
            if ($logged == false) {
                $this->data['error'] = true;
            } else {
                redirect(base_url('?notif=connected'));
            }
        }
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'users/signin', $this->data);
        $this->template->render();
    }

    /**
     * Renew pass
     */
    public function renew_password() {
        // Load
        $this->load->helper('string');
        if (!empty($_POST)) {
            // Check email exists
            $where = array('email' => $this->input->post('email'));
            $user_exists = $this->users->getUserWhere($where);
            if ($user_exists) {
                // Update
                $pass = random_string();
                $this->users->updateUser($where, array('password' => sha1(md5($pass))));
                // Mail
                $this->load->library('mailing');
                $this->mailing->renew_password(array(
                    'email' => $this->input->post('email'),
                    'password' => $pass
                ));
                $this->data['success'] = true;
            } else {
                // Error
                $this->data['error'] = true;
            }
        }
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'users/renew_password', $this->data);
        $this->template->render();
    }

    /**
     * Login de l'user
     *
     * @return boolean
     */
    private function login() {
        // Tentative de connection
        $logged = $this->users->login($this->input->post('email'), $this->input->post('password'));
        if ($logged) {

            $this->session->set_userdata('id', $logged->id);
            $this->session->set_userdata('name', $logged->name);
            $this->session->set_userdata('email', $logged->email);

            return true;
        } else {
            return false;
        }
    }

    /**
     * Déconnexion
     */
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url('?notif=logout_complete'));
    }

    /**
     * Login
     */
    public function signup($redirect = true) {
        // Loading
        $this->load->library('recaptcha');
        $this->load->library('form_validation');
        if (!empty($_POST)) {
            // Validations
            $validationConfig = array(
                array(
                    'field' => 'name',
                    'label' => lang('names'),
                    'rules' => 'trim|required|min_length[5]|max_length[255]'
                ),
                array(
                    'field' => 'password',
                    'label' => lang('password'),
                    'rules' => 'trim|required|min_length[5]|max_length[255]'
                ),
                array(
                    'field' => 'email',
                    'label' => lang('email'),
                    'rules' => 'trim|required|valid_email|is_unique[users.email]|min_length[5]|max_length[255]'
                ),
                array(
                    'field' => 'phone',
                    'label' => lang('phone'),
                    'rules' => 'trim|numeric|max_length[10]'
                ),
                array(
                    'field' => 'password_confirm',
                    'label' => lang('ctrl_password_confirm'),
                    'rules' => 'trim|required|matches[password]'
                ),
                array(
                    'field' => 'legal',
                    'label' => lang('ctrl_accept_legal'),
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($validationConfig);
            // Validation du captcha
            if ($redirect == true) {
                $captchaOk = $this->recaptcha->checkCaptcha($this->input->post('g-recaptcha-response'));
            }

            if ($this->form_validation->run() == true && ($redirect == false || $captchaOk == true)) {
                // Insertion BDD
                $this->users->add(array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'password' => sha1(md5($this->input->post('password'))),
                    'newsletter' => $this->input->post('newsletter'),
                    'legal' => $this->input->post('legal')
                ));

                // Envoi du mail
                $this->load->library('mailing');
                $this->mailing->signup($this->input->post());
                // Login
                $this->login();
                // Inscription newsletter sendinblue
                $this->newsletter();

                if ($redirect == true) {
                    redirect(base_url('?notif=account_created'));
                }
            } else {
                // Erreurs
                $this->data['captchaOk'] = $captchaOk;
            }
        }
        if ($redirect == true) {
            $this->data['scripts_to_load'] = array('users/signup' . MIN_FILE);
            $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
            $this->template->write_view('content', 'users/signup', $this->data);
            $this->template->render();
        }
    }

    /**
     * Favoris
     */
    public function favorites() {
        $users_id = $this->session->userdata('id');
        if ($users_id) {
            $this->data['deals'] = $this->users_favorites->getForUser($users_id);
            $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
            $this->template->write_view('content', 'users/favorites', $this->data);
            $this->template->render();
        } else {
            redirect(base_url('users/signup?notif=favorite_access_required'));
        }
    }

    /**
     * Panier d'achat
     */
    public function cart() {
        $this->check_cart();
        $this->data['scripts_to_load'] = array('users/cart' . MIN_FILE);
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'users/cart', $this->data);
        $this->template->render();
    }

    /**
     * Mes coupons
     */
    public function coupons() {
        $users_id = $this->session->userdata('id');
        if ($users_id) {
            $this->data['deals'] = $this->orders->getForUser($users_id, true);
            $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
            $this->template->write_view('content', 'users/coupons', $this->data);
            $this->template->render();
        } else {
            redirect(base_url('users/signin?notif=access_required'));
        }
    }

    /**
     * Génération d'un coupon
     */
    public function coupon($order_id) {
        $this->data['order'] = $this->orders->getOrder($order_id);
        if ($this->data['order'] && $this->data['order']->users_id == $this->session->userdata('id')) {
            if ($this->data['order']->order_paid == 1) {
                $this->data['deal'] = $this->deals->getDeal($this->data['order']->deals_id);
                $this->data['no_header'] = true;
                $this->data['no_footer'] = true;
                $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
                $this->template->write_view('content', 'users/coupon', $this->data);
                $this->template->render();
            } else {
                redirect('?notif=unknown');
            }
        } else {
            redirect('users/signin?notif=coupon_connect');
        }
    }

    /**
     * Commande
     */
    public function billing() {
        $this->load->library('form_validation');
        $this->load->helper('string');

        // Récupère le cart
        $this->check_cart();

        if (!empty($_POST)) {
            // Validations
            $validationConfig = array(
                array(
                    'field' => 'email',
                    'label' => lang('email'),
                    'rules' => 'trim|required|valid_email|' . ($this->users->isLogged() ? '' : 'is_unique[users.email]|') . 'min_length[5]|max_length[255]'
                ),
                array(
                    'field' => 'firstname',
                    'label' => lang('firstname'),
                    'rules' => 'trim|required|min_length[2]|max_length[255]'
                ),
                array(
                    'field' => 'lastname',
                    'label' => lang('lastname'),
                    'rules' => 'trim|required|min_length[2]|max_length[255]'
                ),
                array(
                    'field' => 'address',
                    'label' => lang('address'),
                    'rules' => 'trim|required|min_length[2]|max_length[255]'
                ),
                array(
                    'field' => 'zipcode',
                    'label' => lang('zipcode'),
                    'rules' => 'trim|required|min_length[2]|max_length[255]'
                ),
                array(
                    'field' => 'city',
                    'label' => lang('city'),
                    'rules' => 'trim|required|min_length[2]|max_length[255]'
                ),
                array(
                    'field' => 'phone',
                    'label' => lang('phone'),
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'information',
                    'label' => lang('ctrl_more_informations'),
                    'rules' => 'trim|max_length[1000]'
                ),
                array(
                    'field' => 'legal',
                    'label' => lang('ctrl_accept_legal'),
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($validationConfig);

            if ($this->form_validation->run() == true) {
                $total = 0;
                foreach ($this->data['deals'] as $deal) {
                    $total += $deal->price_promo;
                }
                // Enregistre + log l'user
                if (!$this->users->isLogged()) {
                    $_POST['name'] = $this->input->post('firstname') . ' ' . $this->input->post('lastname');
                    $_POST['password'] = $_POST['password_confirm'] = random_string();
                    $this->signup(false);
                }

                // Enregistre la commande
                $orders_id = $this->orders->add(array(
                    'order_firstname' => $this->input->post('firstname'),
                    'order_lastname' => $this->input->post('lastname'),
                    'order_address' => $this->input->post('address'),
                    'order_zipcode' => $this->input->post('zipcode'),
                    'order_city' => $this->input->post('city'),
                    'order_phone' => $this->input->post('phone'),
                    'order_email' => $this->input->post('email'),
                    'order_informations' => $this->input->post('informations'),
                    'order_amount' => $total,
                    'order_ip' => $_SERVER['REMOTE_ADDR'],
                    'users_id' => $this->users->isLogged() ? $this->session->userdata('id') : null
                ));

                // Ajout des deals
                if ($orders_id && $this->data['deals']) {
                    foreach ($this->data['deals'] as $deal) {
                        $this->orders_deals->add(array(
                            'orders_id' => $orders_id,
                            'deals_id' => $deal->deal_id,
                            'quantity' => 1,
                            'code' => random_string()
                        ));
                    }

                    redirect(base_url('users/payment/' . $orders_id));
                } else {
                    redirect(base_url('?notif=unknown'));
                }
            }
        }
        $this->data['scripts_to_load'] = array('users/billing' . MIN_FILE);
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'users/billing', $this->data);
        $this->template->render();
    }

    /**
     * Paiement d'une commande
     *
     * @param int $orders_id
     */
    public function payment($orders_id) {
        if ($orders_id) {
            $this->check_cart();
            $order = $this->orders->getOrder($orders_id);
            $order2Payment = array(
                'title' => lang('ctrl_paypal_title_order'),
                'order_amount' => $order->order_amount,
                'orders_id' => $orders_id,
                'order_address' => $order->order_address,
                'order_city' => $order->order_city,
                'order_zipcode' => $order->order_zipcode,
                'order_phone' => $order->order_phone,
                'order_firstname' => $order->order_firstname,
                'order_lastname' => $order->order_lastname,
                'order_informations' => $order->order_informations,
                'order_email' => $order->order_email,
                'return_url' => site_url('users/payment_done/' . $orders_id),
                'cancel_url' => site_url('store/pro?notif=payment_canceled')
            );
            // Load Libs
            $this->load->library('payments', array('gateway' => $this->config->item('payment_gateway')));
            $this->payments->iniatePayment($order2Payment);
        } else {
            redirect(base_url('?notif=unknown'));
        }
    }

    /**
     * Paiement validé
     *
     * @param int $orders_id
     */
    public function payment_done($orders_id) {
        $this->load->library('payments', array('gateway' => $this->config->item('payment_gateway')));
        list($isValid, $deal_id, $amount) = $this->payments->validatePayment($_REQUEST, 'deal_online');

        if ($isValid) {
            // Payment valid
            $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
            $this->template->write_view('content', 'users/payment_done', $this->data);
            $this->template->render();
        } else {
            // Bug payment
            redirect(base_url('?notif=unknown'));
        }
    }

    /**
     * Paiement annulé
     * @param int $orders_id
     */
    public function payment_canceled($orders_id) {
        $this->data['orders_id'] = $orders_id;
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'users/payment_canceled', $this->data);
        $this->template->render();
    }

    /**
     * Retourne les produits dans le cart
     */
    private function check_cart() {
        $users_id = $this->session->userdata('id');
        if ($users_id) {
            // User connected > DB
            $this->data['deals'] = $this->users_cart->getForUser($users_id);
        } else {
            // Guest > Session
            $deals = $this->session->userdata('cart');
            if ($deals) {
                $this->data['deals'] = $this->deals->getDeals(false, false, false, false, false, false, $deals);
            } else {
                $this->data['deals'] = array();
            }
        }
    }

    /**
     * Inscription newsletter Sendinblue
     */
    public function newsletter() {
        if (isset($_POST['email'])) {
            require(APPPATH . 'libraries/Sendinblue.php');
            $sendinblue = new Sendinblue("https://api.sendinblue.com/v2.0", $this->config->item('key_sendinblue'));
            if (isset($_POST['name'])) {
                $data['NAME'] = $this->input->post('name');
            }
            $data = array(
                "email" => $this->input->post('email'),
                "listid" => array('2')
            );
            $sendinblue->create_update_user($data);

            // Si on arrive pas de l'inscription
            if (!isset($_POST['password'])) {
                redirect(base_url('?notif=newsletter_ok'));
            }
        } else {
            // Si on arrive pas de l'inscription
            if (!isset($_POST['password'])) {
                redirect(base_url('?notif=newsletter_bad'));
            }
        }
    }

    /**
     * Impression d'un coupon
     *
     * @param int $deals_id
     */
    public function print_promo($deals_id) {
        if ($deals_id) {
            // TODO : Gérer le cas où l'user a déjà imprimé le coupon, il doit pouvoir le ré-imprimer (valeur fictive dans le model p-e ? pour gérer tous les cas d'un coup)
            if ($this->coupons_printed->getRemaining($deals_id) > 0) {
                $this->coupons_printed->addPrint($deals_id);
                $this->data['deal'] = $this->deals->getDeal($deals_id);
                $this->data['no_header'] = true;
                $this->data['no_footer'] = true;
                $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
                $this->template->write_view('content', 'users/print_promo', $this->data);
                $this->template->render();
            } else {
                redirect('?notif=unknown');
            }
        } else {
            redirect('?notif=unknown');
        }
    }

    /**
     * Inbox du membre
     */
    public function inbox() {
        if ($this->users->isLogged()) {
            $this->data['inbox'] = $this->inbox->getFeedUser($this->session->userdata('id'));

            $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
            $this->template->write_view('content', 'users/inbox', $this->data);
            $this->template->render();
        } else {
            redirect(base_url('users/signin?notif=access_required'));
        }
    }

    /**
     * Messages echangés avec un pro
     */
    public function messages($users_pro_id) {
        // Loading
        $this->load->library('recaptcha');
        $this->load->library('form_validation');

        // Nouveau message
        if (!empty($_POST) && $this->users->isLogged()) {
            // Validations
            $validationConfig = array(
                array(
                    'field' => 'message',
                    'label' => 'Message',
                    'rules' => 'trim|required|max_length[1000]'
                )
            );
            $this->form_validation->set_rules($validationConfig);
            // Validation du captcha
            $captchaOk = $this->recaptcha->checkCaptcha($this->input->post('g-recaptcha-response'));

            if ($this->form_validation->run() == true && $captchaOk == true) {
                // Save inbox
                $this->inbox->add(array(
                    'inbox_from_users_id' => $this->session->userdata('id'),
                    'inbox_to_users_pro_id' => $users_pro_id,
                    'inbox_content' => $this->input->post('message')
                ));
                // Send Email to PRO
                $this->load->library('mailing');
                $this->mailing->contact_store($this->input->post());
                $this->data['message_sended'] = true;
            } else {
                // Erreurs
                $this->data['captchaOk'] = $captchaOk;
            }
        }

        // Listing
        if ($this->users->isLogged() && $users_pro_id) {
            // Message Lu
            $this->inbox->setUserReaded($this->session->userdata('id'), $users_pro_id);
            // Infos listing
            $this->data['inbox'] = $this->inbox->getMessagesUsers($this->session->userdata('id'), $users_pro_id);
            $this->data['pro'] = $this->users_pro->getUser(array('id' => $users_pro_id));

            $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
            $this->template->write_view('content', 'users/messages', $this->data);
            $this->template->render();
        } else {
            redirect(base_url('users/signin?notif=access_required'));
        }
    }

}
