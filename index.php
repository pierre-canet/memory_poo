<?php
require_once 'Game.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>

<body>
    <h1>Bienvenue !</h1>
    <div class="intro">
        <h3>Introduction</h3>
        <p>Ici vous pourrez jouer à un jeu de Memory dont vous pourrez sélectionner la difficulté !</p>
    </div>
    <form action="board.php">
        <div class="form-group"></div>
        <label for="pair-select">Choisissez votre nombre de paires</label>
        <select name="pair-select" id="">
            <option value="">Selectionnez un nombre</option>
            <option value="">3 paires</option>
            <option value="">6 paires</option>
            <option value="">8 paires</option>
        </select>
        <button type="submit">Jouer !</button>
    </form>
</body>

</html>