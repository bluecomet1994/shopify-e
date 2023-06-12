<?php

use Validations as GlobalValidations;

class Validations
{

    public static function validateTypeIds($id)
    {
        if (intval($id) || $id == "ALL" || $id == 0 || $id == "0") {
            return Validations::$check = true;
        }
    }
    public static function removeSpecialCharacters($string){
        $pattern = '/([!;\':\-\[\]\/])/';
        return preg_replace($pattern, '', $string);
    }
    public static function checkPrice($price){
        $pattern = '/(^([0-9])+([.])([0-9])+)|(^[0-9]+$)/';
        if(preg_match($pattern,$price,$matches) ) return true; 
    }
  

}

echo Validations::checkPrice("200333rag");
