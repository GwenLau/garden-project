<?php $this->layout('layout', ['title' => 'Inscription', 'user' => $user]) ?>

<?php $this->start('main_content') ?>

<!-- new version -->
            <form action="#" id="insert-user" method="POST">
                <div class="container">    
                        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                            <div class="panel panel-info" >
                                    <div class="panel-heading">
                                        <div class="panel-title">Inscription</div>
                                    </div>     

                                    <div style="padding-top:30px" class="panel-body" >

                                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                                            
                                        <form id="loginform" method="post" class="form-horizontal" role="form">

                                        <div style="margin-bottom: 25px" class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon"></i></span>
                                                            <input type="text" name="lastname" value="<?php if (isset($lastname)) echo $lastname ?>" placeholder="Nom de famille">
                                                             <?php if (isset($errors['lastname'])) :
                                                            if (isset($errors['lastname']['empty'])) : ?>
                                                                <div class="error">Entrez votre nom</div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>



                                                            <div style="margin-bottom: 25px" class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon"></i></span>
                                                            <input type="text" name="firstname" value="<?php if (isset($firstname)) echo $firstname ?>"
                                                                placeholder="Prénom"">
                                                             <?php if (isset($errors['firstname'])) :
                                                            if (isset($errors['firstname']['empty'])) : ?>
                                                                <div class="error">Entrez votre prénom</div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div style="margin-bottom: 25px" class="input-group">
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon"></i></span>
                                                            <input type="text" name="pseudo" value="<?php if (isset($pseudo)) echo $pseudo ?>"
                                                                placeholder="Pseudo"">
                                                             <?php if (isset($errors['pseudo'])) :
                                                            if (isset($errors['pseudo']['empty'])) : ?>
                                                                <div class="error">Entrez votre Pseudo</div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                    
                                            <div style="margin-bottom: 25px" class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                        <input  error type="text" id="login-username" type="text" class="form-control" name="email" value="<?php if (isset($email)) echo $email ?>" placeholder="E-mail"> 
                                                        <?php if (isset($errors['email'])) :
                                                        if (isset($errors['email']['empty'])) : ?>
                                                            <div class="error">Le mail doit être rempli</div>
                                                        <?php endif;
                                                        if (isset($errors['email']['invalid'])) : ?>
                                                            <div class="error">Le mail n'est pas valide</div>
                                                        <?php endif;
                                                        if (isset($errors['email']['exists'])) : ?>
                                                            <div class="error">Un compte est déjà enregistré avec cette adresse</div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>                                       
                                                    </div>


                                                
                                            <div style="margin-bottom: 25px" class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                        <input id="login-password" type="password" class="form-control" name="pass1" placeholder="Mot de passe">
                                                         <?php if (isset($errors['pass1'])) :
                                                        if (isset($errors['pass1']['empty'])) : ?>
                                                            <div class="error">Entrez un mot de passe</div>
                                                        <?php endif;
                                                        if (isset($errors['pass1']['size'])) : ?>
                                                            <div class="error">Le mot de passe doit comprendre entre 8 et 30 caractères</div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    </div>



                                                        <div style="margin-bottom: 25px" class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                                        <input id="login-password" type="password" class="form-control" name="pass2" placeholder="Confirmation">
                                                         <?php if (isset($errors['pass2'])) :
                                                        if (isset($errors['pass2']['empty'])) : ?>
                                                            <div class="error">Confirmez le mot de passe</div>
                                                        <?php endif;
                                                        if (isset($errors['pass2']['different'])) : ?>
                                                            <div class="error">Les mots de passe ne correspondent pas</div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    </div>



                                                            



                                                <div style="margin-top:10px" class="form-group">
                                                    <!-- Button -->

                                                    <div class="col-sm-12 controls">
                                                      <button  id="btn-login" name="insert-user" type="submit" class="btn btn-success" value="Ajouter un utilisateur">S'incrire </button>

                                                    </div>
                                                </div>



                                            </form>     



                                        </div>                     
                                    </div>  
                        </div>
            </form>
<?php $this->stop('main_content') ?>