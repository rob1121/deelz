<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Classe perso pour la gestion des envois d'email
 */
class Mailing {

    private $ci;
    private $from;
    private $from_name;

    public function __construct() {
        $this->ci = get_instance();
        
        $this->from = $this->ci->config->item('mail_from');
        $this->from_name = $this->ci->config->item('mail_from_name');
        
        $this->ci->load->library('email');
    }

    /**
     * Mail inscription COMINGSOON
     */
    public function signup_comingsoon($datas) {
        if (!empty($datas)) {
            $this->ci->email->from($this->from, $this->from_name);
            $this->ci->email->to($datas['email']);

            $this->ci->email->subject(lang('mail_obj_signup_comingsoon'));
            $view = $this->ci->load->view('mailing/signup_comingsoon', $datas, true);
            $this->ci->email->message($view);
            $this->ci->email->set_mailtype('html');

            if (!$this->ci->email->send()) {
                show_error($this->ci->email->print_debugger());
            }
        }
    }
    
    /**
     * Mail inscription
     */
    public function signup($datas) {
        if (!empty($datas)) {
            $this->ci->email->from($this->from, $this->from_name);
            $this->ci->email->to($datas['email']);

            $this->ci->email->subject(lang('mail_obj_signup'));
            $view = $this->ci->load->view('mailing/signup', $datas, true);
            $this->ci->email->message($view);
            $this->ci->email->set_mailtype('html');

            if (!$this->ci->email->send()) {
                show_error($this->ci->email->print_debugger());
            }
        }
    }
    
    
    
    /**
     * Mail inscription
     */
    public function signup_pro($datas) {
        if (!empty($datas)) {
            $this->ci->email->from($this->from, $this->from_name);
            $this->ci->email->to($datas['email']);

            $this->ci->email->subject(lang('mail_obj_signup_pro'));
            $view = $this->ci->load->view('mailing/signup_pro', $datas, true);
            $this->ci->email->message($view);
            $this->ci->email->set_mailtype('html');

            if (!$this->ci->email->send()) {
                show_error($this->ci->email->print_debugger());
            }
        }
    }
    
    /**
     * Deal enregistré
     */
    public function deal_added($datas) {
        if (!empty($datas)) {
            $this->ci->email->from($this->from, $this->from_name);
            $this->ci->email->to($datas['email']);

            $this->ci->email->subject(lang('mail_obj_deal_added'));
            $view = $this->ci->load->view('mailing/deal_added', $datas, true);
            $this->ci->email->message($view);
            $this->ci->email->set_mailtype('html');

            if (!$this->ci->email->send()) {
                show_error($this->ci->email->print_debugger());
            }
        }
    }
    
    /**
     * Deal enregistré
     */
    public function deal_published($datas) {
        if (!empty($datas)) {
            $this->ci->email->from($this->from, $this->from_name);
            $this->ci->email->to($datas->email);

            $this->ci->email->subject(lang('mail_obj_deal_published'));
            $view = $this->ci->load->view('mailing/deal_published', $datas, true);
            $this->ci->email->message($view);
            $this->ci->email->set_mailtype('html');

            if (!$this->ci->email->send()) {
                show_error($this->ci->email->print_debugger());
            }
        }
    }
    
    /**
     * Boost traité
     */
    public function boost_treated($datas) {
        if (!empty($datas)) {
            $this->ci->email->from($this->from, $this->from_name);
            $this->ci->email->to($datas['email']);

            $this->ci->email->subject(lang('mail_obj_boost_treated'));
            $view = $this->ci->load->view('mailing/boost_treated', $datas, true);
            $this->ci->email->message($view);
            $this->ci->email->set_mailtype('html');

            if (!$this->ci->email->send()) {
                show_error($this->ci->email->print_debugger());
            }
        }
    }
    
    /**
     * Nouvelle vente
     */
    public function new_sale($datas) {
        if (!empty($datas)) {
            $this->ci->email->from($this->from, $this->from_name);
            $this->ci->email->to($datas['email']);

            $this->ci->email->subject(lang('mail_obj_new_sale'));
            $view = $this->ci->load->view('mailing/new_sale', $datas, true);
            $this->ci->email->message($view);
            $this->ci->email->set_mailtype('html');

            if (!$this->ci->email->send()) {
                show_error($this->ci->email->print_debugger());
            }
        }
    }

    /**
     * Mail contact
     */
    public function contact($datas) {
        if (!empty($datas)) {
            $this->ci->email->from($datas['email'], $datas['name']);
            $this->ci->email->to($this->from);

            $this->ci->email->subject(lang('mail_obj_contact'));
            $view = $this->ci->load->view('mailing/contact', $datas, true);
            $this->ci->email->message($view);
            $this->ci->email->set_mailtype('html');

            if (!$this->ci->email->send()) {
                show_error($this->ci->email->print_debugger());
            }
        }
    }

    /**
     * Contact store
     */
    public function contact_store($datas) {
        if (!empty($datas)) {
            $pro = $this->ci->users_pro->getUser(array('id' => $datas['store_id']));
            if ($pro) {
                $this->ci->email->from($this->from, $this->from_name);
                $this->ci->email->to($pro->email);

                $this->ci->email->subject(lang('mail_obj_contact_store'));
                $view = $this->ci->load->view('mailing/contact_store', $datas, true);
                $this->ci->email->message($view);
                $this->ci->email->set_mailtype('html');

                if (!$this->ci->email->send()) {
                    show_error($this->ci->email->print_debugger());
                }
            }
        }
    }
    
    /**
     * Contact from admin
     */
    public function contact_from_admin($datas, $email = false) {
        if (!empty($datas)) {
            $pro = $this->ci->users_pro->getUser(array('id' => $datas['store_id']));
            if ($pro) {
                $this->ci->email->from($this->from, $this->from_name);
                $this->ci->email->to($email == false ? $pro->email : $email); // Pour gérer le cas d'envoi admin > user

                $this->ci->email->subject(lang('mail_obj_contact_from_admin'));
                $view = $this->ci->load->view('mailing/contact_from_admin', $datas, true);
                $this->ci->email->message($view);
                $this->ci->email->set_mailtype('html');

                if (!$this->ci->email->send()) {
                    show_error($this->ci->email->print_debugger());
                }
            }
        }
    }
    
    /**
     * Contact user
     */
    public function contact_user($datas) {
        if (!empty($datas)) {
            $user = $this->ci->users->getUser($datas['user_id']);
            if ($user) {
                $this->ci->email->from($this->from, $this->from_name);
                $this->ci->email->to($user->email);

                $this->ci->email->subject(lang('mail_obj_contact_user'));
                $view = $this->ci->load->view('mailing/contact_user', $datas, true);
                $this->ci->email->message($view);
                $this->ci->email->set_mailtype('html');

                if (!$this->ci->email->send()) {
                    show_error($this->ci->email->print_debugger());
                }
            }
        }
    }
    
    /**
     * Mail coupon
     */
    public function coupon($datas) {
        if (!empty($datas)) {
            $this->ci->email->from($this->from, $this->from_name);
            $this->ci->email->to($datas['email']);

            $this->ci->email->subject(lang('mail_obj_coupon'));
            $view = $this->ci->load->view('mailing/coupon', $datas, true);
            $this->ci->email->message($view);
            $this->ci->email->set_mailtype('html');

            if (!$this->ci->email->send()) {
                show_error($this->ci->email->print_debugger());
            }
        }
    }
    
    /**
     * Mail Renew Pass
     */
    public function renew_password($datas) {
        if (!empty($datas)) {
            $this->ci->email->from($this->from, $this->from_name);
            $this->ci->email->to($datas['email']);

            $this->ci->email->subject(lang('mail_obj_renew_password'));
            $view = $this->ci->load->view('mailing/renew_password', $datas, true);
            $this->ci->email->message($view);
            $this->ci->email->set_mailtype('html');

            if (!$this->ci->email->send()) {
                show_error($this->ci->email->print_debugger());
            }
        }
    }
    
    /**
     * Demande de boost IRL
     */
    public function boost_irl($datas) {
        if (!empty($datas)) {
            $this->ci->email->from($datas['users_pro']->email, $datas['users_pro']->company);
            $this->ci->email->to($datas['email']);

            $this->ci->email->subject(lang('mail_obj_boost_irl').$datas['boost_type']);
            $view = $this->ci->load->view('mailing/boost_irl', $datas, true);
            $this->ci->email->message($view);
            $this->ci->email->set_mailtype('html');

            if (!$this->ci->email->send()) {
                show_error($this->ci->email->print_debugger());
            }
        }
    }
    
    /**
     * Mail à l'admin // Notifs
     */
    public function admin_notif($datas) {
        if (!empty($datas)) {
            $this->ci->email->from($this->from, $this->from_name);
            $this->ci->email->to($this->from);

            $this->ci->email->subject(lang('mail_obj_admin_notif').$datas['notif']);
            $view = $this->ci->load->view('mailing/admin_notif', $datas, true);
            $this->ci->email->message($view);
            $this->ci->email->set_mailtype('html');

            if (!$this->ci->email->send()) {
                show_error($this->ci->email->print_debugger());
            }
        }
    }
    
    /**
     * Demande de devis au PRO
     */
    public function quotation_pro($datas) {
        if (!empty($datas)) {
            $this->ci->email->from($datas['email'], $datas['firstname'].' '.$datas['lastname']);
            $this->ci->email->to($datas['email_pro']);

            $this->ci->email->subject(lang('mail_obj_quotation_pro'));
            $view = $this->ci->load->view('mailing/quotation_pro', $datas, true);
            $this->ci->email->message($view);
            $this->ci->email->set_mailtype('html');

            if (!$this->ci->email->send()) {
                show_error($this->ci->email->print_debugger());
            }
        }
    }
    
    /**
     * Demande de devis résumé à l'user
     */
    public function quotation_user($datas) {
        if (!empty($datas)) {
            $this->ci->email->from($this->from, $this->from_name);
            $this->ci->email->to($datas['email']);

            $this->ci->email->subject(lang('mail_obj_quotation_user'));
            $view = $this->ci->load->view('mailing/quotation_user', $datas, true);
            $this->ci->email->message($view);
            $this->ci->email->set_mailtype('html');

            if (!$this->ci->email->send()) {
                show_error($this->ci->email->print_debugger());
            }
        }
    }

}
