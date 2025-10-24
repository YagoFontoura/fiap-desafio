<?php

$routes = [
    'GET' => [],
    'POST' => [],
    'PUT' => [],
    'PATCH' => [],
    'DELETE' => [],
];

//Autenticação;
$routes['GET'][''] = 'authController@index'; // Rota para a login (/)
$routes['POST']['login'] = 'authController@login'; // Rota para a login (/)
$routes['GET']['sair'] = 'authController@sair'; // Rota para a login (/)

//Dashboard
$routes['GET']['dashboard'] = 'dashboardController@index'; // Rota para a home (/)

//Aluno
$routes['GET']['alunos'] = 'alunoController@index'; // Rota para a home (/)
$routes['POST']['alunos'] = 'alunoController@salvaAluno'; // Rota para a home (/)
$routes['PATCH']['alunos'] = 'alunoController@atualizarAluno'; // Rota para a home (/)
$routes['DELETE']['alunos'] = 'alunoController@excluirAluno'; // Rota para a home (/)

//Matriculas
$routes['POST']['matricula'] = 'matriculaController@salvarMatricula'; // Rota para a home (/)
$routes['DELETE']['matricula'] = 'matriculaController@excluirMatricula'; // Rota para a home (/)


//Turma
$routes['GET']['turmas'] = 'turmaController@index'; // Rota para a home (/)
$routes['GET']['/turma/{id}/'] = 'turmaController@buscarTurmaPorId'; // Rota para a home (/)
$routes['POST']['turmas'] = 'turmaController@salvaTurma'; // Rota para a home (/)
$routes['PATCH']['turmas'] = 'turmaController@editarTurma'; // Rota para a home (/)
$routes['DELETE']['turmas'] = 'turmaController@excluirTurma'; // Rota para a home (/)