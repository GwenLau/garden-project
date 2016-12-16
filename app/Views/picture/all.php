<?php $this->layout('layout', ['title' => 'Liste des Photos']) ?>

<?php $this->start('main_content') ?>
	<h2>Liste des jardins à partager</h2>
	<p>Retrouvez l'ensemble des détails ci-dessous et contactez le propriétaire</p>
	
		<?php foreach($allPictures as $Pic) : ?>
		<div class="row">
		  <div class="col-sm-6 col-md-4">
		    <div class="thumbnail">
		      <?= '<img src="' .
		      $this->assetUrl('uploads/' . $Pic['URL']) ?>" alt="<?= $Pic['ALT'] ?>">
		      <div class="caption">
		        <h3><?= $Pic['Name'] ?></h3>
		        <p><?= $Pic['Description'] ?></p>
		        <p><a href="#Form_contact" class="btn btn-primary" role="button">Contacter</a> <a href="#details.php" class="btn btn-default" role="button">Détails...</a></p>
		      </div>
		    </div>
		  </div>
		</div>
		<?php endforeach ?>

<?php $this->stop('main_content') ?>
