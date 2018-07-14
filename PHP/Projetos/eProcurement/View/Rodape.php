<?php
include_once '../Controller/Session.php';

include_once '../Model/DAO.Class.php';
include_once '../Model/Usuario.Class.php';
include_once '../Controller/DAOUsuario.php';
include_once '../Model/Perfil.Class.php';
include_once '../Controller/DAOPerfil.php';
include_once '../Model/PerfilUsuario.Class.php';
include_once '../Controller/DAOPerfilUsuario.php';

$ObjUsuario = new Usuario();
$ObjPerfil = new Perfil();
$objPerfilUsuario = new PerfilUsuario();

$IDUsuario = $_SESSION['id'];

$ObjUsuario = BuscaUsuarioPorId($IDUsuario);
$objPerfilUsuario = buscaPerfilUsuarioPorIdUsuario($ObjUsuario->getID());
$ObjPerfil = buscaPerfilPorId($objPerfilUsuario->getIDPerfil());
?>

<!--  Dashboard JS includes -->



<span id="jqueryAdd"></span>
<script>
    window.jQuery || document.write("<script src='../Public/js/jquery.js'><\/script>");</script>


<script src="../Public/assets/toast/jquery.toast.js"></script> 
<script type="text/javascript">

<?php if ($Permissoes['PTV0024']['ACESSAR'] == 1 || $Permissoes['PTV0026']['ACESSAR'] == 1) { ?>


        
        var clientes = 0;
        var pedidos = 0;
        var infinity = function () {
            xhr = new XMLHttpRequest();
            xhr.open("GET", "../Controller/Pesquisas.php?Pesquisa=Sineta", true);
            xhr.onload = function (e) {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var total = 0;
                        response = JSON.parse(xhr.responseText);
                        pedidos = parseInt(response.pedidos) || 0;
                        financeiro = parseInt(response.financeiro) || 0;
                        clientes = parseInt(response.clientes) || 0;
    <?php if ($Permissoes['PTV0024']['ACESSAR'] == 1 && $Permissoes['PTV0026']['ACESSAR'] == 1) { ?>
                            total += pedidos + clientes + financeiro;
                            document.getElementById('SinetaPedidosValue').textContent = pedidos;
                            document.getElementById('SinetaPedidosFinanceiroValue').textContent = financeiro;
                            document.getElementById('SinetaClientesValue').textContent = clientes;
    <?php } else if ($Permissoes['PTV0026']['ACESSAR'] == 1) { ?>
                            total += clientes;
                            document.getElementById('SinetaClientesValue').textContent = clientes;
    <?php } else if ($Permissoes['PTV0024']['ACESSAR'] == 1) { ?>
                            total += pedidos;
                            document.getElementById('SinetaPedidosValue').textContent = pedidos;

    <?php } ?>
    <?PHP if ($ObjPerfil->getAprovaFinanceiro() == 1) { ?>
          total += financeiro;
                            document.getElementById('SinetaPedidosFinanceiroValue').textContent = financeiro;
    <?PHP } ?>
                        document.getElementById('SinetaGeral').textContent = total;
                    }
                }
            };
            xhr.onerror = function (e) {
                console.error(xhr.statusText);
            };
            xhr.send();
            setTimeout(infinity, 5000);
        };
        infinity();
<?php } ?>
</script>
<script type="text/javascript" >
    function notifyMe(titulo, corpo, icon) {
        $(function () {
            $.toast({
                heading: titulo,
                text: corpo,
                position: 'bottom-right',
                icon: icon,
                showHideTransition: 'slide',
                hideAfter: false
            });
        });
    }

    var infinityNotify = function () {
        xhr = new XMLHttpRequest();
        xhr.open("GET", "../Controller/API.php?function=BuscarNotificacoes&programa=<?php echo $_SESSION['idProgramaAtual']; ?>", true);
        xhr.onload = function (e) {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    response = JSON.parse(xhr.responseText);
                    response.forEach(function (notify) {
                        //Disparar Notificação
                        if (notify.NOT_VALOR == null || notify.NOT_VALOR == '') {
                            notify.NOT_VALOR = 'success';
                        }
                        notifyMe(notify.NOT_TITULO, notify.NOT_DESCRICAO, notify.NOT_VALOR);
                        //Marcar como vizualizado
                        xhrInsert = new XMLHttpRequest();
                        xhrInsert.open("GET", "../Controller/API.php?function=VizualizarNotificacao&id=" + notify.NOT_ID, true);
                        xhrInsert.send();
                    });
                }
            }
        };
        xhr.onerror = function (e) {
            console.error(xhr.statusText);
        };
        xhr.send();
        setTimeout(infinityNotify, 3000);
    };
    //infinityNotify();


    // Browser Indentify Start
    var browser = "";

    var isIE = false || !!document.documentMode;
    var matches = {
        Opera: (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0,
        Firefox: typeof InstallTrigger !== 'undefined',
        Safari: /constructor/i.test(window.HTMLElement) || (function (p) {
            return p.toString() === "[object SafariRemoteNotification]";
        })(!window['safari'] || safari.pushNotification),
        InternetExplorer: false || !!document.documentMode,
        Edge: !isIE && !!window.StyleMedia,
        Chrome: !!window.chrome && !!window.chrome.webstore
    };

    Object.keys(matches).forEach(function (key) {
        if (matches[key] == true && key != 'Chrome') {
            $("#primaryHeader").before("<div style='background-color: red; color: white; font-size: 16px; text-align: center;'>Atenção: O navegador " + key + " é incompatível com sistema. Utilize Google Chrome.</div>");
        }
    });
    // Browser Indentify End

</script>




<footer class="site-footer">
    <div class="text-center">
        <a target="_BLANK" style="color: white;" href="http://www.forgesolucoes.com.br"><img src="../Public/img/forge.png" width="90px" height="100px"/></a><br/>
        Tel: (47) 3278-9505 | R. Lauro Schroeder, 110 - Aventureiro | Joinville (SC) 
        <a href="#" class="go-top">
            <i class="fa fa-angle-up"></i>
        </a>
        <p style="color: white; font-weight: 500; opacity: 0.75;"  onmouseover="this.style.opacity = 1;" onmouseout="this.style.opacity = 0.75;" >
            <a href="https://www.google.com/chrome/browser/desktop/index.html" target="_blank">
                <span style="font-weight: 600; margin-left: 10px; color: #ffffff;">
                    Utilize somente com Google Chrome
                </span>
            </a>
        </p>
    </div>
</footer>