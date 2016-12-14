// Déclaration des fonctions

function closeAddWindow () {

	$('#addPictureForm').addClass('hide');

	// Vidange du champ name
	$('#name').val('');
	$('#nameError').html('').addClass('hide');

	// Vidange du champ legend
	$('#legend').val('');
	$('#legendError').html('').addClass('hide');

	// Vidange du champ alt
	$('#alt').val('');
	$('#altError').html('').addClass('hide');

	// Vidange du champ file
	$('#newPic').val('');
	$('#uploadError').html('').addClass('hide');

}

function closeEditWindow () {

	$('#editPictureForm').remove();
}


function editPicture (id, phase) {

	closeEditWindow();

	$.ajax({
		method 	:'POST',
		url 	: 'edit-picture.php',
		dataType : 'JSON',
		data 		: {
			id 		: id,
			phase 	: 1
		}
	}).done( function(r) {

		if (typeof r.success !== 'undefined') {

			var checked = '';

			if ( r.infos.Carousel == 1 ) {
				checked += 'checked';
			}


			$('#editPicture').html(`
				<form action="#" name="editPictureForm" id="editPictureForm" data-id="`+r.infos.id+`">
					<h4>Edition</h4>
					<div class="form-group col-sm-12 ">
						<a href="#" id="closeEditWindow">Fermer</a>
					</div>
					<div class="form-group">
						<label for="name">Nom</label>
						<span class="error form-control-static hide" id="editNameError"></span>
						<input type="text" class="form-control" id="name" name="name" value="`+r.infos.Name+`">
					</div>
					<div class="form-group">
						<label for="legend">Légende</label>
						<span class="error form-control-static hide" id="editLegendError"></span>
						<input type="text" class="form-control" id="legend" name="legend" value="`+r.infos.Legend+`">
					</div>
					<div class="form-group">
						<label for="legend">Texte alternatif</label>
						<span class="error form-control-static hide" id="editAltError"></span>
						<input type="text" class="form-control" id="alt" name="alt" value="`+r.infos.ALT+`">
					</div>
					<div class="form-group">
						<input type="checkbox" id="editCarouselChk" `+checked+`>
						<label for="editCarouselChk">Ajouter au carousel</label>
					</div>
					<button type="submit" class="btn btn-default">Modifier</button>
				</form>
				<div class="success hide">
				</div>
				`);

			// Traitement de la checkbox
			var carousel = r.infos.Carousel;
			$('body').find('input:checkbox').change(function() {
				var temp = $(this).is(":checked");
				if ( temp == true ) {
					carousel = 1;
				} else {
					carousel = 0;
				}
			})

			$('#editPictureForm').on('submit', function(e) {

				e.preventDefault();

				$.ajax({
					method 	 :'POST',
					url 	 : 'edit-picture.php',
					dataType : 'JSON',
					data 		: {
						id 		: id,
						phase 	: 2,
						carousel: carousel,
						data 	: $('#editPictureForm').serialize()
					}
				}).done(function (r) {

					if ( typeof r.error !== 'undefined' ) {

						// Pas d'erreur sur le champ name
						if ( typeof r.error.name === 'undefined' ) {
							$('#editNameError') 
							.addClass('hide')
							.html('');
						}

						// champ name vide
						if ( r.error.name == 'err_empty' ) {
							$('#editNameError')
							.removeClass('hide')
							.html('Champ obligatoire');
						}

						// champ name < 3 caractères
						if ( r.error.name == 'err_tooShort' ) {
							$('#editNameError')
							.removeClass('hide')
							.html('Ce champ doit contenir au moins 3 caractères');
						}

						// champ name > 25 caractères
						if ( r.error.name == 'err_tooLong' ) {
							$('#editNameError')
							.removeClass('hide')
							.html('Ce champ doit contenir moins de 25 caractères');
						}

						// Pas d'erreur sur le champ legend
						if ( typeof r.error.legend === 'undefined' ) {
							$('#editLegendError')
							.addClass('hide')
							.html('');
						}

						// champ legend vide 
						if ( r.error.legend == 'err_empty' ) {
							$('#editLegendError')
							.removeClass('hide')
							.html('Champ obligatoire');
						}

						// champ legend < 3 caractères 
						if ( r.error.legend == 'err_tooShort' ) {
							$('#editLegendError')
							.removeClass('hide')
							.html('Ce champ doit contenir au moins 3 caractères');
						}

						// Pas d'erreur sur le champ alt
						if ( typeof r.error.alt === 'undefined' ) {
							$('#editAltError')
							.addClass('hide')
							.html('');
						}

						// champ alt vide 
						if ( r.error.alt == 'err_empty' ) {
							$('#editAltError')
							.removeClass('hide')
							.html('Champ obligatoire');
						}

						// champ alt < 3 caractères
						if ( r.error.alt == 'err_tooShort' ) {
							$('#editAltError')
							.removeClass('hide')
							.html('Ce champ doit contenir au moins 3 caractères');
						}

						// champ alt > 25 caractères
						if ( r.error.alt == 'err_tooLong' ) {
							$('#editAltError')
							.removeClass('hide')
							.html('Ce champ doit contenir moins de 25 caractères');
						}
					} // fin error undefined
					
					if ( typeof r.success !== 'undefined' ) {
		
						closeEditWindow();

						$('#success')
							.removeClass('hide')
							.html('<p>Image modifiée avec succès</p>');
						
						setTimeout(function() {
							$('#success')
								.html('')
								.addClass('hide');
						}, 2000);
						
					}	

				});
			});
		}
	});
		
}

function deletePicture(id, url){
	closeEditWindow();
	closeAddWindow();

	$.ajax({
		method	: 'POST',
		url 	: 'delete-picture.php',
		dataType: 'JSON',
		data    : {
			id 		: id,
			url 	: url
		}
	})
}

function getPictures() { // admin-portfolio.php


	// Destruction de toutes les vignettes existantes
	$('.seekNdestroy').remove();

	// Remplacement des vignettes
	$.ajax({
		method	: 'POST',
		url 	: 'get-portfolio.php',
		dataType: 'JSON',
	}).done( function(r) {

		r.forEach( function(picture) {

			$('#pictures').prepend(` 
				<div class="col-sm-3 seekNdestroy">
				<div class="thumbnail">
				<a href="#" class="thumbnailLink"><img src="`+picture.URL+`" alt="`+picture.ALT+`" height="250" width="250"></a>
				</div>
				<div>
				<button class="btn btn-primary editPicture" data-idpicture="`+picture.id+`">Editer</button>
				<button class="btn btn-primary deletePicture" data-idpicture="`+picture.id+`">Supprimer</button>
				</div>
				</div> 
				`);

		});

		
	});
} // Fin getPicture

function addPicture () { // admin-portfolio.php


	// Initialisation des variables
	var file_data = $('#newPic').prop('files')[0];   
	var form_data = new FormData();                  
	form_data.append('file', 		file_data				);
	form_data.append('name', 		$('#name').val() 		);
	form_data.append('legend',		$('#legend').val() 		);
	form_data.append('alt', 		$('#alt').val() 		);
	form_data.append('carousel', 	$('#carouselChk').prop('checked') );


	$.ajax({
		method			:	'POST',
		url				:	'add-picture.php',
		dataType 		:	'JSON',
		cache  			: 	false,
		contentType 	:	false,
		processData 	:	false,
		data 			:	form_data,

	}).done( function(r){
		
		if ( typeof r.error !== 'undefined' ) {

			// Pas d'erreur sur le champ name
			if ( typeof r.error.name === 'undefined' ) {
				$('#nameError')
				.addClass('hide')
				.html('');
			}

			// champ name vide
			if ( r.error.name == 'err_empty' ) {
				$('#nameError')
				.removeClass('hide')
				.html('Champ obligatoire');
			}

			// champ name < 3 caractères
			if ( r.error.name == 'err_tooShort' ) {
				$('#nameError')
				.removeClass('hide')
				.html('Ce champ doit contenir au moins 3 caractères');
			}

			// champ name > 25 caractères
			if ( r.error.name == 'err_tooLong' ) {
				$('#nameError')
				.removeClass('hide')
				.html('Ce champ doit contenir moins de 25 caractères');
			}

			// Pas d'erreur sur le champ legend
			if ( typeof r.error.legend === 'undefined' ) {
				$('#legendError')
				.addClass('hide')
				.html('');
			}

			// champ legend vide 
			if ( r.error.legend == 'err_empty' ) {
				$('#legendError')
				.removeClass('hide')
				.html('Champ obligatoire');
			}

			// champ legend < 3 caractères 
			if ( r.error.legend == 'err_tooShort' ) {
				$('#legendError')
				.removeClass('hide')
				.html('Ce champ doit contenir au moins 3 caractères');
			}

			// Pas d'erreur sur le champ alt
			if ( typeof r.error.alt === 'undefined' ) {
				$('#altError')
				.addClass('hide')
				.html('');
			}

			// champ alt vide 
			if ( r.error.alt == 'err_empty' ) {
				$('#altError')
				.removeClass('hide')
				.html('Champ obligatoire');
			}

			// champ alt < 3 caractères
			if ( r.error.alt == 'err_tooShort' ) {
				$('#altError')
				.removeClass('hide')
				.html('Ce champ doit contenir au moins 3 caractères');
			}

			// champ alt > 25 caractères
			if ( r.error.alt == 'err_tooLong' ) {
				$('#altError')
				.removeClass('hide')
				.html('Ce champ doit contenir moins de 25 caractères');
			}
	
			// Pas d'erreur sur le champ file
			if ( typeof r.error.upload === 'undefined' ) {
				$('#uploadError')
				.addClass('hide')
				.html('');
			}

			// champ file n'est pas une image
			if ( r.error.upload == 'err_emptyUpload' ) {
				$('#uploadError')
				.removeClass('hide')
				.html('Aucun fichier chargé');
			}

			// champ file n'est pas une image
			if ( r.error.upload == 'err_MIME' ) {
				$('#uploadError')
				.removeClass('hide')
				.html('Ce n\'est pas une image');
			}

			// erreur lors du téléchargement
			if ( r.error.upload == 'err_rec' ) {
				$('#uploadError')
				.removeClass('hide')
				.html('Une erreur est survenue lors du téléchargement');
			}


		} // Fin .error 'undefined'

		if ( typeof r.success !== 'undefined' ) {
			
			closeAddWindow();

			$('#success')
			.removeClass('hide')
			.html('<p>Image ajoutée avec succès</p>');
			
			setTimeout(function() {
				$('#success')
					.html('')
					.addClass('hide');
				getPictures();
			}, 2000);
			
		}
	});

} //fin addPicture

// DOM LOADED CONTENT
$( function () {

	// Admin portfolio
	getPictures();
	// Affichage du formulaire en cas de click sur le bouton +
	$('#addPicture').on('click', function(e) {

		e.preventDefault();
		closeEditWindow ();
		
		$('#addPictureForm')
		.removeClass('hide');
	});

	// Contrôle du formulaire add picture
	
	$('#addPictureForm').submit( function (e) {
		e.preventDefault();

		addPicture();
		
	});

	$('body').on('click','.deletePicture', function(e) {
		
		e.preventDefault();


		var idPicture  = $(this).data('idpicture');
		var urlPicture = $(this)
		.parent('div')
		.prev('.thumbnail')
		.find('img')
		.attr('src');

		deletePicture(idPicture, urlPicture);
		setTimeout(getPictures, 400);

	});

	$('body').on('click', '.editPicture', function(e) {

		e.preventDefault();
		closeEditWindow();
		closeAddWindow();

		var idPicture = $(this).data('idpicture');
		editPicture (idPicture);
		setTimeout(getPictures, 400);
	});

	$('body').on('click', '#closeAddWindow', function(e) {

		e.preventDefault();
		closeAddWindow(); 
	});

	$('body').on('click', '#closeEditWindow', closeEditWindow);

	// Fin admin portfolio
	
	// Carousel
	$('.carousel').carousel('cycle');
	$('.carousel-control.left').click(function(){
		$('.carousel').carousel('prev')
	});
	$('.carousel-control.right').click(function(){
		$('.carousel').carousel('next')
	});
	// Fin carousel

}); // Fin du DOM LOADED CONTENT

