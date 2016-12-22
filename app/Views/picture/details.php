<?php $this->layout('layout', ['title' => 'Liste des Photos']) ?>
<?php $this->start('main_content') ?>
<<<<<<< .merge_file_Tx2Wj3
  
=======

>>>>>>> .merge_file_AbMs0o
  <h2>Détails des jardins sélectionné</h2>
  <p>Retrouvez l'ensemble des détails ci-dessous et contactez le propriétaire</p>

<!-- 1/ Insérer le code de la fiche produit en html / bootstrap responsive -->
<!-- 2/ Insérer le code de la fiche produit en php par rapport à la fonction décrite dans la fonction du controller -->

  <?= $picture['Title'] ?>
  <?= $picture['Author'] ?>
  <?= $picture['ALT'] ?>
  <?= $picture['Description'] ?>

  <img src="<?= $this->assetUrl('/img/' . $picture['URL']) ?>">

<div class="row">
  <div class="col-xs-6 col-md-3">
    <a href="#" class="thumbnail">
      <img src="..." alt="...">
    </a>
  </div>
  ...
</div>

<?php $this->stop('main_content') ?>


