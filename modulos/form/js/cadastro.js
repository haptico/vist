$(document).ready(function() {
    try{
        $('#btn_gravar').click(function(){
            gravar()
        });
        if($("#msg").val() != ""){
            alert($("#msg").val());
        }
    }catch(err){
        alert(err.message);
        return false;
    }
});
function gravar(){
    nomeForm = $("#nome_form").val();
    if(nomeForm != ""){
        $("#incluir").val("S");
        $("#acao").val("GRAVAR");
        navega("modulos/form/controller");
    }else{
        alert("Forneça um nome para o formulário.");
    }
}