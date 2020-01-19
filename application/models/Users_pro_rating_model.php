<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_pro_rating_model extends CI_Model {

    private $table;  
     
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'users_pro_rating';
    }
    
    /**
     * Ajout d'une note
     */
    public function add($datas) {
        $datas = array_merge($datas, array(
            'created_at' => date('Y-m-d H:i:s')
        ));

        $this->db->insert($this->table, $datas);

        return $this->db->insert_id();
    }

    /**
     * Delete d'une note
     */
    public function delete($datas) {
        $this->db->where($datas)->delete($this->table);
    }

    /**
     * Récupère toutes les notes
     */
    public function getAll() {
        return $this->db
                ->join(PREFIXDB.'users_pro', PREFIXDB.'users_pro.id='.$this->table.'.users_pro_id')
                ->get($this->table)
                ->result();
    }

    /**
     * Compte le nombre de notes
     * 
     * @param int $users_pro_id
     */
    public function countRatings($users_pro_id) {
        return $this->db->where(array(
                    'users_pro_id' => $users_pro_id
                ))->get($this->table)->num_rows();
    }

    /**
     * Récupère les notes d'un pro
     * 
     * @param int $users_pro_id
     * @return object
     */
    public function getForStore($users_pro_id) {
        return $this->db->where(array(
                    'users_pro_id' => $users_pro_id
                ))->order_by('rating DESC')->get($this->table)->result();
    }
    
    /**
     * Récupère les notes d'un pro
     * 
     * @param int $users_id
     * @return object
     */
    public function getForUser($users_id) {
        return $this->db->where(array(
                    'users_id' => $users_id
                ))->get($this->table)->result();
    }
    
    /**
     * Moyenne pour un store
     * @param int $users_pro_id
     * @return int
     */
    public function getStoreMoy($users_pro_id) {
        $ratings = $this->db->where(array(
                    'users_pro_id' => $users_pro_id
                ))->order_by('rating DESC')->get($this->table)->result();
        
        if($ratings) {
            $allRatings = 0;
            foreach($ratings as $rating) {
                $allRatings += $rating->rating;
            }
            return $allRatings/count($ratings);
        } else {
            return 0;
        }
    }

}
