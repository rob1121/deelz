<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stats_views_details_model extends CI_Model {

    const PREFIX = 'stat_views_details';

    private $table;

    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'stats_views_details';
    }

    /**
     * Ajout
     */
    public function add($datas) {
        $datas = array_merge($datas, array(
            self::PREFIX . '_created_at' => date('Y-m-d H:i:s')
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
     * Ajoute une vue
     *
     * @param int $deals_id
     */
    public function addView($deals_id) {
        $where = array('deals_id' => $deals_id);
        if ($this->users->isLogged()) {
            $update['users_id'] = $this->session->userdata('id');
            $where['users_id'] = $this->session->userdata('id');
        } else {
            $update['users_ip'] = $this->input->ip_address();
            $where['users_ip'] = $this->input->ip_address();
        }
        $exists = $this->db->where($where)->get($this->table);

        if ($exists->num_rows()) {

            $update[self::PREFIX . '_updated_at'] = date('Y-m-d H:i:s');
            $update[self::PREFIX . '_count'] = (int)$exists->row()->stat_views_details_count+1;
            $this->db->where($where)->update($this->table, array_merge($where, $update));
            $is_new_visitor = false;
        } else {
            $update[self::PREFIX . '_created_at'] = date('Y-m-d H:i:s');
            $update[self::PREFIX . '_count'] = 1;
            $this->db->insert($this->table, array_merge($where, $update));
            $is_new_visitor = true;
        }
        return $is_new_visitor;
    }

    /**
     * Nombre de vues
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

    /**
     * Récupère les stats par jour
     * @param bool $unique
     * @return object
     */
    public function getPerDay($unique = false) {
        if($this->session->userdata('role') != 'admin') {
            $this->db->where(PREFIXDB.'deals.users_pro_id', $this->session->userdata('pro_id'));
        }
        $query = $this->db->select(($unique == false ? 'COUNT' : 'SUM').'('.self::PREFIX.'_count) as stat_count, DAY('.self::PREFIX.'_created_at) as stat_day, '.self::PREFIX.'_created_at as stat_date')
                ->join(PREFIXDB.'deals', PREFIXDB.'deals.id = '.$this->table.'.deals_id')
                ->group_by('stat_day')
                ->order_by(self::PREFIX.'_created_at', 'asc')
                ->get($this->table);


        if($query) {
            return $query->result();
        } else {
            return $query;
        }
    }
}
