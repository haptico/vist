<?php
include "class/Form.php";
use Parse\ParseQuery;
use Parse\ParseObject;

$ID = (isset($_POST['ID']) && $_POST['ID'] != '')?$_POST['ID']:'0';
$target = isset($_POST['target'])?$_POST["target"]:"";
$msg = '';
$erro = false;
//============ACOES============================
if(ACAO == 'GRAVAR'){
    $res = Form::gravaForm($_POST);
    $msg = $res["MSG"];
    if (!$res["ERRO"]){
        $target = "lista";
    } else {
        $target = "cadastro";
    }
}elseif(ACAO == 'EXCLUIR'){
    $res = Form::excluiForm($_POST);
    $msg = $res["MSG"];
}
//============FIM ACOES============================

//============CARREGA A VIEW============================
$target = ($target != '')?$target:'lista';
if($target == 'cadastro'){
    $data = Form::getDataCadastro($ID);
}elseif($target == 'lista'){
    $data = Form::getDataLista();
}

//========TRATA O TARGET E O DIRECIONAMENTO
echo '<input type="hidden" name="target" id="target" value="lista" />';
echo '<input type="hidden" id="msg" value="'.$msg.'" />';
echo '<input type="hidden" name="ID" id="ID" value="'.$ID.'" />';
$pathFile = str_replace('controller', $target, __FILE__);
if(is_file($pathFile)){
    require($pathFile);
}
