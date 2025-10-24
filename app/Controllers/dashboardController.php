<?php

namespace App\Controllers;

use App\Core\Session;
use App\Model\Dashboard;

Session::iniciar();
if (!Session::Logado()) {
    header('Location: /');
    exit;
}

class dashboardController
{
    public function index()
    {
        $dash = new Dashboard();
        $result = $dash->index();
        return view(view: 'dashboard', data: ['turmas' => $result['turmas'], 'alunos' => $result['alunos']]);
    }
}
