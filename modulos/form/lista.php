<div class="h1">Formulários</div>
<div class="row-fluid">
    <div class="span12">
        <ul class="nav nav-pills">
            <li class="active"><a href="javascript:editar(0);" title="Novo registro" >Novo registro</a></li>
        </ul>
        <?
        if ($data['corpoTabela'] != '') {
            ?>
            <table id="dataTables" class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th width="90px">Ações</th>
                        <th>Nome</th>
                        <th>Criado Em</th>
                        <th>Criado Por</th>
                        <th>Atualizado Em</th>
                        <th>Atualizado Por</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $data['corpoTabela'] ?>
                </tbody>
            </table>
            <?
        } else {
            echo '<div class="alert alert-block">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Aviso!</h4>Não há registros.
                  </div>';
        }
        ?>
    </div>
</div>
<script type="text/javascript" src="modulos/form/js/lista.js?<?= filemtime(ROOT . 'modulos/form/js/lista.js'); ?>"></script>