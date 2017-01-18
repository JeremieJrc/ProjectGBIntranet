
<div id="rembtvisiteurForfait" class="container">
    <div class="row"> 
            <div class="col-lg-8 col-md-8 col-xs-8">
                <h2 id="ficheRemboursementForm">Suivie Remboursement Frais Visiteur  : <?php echo $nomVisiteur ?> du mois 
                    <?php echo(substr($leMois,4,2)."/".substr($leMois,0,4)); ?> </h2>
            </div> 
    </div>


    <!--Visuelles des des suivie des forfait-->
        
        <table class="listeLegere">
            <caption>Suivie Remboursement forfait</caption>


            <tr  class="remboursementVisiteur">
                <th class="infoCellule">Identifiant</th>
                <th class="infoCellule">Forfait Etape</th>
                <th class="infoCellule">Frais Kilometrique</th>
                <th class="infoCellule">Nuit Hotel</th>
                <th class="infoCellule">Repas Restaurant</th>
                <th class="infoCellule"> Montant total</th>
                <th class="infoCellule">Status Frais</th>
                <th class="infoCellule">Date modification</th>
                <th class="infoCellule">Nb Justificatifs</th>
                <th class="infoCellule">Commande</th>
            </tr>
            <tr>
                
                <td><?php echo($idVisiteur);?></td>
            
                 <?php
                      foreach (  $lesFraisForfait as $unFraisForfait  ) 
		              {
				            $quantite = $unFraisForfait['quantite'];
		            ?>
                            <td class="qteForfait"><?php echo $quantite?> </td>
		             <?php
                      }
		            ?>
                  
                   <td><?php echo($montantValide);?></td> 
                   <td><?php echo($libEtat);?></td>
                   <td><?php echo($dateModif);?></td> 
                   <td><?php echo($nbJustificatifs);?></td> 
                
                
                <td><a class="btn btn-primary" href="index.php?uc=suivreFrais&action=reboursementFrais&idVisiteur=<?php echo $idVisiteur?>&moisFrais=<?php echo $leMois?>" 
				                onclick="return confirm('Voulez-vous vraiment rebourser les frais ?');">Rembourser</a></td>   
                
        </table>
   
 
