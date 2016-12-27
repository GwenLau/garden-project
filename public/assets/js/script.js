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