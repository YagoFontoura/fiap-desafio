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

    <div class="min-h-screen bg-[#0b1120] flex flex-col items-center justify-center text-white">
        <h1 class="text-4xl font-bold mb-2">Secretaria FIAP</h1>
        <p class="text-gray-400 p-3 mb-10">Bem vindo ao dashboard de controle de turmas e alunos FIAP!</p>

        <div class="flex flex-col sm:flex-row gap-6">
            <!-- Número de Turmas -->
            <div class="bg-[#1a2235] rounded-md px-10 py-6 text-center shadow-lg">
                <p class="text-gray-400 text-sm mb-2">Número de Turmas</p>
                <p class="text-2xl font-bold"><?= htmlspecialchars($turmas) ?></p>
            </div>

            <!-- Vagas Abertas -->
            <div class="bg-[#1a2235] rounded-md px-10 py-6 text-center shadow-lg">
                <p class="text-gray-400 text-sm mb-2">Vagas Abertas</p>
                <p class="text-2xl font-bold">1000</p>
            </div>

            <!-- Alunos Cadastrados -->
            <div class="bg-[#1a2235] rounded-md px-10 py-6 text-center shadow-lg">
                <p class="text-gray-400 text-sm mb-2">Alunos Cadastrados</p>
                <p class="text-2xl font-bold"><?= htmlspecialchars($alunos) ?></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</body>

</html>