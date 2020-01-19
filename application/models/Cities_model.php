<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cities_model extends CI_Model {

    
    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'cities';
    }
    
    /**
     * Ajout d'une ville
     */
    public function add($datas) {
        $datas = array_merge($datas, array(
            'created_at' => date('Y-m-d H:i:s')
        ));
        
        $this->db->insert($this->table, $datas);
        
        return $this->db->insert_id();
    }
    
    /**
     * Récupère toutes les villes
     */
    public function getAll() {
        return $this->db->get($this->table)->result();
    }
    
    /**
     * Création du select
     * @param bool $showCountry
     * @return string
     */
    public function createSelect($showCountry = true) {
        $allCities = $this->getAll();
        if($allCities) {
            $select = '<select class="form-control input-lg search-select" name="city" id="city">';
            if($showCountry == true) {
                $select .= '<option value="0">'.$this->lang->line('add_p_city_title').'</option>';
            } 
            foreach($allCities as $city) {
                $select .= '<option value="'.$city->name.'" '.(isset($_GET['city']) && $_GET['city'] == $city->name ? 'selected' : '').'>'.$city->name.'</option>';
            }
            $select .= '</select>';
            
            return $select;
        }
    }

}
