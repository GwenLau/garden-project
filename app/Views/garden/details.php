
<?php $this->layout('layout', ['title' => 'Détail du jardin']) ?>
<?php $this->start('main_content') ?>

  <?php print_r($garden) ?>
  <h2>Détails des jardins sélectionnés</h2>
  <p>Retrouvez l'ensemble des détails ci-dessous et contactez le propriétaire du jardin</p>

<!-- 1/ Insérer le code de la fiche produit en html / bootstrap responsive -->
<!-- 2/ Insérer le code de la fiche produit en php par rapport à la fonction décrite dans la fonction du controller -->

<!-- 3/ choisir le bon code pour insérer la photo du propriétaire du jardin $ownerInfos['URL']) ou -->
<div id="avatar"><img src="<?= $this->assetUrl('uploads/users/' . $user['avatar']) ?>" alt="avatar"></div>

<div id="avatar"><img src="<?= $this->assetUrl('uploads/img/' . $ownerInfos['URL']) ?>">

  <div><?= $ownerInfos['pseudo'] ?></div>
  <div><?= $garden['Name'] ?></div>
  <div><?= $garden['Description'] ?></div>

  <div><?= $pictures['Title'] ?></div>
  <div><?= $pictures['ALT'] ?></div>

  <div>
    <img src="<?= $this->assetUrl('uploads/' . $pictures['URL']) ?>">
  </div>
  
  <div>
  
    <img src="<?= $this->assetUrl('/img/' . $pictures['URL']) ?>">
    <img src="<?= $this->assetUrl('/img/' . $pictures['URL']) ?>">
  </div>


  


  

<?php $this->stop('main_content') ?>



