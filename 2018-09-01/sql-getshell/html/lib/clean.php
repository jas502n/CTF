<?php
    function getip(){
        if(getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif(getenv('REMOTE_ADDR')) {
            $ip = getenv('REMOTE_ADDR');
        } else {
            $ip = 'Unknown';
        }
        return clean($ip);
    }

    function clean($string){
        $string = str_replace(' ', '',$string);
        $match = preg_match('/(\/|\*|&|\'|substr|like|hex|conv|extractvalue|updatexml|floor|substring|left|right)/is',$string);
        if($match){
            echo $string;
            die('attack detected');
        }else{
            return $string;
        }
    }