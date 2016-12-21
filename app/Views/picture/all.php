<?php $this->layout('layout', ['title' => 'Liste des Photos' , 'user' => $user]) ?>

<?php $this->start('main_content') ?>
	<h2>Liste des jardins à partager</h2>
	<p>Retrouvez l'ensemble des détails ci-dessous et contactez le propriétaire</p>


	<div class="row">
		<?php foreach($allPictures as $Pic) : ?>

		  <div class="col-sm-6 col-md-4">
		    <div class="thumbnail">S
		      <?= '<img src="' .
		      $this->assetUrl('uploads/' . $Pic['URL']) ?>" alt="<?= $Pic['ALT'] ?>">
		      <div class="caption">
		        <h3><?= $Pic['Title'] ?></h3>
		        <p><?= $Pic['Description'] ?></p>
		        <p><a href="#Form_contact" class="btn btn-primary" role="button">Contacter</a> <a href="#details.php" class="btn btn-default" role="button">Détails...</a>
		        <a href="#details.php" class="btn btn-default like" role="button"><span class="glyphicon glyphicon-leaf" aria-hidden="true"></span> J'aime</a></p>

		      </div>
		    </div>
		  </div>

		<?php endforeach ?>

</div>

<?php $this->stop('main_content') ?>
