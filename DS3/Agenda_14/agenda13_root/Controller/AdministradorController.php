<?php
if (!isset($_SESSION)) {
    session_start();
}

class AdministradorController
{

    public function login($cpf, $senha)
    {
        require_once '../Model/Administrador.php';
        $adm = new Administrador();
        if ($adm->carregarAdministrador($cpf)) {
            if ($senha == $adm->getSenha()) {
                $_SESSION['Administrador'] = serialize($adm);
                return true;
            }
        }
        return false;
    }

    public function gerarLista()
    {
        require_once '../Model/Administrador.php';
        $adm = new Administrador();
        return $adm->listaCadastrados();
    }
}
?>