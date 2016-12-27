<?php $this->layout('layout', ['title' => 'Liste des Photos']) ?>
<?php $this->start('main_content') ?>

  <h2>Détails des jardins sélectionné</h2>
  <p>Retrouvez l'ensemble des détails ci-dessous et contactez le propriétaire</p>

<!-- 1/ Insérer le code de la fiche produit en html / bootstrap responsive -->
<!-- 2/ Insérer le code de la fiche produit en php par rapport à la fonction décrite dans la fonction du controller -->

  <?= $pictures['Title'] ?>
  <?= $pictures['ALT'] ?>

  <img src="<?= $this->assetUrl('/img/' . $pictures['URL']) ?>">

<div class="row">
  <div class="col-xs-6 col-md-3">
    <a href="#" class="thumbnail">
      <img src="..." alt="...">
    </a>
  </div>
  ...
</div>

<?php $this->stop('main_content') ?>


