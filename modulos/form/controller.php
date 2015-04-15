<?php
use Parse\ParseQuery;
use Parse\ParseObject;

$msg = "";
if(isset($_POST["acao"]) && $_POST["acao"] == "GRAVAR"){
    $nomeForm = trim($_POST["nome_form"]);
    if ($nomeForm <> "") {
        $query = new ParseQuery("form");
        $query->equalTo("nome", $nomeForm);
        $results = $query->find();
        if (count($results) > 0) {
            $msg = "Já existe um formulário cadastrado com esse nome";
        } else {
            $form = ParseObject::create("form");
            $form->set("nome", $nomeForm);
            $form->save();
            $msg = "Formulário criado com sucesso.";
        }
    } else {
        $msg = "Informe o nome do formulário";
    }
}
?>
<script type="text/javascript" src="modulos/form/js/cadastro.js"></script>
<div>
    <input type="hidden" value="<?= $msg ?>" id="msg" name="msg"/>
    <input type="hidden" name="incluir" id="incluir" value="" />
    Formulário: <input type="text" id="nome_form" name="nome_form" />
    <input type="button" id="btn_gravar" value="Enviar" />
</div>
