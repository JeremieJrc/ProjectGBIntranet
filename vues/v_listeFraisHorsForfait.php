

                <table class="listeLegere">
  	                   <caption>Descriptif des éléments hors forfait
                       </caption>
                             <tr id="lsLibel">
                                <th class="date">Date</th>
				                <th class="libelle">Libellé</th>  
                                <th class="montant">Montant</th>  
                                <th class="action">Commande</th>              
                             </tr>
          
                    <?php    
	                    foreach( $lesFraisHorsForfait as $unFraisHorsForfait) 
		                {
			                $libelle = $unFraisHorsForfait['libelle'];
			                $date = $unFraisHorsForfait['date'];
			                $montant=$unFraisHorsForfait['montant'];
			                $id = $unFraisHorsForfait['id'];
	                ?>		
                            <tr id="horfortfait">
                                <td> <?php echo $date ?></td>
                                <td><?php echo $libelle ?></td>
                                <td><?php echo $montant ?></td>
                                <td><a href="index.php?uc=gererFrais&action=supprimerFrais&idFrais=<?php echo $id ?>" 
				                onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer ce frais</a></td>
                             </tr>
	                <?php		   
                          }
	                ?>	                                  
                    </table>

     
        <form class="idform" action="index.php?uc=gererFrais&action=validerCreationFrais" method="post">
        <div class="row"> 
          <fieldset> 
            <legend id="newElemHforfait">Nouvel élément hors forfait</legend>
            
              <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="element-input">
                    <label for="txtLibelleHF">Libellé</label>
                        <input type="text" id="txtLibelleHF" name="libelle" size="70" maxlength="150" value="" />
                </div>
              </div>
              
              <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="element-input">
                        <label for="txtDateHF">Date (jj/mm/aaaa): </label>

                            <input type="text" id="txtDateHF" name="dateFrais" size="10" maxlength="10" value=""  />
            
              </div>
            </div>
            
              <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="element-input">
                          <label for="txtMontantHF">Montant : </label>
                          <input type="text" id="txtMontantHF" name="montant" size="10" maxlength="10" value="" />
                        </div>
                </div>

          </fieldset>
      </div>

        <div class="row">
             <div class="col-md-12 col-xs-12 col-sm-12">    
                    <p id="input_hsForfait">
                        <input id="ajouter" type="submit" value="Ajouter"/>
                        <input id="effacer" type="reset" value="Effacer" />
                    </p> 
              </div>
            </div>
      </form>

    <!-- end container v_listefrais -->   
  </div>


