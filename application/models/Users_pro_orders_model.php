<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_pro_orders_model extends CI_Model {

    const PREFIX = 'users_pro_orders';
    
    private $table;   
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'users_pro_orders';
    }
    
    /**
     * Ajout
     */
    public function add($datas) {
        $datas = array_merge($datas, array(
            self::PREFIX.'_created_at' => date('Y-m-d H:i:s'),
            self::PREFIX.'_ip' => $this->input->ip_address()
        ));

        $this->db->insert($this->table, $datas);

        return $this->db->insert_id();
    }
    
    /**
     * Récupère tous
     */
    public function getAll() {
        return $this->db->get($this->table)->result();
    }
    
    /**
     * Récupère where
     */
    public function getWhere($where) {
        return $this->db
                ->where($where)
                ->get($this->table)->result();
    }
}
