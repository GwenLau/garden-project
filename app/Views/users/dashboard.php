<?php $this->layout('layout', ['title' => 'Dashboard']) ?>

<?php $this->start('main_content') ?>
	<h2>Gérer ou trouver un jardin</h2>
	<p>Retrouvez l'ensemble des détails de votre profil et gérer vos jardins à partager</p>
	
			<div class="container">
		    <div class="row profile">
				<div class="col-md-3">
					<div class="profile-sidebar">
						<!-- SIDEBAR USERPIC -->
						<div class="profile-userpic">
							<img src="http://keenthemes.com/preview/metronic/theme/assets/admin/pages/media/profile/profile_user.jpg" class="img-responsive" alt="">
						</div>
						<!-- END SIDEBAR USERPIC -->
						<!-- SIDEBAR USER TITLE -->
						<div class="profile-usertitle">
							<div class="profile-usertitle-name">
								Nom de l'user "David Jankovic"
							</div>
						</div>
						<!-- END SIDEBAR USER TITLE -->
						<!-- SIDEBAR BUTTONS -->
						<div class="profile-userbuttons">
							<button type="button" class="btn btn-danger btn-sm">Messagerie</button>
						</div>
						<!-- END SIDEBAR BUTTONS -->
						<!-- SIDEBAR MENU -->
						<div class="profile-usermenu">
							<ul class="nav">
								<li>
									<a href="#">
									<i class="glyphicon glyphicon-user"></i>
									Votre compte </a>
								</li>
								<li>
									<a href="#" target="_blank">
									<i class="glyphicon glyphicon-tree-deciduous"></i>
									Proposer un jardin </a>
								</li>
								<li>
									<a href="#">
									<i class="glyphicon glyphicon-search"></i>
									Rechercher un jardin </a>
								</li>
								<li>
									<a href="#">
									<i class="glyphicon glyphicon-off"></i>
									Se deconnecter </a>
								</li>
							</ul>
						</div>
						<!-- END MENU -->
					</div>
				</div>
				<div class="col-md-9">
		            <div class="profile-content">
					   Bienvenue "Nom du profil"
		            </div>
				</div>
			</div>
		</div>
		<center>
		</center>
		<br>
		<br>

<?php $this->stop('main_content') ?>
