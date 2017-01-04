
				<div class="profile-sidebar">

					<div class="profile-usertitle">
						<div class="profile-usertitle-name">


							<?= $user['pseudo'] ?>

						
							<div id="avatar"><img src="<?= $this->assetUrl('uploads/users/' . $user['avatar']) ?>" alt="avatar"></div>
							<div><?= $user['firstname'] ?></div>

						</div>
					</div>

					<div class="panel panel-info">
						<ul class="nav">
							<li>
								<a href="<?= $this->url('default_profil') ?>">
								<i class="glyphicon glyphicon-user"></i>
								Votre compte </a>
							</li>
							<li>
								<a href="<?= $this->url('default_messagerie') ?>">
								<i class="glyphicon glyphicon-send"></i>
								Contacter </a>
							</li>
							<li>
								<a href="<?= $this->url('default_received') ?>">
								<i class="glyphicon glyphicon-envelope"></i>
								Demandes reçues </a>
							</li>
							<li>
								<a href="<?= $this->url('users/dashboard_mesjardins') ?>">
								<i class="glyphicon glyphicon-tree-deciduous"></i>
								Proposer un jardin </a>
							</li>
							<li>
								<a href="<?= $this->url('default_search') ?>"">
								<i class="glyphicon glyphicon-search"></i>
								Rechercher un jardin </a>
							</li>
							<li>
								<a href="<?= $this->url('default_logout') ?>">
								<i class="glyphicon glyphicon-off"></i>
								Se deconnecter </a>
							</li>
						</ul>
					</div>
					<!-- END MENU -->
				</div>

