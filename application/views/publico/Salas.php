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

