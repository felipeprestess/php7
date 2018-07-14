
<?php
/**
 * Created by PhpStorm.
 * User: Felipe Prestes
 * Date: 28/05/2018
 * Time: 12:35
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="../Public/metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="../Public/metronic/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="../Public/metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../Public/metronic/theme/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="../Public/metronic/theme/assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
    <link href="../Public/metronic/theme/assets/admin/pages/css/login-soft.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="../Public/metronic/theme/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="../Public/metronic/theme/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="../Public/metronic/theme/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
    <link id="style_color" href="../Public/metronic/theme/assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
    <link href="../Public/metronic/theme/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<body>

<div class="login">
    <div class="logo">
        <a href="#">
            <img src="../Public/metronic/theme/assets/admin/layout/img/logo-invert.png">
        </a>
    </div>
    <div class="menu-toggler sidebar-toggler"></div>
    <div class="content">
        <form class="login-form" method="post" action="Index.php" novalidate="novalidate">
            <h3 class="form-title">Entre com seu Email</h3>
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>Entre com qualquer email e senha</span>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Senha</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Senha" name="senha" />
                </div>
            </div>
            <div class="form-actions">
                <label class="checkbox">
                    <div class="checker">
                        <span class>
                            <input type="checkbox" name="remember" value="" />
                        </span>
                    </div>
                    Lembrar-me?
                </label>
                <button type="submit" class="btn blue pull-right">
                    Entrar
                    <i class="m-icon-swapright m-icon-white"></i>
                </button>
            </div>
            <div class="login-options">
                <h4>Ou entre com</h4>
                <ul class="social-icons">
                    <li>
                        <a class="facebook" data-original-title="facebook"></a>
                    </li>
                </ul>
            </div>
            <div class="forget-password">
                <h4>Esqueceu sua senha?</h4>
                <p>Clique <a href="#">aqui</a> para resetar sua senha</p>
            </div>
            <div class="create-account">
                <p>Não criou sua conta ainda? <a href="" id="forget-password">Crie uma conta</a></p>
            </div>
        </form>
        <form class="forget-form" method="post" action="Index.php" novalidate="novalidate">
            <h3>Esqueceu a senha?</h3>
            <p>Digite seu email abaixo para resetar sua senha.</p>
            <div class="form-group">
                <div class="input-icon">
                    <i class="fa fa-envelope"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" />
                </div>
            </div>
            <div class="form-actions">
                <button type="button" id="back-btn" class="btn">
                    <i class="m-icon-swapleft"></i>
                    Voltar
                </button>
                <button type="submit" class="btn blue pull-right">
                    Enviar
                    <i class="m-icon-swarpright m-icon-white"></i>
                </button>
            </div>
        </form>
        <form class="register-form" method="post" action="Index.php" novalidate="novalidate">
            <h3>Registrar-se</h3>
            <p>Digite seus detalhes pessoais abaixo:</p>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Nome completo</label>
                <div class="input-icon">
                    <i class="fa fa-font"></i>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Nome completo" name="nomecompleto" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div class="input-icon">
                    <i class="fa fa-envelope"></i>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Endereço</label>
                <div class="input-icon">
                    <i class="fa fa-check"></i>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Endereço" name="endereco" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Cidade</label>
                <div class="input-icon">
                    <i class="fa fa-location-arrow"></i>
                    <input class="form-control placeholder-no-fix" type="text" placeholder="Cidade" name="cidade" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">País</label>
                <div class="select2-container select2 form-control" id="s2id_select2_sample4">
                    <a href="" class="select2-choice select2-default" tabindex="-1">
                        <span class="select2-chosen" id="select2-chosen-1">
                            <i class="fa fa-map-marker"></i>
                            &nbsp;Selecione um país
                        </span>
                        <abbr class="select2-search-choice-close"></abbr>
                        <span class="select2-arrow" role="presentation">
                            <b role="presentation"></b>
                        </span>
                    </a>
                    <label for="s2id_autogen1" class="select2-offscreen"></label>
                    <input class="select2-focusser select2-offscreen" type="text" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-1" id="s2id_autogen1"/>
                    <div class="select2-drop select2-display-none select2-with-searchbox">
                        <div class="select2-search">
                            <label for="s2id_autogen1_search" class="select2-offscreen"></label>
                            <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-1" id="s2id_autogen1_search" placeholder="">
                        </div>
                        <ul class="select2-results" role="listbox" id="select2-results-1"></ul>
                    </div>
                </div>
                <select name="estado" id="select2_sample4" class="select2 form-control select2-offscreen" tabindex="-1" title>
                    <option value=""></option>
                    <option value="BR">Brasil</option>
                </select>
            </div>
            <p>Digite os detalhes da sua conta:</p>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Usuário</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Usuário" name="usuario"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Senha</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="registra_senha" placeholder="Senha" name="senha"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Digite novamente sua senha</label>
                <div class="controls">
                    <div class="input-icon">
                        <i class="fa fa-check"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Digite novamente sua senha" name="rsenha"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>
                    <div class="checker">
                        <span>
                            <input type="checkbox" name="tnc"/>
                        </span>
                    </div>
                    I concordo com os termos de aceite
                </label>
                <div id="register_tnc_error"></div>
            </div>
            <div class="form-actions">
                <button id="register-back-btn" type="button" class="btn">
                    <i class="m-icon-swapleft"></i>
                    Voltar
                </button>
                <button type="submit" id="register-submit-btn" class="btn blue pull-right"></button>
            </div>
        </form>
    </div>
    <div class="copyright"><?php echo date("Y");?></div>
</div>


<script src="../Public/metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../Public/metronic/theme/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="../Public/metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../Public/metronic/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../Public/metronic/theme/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../Public/metronic/theme/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="../Public/metronic/theme/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="../Public/metronic/theme/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../Public/metronic/theme/assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../Public/metronic/theme/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../Public/metronic/theme/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../Public/metronic/theme/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../Public/metronic/theme/assets/admin/pages/scripts/login-soft.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Login.init();
        Demo.init();
        // init background slide images
        $.backstretch([
                "../Public/metronic/theme/assets/admin/pages/media/bg/1.jpg",
                "../Public/metronic/theme/assets/admin/pages/media/bg/2.jpg",
                "../Public/metronic/theme/assets/admin/pages/media/bg/3.jpg",
                "../Public/metronic/theme/assets/admin/pages/media/bg/4.jpg"
            ], {
                fade: 1000,
                duration: 7000
            }
        );
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
</html>
