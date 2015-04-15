<!DOCTYPE HTML>
<?php
set_time_limit(0);
require 'vendor/autoload.php';

use Parse\ParseClient;
use Parse\ParseUser;
ParseClient::initialize('rj63ADuUbYBR6zDxxa1oh0OGSGkTjYnQMfkzPk4z', 'Y7DrDxQa3NXUanN3ecPfZdZ9BRp9PrsiVk61hPnB', 'bGPHnB5JccLtSX7M1goS8vMdskuPqi0TdcpWCgpG');

$currentUser = ParseUser::getCurrentUser();
if(!$currentUser){
    header("Location: login.php");
}

define('ACAO', ((isset($_POST['acao']) && $_POST['acao'] != '') ? $_POST['acao'] : '')); //facilitando o uso da acao - garantindo que nao será editada na execucao, alem de acesso direto nos metodos... 
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Vistoria</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <?php include "menu.php"; ?> 

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="js/functions.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--script src="js/ie10-viewport-bug-workaround.js"></script-->
    <div class="container">

        <form id="form1" method="post" >
            <?php
            $page = "home";
            if (count($_POST) > 0){
                $pagePost = trim($_POST["page"]);
                $page = ($pagePost != "")?$pagePost:"home";
            }
            include "$page.php";
            ?>
            <input type="hidden" name="page" id="page" value="" />
            <input type="hidden" value="" id="acao" name="acao"/>
        </form>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
  </body>
</html>        