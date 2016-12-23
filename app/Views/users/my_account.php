<?php $this->layout('layout', ['title' => 'Mon compte', 'user' => $user]) ?>

<?php $this->start('main_content') ?>
	
		<div class="container">
		    <div class="row profile">
				<div class="col-md-3">
					<?= $this->insert('users/sidebar_dashboard', ['user' => $user]) ?>
				</div>
				<div class="col-md-9">

				
		            
				</div>
			</div>
		</div>



<?php $this->stop('main_content') ?>
