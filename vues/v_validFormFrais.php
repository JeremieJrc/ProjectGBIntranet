
<div id="validform" class="container">
    <div class="row"> 
            <div class="col-lg-6 col-md-6 col-xs-6">
                <h2 id="fichevalidForm">Fiche de Frais Visiteur : <?php echo $nomVisiteur ?> du mois <?php echo $numMois."/".$numAnnee ?>   </h2>
            </div>
       

            <div class="col-lg-6 col-md-6 col-xs-6">
                 <p>Etat : <?php echo $libEtat?> depuis le <?php echo $dateModif?> 
                 </br>Montant valider : <?php echo $montantValide?>  
                 </br>Montant forfait estimer : <?php echo ($somme['sommeForfait']);?> euros </p>        
          </div>  
    
  </div>
  <!--Visuelles des des saisie de validation des forfait-->

    <div class="row">
        
       <div class="col-lg-12 col-md-12 col-xs-12">
              
          <form class="idform" method="POST" action="index.php?uc=valideFrais&action=validForfaitFrais">
               <fieldset>
                    <div class="title">
                            <h2>Frais au fait : </h2>
                    </div>    
                    <div class="row">   
                
                            <div class="col-md-2 col-xs-2 col-sm-2">  
                                <div class="element-input">
                                    <label  for="idFrais" class="title">Identifiant</label>
                                    <div class="item-cont">

                                      <input type="text" id="idFrais" name="idVisiteur" value="<?php echo $idVisiteur ?>"/>
                                      <span id="glypicon" class="glyphicon glyphicon-list-alt"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-2 col-sm-2">  
                                <div class="element-input">
                                    <label  for="idFrais" class="title">Date</label>
                                        <div class="item-cont">

                                            <input type="text" id="idFrais" name="dateMois" value="<?php echo $leMois ?>"/>
                                            <span id="glypicon" class="glyphicon glyphicon-list-alt"></span>
                                        </div>
                                </div>
                            </div>
                                
                              <?php
				            foreach ($lesFraisForfait as $unFrais)
				            {
					            $idFrais = $unFrais['idfrais'];
					            $libelle = $unFrais['libelle'];
					            $quantite = $unFrais['quantite'];
			              ?>  
               
                             <div class="col-md-2 col-xs-2 col-sm-2">   
                                <div class="element-input">               
                                    <label  for="idFrais" class="title"><?php echo $libelle ?></label>
                            
                                        <div class="item-cont">
                                           <input type="text" id="idFrais" name="lesFrais[<?php echo $idFrais?>]" placeholder="lesFrais[<?php echo $idFrais?>]" value="<?php echo $quantite?>"/>
                                           <span id="glypicon" class="glyphicon glyphicon-list-alt"></span>
                                        </div>
                                 </div>
                            </div>
                                <?php
				            }
				            ?>  
                        </div>
                    <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12 ">
                                <div class="submit"><input type="submit" id="modifier" value="Valider"/></div>
                            </div>
                        </div>  

                           <div class="idformjusticatif">
                                    <div class="row">
                                        <div class="col-md-4 col-xs-4 col-sm-4">  
                                                <div class="element-input">
                                                    <label  for="nbJustificatif" class="title">Nb Justificatif</label>   
                                                </div>
                                        </div>
                                        <div class="col-md-4 col-xs-4 col-sm-4"> 
                                            <div class="item-cont">
                                                      <input type="text" id="nbJustificatif" name="nbJustificatif" value="<?php echo $nbJustificatifs ?>"/>
                                             </div>
                                        </div>
                                       
                                     </div>    
                                </div>
                    </fieldset>  
              </form>

      </div>
        
     </div> 
 

