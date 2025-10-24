<?php

namespace App\Model;

use Database\Connection;
use App\Core\Session;

class Autenticacao
{
    private static $pdo;

    public static function login($email, $senhaDigitada)
    {
        $resultado = self::validaSenha($email, $senhaDigitada);


        if ($resultado['valido'] == false) {
            $mensagem = "Email e/ou senha incorreta.";
            header('Location: /?mensagem=' . urlencode($mensagem));
            exit;
        }
        Session::iniciar();
        Session::set(key: 'usuario_id', value: $resultado['dados']['id_usuario']);
        Session::set(key: 'usuario_nome', value: $resultado['dados']['nome']);
        Session::set(key: 'usuario_email', value: $resultado['dados']['email']);
        Session::set(key: 'usuario_logado', value: true);

        session_write_close();
        return true;
    }
    public static function verificaEstarLogado(): void
    {
        Session::iniciar();
        if (!Session::Logado()) {
            header('Location: /');
            exit;
        }
    }

    private static function validaSenha($email, $senhaDigitada)
    {
        self::$pdo = Connection::getConnection();
        $stmt = self::$pdo->prepare(query: "SELECT * FROM administradores 
         WHERE email = :email");
        $stmt->execute(params: [
            'email' => $email,
        ]);

        $resultado = $stmt->fetch();
        if ($resultado && password_verify($senhaDigitada, $resultado['senha'])) {
            return [
                'valido' => true,
                'dados' => [
                    'id_usuario' => $resultado['id_usuario'],
                    'nome' => $resultado['nome'],
                    'email' => $resultado['email']
                ]
            ];
        }
        return ['valido' => false];
    }

    public static function sair()
    {
        Session::destroy();
        header('Location: /');
        exit;
    }
}
