<?php $this->layout('layout', ['title' => 'Votre compte']) ?>

<?php $this->start('main_content') ?>
	<!-- <h2>Gérer ou trouver un jardin</h2>
	<p>Retrouvez l'ensemble des détails de votre profil et gérer vos jardins à partager</p> -->
	
			<div class="container">
		    <div class="row profile">
				<div class="col-md-3">

					<?= $this->insert('users/sidebar_dashboard', ['user' => $user]) ?>

				</div>
				<div class="col-md-9">
		            <div class="profile-content">
					   
							<div class="col-md-9">

								<!-- Affichage + Update Champ "avatar" -->
								<p><strong>Photo de profil :  </strong><img src="<?= $this->assetUrl('uploads/users/' . $user['avatar']) ?>" alt="avatar"> 
								<button id="update-avatar" type="button" class="btn btn-secondary btn-sm">Télécharger</button></p>
								<div class="add-avatar bg-success hidden">	<?php if(isset($errors['my-file']['empty'])) : ?>
									<p>Aucun fichier n'est téléchargé.</p>
								<?php endif ?>
									<form enctype="multipart/form-data" action="#" method="POST"><input type="file" name="my-file" value="Parcourir..."><button name="save-new-avatar" type="submit" class="btn btn-secondary btn-sm">Ajouter</button>
									</form>
								</div>

								<!-- Affichage Champ "pseudo" -->
								<p><strong>Pseudo :  </strong><?= $user['pseudo'] ?> 
							

								<!-- Affichage Champ "prénom" -->
								<p><strong>Prénom :  </strong><?= $user['firstname'] ?> 


								<!-- Affichage Champ "Nom" -->
								<p><strong>Nom :  </strong><?= $user['lastname'] ?> 


								<!-- Affichage + Update Champ "E-mail" -->
								<p><strong>E-mail :  </strong><?= $user['email'] ?> <button id="update-email" type="button" class="btn btn-secondary btn-sm">Modifier</button></p>

								<!-- Update Champ "Mot-de-passe" -->
								<p><strong>Mot-de-passe :  </strong><button id="update-password" type="button" class="btn btn-secondary btn-sm">Modifier mon mot-de-passe</button></p>		

							</div>
				

		            </div>

				</div>
			</div>
		</div>
		<center>
		</center>
		<br>
		<br>

<?php $this->stop('main_content') ?>
