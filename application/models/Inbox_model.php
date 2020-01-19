<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inbox_model extends CI_Model {

    const PREFIX = 'inbox';

    private $table;  
    
    public function __construct() {
        parent::__construct();
        $this->table = PREFIXDB.'inbox';
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
     * Récupère tous
     */
    public function getAll() {
        return $this->db
                        ->order_by(self::PREFIX . '_created_at DESC')
                        ->get($this->table)->result();
    }

    /**
     * Récupère le feed d'un user
     * 
     * @param int $users_id
     * @return object
     */
    public function getFeedUser($users_id) {
        $feed = $this->db->query('SELECT * FROM ' . $this->table . ' '
                        . ' WHERE (' . self::PREFIX . '_from_users_id = ' . $users_id . ' OR ' . self::PREFIX . '_to_users_id = ' . $users_id . ')'
                        . ' ORDER BY inbox_created_at DESC')->result();

        if ($feed) {
            // Créé un flux unique, quand l'expéditeur ou le destinataire soit le même pro
            $feedUnique = array();
            foreach ($feed as $message) {
                if (!isset($feedUnique[$message->inbox_to_users_pro_id]) && !isset($feedUnique[$message->inbox_from_users_pro_id])) {
                    if ($message->inbox_from_users_pro_id != null) {
                        $users_pro = $this->users_pro->getUser(array('id' => $message->inbox_from_users_pro_id));
                        $feedUnique[$message->inbox_from_users_pro_id] = $message;
                        $feedUnique[$message->inbox_from_users_pro_id]->company = $users_pro->company;
                        $feedUnique[$message->inbox_from_users_pro_id]->logo = $users_pro->logo;
                        $feedUnique[$message->inbox_from_users_pro_id]->users_pro_id = $users_pro->id;
                    } else {
                        $users_pro = $this->users_pro->getUser(array('id' => $message->inbox_to_users_pro_id));
                        $feedUnique[$message->inbox_to_users_pro_id] = $message;
                        $feedUnique[$message->inbox_to_users_pro_id]->company = $users_pro->company;
                        $feedUnique[$message->inbox_to_users_pro_id]->logo = $users_pro->logo;
                        $feedUnique[$message->inbox_to_users_pro_id]->users_pro_id = $users_pro->id;
                    }
                }
            }
            return $feedUnique;
        } else {
            return false;
        }
    }

    /**
     * Récupère les messages échangés users/pro
     * 
     * @param int $users_id
     * @param int $users_pro_id
     * @return object
     */
    public function getMessagesUsers($users_id, $users_pro_id) {
        if ($users_id == null) {
            // Messages admin > pro
            return $this->db->query(
                            'SELECT * FROM ' . $this->table . ' WHERE (' . self::PREFIX . '_from_users_id is NULL AND ' . self::PREFIX . '_to_users_pro_id = ' . $users_pro_id . ') '
                            . 'OR (' . self::PREFIX . '_to_users_id is NULL AND ' . self::PREFIX . '_from_users_pro_id = ' . $users_pro_id . ')'
                            . 'ORDER BY ' . self::PREFIX . '_created_at ASC')->result();
        } else {
            // Messages user > pro
            return $this->db->query(
                            'SELECT * FROM ' . $this->table . ' WHERE (' . self::PREFIX . '_from_users_id = ' . $users_id . ' AND ' . self::PREFIX . '_to_users_pro_id = ' . $users_pro_id . ') '
                            . 'OR (' . self::PREFIX . '_to_users_id = ' . $users_id . ' AND ' . self::PREFIX . '_from_users_pro_id = ' . $users_pro_id . ')'
                            . 'ORDER BY ' . self::PREFIX . '_created_at ASC')->result();
        }
    }

    /**
     * Récupère le feed d'un pro
     * 
     * @param int $users_pro_id
     * @return object
     */
    public function getFeedUserPro($users_pro_id) {
        $usersFeed = $this->db->query('SELECT *, MAX(inbox_created_at) as max_date, ' . PREFIXDB . 'users.id as users_id FROM ' . $this->table . ' '
                        . ' JOIN ' . PREFIXDB . 'users ON ' . PREFIXDB . 'users.id = ' . self::PREFIX . '_from_users_id'
                        . ' WHERE '
                        . ' ' . $this->table . '.' . self::PREFIX . '_id IN (
                        SELECT MAX(' . $this->table . '.' . self::PREFIX . '_id)
                        FROM ' . $this->table . '
                        WHERE (' . self::PREFIX . '_to_users_pro_id = ' . $users_pro_id . ' OR ' . self::PREFIX . '_from_users_pro_id = ' . $users_pro_id . ')
                        GROUP BY ' . self::PREFIX . '_from_users_id
                    )'
                        . ' GROUP BY ' . self::PREFIX . '_from_users_id'
                        . ' ORDER BY max_date DESC')->result();


        $feed = array();
        // Ajout du feeed utilisateur
        if ($usersFeed) {
            foreach ($usersFeed as $message) {
                $message->users_id = $message->users_id;
                $message->type_user = 'users';
                $feed[strtotime($message->inbox_created_at)] = $message;
            }
        };

        // Messages échangés avec l'admin
        $adminFeed = $this->db->query(
                        'SELECT * FROM ' . $this->table . ' WHERE (' . self::PREFIX . '_from_users_id is NULL AND ' . self::PREFIX . '_to_users_pro_id = ' . $users_pro_id . ') '
                        . 'OR (' . self::PREFIX . '_to_users_id is NULL AND ' . self::PREFIX . '_from_users_pro_id = ' . $users_pro_id . ')'
                        .' GROUP BY '.($this->session->userdata('role') == 'admin' ? self::PREFIX . '_to_users_pro_id, '.self::PREFIX . '_from_users_pro_id' : self::PREFIX . '_from_users_pro_id')
                        . ' ORDER BY ' . self::PREFIX . '_created_at ASC')->result();

        // Ajout du feed admin
        if ($adminFeed) {
            $maxAdmin = $adminFeed[count($adminFeed)-1];
            if($maxAdmin->inbox_from_users_pro_id != $users_pro_id) {
                $admin = $this->users_pro->getUser(array('id' => $maxAdmin->inbox_from_users_pro_id));
            } else {
                $admin = $this->users_pro->getUser(array('id' => $maxAdmin->inbox_to_users_pro_id));
            }
            
            // Prend le dernier message échangé avec l'admin
            $maxAdmin->name = $admin->company;
            $maxAdmin->users_id = $admin->id;
            $maxAdmin->logo = $admin->logo;
            $maxAdmin->type_user = 'admin';
            $feed[strtotime($maxAdmin->inbox_created_at)] = $maxAdmin;
        }
  
        // Ordonne par date
        krsort($feed);

        return $feed;
    }

    /**
     * Message lu par un user
     * 
     * @param int $users_id
     * @param int $users_pro_id
     */
    public function setUserReaded($users_id, $users_pro_id) {
        $feed = $this->getMessagesUsers($users_id, $users_pro_id);
        if ($feed) {
            // Dernier message envoyé par le marchand
            if ($feed[count($feed) - 1]->inbox_from_users_pro_id == (int) $users_pro_id) {
                // Readed
                $this->db->where(array(
                            self::PREFIX . '_id' => $feed[count($feed) - 1]->inbox_id
                        ))
                        ->update($this->table, array(
                            self::PREFIX . '_readed' => 1
                ));
            }
        }
    }

    /**
     * Message lu par un pro
     * 
     * @param int $users_id
     * @param int $users_pro_id
     */
    public function setUserProReaded($users_id, $users_pro_id) {
        $feed = $this->getMessagesUsers($users_id, $users_pro_id);
        if ($feed) {
            // Dernier message envoyé par le marchand
            if ($feed[count($feed) - 1]->inbox_to_users_pro_id == (int) $users_pro_id) {
                // Readed
                $this->db->where(array(
                            self::PREFIX . '_id' => $feed[count($feed) - 1]->inbox_id
                        ))
                        ->update($this->table, array(
                            self::PREFIX . '_readed' => 1
                ));
            }
        }
    }

}
