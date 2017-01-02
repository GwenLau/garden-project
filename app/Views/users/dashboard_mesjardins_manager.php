<?php $this->layout('layout', ['title' => 'Gérer ses jardins', 'user' => $user]) ?>

<?php $this->start('main_content') ?>
	
		<div class="container">
			<div class="row profile">
				<div class="col-md-3">
					<?= $this->insert('users/sidebar_dashboard', ['user' => $user]) ?>
				</div>

					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<table class="table" width="100%">
									<thead>
										<tr>
											<th>
												Nom
											</th>
											<th>
												Ville
											</th>
					   
										</tr>
									</thead>
									<tbody>

									<?php foreach($gardens as $garden) : ?>
										<tr>
											<td>
												<strong><?= $garden['Name'] ?></strong>
											</td>
											<td>
												<?= $garden['City'] ?>
											</td>
											<td>
												<button type="button" class="btn btn-secondary btn-sm" id="<?= $garden['id'] ?>" name="update-garden">Modifier</button>
												<button type="button" class="btn btn-danger btn-sm" id="<?= $garden['id'] ?>" name="delete-garden">X</button>
											</td>
										</tr>
									<?php endforeach ?>
									
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



<?php $this->stop('main_content') ?>