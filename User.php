<?php
class User
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

    public function search_user_by_username($username)
    {
        $stmt = mysqli_prepare(
            $this->connexion,
            "SELECT * FROM users WHERE username = ?"
        );

        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }
    public function createUser($username, $password)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare(
            $this->connexion,
            "INSERT into users (username, password) VALUES (?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
        return mysqli_stmt_execute($stmt);
    }
    public function logout()
    {
        unset($_SESSION['username']);
        unset($_SESSION['id']);
        session_destroy();
    }
}
