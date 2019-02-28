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
            <?php $id_tipologia = $row['tipologia_id'];  ?>    
            <?php $data_inicio = $row['data_inicio'];  ?>
            <?php $data_fim = $row['data_fim'];  ?>
            <?php $hora_inicio = $row['hora_inicio'];  ?>
            <?php $hora_fim = $row['hora_fim'];  ?>
            <?php $id_tipologia = $row['tipologia_id'];  ?>
                



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
                <button class="btn btn-warning" data-title="Edit" data-toggle="modal" href="#myModalEditarEquip<?php echo $id_requisicao  ?>">Editar</button>
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


                 <!-- Modal Editar requisição -->
                 <div class="modal fade" id="myModalEditarEquip<?php echo $id_requisicao  ?>" tabindex="-1" role="dialog" aria-labelledby="edit"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <?php echo form_open_multipart('Privado_c/edita_Requisicao') ?>
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
                                    <input class="form-control " type="hidden" name="id_tipologia" id="id_tipologia" value="<?php echo $id_tipologia  ?>">
                                </div>


                                <div class="form-group">
                                    <label for="from">De: </label>
                                    <input type="text" id="from" name="data_inicio" value="<?php echo $data_fim ?>">
                                    <label for="to"> até </label>
                                    <input type="text" id="to" name="data_fim" value="<?php echo $data_fim ?>">

                                </div>

                                <div class="form-group">
                                    <label for="from">Hora de inicio: </label>
                                    <input type="time" name="hora_inicio" value="<?php echo $hora_inicio ?>">
                                    <label for="from">Hora de Fim: </label>
                                    <input type="time" name="hora_fim" value="<?php echo $hora_fim ?>">


                                </div>



                                <div class="modal-footer ">
                                    <button type="submit" class="btn btn-success btn-lg" style="width: 100%;">
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
</div>

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css"
/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="jquery-1.11.3.min.js"></script>

<script type="text/javascript">
    $(function () {
        var dateToday = new Date();
        var dates = $("#from, #to").datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: "today",
            changeMonth: true,
            numberOfMonths: 2,
            minDate: dateToday,
            onSelect: function (selectedDate) {
                var option = this.id == "from" ? "minDate" : "maxDate",
                    instance = $(this).data("datepicker"),
                    date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
                dates.not(this).datepicker("option", option, date);
            }
        });
    });
</script>