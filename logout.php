<?
require 'vendor/autoload.php';
use Parse\ParseUser;
use Parse\ParseClient;
session_start();

ParseClient::initialize('rj63ADuUbYBR6zDxxa1oh0OGSGkTjYnQMfkzPk4z', 'Y7DrDxQa3NXUanN3ecPfZdZ9BRp9PrsiVk61hPnB', 'bGPHnB5JccLtSX7M1goS8vMdskuPqi0TdcpWCgpG');

try {
    ParseUser::logOut();
    header("Location: login.php");
} catch (ParseException $error) {
    $msg = "Erro: ".$error->getCode()." ".$error->getMessage();
}
?>
