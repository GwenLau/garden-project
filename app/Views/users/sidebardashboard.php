
	<div class="profile-sidebar">
		<!-- SIDEBAR USERPIC -->
		<!-- <div class="profile-userpic">
			<img src="http://keenthemes.com/preview/metronic/theme/assets/admin/pages/media/profile/profile_user.jpg" class="img-responsive" alt="">
		</div> -->
		<!-- END SIDEBAR USERPIC -->
		<!-- SIDEBAR USER TITLE -->
		<div class="profile-usertitle">
			<div class="profile-usertitle-name">
				<?= $user['firstname'] ?>
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
					<a href="<?= $this->url('default_profil') ?>">
					<i class="glyphicon glyphicon-user"></i>
					Votre compte </a>
				</li>
				<li>
					<a href="<?= $this->url('default_dashboard') ?>">
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
