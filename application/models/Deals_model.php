<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Deals_model extends CI_Model {

    
    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'deals';
    }
    
    /**
     * Ajout d'un deal
     */
    public function add($datas) {
        $datas = array_merge($datas, array(
            'created_at' => date('Y-m-d H:i:s')
        ));
        
        $this->db->insert($this->table, $datas);
        
        return $this->db->insert_id();
    }
    
    /**
     * Récupère tous les deals
     */
    public function getAll() {
        return $this->db->get($this->table)->result();
    }
    
    /**
     * Update un deal
     * 
     * @param array $where
     * @param array $update
     * @return object
     */
    public function update($where, $update) {
        $this->db->where($where)->update($this->table, $update);
    }

    /**
     * Récupère les deals d'une sous catégorie
     * 
     * @param int $sub_category_id
     * @param int $max
     * @param int $offset
     * @param string $order
     * @param array $where
     * @param array $like
     * @return object
     */
    public function getDeals($sub_category_id = false, $max = false, $offset = false, $order = false, $where = false, $likes = false, $in = false, $statut = 'publish', $category_id = false) {
        if($max != false && $offset != false) {
            $this->db->limit($max, $offset);
        } elseif($max != false && $offset == false) {
            $this->db->limit($max);
        }
        if($order != false) {
            $this->db->order_by(PREFIXDB.'deals.'.$order);
        }
        if($where != false) {
            $this->db->where($where);
        }
        if($sub_category_id != false) {
            $this->db->where('sub_categories_id', $sub_category_id);
        }
        if($category_id != false) {
            $this->db->where('categories_id', $category_id);
        }
        if($likes != false) {
            $compt = 0;
            foreach($likes as $field => $like) {
                if($compt == 0) {
                $this->db->like($field, $like, 'both');
                } else {
                    $this->db->or_like($field, $like, 'both');
                }
                
                $compt++;
            }
        }
        if($in != false) {
            $this->db->where_in(PREFIXDB.'deals.id', $in);
        }
        if($statut != 'all') {
            $this->db->where('statut', $statut);
        }
        
        return $this->db->select('*, '.PREFIXDB.'deals.id as deal_id, users_pro_id as pro_id, '.PREFIXDB.'deals.city as city_deal, '.PREFIXDB.'deals.address as address_deal, COALESCE(NULLIF('.PREFIXDB.'deals.city,""), '.PREFIXDB.'users_pro.city) as city, COALESCE(NULLIF('.PREFIXDB.'deals.address,""), '.PREFIXDB.'users_pro.address) as address, COALESCE(NULLIF('.PREFIXDB.'deals.latitude,""), '.PREFIXDB.'users_pro.latitude) as latitude, COALESCE(NULLIF('.PREFIXDB.'deals.longitude,""), '.PREFIXDB.'users_pro.longitude) as longitude')->join(PREFIXDB.'users_pro', PREFIXDB.'users_pro.id = '.PREFIXDB.'deals.users_pro_id')->get($this->table)->result();
    }
    
    /**
     * Récupération d'un deal
     * 
     * @param int $deal_id
     * @return object
     */
    public function getDeal($deal_id) {
        $deal = $this->db->where('id', $deal_id)->get($this->table)->row();
        if($this->session->userdata('role') != 'admin' && ($deal->users_pro_id != $this->session->userdata('pro_id'))) {
            $this->db->where('statut', 'publish');
        }
        
        return $this->db
                ->select('*, '.PREFIXDB.'deals.id as deal_id, '.PREFIXDB.'users_pro.id as users_pro_id, '.PREFIXDB.'deals.city as city_deal, '.PREFIXDB.'deals.address as address_deal, COALESCE(NULLIF('.PREFIXDB.'deals.city,""), '.PREFIXDB.'users_pro.city) as city, COALESCE(NULLIF('.PREFIXDB.'deals.address,""), '.PREFIXDB.'users_pro.address) as address, COALESCE(NULLIF('.PREFIXDB.'deals.latitude,""), '.PREFIXDB.'users_pro.latitude) as latitude, COALESCE(NULLIF('.PREFIXDB.'deals.longitude,""), '.PREFIXDB.'users_pro.longitude) as longitude')
                ->where(PREFIXDB.'deals.id', $deal_id)
                ->join(PREFIXDB.'users_pro', PREFIXDB.'users_pro.id = '.PREFIXDB.'deals.users_pro_id')
                ->get($this->table)
                ->row();
    }
    
    /**
     * Confirme le paiement
     * 
     * @param int $deals_id
     * @return object
     */
    public function confirmPayment($deals_id) {
        $this->db->where(array(
                    'id' => $deals_id
                ))->update($this->table, array('paid' => 1, 'statut' => 'publish'));
    }
    
    
    /**
     * Récupère le stock
     * 
     * @param int $deals_id
     * @return object
     */
    public function getStock($deals_id) {
        $stock = $this->db->select('COUNT(deals_id) as deals_paid, '.$this->table.'.quantity` as deals_stock')
                        ->where(PREFIXDB.'orders.order_paid', 1)
                        ->where(PREFIXDB.'deals.id', $deals_id)
                        ->join(PREFIXDB.'orders_deals', PREFIXDB.'orders_deals.deals_id = '.$this->table.'.id')
                        ->join(PREFIXDB.'orders', PREFIXDB.'orders.order_id = '.PREFIXDB.'orders_deals.orders_id')
                        ->get($this->table)
                        ->row();
        
        if($stock) {
            return $stock->deals_stock-$stock->deals_paid;
        } else {
            return 0;
        }
    }
}
