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
    if (empty($username) || empty($password)) {
        set_flash('error', 'Pseudonyme et mot de passe obligatoires.');
        header('Location: login.php');
        exit();
    } else {
        $user = new User();
        $existing_user = $user->search_user_by_username($username);

        if (!$existing_user || !password_verify($password, $existing_user['password'])) {
            set_flash('error', 'Identifiants incorrects.');
            header('Location: login.php');
            exit();
        } else {
            $_SESSION['user_id'] = $existing_user['id'];
            $_SESSION['username'] = $existing_user['username'];
            set_flash('success', 'Connexion validée 🎉');
            header('Location: index.php');
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
    <link rel='stylesheet' href='./style.css'>
    <title>Connexion</title>
</head>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="ranking.php">Classements</a></li>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <li>Bonjour <?= htmlspecialchars($_SESSION['username']) ?></li>
                <li><a href="logout.php">Déconnexion</a></li>
            <?php else : ?>
                <li><a href="register.php">Inscription</a></li>
                <li><a href="login.php">Connexion</a></li>
            <?php endif ?>

            <?php if (isset($_SESSION['deck'])) : ?>
                <li><a href="board.php">Continuer votre partie</a></li>
            <?php endif ?>
        </ul>
    </nav>
</header>

<body>
    <?php if (!empty($_SESSION['flash_message'])) : ?>
        <?php echo $_SESSION['flash-message'] ?>
    <?php endif ?>
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