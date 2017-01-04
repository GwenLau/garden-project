<?php $this->layout('layout', ['title' => 'Votre compte']) ?>

<?php $this->start('main_content') ?>
	
			<div class="container">
			<div class="row profile">
				<div class="col-md-3">

					<?= $this->insert('users/sidebar_dashboard', ['user' => $user]) ?>

				</div>
				<div class="col-md-9">
					<div class="profile-content">
						<div class="col-md-9">
							<form enctype="multipart/form-data" action="#" method="POST">
									
								
								<!-- Affichage + Update Champ "avatar" -->
								<p class="avatar"><strong>Photo de profil :  </strong><img src="<?= $this->assetUrl('uploads/users/' . $user['avatar']) ?>" alt="avatar"> 
								<button id="update-avatar" type="button" class="btn btn-secondary btn-sm">Télécharger</button></p>
								<div class="add-avatar hidden">	
									<?php if(isset($errors['my-avatar']['empty'])) : ?>
										<p>Aucun fichier n'est téléchargé.</p>
									<?php endif ?>
									<input type="file" name="my-avatar" id="my-avatar" value="Parcourir..."><button name="save-new-avatar" type="submit" class="btn btn-secondary btn-sm">Ajouter</button>									
								</div>

								<!-- Affichage Champ "pseudo" -->
								<p><strong>Pseudo :  </strong><?= $user['pseudo'] ?> 
								

								<!-- Affichage Champ "prénom" -->
								<p><strong>Prénom :  </strong><?= $user['firstname'] ?> 


								<!-- Affichage Champ "Nom" -->
								<p><strong>Nom :  </strong><?= $user['lastname'] ?> 


								<!-- Affichage + Update Champ "E-mail" -->
								<p class="email"><strong>E-mail :  </strong><?= $user['email'] ?> 
								<button id="update-email" type="button" class="btn btn-secondary btn-sm">Modifier</button></p>
								<div class="add-email hidden">	
									<?php if(isset($error['new-email']['empty'])) : ?>
										<p>Aucun e-mail n'est renseigné.</p>
									<?php endif ?>
									<input type="text" name="new-email"> <button name="save-new-email" type="submit" class="btn btn-secondary btn-sm">Ajouter</button>
								</div>

								<!-- Update Champ "Mot-de-passe" -->
								<p class="password"><strong>Mot-de-passe :  </strong>
								<button id="update-password" type="button" class="btn btn-secondary btn-sm">Modifier mon mot-de-passe</button></p>
								<div class="add-password hidden">	
									<?php if(isset($error['new-password']['empty'])) : ?>
										<p>Aucun mot-de-passe n'est renseigné.</p>
									<?php endif ?>
									<label for="new-password"> Nouveau mot-de-passe : </label><br /><input type="password" name="new-password"> <br /><label for="confirm-new-password">Confirmez le mot-de-passe : </label><br /><input type="password" name="confirm-new-password"> <button name="save-new-password" type="submit" class="btn btn-secondary btn-sm">Ajouter</button>
									
								</div>	
							</form>	
						</div>	
					</div>
				</div>
			</div>
		</div>

<?php $this->stop('main_content') ?>
