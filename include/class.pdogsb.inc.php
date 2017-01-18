<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=gsb_v1';   		
      	private static $user='root' ;    		
      	private static $mdp='' ;	
		private static $monPdo;
		private static $monPdoGsb=null;
/**
 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				
	private function __construct(){
    	PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp); 
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoGsb::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
 * @return l'unique objet de la classe PdoGsb
 */
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;  
	}
/**
 * Retourne les informations d'un visiteur
 
 * @param $login 
 * @param $mdp
 * @return l'id, le nom et le prénom sous la forme d'un tableau associatif 
*/
	public function getInfosVisiteur($login, $mdp){
		$req = "select visiteur.id as id, visiteur.nom as nom, visiteur.prenom as prenom
        from visiteur where visiteur.login='$login' and visiteur.mdp='$mdp'";
		$rs = PdoGsb::$monPdo->query($req);
		$ligne = $rs->fetch();
		return $ligne;
	}

    /**
 * Retourne les informations d'un Comptable
 
 * @param $login 
 * @param $mdp
 * @return l'id, le nom et le prénom sous la forme d'un tableau associatif 
*/
	public function getInfosComptable($login, $mdp){
		$req = "select comptable.id as id, comptable.nom as nom, comptable.prenom as prenom 
        from comptable where comptable.login='$login' and comptable.mdp='$mdp'";
		$rs = PdoGsb::$monPdo->query($req);
		$ligne = $rs->fetch();
		return $ligne;
	}

/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
 * concernées par les deux arguments
 
 * La boucle foreach ne peut être utilisée ici car on procède
 * à une modification de la structure itérée - transformation du champ date-
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif 
*/
	public function getLesFraisHorsForfait($idVisiteur,$mois){
	    $req = "select * from lignefraishorsforfait where lignefraishorsforfait.idvisiteur ='$idVisiteur' 
		and lignefraishorsforfait.mois = '$mois' ";	
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		$nbLignes = count($lesLignes);
		for ($i=0; $i<$nbLignes; $i++){
			$date = $lesLignes[$i]['date'];
			$lesLignes[$i]['date'] =  dateAnglaisVersFrancais($date);
		}
		return $lesLignes; 
	}
/**
 * Retourne le nombre de justificatif d'un visiteur pour un mois donné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return le nombre entier de justificatifs 
*/
	public function getNbjustificatifs($idVisiteur,$mois){
		$req = "select fichefrais.nbjustificatifs as nb from  fichefrais where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne['nb'];
	}
/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
 * concernées par les deux arguments
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif 
*/
	public function getLesFraisForfait($idVisiteur, $mois){
		$req = "select fraisforfait.id as idfrais, fraisforfait.libelle as libelle, 
		lignefraisforfait.quantite as quantite from lignefraisforfait inner join fraisforfait 
		on fraisforfait.id = lignefraisforfait.idfraisforfait
		where lignefraisforfait.idvisiteur ='$idVisiteur' and lignefraisforfait.mois='$mois' 
		order by lignefraisforfait.idfraisforfait";	
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes; 
	}
/**
 * Retourne tous les id de la table FraisForfait
 
 * @return un tableau associatif 
*/
	public function getLesIdFrais(){
		$req = "select fraisforfait.id as idfrais from fraisforfait order by fraisforfait.id";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
/**
 * Met à jour la table ligneFraisForfait
 
 * Met à jour la table ligneFraisForfait pour un visiteur et
 * un mois donné en enregistrant les nouveaux montants
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
 * @return un tableau associatif 
*/
	public function majFraisForfait($idVisiteur, $mois,$lesFrais){
		$lesCles = array_keys($lesFrais);
		foreach($lesCles as $unIdFrais){
			$qte = $lesFrais[$unIdFrais];
			$req = "update lignefraisforfait set lignefraisforfait.quantite = $qte
			where lignefraisforfait.idvisiteur = '$idVisiteur' and lignefraisforfait.mois = '$mois'
			and lignefraisforfait.idfraisforfait = '$unIdFrais'";
			PdoGsb::$monPdo->exec($req);
		}
		
	}
/**
 * met à jour le nombre de justificatifs de la table ficheFrais
 * pour le mois et le visiteur concerné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
*/
	public function majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs){
		$req = "update fichefrais set nbjustificatifs = $nbJustificatifs 
		where fichefrais.idvisiteur = '$idVisiteur' and fichefrais.mois = '$mois'";
		PdoGsb::$monPdo->exec($req);	
	}
/**
 * Teste si un visiteur possède une fiche de frais pour le mois passé en argument
  
 * @param $mois sous la forme aaaamm
 * @return vrai ou faux 
*/	
	public function estPremierFraisMois($idVisiteur,$mois)
	{
		$ok = false;
		$req = "select count(*) as nblignesfrais from fichefrais 
		where fichefrais.mois = '$mois' and fichefrais.idvisiteur = '$idVisiteur'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		if($laLigne['nblignesfrais'] == 0){
			$ok = true;
		}
		return $ok;
	}
/**
 * Teste si un visiteur possède une fiche de frais pour le mois passé en argument
 
 * @param $nomVisiteur 
 * @param $mois sous la forme aaaamm
 * @return vrai ou faux 
*/	
	public function existLigneFraisMois($nomVisiteur,$mois)
	{
		$ok = false;

		$req = "select count(*) As nblignesfrais
        from fichefrais inner join visiteur on fichefrais.idVisiteur = visiteur.id
        where visiteur.nom = '$nomVisiteur' and fichefrais.mois='$mois'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		if($laLigne['nblignesfrais'] == 0){
			$ok = true;
		}
		return $ok;
	}

/**
 * Teste si un visiteur possède une fiche de frais pour le mois fiche RB
 * @param $idVisiteur 
 * @param $leMois sous la forme aaaamm
 * @return vrai ou faux 
*/	

public function existeLigneFraisRemboursee($idVisiteur,$leMois){
    
    $ok = false;

		$req = "select count(*) As ligneremboursee
         from lignefraishorsforfait inner join
        fichefrais On lignefraishorsforfait.idVisiteur = fichefrais.idVisiteur And
        lignefraishorsforfait.mois = fichefrais.mois inner join
        etat On fichefrais.idEtat = etat.id
        Where fichefrais.mois = '$leMois' And
        fichefrais.idEtat = 'RB' And
        lignefraishorsforfait.idVisiteur = '$idVisiteur'";
		
        $res = PdoGsb::$monPdo->query($req);
		
        $laLigne = $res->fetch();
		if($laLigne['ligneremboursee'] == 0){
			$ok = true;
		}
		return $ok;
	}

/**
 * Teste si un visiteur possède une fiche de frais pour le mois fiche en CL ou CR
 * @param $idVisiteur 
 * @param $leMois sous la forme aaaamm
 * @return vrai ou faux 
*/	


 public function exiteLigneFraisCL_CR($idVisiteur,$leMois)
 {
    $ok = false;

    	$req = "Select
  count(*) as nbLigne  
From
  fichefrais
Where
  (fichefrais.idEtat = 'CL' Or
    fichefrais.idEtat = 'CR') And
  fichefrais.mois = '$leMois' And
  fichefrais.idVisiteur = '$idVisiteur'";
		
        $res = PdoGsb::$monPdo->query($req);
		
        $laLigne = $res->fetch();
		if($laLigne['nbLigne'] == 0){
			$ok = true;
		}
		return $ok; 
 }

/**
 * Retourne le dernier mois en cours d'un visiteur
 
 * @param $idVisiteur 
 * @return le mois sous la forme aaaamm
*/	
	public function dernierMoisSaisi($idVisiteur){
		$req = "select max(mois) as dernierMois from fichefrais where fichefrais.idvisiteur = '$idVisiteur'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		$dernierMois = $laLigne['dernierMois'];
		return $dernierMois;
	}
	
/**
 * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un visiteur et un mois donnés
 
 * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
 * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
*/
	public function creeNouvellesLignesFrais($idVisiteur,$mois){
		$dernierMois = $this->dernierMoisSaisi($idVisiteur);
		$laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur,$dernierMois);
		if($laDerniereFiche['idEtat']=='CR'){
				$this->majEtatFicheFrais($idVisiteur, $dernierMois,'CL');
				
		}
		$req = "insert into fichefrais(idvisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat) 
		values('$idVisiteur','$mois',0,0,now(),'CR')";
		PdoGsb::$monPdo->exec($req);
		$lesIdFrais = $this->getLesIdFrais();
		foreach($lesIdFrais as $uneLigneIdFrais){
			$unIdFrais = $uneLigneIdFrais['idfrais'];
			$req = "insert into lignefraisforfait(idvisiteur,mois,idFraisForfait,quantite) 
			values('$idVisiteur','$mois','$unIdFrais',0)";
			PdoGsb::$monPdo->exec($req);
		 }
	}
/**
 * Crée un nouveau frais hors forfait pour un visiteur un mois donné
 * à partir des informations fournies en paramètre
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @param $libelle : le libelle du frais
 * @param $date : la date du frais au format français jj//mm/aaaa
 * @param $montant : le montant
*/
	public function creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$date,$montant){
		$dateFr = dateFrancaisVersAnglais($date);
		$req = "insert into lignefraishorsforfait 
		values('','$idVisiteur','$mois','$libelle','$dateFr','$montant')";
		PdoGsb::$monPdo->exec($req);
	}
/**
 * Supprime le frais hors forfait dont l'id est passé en argument
 
 * @param $idFrais 
*/
	public function supprimerFraisHorsForfait($idFrais){
		$req = "delete from lignefraishorsforfait where lignefraishorsforfait.id =$idFrais ";
		PdoGsb::$monPdo->exec($req);
	}
/**
 * Retourne les mois pour lesquel un visiteur a une fiche de frais
 
 * @param $idVisiteur 
 * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant 
*/
	public function getLesMoisDisponibles($idVisiteur){
		$req = "select fichefrais.mois as mois from  fichefrais where fichefrais.idvisiteur ='$idVisiteur' 
		order by fichefrais.mois desc ";
		$res = PdoGsb::$monPdo->query($req);

		$lesMois =array();
		$laLigne = $res->fetch();

		while($laLigne != null)	{
			$mois = $laLigne['mois'];
			$numAnnee =substr( $mois,0,4);
			$numMois =substr( $mois,4,2);
			$lesMois["$mois"]=array(
		     "mois"=>"$mois",
		    "numAnnee"  => "$numAnnee",
			"numMois"  => "$numMois"
             );
			$laLigne = $res->fetch(); 		
		}
		return $lesMois;
	}

/**
 * Retourne les mois dans les fiches de frais
 
 * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant 
*/

    public function getMoisDisponibles(){
        $req = "select fichefrais.mois as mois from  fichefrais 
		order by fichefrais.mois desc ";
        $res = PdoGsb::$monPdo->query($req);
        
        $lesMois =array();
		$laLigne = $res->fetch();

		while($laLigne != null)	{
			$mois = $laLigne['mois'];
			$numAnnee =substr( $mois,0,4);
			$numMois =substr( $mois,4,2);
			
            $lesMois["$mois"]=array(
		     "mois"=>"$mois",
		    "numAnnee"  => "$numAnnee",
			"numMois"  => "$numMois"
             );
			$laLigne = $res->fetch(); 		
		}
		return $lesMois;  
    }
/**
 * Retourne les noms des Visiteurs present dans les fiches de frais

 * @return un tableau nom des Visiteurs 
*/

 public function getLesVisiteurs(){
     
     $req="select visiteur.nom as nom
     from visiteur inner join fichefrais On fichefrais.idVisiteur = visiteur.id
     group by visiteur.nom";

     $rs = PdoGsb::$monPdo->query($req);
     $nomsVisiteurs =array(); //Cree tab nom visiteurs
 
     while($ligne = $rs->fetch()){
          $nomsVisiteurs[]=$ligne['nom'];    
     }
	 return $nomsVisiteurs;
          
 }

 /**
 * Retourne idVisiteurs du Visiteurs fonction de la date et le nom Visiteur
 *present dans la fiche Frais
  * @param $idVisiteur
   * @param $leMois
 * @return idVisiteur de FicheFrais
*/

  public function getIdVisiteur($unVisiteur,$leMois){
      
      $req="select fichefrais.idVisiteur As idVisiteur
      from visiteur inner join fichefrais On fichefrais.idVisiteur = visiteur.id inner join
      lignefraisforfait On lignefraisforfait.idVisiteur = fichefrais.idVisiteur and
      lignefraisforfait.mois = fichefrais.mois
      where visiteur.nom = '$unVisiteur' and lignefraisforfait.mois = '$leMois'";
      
      $rs = PdoGsb::$monPdo->query($req);
           
      while($ligne = $rs->fetch())
      {
          $idVisiteur=$ligne['idVisiteur'];     
      }
       return $idVisiteur;
  }

   /**
 * Retourne nomVisiteurs du Visiteurs fonction de la date et idVisiteur
 *present dans la fiche Frais
 * @return nomVisiteur de FicheFrais
*/

public function getNomVisiteur($idVisiteur,$leMois){

      $req="select visiteur.nom As nomVisiteur
      From visiteur inner join fichefrais On fichefrais.idVisiteur = visiteur.id inner join
      lignefraisforfait On lignefraisforfait.idVisiteur = fichefrais.idVisiteur And
      lignefraisforfait.mois = fichefrais.mois
      Where fichefrais.idVisiteur = '$idVisiteur' and lignefraisforfait.mois = '$leMois'";
      
      $rs = PdoGsb::$monPdo->query($req);
           
      while($ligne = $rs->fetch())
      {
          $nomVisiteur=$ligne['nomVisiteur'];     
      }
       return $nomVisiteur;

}

/**
 * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état 
*/	

	public function getLesInfosFicheFrais($idVisiteur,$mois){
		$req = "select ficheFrais.idEtat as idEtat, ficheFrais.dateModif as dateModif, ficheFrais.nbJustificatifs as nbJustificatifs, 
			ficheFrais.montantValide as montantValide, etat.libelle as libEtat from  fichefrais inner join Etat on ficheFrais.idEtat = Etat.id 
			where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne;
	}

/**
 * Modifie l'état et la date de modification d'une fiche de frais
 
 * Modifie le champ idEtat et met la date de modif à aujourd'hui
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 */
 
	public function majEtatFicheFrais($idVisiteur,$mois,$etat){
		$req = "update ficheFrais set idEtat = '$etat', dateModif = now() 
		where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
		PdoGsb::$monPdo->exec($req);
	}

/**
 * Permet de retourner les fiche de Frais a cloturer
 
 * @param $mois
 * @return un tableau avec des champs de jointure entre une fiche de frais et visiteurs 
 */

    public function cloturerFrais($mois){
        
        $req = "select visiteur.nom as Nom,visiteur.prenom as Prenom,
        visiteur.id as Identifiant, fichefrais.idEtat as idEtat,
        fichefrais.mois as mois,etat.libelle as libEtat
        from visiteur Inner Join fichefrais On fichefrais.idVisiteur = visiteur.id inner join etat On fichefrais.idEtat = etat.id
        where fichefrais.mois<'$mois'and fichefrais.idEtat='CR'";
		
        $res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();

		return $lesLignes;
    }

/**
 * Modifie l'état et la date de modification d'une fiche de frais
 
 * Modifie le champ idEtat
 * @param $mois
 * @param $mois sous la forme aaaamm
 */

    public function majEtatclotureFrais($mois)
    {
        $req = "update ficheFrais set ficheFrais.idEtat = 'CL' where fichefrais.mois <'$mois'";
		PdoGsb::$monPdo->exec($req);
    }

/**
 * Modifie l'état et la date de modification d'une fiche de frais
 
 * Modifie le champ idEtat
 * @param $idVisiteur
 * @param $mois
 * @param $mois sous la forme aaaamm
 */

    public function majEtatRemboursement($idVisiteur,$mois)
    {
        $req = "update ficheFrais set idEtat ='RB' where fichefrais.mois='$mois'and fichefrais.idVisiteur='$idVisiteur'";
		PdoGsb::$monPdo->exec($req);
    }


    /**
 * Permet de retourner les tous les champs de ligneHors forfait
 
 * @param $id de ligneHorsForfait
 * @return un tableau avec des champs de jointure entre une ligneHorsForfait et fiche frais 
 */

 public function getInfosligneHorsforfait($id){
     
     $req="select lignefraishorsforfait.idVisiteur as IdVisiteur,
            lignefraishorsforfait.mois As moisHorsForfait,
            lignefraishorsforfait.libelle as libelle,
            lignefraishorsforfait.date as dateLigne,
            lignefraishorsforfait.montant as montant
            from lignefraishorsforfait inner join
            fichefrais On lignefraishorsforfait.idVisiteur = fichefrais.idVisiteur And
            lignefraishorsforfait.mois = fichefrais.mois
            where lignefraishorsforfait.id = $id";

            $res=PdoGsb :: $monPdo->query($req);

            $lesLignes=$res->fetchAll();


            return $lesLignes;
 }
 /**
 * Permet mettre a jour libelle lignefraishorsforfait a Refuser
 
 * @param $id de ligneHorsForfait

 */
  public function majLibelleLigneHorsForfait($id,$libelle)
    {
        
        $libelle=trocateLibelleHorsForfait($libelle);
        $req="update lignefraishorsforfait set libelle='$libelle' where lignefraishorsforfait.id='$id'";
        PdoGsb::$monPdo->exec($req);
    }


 /**
 * Retourne le motant des frais forfait du visiteur
 
 * @param $idVisiteur
 *@param $mois
 * @return la somme des fraisforfait du mois  
 */

 public function sommeFraisForfait($idVisiteur,$mois)
 {
    $req="Select sum(fraisforfait.montant *lignefraisforfait.quantite) as sommeForfait
  From fraisforfait inner join lignefraisforfait On lignefraisforfait.idFraisForfait = fraisforfait.id
  inner join fichefrais On lignefraisforfait.idVisiteur = fichefrais.idVisiteur And
  lignefraisforfait.mois = fichefrais.mois  
    where fichefrais.idVisiteur='$idVisiteur'
    and fichefrais.mois='$mois'";
    
     $res=PdoGsb :: $monPdo->query($req);

    $ligne = $res->fetch();
  
    return $ligne;
 }


  /**
 * Mise Jour Motant  des frais forfait du visiteur
 * @param $idVisiteur
 *@param $mois
 * @param $somme
 */

 public function majSommeFraisForfait($idVisiteur,$leMois,$somme){

     $req="update fichefrais set montantValide='$somme' 
     where fichefrais.idVisiteur='$idVisiteur'and fichefrais.mois='$leMois'";
     PdoGsb::$monPdo->exec($req);   
 }


}
?>