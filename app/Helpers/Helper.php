<?php

namespace App\Helpers;

class Helper {
    public static function decimal_val($val,$no=4,$t="b"){
        $final = "";
        $leng = strlen($val);
        $loop = $no-$leng;
        for($i=1;$i<=$loop;$i++){
            $final .= "0";
        }
        $final .= $val;
        return $final;
    }

}