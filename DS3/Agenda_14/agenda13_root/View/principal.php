<?php
include_once '../Model/Usuario.php';
include_once '../Controller/FormacaoAcadController.php';
include_once '../Controller/ExperienciaProfissionalController.php';
include_once '../Controller/OutrasFormacoesController.php';

if (!isset($_SESSION)) {
    session_start();
}
// Verifica se usuário está logado
if (!isset($_SESSION['Usuario'])) {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Currículos</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .w3-sidebar {
            width: 120px;
        }

        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Montserrat", sans-serif;
        }
    </style>
</head>

<body class="w3-light-grey">

    <!-- Sidebar -->
    <nav class="w3-sidebar w3-bar-block w3-center w3-blue">
        <a href="#home" class="w3-bar-item w3-button w3-block"><i class="fa fa-home w3-xxlarge"></i>
            <p>HOME</p>
        </a>
        <a href="#dPessoais" class="w3-bar-item w3-button w3-block"><i class="fa fa-address-book-o w3-xxlarge"></i>
            <p>Dados Pessoais</p>
        </a>
        <a href="#formacao" class="w3-bar-item w3-button w3-block"><i class="fa fa-mortar-board w3-xxlarge"></i>
            <p>Formação</p>
        </a>
        <a href="#eProfissional" class="w3-bar-item w3-button w3-block"><i class="fa fa-user w3-xxlarge"></i>
            <p>Exp. Profissional</p>
        </a>
        <a href="#outrasFormacoes" class="w3-bar-item w3-button w3-block"><i class="fa fa-folder w3-xxlarge"></i>
            <p>Outras Formações</p>
        </a>
    </nav>

    <div class="w3-padding-large" id="main">
        <!-- Home -->
        <header class="w3-container w3-padding-32 w3-center" id="home">
            <h1 class="w3-text-cyan">SISTEMA DE CURRICULOS</h1>
            
            <img 
        src="../Img/enlatados.png" 
        alt="Logo Enlatados" 
        class="w3-margin-top"
        style="max-width: 800px; width: 100%; height: auto; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);"
    >
        </header>

        <!-- Dados Pessoais -->
        <div class="w3-padding-128 w3-content w3-text-grey" id="dPessoais">
            <h2 class="w3-text-cyan">Dados Pessoais</h2>
            <form action="/agenda13_root/Controller/Navegacao.php" method="post"
                class="w3-row w3-light-grey w3-text-blue w3-margin" style="width:70%;">
                <input class="w3-input w3-border w3-round-large" name="txtID" type="hidden"
                    value="<?php echo unserialize($_SESSION['Usuario'])->getID(); ?>">
                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:11%"><i class="w3-xxlarge fa fa-user"></i></div>
                    <div class="w3-rest"><input class="w3-input w3-border w3-round-large" name="txtNome" type="text"
                            value="<?php echo unserialize($_SESSION['Usuario'])->getNome(); ?>"></div>
                </div>
                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:11%"><i class="w3-xxlarge fa fa-drivers-license"></i></div>
                    <div class="w3-rest"><input class="w3-input w3-border w3-round-large" name="txtCPF" type="text"
                            value="<?php echo unserialize($_SESSION['Usuario'])->getCPF(); ?>"></div>
                </div>
                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:11%"><i class="w3-xxlarge fa fa-calendar"></i></div>
                    <div class="w3-rest"><input class="w3-input w3-border w3-round-large" name="txtData" type="date"
                            value="<?php echo unserialize($_SESSION['Usuario'])->getDataNascimento(); ?>"></div>
                </div>
                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:11%"><i class="w3-xxlarge fa fa-envelope-o"></i></div>
                    <div class="w3-rest"><input class="w3-input w3-border w3-round-large" name="txtEmail" type="email"
                            value="<?php echo unserialize($_SESSION['Usuario'])->getEmail(); ?>"></div>
                </div>
                <div class="w3-row w3-section">
                    <div class="w3-center"><button name="btnAtualizar"
                            class="w3-button w3-block w3-blue w3-cell w3-round-large"
                            style="width: 30%;">Atualizar</button></div>
                </div>
            </form>
        </div>

        <!-- Formação Acadêmica -->
        <div class="w3-padding-128 w3-content w3-text-grey" id="formacao">
            <h2 class="w3-text-cyan">Formação</h2>
            <form action="/agenda13_root/Controller/Navegacao.php" method="post"
                class="w3-row w3-light-grey w3-text-blue w3-margin" style="width:70%;">
                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:45%"><input class="w3-input w3-border w3-round-large"
                            name="txtInicioFA" type="date" placeholder="Início"></div>
                    <div class="w3-col" style="width:45%"><input class="w3-input w3-border w3-round-large"
                            name="txtFimFA" type="date" placeholder="Fim"></div>
                </div>
                <div class="w3-row w3-section">
                    <div class="w3-rest"><input class="w3-input w3-border w3-round-large" name="txtDescFA" type="text"
                            placeholder="Descrição"></div>
                </div>
                <div class="w3-row w3-section">
                    <div class="w3-center"><button name="btnAddFormacao"
                            class="w3-button w3-block w3-blue w3-cell w3-round-large" style="width: 20%;">+</button>
                    </div>
                </div>
            </form>
            <div class="w3-container">
                <table class="w3-table-all w3-centered">
                    <thead>
                        <tr class="w3-center w3-blue">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Descrição</th>
                            <th>Apagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $fCon = new FormacaoAcadController();
                        $results = $fCon->gerarLista(unserialize($_SESSION['Usuario'])->getID());
                        if ($results != null)
                            while ($row = $results->fetch_object()) {
                                echo '<tr><td>' . $row->inicio . '</td><td>' . $row->fim . '</td><td>' . $row->descricao . '</td><td>
                        <form action="/agenda13_root/Controller/Navegacao.php" method="post"><input type="hidden" name="id" value="' . $row->idformAcademica . '"><button name="btnExcluirFA" class="w3-button w3-red w3-round-large">X</button></form></td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Experiência Profissional -->
        <div class="w3-padding-128 w3-content w3-text-grey" id="eProfissional">
            <h2 class="w3-text-cyan">Experiência Profissional</h2>
            <form action="/agenda13_root/Controller/Navegacao.php" method="post"
                class="w3-row w3-light-grey w3-text-blue w3-margin" style="width:70%;">
                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:45%"><input class="w3-input w3-border w3-round-large"
                            name="txtInicioEP" type="date" placeholder="Início"></div>
                    <div class="w3-col" style="width:45%"><input class="w3-input w3-border w3-round-large"
                            name="txtFimEP" type="date" placeholder="Fim"></div>
                </div>
                <div class="w3-row w3-section">
                    <div class="w3-rest"><input class="w3-input w3-border w3-round-large" name="txtEmpEP" type="text"
                            placeholder="Empresa"></div>
                </div>
                <div class="w3-row w3-section">
                    <div class="w3-rest"><input class="w3-input w3-border w3-round-large" name="txtDescEP" type="text"
                            placeholder="Descrição"></div>
                </div>
                <div class="w3-row w3-section">
                    <div class="w3-center"><button name="btnAddEP"
                            class="w3-button w3-block w3-blue w3-cell w3-round-large" style="width: 20%;">+</button>
                    </div>
                </div>
            </form>
            <div class="w3-container">
                <table class="w3-table-all w3-centered">
                    <thead>
                        <tr class="w3-center w3-blue">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Empresa</th>
                            <th>Descrição</th>
                            <th>Apagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $epCon = new ExperienciaProfissionalController();
                        $results = $epCon->gerarLista(unserialize($_SESSION['Usuario'])->getID());
                        if ($results != null)
                            while ($row = $results->fetch_object()) {
                                echo '<tr><td>' . $row->inicio . '</td><td>' . $row->fim . '</td><td>' . $row->empresa . '</td><td>' . $row->descricao . '</td><td>
                        <form action="/agenda13_root/Controller/Navegacao.php" method="post"><input type="hidden" name="idEP" value="' . $row->idExpProfiss . '"><button name="btnExcluirEP" class="w3-button w3-red w3-round-large">X</button></form></td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Outras Formações -->
        <div class="w3-padding-128 w3-content w3-text-grey" id="outrasFormacoes">
            <h2 class="w3-text-cyan">Outras Formações</h2>
            <form action="/agenda13_root/Controller/Navegacao.php" method="post" class="w3-row w3-light-grey w3-text-blue w3-margin"
                style="width:70%;">
                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:45%"><input class="w3-input w3-border w3-round-large"
                            name="txtInicioOF" type="date" placeholder="Início"></div>
                    <div class="w3-col" style="width:45%"><input class="w3-input w3-border w3-round-large"
                            name="txtFimOF" type="date" placeholder="Fim"></div>
                </div>
                <div class="w3-row w3-section">
                    <div class="w3-rest"><input class="w3-input w3-border w3-round-large" name="txtDescOF" type="text"
                            placeholder="Descrição"></div>
                </div>
                <!-- BOTÃO DE ADICIONAR -->
                <div class="w3-row w3-section">
                    <div class="w3-center"><button name="btnAddOF"
                            class="w3-button w3-block w3-blue w3-cell w3-round-large" style="width: 20%;">+</button>
                    </div>
                </div>
            </form>

            <!-- Tabela de Exibição -->
            <div class="w3-container">
                <table class="w3-table-all w3-centered">
                    <thead>
                        <tr class="w3-center w3-blue">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Descrição</th>
                            <th>Apagar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ofCon = new OutrasFormacoesController();
                        $results = $ofCon->gerarLista(unserialize($_SESSION['Usuario'])->getID());
                        if ($results != null)
                            while ($row = $results->fetch_object()) {
                                // Verifique se a coluna do banco é 'idoutrasFormacoes' (conforme seu BD.sql)
                                echo '<tr><td>' . $row->inicio . '</td><td>' . $row->fim . '</td><td>' . $row->descricao . '</td><td>
                        <form action="/agenda13_root/Controller/Navegacao.php" method="post"><input type="hidden" name="id" value="' . $row->idoutrasFormacoes . '"><button name="btnExcluirOF" class="w3-button w3-red w3-round-large">X</button></form></td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>