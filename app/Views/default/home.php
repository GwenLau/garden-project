<?php $this->layout('layout', ['title' => '', 'user' => $user]) ?>

<?php $this->start('main_content') ?>
		<section class="wrapper-hero">
		<!-- slider image -->
		<div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
		  <!-- Indicators -->
		  <!-- <ol class="carousel-indicators">
		    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
		  </ol> -->

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img src="<?= $this->assetUrl('img/photo2.jpg') ?>" alt="Slider_1">
		    </div>
		    <div class="item">
		      <img src="<?= $this->assetUrl('img/photo1.jpg') ?>" alt="Slider_2">
		    </div>
		   <div class="item">
		      <img src="<?= $this->assetUrl('img/photo3.jpg') ?>" alt="Slider_3">
		    </div>
		  </div>

		  <!-- Controls -->
		  <!-- <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a> -->
		</div>


	<div id="search" class="container">
		<!-- form -->
		<form class="form-inline" action="<?= $this->url('garden_all') ?>">
		  <div class="form-group">
		    <label class="sr-only" for="exampleInputEmail3">Recherche:</label>
		    <input type="search"  value="<?php if(isset($_GET['s'])) echo $this->e($_GET['s']) ?>" class="form-control" id="s" name="s" placeholder="Rechercher un jardin">
		  </div>
  		  <button type="submit" class="btn btn-primary">Rechercher</button>
		</form>
	</div>

</section>
<section id="concept" class="wrapper-video">
	
	<div class="container">
		<h1 class="text-center">Une animation pour vous expliquer notre concept</h1>
		
		<!-- video -->
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
				<div class="embed-responsive embed-responsive-16by9">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/gxOA3FESAuA" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="container">


<!-- GL = Section Google Maps -->
	<div class="row">
		<div class="col-md-5">
			<h3>Trouvez un jardin...</h3>
			<p>Avec des centaines de jardins proposés, vous trouverez forcément celui qui vous permettra de reconnecter avec la nature, de partager un moment entre passionnés de jardinage ou simplement de profiter d'un cadre vert en ville.</p>
		</div>
		<div class="col-md-7">
			<?php foreach($gardens as $garden) : ?>
				<input type="hidden" data-lat="<?= $garden['lat'] ?>" data-lng="<?= $garden['lng'] ?>">
			<?php endforeach ?>
			<div id="map"></div>

    		<script async defer
    		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAbFi6X_yxNJEkoPPrsb3GFbP-_7Mpglc&callback=initMap">
    		</script>
    
		</div>
	</div>

</section>

<?php $this->stop('main_content') ?>
