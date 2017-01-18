
<div id="v_listefrais" class="container">
    <div class="row"> 
       <div class="col-md-12 col-xs-12 col-sm-12 "> 
        <h2 id="titreFicheMois">Renseigner ma fiche de frais du mois <?php echo $numMois."-".$numAnnee ?></h2>
    </div>
    </div>    
          <form class="idform"  method="POST"  action="index.php?uc=gererFrais&action=validerMajFraisForfait">
             <fieldset>
            <div class="title">
                    <h2>Frais au fait</h2>
             </div>
	            
            <div class="row">   
                
                  <?php
				foreach ($lesFraisForfait as $unFrais)
				{
					$idFrais = $unFrais['idfrais'];
					$libelle = $unFrais['libelle'];
					$quantite = $unFrais['quantite'];
			  ?>  
                <div class="col-md-3 col-xs-3 col-sm-3">   
                    <div class="element-input">               
                        <label  for="idFrais" class="title"><?php echo $libelle ?></label> 
                            <div class="item-cont">
                               <input type="text" id="idFrais" name="lesFrais[<?php echo $idFrais?>]" 
                               placeholder="lesFrais[<?php echo $idFrais?>]" value="<?php echo $quantite?>"/>
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
                    <div class="submit"><input type="submit" id="modifier" value="Modifier"/></div>
                </div>
            </div>  
            </fieldset>  
          </form>
        

