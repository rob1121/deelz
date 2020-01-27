<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    private $data;

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('role') != 'admin') {
            redirect(base_url('?notif=unknown'));
        }
    }

    /**
     * Changement du statut d'un deal
     *
     * @param type $deals_id
     * @param type $statut
     */
    public function changeStatut($deals_id, $statut) {
        if ($deals_id) {
            if (!$this->config->item('demo') || $this->config->item('auth_IP') == $_SERVER['REMOTE_ADDR']) {
                $this->deals->update(array(
                    'id' => $deals_id
                        ), array(
                    'statut' => $statut
                ));
                // Mail : Email PRO
                if ($statut == 'publish') {
                    $deal = $this->deals->getDeal($deals_id);
                    // Mail
                    $this->load->library('mailing');
                    $this->mailing->deal_published($deal);
                }
            }

            redirect(base_url('store/pro?notif=action_ok'));
        } else {
            redirect(base_url('store/pro?notif=unknown'));
        }
    }

    /**
     * Changement position a la une d'un deal
     *
     * @param type $deals_id
     * @param type $change
     */
    public function changeTop($deals_id, $change) {
        if ($deals_id) {
            if (!$this->config->item('demo') || $this->config->item('auth_IP') == $_SERVER['REMOTE_ADDR']) {
                $this->deals->update(array(
                    'id' => $deals_id
                        ), array(
                    'hp_top' => $change
                ));
            }
            redirect(base_url('store/pro?notif=action_ok'));
        } else {
            redirect(base_url('store/pro?notif=unknown'));
        }
    }

    /**
     * Changement position slider d'un deal
     *
     * @param type $deals_id
     * @param type $change
     */
    public function changeSlider($deals_id, $change) {
        if ($deals_id) {
            if (!$this->config->item('demo') || $this->config->item('auth_IP') == $_SERVER['REMOTE_ADDR']) {
                $this->deals->update(array(
                    'id' => $deals_id
                        ), array(
                    'hp_slider' => $change
                ));
            }
            redirect(base_url('store/pro?notif=action_ok'));
        } else {
            redirect(base_url('store/pro?notif=unknown'));
        }
    }

    /**
     * Boost traité
     *
     * @param int $boost_id
     * @param int $boost_type
     * @param int $change
     */
    public function boostTreated($boost_id, $boost_type, $change) {
        if ($boost_id) {
            if (!$this->config->item('demo') || $this->config->item('auth_IP') == $_SERVER['REMOTE_ADDR']) {
                $this->boosts_social->update(array(
                    str_replace('boosts', 'boost', $boost_type) . '_id' => $boost_id
                        ), array(
                    str_replace('boosts', 'boost', $boost_type) . '_treated' => $change
                ));
                // Mail : Boost traité
                if ($change == 1) {
                    $deal = $this->deals->getDeal($boost_id);
                    // Mail
                    $this->load->library('mailing');
                    $this->mailing->boost_treated($deal);
                }
            }

            redirect(base_url('store/pro?notif=action_ok&tab=boost'));
        } else {
            redirect(base_url('store/pro?notif=unknown'));
        }
    }

    /**
     * Delete category
     *
     * @param int $id
     */
    public function deleteCategory($id = false) {
        // TODO : Check avec codeigniter formvalidation
        if (!empty($_POST)) {
            $id = $this->input->post('category_id');
        }
        if ($id != false && $id != '') {
            if (!$this->config->item('demo') || $this->config->item('auth_IP') == $_SERVER['REMOTE_ADDR']) {
                $this->categories->delete($id);
            }
            redirect(base_url('store/pro?notif=action_ok&tab=admin&sub_tab=admin_categories'));
        } else {
            redirect(base_url('store/pro?notif=unknown&tab=admin&sub_tab=admin_categories'));
        }
    }

    /**
     * Delete category
     *
     * @param int $id
     */
    public function deleteSubCategory($id = false) {
        // TODO : Check avec codeigniter formvalidation
        if (!empty($_POST)) {
            $id = $this->input->post('sub_category_id');
        }
        if ($id != false && $id != '') {
            if (!$this->config->item('demo') || $this->config->item('auth_IP') == $_SERVER['REMOTE_ADDR']) {
                $this->sub_categories->delete($id);
            }
            redirect(base_url('store/pro?notif=action_ok&tab=admin&sub_tab=admin_categories'));
        } else {
            redirect(base_url('store/pro?notif=unknown&tab=admin&sub_tab=admin_categories'));
        }
    }

    /**
     * Add a category
     *
     * @param string $name
     * @param string $icon
     * @param string $image
     */
    public function addCategory($name = false, $icon = false, $image = false) {
        // TODO : Check avec codeigniter formvalidation
        if (!empty($_POST)) {
            $name = $this->input->post('name');
            $icon = $this->input->post('icon');
            $image = $this->input->post('image');
        }

        if ($name != false && $icon != false && $image != false) {
            if (!$this->config->item('demo') || $this->config->item('auth_IP') == $_SERVER['REMOTE_ADDR']) {
                $this->categories->add(array(
                    'name' => $name,
                    'route' => strtolower(url_title($name)),
                    'icon' => $icon,
                    'image' => $image
                ));
            }
            redirect(base_url('store/pro?notif=action_ok&tab=admin&sub_tab=admin_categories'));
        } else {
            redirect(base_url('store/pro?notif=error_form&tab=admin&sub_tab=admin_categories'));
        }
    }
    /**
     * Edit a category
     *
     * @param string $name
     * @param string $icon
     * @param string $image
     */
    public function updateCategory($name = false, $icon = false, $image = false) {
        // TODO : Check avec codeigniter formvalidation
        if (!empty($_POST)) {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $icon = $this->input->post('icon');
            $image = $this->input->post('image');
        }
        if ($name != false && $icon != false && $image != false) {
            if (!$this->config->item('demo') || $this->config->item('auth_IP') == $_SERVER['REMOTE_ADDR']) {
                $this->categories->update(array(
                    'name' => $name,
                    'route' => strtolower(url_title($name)),
                    'icon' => $icon,
                    'image' => $image
                ), $id);
            }
            redirect(base_url('store/pro?notif=action_ok&tab=admin&sub_tab=admin_categories'));
        } else {
            redirect(base_url('store/pro?notif=error_form&tab=admin&sub_tab=admin_categories'));
        }
    }


    /**
     * Add a sub-category
     *
     * @param string $name
     * @param string $icon
     * @param string $image
     */
    public function addSubCategory($name = false, $icon = false, $image = false, $category_id = false) {
        // TODO : Check avec codeigniter formvalidation
        if (!empty($_POST)) {
            $name = $this->input->post('name');
            $icon = $this->input->post('icon');
            $image = $this->input->post('image');
            $category_id = $this->input->post('category_id');
        }

        if ($name != false && $icon != false && $image != false && $category_id != '' && $category_id != false) {
            if (!$this->config->item('demo') || $this->config->item('auth_IP') == $_SERVER['REMOTE_ADDR']) {
                $this->sub_categories->add(array(
                    'categories_id' => $category_id,
                    'name' => $name,
                    'route' => strtolower(url_title($name)),
                    'icon' => $icon,
                    'image' => $image
                ));
            }
            redirect(base_url('store/pro?notif=action_ok&tab=admin&sub_tab=admin_categories'));
        } else {
            redirect(base_url('store/pro?notif=error_form&tab=admin&sub_tab=admin_categories'));
        }
    }


    public function updateSubCategory($name = false, $icon = false, $image = false, $category_id = false) {
        // TODO : Check avec codeigniter formvalidation
        if (!empty($_POST)) {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $icon = $this->input->post('icon');
            $image = $this->input->post('image');
            $category_id = $this->input->post('category_id');
        }

        if ($name != false && $icon != false && $image != false && $category_id != '' && $category_id != false) {
            if (!$this->config->item('demo') || $this->config->item('auth_IP') == $_SERVER['REMOTE_ADDR']) {
                $this->sub_categories->update(array(
                    'categories_id' => $category_id,
                    'name' => $name,
                    'route' => strtolower(url_title($name)),
                    'icon' => $icon,
                    'image' => $image
                ), $id);
            }
            redirect(base_url('store/pro?notif=action_ok&tab=admin&sub_tab=admin_categories'));
        } else {
            redirect(base_url('store/pro?notif=error_form&tab=admin&sub_tab=admin_categories'));
        }
    }

    /**
     * Delete a store
     *
     * @param int $store_id
     */
    public function deleteStore($users_pro_id) {
        if (!$this->config->item('demo') || $this->config->item('auth_IP') == $_SERVER['REMOTE_ADDR']) {
            $this->users_pro->deleteStore($users_pro_id);
        }
        redirect(base_url('store/pro?notif=action_ok&tab=admin&sub_tab=admin_stores'));
    }

}
