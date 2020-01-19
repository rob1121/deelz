<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Coupons_printed_model extends CI_Model {

    const PREFIX = 'coupon_printed';

    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'coupons_printed';
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
     * Récupère tous
     */
    public function getAll() {
        return $this->db->get($this->table)->result();
    }

    /**
     * Ajoute une impression
     * 
     * @param int $deals_id
     */
    public function addPrint($deals_id) {
        $where = array('deals_id' => $deals_id, 'users_id' => $this->session->userdata('id'));
        
        $exists = $this->db->where($where)->get($this->table);

        if ($exists->num_rows()) {
            $update[self::PREFIX . '_updated_at'] = date('Y-m-d H:i:s');
            $update[self::PREFIX . '_count'] = $exists->row()->coupon_printed_count+1;
            $this->db->where($where)->update($this->table, array_merge($where, $update));
        } else {
            $update[self::PREFIX . '_created_at'] = date('Y-m-d H:i:s');
            $update[self::PREFIX . '_count'] = 1;
            $this->db->insert($this->table, array_merge($where, $update));
        }
    }
    
    /**
     * Récupère le nombre de coupons restants
     * 
     * @param int $deals_id
     */
    public function getRemaining($deals_id) {
        $total = $this->deals->getDeal($deals_id)->coupons;
        if($total) {
            $printed = $this->db->where('deals_id', $deals_id)->get($this->table)->num_rows();
            return $total-$printed;
        } else {
            return 0;
        }
    }
    
    /**
     * Nombre de coupons imprimés pour un pro
     * @return type
     */
    public function getForUsersPro() {
        if($this->session->userdata('role') != 'admin') {
            $this->db->where(PREFIXDB.'deals.users_pro_id', $this->session->userdata('pro_id'));
        }
        return $this->db->join($this->table, $this->table.'.deals_id = '.PREFIXDB.'deals.id')
                ->get(PREFIXDB.'deals')
                ->num_rows();
    }
}
