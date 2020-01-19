<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stats_views_model extends CI_Model {

    const PREFIX = 'stat_views';

    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'stats_views';
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
     * Ajoute une vue
     * 
     * @param int $deals_id
     */
    public function addView($deals_id) {
        $where = array('deals_id' => $deals_id);
        
        $exists = $this->db->where($where)->get($this->table);

        if ($exists->num_rows()) {
            $update[self::PREFIX . '_updated_at'] = date('Y-m-d H:i:s');
            $update[self::PREFIX . '_count'] = $exists->row()->stat_views_count+1;
            $this->db->where($where)->update($this->table, array_merge($where, $update));
        } else {
            $update[self::PREFIX . '_created_at'] = date('Y-m-d H:i:s');
            $update[self::PREFIX . '_count'] = 1;
            $this->db->insert($this->table, array_merge($where, $update));
        }
    }
}
