<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comingsoon_pro_model extends CI_Model {

    
    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'comingsoon_pro';
    }
    
    /**
     * Ajout d'un user pro coming soon
     */
    public function add($datas) {
        $datas = array_merge($datas, array(
            'created_at' => date('Y-m-d H:i:s')
        ));
        
        $this->db->insert($this->table, $datas);
        
        return $this->db->insert_id();
    }
    
}
