<?php $this->layout('layout', ['title' => 'Connexion']) ?>

<?php $this->start('messages') ?>
	<?php if(isset($error)) : ?>
		<dialog open>Connexion impossible</dialog>
	<?php endif ?>
<?php $this->stop('messages') ?>

<?php $this->start('main_content') ?>

	<section class="login">
		<form action="#" method="post">
			<fieldset>
				<input type="text" name="mail" placeholder="E-mail">
				<input type="password" name="pass" placeholder="Mot de passe">
			</fieldset>
			<a href="<?= $this->url('default_password_recovery') ?>">Mot de passe oublié ?</a>
			<button type="submit" name="login">Connexion</button>
		</form>
	</section>

<?php $this->stop('main_content') ?>