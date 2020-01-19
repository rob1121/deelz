<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model {

    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'users';
    }
    
    /**
     * Ajout d'un user 
     */
    public function add($datas) {
        $datas = array_merge($datas, array(
            'created_at' => date('Y-m-d H:i:s')
        ));

        $this->db->insert($this->table, $datas);

        return $this->db->insert_id();
    }

    /**
     * Récupère tous les users 
     */
    public function getAll() {
        return $this->db->get($this->table)->result();
    }

    /**
     * Login d'un user
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
        $user = $this->session->userdata('id');
        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Récupère un user
     * 
     * @param int $users_id
     * @return object
     */
    public function getUser($users_id) {
        return $this->db->where(array(
                    'id' => $users_id
                ))->get($this->table)->row();
    }
    
    /**
     * Récupère un user
     * @return type
     */
    public function getUserWhere($where) {
        return $this->db->where($where)->get($this->table)->row();
    }

    /**
     * Update un user
     * @return type
     */
    public function updateUser($where, $values) {
        return $this->db->where($where)->update($this->table, $values);
    }
}
