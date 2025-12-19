<?php
session_start();
require_once 'Game.php';
require_once 'User.php';
$pair_amount = $_GET['pairs'] ?? 3;
$game = new Game();
$scores = $game->get_ranking_by_pairs($pair_amount);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='./style.css'>
    <title>Classements</title>
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
    <h1>Le classement de nos meilleurs champions !</h1>

    <form method="GET">
        <label>Difficulté :</label>
        <select name="pairs" onchange="this.form.submit()">
            <option value="">Choisissez un score</option>
            <option value="3">3 paires</option>
            <option value="6">6 paires</option>
            <option value="9">9 paires</option>
            <option value="12">12 paires</option>
        </select>
    </form>
    <table>
        <tr>
            <th>Rang</th>
            <th>Pseudo</th>
            <th>Coups</th>
            <th>Date</th>
        </tr>

        <?php if (empty($scores)) : ?>
            <tr>
                <td colspan="4">Aucun score pour cette difficulté</td>
            </tr>
        <?php else : ?>
            <?php foreach ($scores as $index => $score) : ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($score['username']) ?></td>
                    <td><?= $score['move_amount'] ?></td>
                    <td><?= $score['win_date'] ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>

</body>

</html>