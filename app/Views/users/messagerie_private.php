<?php $this->layout('layout', ['title' => '', 'user' => $user]) ?>

<?php $this->start('main_content') ?>
	<!-- <h2>Gérer vos demandes de reservations de jardins</h2> -->
	<!-- <p>Retrouvez l'ensemble des détails de votre profil et gérer vos jardins à partager</p> -->
	
			<div class="container">
		    <div class="row profile">
				<div class="col-md-3">
					<?= $this->insert('users/sidebar_dashboard', ['user' => $user]) ?>
				</div>
				<div class="col-md-9">
		            <div class="profile-content">
					   

            <form action="#" method="POST">
                <div class="container">    
                        <div id="loginbox" style="margin-top:50px;" class="col-md-6">                    
                            <div class="panel panel-info" >
                                    <div class="panel-heading">
                                        <div class="panel-title"></div>
<!-- <title>Envoi de messages</title> -->
						<form method="POST" action="#">
						<label>Destinataire : </label>
						<!-- <?php print_r($dests) ?>  -->
						<select name="destinataire">
							<?php foreach($dests as $user) : ?>
    						<option value=<?= $user['id'] ?>> 
    						<?= $user['pseudo'] ?>
							</option>
							<?php endforeach ?>
						</select>
						<br /><br />
						<textarea placeholder="Votre message" name="message"></textarea>
						<br /><br />
						<input class="btn btn-success" type="submit" value="Envoyer" name="envoi_message">
						<br /><br />
						<?php if(isset($error)) { echo $error; } ?>
						</form>
          

<!-- form JS START-->


<form method="POST" action="#">
<input type="text" class="tags" ><br>
Chose: <span class="tags_id" name="destinataire"></span>
 <!-- <?php print_r($dests) ?>  -->

<!-- <input type="hidden" name="destinataire" value="<?= $user['id'] ?>">  -->

<script>
var raw = [
<?php foreach($dests as $user) : ?>
    { value: <?= $user['id'] ?>, label: <?= "'" . $user['pseudo'] . "'" ?>  },
<?php endforeach ?>
];
var source  = [ ];
var mapping = { };
for(var i = 0; i < raw.length; ++i) {
    source.push(raw[i].label);
    mapping[raw[i].label] = raw[i].value;
}

$('.tags').autocomplete({
    minLength: 1,
    source: source,
    select: function(event, ui) {
        $('.tags_id').text(mapping[ui.item.value]);
    }
});
</script>


<br /><br />
            <textarea placeholder="Votre message" name="message"></textarea>
            <br /><br />
            <input class="btn btn-success" type="submit" value="Envoyer" name="envoi_message">

            </form>

<!-- form AJAX START-->


<form action="#" method="post">
    <p><input type="text" class="tags" placeholder="destinataire">
    Chose: <span class="tags_id" name="destinataire"></span>
        <span class="error marque empty hide">Vous n'avez pas renseigné le destinataire</span>
    </p>

<script>
var raw = [
<?php foreach($dests as $user) : ?>
    { value: <?= $user['id'] ?>, label: <?= "'" . $user['pseudo'] . "'" ?>  },
<?php endforeach ?>
];
var source  = [ ];
var mapping = { };
for(var i = 0; i < raw.length; ++i) {
    source.push(raw[i].label);
    mapping[raw[i].label] = raw[i].value;
}

$('.tags').autocomplete({
    minLength: 1,
    source: source,
    select: function(event, ui) {
        $('.tags_id').text(mapping[ui.item.value]);
    }
});
</script>

<br /><br />
            <textarea placeholder="Votre message" name="message"></textarea>
            <br /><br />
            <input class="btn btn-success" type="submit" value="Envoyer" name="envoi_message">
</form> 





<?php $this->stop('main_content') ?>
