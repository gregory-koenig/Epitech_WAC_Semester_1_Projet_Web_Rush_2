<?php

class Database
{
    private $pdo;

    /**
     * Database constructor.
     * @param $login
     * @param $password
     * @param $database_name
     * @param string $host
     */
    public function __construct($login, $password, $database_name,
                                $host = 'localhost')
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$database_name;"
                . 'charset=utf8', $login, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Une erreur s'est produite. Veuillez contacter votre "
                . "administrateur.");
        }
    }

    /**
     * @param $query
     * @param bool $params
     * @return PDOStatement
     */
    public function query($query, $params = false)
    {
        if ($params) {
            $req = $this->pdo->prepare($query);
            $req->execute($params);
        } else {
            $req = $this->pdo->query($query);
        }
        return $req;
    }

    /**
     * @return string
     */
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}