<!-- <?php $this->layout('layout', ['title' => 'Liste des comptes']) ?>

<?php $this->start('messages') ?>
	<dialog open class="hide confirm-update">Le solde a été modifié</dialog>
<?php $this->stop('messages') ?>

<?php $this->start('main_content') ?>

<input type="hidden" id="ajax_operation_route" value="<?= $this->url('account_ajax_operation') ?>">

<nav>Trier par :
	<a href="<?= $this->url('account_all', ['mode' => 'name']) ?>">Nom</a> |
	<a href="<?= $this->url('account_all', ['mode' => 'balance']) ?>">Solde</a>
</nav>

<nav>
<?php if($role == 'admin') : ?>
<a href="<?= $this->url('account_add') ?>">Ouvrir un nouveau compte ></a> |
<?php endif ?>
<a href="<?= $this->url('default_logout') ?>">Déconnexion</a>
</nav>

Connecté en tant que : <?= $role ?>

<ul>
	<?php foreach($allAccounts as $account) : ?>
	<li>
		<form action="#" class="form-<?= $account['id'] ?>">
			<?= $account['owner'] ?> (<span class="current-amount"><?= $account['balance'] ?></span> <?= $account['currency'] ?>)

			<?php if($role == 'admin') : ?>
			<input type="hidden" name="accountId" value="<?= $account['id'] ?>">
			<input type="text" name="amount" placeholder="Montant" class="amount">
			<label for="debit-<?= $account['id'] ?>"><input type="radio" name="operation" checked value="debit" id="debit-<?= $account['id'] ?>"> Débiter</label>
			<label for="credit-<?= $account['id'] ?>"><input type="radio" name="operation" value="credit" id="credit-<?= $account['id'] ?>"> Créditer</label>
			<button class="change-balance" type="submit">Valider</button>
			<?php endif ?>

			[<a href="<?= $this->url('account_details', ['id' => $account['id']]) ?>">Consulter</a>
			<?php if($role == 'admin') : ?>
			|
			<a href="<?= $this->url('account_change', ['id' => $account['id']]) ?>">Modifer</a> |
			<a href="<?= $this->url('account_delete', ['id' => $account['id']]) ?>">Supprimer</a>
			<?php endif ?>]
		</form>
	</li>
	<?php endforeach ?>
<ul>
<?php $this->stop('main_content') ?>
 -->