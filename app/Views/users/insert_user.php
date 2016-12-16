<!-- <?php $this->layout('layout', ['title'=>"Ajout d'un utilisateur"]) ?> -->

<?php $this->start('main_content') ?>

<!-- <?php if (isset($formValid)) :
    if (isset($userAdded)) : ?>
        L'utilisateur a été ajouté en base de données
    <?php else : ?>
        Problème lors de l'ajout en base de données
    <?php endif;
else: ?> -->
    <form action="#" id="insert-user" method="POST">
        <div class="field">
            <input error type="text" name="mail" value="<?php if (isset($mail)) echo $mail ?>" placeholder="E-mail"><br>
            <?php if (isset($errors['mail'])) :
                if (isset($errors['mail']['empty'])) : ?>
                    <div class="error">Le mail doit être rempli</div>
                <?php endif;
                if (isset($errors['mail']['invalid'])) : ?>
                    <div class="error">Le mail n'est pas valide</div>
                <?php endif;
                if (isset($errors['mail']['exists'])) : ?>
                    <div class="error">Un compte est déjà enregistré avec cette adresse</div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="field">
            <input type="password" name="pass1" placeholder="Mot de passe"><br>
            <?php if (isset($errors['pass1'])) :
                if (isset($errors['pass1']['empty'])) : ?>
                    <div class="error">Entrez un mot de passe</div>
                <?php endif;
                if (isset($errors['pass1']['size'])) : ?>
                    <div class="error">Le mot de passe doit comprendre entre 8 et 30 caractères</div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="field">
            <input type="password" name="pass2" placeholder="Confirmation"><br>
            <?php if (isset($errors['pass2'])) :
                if (isset($errors['pass2']['empty'])) : ?>
                    <div class="error">Confirmez le mot de passe</div>
                <?php endif;
                if (isset($errors['pass2']['different'])) : ?>
                    <div class="error">Les mots de passe ne correspondent pas</div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="field">
            <input type="text" name="lastname" value="<?php if (isset($lastname)) echo $lastname ?>"
                   placeholder="Nom de famille"><br>
            <?php if (isset($errors['lastname'])) :
                if (isset($errors['lastname']['empty'])) : ?>
                    <div class="error">Entrez votre nom</div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="field">
            <input type="text" name="firstname" value="<?php if (isset($firstname)) echo $firstname ?>"
                   placeholder="Prénom"><br>
            <?php if (isset($errors['firstname'])) :
                if (isset($errors['firstname']['empty'])) : ?>
                    <div class="error">Entrez votre prénom</div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="field">
            <input type="submit" name="insert-user" value="Ajouter un utilisateur">
        </div>
    </form>

<!-- new version
<div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="signupform" class="form-horizontal" role="form">
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                    
                                
                                  
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="email" placeholder="Email Address">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="firstname" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-md-3 control-label">Last Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="passwd" placeholder="Password">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="icode" class="col-md-3 control-label">Invitation Code</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="icode" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    Button                                        
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                                        <span style="margin-left:8px;">or</span>  
                                    </div>
                                </div>
                                
                                <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">
                                    
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-fbsignup" type="button" class="btn btn-primary"><i class="icon-facebook"></i>   Sign Up with Facebook</button>
                                    </div>                                           
                                        
                                </div>
                                
                                
                                
                            </form>
                         </div>
                    </div>

               
               
                
         </div>  -->

    
<?php endif; ?>

<?php $this->stop('main_content') ?>