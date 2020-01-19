<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_cart_model extends CI_Model {

    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'users_cart';
    }
    
    /**
     * Ajout 
     */
    public function add($datas) {
        $datas = array_merge($datas, array(
            'created_at' => date('Y-m-d H:i:s')
        ));

        $this->db->insert($this->table, $datas);

        return $this->db->insert_id();
    }

    /**
     * Delete 
     */
    public function delete($datas) {
        $this->db->where($datas)->delete($this->table);
    }
    
    /**
     * Vide le cart 
     * 
     *  @param int $users_id
     */
    public function cleanCart($users_id) {
        $this->db->where(array(
                'users_id' => $users_id
                ))->delete($this->table);
    }

    /**
     * Récupère tous
     */
    public function getAll() {
        return $this->db->get($this->table)->result();
    }

    /**
     * Check si un deal est dans le panier
     * 
     * @param int $deals_id
     */
    public function isInCart($deals_id) {
        return $this->db->where(array(
                    'users_id' => $this->session->userdata('id'),
                    'deals_id' => $deals_id
                ))->get($this->table)->row();
    }

    /**
     * Compte le nombre de deals dans le panier
     * 
     * @param int $deals_id
     */
    public function countInCart() {
        $users_id = $this->session->userdata('id');
        if ($users_id) {
            return $this->db->where(array(
                        'users_id' => $users_id
                    ))->get($this->table)->num_rows();
        } else {
            $cart_session = $this->session->userdata('cart');
            if ($cart_session) {
                return count($cart_session);
            } else {
                return 0;
            }
        }
    }

    /**
     * Récupère les favoris d'un user
     * 
     * @param int $users_id
     * @return object
     */
    public function getForUser($users_id) {
        return $this->db->select('*, '.PREFIXDB.'deals.id as deal_id')->where(array(
                    'users_id' => $users_id
                ))->join(PREFIXDB.'deals', PREFIXDB.'deals.id = ' . $this->table . '.deals_id')->get($this->table)->result();
    }

}
