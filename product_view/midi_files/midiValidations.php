<?php

class MidiValidations
{
    private static  $check;

    public static function checkValidationSingleValues($pgNum) 
    {
        if (isset($pgNum)   && (intval($pgNum) OR $pgNum==0)  )  {
            MidiValidations::$check = TRUE;
        } else {
            MidiValidations::$check = FALSE;
            
        }
        return MidiValidations::$check;
    }

    public static function checkValidation($pgNum,$sSubType) 
    {
        if (isset($pgNum) && isset($sSubType) && (intval($sSubType) OR $sSubType ==0) && (intval($pgNum) OR $pgNum==0)  )  {
            MidiValidations::$check = TRUE;
        } else {
            MidiValidations::$check = FALSE;
            
        }
        return MidiValidations::$check;
    }
    public static function checkSearchValidation($pgNum,$searchText){
        if(isset($pgNum) && isset($searchText) && is_string($searchText) && (intval($pgNum) OR $pgNum==0) ){
            MidiValidations::$check = TRUE;
        }else{
            MidiValidations::$check = FALSE;
        }
        return MidiValidations::$check;
    }
}

