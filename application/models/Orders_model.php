<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Orders_model extends CI_Model {

    const PREFIX = 'order';

    private $table;

    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'orders';
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
     * Get Where
     */
    public function getWhere($where) {
        $this->db->select('*, ' . $this->table . '.created_at as order_created_at');
        $this->db->where($where);
        $this->db->join(PREFIXDB . 'orders_deals', PREFIXDB . 'orders_deals.orders_id = ' . $this->table . '.order_id')
                ->join(PREFIXDB . 'deals', PREFIXDB . 'deals.id = ' . PREFIXDB . 'orders_deals.deals_id')
                ->join(PREFIXDB . 'users_pro', PREFIXDB . 'deals.users_pro_id = ' . PREFIXDB . 'users_pro.id')
                ->order_by($this->table . '.created_at DESC');
        return $this->db->get($this->table)->result();
    }

    /**
     * Récupère une commande
     *
     * @param int $order_id
     * @return object
     */
    public function getOrder($order_id) {
        return $this->db->where(array(
                            'order_id' => $order_id
                        ))
                        ->join(PREFIXDB . 'orders_deals', PREFIXDB . 'orders_deals.orders_id = ' . $this->table . '.order_id')
                        ->join(PREFIXDB . 'deals', PREFIXDB . 'deals.id = ' . PREFIXDB . 'orders_deals.deals_id')
                        ->get($this->table)->row();
    }

    /**
     * Récupère les commandes validées d'un user
     *
     * @param int $users_id
     * @return object
     */
    public function getForUser($users_id, $paid = false) {
        if ($paid !== false) {
            $this->db->where(array('order_paid' => 1));
        }
        return $this->db->where(array(
                            'users_id' => $users_id
                        ))
                        ->join(PREFIXDB . 'orders_deals', PREFIXDB . 'orders_deals.orders_id = ' . $this->table . '.order_id')
                        ->join(PREFIXDB . 'deals', PREFIXDB . 'deals.id = ' . PREFIXDB . 'orders_deals.deals_id')
                        ->get($this->table)->result();
    }

    /**
     * Confirme le paiement
     *
     * @param int $order_id
     */
    public function confirmPayment($order_id) {
        $this->db->where(array(
            'order_id' => $order_id
        ))->update($this->table, array('order_paid' => 1));
    }

    /**
     * Commandes pour un pro
     * @return type
     */
    public function getForUsersPro($num_rows = true) {
        if ($this->session->userdata('role') != 'admin') {
            $this->db->where(PREFIXDB . 'deals.users_pro_id', $this->session->userdata('pro_id'));
        }

        $query = $this->db
                ->where($this->table . '.' . self::PREFIX . '_paid', 1)
                ->join(PREFIXDB . 'orders_deals', PREFIXDB . 'orders_deals.orders_id = ' . $this->table . '.' . self::PREFIX . '_id')
                ->join(PREFIXDB . 'deals', PREFIXDB . 'deals.id = ' . PREFIXDB . 'orders_deals.deals_id')
                ->join(PREFIXDB . 'users_pro', PREFIXDB . 'users_pro.id = ' . PREFIXDB . 'deals.users_pro_id')
                ->get($this->table);

        if ($num_rows == true) {
            return $query->num_rows();
        } else {
            return $query->result();
        }
    }

    /**
     * Récupère les stats par jour
     * @param bool $unique
     * @return object
     */
    public function getPerDay($unique = false) {
        if ($this->session->userdata('role') != 'admin') {
            $this->db->where(PREFIXDB . 'deals.users_pro_id', $this->session->userdata('pro_id'));
        }
        $query = $this->db->select(($unique == false ? 'COUNT' : 'SUM') . '(' . self::PREFIX . '_id) as stat_count, DAY(' . $this->table . '.created_at) as stat_day, ' . $this->table . '.created_at as stat_date')
                        ->where($this->table . '.' . self::PREFIX . '_paid', 1)
                        ->join(PREFIXDB . 'orders_deals', PREFIXDB . 'orders_deals.orders_id = ' . $this->table . '.' . self::PREFIX . '_id')
                        ->join(PREFIXDB . 'deals', PREFIXDB . 'deals.id = ' . PREFIXDB . 'orders_deals.deals_id')
                        ->join(PREFIXDB . 'users_pro', PREFIXDB . 'users_pro.id = ' . PREFIXDB . 'deals.users_pro_id')
                        ->group_by('stat_day')
                        ->order_by($this->table . '.created_at', 'asc')
                        ->get($this->table);

        if($query) {
            return $query->result();
        } else {
            return $query;
        }

    }

}
