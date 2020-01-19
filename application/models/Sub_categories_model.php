<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sub_categories_model extends CI_Model {
    
    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'sub_categories';
    }
    
    /**
     * Ajout d'une sous catégorie
     */
    public function add($datas) {
        $datas = array_merge($datas, array(
            'created_at' => date('Y-m-d H:i:s')
        ));
        
        $this->db->insert($this->table, $datas);
        
        return $this->db->insert_id();
    }
    
    /**
     * Delete all sub_categories for a category
     */
    public function deleteCategory($id) {
        $this->db->where('categories_id', $id)->delete($this->table);
    }
    
    /**
     * Delete
     */
    public function delete($id) {
        $this->db->where('id', $id)->delete($this->table);
    }
    
    /**
     * Récupère toutes les sous catégories
     */
    public function getAll() {
        return $this->db->get($this->table)->result();
    }
    
    /**
     * Récupère les sous catégories pour un category_id
     */
    public function getSubCategories($category_id) {
        return $this->db->where('categories_id', $category_id)->get($this->table)->result();
    }
    
    /**
     * Récupère une sous catégorie
     */
    public function getSubCategory($sub_category_id) {
        return $this->db->where('id', $sub_category_id)->get($this->table)->row();
    }

}
