
<div class="container mostrasalas">
<!-- Mensagem de err quando não consegue dar login -->
<?php if($this->session->flashdata("Equipamento_sucesso")) :?>
    <p class ="alert alert-success"><?= $this->session->flashdata("Equipamento_sucesso")   ?></p>
    <?php endif ?>





    <div class="form-group col-md-12">
        <?php echo form_open('Publico_c/mostra_equipamento') ?>
        <select style="color:black" name="procura_equipamento" class="form-control">
            <option value="" selected>Tipo de Equipamento</option>
            <?php foreach($equipamento as $rows){
                    echo "<option value=".$rows['nome'].">".$rows['nome'] ."</option>";
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
                <th>Nome</th>
                <th>Quantidade Disponível</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sala as $row){?>
            <tr>
                <td>
                    <img height="50%" width="35%" class="imagem_salas" src="<?php echo base_url($row['imagem'])?>">
                </td>
                <td class="texto ">
                    <?php echo $row['nome'] ?>
                </td>
                <td class="texto ">
                    <?php echo $row['quantidade'] ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>

    </table>
</div>