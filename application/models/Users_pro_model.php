<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_pro_model extends CI_Model {
    
    private $table;   
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'users_pro'; 
    }
    
    /**
     * Ajout d'un user pro
     */
    public function add($datas) {
        $datas = array_merge($datas, array(
            'created_at' => date('Y-m-d H:i:s')
        ));
        
        $this->db->insert($this->table, $datas);
        
        return $this->db->insert_id();
    }
    
    /**
     * Récupère tous les users pro
     */
    public function getAll() {
        $this->db->where('role', 'pro');
        $this->db->where('legal >=', '1');
        return $this->db->order_by('created_at DESC')->get($this->table)->result();
    }
    
    /**
     * Récupère pour pagination
     */
    public function getPagined($max = false, $offset = false) {
        if($max != false && $offset != false) {
            $this->db->limit($max, $offset);
        } elseif($max != false && $offset == false) {
            $this->db->limit($max);
        }
        $this->db->where('role', 'pro');
        $this->db->where('legal >=', '1');
        return $this->db->order_by('created_at DESC')->get($this->table)->result();
    }

    /**
     * Récupère un user en fonction d'un whzere
     * 
     * @param array $where
     * @return object
     */
    public function getUser($where) {
        return $this->db->where($where)->get($this->table)->row();
    }
    
    /**
     * Update un user
     * @param array $where
     * @param array $updates
     */
    public function updateUser($users_pro_id, $updates) {
        $this->db->where('id', $users_pro_id)->update($this->table, $updates);
    }
    
    /**
     * Login d'un user pro
     * 
     * @param string $email
     * @param string $password
     */
    public function login($email = false, $password = false) {
        return $this->db->where(array(
            'email' => $email,
            'password' => sha1(md5($password))
        ))->get($this->table)->row();
    }
    
    /**
     * Check if user is logged
     * 
     * @return boolean
     */
    public function isLogged() {
        $user = $this->session->userdata('pro_id'); 
        if($user) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Delete store and these informations
     */
    public function deleteStore($users_pro_id) {
        $this->db->where('id', $users_pro_id)->delete($this->table);
        $this->db->where('users_pro_id', $users_pro_id)->delete(PREFIXDB.'deals');
    }
    
}
