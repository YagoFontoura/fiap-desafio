<?php

use App\Security\CSRF;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>FIAP - Alunos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-50 dark:bg-gray-900">

    <?php include 'sidebar.php'; ?>

    <section class="bg-gray-50 h-100 dark:bg-gray-900 p-4 mt-14 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-5">
                    <!-- Título -->
                    <div class="md:ml-5 mt-2 md:mt-6 text-center md:text-left">
                        <h1 class="font-extrabold text-2xl md:text-4xl leading-tight tracking-tight text-gray-900 dark:text-white">
                            Controle de Alunos
                        </h1>
                        <h6 class="text-gray-700 dark:text-gray-300 mt-1 text-sm md:text-base">
                            Cadastre, edite e exclua alunos
                        </h6>
                    </div>

                    <!-- Botão -->
                    <div class="mt-4 md:mt-0 md:mr-5 flex justify-center md:justify-end w-full md:w-auto">
                        <button
                            id="defaultModalButton"
                            data-modal-target="defaultModal"
                            data-modal-toggle="defaultModal"
                            type="button"
                            class="flex items-center justify-center w-full md:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors">
                            <svg
                                class="w-4 h-4 mr-2"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Adicionar Aluno
                        </button>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row md:items-center md:space-x-4 space-y-3 md:space-y-0 p-4 w-full">
                    <form class="w-full flex flex-col sm:flex-row gap-3" name="params" method="GET">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg
                                    aria-hidden="true"
                                    class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input
                                type="text"
                                id="simple-search"
                                name="params"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Buscar aluno..."
                                required />
                        </div>
                        <button
                            type="submit"
                            class="flex items-center justify-center gap-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors">
                            <svg
                                aria-hidden="true"
                                class="w-5 h-5"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                            Buscar
                        </button>
                    </form>

                    <a
                        href="/alunos"
                        class="flex items-center justify-center whitespace-nowrap text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors w-full md:w-auto">
                        Limpar Filtros
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Identificação</th>
                                <th scope="col" class="px-4 py-3">Nome</th>
                                <th scope="col" class="px-4 py-3">Data de Nascimento</th>
                                <th scope="col" class="px-4 py-3">CPF</th>
                                <th scope="col" class="px-4 py-3">Email</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alunos as $aluno): ?>
                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= htmlspecialchars($aluno['id_aluno'] ?? "Sem informação") ?></th>
                                    <td class="px-4 py-3"><?= htmlspecialchars($aluno['nome'] ?? 'Sem informação') ?></td>
                                    <td class="px-4 py-3"><?= htmlspecialchars($aluno['data_nascimento'] ?? "Sem informação") ?></td>
                                    <td class="px-4 py-3"><?= htmlspecialchars($aluno['cpf'] ?? "Sem informação") ?></td>
                                    <td class="px-4 py-3"><?= htmlspecialchars($aluno['email'] ?? "Sem informação") ?></td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="relative inline-block text-left">
                                            <button
                                                id="dropdown-button-<?= htmlspecialchars($aluno['id_aluno'] ?? 'Sem informação') ?>"
                                                data-dropdown-toggle="aluno-dropdown-<?= htmlspecialchars($aluno['id_aluno'] ?? 'Sem informação') ?>"
                                                type="button"
                                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                                <span class="mr-2">Opções</span>
                                                <svg
                                                    class="w-5 h-5"
                                                    aria-hidden="true"
                                                    fill="currentColor"
                                                    viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM18 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                            </button>

                                            <div
                                                id="aluno-dropdown-<?= htmlspecialchars($aluno['id_aluno'] ?? 'Sem informação') ?>"
                                                class="hidden absolute right-0 mt-2 z-10 min-w-[180px] bg-white rounded-lg shadow-lg divide-y divide-gray-100 dark:bg-gray-700 dark:divide-gray-600">
                                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                                                    <li>
                                                        <button
                                                            id="aluno-edit-button"
                                                            data-modal-target="updateAlunoModal"
                                                            data-modal-toggle="updateAlunoModal"
                                                            data-id_aluno="<?= htmlspecialchars($aluno['id_aluno'] ?? 'Sem informação') ?>"
                                                            data-nome_aluno="<?= htmlspecialchars($aluno['nome'] ?? 'Sem informação') ?>"
                                                            data-data_nascimento="<?= htmlspecialchars($aluno['data_nascimento'] ?? 'Sem informação') ?>"
                                                            data-email="<?= htmlspecialchars($aluno['email'] ?? 'Sem informação') ?>"
                                                            data-cpf="<?= htmlspecialchars($aluno['cpf'] ?? 'Sem informação') ?>"
                                                            class="flex items-center w-full py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white transition-colors">
                                                            <svg
                                                                class="w-4 h-4 mr-2"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                            </svg>
                                                            Editar
                                                        </button>
                                                    </li>
                                                </ul>

                                                <div class="py-1">
                                                    <form action="/alunos" method="POST">
                                                        <?= CSRF::field() ?>
                                                        <input
                                                            type="hidden"
                                                            name="id_aluno"
                                                            value="<?= htmlspecialchars($aluno['id_aluno'] ?? 'Sem informação') ?>" />
                                                        <input type="hidden" name="_method" value="DELETE" />
                                                        <button
                                                            type="submit"
                                                            class="flex items-center w-full py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white transition-colors">
                                                            <!-- Ícone de Excluir -->
                                                            <svg
                                                                class="w-4 h-4 mr-2"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                            Excluir
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                </nav>
            </div>
        </div>
    </section>

    <!-- Modal de criar aluno -->
    <div id="defaultModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Adicionar aluno
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="/alunos" method="POST" class="form-aluno" id="formAluno">
                    <?= CSRF::field() ?>
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="nome_completo_aluno" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome Completo</label>
                            <input
                                type="text"
                                name="nome"
                                id="nome_completo_aluno"
                                class="input-nome bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Ex: Jose da Silva"
                                required>
                            <small class="erro-nome text-red-500 hidden"></small>
                        </div>

                        <div>
                            <label for="data_nascimento_aluno" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data de nascimento</label>
                            <input
                                type="date"
                                name="data_nascimento"
                                id="data_nascimento_aluno"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                            <small id="erro-data" class="text-red-500 hidden"></small>
                        </div>

                        <div>
                            <label for="cpf_aluno" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CPF</label>
                            <input
                                type="text"
                                name="cpf"
                                id="cpf_aluno"
                                class="input-cpf bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="123.456.789-00"
                                required>
                            <small class="erro-cpf text-red-500 hidden"></small>
                        </div>

                        <div>
                            <label for="email_aluno" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input
                                type="email"
                                name="email"
                                id="email_aluno"
                                class="input-email bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="seu.email@fiap.com.br"
                                required>
                            <small class="erro-email text-red-500 hidden"></small>
                        </div>
                    </div>

                    <div class="w-full mb-3">
                        <label for="senha_aluno" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
                        <input
                            type="password"
                            name="senha"
                            id="senha_aluno"
                            class="input-senha bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            title="Mínimo 8 caracteres, pelo menos 1 letra maiúscula, 1 minúscula, 1 número e 1 símbolo"
                            required>
                        <small class="erro-senha text-red-500 hidden"></small>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Adicionar aluno
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal de Edição -->
    <div id="updateAlunoModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-screen modal-overlay">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative p-4 bg-white rounded-xl shadow-2xl dark:bg-gray-800 sm:p-6">
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        Atualizar Aluno
                    </h3>
                    <button type="button" data-modal-toggle="updateAlunoModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Fechar modal</span>
                    </button>
                </div>
                <form id="updateAlunoForm" class="form-aluno" action="/alunos" method="POST">
                    <?= CSRF::field() ?>
                    <input type="hidden" name="id_aluno" id="update_id_aluno">
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="update_nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome Completo</label>
                            <input type="text" name="nome" id="update_nome" class="input-nome bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ex: Jose da Silva" required="">
                            <small class="erro-nome text-red-500 hidden"></small>
                        </div>
                        <div>
                            <label for="update_data_nascimento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data de nascimento</label>
                            <input type="date" name="data_nascimento" id="update_data_nascimento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                        </div>
                        <div>
                            <label for="update_cpf" class="input-cpf block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cpf</label>
                            <input type="text" name="cpf" id="update_cpf" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="123.456.789-00" required="">
                            <small class="erro-cpf text-red-500 hidden"></small>
                        </div>
                        <div>
                            <label for="update_email" class="input-email block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="update_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="seu.email@fiap.com.br" required="">
                            <small class="erro-email text-red-500 hidden"></small>
                        </div>
                        <div>

                        </div>
                    </div>
                    <div class="w-100 mb-3">
                        <label for="senha_aluno" class="input-senha block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
                        <input type="password" name="senha" id="senha_aluno" class="input-senha bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            title="Mínimo 8 caracteres, pelo menos 1 letra maiúscula, 1 minúscula, 1 número e 1 símbolo">
                        <small class="erro-senha text-red-500 hidden"></small>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="w-5 h-5 mr-1 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Atualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast de Notificação -->
    <?php if (isset($_GET['mensagem'])): ?>
        <div id="toast-success"
            class="fixed top-5 right-5 z-50 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm dark:text-gray-400 dark:bg-gray-800"
            role="alert">

            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>

            <div class="ms-3 text-sm font-normal"><?= htmlspecialchars($_GET['mensagem']) ?></div>

            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg 
                   focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex 
                   items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white 
                   dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-success"
                aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    <?php endif ?>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script>
        document.querySelectorAll(".form-aluno").forEach(form => {
            form.addEventListener("submit", function(e) {
                const nome = form.querySelector(".input-nome").value.trim();
                const cpf = form.querySelector(".input-cpf").value.trim();
                const email = form.querySelector(".input-email").value.trim();
                const senha = form.querySelector(".input-senha") ? form.querySelector(".input-senha").value.trim() : '';

                const erroNome = form.querySelector(".erro-nome");
                const erroCpf = form.querySelector(".erro-cpf");
                const erroEmail = form.querySelector(".erro-email");
                const erroSenha = form.querySelector(".erro-senha");

                const regexSenha = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?':{}|<>_\-]).{8,}$/;
                const regexNome = /^[A-Za-zÀ-ÿ\s]{3,}$/;
                const regexCpf = /^\d{3}\.?\d{3}\.?\d{3}-?\d{2}$/;
                const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                let valido = true;

                if (erroNome && !regexNome.test(nome)) {
                    erroNome.textContent = "O nome deve conter pelo menos 3 letras.";
                    erroNome.classList.remove("hidden");
                    valido = false;
                } else if (erroNome) {
                    erroNome.classList.add("hidden");
                }

                if (erroCpf && !regexCpf.test(cpf)) {
                    erroCpf.textContent = "Digite um CPF válido (ex: 123.456.789-09).";
                    erroCpf.classList.remove("hidden");
                    valido = false;
                } else if (erroCpf) {
                    erroCpf.classList.add("hidden");
                }

                if (erroEmail && !regexEmail.test(email)) {
                    erroEmail.textContent = "Digite um e-mail válido.";
                    erroEmail.classList.remove("hidden");
                    valido = false;
                } else if (erroEmail) {
                    erroEmail.classList.add("hidden");
                }

                // CORREÇÃO: Valida a senha SOMENTE se o campo não estiver vazio.
                if (erroSenha) { // Garante que o elemento erroSenha existe no formulário
                    if (senha.length > 0) {
                        if (!regexSenha.test(senha)) {
                            erroSenha.textContent = "A senha deve ter 8+ caracteres, incluindo letra maiúscula, minúscula, número e símbolo.";
                            erroSenha.classList.remove("hidden");
                            valido = false;
                        } else {
                            erroSenha.classList.add("hidden");
                        }
                    } else {
                        // Se a senha estiver vazia, ela é válida para o formulário de EDIÇÃO.
                        erroSenha.classList.add("hidden");
                    }
                }

                if (!valido) e.preventDefault();
            });
        });


        document.addEventListener('DOMContentLoaded', () => {
            const openModal = (modalId) => {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.setAttribute('aria-hidden', 'false');
                }
            };

            const closeModal = (modalId) => {
                const modal = document.querySelector(modalId);
                if (modal) {
                    modal.classList.add('hidden');
                    modal.setAttribute('aria-hidden', 'true');
                }
            };

            document.querySelectorAll('[data-close-modal]').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const modalId = e.currentTarget.dataset.closeModal;
                    closeModal(modalId);
                });
            });


            const editButtons = document.querySelectorAll('[data-modal-target="updateAlunoModal"]');
            const form = document.getElementById('updateAlunoForm');

            if (!form) return;

            editButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    const btn = e.currentTarget;

                    const id = btn.dataset.id_aluno;
                    const nome = btn.dataset.nome_aluno;
                    const dataNascimento = btn.dataset.data_nascimento;
                    const email = btn.dataset.email;
                    const cpf = btn.dataset.cpf;

                    form.querySelector('[name="id_aluno"]').value = id || '';
                    form.querySelector('[name="nome"]').value = nome || '';
                    form.querySelector('[name="data_nascimento"]').value = dataNascimento || '';
                    form.querySelector('[name="cpf"]').value = cpf || '';
                    form.querySelector('[name="email"]').value = email || '';

                    openModal('updateAlunoModal');

                });
            });
        });
    </script>
</body>

</html>