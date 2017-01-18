<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch($action){
	case 'demandeConnexion':{
		
        //include("vues/v_connexion.php");
        include("vues/v_connexionLogin.php");  
		
        break;
	}
	case 'valideConnexion':{
		$login = $_REQUEST['login'];
		$mdp = $_REQUEST['mdp'];
        $typeUser = $_REQUEST['typeUser'];

              switch($typeUser){
                  case '1':{
                           $visiteur = $pdo->getInfosVisiteur($login,$mdp);
		                   if(!is_array( $visiteur)){
			                    ajouterErreur("Login ou mot de passe incorrect");
			                    include("vues/v_erreurs.php");
			            
                                include("vues/v_connexionLogin.php");
		                    }
		                    else{
			                    $id = $visiteur['id'];
			                    $nom =  $visiteur['nom'];
			                    $prenom = $visiteur['prenom'];
			                    connecter($id,$nom,$prenom);

                                include("vues/v_sommaireVisiteur.php");
                                include("vues/v_accueilVisiteur.php");
		                   }
                            break;  
                          }
                 case'2':{
                      
                      $comptable = $pdo->getInfosComptable($login,$mdp);
                      
                      if(!is_array( $comptable)){
			            ajouterErreur("Login ou mot de passe incorrect");
			            include("vues/v_erreurs.php");
			           
                        include("vues/v_connexionLogin.php");
		            }
		                else{
			            $id = $comptable['id'];
			            $nom =  $comptable['nom'];
			            $prenom = $comptable['prenom'];
			            connecter($id,$nom,$prenom);
			            
                        include("vues/v_sommaireCompt.php");
                        include("vues/v_accueilComptable.php");

                        
		           }  
                   break; 
                  }
                case '0':{
                        ajouterErreur("Login ou mot de passe incorrect");
			            include("vues/v_erreurs.php");
                        include("vues/v_connexionLogin.php"); 
                        break;
                       }
                       break;
              }
              break;
 }
    default :{
		
                include("vues/v_connexionLogin.php");
                break;
	        }
}

