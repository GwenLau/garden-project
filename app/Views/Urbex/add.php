<!-- <?php $this->layout('layout', ['title' => 'Créer un nouveau compte']) ?>

<?php $this->start('main_content') ?>

<nav><a href="<?= $this->url('account_all_default') ?>">< Retour à la liste</a></nav>

<form action="#" method="POST">

	<?php if(isset($errors['owner']['empty'])) : ?>
		<p>Le nom du propriétaire est vide</p>
	<?php endif ?>
	<fieldset>Propriétaire : <input type="text" name="owner"></fieldset>
	<fieldset>

		<?php if(isset($errors['balance']['empty'])) : ?>
			<p>Précisez un solde de départ</p>
		<?php endif ?>
		<p>Solde de départ : <input type="text" name="balance"></p>

		<?php if(isset($errors['currency']['empty'])) : ?>
			<p>Quelle devise utiliser ?</p>
		<?php endif ?>
		<p>Devise : <input type="text" name="currency"></p>
	</fieldset>
	<button type="submit" name="add-user">Valider l'opération</button>
</form>

<?php $this->stop('main_content') ?>
 -->