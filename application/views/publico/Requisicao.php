<div class="container mostrarequisicoes">
    <br>
    <br>
    <br>
    
    <!-- <div class="form-group col-md-12"> -->
     <!-- Mensagem de err quando não consegue dar login -->
     <?php if($this->session->flashdata("erro_quantidade")) :?>
                                        <p class ="alert alert-danger"><?= $this->session->flashdata("erro_quantidade")   ?></p>
                                        <?php endif ?>
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
            <?php foreach ($salas_requisitas as $row){?>

            <?php $id_user = $row['utilizador_id'];  ?>
            <?php $id_requisicao = $row['idreq'];  ?>
            <?php $data_inicio = $row['data_inicio'];  ?>
            <?php $data_fim = $row['data_fim'];  ?>
            <?php $hora_inicio = $row['hora_inicio'];  ?>
            <?php $hora_fim = $row['hora_fim'];  ?>
            <?php $hora_fim = $row['nome'];  ?>

            




            <tr>
                <td class="texto ">
                    <?php echo $row['data_inicio'] ?><br>
                    <?php echo $row['data_fim'] ?>
                </td>
                
                <td class="texto ">
                    <?php echo $row['hora_inicio'] ?><br>
                    <?php echo $row['hora_fim'] ?>              
                </td>
                <td>
                    <?php echo $row['nome'] ?>
                </td>
               
                <td>                 
                <!-- Butões para abrir o modal -->  
                <button class="btn btn-success btn" data-toggle="modal" href="#myModalAdicionarEquip<?php echo $id_requisicao  ?>">Adicionar Equipamento</button>
                <button class="btn btn-warning" data-title="Edit" data-toggle="modal" href="#myModalEditarEquip<?php echo $id_requisicao  ?>" >Editar</button>
                <button class="btn btn-danger"  data-toggle="modal"  href="#myModaleliminar<?php echo $id_requisicao  ?>">Cancelar</button>
                
                </td> 

                
        <!-- Modal Adicionar equipamento -->
                <div class="modal fade" id="myModalAdicionarEquip<?php echo $id_requisicao  ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <?php echo form_open_multipart('Privado_c/adicionar_Equipamento_Requisito') ?>
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


                                    <select style="color:black" name="procuraEquipamento" class="form-control">
                                        <option value="" selected>Equipamento</option>
                                        <?php foreach($equipamentos as $row){
                                            echo "<option value=".$row['nome'].">".$row['nome'] ."</option>";
                                            } ?>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Insira a quantidade</label>
                                    <input class="form-control " type="text" name="quantidade" id="quantidade" value="">
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


                 <!-- Modal Editar equipamento -->
                 <div class="modal fade" id="myModalEditarEquip<?php echo $id_requisicao  ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <?php echo form_open_multipart('Privado_c/adicionar_Equipamento_Requisito') ?>
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
                                    <label for="exampleInputEmail1">Data início</label>
                                    <input id="calendario" type= "date" name="data_inicio" value="<?php echo $data_inicio  ?>">
                                    <label for="exampleInputEmail1">Data fim</label>
                                    <input id="calendario" type= "date" name="data_fim" value="<?php echo $data_fim  ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hora início</label>
                                    <input type="time" name="hora_inicio" value="<?php echo $hora_inicio ?>">
                                    <label for="exampleInputEmail1">Hora fim</label>
                                    <input type="time" name="hora_fim" value= "<?php echo $hora_fim ?>">
                                </div>
                                
                                

                                <div class="modal-footer ">
                                    <button type="submit" class="btn btn-success btn-lg" style="width: 100%;">
                                        <span class="glyphicon glyphicon-ok-sign"></span> Editar </button>
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
                                            <input class="form-control " type="hidden" name="id_requisicao" id="id_requisicao" value ="<?php echo $id_requisicao ?>">
                                        </div>
                                            <div class="modal-body">
                                                <p>Quer mesmo cancelar esta requisição ?Este processo não pode ser revertido.</p>
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
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