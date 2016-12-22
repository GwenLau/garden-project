<?php $this->layout('layout', ['title' => 'Mes jardins', 'user' => $user]) ?>

<?php $this->start('main_content') ?>
	
		<div class="container">
		    <div class="row profile">
				<div class="col-md-3">
					<?= $this->insert('users/sidebar_dashboard', ['user' => $user]) ?>
				</div>
				<div class="col-md-9">
		            <div class="add-garden">
					   
						<h2>Proposer un jardin</h2>

						<form enctype="multipart/form-data" action="#" method="POST">
							<div class="form-group">
								<?php if(isset($errors['name']['emptyorshort'])) : ?>
								<p>Donnez un petit nom pour référencer votre jardin (au moins 10 caractères).</p>
								<?php endif ?>
						    		<label for="name" hidden>Nom du jardin</label>
						    		<input name="name" type="text" class="form-control" placeholder="Nom du jardin">
						  	</div>
						  	<div class="form-group">
						  		<?php if(isset($errors['description']['emptyorshort'])) : ?>
								<p>La description du jardin est vide ou comporte moins de 10 caractères.</p>
								<?php endif ?>
						    		<label for="description" hidden>Description</label>
						    		<textarea name="description" class="form-control" placeholder="Description"></textarea>
						  	</div>
						  	<div class="form-group form-inline">
						  		<?php if(isset($errors['streetnumber']['empty'])) : ?>
								<p>Un numéro de rue est requis.</p>
								<?php endif ?>
								<label> Adresse :</label>
						    		<label for="streetnumber" hidden>N°</label>
						    		<textarea name="streetnumber" class="form-control" placeholder="N°"></textarea>
						  		<?php if(isset($errors['streetname']['empty'])) : ?>
								<p>Un nom de rue est requis.</p>
								<?php endif ?>
						    		<label for="streetname" hidden>Rue</label>
						    		<textarea name="streetname" class="form-control" placeholder="Rue"></textarea>

						  		<?php if(isset($errors['citycode']['empty'])) : ?>
								<p>Un code postal est requis.</p>
								<?php endif ?>
						    		<label for="citycode" hidden>Rue</label>
						    		<textarea name="citycode" class="form-control" placeholder="Code postal"></textarea>

						  		<?php if(isset($errors['city']['empty'])) : ?>
								<p>Veuillez renseigner la ville.</p>
								<?php endif ?>
						    		<label for="city" hidden>Ville</label>
						    		<textarea name="city" class="form-control" placeholder="Ville"></textarea>
						  	</div>
							<div class="form-group">
								<?php if(isset($errors['my-file']['empty'])) : ?>
								<p>Aucun fichier n'est téléchargé.</p>
								<?php endif ?>
								    <label for="my-file">Images : </label>
								    <input type="file" name="my-file" value="Parcourir..." multiple>    
							</div>
							<div class="row">

								<?php foreach ($imgs as $key => $img): ?>
									<div class="col-sm-3">
									<div class="alert alert-danger delete"><a href="$img['id'] ?>">Supprimer</a></div>
									<div class="img" style="background-image: url(<?= $img['url'] ?>)" >
									</div>
									</div>
								<?php endforeach ?>
							</div>
							
							<button name="add-garden" type="submit" class="btn btn-primary ">Ajouter le jardin</button>
						</form>
					</div>
					<div class="update-garden">
						<h2>Modifier mon jardin</h2>
					</div>
					<div class="delete-garden">
						<h2>Supprimer mon jardin</h2>
		            </div>

				</div>
			</div>
		</div>



<?php $this->stop('main_content') ?>

