<div class="container">
    <div class = "row">

    <br><br><br>
    <h2 id="teste1"> Aqui apresentamos a lista de todas as salas do nosso estabelecimento </h2>
        <!-- <div class="form-group col-md-12"> -->
                  
        <?php 
                    foreach ($sala as $row){?>
                <div class="form-group col-md-6">




                        <img height="200" width="350" src="<?php echo base_url($row['imagem'])?>"><br>
                        <?php echo $row['tipo_sala'] ?><br>
                        
                        <?php echo $row['nome_sala'] ?><br>
                        <?php echo $row['capacidade'] ?><br>
                    
                   
                       

               
                </div>
                <?php } ?>
            
       
</div>
</div>