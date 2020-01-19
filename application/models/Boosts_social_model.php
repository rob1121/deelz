<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Boosts_social_model extends CI_Model {

    const PREFIX = 'boost_social';

    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'boosts_social';
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
                ->where(self::PREFIX.'_paid', 1)
                ->join(PREFIXDB.'deals', $this->table.'.deals_id = '.PREFIXDB.'deals.id')
                ->order_by(self::PREFIX.'_created_at DESC')
                ->get($this->table)->result();
    }
    
    /**
     * Confirme le paiement
     * 
     * @param int $boost_id
     */
    public function confirmPayment($boost_id) {
        $this->db->where(array(
                    self::PREFIX.'_id' => $boost_id
                ))->update($this->table, array(self::PREFIX.'_paid' => 1));
    }

}
