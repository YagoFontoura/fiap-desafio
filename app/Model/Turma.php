<?php

namespace App\Model;

use Database\Connection;

class Turma
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getConnection();
    }

    public function listarTurmas($params = null)
    {
        if ($params) {
            $stmt = $this->pdo->prepare("
                SELECT * FROM turmas 
                WHERE id_turma LIKE :term_like 
                   OR nome LIKE :term_like2
                   OR descricao LIKE :term_like3
                ORDER BY nome ASC
            ");
            $stmt->execute([
                'term_like' => '%' . $params . '%',
                'term_like2' => '%' . $params . '%',
                'term_like3' => '%' . $params . '%',
            ]);
        } else {
            $stmt = $this->pdo->prepare("SELECT * FROM turmas ORDER BY nome ASC");
            $stmt->execute();
        }
        return $stmt->fetchAll();
    }
    public function buscarTurmaPorId($id, $params = null)
    {
        if ($params) {
            $stmt = $this->pdo->prepare("
            SELECT 
                t.id_turma, 
                m.id_matricula, 
                t.nome AS nome_turma,
                t.descricao AS descricao_turma, 
                a.id_aluno,
                a.nome AS nome_aluno,
                a.email,
                a.cpf 
            FROM turmas t 
            LEFT JOIN matriculas m ON m.id_turma = t.id_turma
            LEFT JOIN alunos a ON a.id_aluno = m.id_aluno
            WHERE t.id_turma = :id_turma
               AND (
                   t.nome LIKE :term_like 
                OR t.descricao LIKE :term_like2
                OR a.nome LIKE :term_like3
                OR a.email LIKE :term_like4
                OR a.cpf LIKE :term_like5
               )
            ORDER BY nome_aluno ASC
        ");
            $stmt->execute([
                'id_turma'    => $id,
                'term_like'   => '%' . $params . '%',
                'term_like2'  => '%' . $params . '%',
                'term_like3'  => '%' . $params . '%',
                'term_like4'  => '%' . $params . '%',
                'term_like5'  => '%' . $params . '%',
            ]);
        } else {
            $stmt = $this->pdo->prepare("
            SELECT 
                t.id_turma, 
                m.id_matricula, 
                t.nome AS nome_turma,
                t.descricao AS descricao_turma, 
                a.id_aluno,
                a.nome AS nome_aluno,
                a.email,
                a.cpf 
            FROM turmas t 
            LEFT JOIN matriculas m ON m.id_turma = t.id_turma
            LEFT JOIN alunos a ON a.id_aluno = m.id_aluno
            WHERE t.id_turma = :id_turma
            ORDER BY nome_aluno ASC
        ");
            $stmt->execute(['id_turma' => $id]);
        }

        return $stmt->fetchAll();
    }
    public function criarTurma($nome, $descricao = null)
    {



        if (strlen(trim($nome)) < 3) {
            $mensagem = "Por favor, insira no mínimo 3 caracteres.";
            header("Location: /turmas?mensagem=" . urlencode($mensagem));
            exit;
        }

        if (empty($descricao)) {
            $mensagem = "Por favor, insira alguma descrição";
            header("Location: /turmas?mensagem=" . urlencode($mensagem));
            exit;
        }


        $stmt = $this->pdo->prepare("
            INSERT INTO turmas (nome, descricao) 
            VALUES (:nome, :descricao)
        ");

        $stmt->execute([
            'nome' => $nome,
            'descricao' => $descricao
        ]);

        return $this->pdo->lastInsertId();
    }

    public function atualizarTurma($id_turma, $nome, $descricao = null)
    {
        if (strlen(trim($nome)) < 3) {
            $mensagem = "Por favor, insira no mínimo 3 caracteres.";
            header("Location: /turmas?mensagem=" . urlencode($mensagem));
            exit;
        }

        if (empty($descricao)) {
            $mensagem = "Por favor, insira alguma descrição";
            header("Location: /turmas?mensagem=" . urlencode($mensagem));
            exit;
        }

        $stmt = $this->pdo->prepare("
            UPDATE turmas 
            SET nome = :nome, 
                descricao = :descricao 
            WHERE id_turma = :id_turma
        ");

        $stmt->execute([
            'id_turma' => $id_turma,
            'nome' => $nome,
            'descricao' => $descricao
        ]);

        return $stmt->rowCount();
    }

    public function excluirTurma($id_turma)
    {
        if (!is_numeric($id_turma) || !filter_var($id_turma, FILTER_VALIDATE_INT)) {
            $mensagem = "Envie uma turma válida para exclusão.";
            header("Location: /turmas?mensagem=" . urlencode($mensagem));
            exit;
        }
        $stmt = $this->pdo->prepare("DELETE FROM turmas WHERE id_turma = :id_turma");
        $stmt->execute(['id_turma' => $id_turma]);
        return $stmt->rowCount();
    }

    public function listarTurmasComTotalAlunos($params = null, $page = 1, $porPagina = 10)
    {
        $offset = ($page - 1) * $porPagina;

        if ($params) {
            $stmt = $this->pdo->prepare("
            SELECT t.*, COUNT(m.id_matricula) as total_alunos 
            FROM turmas t
            LEFT JOIN matriculas m ON t.id_turma = m.id_turma
            WHERE t.id_turma LIKE :term_like 
                   OR t.nome LIKE :term_like2
                   OR t.descricao LIKE :term_like3
            GROUP BY t.id_turma
            ORDER BY t.nome ASC
            LIMIT :porPagina OFFSET :offset
        ");
            $stmt->execute([
                'term_like' => '%' . $params . '%',
                'term_like2' => '%' . $params . '%',
                'term_like3' => '%' . $params . '%',
                'porPagina' => $porPagina,
                'offset' => $offset,
            ]);
        } else {
            $stmt = $this->pdo->prepare("
            SELECT t.*, COUNT(m.id_matricula) as total_alunos 
            FROM turmas t
            LEFT JOIN matriculas m ON t.id_turma = m.id_turma
            GROUP BY t.id_turma
            ORDER BY t.nome ASC
            LIMIT :porPagina OFFSET :offset
        ");
            $stmt->execute([
                'porPagina' => $porPagina,
                'offset' => $offset,
            ]);
        }
        return $stmt->fetchAll();
    }
    public function totalPaginasTurma()
    {
        $stmt = $this->pdo->prepare("SELECT CEIL(COUNT(*) / 10.0) AS total_paginas FROM turmas");
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total_paginas'];
    }
}
