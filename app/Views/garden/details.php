
<?php $this->layout('layout', ['title' => 'Détail du jardin', 'user' => $user]) ?>
<?php $this->start('main_content') ?>

  <?php print_r($garden) ?>
  <h2>Détails des jardins sélectionnés</h2>
  <p>Retrouvez l'ensemble des détails ci-dessous et contactez le propriétaire du jardin</p>


  <div><?= $garden['Name'] ?></div>
  <div><?= $garden['Description'] ?></div>
  <div><?= $garden['City'] ?></div>
  <div><?= $garden['id'] ?></div>


  <div><?= $owner['avatar'] ?></div> 
  <div><?= $owner['pseudo'] ?></div>

  <div>
    <img src="<?= $this->assetUrl('/img/' . $pictures['URL']) ?>">
  </div>

<?php $this->stop('main_content') ?>