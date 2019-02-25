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
                <th>Foto</th>
                <th>Tipo de sala</th>
                <th>Nome da sala</th>
                <th>Capacidade</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sala as $row){?>
                <tr>
                    <td><img height="50%" width="50%" class="imagem_salas" src="<?php echo base_url($row['imagem'])?>"></td>
                    <td class="texto ">   <?php echo $row['tipo_sala'] ?></td>
                    <td class="texto ">   <?php echo $row['nome_sala'] ?></td>
                    <td class="texto ">    <?php echo $row['capacidade'] ?></td>   
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

