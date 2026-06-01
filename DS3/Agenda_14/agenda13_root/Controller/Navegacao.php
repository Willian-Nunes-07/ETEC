<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . '/../Model/Usuario.php';

// Verifica qual botão foi pressionado
if (isset($_POST["btnPrimeiroAcesso"])) {
    include_once "../View/primeiroAcesso.php";
} 
elseif (isset($_POST["btnCadastrar"])) {
    require_once "../Controller/UsuarioController.php";
    $uController = new UsuarioController();
    if ($uController->inserir($_POST["txtNome"], $_POST["txtCPF"], $_POST["txtEmail"], $_POST['txtSenha'])) {
        include_once "../View/cadastroRealizado.php";
    } else {
        include_once "../View/cadastroNaoRealizado.php";
    }
} 
elseif (isset($_POST["btnLogin"])) {
    require_once "../Controller/UsuarioController.php";
    $uController = new UsuarioController();
    if ($uController->login($_POST['txtLogin'], $_POST['txtSenha'])) {
        include_once "../View/principal.php";
    } else {
        include_once "../View/cadastroNaoRealizado.php";
    }
} 
elseif (isset($_POST["btnCadRealizado"]) || isset($_POST["btnInfInserir"]) || isset($_POST["btnInfExcluir"]) || isset($_POST["btnAtualizacaoCadastro"]) || isset($_POST["btnPrincipal"])) {
    include_once "../View/principal.php";
} 
elseif (isset($_POST["btnCadNRealizado"])) {
    include_once "../View/primeiroAcesso.php";
} 
elseif (isset($_POST["btnAtualizar"])) {
    require_once "../Controller/UsuarioController.php";
    $uController = new UsuarioController();
    if ($uController->atualizar(
        $_POST["txtID"],
        $_POST["txtNome"],
        $_POST["txtCPF"],
        $_POST["txtEmail"],
        date("Y-m-d", strtotime($_POST['txtData']))
    )) {
        include_once "../View/atualizacaoRealizada.php";
    } else {
        include_once "../View/operacaoNaoRealizada.php";
    }
} 
elseif (isset($_POST["btnAddFormacao"])) {
    require_once "../Controller/FormacaoAcadController.php";
    $fController = new FormacaoAcadController();
    if ($fController->inserir(
        date("Y-m-d", strtotime($_POST['txtInicioFA'])),
        date("Y-m-d", strtotime($_POST['txtFimFA'])),
        $_POST["txtDescFA"],
        unserialize($_SESSION['Usuario'])->getID()
    )) {
        include_once "../View/informacaoInserida.php";
    } else {
        include_once "../View/operacaoNaoRealizada.php";
    }
} 
elseif (isset($_POST["btnExcluirFA"])) {
    require_once "../Controller/FormacaoAcadController.php";
    $fController = new FormacaoAcadController();
    if ($fController->remover($_POST['id'])) {
        include_once "../View/informacaoExcluida.php";
    } else {
        include_once "../View/operacaoNaoRealizada.php";
    }
} 
elseif (isset($_POST["btnAddEP"])) {
    require_once "../Controller/ExperienciaProfissionalController.php";
    $epController = new ExperienciaProfissionalController();
    if ($epController->inserir(
        date("Y-m-d", strtotime($_POST['txtInicioEP'])),
        date("Y-m-d", strtotime($_POST['txtFimEP'])),
        $_POST["txtEmpEP"],
        $_POST["txtDescEP"],
        unserialize($_SESSION['Usuario'])->getID()
    )) {
        include_once "../View/informacaoInserida.php";
    } else {
        include_once "../View/operacaoNaoRealizada.php";
    }
} 
elseif (isset($_POST["btnExcluirEP"])) {
    require_once "../Controller/ExperienciaProfissionalController.php";
    $epController = new ExperienciaProfissionalController();
    if ($epController->remover($_POST['idEP'])) {
        include_once "../View/informacaoExcluida.php";
    } else {
        include_once "../View/operacaoNaoRealizada.php";
    }
} 
elseif (isset($_POST["btnAddOF"])) {
    require_once "../Controller/OutrasFormacoesController.php";
    $ofController = new OutrasFormacoesController();
    if ($ofController->inserir(
        date("Y-m-d", strtotime($_POST['txtInicioOF'])),
        date("Y-m-d", strtotime($_POST['txtFimOF'])),
        $_POST["txtDescOF"],
        unserialize($_SESSION['Usuario'])->getID()
    )) {
        include_once "../View/informacaoInserida.php";
    } else {
        include_once "../View/operacaoNaoRealizada.php";
    }
} 
elseif (isset($_POST["btnExcluirOF"])) {
    require_once "../Controller/OutrasFormacoesController.php";
    $ofController = new OutrasFormacoesController();
    if ($ofController->remover($_POST['id'])) {
        include_once "../View/informacaoExcluida.php";
    } else {
        include_once "../View/operacaoNaoRealizada.php";
    }
} 
elseif (isset($_POST["btnADM"])) {
    include_once "../View/ADMLogin.php";
} 
elseif (isset($_POST["btnLoginADM"])) {
    require_once "../Controller/AdministradorController.php";
    $aController = new AdministradorController();
    if ($aController->login($_POST['txtLoginADM'], $_POST['txtSenhaADM'])) {
        include_once "../View/ADMPrincipal.php";
    } else {
        include_once "../View/cadastroNaoRealizado.php";
    }
} 
elseif (isset($_POST["btnListarCadastrados"]) || isset($_POST["btnVoltarLista"])) {
    include_once "../View/ADMListarCadastrados.php";
} 
elseif (isset($_POST["btnListarAdministradores"])) {
    include_once "../View/ADMListarAdministradores.php";
} 
elseif (isset($_POST["btnVisualizar"])) {
    $_SESSION["IDUsuario"] = $_POST['id'];
    include_once "../View/ADMVisualizarCadastro.php";
} 
elseif (isset($_POST["btnVoltar"])) {
    include_once "../View/ADMPrincipal.php";
} 
else {
    // Se nenhum botão for detectado, mostra o login
    include_once __DIR__ . "\\..\\View\\login.php";
}
?>