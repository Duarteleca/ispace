<div class="container mostrarequisicoes">
    <br>
    <br>
    <br>
    
    <!-- <div class="form-group col-md-12"> -->

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
            <?php foreach ($salas_requisitass as $row){?>
            <?php $id_requisicao = $row['id'];  ?>        
            <?php $id_user = $row['utilizador_id'];  ?>
            <?php $id_user = $row['tipologia_id'];  ?>    
            <?php $data_inicio = $row['data_inicio'];  ?>
            <?php $data_fim = $row['data_fim'];  ?>
            <?php $hora_inicio = $row['hora_inicio'];  ?>
            <?php $hora_fim = $row['hora_fim'];  ?>
      



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
                <?php echo $row['utilizador_id'] ?><br>
                </td>
               
      
                <td>                 
                <!-- Butões para abrir o modal -->  
                <button class="btn btn-warning" data-title="Edit" data-toggle="modal" href="#myModalEditarEquip" >Editar</button>
                <button class="btn btn-danger"  data-toggle="modal"  href="#myModaleliminar<?php echo $id_requisicao?>">Cancelar</button>
                
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
                                            <input class="form-control " type="text" name="id_requisicao" id="id_requisicao" value ="<?php echo $id_requisicao?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control " type="hidden" name="quantidade" id="quantidade" value ="">
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