
    <div id="v_listeMois" class="container">
        <form class="well form-horizontal" action="index.php?uc=etatFrais&action=voirEtatFrais" method="post" id="contact_form_v">
    <fieldset>

                    <!-- Form Name -->
                    <legend> Selectionner Date : </legend> 
			 <!-- Select Basic -->
   
                            <div class="form-group"> 
                              <label class="col-md-3 control-label" for="lstMois" accesskey="n">Mois : </label>
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
                                    <button id="ok"  type="submit" class="btn btn-warning" >Valider<span class="glyphicon glyphicon-send"></span></button>
                                   
                                  </div>
                                  <div class="col-md-5">
                                   
                                    <button id="annuler"  type="reset" class="btn btn-warning" >effacer<span class="glyphicon glyphicon-send"></span></button>
                                  </div>
                                </div>
                <!-- Success message -->
                <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i>
                     Thanks for contacting us, we will get back to you shortly.</div>
  
                    

                    </fieldset>
               </form>
          </div>