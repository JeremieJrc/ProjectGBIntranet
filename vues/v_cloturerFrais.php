


<div id="v_cloture" class="container">        
      <h2>Clôturer</h2>  
       <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
  	            <table class="listeLegere">
  	               <caption> Les Visiteurs a clôturer en priorié  </caption>
                         <tr class="clotVisiteur">
                            <th class="infoCellule">Identifiant</th>
                            <th class="infoCellule">Nom</th>
                            <th class="infoCellule">Prenom</th>
                            <th class="infoCellule">Status</th>
                            <th class="infoCellule">Date</th>
                                            
                         </tr>

                    <?php      
                      foreach($lesVisiteurs as $unVisiteur){

                            $identifiant=$unVisiteur['Identifiant'];
                            $nom=$unVisiteur['Nom'];
                            $prenom=$unVisiteur['Prenom'];
                            //$idEtat=$unVisiteur['idEtat'];
                            $libEtat=$unVisiteur['libEtat'];
                            $mois=$unVisiteur['mois'];
		            ?>
                         <tr>
                            <td><?php echo $identifiant ?></td>
                            <td><?php echo $nom ?></td>
                            <td><?php echo $prenom ?></td>
                            <td><?php echo $libEtat ?></td>
                            <td><?php echo $mois ?></td>

                         </tr>
                    <?php 
                      }
		            ?>
                </table>

             </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                 <button id="btCloturer" type="button" onclick="self.location.href='index.php?uc=clotureFrais&action=clotureVisiteursFrais'" class="btn btn-default">Cloturer</button>
         </div>
       </div>
</div>   