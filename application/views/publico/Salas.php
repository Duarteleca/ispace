<div class="container mostrasalas">
 

    <br><br><br>

    <div class="form-group col-md-6">

<?php echo form_open('Publico_c/mostra_salas') ?>


    <select style="color:black" name="search_sala" class="form-control">
        <option value="" selected>Tipo de sala</option>

        <?php
foreach($salas as $rows){
echo "<option value=".$rows['tipo_sala'].">".$rows['tipo_sala'] ."</option>";
}
?>
    </select>
</div>


<div class="form-group col-md-6 ">
<input type="submit" class="btn btn-info" name="submit" value="Pesquisa">
</div>
<br>
<?php echo form_close() ?>

    <!-- <h2 >Salas que podem ser requisitadas no nosso estabelecimento </h2> -->

        <!-- <div class="form-group col-md-12"> -->
                  
        <?php 
                    foreach ($sala as $row){?>
                <div class="col-md-12  conteudo">


                    <div class="col-md-8 ">
                        <img height="100%" width="100%" class="imagem_salas" src="<?php echo base_url($row['imagem'])?>"><br>
                    </div>
                    <div class="col-md-4 texto ">
                      
                        Tipo de sala: <?php echo $row['tipo_sala'] ?><br>
                        Nome da Sala: <?php echo $row['nome_sala'] ?><br>
                        Capacidade: <?php echo $row['capacidade'] ?>
                   
                    </div>
                    
                   
                       

               
                </div>
                <?php } ?>
                <div class="form-group col-md-12 text-center">
                    <?php echo $links; ?>
            
       

</div>