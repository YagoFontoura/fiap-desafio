<?php

namespace App\Controllers;

use App\Model\Aluno;
use App\Core\Session;
use App\Security\CSRF;

Session::iniciar();
if (!Session::Logado()) {
    header('Location: /');
    exit;
}

class alunoController
{
    public function index()
    {
        $parametros = null;

        if (isset($_GET['params'])) {
            $parametros = $_GET['params'];
        }
        $aluno = new Aluno();

        $alunosLista = $aluno->listarAluno(params: $parametros);

        return view(view: 'aluno', data: ['status' => false, 'alunos' => $alunosLista]);
    }
    public function salvaAluno()
    {
        if (!isset($_POST['csrf_token']) || !CSRF::validateToken($_POST['csrf_token'])) {
            $mensagem = "CSRF Token inválido!";
            header('Location: /?error=' . urlencode($mensagem));
            exit;
        }
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $data_nascimento = $_POST['data_nascimento'];
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];

        $aluno = new Aluno();

        $aluno->criarAluno(nome: $nome, data_nascimento: $data_nascimento, cpf: $cpf, email: $email, senha: $senha);

        $mensagem = "Aluno criado com sucesso!";
        header("Location: /alunos?mensagem=" . urlencode($mensagem));
        exit;
    }
    public function atualizarAluno()
    {
        if (!isset($_POST['csrf_token']) || !CSRF::validateToken($_POST['csrf_token'])) {
            $mensagem = "CSRF Token inválido!";
            header('Location: /?error=' . urlencode($mensagem));
            exit;
        }

        $id_aluno = $_POST['id_aluno'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $data_nascimento = $_POST['data_nascimento'];
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];

        $aluno = new Aluno();

        $aluno->atualizarAluno(id_aluno: $id_aluno, nome: $nome, data_nascimento: $data_nascimento, cpf: $cpf, email: $email, senha: $senha);


        $mensagem = "Aluno atualizado com sucesso!";
        header("Location: /alunos?mensagem=" . urlencode($mensagem));
        exit;
    }
    public function excluirAluno()
    {
        if (!isset($_POST['csrf_token']) || !CSRF::validateToken($_POST['csrf_token'])) {
            $mensagem = "CSRF Token inválido!";
            header('Location: /?error=' . urlencode($mensagem));
            exit;
        }
        $id_aluno = $_POST['id_aluno'];

        $aluno = new Aluno();

        $aluno->excluirAluno(id_aluno: $id_aluno);

        $mensagem = "Aluno excluído com sucesso!";
        header("Location: /alunos?mensagem=" . urlencode($mensagem));
        exit;
    }
}
