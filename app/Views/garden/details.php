
<?php $this->layout('layout', ['title' => 'Détail du jardin']) ?>
<?php $this->start('main_content') ?>

  <h2>Détails des jardins sélectionnés</h2>
  <p>Retrouvez l'ensemble des détails ci-dessous et contactez le propriétaire du jardin</p>

<div id="avatar"><img src="<?= $this->assetUrl('uploads/users/' . $user['avatar']) ?>" alt="avatar"></div>

<div id="avatar"><img src="<?= $this->assetUrl('uploads/img/' . $ownerInfos['URL']) ?>">

  <div><?= $garden[0]['pseudo'] ?></div>

  <div><?= $garden[0]['Name'] ?></div>
  <div><?= $garden[0]['Description'] ?></div>
  <div><?= $garden[0]['City'] ?></div>
  <div><?= $garden[0]['id'] ?></div>


  <div><?= $garden[0]['avatar'] ?></div> 
  <div><?= $garden[0]['pseudo'] ?></div>

  <?php foreach($garden as $gardenPicture) : ?>
    <img src="<?= $this->assetUrl('/uploads/' . $gardenPicture['URL']) ?>">
  <?php endforeach ?>

<?php $this->stop('main_content') ?>

