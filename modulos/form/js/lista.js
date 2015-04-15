$(document).ready(function() {
    try{
        if($("#msg").val() != ""){
            alert($("#msg").val());
        }
    }catch(err){
        alert(err.message);
        return false;
    }
});
function editar(ID){
    $("#ID").val(ID);
    $("#target").val("cadastro");
    navega("modulos/form/controller");
}

function confirmaExclusao(ID, nome){
    if(confirm("Confirma exclusão do formulário "+nome+"?")){
        $("#ID").val(ID);
        $("#acao").val("EXCLUIR");
        navega("modulos/form/controller");
    }
}