<?php $this->layout('layout', ['title' => 'Dashboard', 'user' => $user]) ?>

<?php $this->start('main_content') ?>
	<h2>Gérer vos demandes de reservations de jardins</h2>
	


	<!-- <p>Retrouvez l'ensemble des détails de votre profil et gérer vos jardins à partager</p> -->
	
			<div class="container">
		    <div class="row profile">
				<div class="col-md-3">
					<?= $this->insert('users/sidebar_dashboard', ['user' => $user]) ?>
				</div>
				<div class="col-md-9">
		            <div class="profile-content">
					   received
							
					
						<title>reception de messages</title>

<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Pseudo</th>
                <th>Prénom</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
            </tr>

        </tbody>
    </table>












<!-- 
						<form method="POST" action="#">
						<label>Destinataire : </label>
						<?php print_r($dests) ?>
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
						</form> -->
		            </div>

				</div>
			</div>
		</div>
		<center>
		</center>
		<br>
		<br>

<?php $this->stop('main_content') ?>
