  
<div class="container">
 <!--menu start-->
	<nav class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
				</button>
                <h3>Comptable <?php echo $_SESSION['prenom']."  ".$_SESSION['nom']?></h3>
		</div>   
			
            <div class="single-page-nav sticky-wrapper" id="tmNavbar">
				<ul class="nav navbar-nav">
                    <li>
                        <a href="index.php?uc=acccueil&action=accueilComptable">Accueil</a></li>

                    <li>
                        <a href="index.php?uc=clotureFrais&action=voirCloturerFrais">Clôturer</a></li>

					<li>
                        <a href="index.php?uc=valideFrais&action=logVisiteursFrais" title="Saisie fiche de frais ">Valide Fiche Frais</a></li>

					<li>
                        <a href="index.php?uc=suivreFrais&action=logVRemboursementFrais" title="Consultation de mes fiches de frais">Suivie Remboursement</a></li>

					<li>
                        <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Deconnexion</a></li>
				</ul>
		    </div>   
	    </div>
	</nav>    
    <!--menu end-->
    </div>