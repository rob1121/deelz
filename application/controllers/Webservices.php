<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Webservices extends CI_Controller {

    private $data;

    public function __construct() {
        parent::__construct(); 
    }

    /**
     * Get the categories
     */
    public function getCategories() {
        echo json_encode($this->categories->getAll());
    }

    /**
     * Get the deals
     */
    public function getDeals() {
        sleep(2);
        $allDeals = $this->deals->getDeals(false, false, false, 'created_at DESC');
        if ($allDeals) {
            foreach ($allDeals as $key => $deal) {
                $allDeals[$key] = $this->dealsDatas($allDeals[$key], $deal);
            }
        }
        echo json_encode($allDeals);
    }

    /**
     * Showroom
     */
    public function getShowroom() {
        $deals_slider = $this->deals->getDeals(false, false, false, 'hp_slider ASC', array('hp_slider >' => 0));
        if ($deals_slider) {
            foreach ($deals_slider as $key => $deal) {
                $deals_slider[$key] = $this->dealsDatas($deals_slider[$key], $deal);
            }
        }
        $categories = $this->categories->getAll();
        if ($categories) {
            foreach ($categories as $key => $category) {
                $categories[$key]->image = base_url('assets/images/' . $category->image);
            }
        }
        echo json_encode(array(
            'banner_image' => base_url('assets/images/webservices/top.jpg'),
            'banner_url' => array('id' => 'pass', 'name' => 'The best deals !'),
            'banner_title' => 'The best deals !',
            'categories' => $categories,
            'populars' => array(),//$deals_slider,
        ));
    }

    /**
     * Get deals for a category
     */
    public function getCategoryDeals($category_id) {
        if ($category_id == 'pass') {
            $deals_slider = $this->deals->getDeals(false, false, false, 'hp_top DESC', array('type_deal' => 'pass'), false, false, 'publish');
        } else {
            $deals_slider = $this->deals->getDeals(false, false, false, 'hp_top DESC', false, false, false, 'publish', $category_id);
        }
        if ($deals_slider) {
            foreach ($deals_slider as $key => $deal) {
                $deals_slider[$key] = $this->dealsDatas($deals_slider[$key], $deal);
            }
        }

        echo json_encode($deals_slider);
        //echo json_encode(array());
    }

    /**
     * Create datas for JS
     * 
     * @param type $deals
     * @param type $deal
     * @return type
     */
    private function dealsDatas($deals, $deal) {
        if ($deal->type_deal == 'pass') {
            $deals->content = '<h1>The best deals</h1>' . $deals->content;
            $deals->url = 'http://yoodeal.devtoo.fr';
        } else {
            $deals->url = routeDeal($deal->deal_id, $deal->title) . '?from_mobile=1';
        }
        $deals->type = ucwords($deal->type_deal_full);
        $deals->image = base_url('assets/images/' . $deal->cover);
        $deals->informations = ($deal->informations == 'More informations ? (optional)' ? '' : $deal->informations);

        if ($deal->type_deal == 'deal') {
            $deals->buy_text = 'Buy online';
            $deals->buy_icon = 'cart';
            $deals->price = $deal->price_promo . '€';
        } else if ($deal->type_deal == 'bon-de-réduction') {
            $deals->buy_text = 'See the coupon';
            $deals->buy_icon = 'barcode';
            $deals->price = $deal->price_promo . '€';
        } else {
            if ($deals->price_type == 'quotation' && $deals->quotation_online == '1') {
                $deals->buy_text = "Online quotation";
                $deals->buy_icon = 'calculator';
                $deals->price = 'On quotation';
            } else {
                if ($deals->price_type == 'quotation') {
                    $deals->price = 'On quotation';
                } else {
                    if ($deals->price_promo > 0) {
                        $deals->price = $deals->price_promo . '€';
                    } else if ($deals->promo_discount > 0) {
                        $deals->price = '-' . $deals->promo_discount . '%';
                    } else {
                        $deals->price = 'Gratuit';
                    }
                }
                if ($deal->type_deal == 'pass') {
                    $deals->buy_text = 'Buy the pass';
                    $deals->buy_icon = 'cart';
                } else {
                    $deals->buy_text = "More informations";
                    $deals->buy_icon = 'bookmark';
                }
            }
        }
        return $deals;
    }

}
