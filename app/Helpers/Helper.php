<?php
    // Determination du coefficient de la matière 
    if(!function_exists('dtnCoefMatiere')){
        function dtnCoefMatiere($dts, $id){
            $val = $dts->where('discipline_id', $id)->first();
            return $val ? $val['coefficient']:null;
        }
    }


?>