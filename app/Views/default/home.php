<?php $this->layout('layout', ['title' => '', 'user' => $user]) ?>

<?php $this->start('main_content') ?>

<section class="wrapper-hero">
		<!-- slider image -->
		<div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
		  

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img class="slider" src="<?= $this->assetUrl('img/photo2.jpg') ?>" alt="Slider_1">
		    </div>
		    <div class="item">
		      <img class="slider" src="<?= $this->assetUrl('img/photo1.jpg') ?>" alt="Slider_2">
		    </div>
		   <div class="item">
		      <img class="slider" src="<?= $this->assetUrl('img/photo3.jpg') ?>" alt="Slider_3">
		    </div>
		  </div>

		 
		</div>


	<div id="search" class="container">
		<!-- form -->
		<form class="form-inline" action="<?= $this->url('garden_all') ?>">
		  <div class="form-group">
		    <label class="sr-only" for="exampleInputEmail3">Recherche:</label>
		    <input type="search"  value="<?php if(isset($_GET['s'])) echo $this->e($_GET['s']) ?>" class="form-control search" id="s" name="s" placeholder="Rechercher un jardin" size='40'>
		  </div>
  		  <button type="submit" class="btn btn-primary">Rechercher</button>
		</form>
	</div>

</section>

<section id="concept" class="wrapper-video">
	
	<div class="container">

		<h1 class="text-center">Notre concept</h1>
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

<!-- GL = Section Google Maps -->
<section class="container">
	<div class="row">
		<div class="col-md-5">
			<br />
			<br />
			<br />
			<h3 class="presentation">Trouvez un jardin...</h3>
			<br />
			<p class="presentation">Avec des centaines de jardins proposés, vous trouverez forcément celui qui vous permettra de reconnecter avec la nature.</p>
		</div>
		<div class="col-md-7">
			<?php foreach($gardens as $garden) : ?>
				<input type="hidden" data-lat="<?= $garden['lat'] ?>" data-lng="<?= $garden['lng'] ?>">
			<?php endforeach ?>
			
		<div class="embed-responsive embed-responsive-16by9">
			<div id="map"></div></div>
	    	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAbFi6X_yxNJEkoPPrsb3GFbP-_7Mpglc&callback=initMap" async defer>
	    	</script>   
		</div>
	</div>
</section>

<br>


<?php $this->stop('main_content') ?>
