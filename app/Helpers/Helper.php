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


    // Calcul Moyenne Matiere Trimestre -----------
    if(!function_exists('calculMatterMoyenne')){
        function calculMatterMoyenne($data){
            $eval = 0; $totals = 0; $exist = false;
            foreach($data as $item){
                if(!($item->valeur == 'nc')){
                    $totals += $item->valeur; $eval += $item->value; $exist = true;
                }
            }
            $moyen = $exist ? ($totals ? number_format(($totals / $eval), 2, '.', ' '):'0'):'nc';
            return $exist ? ($moyen < 10 ? '0'.$moyen:$moyen):$moyen;
        }
    }


    // Gestion Classement Student --------------------
    if(!function_exists('ClassementStudent')){
        function ClassementStudent($data){
            array_multisort(array_column($data, 'moyen'), SORT_DESC, $data); // Trier le tableau par ordre décroissant des moyennes
            $previous = null; $rank = 1; $adjusted = 1; $table = [];
            foreach ($data as $item) {
                if ($previous === $item['moyen']){
                    $item['rang'] = $adjusted.'ex';
                    $table[] = $item;
                } 
                else {
                    $item['rang'] = $item['moyen'] == 'nc' ? '--':($rank > 1 ? $rank.'ème':($item['genre'] == 'F' ? $rank.'ère':$rank.'er'));
                    $table[] = $item;
                    $adjusted = $item['moyen'] == 'nc' ? '--':$rank; // Mémoriser le rang pour les ex-aequo
                }
                $previous = $item['moyen'] == 'nc' ? $previous:$item['moyen']; // Mettre à jour le rang précédent
                $item['moyen'] == 'nc' ? $rank:$rank++; // Incrementer le rang pour l'eleve suivant
            }
            return $table;
        }
    }


    // Change Value Matter ---------------------------------
    if(!function_exists('changeValMatter')){
        function changeValMatter($value, $matter = null){
            return match(true) {
                $value == 'Mus/AP' => $matter,
                default => $value
            };
        }
    }


    // Vérifie La Matière Et Le Cyccle ------------------------
    if(!function_exists('verifyMatterCycle')){
        function verifyMatterCycle($classe, $matter){
            if($matter['discipline_id'] == 2 && in_array($classe['level_id'], [1, 2, 3, 4])){
                $val = true;
            }
            return $val ?? false;
        }
    }

?>