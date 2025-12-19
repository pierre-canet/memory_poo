<?php

class Game
{

    private $connexion;

    public function __construct()
    {
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "memory_poo";

        $this->connexion = mysqli_connect($host, $username, $password, $database);

        if (!$this->connexion) {
            die("Erreur de connexion : " . mysqli_connect_error());
        }
    }
    public function get_all_scores()
    {
        $stmt = mysqli_prepare(
            $this->connexion,
            "SELECT r.*, u.username
         FROM `rank` r
         JOIN users u ON u.id = r.user_id
         ORDER BY r.pair_amount DESC, r.move_amount ASC, r.win_date ASC"
        );

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function get_ranking_by_pairs($pair_amount)
    {
        $stmt = mysqli_prepare(
            $this->connexion,
            "SELECT r.*, u.username
         FROM `rank` r
         JOIN users u ON u.id = r.user_id
         WHERE r.pair_amount = ?
         ORDER BY r.move_amount ASC, r.win_date ASC"
        );

        mysqli_stmt_bind_param($stmt, "i", $pair_amount);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function get_scores_by_user($user_id)
    {
        $stmt = mysqli_prepare(
            $this->connexion,
            "SELECT * FROM `rank` WHERE user_id = ? ORDER BY win_date DESC"
        );

        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function save_score($user_id, $pair_amount, $move_amount)
    {

        $stmt = mysqli_prepare(
            $this->connexion,
            "INSERT INTO `rank` (user_id, pair_amount, move_amount, win_date) VALUES (?, ?, ?, NOW())"
        );

        mysqli_stmt_bind_param($stmt, "iii", $user_id, $pair_amount, $move_amount);
        return mysqli_stmt_execute($stmt);
    }
}
