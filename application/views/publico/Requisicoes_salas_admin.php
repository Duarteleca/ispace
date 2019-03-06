<div class="container mostrarequisicoes">


 <?php echo form_open('Privado_c/mostra_Requisicoes_Salas_admin') ?>
                    <div class="form-group col-xs-3 col-md-3" ></div>
                    <div class="form-group col-xs-6 col-md-6" >
                        <input type="text" class="form-control" name="pesquisar" placeholder="Pesquisar">
                    </div>
                        <button type="submit" id="search" class="btn btn-info" name="submit" >Search</button>
                <?php echo form_close() ?>

    <!-- Mensagem requisicao editada com sucesso-->
    <?php if($this->session->flashdata("requisicao_editada_sucesso")) :?>
    <p class="alert alert-success">
        <?= $this->session->flashdata("requisicao_editada_sucesso")   ?>
    </p>
    <?php endif ?>
    <!-- Mensagem requisicao erro de editar requisicao-->
    <?php if($this->session->flashdata("erro_requisicao")) :?>
    <p class="alert alert-danger">
        <?= $this->session->flashdata("erro_requisicao")   ?>
    </p>
    <?php endif ?>
    <!-- <div class="form-group col-md-12"> -->

    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Data inicio/fim</th>
                <th>Hora inicio/fim</th>
                <th>Nome Sala</th>
                <th>Requisitado por:</th>



                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
        
            <?php foreach ($salas_requisitas_admin as $row){?>
            <?php $id_requisicao = $row['idreq'];  ?>
            <?php $id_user = $row['utilizador_id'];  ?>
            <?php $id_tipologia = $row['tipologia_id'];  ?>
            <?php $data_inicio = $row['data_inicio'];  ?>
            <?php $data_fim = $row['data_fim'];  ?>
            <?php $hora_inicio = $row['hora_inicio'];  ?>
            <?php $hora_fim = $row['hora_fim'];  ?>





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
                    <?php echo $row['tiponome'] ?>
                    <br>
                </td>
                <td>
                    <?php echo $row['nomeuser'] ?>
                    <br>
                </td>


                <td>
                    <!-- Butões para abrir o modal -->
                    <button class="btn btn-warning" data-title="Edit" data-toggle="modal" href="#myModalEditarEquip<?php echo $id_requisicao  ?>">Editar</button>
                    <button class="btn btn-danger" data-toggle="modal" href="#myModaleliminar<?php echo $id_requisicao?>">Cancelar</button>

                </td>



                <!-- Modal eliminar requisicao  -->
                <div id="myModaleliminar<?php echo $id_requisicao?>" class="modal fade">
                    <div class="modal-dialog modal-confirm">
                        <div class="modal-content">

                            <?php echo form_open('Privado_c/apaga_Requisicao_admin') ?>

                            <div class="modal-header">
                                <div class="icon-box">
                                    <i class="material-icons">&#xE5CD;</i>
                                </div>
                                <h4 class="modal-title">Tem a certeza?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="form-group">
                                <input class="form-control " type="text" name="id_requisicao" id="id_requisicao" value="<?php echo $id_requisicao?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control " type="hidden" name="quantidade" id="quantidade" value="">
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


                <!-- Modal Editar requisição -->
                <div class="modal fade" id="myModalEditarEquip<?php echo $id_requisicao  ?>" tabindex="-1" role="dialog" aria-labelledby="edit"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <?php echo form_open_multipart('Privado_c/edita_Requisicao_admin') ?>
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
                                <div class="form-group">
                                    <input class="form-control " type="hidden" name="id_user" id="id_user" value="<?php echo $id_user  ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">Data de inicio</label>
                                    <input type="date" id="bida" name="data_inicio" style="color:black;" value="<?php echo $data_inicio ?>" required min="<?php echo date('Y-m-d'); ?>"
                                        max="<?php echo date('Y-m-d',strtotime('+12 months')); ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Data de entrega</label>
                                    <input type="date" id="biday" name="data_fim" style="color:black;" value="<?php echo $data_fim ?>" onchange='compareDates()'
                                        min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d',strtotime('+12 months')); ?>">
                                </div>

                                <div class="form-group">
                                    <label for="from">Hora de inicio: </label>
                                    <input type="time" name="hora_inicio" value="<?php echo $hora_inicio ?>">
                                    <label for="from">Hora de Fim: </label>
                                    <input type="time" name="hora_fim" value="<?php echo $hora_fim ?>">

                                </div>

                                <div class="modal-footer ">
                                    <button type="submit" class="btn btn-success btn-lg" style="width: 100%;">
                                        <span class="glyphicon glyphicon-ok-sign"></span>Atualizar</button>
                                </div>

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

<script>

    function compareDates() {
        var startDate = Date.parse(document.getElementById('biday').value);
        var today = Date.parse(document.getElementById('bida').value);
        if (!isNaN(startDate) && startDate < today) {
            alert("Data inicial maior que a final");
        }
    }


</script>
