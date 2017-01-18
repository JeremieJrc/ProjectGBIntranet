<?php

include("vues/v_sommaireCompt.php");

$mois = getMois(date("d/m/Y"));
$numAnnee =substr( $mois,0,4);
$numMois =substr( $mois,4,2);


$action = $_REQUEST['action'];

switch($action){
    case 'logVisiteursFrais':{

        $lesMois=$pdo->getMoisDisponibles();
        $lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
   
        $lesVisiteurs=$pdo->getLesVisiteurs();
        $lesClesV = array_keys( $lesVisiteurs );
		$visiteurASelectionner = $lesClesV[0];

        include("vues/v_validFraisLogVisiteur.php");
        
        break;
     }
    case 'voirFrais' :{
        
           $leMois = $_REQUEST['lstMois'];
           $nomVisiteur=$_REQUEST['lsVisiteurs'];
       
           $lesMois=$pdo->getMoisDisponibles();
           $moisASelectionner = $leMois;

           $lesVisiteurs=$pdo->getLesVisiteurs();
           $visiteurASelectionner = $nomVisiteur;
           
           include("vues/v_validFraisLogVisiteur.php");

        
                          if(!$pdo->existLigneFraisMois($nomVisiteur,$leMois))
                          {
                              $idVisiteur=$pdo->getIdVisiteur($nomVisiteur,$leMois);

                               if(!$pdo->existeLigneFraisRemboursee($leMois,$idVisiteur)){
                                     $errreurfrais="Fiche Frais déjà remboursé"; 
                                    include("vues/v_erreurFrais.php");
                                    }
                                    else
                                    {   
                                        $somme=$pdo->sommeFraisForfait($idVisiteur,$leMois);
                                     
                                        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
		                                $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);
		                                $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);

		                                $numAnnee =substr( $leMois,0,4);
		                                $numMois =substr( $leMois,4,2);

		                                $libEtat = $lesInfosFicheFrais['libEtat'];
		                                $montantValide = $lesInfosFicheFrais['montantValide'];
		                                $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];

		                                $dateModif =  $lesInfosFicheFrais['dateModif'];
		                                $dateModif =  dateAnglaisVersFrancais($dateModif);
		                                   
                                        include("vues/v_validFormFrais.php");
                                        include("vues/v_validFormHorsFrais.php");
                                    }
               
                          }else{
                               $errreurfrais="Fiche Frais Fiche Frais exite pas.";
                               include("vues/v_erreurFrais.php");
                           }   
                 
           break;
       }
    case 'validForfaitFrais':{
            
          //Ici gestion d'abord requete permetta,t la recuperation du idVisiteur
          //requette fonction de frais select idVisteur from

           $lesMois=$pdo->getMoisDisponibles();
           $lesVisiteurs=$pdo->getLesVisiteurs();
           include("vues/v_validFraisLogVisiteur.php");
           
              $idVisiteur = $_REQUEST['idVisiteur'];    
              $leMois = $_REQUEST['dateMois'];
              $lesFrais = $_REQUEST['lesFrais'];
              $nbJustificatif = $_REQUEST['nbJustificatif'];
              
              
		        if(lesQteFraisValides($lesFrais)){

                    $pdo->majFraisForfait($idVisiteur,$leMois,$lesFrais);
                    $pdo-> majNbJustificatifs($idVisiteur, $leMois, $nbJustificatif);
                    $pdo-> majEtatFicheFrais($idVisiteur,$leMois,'VA');
                    
                    $somme=$pdo->sommeFraisForfait($idVisiteur,$leMois);
                    $pdo-> majSommeFraisForfait($idVisiteur,$leMois,$somme['sommeForfait']);


                        
		               $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
		               $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);
		               $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);

                       $nomVisiteur=$pdo->getNomVisiteur($idVisiteur,$leMois);

		               $numAnnee =substr( $leMois,0,4);
		               $numMois =substr( $leMois,4,2);

		               $libEtat = $lesInfosFicheFrais['libEtat'];
		               $montantValide = $lesInfosFicheFrais['montantValide'];
		               $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];

		               $dateModif =  $lesInfosFicheFrais['dateModif'];
		               $dateModif =  dateAnglaisVersFrancais($dateModif);

                       
		               include("vues/v_validFormFrais.php");
                       include("vues/v_validFormHorsFrais.php");
		        }
		        else{
			        ajouterErreur("Les valeurs des frais doivent être numériques");
			        include("vues/v_erreurs.php");
		        }


	  break;
	}
    case 'reporterFrais' :{
       
        $idFrais = $_REQUEST['idFrais'];

        $numMoisnext=$numMois+1;
        $rdate=date("d/$numMoisnext/Y");
        $moisNext=getMois($rdate);
       
        $LaLigneHorsForfait=$pdo->getInfosligneHorsforfait($idFrais);

         foreach($LaLigneHorsForfait as $info)
         {
             $idVisiteur=$info['IdVisiteur'];
             $leMois=$info['moisHorsForfait'];
             $libelle=$info['libelle'];
             $dateCreate=$info['dateLigne'];
             $montant=$info['montant'];
         }

         if($pdo->estPremierFraisMois($idVisiteur,$moisNext)){
			$pdo->creeNouvellesLignesFrais($idVisiteur,$moisNext);    
		  }
         $dateCreate=dateAnglaisVersFrancais($dateCreate);

        //Creation horsForfait
         valideInfosFrais($dateCreate,$libelle,$montant);
	     if (nbErreurs() != 0 ){
			include("vues/v_erreurs.php");
		}
		else{
			$pdo->creeNouveauFraisHorsForfait($idVisiteur,$moisNext,$libelle,$dateCreate,$montant);
		     
             //Supprime le frais hors forfait avec sont id
             $pdo->supprimerFraisHorsForfait($idFrais);     
        }


        //MiSE EN PLACE TRAITEMENT VUE

            //Pour LogVisiteurComptable

           $lesMois=$pdo->getMoisDisponibles();
           $lesVisiteurs=$pdo->getLesVisiteurs();

           //Pour les FormulaireValidFrais

           $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
           $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur, $leMois); 
           $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
           $nomVisiteur=$pdo->getNomVisiteur($idVisiteur, $leMois);

           $libEtat = $lesInfosFicheFrais['libEtat'];
		   $montantValide = $lesInfosFicheFrais['montantValide'];
		   $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];

		   $dateModif =  $lesInfosFicheFrais['dateModif'];
		   $dateModif =  dateAnglaisVersFrancais($dateModif);

           include("vues/v_validFraisLogVisiteur.php");

           $numAnnee =substr($leMois,0,4);
		   $numMois =substr($leMois,4,2);

           include("vues/v_validFormFrais.php");
           include("vues/v_validFormHorsFrais.php");

                break;
            }

    case 'refuserFrais' :{
       
            $idFrais = $_REQUEST['idFrais'];
           
            //Recuperation du frais HorsForfait

                $LaLigneHorsForfait=$pdo->getInfosligneHorsforfait($idFrais);
                
                    foreach($LaLigneHorsForfait as $info)
                    {
                        $idVisiteur=$info['IdVisiteur'];
                        $leMois=$info['moisHorsForfait'];
                        $libelle=$info['libelle'];
                        $dateCreate=$info['dateLigne'];
                        $montant=$info['montant'];
                    }

                    $pdo->majLibelleLigneHorsForfait($idFrais,$libelle); 

                       //MiSE EN PLACE TRAITEMENT VUE

                       //Pour LogVisiteurComptable

                       $lesMois=$pdo->getMoisDisponibles();
                       $lesVisiteurs=$pdo->getLesVisiteurs();

                       //Pour les FormulaireValidFrais

                       $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
                       $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur, $leMois); 
                       $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
                       $nomVisiteur=$pdo->getNomVisiteur($idVisiteur, $leMois);
                       

                       $libEtat = $lesInfosFicheFrais['libEtat'];
		               $montantValide = $lesInfosFicheFrais['montantValide'];
		               $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];

                       $numAnnee =substr($leMois,0,4);
		               $numMois =substr($leMois,4,2);
                       echo($numMois);

		               $dateModif =  $lesInfosFicheFrais['dateModif'];
		               $dateModif =  dateAnglaisVersFrancais($dateModif);

                       include("vues/v_validFraisLogVisiteur.php");

                       $numAnnee =substr($leMois,0,4);
		               $numMois =substr($leMois,4,2);
                       include("vues/v_validFormFrais.php");
                       include("vues/v_validFormHorsFrais.php");
                       

            break;
       }
              
    break;
    }
                
?>