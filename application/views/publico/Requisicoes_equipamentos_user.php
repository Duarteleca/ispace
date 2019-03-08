<!-- Para que um utilizador nao vá diretamento para pagina que colocar no link -->
<?php if ($this->session->userdata("usuario_logado")[0]['tipo'] != 3){ 
    redirect(base_url('home'));
}
?>

<div class="container mostrarequisicoes">

    <?php echo form_open('Privado_c/mostra_Requisicoes_Equipamentos_user') ?>
    <div class="form-group col-xs-3 col-md-3"></div>
    <div class="form-group col-xs-6 col-md-6">
        <input type="text" class="form-control" name="pesquisar" placeholder="Pesquisar">
    </div>
    <button type="submit" id="search" class="btn btn-success" name="submit">Search</button>
    <?php echo form_close() ?>


    <!-- Mensagem de sucesso ao cancelar requisição-->
    <?php if ($this->session->flashdata("equipamento_cancelado_sucesso")) :?>
    <p class="alert alert-success">
        <?= $this->session->flashdata("equipamento_cancelado_sucesso")   ?>
    </p>
    <?php endif ?>
    <?php if ($this->session->flashdata("erro_quantidade_requisicao_equipamento")) :?>
    <p class="alert alert-danger">
        <?= $this->session->flashdata("erro_quantidade_requisicao_equipamento")   ?>
    </p>
    <?php endif ?>


    <?php if ($this->session->flashdata("erro_quantidade")) :?>
    <p class="alert alert-danger">
        <?= $this->session->flashdata("erro_quantidade")   ?>
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
                <th>Quantidade</th>
                <th>Nome Equip</th>


                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salas_requisitass as $row) { ?>

            <?php $id_user = $row['utilizador_id'];  ?>
            <?php $id_requisicao = $row['idreq'];  ?>
            <?php $data_inicio = $row['data_inicio'];  ?>
            <?php $data_fim = $row['data_fim'];  ?>
            <?php $hora_inicio = $row['hora_inicio'];  ?>
            <?php $hora_fim = $row['hora_fim'];  ?>
            <?php $nome_sala = $row['nome'];  ?>
            <?php $quantidade = $row['quantidade'];  ?>
            <?php $nome_User = $row['nomeuser'];  ?>
            <?php $equipamento_id = $row['equipamento_id']; ?>
            <?php $id_requisicao_equipamento = $row['idreqequip']; ?>




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
                <td class="texto ">
                    <?php echo $row['nome'] ?>
                    <br>
                </td>
                <td class="texto ">
                    <?php echo $row['nomeuser'] ?>
                    <br>
                </td>
                <td class="texto ">
                    <?php echo $row['quantidade'] ?>
                    <br>
                </td>
                <td class="texto ">
                    <?php echo $row['equipnome'] ?>
                    <br>
                </td>
                <td>
                    <!-- Butões para abrir o modal -->
                    <button class="btn btn-danger" data-toggle="modal" href="#myModalcancelar<?php echo $id_requisicao  ?>">Cancelar Equipamento</button>
                    <button class="btn btn-warning" data-title="Edit" data-toggle="modal" href="#myModalEditarEquip<?php echo $id_requisicao  ?>">Editar</button>

                </td>


                <!-- Modal Cancelar equipamento da requisição  -->
                <div id="myModalcancelar<?php echo $id_requisicao  ?>" class="modal fade">
                    <div class="modal-dialog modal-confirm">
                        <div class="modal-content">

                            <?php echo form_open('Privado_c/cancelar_equipamento_requisicao_user') ?>

                            <div class="modal-header">
                                <div class="icon-box">
                                    <i class="material-icons">&#xE5CD;</i>
                                </div>
                                <h4 class="modal-title">Tem a certeza?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="form-group">
                                <input class="form-control " type="hidden" name="id_requisicao" id="id_requisicao" value="<?php echo $id_requisicao ?>" disabled>
                            </div>
                            <div class="form-group">
                                <input class="form-control " type="hidden" name="quantidade" id="quantidade" value="<?php echo $quantidade ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control " type="hidden" name="id_equipamento" id="id_equipamento" value="<?php echo $equipamento_id ?>">
                            </div>
                            <div class="form-group">
                                <input class="form-control " type="hidden" name="id_requisicao_equipamento" id="id_requisicao_equipamento" value="<?php echo $id_requisicao_equipamento ?>">
                            </div>

                            <div class="modal-body">
                                <p>Quer mesmo cancelar este equipamento dessa requisição ?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info" data-dismiss="modal">Voltar</button>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </div>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                </div>

                <!-- Modal Editar equipamento da requisição  -->
                <div class="modal fade" id="myModalEditarEquip<?php echo $id_requisicao  ?>" tabindex="-1" role="dialog" aria-labelledby="edit"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <?php echo form_open_multipart('Privado_c/editar_equipamento_requisicao_user') ?>
                            <div class="modal-header">
                                <h4 class="modal-title custom_align" id="Heading">Editar Requisição</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">

                                    <input class="form-control " type="hidden" name="id_requisicao" id="id_requisicao" value="<?php echo $id_requisicao ?>">
                                </div>
                                <div class="form-group">
                                    <label for="from">Nome do Equipamento </label>
                                    <input class="form-control" disabled type="text" value="<?php echo $row['equipnome'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="from">Quantidade </label>
                                    <input class="form-control " type="text" name="quantidade" id="quantidade" value="<?php echo $quantidade ?>">
                                </div>
                                <div class="form-group">

                                    <input class="form-control " type="hidden" name="id_equipamento" id="id_equipamento" value="<?php echo $equipamento_id ?>">
                                </div>
                                <div class="form-group">

                                    <input class="form-control " type="hidden" name="id_requisicao_equipamento" id="id_requisicao_equipamento" value="<?php echo $id_requisicao_equipamento ?>">
                                </div>
                                

                            </div>



                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-success btn-lg" style="width: 100%;">
                                    <span class="glyphicon glyphicon-ok-sign"></span>Confirmar Edição</button>
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