<div class="container texto">
 

    <br><br><br>

    <!-- <h2 >Salas que podem ser requisitadas no nosso estabelecimento </h2> -->

        <!-- <div class="form-group col-md-12"> -->
                  
        <?php 
                    foreach ($sala as $row){?>
                <div class="form-group col-md-6">



                        <img height="300" width="500" src="<?php echo base_url($row['imagem'])?>"><br>
                        <span>
                        Tipo de sala: <?php echo $row['tipo_sala'] ?><br>
                        
                        Nome da Sala: <?php echo $row['nome_sala'] ?><br>
                        Capacidade: <?php echo $row['capacidade'] ?>
                    </span>
                    
                   
                       

               
                </div>
                <?php } ?>
            
       

</div>