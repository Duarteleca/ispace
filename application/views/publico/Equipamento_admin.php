<div class="container">

    <br><br><br>

          <div class="row">
              <div class="col-xs-6 col-md-6">
                 <a href="<?php echo base_url('Inserir_equipamento')?>" data-placement="top" data-toggle="tooltip" title="Insert"><button class="btn btn-info" data-title="Insert" data-toggle="modal" data-target="#insert" >Inserir novo Equipamento</span></button></a>

                </div>
            </div>
            <br>

<!-- Mensagem de err quando não consegue dar login -->
<?php if(isset($erros['mensagens'])) :?>
            <div class="alert alert-danger alert-dismissible classeerrologin" role="alert" id="">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <?php echo $erros['mensagens']; ?>
        </div>
        
        <?php endif;                
        ?>

    <table name="tabelaequipamentos"  id="example" class="table table-bordered table-condensed" >
        <thead>
            <tr id="titulotabela">
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Imagem</th>
                <th>Disponibilidade</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
                  <?php 
                    foreach ($equipamentos as $row){?>
                  <?php $id_equipamento= $row['id'] ?>
                  
            <tr>        
                        <td><?php echo $row['nome'] ?></td>
                        <td><?php echo $row['quantidade'] ?></td>
                        <td><?php echo $row['imagem'] ?></td>
                        <td>
                        <!-- Se a disponibilidade for 1, ira aparecer disponivel, caso contrario, indisponivel. -->
                            <?php
                                if($row['disponibilidade']==1){
                                  echo "Disponível";
                                }
                                else{
                                  echo "Indisponível";

                                }
                            ?>
                        </td>
                        <td>                 
                            <!-- Butões para abrir o modal -->  
                            <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" href="#myModaleditar<?php echo $id_equipamento;?>" ><span class="fas fa-edit"></span></button>
                            
                            </td>        
                        
    <!-- Modal Edit-->
    <div class="modal fade"  id="myModaleditar<?php echo $id_equipamento;?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <?php echo form_open_multipart('Privado_c/editar_Equipamento') ?>
                          <div class="modal-header">
                            <h4 class="modal-title custom_align" id="Heading">Editar Sala</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>    
                          </div>

                <div class="modal-body">
                        <div class="form-group">
                                <input class="form-control " type="text" name="id_tiposala" id="id_tiposala" value =" <?php echo $id_equipamento; ?>">
                        </div>
                
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input  class="form-control " type="text" name="capacidade" id="capacidade" value =" <?php echo $row['nome'] ?> ">
                            </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Quantidade</label>
                                    <input  class="form-control " type="text" name="nome_sala" id="nome_sala" value =" <?php echo $row['quantidade'] ?>">
                                </div>

                                    <div class="form-group">
                                            <label for="exampleInputEmail1">Disponibilidade</label>
                                            <input class="form-control " type="text" name="disponibilidade" id="disponibilidade" value ="<?php echo $row['disponibilidade'] ?> ">
                                        </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Imagem</label>
                                                    <img id="imagem" height="100%" width="100%" src="<?php echo base_url($row['imagem'])?>"> 
                                                        <input type="file" name="postimage" id="fileToUpload">
                                            </div>
                                          
                                                    <div class="modal-footer ">
                                                        <button type="submit" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
                                                    </div>
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

<!-- Mensagem de err quando não consegue dar login -->
<?php if($this->session->flashdata("Sala_sucesso")) :?>
    <p class ="alert alert-success"><?= $this->session->flashdata("Sala_sucesso")   ?></p>
    <?php endif ?>