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
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
    <form method="POST">
        <div class="form-group">
            <label for="username">Votre pseudo</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div class="form-group">
            <label for="password">Votre mot de passe</label>
            <input type="password" name="password" id="password" maxlength="20" required>
        </div>
        <button type="submit" name="submit">Connexion</button>
    </form>
</body>

</html>