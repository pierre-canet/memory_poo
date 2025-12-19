<?php
session_start();
require_once 'Game.php';
if (isset($_POST['pair-select'])) {
    unset($_SESSION['deck']);
    unset($_SESSION['turn']);
    $_SESSION['pairs'] = $_POST['pair-select'];
    header('Location: board.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
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
    <h1>Bienvenue !</h1>
    <div class="intro">
        <h3>Introduction</h3>
        <p>Ici vous pourrez jouer à un jeu de Memory dont vous pourrez sélectionner la difficulté !</p>
    </div>
    <form method="POST">
        <div class="form-group"></div>
        <label for="pair-select">Choisissez votre nombre de paires</label>
        <select name="pair-select" id="">
            <option value="3">3 paires</option>
            <option value="6">6 paires</option>
            <option value="9">9 paires</option>
            <option value="12">12 paires</option>
        </select>
        <button type="submit">Jouer !</button>
    </form>
</body>

</html>