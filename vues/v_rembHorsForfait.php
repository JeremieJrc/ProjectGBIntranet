

    <!--Visuelles des des suivie hors forfait-->
        
        <table class="listeLegere">
            <caption>Suivie Remboursement hors forfait</caption>


            <tr  class="remboursementVisiteur">
                <th class="infoCellule">Date</th>
                <th class="infoCellule">Libelle</th>
                <th class="infoCellule"> Montant</th>
                <th class="infoCellule">Status</th> 
            </tr>
            <tr>
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
                            <td><?php echo verifLibelle($libelle,$libEtat);?> </td>
                         </tr>
                    <?php 
                      }
		            ?>
                  
            </tr>
        </table>
     
     </div> 
 
