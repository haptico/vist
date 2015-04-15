<?php
use Parse\ParseQuery;
use Parse\ParseObject;
use Parse\ParseException;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form
 *
 * @author Admin
 */
class Form {
    public static function gravaForm($post) {
        global $currentUser;
        $nomeForm = trim($post["nome_form"]);
        $ID = trim($post["ID"]);
        $erro = false;
        $query = new ParseQuery("form");
        $query->equalTo("nome", $nomeForm);
        $results = $query->find();
        if (count($results) > 0) {
            $msg = "Já existe um formulário cadastrado com esse nome";
            $erro = true;
        }
        if (!$erro){
            if ($ID != '0') {
                try {
                    $query = new ParseQuery("form");
                    $form = $query->get($ID);
                    $form->set("nome", $nomeForm);
                    $form->set("atualizadoPor", $currentUser);
                    $form->save();
                    $msg = "Formulário atualizado com sucesso.";
                } catch (Exception $err) {
                    $msg = "Erro ao atualizar formulário. ".$err->getMessage();
                    $erro = true;
                }
            }else{
                try {
                    $form = ParseObject::create("form");
                    $form->set("nome", $nomeForm);
                    $form->set("criadoPor", $currentUser);
                    $form->set("atualizadoPor", $currentUser);
                    $form->save();
                    $msg = "Formulário criado com sucesso.";
                } catch (Exceptio $err) {
                    $msg = "Erro ao criar formulário. ".$err->getMessage();
                    $erro = true;
                }
            }
        }        

        return array("ERRO" => $erro, "MSG" => $msg);

    }
    
    public static function excluiForm($post) {
        $ID = trim($post["ID"]);
        $erro = false;
        $msg = "";
        if ($ID != '0') {
            try {
                $query = new ParseQuery("form");
                $form = $query->get($ID);
                $form->destroy();
                $msg = "Formulário excluído com sucesso.";
            } catch (Exception $err) {
                $msg = "Erro ao excluir formulário. ".$err->getMessage();
                $erro = true;
            }
        }

        return array("ERRO" => $erro, "MSG" => $msg);

    }
    
    public static function getDataCadastro($ID){
        $data = array();
        if ($ID != '0'){
            $query = new ParseQuery("form");
            $form = $query->get($ID);
            $data["ID"] = $ID;
            $data["nomeForm"] = $form->get("nome");
        }else{
            $data["ID"] = $ID;
            $data["nomeForm"] = "";
        }
        return $data;
    }
    
    public static function getDataLista(){
        $data = array();
        $query = new ParseQuery("form");
        $forms = $query->find();
        $strCorpoTabela = "";
        $timezone = new DateTimeZone("America/Sao_Paulo");
        foreach ($forms as $form) {
            //==========INICIO AÇÕES================
            //$ativacao = "<img src='img/icon/img_sinalVerde.gif' id='imgBanner_{$obj->getID()}' style='cursor:pointer;' alt='Ativa' onclick=\"setAtivacao('{$obj->getID()}')\" />";
            $excluir = "<img alt='Editar' src='img/icon/delete.gif' style='cursor:pointer;' onClick=\"confirmaExclusao('{$form->getObjectId()}','{$form->get("nome")}')\" />";
            $editar = "<img alt='Excluir' src='img/icon/edit.gif' style='cursor:pointer;' onClick=\"editar('{$form->getObjectId()}')\" />";
            //==========FIM AÇÕES================

            $criado = $form->getCreatedAt();
            date_timezone_set($criado, $timezone);
            $criadoEm = date_format($criado, "d/m/Y H:i");
            $userCriacao = "";
            $criadoPor = $form->get("criadoPor");
            if (isset($criadoPor)){
                $criadoPor->fetch();
                if ($criadoPor instanceof ParseObject){
                    $userCriacao = $criadoPor->get("username");
                }
            }
            $userAtualizacao = "";
            $atualizado = $form->getUpdatedAt();
            date_timezone_set($atualizado, $timezone);
            $atualizadoEm = date_format($atualizado, "d/m/Y H:i");
            $atualizadoPor = $form->get("atualizadoPor");
            if (isset($atualizadoPor)){
                $atualizadoPor->fetch();
                if ($atualizadoPor instanceof ParseObject){
                    $userAtualizacao = $atualizadoPor->get("username");
                }
            }
            
            $strCorpoTabela .= <<<EOT
            <tr>
                <td> $editar | $excluir</td>
                <td>{$form->get("nome")}</td>
                <td>{$criadoEm}</td>
                <td>{$userCriacao}</td>
                <td>{$atualizadoEm}</td>
                <td>{$userAtualizacao}</td>
            </tr>
EOT;
        }
        
        $data["corpoTabela"] = $strCorpoTabela;

        return $data;
    }
    
}
