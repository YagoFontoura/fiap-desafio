<?php

namespace App\Model;

use Database\Connection;

class Matricula
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getConnection();
    }

    public function listarMatriculas($params = null)
    {
        if ($params) {
            $stmt = $this->pdo->prepare("
                SELECT m.*, a.nome as nome_aluno, t.nome as nome_turma 
                FROM matriculas m
                INNER JOIN alunos a ON m.id_aluno = a.id_aluno
                INNER JOIN turmas t ON m.id_turma = t.id_turma
                WHERE m.id_matricula = :term
                   OR m.id_aluno = :term
                   OR m.id_turma = :term
                   OR a.nome LIKE :term_like
                   OR t.nome LIKE :term_like
                ORDER BY m.data_matricula DESC
            ");
            $stmt->execute([
                'term' => $params,
                'term_like' => '%' . $params . '%'
            ]);
        } else {
            $stmt = $this->pdo->prepare("
                SELECT m.*, a.nome as nome_aluno, t.nome as nome_turma 
                FROM matriculas m
                INNER JOIN alunos a ON m.id_aluno = a.id_aluno
                INNER JOIN turmas t ON m.id_turma = t.id_turma
                ORDER BY m.data_matricula DESC
            ");
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criarMatricula($id_aluno, $id_turma)
    {

        if ($this->verificarMatriculaExistente($id_aluno, $id_turma)) {
            $mensagem = "O aluno já está matriculado na turma.";
            header("Location: /turmas?mensagem=" . urlencode($mensagem));
            exit;
        }

        $stmt = $this->pdo->prepare("
            INSERT INTO matriculas (id_aluno, id_turma) 
            VALUES (:id_aluno, :id_turma)
        ");

        $stmt->execute([
            'id_aluno' => $id_aluno,
            'id_turma' => $id_turma
        ]);

        return $this->pdo->lastInsertId();
    }

    public function atualizarMatricula($id_matricula, $id_aluno, $id_turma)
    {
        $stmt = $this->pdo->prepare("
            UPDATE matriculas 
            SET id_aluno = :id_aluno, 
                id_turma = :id_turma 
            WHERE id_matricula = :id_matricula
        ");

        $stmt->execute([
            'id_matricula' => $id_matricula,
            'id_aluno' => $id_aluno,
            'id_turma' => $id_turma
        ]);

        return $stmt->rowCount();
    }

    public function excluirMatricula($id_matricula)
    {
        $stmt = $this->pdo->prepare("DELETE FROM matriculas WHERE id_matricula = :id_matricula");
        $resultado = $stmt->execute(['id_matricula' => $id_matricula]);
        return $resultado;
    }

    private function verificarMatriculaExistente($id_aluno, $id_turma)
    {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) as total 
            FROM matriculas 
            WHERE id_aluno = :id_aluno AND id_turma = :id_turma
        ");
        $stmt->execute([
            'id_aluno' => $id_aluno,
            'id_turma' => $id_turma
        ]);
        $result = $stmt->fetch();
        return $result['total'] > 0;
    }
}
