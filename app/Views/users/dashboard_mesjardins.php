<?php $this->layout('layout', ['title' => 'Proposer un jardin', 'user' => $user]) ?>

<?php $this->start('main_content') ?>
	
		<div class="container">
		    <div class="row profile">
				<div class="col-md-3">
					<?= $this->insert('users/sidebar_dashboard', ['user' => $user]) ?>
				</div>
				<div class="col-md-9">
		            <div class="add-garden">

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

								<label> Adresse :</label>
						    	<label for="streetnumber" hidden>N°</label>
						    	<textarea name="streetnumber" class="form-control" placeholder="N°"></textarea>

							  	<?php if(isset($errors['streetname']['empty'])) : ?>
									<p>Un nom de rue est requis.</p>
								<?php endif ?>
						    	<label for="streetname" hidden>Rue</label>
						    	<textarea name="streetname" class="form-control" placeholder="Rue"></textarea>

							  	<?php if(isset($errors['citycode']['emptyorfalse'])) : ?>
									<p>Un code postal valide est requis.</p>
								<?php endif ?>
						    	<label for="citycode" hidden>Rue</label>
						    	<textarea name="citycode" class="form-control" placeholder="Code postal"></textarea>

							  	<?php if(isset($errors['city']['emptyorshort'])) : ?>
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
					    		<input type="file" name="my-file[]" value="Parcourir...">
								<input type="file" name="my-file[]" value="Parcourir...">
								<input type="file" name="my-file[]" value="Parcourir...">   
							</div>
							
							<button name="add-garden" type="submit" class="btn btn-success ">Ajouter le jardin</button>
						</form>
					</div>
				</div>
			</div>
		</div>



<?php $this->stop('main_content') ?>

