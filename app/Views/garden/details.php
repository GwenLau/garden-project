
<?php $this->layout('layout', ['title' => 'Détail du jardin']) ?>
<?php $this->start('main_content') ?>

  <!-- <?php print_r($garden) ?> -->
  <h2>Détails des jardins sélectionnés</h2>
  <p>Retrouvez l'ensemble des détails ci-dessous et contactez le propriétaire du jardin</p>



<!-- 3/ choisir le bon code pour insérer la photo du propriétaire du jardin $ownerInfos['URL']) ou -->


  <div>Propriétaire (pseudo)  : <?= $garden[0]['pseudo'] ?></div>

  <div><?= $garden[0]['Name'] ?></div>
  <div>Description du jardin: <?= $garden[0]['Description'] ?></div>
  <div>Localisation : <?= $garden[0]['City'] ?></div>


 

   <!-- Carousel
    ================================================== -->
    <div id="carousel-example-generic" class="carousel slide carousel-details" data-ride="carousel">
  <!-- Indicators -->


          <ol class="carousel-indicators">


          <?php foreach ($garden as $gardenPicture => $value): ?>
            <?php if ($gardenPicture == 0): ?>
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <?php else : ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?= $key ?>"></li>
           <?php endif ?>
          <?php endforeach ?>
          </ol>


          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
          <?php foreach ($garden as $gardenPicture => $img): ?>
            <?php if ($gardenPicture == 0): ?>
              <div class="item active details">
              <img class="sliderdetails" src="<?= $this->assetUrl('/uploads/' . $img['URL']) ?>" alt="">
              <div class="carousel-caption">
                <?= $img['alt'] ?>
              </div>
            </div>
            <?php else : ?>
            <div class="item details">
              <img class="sliderdetails" src="<?= $this->assetUrl('/uploads/' . $img['URL']) ?>" alt="">
              <div class="carousel-caption">
                <?= $img['alt'] ?>
              </div>
            </div>
            <?php endif; ?>
          <?php endforeach ?>
          </div>


          <!-- Controls
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
                  </div> -->




          <p><a href="<?= $this->url('default_contact', ['id' => $Pic['gardenId']]) ?>" class="btn btn-primary" role="button">Contacter</a> </p>
          

        <?php $this->stop('main_content') ?>




