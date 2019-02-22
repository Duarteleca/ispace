<div class="container mostrasalas">
<br><br><br>

    
    
              <div class="col-xs-6 col-md-6">
                 <a  href="<?php echo base_url('Fazer_requisicao')?>" data-placement="top" data-toggle="tooltip" title="Insert"><button id="butaorequisitar" class="btn btn-info" data-title="Insert" data-toggle="modal" data-target="#insert" >Requisitar Sala</span></button></a>

                </div>
     
   

<!-- <h2 >Salas que podem ser requisitadas no nosso estabelecimento </h2> -->

<!-- <div class="form-group col-md-12"> -->

    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Data inicio</th>
                <th>Data fim</th>
                <th>Hora inicio</th>
                <th>Hora fim</th>
                <th>Utilizador id</th>
                <th>Sala id</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salas_requisitas as $row){?>
            
            <?php $id_user = $row['utilizador_id'];  ?>
      
           
            
                <tr>
                    <td class="texto ">   <?php echo $row['data_inicio'] ?></td>
                    <td class="texto ">   <?php echo $row['data_fim'] ?></td>
                    <td class="texto ">   <?php echo $row['hora_inicio'] ?></td>
                    <td class="texto ">   <?php echo $row['hora_fim'] ?></td>
                    <td class="texto ">   <?php echo $row['utilizador_id'] ?></td>
                    <td class="texto ">    <?php echo $row['sala_id'] ?></td>

                    <td class="texto "><a  href="<?php echo base_url('Privado_c/mostra_equipamento_requisitar/'.$row['id'])?>"><button id="" class="btn btn-info" data-title="Insert">Adicionar Equipamento</button></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

