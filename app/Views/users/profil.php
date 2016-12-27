<?php $this->layout('layout', ['title' => 'Dashboard']) ?>

<?php $this->start('main_content') ?>
	<h2>Gérer ou trouver un jardin</h2>
	<p>Retrouvez l'ensemble des détails de votre profil et gérer vos jardins à partager</p>
	
			<div class="container">
		    <div class="row profile">
				<div class="col-md-3">

					<?= $this->insert('users/sidebar_dashboard', ['user' => $user]) ?>

				</div>
				<div class="col-md-9">
		            <div class="profile-content">
					   
							<div class="col-md-9">
								<p><strong>Avatar :  </strong><img src="<?= $this->assetUrl('uploads/users/' . $user['avatar']) ?>" alt="avatar"> 


								<button id="update-pseudo" type="button" class="btn btn-outline-success btn-sm">Modifier</button></p>
								<p><strong>Pseudo :  </strong><?= $user['pseudo'] ?> <button id="update-pseudo" type="button" class="btn btn-outline-success btn-sm">Modifier</button></p>
								<p><strong>Prénom :  </strong><?= $user['firstname'] ?> <button id="update-firstname" type="button" class="btn btn-secondary btn-sm">Modifier</button></p>
								<p><strong>Nom :  </strong><?= $user['lastname'] ?> <button id="update-lastname" type="button" class="btn btn-secondary btn-sm">Modifier</button></p>
								<p><strong>E-mail :  </strong><?= $user['email'] ?> <button id="update-email" type="button" class="btn btn-secondary btn-sm">Modifier</button></p>
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
