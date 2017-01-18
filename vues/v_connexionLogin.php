
      <div class="container">

        <form id="contact_form" class="well form-horizontal" method="post" action="index.php?uc=connexion&action=valideConnexion">
    <fieldset>

                    <!-- Form Name -->
                    <legend> Login Users!</legend>

<!-- Text input--> 
                        <div class="form-group">  
                          <label for="nom" class="col-md-3 control-label">Login</label>  
                          <div class="col-md-8 inputGroupContainer">
                          <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                          <input  id="login" name="login"  placeholder="First Name" class="form-control"  type="text">
                            </div>
                          </div>
                        </div>

                        <!-- Text input-->

                        <div class="form-group">
                          <label for="mdp" class="col-md-3 control-label" >Password</label> 
                            <div class="col-md-8 inputGroupContainer">
                            <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                          <input id="mdp" type="password"  name="mdp" class="form-control" placeholder="Password">
                            </div>
                          </div>
                        </div>
                            <!-- Select Basic -->
   
                            <div class="form-group"> 
                              <label for="typeUser" class="col-md-3 control-label">Compte</label>
                                <div class="col-md-8 selectContainer">
                                
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                
                               <select name="typeUser" id="typeUser" class="form-control selectpicker" >
                                   <option value="0" >Selectionner type users</option>
                                   <option value="1">Visiteurs</option>
                                   <option value="2">Comptable</option>
                                </select>

                              </div>
                            </div>
                         </div>

              
                        <!-- Button -->
                                <div class="form-group">
                                  <label class="col-md-12 control-label"></label>
                                  <div class="col-md-5">
                                    <button name="valider" type="submit" class="btn btn-warning" >Connexion <span class="glyphicon glyphicon-send"></span></button>
                                  </div>
                                </div>
                <!-- Success message -->
                <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i>
                     Thanks for contacting us, we will get back to you shortly.</div>

                    </fieldset>
                    </form>
      </div>
                    

