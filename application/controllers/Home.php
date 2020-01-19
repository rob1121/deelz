<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    private $data;

    /**
     * Coming soon
     */
    public function comingsoon() {
        $this->load->library('form_validation');

        if (isset($_COOKIE['pro_access'])) {
            redirect(base_url());
        }
        if (!empty($_POST['access'])) {
            if ($_POST['access'] == '2mS2Gr' || strtolower($_POST['access']) == 'run2017' || $_POST['access'] == 'Run2017' || $_POST['access'] == 'RUN2017') {
                setcookie('pro_access', 'true', time() + (60 * 60 * 24));
                redirect(base_url());
            } else {
                $this->data['error'] = true;
            }
        }
        if (!empty($_POST['name']) || !empty($_POST['email']) || !empty($_POST['company'])) {
            // Validations
            $validationConfig = array(
                array(
                    'field' => 'name',
                    'label' => lang('names'),
                    'rules' => 'trim|required|min_length[3]|max_length[255]'
                ), array(
                    'field' => 'email',
                    'label' => lang('email'),
                    'rules' => 'trim|required|valid_email|is_unique[comingsoon_pro.email]|min_length[4]|max_length[255]'
                ), array(
                    'field' => 'company',
                    'label' => lang('ctrl_company_name'),
                    'rules' => 'trim|required|min_length[3]|max_length[255]'
            ));


            $this->form_validation->set_rules($validationConfig);

            if ($this->form_validation->run()) {
                $this->comingsoon_pro->add($this->input->post());
                setcookie('pro_access', 'true', time() + (60 * 60 * 24 * 30));
                // Envoi du mail
                $this->load->library('mailing');
                $this->mailing->signup_comingsoon($this->input->post());

                // Envoi email notif admin
                $this->mailing->admin_notif(array(
                    'notif' => lang('ctrl_pre_signup_pro'),
                    'content' => $this->input->post('company') . ' '
                    . '<br /><strong>'.lang('lastname').' :</strong> ' . $this->input->post('name') . ''
                    . '<br /><strong>'.lang('email').' :</strong> ' . $this->input->post('email')
                ));


                redirect(base_url());
            } else {
                $this->data['errorSignup'] = true;
            }
        }

        $this->load->view('commingsoon/index', $this->data);
    }

    /**
     * Home Page
     */
    public function index() {
        $this->data['deals_slider'] = $this->deals->getDeals(false, false, false, 'hp_slider ASC', array('hp_slider >' => 0));
        $this->data['deals_top'] = $this->deals->getDeals(false, 6, false, 'created_at DESC', array('hp_top' => 1));
        $this->data['last_deals'] = $this->deals->getDeals(false, 8, false, 'created_at DESC', false);
        $this->data['pros'] = $this->users_pro->getAll();

        $this->data['menu'] = 'home';
        $this->template->write('title', SITE_NAME.' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'home/index', $this->data);
        $this->template->render();
    }

    /**
     * Concept Page
     */
    public function concept() {
        $this->data['menu'] = 'concept';
        $this->template->write('title', SITE_NAME.' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'home/concept', $this->data);
        $this->template->render();
    }
    
    /**
     * Invest Page
     */
    public function invest() {
        $this->data['menu'] = 'invest';
        $this->template->write('title', SITE_NAME.' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'home/invest', $this->data);
        $this->template->render();
    }

    /**
     * Mention légales Page
     */
    public function notice() {
        $this->template->write('title', SITE_NAME.' | Notice');
        $this->template->write_view('content', 'home/notice', $this->data);
        $this->template->render();
    }

    /**
     * Legal Page
     */
    public function legal() {
        $this->template->write('title', SITE_NAME.' | Legal');
        $this->template->write_view('content', 'home/legal', $this->data);
        $this->template->render();
    }

    /**
     * Contact Page
     */
    public function contact() {
        // Loading
        $this->load->library('recaptcha');
        $this->load->library('form_validation');
        if (!empty($_POST)) {
            // Validations
            $validationConfig = array(
                array(
                    'field' => 'content',
                    'label' => lang('message'),
                    'rules' => 'trim|required|min_length[5]|max_length[1000]'
                ),
            );
            // Si pas connecté
            if (!isset($_POST['users_pro_id']) && !isset($_POST['users_id'])) {
                $validationConfig[] = array(
                    'field' => 'name',
                    'label' => lang('names'),
                    'rules' => 'trim|required|min_length[5]|max_length[255]'
                );
                $validationConfig[] = array(
                    'field' => 'email',
                    'label' => lang('email'),
                    'rules' => 'trim|required|valid_email|min_length[5]|max_length[255]'
                );
            }
            $this->form_validation->set_rules($validationConfig);
            // Validation du captcha
            $captchaOk = $this->recaptcha->checkCaptcha($this->input->post('g-recaptcha-response'));

            if ($this->form_validation->run() == true && $captchaOk == true) {

                // Insertion DB si membre
                if (isset($_POST['users_pro_id'])) {
                    $this->inbox->add(array(
                        'inbox_from_users_pro_id' => $this->input->post('users_pro_id'),
                        'inbox_to_users_pro_id' => 11,
                        'inbox_content' => $this->input->post('content')
                    ));
                    $_POST['email'] = $this->session->userdata('pro_email');
                    $_POST['name'] = $this->session->userdata('pro_company') . ' (' . $this->session->userdata('pro_name') . ')';
                } elseif (isset($_POST['users_id'])) {
                    $this->inbox->add(array(
                        'inbox_from_users_id' => $this->input->post('users_id'),
                        'inbox_to_users_pro_id' => 11,
                        'inbox_content' => $this->input->post('content')
                    ));
                    $_POST['email'] = $this->session->userdata('email');
                    $_POST['name'] = $this->session->userdata('name');
                }


                // Envoi du mail
                $this->load->library('mailing');
                $this->mailing->contact($this->input->post());
                redirect(base_url('?notif=message_sended'));
            } else {
                // Erreurs
                $this->data['captchaOk'] = $captchaOk;
            }
        }
        $this->template->write('title', SITE_NAME.' | Coupons, Deals, Discounts & Online quotations');
        $this->template->write_view('content', 'home/contact', $this->data);
        $this->template->render();
    }

}
