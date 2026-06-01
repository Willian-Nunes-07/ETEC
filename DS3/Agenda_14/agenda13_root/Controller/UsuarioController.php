<?php
if (!isset($_SESSION)) {
    session_start();
}

class UsuarioController
{

    public function inserir($nome, $cpf, $email, $senha)
    {
        require_once '../Model/Usuario.php';
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setCPF($cpf);
        $usuario->setEmail($email);
        $usuario->setSenha($senha); // Nota: Se usar hash, faça no Controller ou Model
        $r = $usuario->inserirBD();

        if ($r) {
            $_SESSION['Usuario'] = serialize($usuario);
        }
        return $r;
    }

    public function atualizar($id, $nome, $cpf, $email, $dataNascimento)
    {
        require_once '../Model/Usuario.php';
        $usuario = new Usuario();
        $usuario->setId($id);
        $usuario->setNome($nome);
        $usuario->setCPF($cpf);
        $usuario->setEmail($email);
        $usuario->setDataNascimento($dataNascimento);
        $r = $usuario->atualizarBD();

        if ($r) {
            $_SESSION['Usuario'] = serialize($usuario);
        }
        return $r;
    }

    public function login($cpf, $senha)
    {
        require_once '../Model/Usuario.php';
        $usuario = new Usuario();
        // Carrega pelo CPF
        if ($usuario->carregarUsuario($cpf)) {
            // Verifica senha (se for hash, use password_verify)
            if ($senha == $usuario->getSenha()) {
                $_SESSION['Usuario'] = serialize($usuario);
                return true;
            }
        }
        return false;
    }

    public function gerarLista()
    {
        require_once '../Model/Usuario.php';
        $usuario = new Usuario();
        return $usuario->listaCadastrados();
    }
}
?>