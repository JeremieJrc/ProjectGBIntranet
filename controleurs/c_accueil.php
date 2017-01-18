<?php

$action = $_REQUEST['action'];

switch($action){
    
    case 'accueilComptable' : {
                include("vues/v_sommaireCompt.php");
                include("vues/v_accueilComptable.php");
                break;
               }
    case 'accueilVisiteur' :{
                
               include("vues/v_sommaireVisiteur.php");
               include("vues/v_accueilVisiteur.php");
               break;
           }
    
    break;
    }

?>