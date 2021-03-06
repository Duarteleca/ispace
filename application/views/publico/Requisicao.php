<!-- Para que um utilizador nao vá diretamento para pagina que colocar no link -->
<?php if($this->session->userdata("usuario_logado")[0]['tipo'] != 3){ 
    redirect(base_url('home'));
}
?>

<div class="container mostrarequisicoes">

    <!-- Mensagem de erro quando pretende requisitar um equipamento que nao exista tanta quantidade -->
    <?php if ($this->session->flashdata("erro_quantidade")) :?>
    <p class="alert alert-danger">
        <?= $this->session->flashdata("erro_quantidade")   ?>
    </p>
    <?php endif ?>

    <!-- Mensagem de sucesso de requisição -->
    <?php if ($this->session->flashdata("requisicao_sucesso")) :?>
    <p class="alert alert-success">
        <?= $this->session->flashdata("requisicao_sucesso")   ?>
    </p>
    <?php endif ?>

    <!-- Mensagem de erro quando der erro de requisitar  -->
    <?php if ($this->session->flashdata("erro_requisicao")) :?>
    <p class="alert alert-danger">
        <?= $this->session->flashdata("erro_requisicao")   ?>
    </p>
    <?php endif ?>

    <!-- Mensagem de sucesso ao editar requisição-->
    <?php if ($this->session->flashdata("requisicao_editada_sucesso")) :?>
    <p class="alert alert-success">
        <?= $this->session->flashdata("requisicao_editada_sucesso")   ?>
    </p>
    <?php endif ?>

    <!-- Mensagem de sucesso ao cancelar requisição-->
    <?php if ($this->session->flashdata("requisicao_cancelada_sucesso")) :?>
    <p class="alert alert-success">
        <?= $this->session->flashdata("requisicao_cancelada_sucesso")   ?>
    </p>
    <?php endif ?>

    <!-- Mensagem de sucesso ao cancelar requisição-->
    <?php if ($this->session->flashdata("equipamento_adicionado_sucesso")) :?>
    <p class="alert alert-success">
        <?= $this->session->flashdata("equipamento_adicionado_sucesso")   ?>
    </p>
    <?php endif ?>

    <!-- Mensagem de erro quando tentar meter a data iniicon menos que a fim-->
    <?php if ($this->session->flashdata("erro_hora_requisicao")) :?>
    <p class="alert alert-danger">
        <?= $this->session->flashdata("erro_hora_requisicao")   ?>
    </p>
    <?php endif ?>

    <!-- Mensagem de erro quando tentar inserir sem colocar equipamento-->
    <?php if ($this->session->flashdata("erro_requisicao_equipamento")) :?>
    <p class="alert alert-danger">
        <?= $this->session->flashdata("erro_requisicao_equipamento")   ?>
    </p>
    <?php endif ?>

    <!-- Mensagem de erro quando tentar inserir uma quantidade inválida-->
    <?php if ($this->session->flashdata("erro_quantidade_requisicao_equipamento")) :?>
    <p class="alert alert-danger">
        <?= $this->session->flashdata("erro_quantidade_requisicao_equipamento")   ?>
    </p>
    <?php endif ?>
    <!-- Mensagem de erro quando eliminar a requisição com sucesso-->
    <?php if ($this->session->flashdata("elimina_requisicao")) :?>
    <p class="alert alert-success">
        <?= $this->session->flashdata("elimina_requisicao")   ?>
    </p>
    <?php endif ?>


    <!-- Tabela -->
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Data inicio/fim</th>
                <th>Hora inicio/fim</th>
                <th>Nome Sala</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($salas_requisitas as $row) { ?>

            <?php $id_user = $row['utilizador_id'];  ?>
            <?php $id_requisicao = $row['idreq'];  ?>
            <?php $data_inicio = $row['data_inicio'];  ?>
            <?php $data_fim = $row['data_fim'];  ?>
            <?php $hora_inicio = $row['hora_inicio'];  ?>
            <?php $hora_fim = $row['hora_fim'];  ?>
            <?php $nome = $row['nome'];  ?>
            <?php $id_tipologia = $row['tipologia_id'];  ?>
            <?php $quantidade = $row['quantidade']; ?>


            <tr>
                <td class="texto ">
                    <?php echo $row['data_inicio'] ?>
                    <br>
                    <?php echo $row['data_fim'] ?>
                </td>

                <td class="texto ">
                    <?php echo $row['hora_inicio'] ?>
                    <br>
                    <?php echo $row['hora_fim'] ?>
                </td>
                <td>
                    <?php echo $row['nome'] ?>
                </td>

                <td>
                    <!-- Butões para abrir o modal -->
                    <button class="btn btn-success btn" data-toggle="modal" href="#myModalAdicionarEquip<?php echo $id_requisicao  ?>">Adicionar Equipamento</button>
                    <button class="btn btn-warning" data-title="Edit" data-toggle="modal" href="#myModalEditarEquip<?php echo $id_requisicao  ?>">Editar</button>
                    <button class="btn btn-danger" data-toggle="modal" href="#myModaleliminar<?php echo $id_requisicao  ?>">Cancelar</button>

                </td>


                <!-- Modal Adicionar equipamento -->
                <div class="modal fade" id="myModalAdicionarEquip<?php echo $id_requisicao  ?>" tabindex="-1" role="dialog" aria-labelledby="edit"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <?php echo form_open_multipart('Privado_c/adicionar_Equipamento_Requisito') ?>
                            <input class="form-control " type="hidden" name="url" id="url" value="<?php base_url(); ?>">
                            <div class="modal-header">
                                <h4 class="modal-title custom_align" id="Heading">Adicionar Equipamento</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <input class="form-control " type="hidden" name="id_requisicao" id="id_requisicao" value="<?php echo $id_requisicao  ?>">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Insira o Nome do equipamento</label>


                                    <select id="selecionarequipamento" style="color:black" name="procuraEquipamento" class="form-control">
                                        <option value="" selected>Equipamento</option>
                                        <?php foreach ($equipamentos as $row) {
                                            echo "<option value=".$row['id'].">".$row['nome'] ."</option>";
                                            } ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Quantidade disponivel</label>
                                    <input disabled class="form-control " type="text" name="quantidade" id="quantidade" value="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Insira a quantidade</label>
                                    <input class="form-control " type="number" max="30" name="quantidade" id="quantidade" value="">
                                </div>

                                <div class="modal-footer ">

                                    <button type="submit" class="btn btn-success btn-lg" style="width: 100%;">
                                        <span class="glyphicon glyphicon-ok-sign"></span> Adicionar </button>
                                </div>
                            </div>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                </div>


                <!-- Modal Editar requisição -->
                <div class="modal fade" id="myModalEditarEquip<?php echo $id_requisicao  ?>" tabindex="-1" role="dialog" aria-labelledby="edit"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <?php echo form_open_multipart('Privado_c/edita_Requisicao') ?>
                            <div class="modal-header">
                                <h4 class="modal-title custom_align" id="Heading">Editar Requisição</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <input class="form-control " type="hidden" name="id_requisicao" id="id_requisicao" value="<?php echo $id_requisicao  ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control " type="hidden" name="id_tipologia" id="id_tipologia" value="<?php echo $id_tipologia  ?>">
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="">Data de inicio</label>
                                    <input type="date" id="start" name="data_inicio" style="color:black;" value="<?php echo $data_inicio  ?>" required min="<?php echo date('Y-m-d'); ?>"
                                        max="<?php echo date('Y-m-d',strtotime('+12 months')); ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Data de entrega</label>
                                    <input type="date" id="start" name="data_fim" style="color:black;" value="<?php echo $data_fim  ?>" required min="<?php echo date('Y-m-d'); ?>"
                                        max="<?php echo date('Y-m-d',strtotime('+12 months')); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="from">Hora de inicio: </label>
                                    <input type="time" name="hora_inicio" value="<?php echo $hora_inicio ?>">
                                    <label for="from">Hora de Fim: </label>
                                    <input type="time" name="hora_fim" value="<?php echo $hora_fim ?>">
                                </div>

                                <div class="modal-footer ">
                                    <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;">
                                        <span class="glyphicon glyphicon-ok-sign"></span>Editar</button>
                                </div>

                            </div>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                </div>


                <!-- Modal Eliminar -->
                <div id="myModaleliminar<?php echo $id_requisicao  ?>" class="modal fade">
                    <div class="modal-dialog modal-confirm">
                        <div class="modal-content">

                            <?php echo form_open('Privado_c/apaga_Requisicao') ?>

                            <div class="modal-header">
                                <div class="icon-box">
                                    <i class="material-icons">&#xE5CD;</i>
                                </div>
                                <h4 class="modal-title">Tem a certeza?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="form-group">
                                <input class="form-control " type="hidden" name="id_requisicao" id="id_requisicao" value="<?php echo $id_requisicao ?>">
                            </div>
                            <div class="modal-body">
                                <p>Quer mesmo cancelar esta requisição ?Este processo não pode ser revertido.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info" data-dismiss="modal">Voltar</button>
                                <button type="submit" class="btn btn-danger">Cancelar</button>
                            </div>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                </div>
            </tr>


            <?php } ?>
        </tbody>
    </table>
</div>


<!-- Script para mostrar a quantidade dos equipamentos conforme selecione -->
<script>

    $("#selecionarequipamento").change(function () {
        console.log($("#selecionarequipamento").val());
        var equipamento = $("#selecionarequipamento").val();
        var url = $("#url").val();
        $.ajax(
            {
                url: url + 'Privado_c/Ajax',
                type: "post",
                // dataType: "json",
                data: {
                    "equipamento": equipamento,
                },
                success: function (data, status) {

                    console.log(data);
                    $("#quantidade").val(data);

                }
            });
    });



</script>