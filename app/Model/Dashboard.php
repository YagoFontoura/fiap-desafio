<?php

namespace App\Model;

use Database\Connection;

class Dashboard
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getConnection();
    }

    public function index()
    {
        $stmt = $this->pdo->prepare("
        SELECT 
            (SELECT COUNT(*) FROM turmas) AS turmas,
            (SELECT COUNT(*) FROM alunos) AS alunos;
        ");
        $stmt->execute();

        return $stmt->fetch();
    }
}
