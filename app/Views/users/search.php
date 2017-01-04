<?php $this->layout('layout', ['title' => '', 'user' => $user]) ?>

<?php $this->start('main_content') ?>
	<h2></h2>
	<p></p>
	
			<div class="container">
			    <div class="row profile">
					<div class="col-md-3">

						<?= $this->insert('users/sidebar_dashboard', ['user' => $user]) ?>

					</div>
					<div class="col-md-9">
			            <div class="profile-content">
						   
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
			  </div>
					</div>
				</div>
			</div>
		<center>
		</center>
		<br>
		<br>

<?php $this->stop('main_content') ?>
