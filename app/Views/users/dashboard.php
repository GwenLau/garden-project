<?php $this->layout('layout', ['title' => 'Dashboard', 'user' => $user]) ?>

<?php $this->start('main_content') ?>
			
			<div class="container">
			    <div class="row profile">
					<div class="col-md-3">
						<?= $this->insert('users/sidebar_dashboard', ['user' => $user]) ?>
					</div>
					<div class="col-md-9">
			            <div class="profile-content">
						   
								Bienvenue <?= $user['pseudo'] ?>, gérez votre profil, proposez un jardin ou faites une demande de réservation auprès d'un propriétaire.				
					    </div>
					</div>
				</div>
			</div>

<?php $this->stop('main_content') ?>
