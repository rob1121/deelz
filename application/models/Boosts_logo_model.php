<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Boosts_logo_model extends CI_Model {

    const PREFIX = 'boost_logo';

    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'boosts_logo';
    }
    
    /**
     * Ajout
     */
    public function add($datas) {
        $datas = array_merge($datas, array(
            self::PREFIX.'_created_at' => date('Y-m-d H:i:s')
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
     * Update
     * 
     * @param array $where
     * @param array $update
     * @return object
     */
    public function update($where, $update) {
        $this->db->where($where)->update($this->table, $update);
    }

   /**
     * Récupère tous
     */
    public function getAll() {
        return $this->db
                ->join(PREFIXDB.'users_pro', $this->table.'.users_pro_id = '.PREFIXDB.'users_pro.id')
                ->order_by(self::PREFIX.'_created_at DESC')
                ->get($this->table)->result();
    }

    /**
     * Check si boost déjà demandé
     */
    public function asked() {
        return $this->db->where(array(
                    'users_pro_id' => $this->session->userdata('pro_id')
                ))->get($this->table)->num_rows();
    }
    
    
}
