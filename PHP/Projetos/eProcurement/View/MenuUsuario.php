<?php
include_once '../Model/Usuario.Class.php';
include_once '../Controller/DAOUsuario.php';

$objUsuario = new Usuario();
$objUsuario = BuscaUsuarioPorID($_REQUEST['id']);
?>
<aside class="profile-nav col-lg-3">
    <section class="panel">
        <div class="user-heading round">
            <a href="#">
                <?php
                if ($objUsuario->getImagem() != "" && !is_null($objUsuario->getImagem())) {
                    echo "<img src='../Public/img/Usuarios/{$objUsuario->getImagem()}' alt=''>";
                } else {
                    echo "<img src='../Public/img/Cliente/empresas.png' alt=''>";
                }
                ?>
            </a>
            <h1><?php echo $objUsuario->getNome(); ?></h1>
            <p><?php echo $objUsuario->getEmail(); ?></p>
        </div>
        <ul class="nav nav-pills nav-stacked">
            <li <?php echo (substr_count($_SERVER["SCRIPT_NAME"], 'View/Usuario.php') > 0) ? "class='active'" : ""; ?>><a href="Usuario.php?id=<?php echo $objUsuario->getID(); ?>&Acao=Atualizar"><i class="fa fa-list-alt"></i> Detalhes</a></li>
            <!--<li <?php echo (substr_count($_SERVER["SCRIPT_NAME"], 'TransportadoraUsuario') > 0) ? "class='active'" : ""; ?>><a href="TransportadoraUsuario.php?id=<?php echo $objUsuario->getID(); ?>"> <i class="fa fa-truck"></i>Transportadoras</a></li>
            <li <?php echo (substr_count($_SERVER["SCRIPT_NAME"], 'CondicaoPagamentoUsuario') > 0) ? "class='active'" : ""; ?>><a href="CondicaoPagamentoUsuario.php?id=<?php echo $objUsuario->getID(); ?>"> <i class="fa fa-money"></i>Condições de Pagamento</a></li>
            <li <?php echo (substr_count($_SERVER["SCRIPT_NAME"], 'NaturezaOperacaoUsuario') > 0) ? "class='active'" : ""; ?>><a href="NaturezaOperacaoUsuario.php?id=<?php echo $objUsuario->getID(); ?>"> <i class="fa fa-tag"></i>Naturezas de Operação</a></li>
            <li <?php echo (substr_count($_SERVER["SCRIPT_NAME"], 'ListaPrecoUsuario') > 0) ? "class='active'" : ""; ?>><a href="ListaPrecoUsuario.php?id=<?php echo $objUsuario->getID(); ?>"> <i class="fa fa-list-ol"></i>Listas de Preço</a></li>-->
            <li <?php echo (substr_count($_SERVER["SCRIPT_NAME"], 'PerfilUsuario') > 0) ? "class='active'" : ""; ?>><a href="PerfilUsuario.php?Acao=Atualizar&id=<?php echo $objUsuario->getID(); ?>"> <i class="fa fa fa-user"></i>Perfil</a></li>
            <li <?php echo (substr_count($_SERVER["SCRIPT_NAME"], 'ProgramaPorUsuario') > 0) ? "class='active'" : ""; ?>><a href="ProgramaPorUsuario.php?Acao=Atualizar&id=<?php echo $objUsuario->getID(); ?>"> <i class="fa fa fa-user"></i>Programas</a></li>
            <!-- 
            <li><a href="ParametrosUsuario.php?<?php //echo USUARIO_ID."=".$objUsuario->getID();  ?>"><i class="fa fa-check"></i> Parêmetros</a></li> 
            <li><a href="<?php //echo USUARIO_ID.IGUAL.$objUsuario->getID();  ?>"> <i class="fa fa-bar-chart-o"></i>Dashboards</a></li>
            -->
        </ul>
    </section>
</aside>
<aside class="profile-info col-lg-9">
