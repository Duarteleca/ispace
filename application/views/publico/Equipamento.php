<div class="container mostrasalas">
 

    <br><br><br>
    <div class="form-group col-md-12">

<?php echo form_open('Publico_c/mostra_equipamento') ?>


    <select style="color:black" name="search_sala" class="form-control">
        <option value="" selected>Tipo de Equipamento</option>

        <?php
foreach($equipamento as $rows){
echo "<option value=".$rows['nome'].">".$rows['nome'] ."</option>";
}
?>
    </select>
</div>


<div class="form-group col-md-12 ">
<input type="submit" class="btn btn-info" name="submit" value="Pesquisa">
</div>
<br>
<?php echo form_close() ?>

    <!-- <h2 >Salas que podem ser requisitadas no nosso estabelecimento </h2> -->

        <!-- <div class="form-group col-md-12"> -->


        <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Quantidade</th>  
            </tr>
        </thead>
        <tbody>
        <?php    
                foreach ($sala as $row){?>
            <tr>
                  
            <td>   <img height="100%" width="70%" class="imagem_salas" src="<?php echo base_url($row['imagem'])?>"><br></td>
                   
                  
                      

             <td class="texto "><?php echo $row['nome'] ?><br></td>
             <td class="texto "><?php echo $row['quantidade'] ?><br></td>
                        
                   
             </tr>
            <?php } ?>
            
           
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Name</th>
                <th>Name</th>
                <th>Name</th>
               
            </tr>
        </tfoot>
    </table>