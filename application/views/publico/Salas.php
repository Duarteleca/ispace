<div class="container mostrasalas">

    <!-- Mensagem de erro ao mudar a hora de requisição-->
    <?php if ($this->session->flashdata("erro_hora_requisicao")) :?>
    <p class="alert alert-danger">
        <?= $this->session->flashdata("erro_hora_requisicao")   ?>
    </p>
    <?php endif ?>

    <!-- Mensagem de sucesso ao fazer requisição -->
    <?php if ($this->session->flashdata("requisicao_sucesso")) :?>
    <p class="alert alert-success">
        <?= $this->session->flashdata("requisicao_sucesso")   ?>
    </p>
    <?php endif ?>

    <!-- Mensagem de erro quando não consegue fazer requisição -->
    <?php if ($this->session->flashdata("erro_requisicao")) :?>
    <p class="alert alert-danger">
        <?= $this->session->flashdata("erro_requisicao")   ?>
    </p>
    <?php endif ?>



    <div class="form-group col-md-12">
        <?php echo form_open('Publico_c/mostra_salas') ?>
        <select style="color:black" name="search_sala" class="form-control">
            <option value="" selected>Tipo de sala</option>
            <?php foreach ($salas as $rows) {
                echo "<option value=".$rows['tipo_sala'].">".$rows['tipo_sala'] ."</option>";
                } ?>
        </select>
    </div>
    <div class="form-group col-md-12 ">
        <input type="submit" class="btn btn-info" name="submit" value="Pesquisa">
    </div>
    <?php echo form_close() ?>

    <!-- <h2 >Salas que podem ser requisitadas no nosso estabelecimento </h2> -->

    <!-- <div class="form-group col-md-12"> -->
    <?php 
        if (!$this->session->userdata("usuario_logado")) { ?>

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
            <?php foreach ($sala as $row) { ?>
            <tr>
                <td>
                    <img height="30%" width="30%" class="imagem_salas" src="<?php echo base_url($row['imagem'])?>">
                </td>
                <td class="texto ">
                    <?php echo $row['tipo_sala'] ?>
                </td>
                <td class="texto ">
                    <?php echo $row['nome_sala'] ?>
                </td>
                <td class="texto ">
                    <?php echo $row['capacidade'] ?>
                </td>

            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } else  {  ?>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Tipo de sala</th>
                <th>Nome da sala</th>
                <th>Capacidade</th>
                <th>Ação</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($sala as $row) { ?>
            <?php $id_sala= $row['tipoid'] ?>

            <tr>
                <td>
                    <img height="50%" width="50%" class="imagem_salas" src="<?php echo base_url($row['imagem'])?>">
                </td>
                <td class="texto ">
                    <?php echo $row['tipo_sala'] ?>
                </td>
                <td class="texto ">
                    <?php echo $row['nome_sala'] ?>
                </td>
                <td class="texto ">
                    <?php echo $row['capacidade'] ?>
                </td>
                <td class="texto ">
                    <button class="btn btn-success" data-title="Requisitar" data-toggle="modal" href="#myModalrequisitar<?php echo $id_sala;?>">Requisitar</button>
                </td>



                <!-- Modal Requisitar-->
                <div class="modal fade" id="myModalrequisitar<?php echo $id_sala;?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <?php echo form_open_multipart('Privado_c/requisitar_Sala') ?>
                            <div class="modal-header">
                                <h4 class="modal-title custom_align" id="Heading">Requisitar Sala</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <input class="form-control " type="hidden" name="id_user" id="id_user" value="<?php echo $this->session->userdata("usuario_logado")[0]['id'] ?>">

                                </div>


                                <div class="modal-body">
                                    <div class="form-group">
                                        <input class="form-control " type="hidden" name="id_sala" id="id_sala" value="<?php echo $id_sala ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nome Sala</label>
                                        <input disabled class="form-control " type="text" name="nome_sala" id="nome_sala" value="<?php echo $row['nome_sala'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Capacidade</label>
                                        <input disabled class="form-control " type="text" name="capacidade" id="capacidade" value="<?php echo $row['capacidade'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Disponibilidade</label>
                                        <input disabled class="form-control " type="text" name="disponibilidade" id="disponibilidade" value="<?php
                                                            if ($row['disponibilidade']==1) {
                                                            echo " Disponível ";
                                                            }else{
                                                                echo "Indisponível ";
    
                                                                }
                                                            
                                                        ?>">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">Data de inicio</label>
                                        <input type="date" id="bida" name="data_inicio" style="color:black;" required min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d',strtotime('+12 months')); ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Data de entrega</label>
                                        <input type="date" id="biday" name="data_fim" style="color:black;" onchange='compareDates()' min="<?php echo date('Y-m-d'); ?>"
                                            max="<?php echo date('Y-m-d',strtotime('+12 months')); ?>">
                                    </div>


                                    <div class="form-group">
                                        <label>Hora de inicio:
                                            <input type="time" class="form-control" name="hora_inicio" value="08:00"> Hora de Fim:
                                            <input class="form-control" type="time" name="hora_fim" value="18:00">
                                        </label>

                                    </div>

                                    <div class="modal-footer ">
                                        <button type="submit" class="btn btn-success btn-lg" style="width: 100%;" onclick='compareDates()'>
                                            <span class="glyphicon glyphicon-ok-sign"></span>Requisitar</button>
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
    <?php }  ?>
    </div>

    <!-- Scipt para fazer um alerta -->
    <script>

        function compareDates() {
            var startDate = Date.parse(document.getElementById('biday').value);
            var today = Date.parse(document.getElementById('bida').value);
            if (!isNaN(startDate) && startDate < today) {
                alert("Data inicial maior que a final");
            }
        }

    </script>