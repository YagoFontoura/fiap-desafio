<?php

namespace App\Model;

use Database\Connection;

class Aluno
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = Connection::getConnection();
    }
    public function listarAluno($params = null)
    {
        if ($params) {
            $stmt = $this->pdo->prepare("
            SELECT * FROM alunos 
            WHERE id_aluno LIKE :term_like
               OR nome LIKE :term_like2
               OR cpf LIKE :term_like3
               OR email LIKE :term_like4
            ORDER BY nome ASC
        ");
            $stmt->execute(params: [
                'term_like' => '%' . $params . '%',
                'term_like2' => '%' . $params . '%',
                'term_like3' => '%' . $params . '%',
                'term_like4' => '%' . $params . '%'
            ]);
        } else {
            $stmt = $this->pdo->prepare("SELECT * FROM alunos ORDER BY nome ASC");
            $stmt->execute();
        }

        return $stmt->fetchAll();
    }

    public function criarAluno($nome, $data_nascimento, $cpf, $email, $senha): void
    {


        if (strlen(trim($nome)) < 3) {
            $mensagem = "Por favor, insira no mínimo 3 caracteres.";
            header("Location: /alunos?mensagem=" . urlencode($mensagem));
            exit;
        }
        if (!preg_match('/^[A-Za-zÀ-ÿ\s]+$/', $nome)) {
            $mensagem = "O nome só pode conter letras e espaços.";
            header("Location: /alunos?mensagem=" . urlencode($mensagem));
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mensagem = "E-mail inválido.";
            header("Location: /alunos?mensagem=" . urlencode($mensagem));
            exit;
        }

        if (strlen(preg_replace('/\D/', '', $cpf)) != 11) {
            $mensagem = "CPF deve conter 11 dígitos numéricos.";
            header("Location: /alunos?mensagem=" . urlencode($mensagem));
            exit;
        }
        if (!$this->validarCPF($cpf)) {
            $mensagem = "Envie um CPF valido";
            header("Location: /alunos?mensagem=" . urlencode($mensagem));
            exit;
        }
        if ($this->verificarCpfExistente($cpf)) {
            $mensagem = "Esse CPF já está cadastrado.";
            header("Location: /alunos?mensagem=" . urlencode($mensagem));
            exit;
        }

        if ($this->verificarEmailExistente($email)) {
            $mensagem = "Esse e-mail já está cadastrado.";
            header("Location: /alunos?mensagem=" . urlencode($mensagem));
            exit;
        }

        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>_\-]).{8,}$/', $senha)) {
            $mensagem = "A senha deve ter no mínimo 8 caracteres, incluindo letra maiúscula, minúscula, número e símbolo.";
            header("Location: /alunos?mensagem=" . urlencode($mensagem));
            exit;
        }

        $nome = strtoupper($nome);
        $cpf = trim($cpf);
        $cpf = str_replace(['.', '-'], '', $cpf);
        $email = strtolower($email);

        $stmt = $this->pdo->prepare("
            INSERT INTO alunos (nome, data_nascimento, cpf, email, senha) 
            VALUES (:nome, :data_nascimento, :cpf, :email, :senha)
        ");


        $stmt->execute([
            'nome' => $nome,
            'data_nascimento' => $data_nascimento,
            'cpf' => $cpf,
            'email' => $email,
            'senha' => password_hash($senha, PASSWORD_DEFAULT)
        ]);
    }

    public function atualizarAluno($id_aluno, $nome, $data_nascimento, $cpf, $email, $senha = null)
    {
        if (strlen(trim($nome)) < 3) {
            $mensagem = "Por favor, insira no mínimo 3 caracteres.";
            header("Location: /alunos?mensagem=" . urlencode($mensagem));
            exit;
        }
        if (!preg_match('/^[A-Za-zÀ-ÿ\s]+$/', $nome)) {
            $mensagem = "O nome só pode conter letras e espaços.";
            header("Location: /alunos?mensagem=" . urlencode($mensagem));
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mensagem = "E-mail inválido.";
            header("Location: /alunos?mensagem=" . urlencode($mensagem));
            exit;
        }

        if (strlen(preg_replace('/\D/', '', $cpf)) != 11) {
            $mensagem = "CPF deve conter 11 dígitos numéricos.";
            header("Location: /alunos?mensagem=" . urlencode($mensagem));
            exit;
        }

        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>_\-]).{8,}$/', $senha)) {
            $mensagem = "A senha deve ter no mínimo 8 caracteres, incluindo letra maiúscula, minúscula, número e símbolo.";
            header("Location: /alunos?mensagem=" . urlencode($mensagem));
            exit;
        }

        $nome = strtoupper($nome);
        $cpf = trim($cpf);
        $cpf = str_replace(['.', '-'], '', $cpf);
        $email = strtolower($email);


        $sql = "UPDATE alunos 
            SET nome = :nome, 
                data_nascimento = :data_nascimento, 
                cpf = :cpf, 
                email = :email";

        $params = [
            'id_aluno' => $id_aluno,
            'nome' => $nome,
            'data_nascimento' => $data_nascimento,
            'cpf' => $cpf,
            'email' => $email
        ];

        if ($senha) {
            $sql .= ", senha = :senha";
            $params['senha'] = password_hash($senha, PASSWORD_DEFAULT);
        }

        $sql .= " WHERE id_aluno = :id_aluno";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    public function excluirAluno($id_aluno)
    {
        if (!is_numeric($id_aluno) || !filter_var($id_aluno, FILTER_VALIDATE_INT)) {
            $mensagem = "Envie um aluno válido para exclusão.";
            header("Location: /alunos?mensagem=" . urlencode($mensagem));
            exit;
        }
        $stmt = $this->pdo->prepare("DELETE FROM alunos WHERE id_aluno = :id_aluno");
        $stmt->execute(['id_aluno' => $id_aluno]);
        return $stmt->rowCount();
    }

    private function verificarEmailExistente($email)
    {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) as total 
            FROM alunos 
            WHERE email = :email 
        ");
        $stmt->execute([
            'email' => $email,

        ]);
        $result = $stmt->fetch();
        return $result['total'] > 0;
    }
    private function verificarCpfExistente($cpf)
    {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) as total 
            FROM alunos 
            WHERE cpf = :cpf 
        ");
        $stmt->execute([
            'cpf' => $cpf,

        ]);
        $result = $stmt->fetch();
        return $result['total'] > 0;
    }

    private function validarCPF($cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$t] != $d) {
                return false;
            }
        }

        return true;
    }
}
