
 <div class="row"> 
     <div class="col-md-12 col-xs-12 col-sm-12">
        
 <!--Visuelles des des saisie de validation des hors forfait-->
    <div class="row">    
        <div class="col-lg-12 col-md-12 col-xs-12">
  	          <table class="listeLegere">
  	               <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
                   </caption>
                         <tr class="lsfrais">
                            <th class="date">Date</th>
                            <th class="libelle">Libellé</th>
                            <th class="montant">Montant</th>
                            <th class="action">Commande</th>
                                            
                         </tr>
                    <?php      
                      foreach ( $lesFraisHorsForfait as $unFraisHorsForfait ) 
		              {
			            $date = $unFraisHorsForfait['date'];
			            $libelle = $unFraisHorsForfait['libelle'];
			            $montant = $unFraisHorsForfait['montant'];
                        $id = $unFraisHorsForfait['id'];
		            ?>
                         <tr>
                            <td><?php echo $date ?></td>
                            <td><?php echo $libelle ?></td>
                            <td><?php echo $montant ?></td>
                            <td>

                                <a class="btn btn-primary" href="index.php?uc=valideFrais&action=refuserFrais&idFrais=<?php echo $id ?>" 
				                onclick="return confirm('Voulez-vous vraiment refuser ce frais?');">Refuser</a>
                                
                                <a class="btn btn-primary" href="index.php?uc=valideFrais&action=reporterFrais&idFrais=<?php echo $id ?>" 
				                onclick="return confirm('Voulez-vous vraiment reporter ce frais?');">Reporter</a>
                            
                            </td>
                         </tr>
                    <?php 
                      }
		            ?>
                </table> 
            </div>
        </div>  
    </div>
  </div>



<!--close container id=validForm-->
</div>


