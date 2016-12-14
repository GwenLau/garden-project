<?php $this->layout('layout', ['title' => 'Connexion']) ?>

<?php $this->start('messages') ?>
	<?php if(isset($error)) : ?>
		<dialog open>Connexion impossible</dialog>
	<?php endif ?>
<?php $this->stop('messages') ?>

<?php $this->start('main_content') ?>


		<form class="form-inline" method="POST" action="#">
		  <div class="form-group">
		    <label class="sr-only" for="exampleInputEmail3">Email address</label>
		    <input type="email" class="form-control" id="exampleInputEmail3" name="mail" placeholder="E-mail">
		  </div>
		  <div class="form-group">
		    <label class="sr-only" for="exampleInputPassword3">Password</label>
		    <input type="password" name="pass" class="form-control" id="exampleInputPassword3" placeholder="Mot de passe">
		    <a href="<?= $this->url('default_password_recovery') ?>">Mot de passe oublié ?</a>
		  </div>
		  <button type="submit" name="login" class="btn btn-default">Connexion</button>
		</form>

<?php $this->stop('main_content') ?>