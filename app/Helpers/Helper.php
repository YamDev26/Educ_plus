<?php
    // First Name End Last Name User Connect
    if(!function_exists('userName')){
        function userName(){
            return auth()->user()->civilite. ' '. strtoupper(auth()->user()->first_name.' '.mb_substr(auth()->user()->last_name, 0, 1));
        }
    }

    // Role User Connect
    if(!function_exists('userRole')){
        function userRole(){
            $role = Str::limit((auth()->user()->role->libelle), 11, '...');
            return ucwords($role);
        }
    }


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


    // Connaitre la Matière En Classe Mixte (All, Esp) ------------------------
    if(!function_exists('getClasseMixte')){
        function getClasseMixte($str){
            return match(true) {
                ($str == 'All') => 'Allemand',
                ($str == 'Esp') => 'Espagnol',
                default => null,
            };
        }
    }


    // 
    if(!function_exists('getMatter')){
        function getMatter($str, $dts){
            list($mat, $tims, $day) = explode('_', $str);
            foreach($dts as $item){
                if($item['slot_time_id'] == $tims && $item['days_week_id'] == $day && $item['discipline_level_id'] == $mat){
                    return 'selected';
                }
            }
        }
    }

    // 
    if(!function_exists('indexMatter')){
        function indexMatter($str, $dts, $lv2 = null, $autre = null){
            list($tims, $day, $other) = explode('_', $str);
            foreach($dts as $item){
                if($item['slot_time_id'] == $tims && $item['days_week_id'] == $day && $item['moment'] == $other){
                    $libs = $item->discipline_level->discipline->abbreviat;
                    return match(true){
                        ($libs == 'LV2' && $lv2 != 'mixte') => substr(ucfirst($lv2), 0, 3),
                        ($libs == 'Mus/AP') => ($autre == 'musique' ? 'Mus':'AP'),
                        ($libs == 'LV2' && $lv2 == 'mixte') => 'All/Esp',
                        default => ucwords($libs)
                    };
                }
            }
        }
    }


    // Get Libelle Matter User Classe
    if(!function_exists('userMatter')){
        function userMatter($str, $dts){
            list($mat, $user, $int) = explode('_', $str);
            foreach($dts as $item){
                if($item['user_id'] == $user && $item['discipline_level_id'] == $mat && $item['order'] == $int){
                    return 'selected';
                }
            }
        }
    }


    // Get Libelle Matter User Classe
    if(!function_exists('formatMatterUser')){
        function formatMatterUser($libelle, $autre = null, $lv2 = null){
            return match(true) {
                $libelle == 'Musique/Arts Plastique' => ucfirst($autre),
                $libelle == 'Allemand/Espagnol' => ucfirst($lv2),
                default => $libelle
            };
        }
    }


    // Get User Prof Principal
    if(!function_exists('getProfPrincipal')){
        function getProfPrincipal($i, $mat, $dts){
            $val = $dts->where('pp', '1')->where('order', $i)->where('discipline_level_id', $mat);
            return count($val);
        }
    }


    // Ajout d'un zero pour toute les valeur inferieur à 10
    if(!function_exists('nombre')){
        function nombre($val){
            return match(true){
                ($val > 9) => $val,
                default => '0'.$val
            };
        }
    }


    // Appréciation Selon La Moyenne De La Classe
    if(!(function_exists('appreciationClasse'))){
        function appreciationClasse($moyenne){
            switch (true) {
                case ($moyenne >= 17 && $moyenne <= 20):
                    $val = "Excellent travail dans l'ensemble";
                    break;
                case ($moyenne >= 16 && $moyenne < 17):
                    $val = "Très bien dans l'ensemble";
                    break;
                case ($moyenne >= 14 && $moyenne < 16):
                    $val = "Bien dans l'ensemble";
                    break;
                case ($moyenne >= 12 && $moyenne < 14):
                    $val = "Assez bien dans l'ensemble";
                    break;
                case ($moyenne >= 10 && $moyenne < 12):
                    $val = "Passable dans l'ensemble";
                    break;
                case ($moyenne >= 8 && $moyenne < 10):
                    $val = "Insuffisant dans l'ensemble";
                    break;
                case ($moyenne >= 6 && $moyenne < 8):
                    $val = "Faible dans l'ensemble";
                    break;
                default:
                    $val = "Médiocre dans l'ensemble";
                    break;
            }
            return $val;
        }
    }
?>