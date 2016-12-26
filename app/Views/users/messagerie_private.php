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
						<!-- <?php print_r($dests) ?> -->
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
          

           <script>
          $( function() {
          var availableTags = [
                        <?php foreach($dests as $user) : ?>
                          
                           <?= '"' . $user['pseudo'] . '"' . ',' ?>
                        
                        <?php endforeach ?>];
                   
              $( "#tags" ).autocomplete({
                source: availableTags
              });
            } );
           </script>

      <form method="POST" action="#">
          <div class="ui-widget">
            <label for="tags">Destinataire (pseudo): </label> 
            <input id="tags" >
          </div>
            <br /><br />
          <textarea placeholder="Votre message" name="message"></textarea>
            <br /><br />
            <input class="btn btn-success" type="submit" value="Envoyer" name="envoi_message">
            <br /><br />
            
      </form>




<?php $this->stop('main_content') ?>
