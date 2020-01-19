<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Quotations_model extends CI_Model {

    const PREFIX = 'quotation';

    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'quotations';
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
     * Récupère where
     */
    public function getWhere($where) {
        return $this->db
                ->where($where)
                ->get($this->table)->result();
    }
    
    /**
     * Récupère le nombre de devis restants
     * 
     * @param int $deals_id
     */
    public function getRemaining($deals_id) {
        $total = $this->deals->getDeal($deals_id)->coupons;
        if($total) {
            $quotations = $this->db->where('deals_id', $deals_id)->get($this->table)->num_rows();
            return $total-$quotations;
        } else {
            return 0;
        }
    }
    
}
