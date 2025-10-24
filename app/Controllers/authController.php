<?php

namespace App\Controllers;

use App\Model\Autenticacao;
use App\Security\CSRF;

class authController
{
    public function index()
    {
        return view(view: 'login');
    }
    public function login()
    {
        if (!isset($_POST['csrf_token']) || !CSRF::validateToken($_POST['csrf_token'])) {
            $mensagem = "CSRF Token inválido!";
            header('Location: /?error=' . urlencode($mensagem));
            exit;
        }

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $senha = trim($_POST['senha']);

        if (empty($email) && empty($senha)) {
            $mensagem = "Informe o email e senha.";
            header('Location: /?mensagem=' . urlencode($mensagem));
            exit;
        }
        if (empty($email)) {
            $mensagem = "Informe o email.";
            header('Location: /?mensagem=' . urlencode($mensagem));
            exit;
        }
        if (empty($senha)) {
            $mensagem = "Informe a senha.";
            header('Location: /?mensagem=' . urlencode($mensagem));
            exit;
        }

        $auth = Autenticacao::login(email: $email, senhaDigitada: $senha);

        header('Location: /dashboard');
    }
    public function sair()
    {
        Autenticacao::sair();
    }
}
