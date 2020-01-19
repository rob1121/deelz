<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Deals extends CI_Controller {

    private $data;

    /**
     * Ajouter un deal
     */
    public function add() {
        $this->load->library('form_validation');
        if (!empty($_POST)) {
            // Validations
            $validationConfig = array(
                array(
                    'field' => 'name',
                    'label' => 'Nom / Prénom',
                    'rules' => 'trim|required|min_length[5]|max_length[255]'
                ),
                array(
                    'field' => 'company',
                    'label' => 'Nom de votre société',
                    'rules' => 'trim|required|min_length[2]|max_length[255]'
                ),
                array(
                    'field' => 'phone',
                    'label' => 'Téléphone',
                    'rules' => 'trim|numeric|max_length[10]'
                ),
            );
            $this->form_validation->set_rules($validationConfig);

            if ($this->form_validation->run() == true) {
                // Envoi du mail
                $this->load->library('mailing');
                // Envoi email notif admin
                $this->mailing->admin_notif(array(
                    'notif' => 'Demande de rappel',
                    'content' => $this->input->post('name') . ' '
                    . '<br /><strong>Créneau :</strong> ' . $this->input->post('time') . ''
                    . '<br /><strong>Société :</strong> ' . $this->input->post('company') . ''
                    . '<br /><strong>Téléphone :</strong> ' . $this->input->post('phone')
                ));


                redirect(base_url('deals/add?notif=phone_ok'));
            }
        }

        // Add PRO deals from admin acount
        if ($this->session->userdata('role') == 'admin' && isset($_GET['pro'])) {
            $this->session->set_userdata('to_pro', $this->input->get('pro'));
        }

        $this->data['section_pro'] = true;
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'deals/add', $this->data);
        $this->template->render();
    }

    /**
     * Ajout d'un deal en ligne
     */
    public function add_online() {
        // Not active in ADMIN
        if (!isset($this->config->item('admin')['active_deal']) || $this->config->item('admin')['active_deal'] == 0) {
            redirect(base_url('deals/add'));
        }
        $this->session->set_userdata('process_id', time());
        $this->data['scripts_to_load'] = array('plugins/dropzone/dropzone.min', 'plugins/tinymce/tinymce.min', 'plugins/datepicker/picker', 'plugins/datepicker/picker.date', 'plugins/formvalidator', 'deals/process_v1.0.7' . MIN_FILE);
        $this->data['styles_to_load'] = array('plugins/dropzone/dropzone', 'plugins/datepicker/themes/default', 'plugins/datepicker/themes/default.date');
        $this->data['section_pro'] = true;
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'deals/add_online', $this->data);
        $this->template->render();
    }

    /**
     * Ajout d'un coupon de réduc
     */
    public function add_coupon() {
        // Not active in ADMIN
        if (!isset($this->config->item('admin')['active_coupon']) || $this->config->item('admin')['active_coupon'] == 0) {
            redirect(base_url('deals/add'));
        }
        $this->session->set_userdata('process_id', time());
        $this->data['scripts_to_load'] = array('plugins/dropzone/dropzone.min', 'plugins/tinymce/tinymce.min', 'plugins/datepicker/picker', 'plugins/datepicker/picker.date', 'plugins/formvalidator', 'deals/process_v1.0.7' . MIN_FILE);
        $this->data['styles_to_load'] = array('plugins/dropzone/dropzone', 'plugins/datepicker/themes/default', 'plugins/datepicker/themes/default.date');
        $this->data['section_pro'] = true;
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'deals/add_coupon', $this->data);
        $this->template->render();
    }

    /**
     * Ajout d'un autre bon plan
     */
    public function add_other() {
        // Not active in ADMIN
        if (!isset($this->config->item('admin')['active_bon-plan']) || $this->config->item('admin')['active_bon-plan'] == 0) {
            redirect(base_url('deals/add'));
        }
        $this->session->set_userdata('process_id', time());
        $this->data['scripts_to_load'] = array('plugins/dropzone/dropzone.min', 'plugins/tinymce/tinymce.min', 'plugins/datepicker/picker', 'plugins/datepicker/picker.date', 'plugins/formvalidator', 'deals/process_v1.0.7' . MIN_FILE);
        $this->data['styles_to_load'] = array('plugins/dropzone/dropzone', 'plugins/datepicker/themes/default', 'plugins/datepicker/themes/default.date');
        $this->data['section_pro'] = true;
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'deals/add_other', $this->data);
        $this->template->render();
    }

    /**
     * Ajout d'une boutique
     */
    public function add_pro() {
        // Not active in ADMIN
        if (!isset($this->config->item('admin')['active_pro']) || $this->config->item('admin')['active_pro'] == 0) {
            redirect(base_url('deals/add'));
        }
        $this->session->set_userdata('process_id', time());
        $this->session->unset_userdata('to_pro');
        $this->data['scripts_to_load'] = array('plugins/dropzone/dropzone.min', 'plugins/tinymce/tinymce.min', 'plugins/datepicker/picker', 'plugins/datepicker/picker.date', 'plugins/formvalidator', 'deals/process_v1.0.7' . MIN_FILE);
        $this->data['styles_to_load'] = array('plugins/dropzone/dropzone', 'plugins/datepicker/themes/default', 'plugins/datepicker/themes/default.date');
        $this->data['section_pro'] = true;
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'deals/add_pro', $this->data);
        $this->template->render();
    }

    /**
     * Sauvegarde du deal
     */
    public function save_deal() {
        // Loading
        $this->load->library('mailing');
        $this->load->library('form_validation');
        $this->load->library('recaptcha');
        $this->load->helper('string');
        if (!empty($_POST)) {
            // Validations
            $validationConfig = array(
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required|valid_email|is_unique[users_pro.email]|min_length[5]|max_length[255]'
                ),
                array(
                    'field' => 'legal',
                    'label' => 'CGV',
                    'rules' => 'trim|required'
                )
                    // TODO : Autres champs, même si validation JS on doit vérif côté serveur
            );
            $this->form_validation->set_rules($validationConfig);
            if (isset($_POST['g-recaptcha-response'])) {
                $captchaOk = $this->recaptcha->checkCaptcha($this->input->post('g-recaptcha-response'));
            } else {
                $captchaOk = true;
            }

            if (($this->form_validation->run() == true && $captchaOk) || $this->users_pro->isLogged()) {
                // Premier deal > inscription OR add from admin
                if (!$this->users_pro->isLogged() || ($this->session->userdata('role') == 'admin' && !$this->session->userdata('to_pro'))) {
                    $pass = random_string();
                    $users_pro_id = $this->users_pro->add(array(
                        'users_pro_categories_id' => $this->input->post('category_id'),
                        'users_pro_sub_categories_id' => $this->input->post('subcategory_id'),
                        'company' => $this->input->post('company'),
                        'siret' => $this->input->post('siret'),
                        'name_dealer' => $this->input->post('name_dealer'),
                        'address' => $this->input->post('address'),
                        'zipcode' => $this->input->post('zipcode'),
                        'city' => $this->input->post('city'),
                        'phone' => $this->input->post('phone'),
                        'email' => $this->input->post('email'),
                        'password' => sha1(md5($pass)),
                        'informations' => $this->input->post('informations'),
                        'latitude' => $this->input->post('latitude'),
                        'longitude' => $this->input->post('longitude'),
                        'legal' => $this->input->post('legal'),
                        'ip' => $this->input->ip_address(),
                    ));
                    $_POST['password'] = $pass;

                    // Newsletter PRO
                    require(APPPATH . 'libraries/Sendinblue.php');
                    $sendinblue = new Sendinblue("https://api.sendinblue.com/v2.0", $this->config->item('key_sendinblue'));
                    $data = array(
                        'attributes' => array(
                            "COMPANY" => $users_pro_id,
                            "NOM" => $this->input->post('name_dealer'),
                            "GROUPE" => $this->input->post('company'),
                            "SMS" => '+262' . $this->input->post('phone'),
                            "SIRET" => $this->input->post('siret'),
                            "ADDRESS" => $this->input->post('address'),
                            "ZIPCODE" => $this->input->post('zipcode'),
                            "CITY" => $this->input->post('city')),
                        "email" => $this->input->post('email'),
                        "listid" => array('6')
                    );
                    $sendinblue->create_update_user($data);

                    // Mail membre
                    $this->mailing->signup_pro($this->input->post());

                    // Envoi email notif admin
                    $this->mailing->admin_notif(array(
                        'notif' => 'Création de compte',
                        'content' => $this->input->post('company') . ' (' . $this->input->post('siret') . ')' . ' - ' . $this->input->post('name_dealer') . ' '
                        . '<br /><strong>Adresse :</strong> ' . $this->input->post('address') . ' ' . $this->input->post('zipcode') . ' ' . $this->input->post('city') . ''
                        . '<br /><strong>Téléphone :</strong> ' . $this->input->post('phone') . ''
                        . '<br /><strong>Email :</strong> ' . $this->input->post('email')
                    ));

                    // Connexion if not admin (admin can create an user)
                    if ($this->session->userdata('role') != 'admin') {
                        $this->session->set_userdata('pro_id', $users_pro_id);
                        $this->session->set_userdata('pro_name', $this->input->post('name_dealer'));
                        $this->session->set_userdata('pro_company', $this->input->post('company'));
                        $this->session->set_userdata('pro_email', $this->input->post('email'));
                    }
                } else {
                    $users_pro_id = $this->session->userdata('pro_id');
                    // Add deal for any PRO from ADMIN
                    if ($this->session->userdata('role') == 'admin' && $this->session->userdata('to_pro')) {
                        $users_pro_id = $this->session->userdata('to_pro');
                    }
                }



                if (!empty($_POST['title'])) {
                    $deals_id = $this->deals->add(array(
                        'users_pro_id' => $users_pro_id,
                        'title' => $this->input->post('title'),
                        'excerpt' => $this->input->post('excerpt'),
                        'start' =>$this->input->post('start') . ' 00:00:00',
                        'end' => $this->input->post('end') . ' 00:00:00',
                        'price_type' => $this->input->post('price_type'),
                        'price_base' => (!isset($_POST['price_base']) ? 0 : $this->input->post('price_base')),
                        'price_promo' => $this->input->post('price_promo'),
                        'promo_amount' => $this->input->post('promo_amount'),
                        'promo_discount' => $this->input->post('promo_discount'),
                        'tva' => isset($_POST['tva']) ? $this->input->post('tva') : 1,
                        'content' => $this->input->post('content'),
                        'target' => $this->input->post('target'),
                        'validity' => $this->input->post('validity'),
                        'date_valid' => $this->input->post('date_valid') . ' 00:00:00',
                        'use' => $this->input->post('use'),
                        'quotation_online' => (isset($_POST['quotation_online']) ? 1 : 0),
                        'coupons' => 0,
                        'quantity' => $this->input->post('quantity'),
                        'cover' => $this->input->post('cover'),
                        'statut' => 'draft',
                        'type_deal_full' => $this->input->post('type_deal_full'),
                        'type_deal' => $this->input->post('type_deal'),
                        'categories_id' => $this->input->post('category_id'),
                        'sub_categories_id' => $this->input->post('subcategory_id'),
                    ));

                    // Photos uploadées
                    $pathTemp = $this->config->item('base_path') . 'assets/images/products_temp/' . $this->session->userdata('process_id');
                    $path = $this->config->item('base_path') . 'assets/images/products/' . $deals_id;

                    $config['image_library'] = 'gd2';
                    $config['create_thumb'] = TRUE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 800;
                    $config['height'] = 500;

                    $this->load->library('image_lib', $config);

                    if (is_dir($pathTemp)) {
                        if (!is_dir($path)) {
                            mkdir($path, 0777);
                        }
                        $files = array_diff(scandir($pathTemp), array('.', '..'));
                        if ($files) {
                            foreach ($files as $file) {
                                rename($pathTemp . '/' . $file, $path . '/' . $file);
                                // Création d'un thumb 800x500
                                $config['source_image'] = $path . '/' . $file;
                                $this->image_lib->initialize($config);
                                $this->image_lib->resize();
                            }
                        }
                    }

                    // MAIL : Notif Admin
                    $this->mailing->admin_notif(array(
                        'notif' => 'Création de ' . $this->input->post('type_deal_full'),
                        'content' => $this->input->post('title') . ' (' . $this->input->post('excerpt') . ')'
                        . '<br /><strong>Dates :</strong> ' . $this->input->post('start') . '  > ' . $this->input->post('end') . ''
                        . '<br /><strong>Prix :</strong> ' . $this->input->post('price_base') . ' > ' . $this->input->post('price_promo')
                    ));

                    // MAIL : Deal enregistré
                    $this->mailing->deal_added(array('email' => $this->session->userdata('pro_email')));

                    // Payment or notif OK
                    if (isset($_POST['quotation_online']) || $this->input->post('type_deal') == 'bon-de-réduction') {
                        redirect(base_url('deals/deal_payment/' . $deals_id) . '?type=' . $this->input->post('type_deal_full') . '&pro_id=' . $users_pro_id . '&coupons=' . $this->input->post('coupons'));
                    } else {
                        redirect(base_url('deals/deal_saved') . '?type=' . $this->input->post('type_deal_full') . '&pro_id=' . $users_pro_id);
                    }
                } else {
                    redirect(base_url('deals/pro_added') . '?type=' . $this->input->post('type_deal_full') . '&pro_id=' . $users_pro_id);
                }
            } else {
                $users = $this->users_pro->getUser(array('email' => $_POST['email']));
                if (!empty($users)) {
                    redirect(base_url('boutique/' . strtolower(url_title($users->company)) . '/' . $users->id) . '?notif=store_exists');
                } elseif (!isset($_POST['legal'])) {
                    redirect(base_url('deals/add_pro?error=legal'));
                } elseif ($captchaOk == false) {
                    redirect(base_url('deals/add_pro?error=captcha'));
                } else {
                    redirect(base_url('deals/add?notif=unknown'));
                }
            }
        }
    }

    /**
     * Edit d'un deal
     */
    public function deal_update() {
        $deal = $this->deals->getDeal($this->input->post('deals_id'));
        if (isset($_POST['deals_id']) && ($this->session->userdata('role') == 'admin' || ($deal->users_pro_id == $this->session->userdata('pro_id') && $deal->statut == 'draft'))) {
            $this->deals->update(array(
                'id' => $this->input->post('deals_id')
                    ), array(
                'title' => $this->input->post('title'),
                'excerpt' => $this->input->post('excerpt'),
                'start' => $this->input->post('start') . ' 00:00:00',
                'end' => $this->input->post('end') . ' 00:00:00',
                'price_type' => $this->input->post('price_type'),
                'price_base' => $this->input->post('price_base'),
                'price_promo' => $this->input->post('price_promo'),
                'promo_amount' => $this->input->post('promo_amount'),
                'promo_discount' => $this->input->post('promo_discount'),
                'tva' => isset($_POST['tva']) ? $this->input->post('tva') : 1,
                'content' => $this->input->post('content'),
                'target' => $this->input->post('target'),
                'validity' => $this->input->post('validity'),
                'date_valid' => $this->input->post('date_valid') . ' 00:00:00',
                'use' => $this->input->post('use'),
                'quotation_online' => isset($_POST['quotation_online']) ? 1 : 0,
                //'coupons' => $this->input->post('coupons'),
                'quantity' => $this->input->post('quantity'),
                'cover' => $this->input->post('cover'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'latitude' => $this->input->post('latitude'),
                'longitude' => $this->input->post('longitude'),
                //'statut' => 'draft',
                'categories_id' => $this->input->post('categories_id'),
                'sub_categories_id' => $this->input->post('sub_categories_id'),
            ));

            // Photos uploadées
            $pathTemp = $this->config->item('base_path') . 'assets/images/products_temp/' . $this->session->userdata('process_id');
            $path = $this->config->item('base_path') . 'assets/images/products/' . $this->input->post('deals_id');

            $config['image_library'] = 'gd2';
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 800;
            $config['height'] = 500;

            $this->load->library('image_lib', $config);

            if (is_dir($pathTemp)) {
                if (!is_dir($path)) {
                    mkdir($path, 0777);
                }
                $files = array_diff(scandir($pathTemp), array('.', '..'));
                if ($files) {
                    foreach ($files as $file) {
                        rename($pathTemp . '/' . $file, $path . '/' . $file);
                        // Création d'un thumb 800x500
                        $config['source_image'] = $path . '/' . $file;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                }
            }

            if ($this->input->post('coupons') > 0) {
                $this->deals->update(array(
                    'id' => $this->input->post('deals_id')
                        ), array(
                    'paid' => 0));
                redirect(base_url('deals/deal_payment/' . $this->input->post('deals_id')) . '?type=' . $this->input->post('type_deal_full') . '&pro_id=' . $this->session->userdata('pro_id') . '&coupons=' . $this->input->post('coupons'));
            } else {
                redirect(base_url(url_title($this->input->post('title')) . '/bon-plan-reunion/' . $this->input->post('deals_id') . '?notif=action_ok'));
            }
        } else {
            redirect(base_url('store/pro?notif=unknown'));
        }
    }

    /**
     * Message de confirmation / Erreur Ajout d'un deal
     */
    public function deal_saved() {
        $this->data['section_pro'] = true;
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'deals/deal_saved', $this->data);
        $this->template->render();
    }

    /**
     * Paiement d'un deal
     */
    public function deal_payment($deals_id) {
        if ($deals_id) {
            $this->data['section_pro'] = true;
            $this->data['deals_id'] = $deals_id;
            $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
            $this->template->write_view('content', 'deals/deal_payment', $this->data);
            $this->template->render();
        } else {
            redirect(base_url('store/pro?notif=unknown'));
        }
    }

    /**
     * Go to paiement d'un deal (coupon / bon plan)
     * 
     * @param int $deals_id
     */
    public function deal_payment_go($deals_id) {
        if ($deals_id) {
            $deal = $this->deals->getDeal($deals_id);
            if ($deal && isset($_GET['coupons'])) {
                switch ($deal->type_deal) {
                    case 'bon-de-réduction' :
                        $desc = $this->input->get('coupons') . ' Impressions';
                        $amount = $deal->price_promo * $this->input->get('coupons') * ($this->config->item('admin')['coef_coupons'] / 100);
                        break;
                    case 'bon-plan' :
                        $desc = $this->input->get('coupons') . ' Devis';
                        $amount = $this->input->get('coupons') * $this->config->item('admin')['coef_quotation'];
                        break;
                }
                if ($amount) {
                    $order2Payment = array(
                        'title' => $deal->type_deal_full,
                        'order_amount' => $amount,
                        'orders_id' => $deals_id,
                        'order_address' => $deal->address,
                        'order_city' => $deal->city,
                        'order_zipcode' => $deal->zipcode,
                        'order_phone' => $deal->phone,
                        'order_firstname' => $deal->name_dealer,
                        'order_lastname' => '',
                        'order_informations' => $deal->type_deal_full . ' ' . SITE_NAME . ' (' . $desc . ')',
                        'order_email' => $deal->email,
                        'return_url' => site_url('deals/deal_paid/' . $deals_id),
                        'cancel_url' => site_url('store/pro?notif=payment_canceled'),
                        'tax_amount' => $amount * ($this->config->item('admin')['coef_taxe'] / 100),
                    );
                    // Load Libs
                    $this->load->library('payments', array('gateway' => $this->config->item('payment_gateway')));
                    $this->payments->iniatePayment($order2Payment);
                } else {
                    redirect(base_url('store/pro?notif=unknown'));
                }
            } else {
                redirect(base_url('store/pro?notif=unknown'));
            }
        } else {
            redirect(base_url('store/pro?notif=unknown'));
        }
    }

    /**
     * Deal payé
     */
    public function deal_paid($deals_id) {
        if ($deals_id) {
            $this->load->library('payments', array('gateway' => $this->config->item('payment_gateway')));
            list($isValid, $deal_id, $amount) = $this->payments->validatePayment($_REQUEST, 'deal');

            if ($isValid) {
                redirect(base_url('store/pro?notif=deal_paid&deals_id=' . $deal_id . '&amount=' . $amount));
            } else {
                // Bug payment
                redirect(base_url('store/pro?notif=unknown'));
            }
        }
    }

    /**
     * Message de confirmation / Erreur Ajout d'un pro
     */
    public function pro_added() {
        $this->data['section_pro'] = true;
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'deals/pro_added', $this->data);
        $this->template->render();
    }

    /**
     * Listing des categories
     * 
     * @param int $category_id
     */
    public function category_list($category_id) {
        $this->data['scripts_to_load'] = array('deals/category_list' . MIN_FILE);
        $this->data['category_id'] = $category_id;
        $this->data['category'] = $this->categories->getCategory($category_id);
        $this->data['sub_categories'] = $this->sub_categories->getSubCategories($category_id);
        foreach ($this->data['sub_categories'] as $key => $sub_category) {
            $this->data['sub_categories'][$key]->deals = $this->deals->getDeals($sub_category->id, false, false, 'promo_discount DESC');
        }
        $this->data['menu'] = 'deal';
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'deals/category_list', $this->data);
        $this->template->render();
    }

    /**
     * Listing des categories
     * 
     * @param int $category_id
     */
    public function list_deals($sub_category_id, $offset = 0) {

        $this->data['category'] = $this->sub_categories->getSubCategory($sub_category_id);

        $per_page = 6;
        $order = 'created_at DESC';
        if (isset($_GET['type'])) {
            $where = array('type_deal' => $this->input->get('type'));
        } else {
            $where = false;
        }
        $this->data['deals'] = $this->deals->getDeals($sub_category_id, $per_page, $offset, $order, $where);
        $this->data['deals_all'] = $this->deals->getDeals($sub_category_id, false, false, false, $where);

        $this->load->library('pagination');

        $config = paginationConfig();
        $config['base_url'] = base_url($this->data['category']->route) . (isset($_GET['type']) ? '?type=' . $_GET['type'] : '');
        $config['total_rows'] = count($this->data['deals_all']);
        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $this->data['scripts_to_load'] = array('deals/list_deals' . MIN_FILE);
        $this->data['sub_category_id'] = $sub_category_id;

        $this->data['menu'] = 'deal';
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'deals/list_deals', $this->data);
        $this->template->render();
    }

    /**
     * Affichage d'un deal
     * 
     * @param int $deal_id
     */
    public function deal($deal_id) {

        // Loading
        $this->load->library('recaptcha');
        $this->load->library('form_validation');
        $is_new_visitor = $this->stats_views_details->addView($deal_id);
        if ($is_new_visitor) {
            // Add only newest visits to global count
            $this->stats_views->addView($deal_id);
        }

        $this->data['deal'] = $this->deals->getDeal($deal_id);

        // Commande depuis le mobile
        if (isset($_GET['from_mobile']) && $this->data['deal']->type_deal == 'deal') {
            redirect(base_url('ajax/addToCart/' . $deal_id . '/true'));
        }

        if ($this->data['deal']) {
            // Stock pour les deal, sinon 1 dans les autres cas car cette variable n'est utile que pour les deals
            if ($this->data['deal']->type_deal == 'deal') {
                $this->data['stock'] = $this->deals->getStock($deal_id);
            } else {
                $this->data['stock'] = 1;
            }


            // Demande de devis
            if (!empty($_POST) && isset($_POST['quotation'])) {
                // Validations
                $validationConfig = array(
                    array(
                        'field' => 'firstname',
                        'label' => 'Prénom',
                        'rules' => 'trim|required|min_length[2]|max_length[255]'
                    ),
                    array(
                        'field' => 'lastname',
                        'label' => 'Nom',
                        'rules' => 'trim|required|min_length[2]|max_length[255]'
                    ),
                    array(
                        'field' => 'address',
                        'label' => 'Adresse',
                        'rules' => 'trim|required|min_length[2]|max_length[255]'
                    ),
                    array(
                        'field' => 'zipcode',
                        'label' => 'Code postal',
                        'rules' => 'trim|required|min_length[5]|max_length[5]|numeric'
                    ),
                    array(
                        'field' => 'city',
                        'label' => 'Ville',
                        'rules' => 'trim|required|min_length[2]|max_length[255]'
                    ),
                    array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required|valid_email|min_length[5]|max_length[255]'
                    ),
                    array(
                        'field' => 'phone',
                        'label' => 'Téléphone',
                        'rules' => 'trim|numeric|required|max_length[10]|min_length[10]'
                    ),
                    array(
                        'field' => 'informations',
                        'label' => 'Informations',
                        'rules' => 'trim|required|min_length[25]|max_length[10000]'
                    ),
                );
                $this->form_validation->set_rules($validationConfig);
                // Validation du captcha :: TODO : le loading du captacha ne se fait pas en popup, donc on ne vérif pas (car pas demandé)
                $captchaOk = true;

                if ($this->form_validation->run() == true && $captchaOk == true) {
                    // Save Quotation
                    $this->quotations->add(array(
                        'deals_id' => $this->input->post('deals_id'),
                        'users_pro_id' => $this->input->post('users_pro_id'),
                        'users_id' => $this->users->isLogged() ? $this->session->userdata('id') : null,
                        'quotation_firstname' => $this->input->post('firstname'),
                        'quotation_lastname' => $this->input->post('lastname'),
                        'quotation_address' => $this->input->post('address'),
                        'quotation_zipcode' => $this->input->post('zipcode'),
                        'quotation_city' => $this->input->post('city'),
                        'quotation_phone' => $this->input->post('phone'),
                        'quotation_email' => $this->input->post('email'),
                        'quotation_informations' => $this->input->post('informations')
                    ));
                    // Send Email to USER
                    $this->load->library('mailing');
                    $this->mailing->quotation_pro(array_merge($this->input->post(), array('email_pro' => $this->data['deal']->email)));
                    $this->mailing->quotation_user($this->input->post());

                    redirect(current_url() . '?notif=quotation_sended');
                } else {
                    // Erreurs
                    $this->data['captchaOk'] = $captchaOk;
                }
            }

            $this->data['menu'] = 'deal';
            switch ($this->data['deal']->type_deal) {
                case 'deal' :
                case 'bon-de-réduction' :
                    $title = SITE_NAME . ' | ' . $this->data['deal']->title . ' ' . $this->data['deal']->price_promo . $this->config->item('currency');
                    break;
                case 'deal' :
                    $title = $this->data['deal']->title . ' ' . $this->data['deal']->price_base > 0 ? $this->data['deal']->price_base . $this->config->item('currency') : $this->data['deal']->price_type == 'quotation' ? '(' . $this->lang('on_quotation') . ')' : '(' . strtoupper($this->lang('free')) . ')';
                    break;
                default :
                    $title = $this->data['deal']->title;
                    break;
            }
            $this->data['img_fb'] = base_url('assets/images/') . urldecode($this->data['deal']->cover);
            $this->data['meta_description'] = $this->data['deal']->excerpt;
            $this->template->write('title', $title);
            // Admin ou partner gérant le deal (si le deal est draft)
            if ($this->session->userdata('role') == 'admin' || ($this->data['deal']->users_pro_id == $this->session->userdata('pro_id') && $this->data['deal']->statut == 'draft')) {
                // Nouveau message
                if (!empty($_POST) && isset($_POST['message']) && $this->users_pro->isLogged()) {
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
                        // TODO : Save inbox
                        $this->inbox->add(array(
                            'inbox_to_users_pro_id' => $this->input->post('store_id'),
                            'inbox_from_users_pro_id' => $this->session->userdata('pro_id'),
                            'inbox_content' => $this->input->post('message')
                        ));
                        // Send Email to USER
                        $this->load->library('mailing');
                        $this->mailing->contact_from_admin($this->input->post());
                        $this->data['message_sended'] = true;
                    } else {
                        // Erreurs
                        $this->data['captchaOk'] = $captchaOk;
                    }
                }

                $this->session->set_userdata('process_id', time());
                $this->data['styles_to_load'] = array('plugins/dropzone/dropzone', 'plugins/datepicker/themes/default', 'plugins/datepicker/themes/default.date');
                $this->data['scripts_to_load'] = array('plugins/dropzone/dropzone.min', 'plugins/tinymce/tinymce.min', 'plugins/datepicker/picker', 'plugins/datepicker/picker.date', 'deals/deal_v1.0.1' . MIN_FILE, 'deals/process_v1.0.7' . MIN_FILE, 'deals/deal_edit_v1.0.1' . MIN_FILE, 'users/cart' . MIN_FILE);
                $this->template->write_view('content', 'deals/deal_edit', $this->data);
            } else {
                $this->data['scripts_to_load'] = array('deals/deal_v1.0.1' . MIN_FILE, 'users/cart' . MIN_FILE);
                $this->template->write_view('content', 'deals/deal', $this->data);
            }

            $this->template->render();
        } else {
            redirect(base_url('?notif=deal_ended'));
        }
    }

    /**
     * Recherche de deals
     */
    public function search($offset = 0) {
        $per_page = 10;
        $like = array();
        $where = false;
        // Après pagination
        $flashdata = $this->session->flashdata('search');
        if ($flashdata && !isset($_GET['search'])) {
            $_GET['search'] = $this->session->flashdata('search');
            $_GET['city'] = $this->session->flashdata('city');
        }
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $like['content'] = $this->input->get('search');
        }
        if (isset($_GET['type']) && !empty($_GET['type'])) {
            $where['type_deal'] = $this->input->get('type');
        }

        if (isset($_GET['city']) && !empty($_GET['city']) && $_GET['city'] != '0') {
            $where[PREFIXDB . 'cities.area'] = $this->input->get('city');
        }
        $this->data['deals'] = $this->deals->getDeals(false, $per_page, $offset, 'created_at DESC', $where, $like);

        $this->data['deals_all'] = $this->deals->getDeals(false, false, false, false, $where, $like);

        $this->load->library('pagination');

        $config = paginationConfig();
        // Garde en session pour la pagination
        $this->session->set_flashdata('search', $this->input->get('search'));
        $this->session->set_flashdata('city', $this->input->get('city'));
        $config['base_url'] = base_url('deals/search');
        $config['suffix'] = '';
        if (isset($_GET['search'])) {
            $config['suffix'] .= '?search=' . $this->input->get('search');
        }
        if (isset($_GET['city'])) {
            $config['suffix'] .= '&city=' . $this->input->get('city');
        }
        if (isset($_GET['type'])) {
            $config['suffix'] .= '&type=' . $this->input->get('type');
        }
        $config['total_rows'] = count($this->data['deals_all']);
        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $this->data['menu'] = 'deal';
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'deals/search', $this->data);
        $this->template->render();
    }

}
