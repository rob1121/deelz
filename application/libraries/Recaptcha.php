<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Classe perso pour le recaptcha Google
 */
class Recaptcha { 
    private $ci;
    
    public function __construct() {
        $this->ci = get_instance();
    }
    /**
     * Check si captcha OK
     */
    public function checkCaptcha($responseRecaptcha = false)  {
        
        if ($responseRecaptcha == false) {
            return false;
        }
        $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $this->ci->config->item('recaptcha_key_secret') . "&response=" . $responseRecaptcha));

        if ($response->success == false) {
            return false;
        } else {
            return true;
        }
    }
}