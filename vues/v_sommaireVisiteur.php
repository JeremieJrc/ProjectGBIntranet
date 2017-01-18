<div class="container">
	<nav class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
                                 data-target="#navbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
                    <span class="icon-bar"></span>                         
				</button>
                <h3>Visiteurs <?php echo $_SESSION['prenom']."  ".$_SESSION['nom']?></h3>
		</div>   
			
            <div class="single-page-nav sticky-wrapper" id="tmNavbar">
				<ul class="nav navbar-nav">
					<li><a href="index.php?uc=acccueil&action=accueilVisiteur">Accueil</a></li>
					<li><a href="index.php?uc=gererFrais&action=saisirFrais" title="Saisie fiche de frais" >Saisie Fiche Frais</a></li>
					<li><a href="index.php?uc=etatFrais&action=selectionnerMois" title="Consultation de mes fiches de frais">Suivie Remboursement</a></li>
					<li><a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Deconnexion</a></li>
				</ul>
		    </div>   
	    </div>
	</nav>    
    <!--menu Visiteurs end-->
    </div>