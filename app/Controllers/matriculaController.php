<?php

namespace App\Controllers;

use App\Security\CSRF;
use App\Model\Turma;
use App\Model\Matricula;
use App\Core\Session;

Session::iniciar();
if (!Session::Logado()) {
    header('Location: /');
    exit;
}

class matriculaController
{
    public function salvarMatricula()
    {
        if (!isset($_POST['csrf_token']) || !CSRF::validateToken($_POST['csrf_token'])) {
            $mensagem = "CSRF Token inválido!";
            header('Location: /?error=' . urlencode($mensagem));
            exit;
        }
        $id_turma = filter_input(INPUT_POST, 'id_turma_matricula', FILTER_VALIDATE_INT);
        $id_aluno = filter_input(INPUT_POST, 'id_aluno', FILTER_VALIDATE_INT);

        if (!isset($id_turma)) {
            $mensagem = "Envie uma turma valida.";
            header("Location: /turmas?mensagem=" . urlencode($mensagem));
            exit;
        }

        if (!isset($_POST['id_aluno'])) {
            $mensagem = "Envie um aluno valido.";
            header("Location: /turmas?mensagem=" . urlencode($mensagem));
            exit;
        }

        if ($id_turma === false) {
            $mensagem = "Envie uma turma valida.";
            header("Location: /turmas?mensagem=" . urlencode($mensagem));
            exit;
        }
        if ($id_aluno === false) {
            $mensagem = "Envie um aluno valido.";
            header("Location: /turmas?mensagem=" . urlencode($mensagem));
            exit;
        }

        $matricula = new Matricula();

        $matricula->criarMatricula(id_aluno: $id_aluno, id_turma: $id_turma);

        $mensagem = "Aluno matriculado.";
        header(header: "Location: /turma/" . $id_turma . "?mensagem=" . urlencode($mensagem));
        exit;
    }
    public function excluirMatricula()
    {
        if (!isset($_POST['csrf_token']) || !CSRF::validateToken($_POST['csrf_token'])) {
            $mensagem = "CSRF Token inválido!";
            header('Location: /?error=' . urlencode($mensagem));
            exit;
        }
        $id_matricula = $_POST['id_matricula'];
        $id_turma = $_POST['id_turma'];

        $matricula = new Matricula();

        $resultado = $matricula->excluirMatricula(id_matricula: $id_matricula);

        if (!$resultado) {
            $mensagem = "Erro ao tentar remover o aluno!";
            header('Location: /turma/' . $id_turma . '?mensagem=' . urlencode($mensagem));
        }
        $mensagem = "Aluno removido com sucesso!";
        header('Location: /turma/' . $id_turma . '?mensagem=' . urlencode($mensagem));
    }
}
