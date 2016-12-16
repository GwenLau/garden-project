<?php

require_once 'inc/connect.php';
require_once 'inc/functions.php';

if (isset($_POST['save_user'])) {
    $errors = array();

    // Vérifications sur les champs
    if (!empty($_POST['mail'])) {

        // Avant de valider un champ, on le nettoie
        $mail = filter_var($_POST['mail'], FILTER_SANITIZE_SPECIAL_CHARS);
        // Facultatif

        // On teste la validité du mail
        $isMailValid = filter_var($mail, FILTER_VALIDATE_EMAIL);
        if (!$isMailValid) {
            $errors['mail']['invalid'] = true;
        }

        // Le mail est-il déjà enregistré ?
        if (mailExists($pdo, $mail))
            $errors['mail']['exists'] = true;
    } else {

        // Si le mail n'est pas renseigné
        $errors['mail']['empty'] = true;
    }

    if (!empty($_POST['pass1'])) {
        if (strlen($_POST['pass1']) < 8 || strlen($_POST['pass1']) > 30) {
            $errors['pass1']['size'] = true;
        }
    } else {

        // Si on a pas précisé de mot de passe
        $errors['pass1']['empty'] = true;
    }

    if (!empty($_POST['pass2'])) {
        if (!empty($_POST['pass1']) && ($_POST['pass1'] !== $_POST['pass2'])) {

            // Si le mot de passe a été rempli, la confirmation aussi,
            // mais les deux sont différents
            $errors['pass2']['different'] = true;
        }
    } else {

        // On n'a pas renseigné la confirmation de mot de passe
        $errors['pass2']['empty'] = true;
    }

    $lastname = trim($_POST['lastname']);
    $lastname = filter_var($lastname, FILTER_SANITIZE_SPECIAL_CHARS);
    $firstname = trim($_POST['firstname']);
    $firstname = filter_var($firstname, FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($lastname)) {
        // Le nom est vide
        $errors['lastname']['empty'] = true;
    }
    if (empty($firstname)) {
        // Le prénom est vide
        $errors['firstname']['empty'] = true;
    }

    // Le formulaire est valide si je n'ai pas enregistré d'erreurs
    if (count($errors) == 0) {
        $formValid = true;

        // Hash du mot de passe
        $passHashed = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
        $userAdded = insertUser($pdo, $mail, $passHashed, $lastname, $firstname);
    }
}

?><!DOCTYPE html>
<html>
<head>
    <title>Insertion d'un utilisateur</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php if (isset($formValid)) :
    if (isset($userAdded)) : ?>
        L'utilisateur a été ajouté en base de données
    <?php else : ?>
        Problème lors de l'ajout en base de données
    <?php endif;
else: ?>
    <form action="#" id="insert-user" method="POST">
        <header>
            <h1>Inscription</h1>
        </header>

        <div class="field">
            <input error type="text" name="mail" value="<?php if (isset($mail)) echo $mail ?>" placeholder="E-mail"><br>
            <?php if (isset($errors['mail'])) :
                if (isset($errors['mail']['empty'])) : ?>
                    <div class="error">Le mail doit être rempli</div>
                <?php endif;
                if (isset($errors['mail']['invalid'])) : ?>
                    <div class="error">Le mail n'est pas valide</div>
                <?php endif;
                if (isset($errors['mail']['exists'])) : ?>
                    <div class="error">Un compte est déjà enregistré avec cette adresse</div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="field">
            <input type="password" name="pass1" placeholder="Mot de passe"><br>
            <?php if (isset($errors['pass1'])) :
                if (isset($errors['pass1']['empty'])) : ?>
                    <div class="error">Entrez un mot de passe</div>
                <?php endif;
                if (isset($errors['pass1']['size'])) : ?>
                    <div class="error">Le mot de passe doit comprendre entre 8 et 30 caractères</div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="field">
            <input type="password" name="pass2" placeholder="Confirmation"><br>
            <?php if (isset($errors['pass2'])) :
                if (isset($errors['pass2']['empty'])) : ?>
                    <div class="error">Confirmez le mot de passe</div>
                <?php endif;
                if (isset($errors['pass2']['different'])) : ?>
                    <div class="error">Les mots de passe ne correspondent pas</div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="field">
            <input type="text" name="lastname" value="<?php if (isset($lastname)) echo $lastname ?>"
                   placeholder="Nom de famille"><br>
            <?php if (isset($errors['lastname'])) :
                if (isset($errors['lastname']['empty'])) : ?>
                    <div class="error">Entrez votre nom</div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="field">
            <input type="text" name="firstname" value="<?php if (isset($firstname)) echo $firstname ?>"
                   placeholder="Prénom"><br>
            <?php if (isset($errors['firstname'])) :
                if (isset($errors['firstname']['empty'])) : ?>
                    <div class="error">Entrez votre prénom</div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="field">
            <input type="submit" name="save_user" value="Ajouter un utilisateur">
        </div>
    </form>
<?php endif; ?>
</body>
</html>