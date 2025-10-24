<?php

namespace App\Controllers;

use App\Model\Aluno;
use App\Model\Turma;
use App\Core\Session;
use App\Security\CSRF;

Session::iniciar();
if (!Session::Logado()) {
    header('Location: /');
    exit;
}

class turmaController
{
    public function index()
    {
        $parametros = null;
        $paginacao = 1;

        if (isset($_GET['params'])) {
            $parametros = $_GET['params'];
        }
        if (isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT) !== false) {
            $paginacao = (int) $_GET['page'];
        }

        $turma = new Turma();
        $aluno = new Aluno();

        $turmaLista = $turma->listarTurmasComTotalAlunos(params: $parametros, page: $paginacao);
        $TotalPaginasTurma = $turma->totalPaginasTurma();
        $alunoLista = $aluno->listarAluno();


        return view(view: 'turma', data: ['status' => false, 'turmas' => $turmaLista, 'alunos' => $alunoLista, 'paginas' => $TotalPaginasTurma]);
    }
    public function buscarTurmaPorId($id)
    {
        $params = isset($_GET['params']) && !empty($_GET['params']) ? $_GET['params'] : null;

        $turma = new Turma();
        $turma_lista = $turma->buscarTurmaPorId(id: $id, params: $params);
        $aluno = new Aluno();
        $alunoLista = $aluno->listarAluno();
        return view(
            view: 'lista_turma',
            data: [
                'status' => false,
                'turma_lista' => $turma_lista,
                'alunos' => $alunoLista,
                'id_turma' => $id
            ]
        );
    }
    public function salvaTurma()
    {
        if (!isset($_POST['csrf_token']) || !CSRF::validateToken($_POST['csrf_token'])) {
            $mensagem = "CSRF Token inválido!";
            header('Location: /?error=' . urlencode($mensagem));
            exit;
        }

        $nome_turma = $_POST['nome_turma'];
        $descricao_turma = $_POST['descricao_turma'];

        $turma = new Turma();

        $turma->criarTurma(nome: $nome_turma, descricao: $descricao_turma);

        header("Location: /turmas?mensagem=Turma+criada+com+sucesso");
        exit;
    }
    public function editarTurma()
    {
        $id_turma = $_POST['id_turma'];
        $nome_turma = $_POST['nome_turma'];
        $descricao_turma = $_POST['descricao_turma'];

        $turma = new Turma();

        $turma->atualizarTurma(id_turma: $id_turma, nome: $nome_turma, descricao: $descricao_turma);

        header("Location: /turmas?mensagem=Turma+editada+com+sucesso");
    }
    public function excluirTurma()
    {
        $id_turma = $_POST['id_turma'];

        $turma = new Turma();

        $turma->excluirTurma(id_turma: $id_turma);

        header("Location: /turmas?mensagem=Turma+excluida+com+sucesso");
    }
}
