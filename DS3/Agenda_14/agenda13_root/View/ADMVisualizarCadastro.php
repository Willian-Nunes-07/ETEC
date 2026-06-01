<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Visualizar Currículo</title>
    <style>
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

<body>
    <?php
    // Inicia sessão se não estiver ativa
    if (!isset($_SESSION)) {
        session_start();
    }

    // Verifica se o ID do usuário foi passado na sessão
    if (!isset($_SESSION['IDUsuario'])) {
        header("Location: ../index.php");
        exit;
    }

    $idUsuario = $_SESSION['IDUsuario'];

    // Carrega classes necessárias
    require_once '../Model/Usuario.php';
    require_once '../Controller/FormacaoAcadController.php';
    require_once '../Controller/ExperienciaProfissionalController.php';
    require_once '../Controller/OutrasFormacoesController.php';

    // Tenta carregar os dados do usuário pelo ID
    $u = new Usuario();
    $sucesso = $u->carregarUsuarioID($idUsuario);

    if (!$sucesso) {
        echo "<div class='w3-container w3-center w3-padding-32'>";
        echo "<h2 class='w3-text-red'>Usuário não encontrado.</h2>";
        echo "<a href='/Controller/Navegacao.php' class='w3-button w3-blue'>Voltar</a>";
        echo "</div>";
        exit;
    }
    ?>

    <!-- Cabeçalho -->
    <header class="w3-container w3-padding-32 w3-center w3-cyan">
        <h1 class="w3-text-white"><?php echo htmlspecialchars($u->getNome()); ?> - Currículo</h1>
    </header>

    <!-- Dados Pessoais -->
    <div class="w3-padding-128 w3-content w3-text-grey">
        <div class="w3-container w3-card w3-white w3-padding-16">
            <h2 class="w3-text-cyan"><i class="fa fa-user"></i> Dados Pessoais</h2>
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($u->getNome()); ?></p>
            <p><strong>CPF:</strong> <?php echo htmlspecialchars($u->getCPF()); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($u->getEmail()); ?></p>
            <p><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars($u->getDataNascimento()); ?></p>
        </div>
    </div>

    <!-- Formação Acadêmica -->
    <div class="w3-padding-128 w3-content w3-text-grey">
        <div class="w3-container w3-card w3-white w3-padding-16">
            <h2 class="w3-text-cyan"><i class="fa fa-mortar-board"></i> Formação Acadêmica</h2>
            <div class="w3-responsive">
                <table class="w3-table-all w3-centered">
                    <thead>
                        <tr class="w3-center w3-cyan">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $fCon = new FormacaoAcadController();
                        $results = $fCon->gerarLista($idUsuario);

                        if ($results && $results->num_rows > 0) {
                            while ($row = $results->fetch_object()) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row->inicio) . '</td>';
                                echo '<td>' . htmlspecialchars($row->fim) . '</td>';
                                echo '<td>' . htmlspecialchars($row->descricao) . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="3" class="w3-center">Nenhuma formação registrada.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Experiência Profissional -->
    <div class="w3-padding-128 w3-content w3-text-grey">
        <div class="w3-container w3-card w3-white w3-padding-16">
            <h2 class="w3-text-cyan"><i class="fa fa-briefcase"></i> Experiência Profissional</h2>
            <div class="w3-responsive">
                <table class="w3-table-all w3-centered">
                    <thead>
                        <tr class="w3-center w3-cyan">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Empresa</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ePro = new ExperienciaProfissionalController();
                        $results = $ePro->gerarLista($idUsuario);

                        if ($results && $results->num_rows > 0) {
                            while ($row = $results->fetch_object()) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row->inicio) . '</td>';
                                echo '<td>' . htmlspecialchars($row->fim) . '</td>';
                                echo '<td>' . htmlspecialchars($row->empresa) . '</td>';
                                echo '<td>' . htmlspecialchars($row->descricao) . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="4" class="w3-center">Nenhuma experiência registrada.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Outras Formações -->
    <div class="w3-padding-128 w3-content w3-text-grey">
        <div class="w3-container w3-card w3-white w3-padding-16">
            <h2 class="w3-text-cyan"><i class="fa fa-graduation-cap"></i> Outras Formações</h2>
            <div class="w3-responsive">
                <table class="w3-table-all w3-centered">
                    <thead>
                        <tr class="w3-center w3-cyan">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ofCon = new OutrasFormacoesController();
                        $results = $ofCon->gerarLista($idUsuario);

                        if ($results && $results->num_rows > 0) {
                            while ($row = $results->fetch_object()) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row->inicio) . '</td>';
                                echo '<td>' . htmlspecialchars($row->fim) . '</td>';
                                echo '<td>' . htmlspecialchars($row->descricao) . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="3" class="w3-center">Nenhuma outra formação registrada.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Botões de Ação -->
    <div class="w3-padding-128 w3-content w3-text-grey">
        <div class="w3-container w3-center">
            <form action="/agenda13_root/Controller/Navegacao.php" method="post" class="w3-margin">
                <button name="btnVoltarLista" class="w3-button w3-blue w3-round-large w3-margin">
                    <i class="fa fa-arrow-left"></i> Voltar para Lista
                </button>
            </form>

            <button onclick="window.print()" class="w3-button w3-teal w3-round-large w3-margin">
                <i class="fa fa-print"></i> Imprimir Currículo
            </button>
        </div>
    </div>

</body>

</html>