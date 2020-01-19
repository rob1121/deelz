<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categories_model extends CI_Model {

    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'categories';
    }
    
    /**
     * Ajout d'une catégorie
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
    public function delete($id) {
        $this->db->where('id', $id)->delete($this->table);
        // Delete sub_categories
        $this->sub_categories->deleteCategory($id);
    }
    
    /**
     * Récupère toutes les catégories
     */
    public function getAll() {
        return $this->db->get($this->table)->result();
    }
    
    /**
     * Infos d'une category
     * 
     * @param int $category_id
     * @return type
     */
    public function getCategory($category_id) {
        return $this->db->where('id', $category_id)->get($this->table)->row();
    }

}
