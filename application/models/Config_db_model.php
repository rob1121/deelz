<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Config_db_model extends CI_Model {

    const PREFIX = 'config';

    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'config';
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
        return false;
        $this->db->where($datas)->delete($this->table);
    }

    /**
     * Insert
     * 
     * @param array $insert
     * @return object
     */
    public function insert($insert) {
        return false;
        $this->db->insert($this->table, $insert);
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
     * Affiche une valeur de config
     */
    public function item($name) {
        $where = array(
            self::PREFIX . '_name' => $name,
        );
        $isset = $this->db->where($where)->get($this->table)->num_rows();

        if ($isset) {
            return $this->db->where($where)->get($this->table)->row()->config_value;
        } else {
            return false;
        }
    }
    
    /**
     * Get All
     */
    public function getAll() {
        return $this->db->get($this->table)->result();
    }

}
