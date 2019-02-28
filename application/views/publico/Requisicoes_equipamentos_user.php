<div class="container mostrarequisicoes">
    <br>
    <br>
    <br>

                <?php echo form_open('Privado_c/mostra_Requisicoes_Equipamentos_user') ?>
                    <div class="form-group col-xs-3 col-md-3" ></div>
                    <div class="form-group col-xs-6 col-md-6" >
                        <input type="text" class="form-control" name="pesquisar" placeholder="Pesquisar">
                    </div>
                        <button type="submit" id="search" class="btn btn-success" name="submit" >Search</button>
                <?php echo form_close() ?>

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
            <?php foreach ($salas_requisitass as $row){?>

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
                    <?php echo $row['data_inicio'] ?><br>
                    <?php echo $row['data_fim'] ?>
                </td>
                
                <td class="texto ">
                    <?php echo $row['hora_inicio'] ?><br>
                    <?php echo $row['hora_fim'] ?>
                </td>
                <td class="texto ">
                    <?php echo $row['nome'] ?><br>
                </td>
                <td class="texto ">
                    <?php echo $row['nomeuser'] ?><br>
                </td>
                <td class="texto ">
                    <?php echo $row['quantidade'] ?><br>
                </td>
                <td class="texto ">
                    <?php echo $row['equipnome'] ?><br>
                </td>
                <td>                 
                <!-- Butões para abrir o modal --> 
                <div><button class="btn btn-warning"  data-toggle="modal"  href="#myModaleditar<?php echo $id_requisicao  ?>">Editar Equipamento</button></div>
                
                <div><button class="btn btn-danger"  data-toggle="modal"  href="#myModalcancelar<?php echo $id_requisicao  ?>">Cancelar Equipamento</button></div>
                
                
               
                
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
                                            <input class="form-control " type="hidden" name="id_requisicao" id="id_requisicao" value ="<?php echo $id_requisicao ?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control " type="hidden" name="quantidade" id="quantidade" value ="<?php echo $quantidade ?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control " type="hidden" name="id_equipamento" id="id_equipamento" value ="<?php echo $equipamento_id ?>">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control " type="hidden" name="id_requisicao_equipamento" id="id_requisicao_equipamento" value ="<?php echo $id_requisicao_equipamento ?>">
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
                


            
                </tr>


<?php } ?>
</tbody>
</table>
</div>