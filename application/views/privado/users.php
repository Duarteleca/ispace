<?php if(!$this->session->userdata("usuario_logado")[0]['tipo'] == 1){ 
    redirect(base_url('home'));
}
?>


<div class="container">

    <br><br><br>

          <div class="row">
              <div class="col-xs-6 col-md-6">
                 <a href="<?php echo base_url('Registo')?>" data-placement="top" data-toggle="tooltip" title="Insert"><button class="btn btn-info" data-title="Insert" data-toggle="modal" data-target="#insert" >Inserir novo Utilizador</span></button></a>

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
            <th>Foto</th>
                <th>Nome</th>
                <th>Username</th>
                <th>email</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
                  <?php 
                    foreach ($utilizadores as $row){?>
                  <?php $id_utilizador= $row['id'] ?>
                  
            <tr>        
                        <td><img id="imagem" class="imagem_logo" height="60px" width="60px" src="<?php echo base_url($row['imagem'])?>"> </td>
                        <td><?php echo $row['nome'] ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td>
                        <!-- Se a disponibilidade for 1, ira aparecer disponivel, caso contrario, indisponivel. -->
                            <?php
                                if($row['tipo']==1){
                                  echo "Admin";
                                }else if($row['tipo']==2){
                                    echo "Admin temporario";
                                  }else{
                                  echo "Utilizador";
                                }
                            ?>
                        </td>
                        <td>   
                        <?php
                                if($row['tipo']==1){ }else{?>           
                            <!-- Butões para abrir o modal -->  
                            <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" href="#myModaleditar<?php echo $id_utilizador;?>" ><span class="fas fa-edit"></span></button>
                            
                            <?php if($row['tipo']==2){ }else{?>  
                            <button class="btn btn-danger btn-xs"  data-toggle="modal"  href="#myModaleliminar<?php echo $id_utilizador;?>" ><span class="fas fa-trash-alt"></span></button>
                           <?php }}?>
                            </td>        
                        
    <!-- Modal Edit-->
    <div class="modal fade"  id="myModaleditar<?php echo $id_utilizador;?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <?php echo form_open_multipart('Privado_c/users') ?>
                          <div class="modal-header">
                            <h4 class="modal-title custom_align" id="Heading">Editar Utilizador</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>    
                          </div>

                <div class="modal-body">
                        <div class="form-group">
                                <input class="form-control " type="text" name="id_user" id="id_tiposala" value =" <?php echo $id_utilizador; ?>">
                        </div>
                        <div class="form-group">
                                            
                            <img id="imagem" class=" imagem_logo" height="60px" width="60px" src="<?php echo base_url($row['imagem'])?>">
                            </div>
                
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input readonly  class="form-control " type="text" name="nome" id="capacidade" value =" <?php echo $row['nome'] ?> ">
                            </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Username</label>
                                    <input readonly  class="form-control " type="text" name="username" id="nome_sala" value =" <?php echo $row['username'] ?>">
                                </div>
                                    <div class="form-group">
                                            <label for="exampleInputEmail1">email</label>
                                            <input readonly  class="form-control " type="text" name="email" id="disponibilidade" value ="<?php echo $row['email'] ?> ">
                                        </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">tipo</label>
                                    

                                    <select style="color:black" name="tipo_user" required class="form-control" > 
                                        <option value="<?php echo $row['tipo'] ; ?>" selected ><?php if( $row['tipo'] == 0){echo "Utilizador";}else{echo "Adminstrador";}?></option> 
                                        <option value="0">Utilizador</option> 
                                        <option value="2">Administrador</option>     
                                    </select>

                                </div>
                                <div class="modal-footer ">
                                    <button type="submit" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
                                </div>
                                
                </div>
                <?php echo form_close() ?>
              </div>
            </div>
          </div>
                            
                         <!-- Modal Eliminar -->
                <div id="myModaleliminar<?php echo $id_utilizador;?>" class="modal fade">
                    <div class="modal-dialog modal-confirm">
                        <div class="modal-content">

                            <?php echo form_open('Privado_c/apaga_utilizador') ?>

                                <div class="modal-header">
                                    <div class="icon-box">
                                        <i class="material-icons"></i>
                                    </div>				
                                        <h4 class="modal-title">Tem a certeza?</h4>	
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                        <div class="form-group">
                                            <input class="form-control " type="text" name="id_user" id="username_modal" value =" <?php echo $id_utilizador ?>">
                                        </div>
                                            <div class="modal-body">
                                                <p>Quer mesmo apagar este Utilizador? Este processo não pode ser revertido.</p>
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </div>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                </div> 

                        <?php }  ?>
    
        </tr>
        
        </tbody>
    </table>
    <?php echo isset($error) ?  "<div class='alert alert-success' role='alert'>". $error ."</div>" : ''; ?>
</div>

<!-- Mensagem de err quando não consegue dar login -->
<?php if($this->session->flashdata("Sala_sucesso")) :?>
    <p class ="alert alert-success"><?= $this->session->flashdata("Sala_sucesso")   ?></p>
    <?php endif ?>