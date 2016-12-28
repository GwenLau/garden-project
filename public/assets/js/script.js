
/*$(function(){
    $('form').submit(function(e){
        e.preventDefault();

        $.ajax({
            method: "post",
            url: 'send-mail.php',
            data : {
                formInputs: $(this).serialize(),
            },
            dataType: 'json'
        }).done(function(r){

            $('.error').addClass('hide');

            if(typeof r.success !== 'undefined') {
                $('.mail-sent').removeClass('hide');
            } else {
                // J'ai des erreurs
                if(typeof r.errors.destinataire !== 'undefined') {
                    // J'ai des erreurs sur la marque
                    if(r.errors.destinataire == 'empty') {
                        // La marque était vide
                        $('.error.destinataire.empty').removeClass('hide');
                    }
                }

                if(typeof r.errors.message !== 'undefined') {
                    if(r.errors.message == 'empty') {
                        $('.error.message.empty').removeClass('hide');
                    }
                }
            }

            console.log(r);
        }).fail(function(r){
            console.log(r.responseText);
        });

        return false;
    });
});
 */

function initMap()
{
    var container = document.getElementById('map');
    var map = new google.maps.Map(container, {
        center : {lat:47, lng:2.40},
        zoom : 5
    });
    var myMarkerImage = new google.maps.MarkerImage('assets/img/jardin-mini.png');

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

