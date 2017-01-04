<?php $this->layout('layout', ['title' => '', 'user' => $user]) ?>

<?php $this->start('main_content') ?>
<!-- 	<h2>Gérer vos demandes de reservations de jardins</h2> -->
	
	<!-- <p>Retrouvez l'ensemble des détails de votre profil et gérer vos jardins à partager</p> -->
	
			<div class="container">
		    <div class="row profile">
				<div class="col-md-3">
					<?= $this->insert('users/sidebar_dashboard', ['user' => $user]) ?>
				</div>
				<div class="col-md-9">
		            <div class="profile-content">
						<title>reception de messages</title>

				<div class="container">
				    <div class="row">
				        <div class="col-md-6">
				            <div class="alert alert-info">
				                Historique de demandes de jardins</div>
				            <div class="alert alert-success" style="display:none;">
				                <span class="glyphicon glyphicon-ok"></span> Drag table row and cange Order</div>
				            <table class="table" width="100%">
				                <thead>
				                    <tr>
				                        <th>
				                            Pseudo
				                        </th>
				                        <th>
				                            Prénom
				                        </th>
				                        <th>
				                            Message
				                        </th>
				                        <th>
				                            Date
				                        </th>
				                    </tr>
				                </thead>
				                <tbody>
				                    <tr>
				                    <?php foreach($received as $recei) : ?>
				                        <td>
				                            <?= $recei['pseudo'] ?>
				                        </td>
				                        <td>
				                            <?= $recei['firstname'] ?>
				                        </td>
				                        <td>
				                            <?= $recei['Message'] ?>
				                        </td>
				                        <td>
				                            <?= $recei['Date'] ?>
				                        </td>
				                    </tr>
				                    </tr><?php endforeach ?>

				                </tbody>
				            </table>
				        </div>
				    </div>
				</div>


<?php $this->stop('main_content') ?>
