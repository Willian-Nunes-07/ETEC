<?php
if (!isset($_SESSION)) {
    session_start();
}

class ExperienciaProfissionalController
{

    public function inserir($inicio, $fim, $empresa, $descricao, $idusuario)
    {
        require_once '../Model/ExperienciaProfissional.php';
        $exp = new ExperienciaProfissional();
        $exp->setInicio($inicio);
        $exp->setFim($fim);
        $exp->setEmpresa($empresa);
        $exp->setDescricao($descricao);
        $exp->setIdUsuario($idusuario);
        return $exp->inserirBD();
    }

    public function remover($id)
    {
        require_once '../Model/ExperienciaProfissional.php';
        $exp = new ExperienciaProfissional();
        return $exp->excluirBD($id);
    }

    public function gerarLista($idusuario)
    {
        require_once '../Model/ExperienciaProfissional.php';
        $exp = new ExperienciaProfissional();
        return $exp->listaExperiencias($idusuario);
    }
}
?>