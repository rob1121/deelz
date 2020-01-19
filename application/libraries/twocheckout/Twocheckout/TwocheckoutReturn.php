<?php

class Twocheckout_Return extends Twocheckout
{

    public static function check($params=array(), $secretWord)
    {
        $hashSecretWord = $secretWord;
        $hashSid = $params['sid'];
        $hashTotal = $params['total'];
        $hashOrder = $params['order_number'];
        // EDIT BUG
        //$hashOrder = self::$sandbox ? 1 : $params['order_number'];
        /*var_dump($hashSecretWord);
        var_dump($hashSid);
        var_dump($hashOrder);
        var_dump($hashTotal);*/
        
        $StringToHash = strtoupper(md5($hashSecretWord . $hashSid . $hashOrder . $hashTotal));
        if ($StringToHash != $params['key']) {
            $result = Twocheckout_Message::message('Fail', 'Hash Mismatch');
        } else {
            $result = Twocheckout_Message::message('Success', 'Hash Matched');
        }
        return Twocheckout_Util::returnResponse($result);
    }

}