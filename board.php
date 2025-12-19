<?php require_once 'Card.php';
require_once 'User.php';
require_once 'Game.php';
session_start(); ?>

<html lang='fr'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Jeu de Mémoire</title>
    <link rel='stylesheet' href='./style.css'>
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
    <form method="post" class='game-board'>
        <?php

        if (!isset($_SESSION['deck'])) {
            $deck = [];
            $pairs = $_SESSION['pairs'];
            for ($i = 1; $i <= $pairs; $i++) {
                $imagePath = "./assets/card" . $i . ".png";
                $deck[] = new Card($i * 2 - 1, $imagePath);
                $deck[] = new Card($i * 2, $imagePath);
            }
            if (!isset($_SESSION['move_count'])) {
                $_SESSION['move_count'] = 0;
            }
            shuffle($deck);
            $_SESSION['deck'] = $deck;
            $_SESSION['turn'] = true;
        };
        $allMatched = true;
        $deck = ($_SESSION['deck']);


        if (isset($_POST['cardId'])) {
            for ($i = 0; $i < count($deck); $i++) {
                if ($deck[$i]->getId() == $_POST['cardId']) {
                    $deck[$i]->flipped = true;
                    $flippedCard = $deck[$i]->getImage();
                    if ($_SESSION['turn'] === false) {
                        for ($j = 0; $j < count($deck); $j++) {
                            if ($i !== $j && $deck[$j]->getImage() === $flippedCard && $deck[$j]->flipped === true) {
                                $deck[$j]->matched = true;
                                $deck[$i]->matched = true;
                            }
                        }
                    }
                } elseif ($_SESSION['turn']) {
                    $deck[$i]->flipped = false;
                }
            }
            if ($_SESSION['turn'] === false) {
                $_SESSION['move_count']++;
            }
            $_SESSION['turn'] = !$_SESSION['turn'];
            $_SESSION['deck'] = $deck;
        }

        foreach ($deck as $card) {
            if ($card->matched === false) {
                $allMatched = false;
            }
        }

        if ($allMatched) {
            echo "<div>
            <h2>Félicitations ! Vous avez gagné !</h2>
            <button type='submit' class='restart'>Recommencer</button>
            <a href='index.php'>Retour au menu</a>
            </div>";
            if (isset($_SESSION['user_id'])) {
                $game = new Game();
                $user_id = $_SESSION['user_id'];
                $move_amount = isset($_SESSION['move_count']) ? $_SESSION['move_count'] : 0;
                $pair_amount = $_SESSION['pairs'];

                $game->save_score($user_id, $pair_amount, $move_amount);
            }

            unset($_SESSION['deck']);
            unset($_SESSION['turn']);
            unset($_SESSION['move_count']);
            echo "";
        } else {
            foreach ($deck as $card) {
                if ($card->flipped || $card->matched) {
                    echo "<div class='card'>
                <img src='" . $card->getImage() . "' alt='Card Image'>
                </div>";
                } else {
                    echo "<button type='submit' class='card' name='cardId' value='" . $card->getId() . "'>
                <img src='./assets/backside.png' alt='Card Back'>
                </button>";
                }
            }
        }


        ?>
    </form>
</body>