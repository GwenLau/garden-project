<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>
<section class="wrapper-hero">
<!-- slider image -->
	<div class="container">
		<!-- form -->
	</div>
</section>
<section class="wrapper-video">
	<h1>Youpi Garden</h1>
	<div class="container">
		<!-- video -->
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
			<div id="map"></div>

    		<script async defer
    		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAbFi6X_yxNJEkoPPrsb3GFbP-_7Mpglc&callback=initMap">
    		</script>
    
		</div>
	</div>

</section>

<?php $this->stop('main_content') ?>
