<?php

include("vues/v_sommaireCompt.php");


$mois = getMois(date("d/m/Y"));
$numAnnee =substr( $mois,0,4);
$numMois =substr( $mois,4,2);

$action = $_REQUEST['action'];


switch($action){
    
     case 'logVRemboursementFrais':  {

        
        $lesMois=$pdo->getMoisDisponibles();
        $lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
   
        $lesVisiteurs=$pdo->getLesVisiteurs();
        $lesClesV = array_keys( $lesVisiteurs );
		$visiteurASelectionner = $lesClesV[0];

         include("vues/v_suivreFraisLogVisiteur.php");

         break;
     }


     case'voirRemboursementFrais':{
        
         $leMois = $_REQUEST['lstMois'];
         $nomVisiteur=$_REQUEST['lsVisiteurs'];

         $lesMois=$pdo->getMoisDisponibles();
         $moisASelectionner = $leMois;

         $lesVisiteurs=$pdo->getLesVisiteurs();
         $visiteurASelectionner = $nomVisiteur;

        if(!$pdo->existLigneFraisMois($nomVisiteur,$leMois))
         {
            $idVisiteur=$pdo->getIdVisiteur($nomVisiteur,$leMois);
            
              if(!$pdo->exiteLigneFraisCL_CR($idVisiteur,$leMois)){
              
                 $errreurfrais="Fiche frais n'a pas été Validée "; 
                  include("vues/v_suivreFraisLogVisiteur.php");
                  include("vues/v_erreurFrais.php");
               }else{

                    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
		            $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);
		            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);


		            $libEtat = $lesInfosFicheFrais['libEtat'];
		            $montantValide = $lesInfosFicheFrais['montantValide'];
		            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];

		            $dateModif =  $lesInfosFicheFrais['dateModif'];
		            $dateModif =  dateAnglaisVersFrancais($dateModif);

   
                     include("vues/v_suivreFraisLogVisiteur.php");
                     include("vues/v_rembFraisForfait.php"); 
                     include("vues/v_rembHorsForfait.php");
              } 
         }else
         {
              $errreurfrais="Fiche Frais exite pas.";
              include("vues/v_suivreFraisLogVisiteur.php");
              include("vues/v_erreurFrais.php");
         }
            
             
         break;
    }
     case 'reboursementFrais' : {
         
        $idVisiteur = $_REQUEST['idVisiteur'];
        $leMois = $_REQUEST['moisFrais'];

        $lesMois=$pdo->getMoisDisponibles();
        $moisASelectionner = $leMois;

        $nomVisiteur=$pdo->getNomVisiteur($idVisiteur,$leMois);
        $pdo->majEtatRemboursement($idVisiteur,$leMois);

        $lesVisiteurs=$pdo->getLesVisiteurs();
        $visiteurASelectionner = $nomVisiteur; 

        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);

	
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];

		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);

         include("vues/v_suivreFraisLogVisiteur.php");
         include("vues/v_rembFraisForfait.php"); 
         include("vues/v_rembHorsForfait.php"); 
        
        break;
         
         }

    break;

}

?>

