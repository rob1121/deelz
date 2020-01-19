<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    private $data;

    /**
     * Récupère les sous catégories pour une catégorie
     */
    public function loadCategories() {
        $categories = $this->categories->getAll();
        if ($categories) {
            foreach ($categories as $key => $category) {
                $categories[$key]->text = $category->name;
                $categories[$key]->href = '#category-' . $category->id;
                $subCategories = $this->sub_categories->getSubCategories($category->id);
                if ($subCategories) {
                    foreach ($subCategories as $subKey => $subCategory) {
                        $subCategories[$subKey]->text = $subCategory->name;
                        $subCategories[$subKey]->href = '#sub_category-' . $subCategory->id;
                        $categories[$key]->nodes = $subCategories;
                    }
                }
            }
        } else {
            $categories = false;
        }
        echo json_encode($categories);
    }

    /**
     * Récupère les sous catégories pour une catégorie
     */
    public function getSubCategories($category_id) {
        echo json_encode($this->sub_categories->getSubCategories($category_id));
    }

    /**
     * Récupère les images d'une catégorie
     * 
     * @param int $category_id
     */
    public function loadImagesCategory($category_id = '_all') {
        $files = array_diff(scandir($this->config->item('base_path') . 'assets/images/categories/' . $category_id), array('..', '.', '.DS_Store'));
        $urlBase = 'categories/' . $category_id . '/';
        if (empty($files)) {
            $files = array_diff(scandir($this->config->item('base_path') . 'assets/images/categories/_all'), array('..', '.', '.DS_Store'));
            $urlBase = 'categories/_all/';
        }
        if ($files) {
            foreach ($files as $key => $file) {
                if (strpos($file, '_thumb') !== false) {
                    unset($files[$key]);
                } else {
                    $files[$key] = $urlBase . $file;
                }
            }
            echo json_encode($files);
        } else {
            echo json_encode(false);
        }
    }

    /**
     * Récupère les logos pour les stores
     */
    public function loadBrandLogos() {
        $path = $this->config->item('base_path') . 'assets/images/brands/shops/';
        if (is_dir($path)) {
            $files = array_diff(scandir($path), array('..', '.', '.DS_Store'));
            if ($files) {
                echo json_encode($files);
            } else {
                echo json_encode(false);
            }
        } else {
            echo json_encode(false);
        }
    }

    /**
     * Loading des images d'un deal
     * 
     * @param int $deals_id
     */
    public function loadDealImages($deals_id) {
        $result = [];
        if ($deals_id) {
            $path = $this->config->item('base_path') . 'assets/images/products/' . $deals_id . '/';
            if (is_dir($path)) {
                $files = array_diff(scandir($path), array('..', '.', '.DS_Store'));
                if ($files) {
                    foreach ($files as $file) {
                        if (strpos($file, '_thumb') == false) {
                            $obj['name'] = $file;
                            $obj['size'] = filesize($path . $file);
                            $obj['url'] = base_url() . 'assets/images/products/' . $deals_id . '/' . $file;
                            $result[] = $obj;
                        }
                    }
                }
            }
        }
        echo json_encode($result);
    }

    /**
     * Loading des images categories _all for dropzone media
     * 
     * @param int $deals_id
     */
    public function loadAllMedias() {
        $result = [];
        $path = $this->config->item('base_path') . 'assets/images/categories/_all/';
        if (is_dir($path)) {
            $files = array_diff(scandir($path), array('..', '.', '.DS_Store'));
            if ($files) {
                foreach ($files as $file) {
                    if (strpos($file, '_thumb') == false) {
                        $obj['name'] = $file;
                        $obj['size'] = filesize($path . $file);
                        $obj['url'] = base_url() . 'assets/images/categories/_all/' . $file;
                        $result[] = $obj;
                    }
                }
            }
        }
        echo json_encode($result);
    }

    /**
     * Ajout d'un deal aux favoris
     * 
     * @param int $deals_id
     */
    public function addToFavorites($deals_id) {
        if ($this->users->isLogged()) {
            // TODO : Check pas déjà inséré pour éviter erreur au retour ajax
            // Ajout en base
            $this->users_favorites->add(array(
                'users_id' => $this->session->userdata('id'),
                'deals_id' => $deals_id
            ));

            // Retour JSON
            echo json_encode('true');
        } else {
            echo json_encode('not_logged');
        }
    }

    /**
     * Supprime des favoris
     * 
     * @param int $deals_id
     */
    public function deleteFavorite($deals_id) {
        if ($this->users->isLogged()) {
            // Ajout en base
            $this->users_favorites->delete(array(
                'users_id' => $this->session->userdata('id'),
                'deals_id' => $deals_id
            ));

            // Retour JSON
            echo json_encode('true');
        } else {
            echo json_encode('not_logged');
        }
    }

    /**
     * Ajout au panier
     * 
     * @param int $deals_id
     */
    public function addToCart($deals_id, $redirect = false) {
        if ($deals_id) {
            if ($this->users->isLogged()) {
                // Pas de doublon 
                if (!$this->users_cart->isInCart($deals_id)) {
                    // Ajout en base
                    $this->users_cart->add(array(
                        'users_id' => $this->session->userdata('id'),
                        'deals_id' => $deals_id
                    ));
                }
            } else {
                $cart_session = $this->session->userdata('cart');
                if ($cart_session) {
                    if (!in_array($deals_id, $cart_session)) {
                        $cart_session[] = $deals_id;
                    }
                    $this->session->set_userdata('cart', $cart_session);
                } else {
                    $this->session->set_userdata('cart', array($deals_id));
                }
            }

            // Retour JSON
            if ($redirect) {
                redirect(base_url('users/billing#infoPerso'));
            } else {
                echo json_encode('true');
            }
        } else {
            if ($redirect) {
                redirect(base_url('?notif=unknown'));
            } else {
                return false;
            }
        }
    }

    /**
     * Supprime du panier
     * 
     * @param int $deals_id
     */
    public function deleteInCart($deals_id) {
        if ($this->users->isLogged()) {
            // Ajout en base
            $this->users_cart->delete(array(
                'users_id' => $this->session->userdata('id'),
                'deals_id' => $deals_id
            ));
        }
        $this->session->unset_userdata('cart');
        // Retour JSON
        echo json_encode('true');
    }

    /**
     * Check si user loggué
     */
    public function userIsLogged() {
        echo json_encode($this->users->isLogged());
    }

    /**
     * Sauvegarde des photos en temporaire
     */
    public function addPics() {
        $path = $this->config->item('base_path') . 'assets/images/products_temp/' . $this->session->userdata('process_id');
        if (!is_dir($path)) {
            mkdir($path, 0777);
        }
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '10000';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';

        // Création des dossiers
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777);
        }

        //$config['file_name'] = uniqid() . '.jpg';
        $this->load->library('upload', $config);

        // Upload
        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            echo 'true';
        }
    }

    /**
     * Suppression img temporaire
     */
    public function deletePics($deals_id = false) {
        if (!$this->config->item('demo') || $this->config->item('auth_IP') == $_SERVER['REMOTE_ADDR']) {
            if (isset($_POST['name'])) {
                if ($deals_id == false || $deals_id == 'false') {
                    $path = $this->config->item('base_path') . 'assets/images/products_temp/' . $this->session->userdata('process_id');
                } else {
                    $path = $this->config->item('base_path') . 'assets/images/products/' . $deals_id;
                    $pathTemp = $this->config->item('base_path') . 'assets/images/products_temp/' . $this->session->userdata('process_id');
                }
                $extension = pathinfo($this->input->post('name'), PATHINFO_EXTENSION);
                $pathDelete = $path . '/' . str_replace('.', '_', str_replace(' ', '_', str_replace('.' . $extension, '', $this->input->post('name')))) . '.' . $extension;
                $pathDeleteThumb = $path . '/' . str_replace('.', '_', str_replace(' ', '_', str_replace('.' . $extension, '', $this->input->post('name')))) . '_thumb.' . $extension;

                if (file_exists($pathDelete)) {
                    unlink($pathDelete);
                } elseif (isset($pathTemp)) {
                    $pathDelete = $pathTemp . '/' . str_replace('.', '_', str_replace(' ', '_', str_replace('.' . $extension, '', $this->input->post('name')))) . '.' . $extension;
                    if (file_exists($pathDelete)) {
                        unlink($pathDelete);
                    }
                }
                if (file_exists($pathDeleteThumb)) {
                    unlink($pathDeleteThumb);
                }
                echo 'true';
            } else {
                echo 'false';
            }
        } else {
            echo 'false';
        }
    }

    /**
     * Sauvegarde des photos en temporaire
     */
    public function addPicsStore() {
        $path = $this->config->item('base_path') . 'assets/images/store/' . $this->session->userdata('pro_id');
        if (!is_dir($path)) {
            mkdir($path, 0777);
        }
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '10000';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';

        // Création des dossiers
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777);
        }

        //$config['file_name'] = uniqid() . '.jpg';
        $this->load->library('upload', $config);

        // Upload
        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            var_dump($this->upload->data());
            // Thumb 800x500
            $config['image_library'] = 'gd2';
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 800;
            $config['height'] = 500;
            $config['source_image'] = $path . '/' . $this->upload->data()['file_name'];

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            echo 'true';
        }
    }

    /**
     * Suppression img temporaire
     */
    public function deletePicsStore() {
        if (!$this->config->item('demo') || $this->config->item('auth_IP') == $_SERVER['REMOTE_ADDR']) {
            if (isset($_POST['name'])) {
                $path = $this->config->item('base_path') . 'assets/images/store/' . $this->session->userdata('pro_id');
                $extension = pathinfo($this->input->post('name'), PATHINFO_EXTENSION);
                $pathDelete = $path . '/' . str_replace('.', '_', str_replace(' ', '_', str_replace('.' . $extension, '', $this->input->post('name')))) . '.' . $extension;
                $pathDeleteThumb = $path . '/' . str_replace('.', '_', str_replace(' ', '_', str_replace('.' . $extension, '', $this->input->post('name')))) . '_thumb.' . $extension;

                if (file_exists($pathDelete)) {
                    unlink($pathDelete);
                    unlink($pathDeleteThumb);
                }
                echo 'true';
            } else {
                echo 'false';
            }
        } else {
            echo 'false';
        }
    }

    /**
     * Sauvegarde des photos categories _all
     */
    public function addPicsCategories() {
        $path = $this->config->item('base_path') . 'assets/images/categories/_all';
        if (!is_dir($path)) {
            mkdir($path, 0777);
        }
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '10000';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';

        // Création des dossiers
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777);
        }

        //$config['file_name'] = uniqid() . '.jpg';
        $this->load->library('upload', $config);

        // Upload
        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            var_dump($this->upload->data());
            // Thumb 800x500
            $config['image_library'] = 'gd2';
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 800;
            $config['height'] = 500;
            $config['source_image'] = $path . '/' . $this->upload->data()['file_name'];

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            echo 'true';
        }
    }

    /**
     * Suppression img categories _all
     */
    public function deletePicsCategories() {
        if (!$this->config->item('demo') || $this->config->item('auth_IP') == $_SERVER['REMOTE_ADDR']) {
            if (isset($_POST['name'])) {
                $path = $this->config->item('base_path') . 'assets/images/categories/_all';
                $extension = pathinfo($this->input->post('name'), PATHINFO_EXTENSION);
                $pathDelete = $path . '/' . str_replace('.', '_', str_replace(' ', '_', str_replace('.' . $extension, '', $this->input->post('name')))) . '.' . $extension;
                $pathDeleteThumb = $path . '/' . str_replace('.', '_', str_replace(' ', '_', str_replace('.' . $extension, '', $this->input->post('name')))) . '_thumb.' . $extension;

                if (file_exists($pathDelete)) {
                    unlink($pathDelete);
                    unlink($pathDeleteThumb);
                }
                echo 'true';
            } else {
                echo 'false';
            }
        } else {
            echo 'false';
        }
    }

    /**
     * Update Logo pro
     */
    public function updateLogo() {
        if (isset($_POST['logo'])) {
            $this->users_pro->updateUser($this->session->userdata('pro_id'), array('logo' => $this->input->post('logo')));
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }

    /**
     * Si un pro n'a pas eu la popup
     */
    public function proPopup() {
        echo json_encode(false);
        return;
        if (!isset($_COOKIE["propopup"])) {
            // 1 jour
            $time = 60 * 60 * 24 * 1;
            // Pose le cookie
            setcookie("propopup", 1, time() + $time);
            echo json_encode(true);
        } else {
            $_COOKIE["propopup"] = $_COOKIE["propopup"] + 1;
            echo json_encode(false);
        }
    }

    /**
     * Retourne le contenu CMS 
     * 
     * @param string $controller
     * @param string $method
     */
    public function loadCmsContent($controller, $method) {
        echo json_encode($this->cms->show($controller, $method));
    }

}
