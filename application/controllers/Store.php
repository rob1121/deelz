<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Controller {

    private $data;

    /**
     * Page boutique
     *
     * @param int $users_pro_id
     */
    public function showroom($users_pro_id) {
        $this->data['pro'] = $this->users_pro->getUser(array('id' => $users_pro_id));
        if ($this->data['pro']) {

            // Loading
            $this->load->library('recaptcha');
            $this->load->library('form_validation');
            if (!empty($_POST) && $this->users->isLogged()) {
                // Validations
                $validationConfig = array(
                    array(
                        'field' => 'message',
                        'label' => lang('message'),
                        'rules' => 'trim|required|min_length[50]|max_length[1000]'
                    )
                );
                $this->form_validation->set_rules($validationConfig);
                // Validation du captcha
                $captchaOk = $this->recaptcha->checkCaptcha($this->input->post('g-recaptcha-response'));

                if ($this->form_validation->run() == true && $captchaOk == true) {
                    // TODO : Save inbox
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

            $this->data['deals'] = $this->deals->getDeals(false, false, false, 'created_at DESC', array('users_pro_id' => $users_pro_id, 'type_deal' => 'deal'));
            $this->data['coupons'] = $this->deals->getDeals(false, false, false, 'created_at DESC', array('users_pro_id' => $users_pro_id, 'type_deal' => 'bon-de-réduction'));
            $this->data['plans'] = $this->deals->getDeals(false, false, false, 'created_at DESC', array('users_pro_id' => $users_pro_id, 'type_deal' => ($users_pro_id == 74 ? 'pass' : 'bon-plan')));

            $this->data['menu'] = 'store';
            $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
            $this->template->write_view('content', 'store/showroom', $this->data);
            $this->template->render();
        } else {
            redirect(base_url() . '?notif=bad_store');
        }
    }

    /**
     * Listing des marchands
     */
    public function listing($offset = 0) {
        $this->data['menu'] = 'store';
        $per_page = 12;
        $this->data['pros'] = $this->users_pro->getAll();
        $this->data['prosPagined'] = $this->users_pro->getPagined($per_page, $offset);
        $this->load->library('pagination');

        $config = paginationConfig();
        $config['base_url'] = base_url('les-commerces');
        $config['suffix'] = '#storeListing';
        $config['total_rows'] = count($this->data['pros']);
        $config['per_page'] = $per_page;

        $this->pagination->initialize($config);

        $updateDone = false;
        foreach ($this->data['pros'] as $pro) {
            // Lat / Lng MAJ
            if (empty($pro->latitude)) {
                $latLng = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($pro->address . ' ' . $pro->zipcode . ' ' . $pro->city) . '&key=' . $this->config->item('google_map_api_key')));

                if ($latLng && isset($latLng->results[0])) {
                    $this->users_pro->updateUser($pro->id, array(
                        'latitude' => $latLng->results[0]->geometry->location->lat,
                        'longitude' => $latLng->results[0]->geometry->location->lng
                    ));
                    $updateDone = true;
                }
            }
        }
        if ($updateDone == true) {
            $this->data['pros'] = $this->users_pro->getAll();
        }
        $this->data['deals'] = $this->deals->getDeals();
        $this->data['scripts_to_load'] = array('plugins/markerclusterer.min', 'plugins/markerclusterer_plus', 'store/listing_v1.0.4' . MIN_FILE);
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'store/listing', $this->data);
        $this->template->render();
    }

    /**
     * Ajout d'une note pour un pro
     */
    public function addUsersProRating() {
        $this->load->library('form_validation');
        if (isset($_POST['users_pro_id']) && isset($_POST['rating']) && isset($_POST['review']) && isset($_POST['redirect'])) {
            $notif = '';
            // User loggué
            if ($this->users->isLogged()) {
                $validationConfig = array(
                    array(
                        'field' => 'review',
                        'label' => lang('comment'),
                        'rules' => 'trim|required|min_length[50]|max_length[1000]'
                    )
                );
                $this->form_validation->set_rules($validationConfig);
                if ($this->form_validation->run() == true) {
                    // Insert as User
                    $this->users_pro_rating->add(array(
                        'users_pro_id' => $this->input->post('users_pro_id'),
                        'users_id' => $this->session->userdata('id'),
                        'rating' => $this->input->post('rating'),
                        'review' => $this->input->post('review')
                    ));
                    $notif = '?notif=review_added';
                } else {
                    $this->session->set_flashdata('rating_datas', $_POST);
                    $this->session->set_flashdata('errors_rating', validation_errors());
                }
            } elseif (isset($_POST['guest_email']) && isset($_POST['guest_name'])) {
                $validationConfig = array(
                    array(
                        'field' => 'guest_name',
                        'label' => lang('names'),
                        'rules' => 'trim|required|min_length[5]|max_length[255]'
                    ),
                    array(
                        'field' => 'guest_email',
                        'label' => lang('email'),
                        'rules' => 'trim|required|valid_email|is_unique[users.email]|min_length[5]|max_length[255]'
                    ),
                    array(
                        'field' => 'review',
                        'label' => lang('comment'),
                        'rules' => 'trim|required|min_length[50]|max_length[1000]'
                    )
                );
                $this->form_validation->set_rules($validationConfig);

                if ($this->form_validation->run() == true) {
                    //  Insert as Guest
                    $this->users_pro_rating->add(array(
                        'users_pro_id' => $this->input->post('users_pro_id'),
                        'guest_name' => $this->input->post('guest_name'),
                        'guest_email' => $this->input->post('guest_email'),
                        'rating' => $this->input->post('rating'),
                        'review' => $this->input->post('review')
                    ));
                    $notif = '?notif=review_added';
                } else {
                    $this->session->set_flashdata('rating_datas', $_POST);
                    $this->session->set_flashdata('errors_rating', validation_errors());
                }
            }
            redirect($this->input->post('redirect') . $notif);
        } else {
            redirect(base_url('?notif=unknown'));
        }
    }

    /**
     * Login
     */
    public function signin() {
        if (!empty($_POST)) {
            $logged = $this->login();
            if ($logged == false) {
                $this->data['error'] = true;
            } else {
                redirect(base_url('store/pro?notif=connected'));
            }
        }
        $this->data['menu'] = 'store';
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'store/signin', $this->data);
        $this->template->render();
    }

    /**
     * Login de l'user
     *
     * @return boolean
     */
    private function login() {
        // Tentative de connection
        $logged = $this->users_pro->login($this->input->post('email'), $this->input->post('password'));
        if ($logged) {
            $this->session->set_userdata('pro_id', $logged->id);
            $this->session->set_userdata('pro_name', $logged->name_dealer);
            $this->session->set_userdata('pro_company', $logged->company);
            $this->session->set_userdata('pro_email', $logged->email);
            $this->session->set_userdata('role', $logged->role);

            return true;
        } else {
            return false;
        }
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
            $user_exists = $this->users_pro->getUser($where);
            if ($user_exists) {
                // Update
                $pass = random_string();
                $this->users_pro->updateUser($user_exists->id, array('password' => sha1(md5($pass))));
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
        $this->data['menu'] = 'store';
        $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'store/renew_password', $this->data);
        $this->template->render();
    }

    /**
     * Legal Page
     */
    public function legal() {
        $this->template->write('title', SITE_NAME.' | Conditions générales professionnels');
        $this->template->write_view('content', 'store/legal_v2', $this->data);
        $this->template->render();
    }

    /**
     * Page PRO de gestion
     *
     * @param int $users_pro_id
     */
    public function pro() {
        // Loading
        $this->load->library('form_validation');
        $users_pro_id = $this->session->userdata('pro_id');

        /**
         * Se connecter en tant que PRO quand on est admin
         */
        if (isset($_POST['admin_show']) && $this->session->userdata('role') == 'admin') {
            $this->session->set_userdata('pro_id', $this->input->post('admin_show'));
            $this->session->unset_userdata('role');
            redirect(current_url());
        }

        if ($users_pro_id) {
            // Acceptation des CGV
            if (isset($_POST['legal'])) {
                $this->users_pro->updateUser($users_pro_id, array('legal' => $this->input->post('legal')));
            }
            $this->data['pro'] = $this->users_pro->getUser(array('id' => $users_pro_id));
            if ($this->data['pro']) {

                /**
                 * Change PRO infos
                 */
                if (!empty($_POST) && isset($_POST['company'])) {
                    // Validations
                    $validationConfig = array(
                        array(
                            'field' => 'company',
                            'label' => lang('company'),
                            'rules' => 'trim|required|min_length[3]|max_length[255]'
                        ),
                        array(
                            'field' => 'name_dealer',
                            'label' => lang('names'),
                            'rules' => 'trim|required|min_length[3]|max_length[255]'
                        ),
                        array(
                            'field' => 'email',
                            'label' => lang('email'),
                            'rules' => 'trim|required|valid_email|min_length[5]|max_length[255]'
                        ),
                        array(
                            'field' => 'address',
                            'label' => lang('address'),
                            'rules' => 'trim|required|min_length[3]|max_length[255]'
                        ),
                        array(
                            'field' => 'zipcode',
                            'label' => lang('zipcode'),
                            'rules' => 'trim|required|min_length[5]|max_length[5]|numeric'
                        ),
                        array(
                            'field' => 'city',
                            'label' => lang('city'),
                            'rules' => 'trim|required|min_length[3]|max_length[255]'
                        ),
                        array(
                            'field' => 'phone',
                            'label' => lang('phone'),
                            'rules' => 'trim|required|min_length[10]|max_length[10]|numeric'
                        ),
                        array(
                            'field' => 'informations',
                            'label' => lang('ctrl_informations'),
                            'rules' => 'trim|max_length[1000]'
                        ),
                        // -- Update V1.1.0
                        array(
                            'field' => 'bank_company',
                            'label' => lang('store_pro_bank_company'),
                            'rules' => 'trim|max_length[255]'
                        ),
                        array(
                            'field' => 'bank_name',
                            'label' => lang('store_pro_bank_name'),
                            'rules' => 'trim|max_length[255]'
                        ),
                        array(
                            'field' => 'bank_address',
                            'label' => lang('store_pro_bank_address'),
                            'rules' => 'trim|max_length[255]'
                        ),
                        array(
                            'field' => 'bank_iban',
                            'label' => lang('store_pro_bank_iban'),
                            'rules' => 'trim|max_length[255]'
                        ),
                        array(
                            'field' => 'bank_bic',
                            'label' => lang('store_pro_bank_bic'),
                            'rules' => 'trim|max_length[255]'
                        ),
                        array(
                            'field' => 'paypal_account',
                            'label' => lang('store_pro_paypal_account'),
                            'rules' => 'trim|max_length[255]'
                        ),
                            // -- End Update V1.1.0
                    );

                    /**
                     * Change PRO password
                     */
                    if (isset($_POST['password_new']) && !empty($_POST['password_new']) && !empty($_POST['password_new'])) {
                        $validationConfig[] = array(
                            'field' => 'password_new',
                            'label' => lang('ctrl_new_pass'),
                            'rules' => 'trim|required|min_length[5]|max_length[255]'
                        );
                        $validationConfig[] = array(
                            'field' => 'password_new_confirm',
                            'label' => lang('ctrl_new_pass_confirm'),
                            'rules' => 'trim|required|matches[password_new]'
                        );
                        $logged = $this->users_pro->login($this->session->userdata('pro_email'), $this->input->post('password'));
                        if (!$logged) {
                            $errorPass = true;
                        }
                    }
                    $this->form_validation->set_rules($validationConfig);

                    if ($this->form_validation->run() == true && !isset($errorPass)) {
                        // Update PRO logo
                        if ($_FILES['logo']['name'] != '') {
                            $config['upload_path'] = $this->config->item('base_path') . 'assets/images/brands/';
                            $config['allowed_types'] = 'gif|jpg|png';
                            $config['max_size'] = 5000;
                            $config['max_width'] = 3000;
                            $config['max_height'] = 3000;
                            $config['file_name'] = $this->session->userdata('pro_id') . '.png';
                            $config['overwrite'] = true;

                            $this->load->library('upload', $config);

                            if (!$this->upload->do_upload('logo')) {
                                $this->data['error_logo'] = $this->upload->display_errors();
                                $this->data['errors'] = '';
                            } else {
                                // Resize
                                $config['image_library'] = 'gd2';
                                $config['source_image'] = $config['upload_path'] . $config['file_name'];
                                $config['create_thumb'] = false;
                                $config['maintain_ratio'] = true;
                                $config['width'] = 200;

                                $this->load->library('image_lib', $config);

                                $this->image_lib->resize();
                            }
                            // Update
                            $this->users_pro->updateUser($this->session->userdata('pro_id'), array(
                                'logo' => $config['file_name']
                            ));
                        }
                        // Update infos user
                        $datasUpdate = array(
                            'company' => $this->input->post('company'),
                            'name_dealer' => $this->input->post('name_dealer'),
                            'address' => $this->input->post('address'),
                            'zipcode' => $this->input->post('zipcode'),
                            'city' => $this->input->post('city'),
                            'phone' => $this->input->post('phone'),
                            'email' => $this->input->post('email'),
                            'informations' => $this->input->post('informations'),
                            'latitude' => $this->input->post('latitude'),
                            'longitude' => $this->input->post('longitude'),
                            // -- Update V1.1.0
                            'bank_company' => $this->input->post('bank_company'),
                            'bank_name' => $this->input->post('bank_name'),
                            'bank_address' => $this->input->post('bank_address'),
                            'bank_iban' => $this->input->post('bank_iban'),
                            'bank_bic' => $this->input->post('bank_bic'),
                            'paypal_account' => $this->input->post('paypal_account'),
                                // -- End Update V1.1.0
                        );

                        // Password update
                        if (isset($_POST['password_new']) && !empty($_POST['password_new'])) {
                            $datasUpdate['password'] = sha1(md5($this->input->post('password_new')));
                        }
                        $this->users_pro->updateUser($this->session->userdata('pro_id'), $datasUpdate);

                        // Update front
                        $this->data['pro'] = $this->users_pro->getUser(array('id' => $users_pro_id));
                    } else {
                        $this->data['errors'] = validation_errors();
                        // erreur pass actuel
                        if (isset($errorPass)) {
                            $this->data['errors'] .= '<p>' . lang('ctrl_bad_password') . '</p>';
                        }
                    }
                }

                // Validate coupon code
                if (!empty($_POST) && isset($_POST['coupon_code'])) {
                    $this->data['coupon_validation'] = $this->orders_deals->validateCode($users_pro_id, $this->input->post('coupon_code'));
                }

                if ($this->session->userdata('role') == 'admin') {
                    /**
                     * CMS EDITION
                     */
                    if (isset($_POST['content_cms'])) {
                        if (!$this->config->item('demo') || $this->config->item('auth_IP') == $_SERVER['REMOTE_ADDR']) {
                            // Validation rules
                            $validationConfig = array(
                                array(
                                    'field' => 'page',
                                    'label' => 'Page',
                                    'rules' => 'trim|required'
                                ),
                                array(
                                    'field' => 'content_cms',
                                    'label' => 'Contenu',
                                    'rules' => 'trim|required'
                                )
                            );

                            $this->form_validation->set_rules($validationConfig);
                            // Valid form
                            if ($this->form_validation->run() == true) {
                                // Explode Controller+Method
                                $page = explode('+', $this->input->post('page'));

                                // Check CMS page exists
                                $cmsExists = $this->cms->show($page[0], $page[1]);

                                if ($cmsExists) {
                                    // Update CMS
                                    $this->cms->update(array(
                                        'cms_controller' => $page[0],
                                        'cms_method' => $page[1]
                                            ), array(
                                        'cms_controller' => $page[0],
                                        'cms_method' => $page[1],
                                        'cms_content' => $this->input->post('content_cms')
                                    ));
                                } else {
                                    // Insert if not exists
                                    $this->cms->insert(array(
                                        'cms_controller' => $page[0],
                                        'cms_method' => $page[1],
                                        'cms_content' => $this->input->post('content_cms')
                                    ));
                                }
                            } else {
                                // TODO : Error front
                            }
                        }
                    }
                    /**
                     * END CMS EDITION
                     */
                    /**
                     * CONFIG DB EDITION
                     */
                    if (isset($_POST['color_1'])) {
                        // Validation rules
                        $validationConfig = array(
                            array(
                                'field' => 'color_1',
                                'label' => lang('ctrl_color') . ' 1',
                                'rules' => 'trim|required'
                            ),
                            array(
                                'field' => 'color_2',
                                'label' => lang('ctrl_color') . ' 2',
                                'rules' => 'trim|required'
                            ),
                            array(
                                'field' => 'color_3',
                                'label' => lang('ctrl_color') . ' 3',
                                'rules' => 'trim|required'
                            ),
                            array(
                                'field' => 'color_4',
                                'label' => lang('ctrl_color') . ' 4',
                                'rules' => 'trim|required'
                            ),
                            array(
                                'field' => 'coef_deals',
                                'label' => lang('ctrl_coef_deals'),
                                'rules' => 'numeric|trim|required'
                            ),
                            array(
                                'field' => 'coef_coupons',
                                'label' => lang('ctrl_coef_coupons'),
                                'rules' => 'numeric|trim|required'
                            ),
                            array(
                                'field' => 'coef_quotation',
                                'label' => lang('ctrl_coef_quotations'),
                                'rules' => 'numeric|trim|required'
                            ),
                            array(
                                'field' => 'coef_taxe',
                                'label' => lang('ctrl_coef_taxes'),
                                'rules' => 'numeric|trim|required'
                            )
                        );

                        $this->form_validation->set_rules($validationConfig);
                        // Valid form
                        if ($this->form_validation->run() == true) {
                            if (!isset($_POST['active_pro'])) {
                                $_POST['active_pro'] = 0;
                            }
                            if (!isset($_POST['active_deal'])) {
                                $_POST['active_deal'] = 0;
                            }
                            if (!isset($_POST['active_coupon'])) {
                                $_POST['active_coupon'] = 0;
                            }
                            if (!isset($_POST['active_bon-plan'])) {
                                $_POST['active_bon-plan'] = 0;
                            }
                            if (!isset($_POST['active_boost'])) {
                                $_POST['active_boost'] = 0;
                            }

                            /**
                             * Save config vars
                             */
                            foreach ($_POST as $key => $info) {

                                // Check CONFIG exists
                                $configExists = $this->config_db->item($key);

                                if ($configExists !== false) {
                                    // Update CMS
                                    $this->config_db->update(array(
                                        'config_name' => $key
                                            ), array(
                                        'config_value' => $info
                                    ));
                                } else {
                                    // Insert if not exists
                                    $this->config_db->insert(array(
                                        'config_name' => $key,
                                        'config_value' => $info
                                    ));
                                }
                            }

                            // Update SITE logo
                            if ($_FILES['logo']['name'] != '') {
                                $config['upload_path'] = $this->config->item('base_path') . 'assets/uploads/';
                                $config['allowed_types'] = 'gif|jpg|png';
                                $config['max_size'] = 5000;
                                $config['max_width'] = 3000;
                                $config['max_height'] = 3000;
                                $config['file_name'] = 'logo.png';
                                $config['overwrite'] = true;

                                $this->load->library('upload', $config);

                                if (!$this->upload->do_upload('logo')) {
                                    $this->data['error_logo'] = $this->upload->display_errors();
                                    $this->data['errors'] = '';
                                } else {
                                    // Resize
                                    $config['image_library'] = 'gd2';
                                    $config['source_image'] = $config['upload_path'] . $config['file_name'];
                                    $config['create_thumb'] = false;
                                    $config['maintain_ratio'] = true;
                                    $config['width'] = 200;

                                    $this->load->library('image_lib', $config);

                                    $this->image_lib->resize();
                                }
                                // Update
                                if (!$this->config_db->item('logo')) {
                                    $this->config_db->insert(array(
                                        'config_name' => 'logo',
                                        'config_value' => 1
                                    ));
                                }
                            }

                            // -- Update V1.1.0
                            // Redirect to get new change in config
                            redirect('store/pro?tab=admin');
                            // -- End Update V1.1.0
                        } else {
                            $this->data['errors'] = validation_errors();
                        }
                    }
                    /**
                     * END CONFIG DB EDITION
                     */
                    // DATAS ADMIN INTERFACE
                    $this->data['deals'] = $this->deals->getDeals(false, false, false, 'created_at DESC', array('type_deal' => 'deal'), false, false, 'all');
                    $this->data['deals_online'] = $this->deals->getDeals(false, false, false, 'created_at DESC', array('type_deal' => 'deal'), false, false, 'all');
                    $this->data['coupons'] = $this->deals->getDeals(false, false, false, 'created_at DESC', array('type_deal' => 'bon-de-réduction'), false, false, 'all');
                    $this->data['plans'] = $this->deals->getDeals(false, false, false, 'created_at DESC', array('type_deal' => 'bon-plan'), false, false, 'all');
                    $this->data['boosts_social'] = $this->boosts_social->getAll();
                    $this->data['boosts_zotdeal'] = $this->boosts_zotdeal->getAll();
                    $this->data['boosts_newsletter'] = $this->boosts_newsletter->getAll();
                    $this->data['boosts_photo'] = $this->boosts_photo->getAll();
                    $this->data['boosts_logo'] = $this->boosts_logo->getAll();
                    $this->data['all_pros'] = $this->users_pro->getAll();
                    $this->data['pass'] = $this->deals->getDeals(false, false, false, 'created_at DESC', array('type_deal' => 'pass'), false, false, 'all');
                    $this->data['orders'] = $this->orders->getWhere(array('order_paid' => 1));
                    $this->data['categories'] = $this->categories->getAll();
                    $this->data['sub_categories'] = $this->sub_categories->getAll();
                    $config_db = $this->config_db->getAll();
                    if ($config_db) {
                        foreach ($config_db as $conf) {
                            $configName = $conf->config_name;
                            $this->data['config'][$configName] = $conf->config_value;
                        }
                    }
                    // END DATAS ADMIN INTERFACE
                } else {
                    $this->data['deals'] = $this->deals->getDeals(false, false, false, 'created_at DESC', array('users_pro_id' => $users_pro_id), false, false, 'all');
                    $this->data['deals_online'] = $this->deals->getDeals(false, false, false, 'created_at DESC', array('users_pro_id' => $users_pro_id, 'type_deal' => 'deal'), false, false, 'all');
                    $this->data['coupons'] = $this->deals->getDeals(false, false, false, 'created_at DESC', array('users_pro_id' => $users_pro_id, 'type_deal' => 'bon-de-réduction'), false, false, 'all');
                    $this->data['plans'] = $this->deals->getDeals(false, false, false, 'created_at DESC', array('users_pro_id' => $users_pro_id, 'type_deal' => ($users_pro_id == 74 ? 'pass' : 'bon-plan')), false, false, 'all');
                    $this->data['orders'] = $this->orders->getForUsersPro(false);
                }


                $this->data['scripts_to_load'] = array('plugins/dropzone/dropzone.min', 'plugins/raphael/raphael.min', 'plugins/morris/morris.min', 'store/pro_v1.0.2' . MIN_FILE);
                $this->data['styles_to_load'] = array('plugins/dropzone/dropzone', 'plugins/morris/morris');
                $this->data['menu'] = 'store';
                $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
                if ($this->session->userdata('role') == 'admin') {
                    $this->data['scripts_to_load'][] = 'plugins/tinymce/tinymce.min';
                    $this->data['scripts_to_load'][] = 'plugins/bootstrap-treeview';
                    $this->data['scripts_to_load'][] = 'plugins/colorpicker/colorpicker';
                    $this->data['styles_to_load'][] = 'plugins/colorpicker/colorpicker';
                    $this->data['scripts_to_load'][] = 'store/admin_v1.0.1' . MIN_FILE;
                    $this->template->write_view('content', 'store/admin', $this->data);
                } else {
                    $this->template->write_view('content', 'store/pro', $this->data);
                }
                $this->template->render();
            } else {
                redirect(base_url() . '?notif=bad_store');
            }
        } else {
            redirect(base_url('store/signin') . '?notif=unknown');
        }
    }

    /**
     * Boost in real life
     */
    public function boost_irl() {
        if (!empty($_POST['boost_type'])) {
            switch ($this->input->post('boost_type')) {
                case 'photo' :
                    $this->boosts_photo->add(array(
                        'users_pro_id' => $this->session->userdata('pro_id')
                    ));
                    break;
                case 'logo' :
                    $this->boosts_logo->add(array(
                        'users_pro_id' => $this->session->userdata('pro_id')
                    ));
                    break;
            }
            $users_pro = $this->users_pro->getUser(array('id', $this->session->userdata('pro_id')));
            if ($users_pro) {
                // Mail
                $this->load->library('mailing');
                $this->mailing->boost_irl(array(
                    'email' => 'adrien@booklee.net',
                    'boost_type' => $this->input->post('boost_type'),
                    'users_pro' => $users_pro
                ));
                redirect(base_url('store/pro?tab=boost_' . $this->input->post('boost_type')));
            } else {
                redirect(base_url('store/pro?notif=unknown'));
            }
        } else {
            redirect(base_url('store/pro?notif=unknown'));
        }
    }

    /**
     * Boost Payment
     */
    public function boost_online() {
        // TODO : Notification canceled > go to paiement (get infos from db & go paypal)
        $this->load->library('paypal', array('sandbox_status' => $this->config->item('paypal_debug')));
        if (!empty($_POST['boost_type'])) {
            switch ($_POST['boost_type']) {
                case 'social' :
                    $boosts_id = $this->boosts_social->add(array(
                        'deals_id' => $this->input->post('deals_id'),
                        'boost_social_target' => $this->input->post('boost_target'),
                        'boost_social_amount' => $this->input->post('social_amount'),
                    ));
                    $amount = $this->input->post('social_amount');
                    break;
                case 'zotdeal' :
                    $boosts_id = $this->boosts_zotdeal->add(array(
                        'deals_id' => $this->input->post('deals_id'),
                        'boost_zotdeal_top' => $this->input->post('boost_top'),
                        'boost_zotdeal_slider' => $this->input->post('boost_slider'),
                    ));
                    $amount = ($this->input->post('boost_top') * 10) + ($this->input->post('boost_slider') * 30);
                    break;
                case 'newsletter' :
                    $boosts_id = $this->boosts_newsletter->add(array(
                        'deals_id' => $this->input->post('deals_id'),
                        'boost_newsletter_position' => $this->input->post('boost_position'),
                    ));
                    break;
            }

            if ($boosts_id && $amount > 0) {
                $users_pro = $this->users_pro->getUser(array('id' => $this->session->userdata('pro_id')));
                if ($users_pro) {
                    $order2Payment = array(
                        'title' => lang('ctrl_paypal_title_boost'),
                        'order_amount' => $amount,
                        'orders_id' => $boosts_id,
                        'order_address' => $users_pro->address,
                        'order_city' => $users_pro->city,
                        'order_zipcode' => $users_pro->zipcode,
                        'order_phone' => $users_pro->phone,
                        'order_firstname' => $users_pro->name_dealer,
                        'order_lastname' => '',
                        'order_informations' => lang('ctrl_paypal_title_boost'),
                        'order_email' => $users_pro->email,
                        'return_url' => site_url('store/boost_paid/' . $this->input->post('boost_type') . '/' . $boosts_id),
                        'cancel_url' => site_url('store/pro?notif=payment_canceled&url=' . urlencode(base_url('store/pro/boost_online/' . $boosts_id))),
                        'tax_amount' => $amount * 0.085,
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
     * Validation du paiement d'un boost
     * @param type $boost_type
     * @param type $boost_id
     */
    public function boost_paid($boost_type, $boost_id) {
        if ($boost_id) {
            $this->load->library('payments', array('gateway' => $this->config->item('payment_gateway')));
            list($isValid, $boost_id, $amount) = $this->payments->validatePayment($_REQUEST, 'boost', $boost_type);

            if ($isValid) {
                redirect(base_url('store/pro?tab=boost&notif=boost_paid&amount=' . $amount));
            } else {
                // Bug payment
                redirect(base_url('store/pro?notif=unknown'));
            }
        } else {
            redirect(base_url('?notif=unknown'));
        }
    }

    /**
     * Inbox du pro
     */
    public function inbox() {
        if ($this->users_pro->isLogged()) {
            $this->data['inbox'] = $this->inbox->getFeedUserPro($this->session->userdata('pro_id'));

            $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
            $this->template->write_view('content', 'store/inbox', $this->data);
            $this->template->render();
        } else {
            redirect(base_url('store/signin?notif=access_required'));
        }
    }

    /**
     * Messages echangés avec un client
     */
    public function messages($users_id, $admin = false) {
        // Loading
        $this->load->library('recaptcha');
        $this->load->library('form_validation');

        // Nouveau message
        if (!empty($_POST) && $this->users_pro->isLogged()) {
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
                if ($admin) {
                    $this->inbox->add(array(
                        'inbox_to_users_pro_id' => $users_id,
                        'inbox_from_users_pro_id' => $this->session->userdata('pro_id'),
                        'inbox_content' => $this->input->post('message')
                    ));
                } else {
                    $this->inbox->add(array(
                        'inbox_to_users_id' => $users_id,
                        'inbox_from_users_pro_id' => $this->session->userdata('pro_id'),
                        'inbox_content' => $this->input->post('message')
                    ));
                }
                // Send Email to USER
                $this->load->library('mailing');
                if ($this->session->userdata('role') == 'admin') {
                    $_POST['store_id'] = $this->session->userdata('pro_id');
                    if ($admin) {
                        // Admin > Pro
                        $email = $this->users_pro->getUser(array('id' => $users_id))->email;
                    } else {
                        // Admin > User
                        $email = $this->users->getUser($users_id)->email;
                    }
                    $this->mailing->contact_from_admin($this->input->post(), $email);
                } else {
                    // Pro > User
                    $this->mailing->contact_user($this->input->post());
                }
                $this->data['message_sended'] = true;
            } else {
                // Erreurs
                $this->data['captchaOk'] = $captchaOk;
            }
        }

        // Listing
        if ($this->users_pro->isLogged() && $users_id) {
            // Si admin
            $this->data['admin'] = $admin;
            if ($admin != false) {
                $this->data['user'] = $this->users_pro->getUser(array('id' => $users_id));
                $users_id = null;
            } else {
                $this->data['user'] = $this->users->getUser($users_id);
            }
            // Message Lu
            $this->inbox->setUserProReaded($users_id, $this->session->userdata('pro_id'));
            // Listing
            $this->data['inbox'] = $this->inbox->getMessagesUsers($users_id, $this->session->userdata('pro_id'));

            $this->data['pro'] = $this->users_pro->getUser(array('id' => $this->session->userdata('pro_id')));

            $this->template->write('title', SITE_NAME . ' | Coupons, Deals, Discounts & Online quotations');
            $this->template->write_view('content', 'store/messages', $this->data);
            $this->template->render();
        } else {
            redirect(base_url('store/signin?notif=access_required'));
        }
    }

}
