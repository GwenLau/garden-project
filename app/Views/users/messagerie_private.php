<?php $this->layout('layout', ['title' => '', 'user' => $user]) ?>

<?php $this->start('main_content') ?>
	<!-- <h2>Gérer vos demandes de reservations de jardins</h2> -->
	<!-- <p>Retrouvez l'ensemble des détails de votre profil et gérer vos jardins à partager</p> -->
	
			<div class="container">
		    <div class="row profile">
				<div class="col-md-3">
					<?= $this->insert('users/sidebar_dashboard', ['user' => $user]) ?>
				</div>
				<div class="col-md-9">
		            <div class="profile-content">
					   
							
					
						<title>Envoi de messages</title>
						<form method="POST" action="#">
						<label>Destinataire : </label>
						<!-- <?php print_r($dests) ?> -->
						<select name="destinataire">
							<?php foreach($dests as $user) : ?>
    						<option value=<?= $user['id'] ?>> 
    						<?= $user['pseudo'] ?>
							</option>
							<?php endforeach ?>
						</select>
						<br /><br />
						<textarea placeholder="Votre message" name="message"></textarea>
						<br /><br />
						<input class="btn btn-success" type="submit" value="Envoyer" name="envoi_message">
						<br /><br />
						<?php if(isset($error)) { echo $error; } ?>
						</form>




		            </div>

				</div>
			</div>
		</div>
		<center>
		</center>
		<br>
		<br>

<?php $this->stop('main_content') ?>
