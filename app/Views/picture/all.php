<?php $this->layout('layout', ['title' => 'Liste des Photos']) ?>

<?php $this->start('main_content') ?>
	<h2>Let's code.</h2>
	<p>Vous avez atteint la page des photos. Bravo.</p>
	<p>Et maintenant, RTFM dans <strong><a href="../docs/tuto/" title="Documentation de W">docs/tuto</a></strong>.</p>
	
		<?php foreach($allPictures as $Pic) : ?>
		<div class="row">
		  <div class="col-sm-6 col-md-4">
		    <div class="thumbnail">
		      <?= '<img src="' .
		      $this->assetUrl('uploads/' . $Pic['URL']) ?>" alt="<?= $Pic['ALT'] ?>">
		      <div class="caption">
		        <h3>Thumbnail label</h3>
		        <p>...</p>
		        <p><a href="#" class="btn btn-primary" role="button">Contacter</a> <a href="#" class="btn btn-default" role="button">Plus...</a></p>
		      </div>
		    </div>
		  </div>
		</div>
		<?php endforeach ?>

<?php $this->stop('main_content') ?>
