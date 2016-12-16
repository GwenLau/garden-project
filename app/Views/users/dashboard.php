<?php $this->layout('layout', ['title' => 'Dashboard', 'user' => $user]) ?>

<?php $this->start('main_content') ?>
	<h2>Gérer ou trouver un jardin</h2>
	<p>Retrouvez l'ensemble des détails de votre profil et gérer vos jardins à partager</p>
	
			<div class="container">
		    <div class="row profile">
				<div class="col-md-3">
					<?= $this->insert('users/sidebardashboard', ['user' => $user]) ?>
				</div>
				<div class="col-md-9">
		            <div class="profile-content">
					   
							Proposer un jardin ...

							<form enctype="multipart/form-data" action="#" method="POST">
								<div class="form-group">
								<?php if(isset($errors['title']['emptyorshort'])) : ?>
								<p>Le titre de l'image est vide ou comporte moins de 10 caractères.</p>
								<?php endif ?>
						    		<label for="title" hidden>Titre de l'image</label>
						    		<input name="title" type="text" class="form-control" placeholder="Titre de l'image">
						  		</div>
						  		<div class="form-group">
						  		<?php if(isset($errors['description']['emptyorshort'])) : ?>
								<p>La description de l'image est vide ou comporte moins de 10 caractères.</p>
								<?php endif ?>
						    		<label for="description" hidden>Description</label>
						    		<textarea name="description" class="form-control" placeholder="Description"></textarea>
						  		</div>
								<div class="form-group">
								<?php if(isset($errors['my-file']['empty'])) : ?>
								<p>Aucun fichier n'est téléchargé.</p>
								<?php endif ?>
								    <label for="my-file">Image : </label>
								    <input type="file" name="my-file" value="Parcourir...">
								    
								</div>
								<div class="form-group">
						    		<label for="localisation" hidden>Emplacement géographique</label>
						    		<input name="localisation" class="form-control" placeholder="Emplacement géographique">
						  		</div>
								<button name="add-image" type="submit" class="btn btn-default ">Ajouter le jardin</button>
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
