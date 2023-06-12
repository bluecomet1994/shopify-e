<?php

class Validation
{
    public static function isCustomerPurchaseIdValid($unique_id)
    {
        $status = false;
        if (preg_match("/^([a-z0-9A-Z])+$/", $unique_id)) {
            $status = true;
        }
        return $status;
    }
    public static function isDateTimeValid($dnt)
    {
        $status = false;
        $pattern = "/^((20[2-4][0-9]-((1[0-2])|(0[1-9]))-(([3][0-1])|([1-2][0-9])|(0[1-9]))) ([2][0-3]|[0-1][0-9]):[0-5][0-9]:[0-5][0-9])/";
        if(preg_match($pattern,$dnt)){
            $status = true;
        }

        return $status;
    }
}

