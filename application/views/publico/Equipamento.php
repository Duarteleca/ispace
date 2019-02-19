<div class="container mostrasalas">
 

    <br><br><br>
    <div class="form-group col-md-6">

<?php echo form_open('Publico_c/mostra_equipamento') ?>


    <select style="color:black" name="search_sala" class="form-control">
        <option value="" selected>Tipo de sala</option>

        <?php
foreach($equipamento as $rows){
echo "<option value=".$rows['nome'].">".$rows['nome'] ."</option>";
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
                <div class="col-md-6  conteudo">


                    <div class="col-md-9 ">
                        <img height="100%" width="100%" class="imagem_salas" src="<?php echo base_url($row['imagem'])?>"><br>
                    </div>
                    <div class="col-md-3 texto_equipamento ">
                      
                        Nome: <?php echo $row['nome'] ?><br>
                        Quantidade: <?php echo $row['quantidade'] ?><br>
                        
                   
                    </div>
                    
                   
                       

               
                </div>
                <?php } ?>
            
       

</div>