<?php
session_start();
require_once 'User.php';

function set_flash($type, $message)
{
    $_SESSION['flash_messages'][$type][] = $message;
};
if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password-confirm'];
    if (empty($username) || empty($password) || empty($password_confirm)) {
        set_flash('error', 'Tous les champs sont obligatoires.');
        header('Location: register.php');
        exit();
    } elseif (strlen($password) > 20) {
        set_flash('error', 'Le mot de passe doit contenir moins de 20 caractères.');
        header('Location: register.php');
        exit();
    } elseif ($password !== $password_confirm) {
        set_flash('error', 'Les mots de passe ne correspondent pas.');
        header('Location: register.php');
        exit();
    } else {
        $user = new User();
        $existing_user = $user->search_user_by_username($username);

        if ($existing_user) {
            set_flash('error', 'Ce pseudo est déjà utilisé.');
            header('Location: register.php');
            exit();
        } else {
            $create_user = $user->createUser($username, $password);
            set_flash('success', 'Inscription validée 🎉');
            header('Location: login.php');
            exit();
        }
    }
};
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>
    <form method="POST">
        <div class="form-group">
            <label for="username">Votre pseudo</label>
            <input type="text" name="username" id="username" placeholder="15 caractères max" required>
        </div>
        <div class="form-group">
            <label for="password">Votre mot de passe</label>
            <input type="password" name="password" id="password" maxlength="20" placeholder="20 caractères max" required>
        </div>
        <div class="form-group">
            <label for="password-confirm">Confirmer votre mot de passe</label>
            <input type="password" name="password-confirm" id="password-confirm" maxlength="20" placeholder="20 caractères max" required>
        </div>
        <button type="submit" name="submit">S'inscrire</button>
    </form>
</body>

</html>