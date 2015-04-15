<?
set_time_limit(0);
require 'vendor/autoload.php';

use Parse\ParseUser;
use Parse\ParseClient;
use Parse\ParseException;
use Parse\ParseSessionStorage;
session_start();

ParseClient::initialize('rj63ADuUbYBR6zDxxa1oh0OGSGkTjYnQMfkzPk4z', 'Y7DrDxQa3NXUanN3ecPfZdZ9BRp9PrsiVk61hPnB', 'bGPHnB5JccLtSX7M1goS8vMdskuPqi0TdcpWCgpG');
ParseClient::setStorage( new ParseSessionStorage() );

if(count($_POST)>0){
    $usuario = trim($_POST["usuario"]);
    $senha = trim($_POST["senha"]);
    if($usuario != "" && $senha != ""){
        try {
            $user = ParseUser::logIn($usuario, $senha);
            if($user){
                $msg = "Login realizado com sucesso";
                header("Location: index.php");
            }
        } catch (ParseException $error) {
            if($error->getCode() == 101){
                $msg = "Erro: Credenciais inválidas.";
            }else{
                $msg = "Erro: ".$error->getCode()." ".$error->getMessage();
            }
        }
    }else{
        $msg = "Preencha os campos Login e Senha.";
    }
}
?>

<!DOCTYPE html> 
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Vistoria</title>
        <meta name="description" content="">
        <meta name="author" content="scoob">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Plugin Bootstrap css -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.css" rel="stylesheet">

        <link rel='stylesheet' type='text/css' href='css/login.css'>
        <!-- Bootstrap scripts -->
        <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/bootstrap-alert.js"></script>
    </head>
    <body class="login-page">
        <!-- Main login container -->
        <div class="login-container">
            <!-- Login page logo -->

            <section>
                <?if (isset($msg) && $msg != '') { ?>
                    <div class="alert alert-info alert-block fade in">
                        <button class="close" data-dismiss="alert">&times;</button>
                    <?= $msg ?>
                    </div>
                <? } ?>

                <!-- Login form -->
                <form method="post" action="#" id="login">
                    <input type="hidden" name="acao" value="LOGIN" />
                    <fieldset>
                        <h1><small><span class="brand cufon-font-blk">Vistoria</span></small></h1>
                        <div class="control-group">
                            <label class="control-label cufon-font" for="login">Login</label>
                            <div class="controls">
                                <input id="usuario" type="text" placeholder="Seu login" name="usuario">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label cufon-font" for="senha">Senha</label>
                            <div class="controls">
                                <input id="senha" type="password" placeholder="Sua senha" name="senha">
                            </div>
                        </div>
                        <br />
                        <div class="form-actions">
                            <button class="btn btn-primary btn-alt cufon-font-blk" type="submit"><span class="awe-signin "></span> Log in</button>
                        </div>
                    </fieldset>
                </form>
                <!-- /Login form -->

                <!-- Perdeu a senha form>
                <form method="post" action="#" id="senha" style="display: none;">
                    <input type="hidden" name="acao" value="SENHA" />
                    <fieldset>
                        <h1><small><a class="brand cufon-font-blk" href="#"><?= NOME_SISTEMA ?></a></small></h1>
                        <div class="control-group">
                            <label class="control-label cufon-font" for="login">Login</label>
                            <div class="controls">
                                <input id="login" type="text" placeholder="Seu login" name="login">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label cufon-font" for="email">E-mail</label>
                            <div class="controls">
                                <input id="email" type="text" placeholder="Seu e-mail" name="email">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary btn-alt cufon-font-blk" type="submit"><span class="awe-signin "></span> Enviar nova senha</button>
                        </div>
                    </fieldset>
                </form>
                <!-- /Perdeu a senha form -->

            </section>

            <!-- Login page navigation -->
            <nav>
                <ul>
                    <li><a class="cufon-font" href="registro.php" id="registro">Crie uma conta</a></li>
                    <!--li><a class="cufon-font" href="#" id="voltar" style="display: none;">Voltar</a></li>
                    <li><a class="cufon-font" href="#">Suporte</a></li-->
                </ul>
            </nav>
            <!-- Login page navigation -->
        </div>
        <!-- /Main login container -->
        <script type="text/javascript">
            $(document).ready(function(){
                $('#PerdeuAsenha').click(function() {
                    $('form#login').hide();
                    $('form#senha').show();
                    $('#PerdeuAsenha').hide();
                    $('#voltar').show();
                });
                $('#voltar').click(function() {
                    $('form#senha').hide();
                    $('form#login').show();
                    $('#voltar').hide();
                    $('#PerdeuAsenha').show();
                });
            });
        </script>

    </body>
</html>
