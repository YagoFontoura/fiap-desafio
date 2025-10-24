<?php

use App\Security\CSRF;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>FIAP - Turma</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />


</head>

<body class="bg-gray-50 dark:bg-gray-900">

    <?php include 'sidebar.php'; ?>


    <section class=" bg-gray-50 h-100 dark:bg-gray-900 p-4 mt-14 sm:p-5">
        <div class="w-full max-w-screen-xl px-4 mb-3 mx-auto lg:px-12">
            <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                    <div>
                        <h5 class="mr-3 font-semibold dark:text-white">Turma - <?= htmlspecialchars($turma_lista[0]['nome_turma'] ?? "Sem informação")  ?> </h5>
                        <p class="text-gray-500 dark:text-gray-400"><?= htmlspecialchars($turma_lista[0]['descricao_turma'] ?? "Sem informação") ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
                <div>
                    <a href="/turmas" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button"> Voltar</a>
                </div>

                <label for="table-search" class="sr-only">Search</label>
                <div class="flex gap-3">
                    <div class="relative">
                        <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <form action="" class="flex flex-row gap-3" method="get">
                            <input type="text" name="params" id="table-search-users" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Procure por alunos">
                            <button type="submit" class="flex  items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                                Buscar
                            </button>
                        </form>
                    </div>
                    <a href="/turma/<?= htmlspecialchars($id_turma)  ?>" id="defaultModalButton" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button">
                        Limpar Filtros
                    </a>
                </div>
                <button

                    data-modal-target="matriculaModal"
                    data-modal-toggle="matriculaModal"
                    data-id_turma_matricula="<?= htmlspecialchars($turma['id_turma'] ?? 'Sem informação') ?>"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Matricular aluno
                </button>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6  py-3">
                            Matricula
                        </th>
                        <th scope="col" class="px-6  py-3">
                            Nome
                        </th>
                        <th scope="col" class="px-6  py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6  py-3">
                            Cpf
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Opções
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($turma_lista[0]['id_aluno']) && is_array($turma_lista)): ?>
                        <?php foreach ($turma_lista as $aluno): ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">
                                    <?= htmlspecialchars($aluno['id_matricula'] ?? "Sem informação") ?>
                                </td>
                                <td scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    <img class="w-10 h-10 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="Foto do aluno">
                                    <div class="ps-3">
                                        <div class="text-base font-semibold"><?= htmlspecialchars($aluno['nome_aluno'] ?? "Sem informação") ?></div>
                                        <div class="font-normal text-gray-500"><?= htmlspecialchars($aluno['email'] ?? "Sem informação") ?></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Online
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <?= htmlspecialchars($aluno['cpf'] ?? "Sem informação") ?>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="/matricula" method="POST">
                                        <?= CSRF::field() ?>
                                        <input type="hidden" name="id_matricula" value=<?= htmlspecialchars($aluno['id_matricula'] ?? "Sem informação") ?>>
                                        <input type="hidden" name="id_turma" value=<?= htmlspecialchars($aluno['id_turma'] ?? "Sem informação") ?>>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Remover da turma</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">
                                Nenhum aluno matriculado nesta turma.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>

    </section>
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
                        <input type="hidden" name="id_turma_matricula" value="<?= htmlspecialchars($id_turma) ?>">
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

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>