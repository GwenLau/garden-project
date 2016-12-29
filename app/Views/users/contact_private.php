<?php $this->layout('layout', ['title' => '', 'user' => $user]) ?>

<?php $this->start('main_content') ?>
	<!-- <h2>Contacter le proprietaire du jardin</h2> -->

<!-- new version -->
            <form action="#" id="contact-user" method="POST">
            	<input type="hidden" name="destinataire" value="<?= $gardenOwnerId ?>">
                <div class="container">    
                        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                            <div class="panel panel-info" >
                                    <div class="panel-heading">
                                        <div class="panel-title">Contacter le propriétaire</div>
                                    </div>     

                                    <div style="padding-top:30px" class="panel-body" >

                                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                                            
                                        <form id="loginform" method="post" class="form-horizontal" role="form">


												<!-- <form method="POST" action="#"> -->
												<input type="hidden" name="destinataire" value="<?= $destinataire ?>">
												<br /><br />
												<textarea placeholder="Votre message" name="message"></textarea>
												<br /><br />
												<input class="btn btn-success" type="submit" value="Envoyer" name="contact">
												<br /><br />
												<?php if(isset($error)) { echo $error; } ?>
												<!-- </form> -->

                                                    </div>
                                                </div>

                                            </form>     

                                        </div>                     
                                    </div>  
                        </div>
            </form>


<?php $this->stop('main_content') ?>
