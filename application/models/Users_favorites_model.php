<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_favorites_model extends CI_Model {
    
    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'users_favorites';
    }
    
    /**
     * Ajout d'un deal
     */
    public function add($datas) {
        $datas = array_merge($datas, array(
            'created_at' => date('Y-m-d H:i:s')
        ));

        $this->db->insert($this->table, $datas);

        return $this->db->insert_id();
    }
    
    /**
     * Delete un deal
     */
    public function delete($datas) {
        $this->db->where($datas)->delete($this->table);
    }

    /**
     * Récupère tous les deals
     */
    public function getAll() {
        return $this->db->get($this->table)->result();
    }

    /**
     * Check si un deal est favoris
     * 
     * @param int $deals_id
     */
    public function isFavorite($deals_id) {
        return $this->db->where(array(
                    'users_id' => $this->session->userdata('id'),
                    'deals_id' => $deals_id
                ))->get($this->table)->row();
    }

    /**
     * Compte le nombre de favoris
     * 
     * @param int $deals_id
     */
    public function countFavorites() {
        $users_id = $this->session->userdata('id');
        if ($users_id) {
            return $this->db->where(array(
                        'users_id' => $users_id
                    ))->get($this->table)->num_rows();
        } else {
            return 0;
        }
    }
    
    /**
     * Récupère les favoris d'un user
     * 
     * @param int $users_id
     * @return object
     */
    public function getForUser($users_id) {
        return $this->db->where(array(
                    'users_id' => $users_id
                ))->join(PREFIXDB.'deals', PREFIXDB.'deals.id = '.PREFIXDB.'users_favorites.deals_id')->get($this->table)->result();
    }

}
