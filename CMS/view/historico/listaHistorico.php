<?php
    @session_start();
    require_once($_SESSION["importInclude"]); 

    require_once(IMPORT_V_DETALHES_LOCACAO);
    require_once(IMPORT_V_DETALHES_LOCACAO_CONTROLLER);

    $controllerV_detalhes_locacao = new controllerV_detalhes_locacao();
    $locacoes[] = new V_detalhes_locacao();
    $locacoes = $controllerV_detalhes_locacao->listarLocacoes();


?>


<div class="titulo-func-lista">GERENCIAMENTO DO HSTORICO DE LOCAÇÃO</div>

<?php

    foreach($locacoes as $locacao){

    

?>


<div class="listaDados2" onclick="historicoAbrir();">

    <div class="dados">
    
        ID Locação:
        
    </div>
    <div class="infoDados">
    
        <?php echo utf8_encode($locacao->getIdLocacao()) ?>
    
    </div>
    <div class="dados">
    
        Locador:
        
    </div>
    <div class="infoDados">
    
        <?php echo utf8_encode($locacao->getLocador()) ?>
    
    </div>

    <div class="dados">
    
        Locatario:
        
    </div>
    <div class="infoDados">
    
    <?php echo utf8_encode($locacao->getLocatario()) ?>
    
    </div>

    <div class="dados">
    
        Veiculo:
        
    </div>
    <div class="infoDados">
    
        <?php echo utf8_encode($locacao->getVeiculo()) ?>
    
    </div>
    
    
</div>

<?php

    }

    

?>

