<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Orders_deals_model extends CI_Model {

    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'orders_deals';
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
     * Récupère tous
     */
    public function getAll() {
        return $this->db->get($this->table)->result();
    }
    
    /**
     * Retourne les deals correspondant à une commande
     * @param int $orders_id
     * @return object
     */
    public function getDeals($orders_id) {
        return $this->db->where('orders_id', $orders_id)->get($this->table)->result();
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
     * Valide un code coupon
     * 
     * @param int $users_pro_id
     * @param string $code
     */
    public function validateCode($users_pro_id, $code) {
        $codeExists = $this->db->where(array(
            $this->table.'.code' => $code,
            PREFIXDB.'deals.users_pro_id' => $users_pro_id
        ))
                ->join(PREFIXDB.'deals', PREFIXDB.'deals.id = '.$this->table.'.deals_id')
                ->get($this->table)
                ->row();
        
        if($codeExists) {
            $this->db->where(array(
                'orders_id' => $codeExists->orders_id,
                'deals_id' => $codeExists->deals_id
            ))->update($this->table, array(
                'validated' => 1
            ));
            return true;
        } else {
            return false;
        }
    }

}
