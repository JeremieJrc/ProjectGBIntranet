

<div id="etat_frais" class="container">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
               <h3 id="idEtatFrais">Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> : </h3>
            </div>
       
    
                <div class="col-lg-6 col-md-6 col-xs-6">
                  <p id="idEtatlib"> Etat : <?php echo $libEtat?> <br>
                      le : <?php echo $dateModif?> <br> 
                    Montant validé : <?php echo $montantValide?> </p>
            </div>
       </div>
    
    <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                 <table class="listeLegere">
  	               <caption>Eléments forfaitisés </caption>
                    <tr>
                     <?php
                     foreach ( $lesFraisForfait as $unFraisForfait ) 
		             {
			            $libelle = $unFraisForfait['libelle'];
		            ?>	
			            <th class="elementForfait"> <?php echo $libelle?></th>
		             <?php
                    }
		            ?>
		            </tr>
                    <tr>
                    <?php
                      foreach (  $lesFraisForfait as $unFraisForfait  ) 
		              {
				            $quantite = $unFraisForfait['quantite'];
		            ?>
                            <td class="qteForfait"><?php echo $quantite?> </td>
		             <?php
                      }
		            ?>
		            </tr>
                </table>
              </div>
            </div>
    


           <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
  	            <table class="listeLegere">
  	               <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
                   </caption>
                         <tr>
                            <th class="date">Date</th>
                            <th class="libelle">Libellé</th>
                            <th class='montant'>Montant</th>                
                         </tr>
                    <?php      
                      foreach ( $lesFraisHorsForfait as $unFraisHorsForfait ) 
		              {
			            $date = $unFraisHorsForfait['date'];
			            $libelle = $unFraisHorsForfait['libelle'];
			            $montant = $unFraisHorsForfait['montant'];
		            ?>
                         <tr>
                            <td><?php echo $date ?></td>
                            <td><?php echo $libelle ?></td>
                            <td><?php echo $montant ?></td>
                         </tr>
                    <?php 
                      }
		            ?>
                </table>
            </div>
          </div>
</div>









