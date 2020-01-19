<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Providers_model extends CI_Model {

    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'providers';
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
     * Récupère un provider
     * 
     * @param int $provider_id
     * @return object
     */
    public function getProvider($provider_id) {
        return $this->db->where(array(
                    'id' => $provider_id
                ))->get($this->table)->row();
    }

}
