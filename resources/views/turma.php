<?php

use App\Security\CSRF;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>FIAP - Turmas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-50 dark:bg-gray-900">

    <?php include 'sidebar.php'; ?>

    <section class=" bg-gray-50 h-100 dark:bg-gray-900 p-4 mt-14 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <!-- Cabeçalho -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-5">
                    <div class="md:ml-5 mt-2 md:mt-6 text-center md:text-left">
                        <h1 class="font-extrabold text-2xl md:text-4xl leading-tight tracking-tight text-gray-900 dark:text-white">
                            Controle de Turmas
                        </h1>
                        <h6 class="text-gray-700 dark:text-gray-300 mt-1 text-sm md:text-base">
                            Cadastre novas turmas, edite turmas existentes e vincule alunos em turmas
                        </h6>
                    </div>

                    <div class="mt-4 md:mt-0 md:mr-5 flex justify-center md:justify-end w-full md:w-auto">
                        <button
                            id="defaultModalButton"
                            data-modal-target="defaultModal"
                            data-modal-toggle="defaultModal"
                            type="button"
                            class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors">
                            <svg
                                class="w-4 h-4 mr-2"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Adicionar Turma
                        </button>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row items-center md:space-x-4 space-y-3 md:space-y-0 p-4 w-full">
                    <form name="params" method="GET" class="w-full flex flex-col sm:flex-row gap-3">
                        <!-- Campo de busca -->
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
                                placeholder="Buscar turma..."
                                required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
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
                        href="/turmas"
                        class="flex items-center justify-center whitespace-nowrap text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors w-full md:w-auto">
                        Limpar Filtros
                    </a>
                </div>


                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Turma</th>
                                <th scope="col" class="px-4 py-3">Nome</th>
                                <th scope="col" class="px-4 py-3">Descrição</th>
                                <th scope="col" class="px-4 py-3">Total de Alunos</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($turmas as $turma): ?>
                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= htmlspecialchars($turma['id_turma'] ?? "Sem informação") ?></th>
                                    <td class="px-4 py-3"><?= htmlspecialchars($turma['nome'] ?? "Sem informação") ?></td>
                                    <td class="px-4 py-3"><?= htmlspecialchars($turma['descricao'] ?? "Sem informação") ?></td>
                                    <td class="px-4 py-3"><?= htmlspecialchars($turma['total_alunos'] ?? "Sem informação") ?></td>
                                    <td class="px-4 py-3 text-right">
                                        <!-- Container para o botão + dropdown -->
                                        <div class="relative inline-block text-left">
                                            <!-- Botão -->
                                            <button
                                                id="menu-dropdown-button-<?= htmlspecialchars($turma['id_turma'] ?? 'Sem informação') ?>"
                                                data-dropdown-toggle="menu-dropdown-<?= htmlspecialchars($turma['id_turma'] ?? 'Sem informação') ?>"
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

                                            <!-- Dropdown -->
                                            <div
                                                id="menu-dropdown-<?= htmlspecialchars($turma['id_turma'] ?? 'Sem informação') ?>"
                                                class="hidden absolute right-0 mt-2 z-10 min-w-[180px] bg-white rounded-lg shadow-lg divide-y divide-gray-100 dark:bg-gray-700 dark:divide-gray-600">
                                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                                                    <li>
                                                        <a
                                                            href="/turma/<?= htmlspecialchars($turma['id_turma'] ?? 'Sem informação') ?>"
                                                            class="block w-full py-2 px-4 text-left hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Ver alunos
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <button
                                                            data-modal-target="updateModalTurma"
                                                            data-modal-toggle="updateModalTurma"
                                                            data-id_turma="<?= htmlspecialchars($turma['id_turma'] ?? 'Sem informação') ?>"
                                                            data-nome_turma="<?= htmlspecialchars($turma['nome'] ?? 'Sem informação') ?>"
                                                            data-descricao_turma="<?= htmlspecialchars($turma['descricao'] ?? 'Sem informação') ?>"
                                                            class="w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Editar Turma
                                                        </button>
                                                    </li>

                                                    <li>
                                                        <button
                                                            data-modal-target="matriculaModal"
                                                            data-modal-toggle="matriculaModal"
                                                            data-id_turma_matricula="<?= htmlspecialchars($turma['id_turma'] ?? 'Sem informação') ?>"
                                                            class="w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            Matricular aluno
                                                        </button>
                                                    </li>
                                                </ul>

                                                <div class="py-1">
                                                    <form action="/turmas" method="POST">
                                                        <?= CSRF::field() ?>
                                                        <input
                                                            type="hidden"
                                                            name="id_turma"
                                                            value="<?= htmlspecialchars($turma['id_turma'] ?? 'Sem informação') ?>" />
                                                        <input type="hidden" name="_method" value="DELETE" />
                                                        <button
                                                            type="submit"
                                                            class="w-full text-left block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
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
                <div class="flex justify-center p-3">
                    <!-- Navegação -->
                    <nav aria-label="Page navigation example">
                        <?php $paginaAtual = isset($_GET['page']) ? (int)$_GET['page'] : 1; ?>
                        <ul class="flex items-center -space-x-px h-10 text-base">
                            <?php for ($i = 0; $i < $paginas; $i++): ?>
                                <?php
                                $numeroPagina = $i + 1;
                                $isAtiva = ($numeroPagina == $paginaAtual);
                                ?>
                                <li>
                                    <a href="?page=<?= $numeroPagina ?>"
                                        class="flex items-center justify-center px-4 h-10 leading-tight 
                                        <?php if ($isAtiva): ?>
                                            <!-- Classes para página ativa -->
                                            text-blue-600 bg-blue-50 border border-blue-300 
                                            hover:bg-blue-100 hover:text-blue-700 
                                            dark:border-gray-700 dark:bg-gray-700 dark:text-white
                                        <?php else: ?>
                                            <!-- Classes para páginas inativas -->
                                            text-gray-500 bg-white border border-gray-300 
                                            hover:bg-gray-100 hover:text-gray-700 
                                            dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 
                                            dark:hover:bg-gray-700 dark:hover:text-white
                                        <?php endif; ?>">
                                        <?= $numeroPagina ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal de Adição Turma -->
    <div id="defaultModal" data-modal-backdrop="static" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Adicionar Turma
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="/turmas" method="POST">
                    <?= CSRF::field() ?>
                    <div class="grid gap-4 mb-4 sm:grid-cols-1">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome da Turma</label>
                            <input type="text" name="nome_turma" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                        </div>
                        <div>
                            <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição da turma</label>
                            <textarea type="text" name="descricao_turma" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required=""></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                </svg>
                                Adicionar turma
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal de matricula do Aluno -->
    <div id="matriculaModal" data-modal-backdrop="static" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Selecione um aluno
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="matriculaModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="/matricula" method="POST">
                    <div class="grid gap-4 mb-4 sm:grid-cols-1">
                        <?= CSRF::field() ?>
                        <input type="hidden" name="id_turma_matricula" value="">
                        <div>
                            <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Aluno</label>
                            <select name="id_aluno" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required>
                                <option disabled selected> Selecione um aluno... </option>
                                <?php foreach ($alunos as $aluno): ?>
                                    <option value=<?= htmlspecialchars($aluno['id_aluno'] ?? "Sem informação") ?>>
                                        <?= htmlspecialchars($aluno['nome'] ?? "Sem informação") ?> </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="  flex justify-end w-100">

                            <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                </svg>
                                Registrar matricula
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal de Edição -->
    <div id="updateModalTurma" data-modal-backdrop="static" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Atualizar turma
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateModalTurma">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="/turmas" method="POST">
                    <div class="grid gap-4 mb-4 sm:grid-cols-1">
                        <?= CSRF::field() ?>
                        <input type="hidden" name="id_turma" value="">
                        <input type="hidden" name="_method" value="PATCH">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome da Turma</label>
                            <input type="text" name="nome_turma" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                        </div>
                        <div>
                            <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição da turma</label>
                            <textarea type="text" name="descricao_turma" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required=""></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Atualizar turma
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

            const matriculaButtons = document.querySelectorAll('[data-modal-target="matriculaModal"]');
            const matriculaForm = document.getElementById('matriculaModal');

            matriculaButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    const btn = e.currentTarget;
                    const id_turma_matricula = btn.dataset.id_turma_matricula;
                    matriculaForm.querySelector('[name="id_turma_matricula"]').value = id_turma_matricula || '';
                    openModal('matriculaModal');
                });
            });

            const editButtons = document.querySelectorAll('[data-modal-target="updateModalTurma"]');
            const form = document.getElementById('updateModalTurma');
            if (!form) return;
            editButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    const btn = e.currentTarget;

                    const id_turma = btn.dataset.id_turma;
                    const nome_turma = btn.dataset.nome_turma;
                    const descricao_turma = btn.dataset.descricao_turma;

                    form.querySelector('[name="id_turma"]').value = id_turma || '';
                    form.querySelector('[name="nome_turma"]').value = nome_turma || '';
                    form.querySelector('[name="descricao_turma"]').value = descricao_turma || '';


                    openModal('updateModalTurma');
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form[action="/turmas"]');
            const nomeTurmaInput = document.querySelector('input[name="nome_turma"]');
            const nomeTurmaContainer = nomeTurmaInput.parentElement;

            const errorMessage = document.createElement('small');
            errorMessage.className = 'text-red-600 dark:text-red-400 text-xs mt-1 hidden';
            errorMessage.textContent = 'O nome da turma deve ter no mínimo 3 caracteres';
            nomeTurmaContainer.appendChild(errorMessage);

            nomeTurmaInput.addEventListener('input', function() {
                if (this.value.length > 0 && this.value.length < 3) {
                    errorMessage.classList.remove('hidden');
                    this.classList.add('border-red-500');
                } else {
                    errorMessage.classList.add('hidden');
                    this.classList.remove('border-red-500');
                }
            });

            form.addEventListener('submit', function(e) {
                if (nomeTurmaInput.value.length < 3) {
                    e.preventDefault();
                    errorMessage.classList.remove('hidden');
                    nomeTurmaInput.classList.add('border-red-500');
                    nomeTurmaInput.focus();
                }
            });
        });
    </script>
</body>

</html>