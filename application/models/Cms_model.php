<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms_model extends CI_Model {

    const PREFIX = 'cms';

    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'cms';
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
     * Insert
     * 
     * @param array $insert
     * @return object
     */
    public function insert($insert) {
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
     * Affiche un contenu CMS
     */
    public function show($controller, $method) {
        $where = array(
            self::PREFIX . '_controller' => $controller,
            self::PREFIX . '_method' => $method,
        );
        $isset = $this->db->where($where)->get($this->table)->num_rows();

        if ($isset) {
            return $this->db->where($where)->get($this->table)->row()->cms_content;
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
