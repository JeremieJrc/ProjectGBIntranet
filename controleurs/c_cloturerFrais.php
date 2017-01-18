<?php

include("vues/v_sommaireCompt.php");

$mois = getMois(date("d/m/Y"));
$action = $_REQUEST['action'];

switch($action){
    
    case 'voirCloturerFrais' : {
                $lesVisiteurs= $pdo->cloturerFrais($mois);
                  include("vues/v_cloturerFrais.php");
                break;
               }
    case 'clotureVisiteursFrais' :{
                
                $pdo->majEtatclotureFrais($mois);
                $lesVisiteurs= $pdo->cloturerFrais($mois);
                include("vues/v_cloturerFrais.php");
                break;
           }
    
    break;
    }

?>

