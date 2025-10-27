<?php
    // Determination du coefficient de la matière 
    if(!function_exists('dtnCoefMatiere')){
        function dtnCoefMatiere($dts, $id){
            $val = $dts->where('discipline_id', $id)->first();
            return $val ? $val['coefficient']:null;
        }
    }

    // Comparaison des dates debut et fin des decoupages ----
    if(!(function_exists('compareToDate'))){
        function compareToDate($actuel, $debut, $fin){
            $status = ['0', '1', '2'];
            return match(true) {
                ((strtotime($debut) > strtotime($actuel)) && (strtotime($fin) > strtotime($actuel))) => $status[0],
                ((strtotime($debut) <= strtotime($actuel)) && (strtotime($fin) >= strtotime($actuel))) => $status[1],
                ((strtotime($debut) < strtotime($actuel)) && (strtotime($fin) < strtotime($actuel))) => $status[2]
            };
        }
    }

    // Get status decoupage
    if(!(function_exists('getStatus'))){
        function getStatus($value){
            switch($value){
                case 0:
                    return ['warning', 'En attente'];
                    break;
                case 1:
                    return ['success', 'En cours'];
                    break;
                default :
                    return ['danger', 'Ternimer'];
            }
        }
    }

?>