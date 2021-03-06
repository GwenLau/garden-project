
/* Google Maps */

function initMap()
	{
		var container = document.getElementById('map');
		var map = new google.maps.Map(container, {
			center : {lat:47, lng:2.40},
			zoom : 5
		});
		var myMarkerImage = new google.maps.MarkerImage('assets/img/picto-jardin.png');
		/* Style de la Map */
		var styles = [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#6195a0"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"lightness":"0"},{"saturation":"0"},{"color":"#f5f5f2"},{"gamma":"1"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"lightness":"-3"},{"gamma":"1.00"}]},{"featureType":"landscape.natural.terrain","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#bae5ce"},{"visibility":"on"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#fac9a9"},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"color":"#4e4e4e"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#787878"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"transit.station.airport","elementType":"labels.icon","stylers":[{"hue":"#0a00ff"},{"saturation":"-77"},{"gamma":"0.57"},{"lightness":"0"}]},{"featureType":"transit.station.rail","elementType":"labels.text.fill","stylers":[{"color":"#43321e"}]},{"featureType":"transit.station.rail","elementType":"labels.icon","stylers":[{"hue":"#ff6c00"},{"lightness":"4"},{"gamma":"0.75"},{"saturation":"-68"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#eaf6f8"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#c7eced"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"lightness":"-49"},{"saturation":"-53"},{"gamma":"0.79"}]}]

		map.setOptions({styles: styles});

		$('input[type="hidden"]').each(function(key, elt) {
			var marker = new google.maps.Marker({
				position: {
					lat: parseFloat($(elt).attr('data-lat')),
					lng: parseFloat($(elt).attr('data-lng'))
				},
				map: map,
				icon: myMarkerImage,
				mapTypeControl: false,
				title: "France"
				});        
			});
	}

	/* Fonctions d'affichage pour l'actualisation des informations dans "Dashboard > Mon compte" */
	
	$("#update-avatar").click(function() {
		$(".avatar").addClass('hidden');
		$(".add-avatar").removeClass('hidden');
	});

	$("#update-email").click(function() {
		$(".email").addClass('hidden');
		$(".add-email").removeClass('hidden');
	});

	$("#update-password").click(function() {
		$(".password").addClass('hidden');
		$(".add-password").removeClass('hidden');
	});

	/* Fonction AJAX pour la suppression des jardins */
  	$('.delete-garden').click(function(e){
  		e.preventDefault();

  		//récupère l'id du jardin
		var id = $(this).data('id');
      
      	//ajax de suppression 
	    $.ajax({
	        method: "POST",
	        url: $('#gardenDeleteRoute').val(),
	        data: { id : id },
	        dataType: 'json',
	        success: function(r) {
	          	if(r === true) {
	            	console.log($('#garden-' + id) );
	            	$('#garden-' + id).fadeOut('fast', function(){
	            		$(this).remove();
	            	});
	            	$('garden-deleted').removeClass('hidden');
	          	} else {
	          		// Génération d'une erreur
	          		alert('Une erreur s’est produite.');
	          	}
	        },
	        error:function(r){
	        	console.log(r.responseText);
	        }

	    });
	    
    }); // fin de la fonction ajax





