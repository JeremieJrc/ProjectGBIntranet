

     <!--container -->

    <div id="v_logDateVisiteur" class="container">
        <form class="well form-horizontal" action="index.php?uc=suivreFrais&action=voirRemboursementFrais" method="post"  id="contact_form_Cv">
                  <fieldset>
                                    <!-- Form Name -->
                                    <legend>Select Visiteur et Date!</legend>

                                            <!-- Select Basic -->
   
                                            <div class="form-group"> 
                                              <label class="col-md-3 control-label" for="lsVisiteurs">Visiteurs </label>
                                                <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                <select name="lsVisiteurs" id="lsVisiteurs" class="form-control selectpicker" >
                                                   <?php 
                						                foreach($lesVisiteurs as $unVisiteur)
                                                        {
                                                            $visit = $unMois['nom'];
                                                            if($visit== $visiteurASelectionner){
                                                        ?>
                   						                <option selected value="<?php echo $unVisiteur?>"><?php echo $unVisiteur ?> </option>   
                						                <?php 
                                                        }else{?>
                                                            <option selected value="<?php echo $unVisiteur?>"><?php echo $unVisiteur ?> </option>   
                						                <?php
                                                        }
                                                      }
                                                     ?>
                                                </select>
                                              </div>
                                            </div>
                                       </div>


			                 <!-- Select Basic -->
   
                                            <div class="form-group"> 
                                              <label class="col-md-3 control-label" for="lstMois" accesskey="n">Mois </label>
                                                <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                                <select id="lstMois" name="lstMois" class="form-control selectpicker" >
                                                   <?php
			                foreach ($lesMois as $unMois)
			                {
			                    $mois = $unMois['mois'];
				                $numAnnee =  $unMois['numAnnee'];
				                $numMois =  $unMois['numMois'];
				
                                if($mois == $moisASelectionner){
				                ?>
				                <option selected value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
				                <?php 
				                }
				                else{ ?>
				                <option value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
				                <?php 
				                }
			                }
		                   ?>    
                                                </select>
                                              </div>
                                            </div>
                                            </div>

              
                                        <!-- Button -->
                                                <div class="form-group">
                                                  <label class="col-md-12 control-label"></label>
                                                  <div class="col-md-5">
                                  	                <div class="ButtonvalidFrais">
                                                    <button  id="ok" type="submit" class="btn btn-warning" >Valider<span class="glyphicon glyphicon-send"></span></button>
                                                  </div>
                                                  </div>
                                                </div>


                                <!-- Success message -->
                                <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i>
                                     Thanks for contacting us, we will get back to you shortly.</div>
  
                   </fieldset>
         </form>
    </div>