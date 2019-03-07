<!-- Para que um utilizador nao vá diretamento para pagina que colocar no link -->
<?php if ($this->session->userdata("usuario_logado")[0]['tipo'] != 1){ 
    redirect(base_url('home'));
}
?>

<div class="container">

    <!-- Mensagem de sucesso apos eliminar uma sala -->
    <?php if ($this->session->flashdata("sala_eliminada_sucesso")) :?>
    <p class="alert alert-success">
        <?= $this->session->flashdata("sala_eliminada_sucesso")   ?>
    </p>
    <?php endif ?>
    <!-- Mensagem de erro apos editar capacidade invalida -->
    <?php if ($this->session->flashdata("erro_capacidade_requisicao_equipamento")) :?>
    <p class="alert alert-danger">
        <?= $this->session->flashdata("erro_capacidade_requisicao_equipamento")   ?>
    </p>
    <?php endif ?>

    <!-- Mensagem de erro-->
    <?php if (isset($erros['mensagens'])) :?>
    <div class="alert alert-danger alert-dismissible classeerrologin" role="alert" id="">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <?php echo $erros['mensagens']; ?>
    </div>

    <?php endif;                
        ?>
    <!-- Mensagem de erro -->
    <?php if ($this->session->flashdata("Sala_sucesso")) :?>
    <p class="alert alert-success">
        <?= $this->session->flashdata("Sala_sucesso")   ?>
    </p>
    <?php endif ?>



    <div class="row">
        <div class="col-xs-6 col-md-6">
            <a href="<?php echo base_url('Inserir_sala')?>" data-placement="top" data-toggle="tooltip" title="Insert">
                <button class="btn btn-info" data-title="Insert" data-toggle="modal" data-target="#insert">Inserir nova sala</span>
                </button>
            </a>

        </div>
    </div>
    <br>

    <table name="tabelasalas" id="example" class="table table-bordered table-condensed">
        <thead>
            <tr id="titulotabela">
                <th>Tipo de Sala</th>
                <th>Capacidade</th>
                <th>Nome</th>
                <th>Imagem</th>
                <th>Disponibilidade</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php 
                    foreach ($salas as $row) { ?>
            <?php $id_tiposala = $row['tipoid'] ?>

            <tr>
                <td>
                    <?php echo $row['tipo_sala'] ?>
                </td>
                <td>
                    <?php echo $row['capacidade'] ?>
                </td>
                <td>
                    <?php echo $row['nome_sala'] ?>
                </td>
                <td>
                    <?php echo $row['imagem'] ?>
                </td>
                <td>
                    <!-- Se a disponibilidade for 1, ira aparecer disponivel, caso contrario, indisponivel. -->
                    <?php
                                if($row['disponibilidade']==1){
                                  echo "Disponível";
                                }else{
                                    echo "Indisponível";
  
                                  }
                                
                            ?>
                </td>

                <td>
                    <!-- Butões para abrir o modal -->
                    <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" href="#myModaleditar<?php echo $id_tiposala;?>">
                        <span class="fas fa-edit"></span>
                    </button>
                    <button class="btn btn-danger btn-xs" data-toggle="modal" href="#myModaleliminar<?php echo $id_tiposala;?>">
                        <span class="fas fa-trash-alt"></span>
                    </button>
                </td>

                <!-- Modal Edit-->
                <div class="modal fade" id="myModaleditar<?php echo $id_tiposala;?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <?php echo form_open_multipart('Privado_c/editar_Sala') ?>
                            <div class="modal-header">
                                <h4 class="modal-title custom_align" id="Heading">Editar Sala</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <input class="form-control " type="hidden" name="id_tiposala" id="id_tiposala" value=" <?php echo $id_tiposala; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Capacidade</label>
                                    <input class="form-control " type="text" name="capacidade" id="capacidade" value=" <?php echo $row['capacidade'] ?> ">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nome Sala</label>
                                    <input class="form-control " type="text" name="nome_sala" id="nome_sala" value=" <?php echo $row['nome_sala'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Disponibilidade</label>
                                    <select style="color:black" name="disponibilidade" placeholder="disponibilidade" class="form-control">
                                        <option value="<?php echo $row['disponibilidade'] ?>" selected>
                                            <?php if ($row['disponibilidade'] == 0){
                                                echo "Indisponivel";
                                                }else{
                                                    echo "Disponivel";
                                                    }?>
                                        </option>

                                        <option value="0">Indisponivel</option>
                                        <option value="1">Disponivel</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Imagem</label>
                                    <img id="imagem" height="100%" width="100%" src="<?php echo base_url($row['imagem'])?>">
                                    <input type="file" name="postimage" id="fileToUpload">
                                </div>

                                <div class="modal-footer ">
                                    <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;">
                                        <span class="glyphicon glyphicon-ok-sign"></span> Editar</button>
                                </div>
                            </div>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                </div>

                <!-- Modal Eliminar -->
                <div id="myModaleliminar<?php echo $id_tiposala;?>" class="modal fade">
                    <div class="modal-dialog modal-confirm">
                        <div class="modal-content">

                            <?php echo form_open('Privado_c/Apaga_Sala') ?>

                            <div class="modal-header">
                                <div class="icon-box">
                                    <i class="material-icons">&#xE5CD;</i>
                                </div>
                                <h4 class="modal-title">Tem a certeza?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="form-group">
                                <input class="form-control " type="text" name="id_tiposala" id="id_tiposala" value="<?php echo $id_tiposala; ?>">
                            </div>
                            <div class="modal-body">
                                <p>Quer mesmo apagar este registo? Este processo não pode ser revertido.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info" data-dismiss="modal">Voltar</button>
                                <button type="submit" class="btn btn-danger">Cancelar</button>
                            </div>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                </div>

                <?php }  ?>

            </tr>

        </tbody>
    </table>
</div>