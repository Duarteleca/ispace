
<div class="container mostrasalas">
<br><br><br>

    <div class="form-group col-md-12">
        <?php echo form_open('Publico_c/mostra_salas') ?>
        <select style="color:black" name="search_sala" class="form-control">
            <option value="" selected>Tipo de sala</option>
                <?php foreach($salas as $rows){
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
        if(!$this->session->userdata("usuario_logado")) { ?>

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
    <?php }else  {  ?>
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
            <?php foreach ($sala as $row){?>
                <?php $id_sala= $row['tipoid'] ?>
                
               
                               
                <tr>
                    <td><img height="50%" width="50%" class="imagem_salas" src="<?php echo base_url($row['imagem'])?>"></td>
                    <td class="texto ">   <?php echo $row['tipo_sala'] ?></td>
                    <td class="texto ">   <?php echo $row['nome_sala'] ?></td>
                    <td class="texto ">    <?php echo $row['capacidade'] ?></td>
                    <td class="texto ">   <button class="btn btn-success" data-title="Requisitar" data-toggle="modal" href="#myModalrequisitar<?php echo $id_sala;?>" >Requisitar</button></td>
                        


<!-- Modal Requisitar-->
<div class="modal fade"  id="myModalrequisitar<?php echo $id_sala;?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <?php echo form_open_multipart('Privado_c/requisitar_Sala') ?>
                          <div class="modal-header">
                            <h4 class="modal-title custom_align" id="Heading">Requisitar Sala</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>    
                          </div>
                          
                          <div class="modal-body">
                        <div class="form-group">
                                <input class="form-control " type="hidden" name="id_user" id="id_user" value="<?php echo $this->session->userdata("usuario_logado")[0]['id'] ?>">
                        </div>


                <div class="modal-body">
                        <div class="form-group">
                                <input class="form-control " type="hidden" name="id_sala" id="id_sala" value ="<?php echo $id_sala ?>">
                        </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nome Sala</label>
                                    <input disabled class="form-control " type="text" name="nome_sala" id="nome_sala" value ="<?php echo $row['nome_sala'] ?>">
                                </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Capacidade</label>
                                        <input disabled class="form-control " type="text" name="capacidade" id="capacidade" value ="<?php echo $row['capacidade'] ?>">
                                    </div>

                                        <div class="form-group">
                                                <label for="exampleInputEmail1">Disponibilidade</label>
                                                <input disabled class="form-control " type="text" name="disponibilidade" id="disponibilidade" 
                                                value ="<?php
                                                            if($row['disponibilidade']==1){
                                                            echo "Disponível";
                                                            }
                                                            else{
                                                            echo "Indisponível";

                                                            }
                                                        ?>">
                                        </div>

                                                       
                                                       <div class="form-group">
                                                            <label for="from">De: </label>
                                                            <input type="text" id="from" name="data_inicio" value="<?php echo date('Y-m-d'); ?>">
                                                            <label for="to"> até </label>
                                                            <input type="text" id="to" name="data_fim" value="<?php echo date('Y-m-d'); ?>">
                                                            
                                                        </div>

                                                        <!-- <div class="form-group">
                                                       
                                                        <label>Hora de inicio: <input type="text" id="timepicker" name="hora_inicio"  > Hora de Fim: <input type="text" id="timepicker1" name="hora_fim" ></label>
                                                        
                                        
                                                        </div> -->
                                                        <!-- <div id="calendariomain" class="form-group">
                                                            <label for="exampleInputEmail1">Dia Incio</label>
                                                            <input id="calendario" type= "date" name="data_inicio" value="<?php echo date('Y-m-d'); ?>"  max="">
                                                            <label for="exampleInputEmail1">Dia Fim</label>
                                                            <input id="calendario" type= "date" name="data_fim" value="<?php echo date('Y-m-d'); ?>" min="2019-01-01" max="">
                                                        </div>  -->

                                                        <div class="form-group">
                                                        <label for="from">Hora de inicio: </label>
                                                        
                                                        <input type="time" class="form-control"   name="hora_inicio"   value ="08:00"> 
                                                        <label for="from">Hora de fim: </label> 
                                                        <input class="form-control" type="time" name="hora_fim" value ="18:00">
                                                      
                                                         
                                                        </div> 


      
                                                    <div class="modal-footer ">
                                                        <button type="submit" class="btn btn-success btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Requisitar</button>
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

  

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<link href="style.css" rel="stylesheet" type="text/css"/>
<script src="jquery-1.11.3.min.js"></script>

<script type="text/javascript">
  $(function() {
    var dateToday = new Date();
var dates = $("#from, #to").datepicker({
   dateFormat: 'yy-mm-dd',
    defaultDate: "today",
    changeMonth: true,
    numberOfMonths: 2,
    minDate: dateToday,
    onSelect: function(selectedDate) {
        var option = this.id == "from" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
});
  });



//    $(function(){
//         $("#to").datepicker({ dateFormat: 'yy-mm-dd' });
//         $("#from").datepicker({ dateFormat: 'yy-mm-dd' }).bind("change",function(){
//             var minValue = $(this).val();
//             minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
//             minValue.setDate(minValue.getDate()+1);
//             $("#to").datepicker( "option", "minDate", minValue );
//         })
//     });
</script>
