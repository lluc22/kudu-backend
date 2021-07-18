<?php

class MoneyUtils {

    public static function isZero(string $number){
        
        return bccomp(bcpow(0,2), bcpow($number,"2")) === 0;
    }

}