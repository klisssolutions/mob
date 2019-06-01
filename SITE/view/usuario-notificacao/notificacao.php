<?php

@session_start();
@$_SESSION["importInclude"] = $_SERVER["DOCUMENT_ROOT"] . "/Mobshare/include.php";
require_once($_SESSION["importInclude"]);

require_once(IMPORT_VSOLICITACAO_LOCACAO);
require_once(IMPORT_SOLICITACAO_LOCACAO);
require_once(IMPORT_SOLICITACAO_LOCACAO_DAO);
require_once(IMPORT_SOLICITACAO_LOCACAO_CONTROLLER);

require_once(IMPORT_CLIENTE);
require_once(IMPORT_CLIENTE_CONTROLLER);

$idCliente = $_SESSION['idCliente']['idCliente'];

$_GET['id'] = $idCliente;

$controllerCliente = new controllerCliente();
$clientes[] = new Cliente();
$clientes = $controllerCliente->buscarCliente();


$controllerSolicitacao_Locacao = new controllerSolicitacao_Locacao();

$solicitacao_locacoes = new Solicitacao_Locacao();
$vSolicitacoes_Locacao[] = new Solicitacao_Locacao();
$vSolicitacoes_Locacao = null;
$vSolicitacoes_Locacao = $controllerSolicitacao_Locacao->listarSolicitacaoLocacaoPorLocador();

$aceitar = "router('SOLICITACAO', 'ACEITAR', '".$solicitacao_locacoes->getIdSolicitacao_Locacao()."')";

$recusar = "router('SOLICITACAO', 'RECUSAR', '".$solicitacao_locacoes->getIdSolicitacao_Locacao()."')";



?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
    <script type="text/javascript" src="../js/link.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <meta http-equiv="Content-Type" content="view/text/html; charset=utf-8" />
    <link rel="shortcut icon" href="images/user.png" />
    <title>Painel do Usuário </title>
</head>
<body>
    <!-- HEADER DO MENU-->
    <?php require_once(HEADER);?>
    <!-- CAIXA QUE SEGURA O CONTEÚDO EMBAIXO DO MENU -->
    <div class="content">
        <div class="box-painel-usuario">
            <div class="menu-lateral-usuario">
                <div class="img-usuario-menu">
                <div class="imagem-usuario">
                        <img src="../../../arquivos/<?php echo ($clientes->getFotoPerfil());?>" width="180" height="180"  alt="Usuário">
                    </div>

                    <div class="nome-usuario-menu">
                        <h1><?php echo ($clientes->getNome());?></h1>
                    </div>
                </div>
                <!-- ITEM - MENU -->
                <a href="<?php echo utf8_encode(LINK_DASHBOARD_VISUALIZAR_PERFIL); ?>">
                <div class="nav-menu-usuario">
                    <h2> <img src="../images/black-male-user-symbol.png" width="28" height="28"  alt="Usuário">Meu perfil</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo utf8_encode(LINK_DASHBOARD_NOTIFICACAO); ?>">
                <div class="nav-menu-usuario-clicado">
                    <h2> <img src="../images/script.png" width="28" height="28"  alt="Usuário">Notificações</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo utf8_encode(LINK_DASHBOARD_VISUALIZAR_ENDERECO); ?>">
                <div class="nav-menu-usuario">
                    <h2> <img src="../images/coupon.png" width="28" height="28"  alt="Usuário">Meus endereços</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo utf8_encode(LINK_DASHBOARD_OPCAO_VEICULO); ?>">
                <div class="nav-menu-usuario">
                    <h2><img src="../images/car (1).png" width="28" height="28"  alt="Usuário">Meus veículos</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo utf8_encode(LINK_DASHBOARD_NOTIFICACAO); ?>">
                <div class="nav-menu-usuario">
                    <h2><img src="../images/tag.png" width="28" height="28"  alt="Usuário">Vendas</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo utf8_encode(LINK_DASHBOARD_HISTORICO_VEICULO); ?>">
                <div class="nav-menu-usuario">
                    <h2> <img src="../images/script.png" width="28" height="28"  alt="Usuário">Meus históricos</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo utf8_encode(LINK_DASHBOARD_CUPONS); ?>">
                <div class="nav-menu-usuario">
                    <h2> <img src="../images/coupon.png" width="28" height="28"  alt="Usuário">Cupons</h2>
                </div>
                </a>

                <div class="nav-menu-usuario-button">
                    <h3>Sair</h3>
                </div>
            </div>
            <div class="conteudo-usuario">
                <div class="titulo-lista">
                    <h1>Minhas Notificações:</h1>
                    <?php
                    if(!is_null($vSolicitacoes_Locacao)):
                        foreach($vSolicitacoes_Locacao as $vsolicitacao_locacao){

                        $data = new DateTime($vsolicitacao_locacao->getHorarioInicio());
                        $dataInicio = date_format($data, "d/m/Y H:i");
                        $data = new DateTime($vsolicitacao_locacao->getHorarioFim());
                        $dataFim = date_format($data, "d/m/Y H:i");

                    ?>
                    <form id="form" method="post" enctype="multipart/form-data">
                        <div class="notificacao">
                            <p> <?php echo utf8_encode($vsolicitacao_locacao->getNomeCliente());?> 
                            deseja alugar o seu <?php echo utf8_encode($vsolicitacao_locacao->getVeiculo());?>
                             no dia <?php echo utf8_encode($dataInicio);?> 
                             com fim no <?php echo utf8_encode($dataFim);?>.
                            </p>
                            <a href="http://www.mob.com.br/Mobshare/SITE/router.php?controller=SOLICITACAO&modo=ACEITAR&id=<?php echo utf8_encode($vsolicitacao_locacao->getIdSolicitacao_Locacao());?>">
                            <input type="button" value="aceitar" class="ipt-aceitar">
                            </a>
                            <a href="http://www.mob.com.br/Mobshare/SITE/router.php?controller=SOLICITACAO&modo=RECUSAR&id=<?php echo utf8_encode($vsolicitacao_locacao->getIdSolicitacao_Locacao());?>">
                            <input type="button" value="recusar" class="ipt-recusar">
                            </a>
                        </div>
                    </form>
                    <?php
                    }
                endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- RODAPÉ-->
    <?php require_once(FOOTER);?>

</body>

</html>