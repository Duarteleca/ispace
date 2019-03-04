<div class="container mostrasalas">

    <!-- <h2 >Salas que podem ser requisitadas no nosso estabelecimento </h2> -->
    <?php echo form_open_multipart('Privado_c/adicionar_Equipamento_Requisito') ?>
    <!-- <div class="form-group col-md-12"> -->
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Selecionar /Quandidade Necessária</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipamento as $row){?>
            <?php $id_equipamento = $row['id'];  ?>


            <tr>
                <td>
                    <img height="50%" width="50%" class="imagem_salas" src="<?php echo base_url($row['imagem'])?>">
                </td>
                <td class="texto ">
                    <?php echo $row['nome'] ?>
                </td>
                <td class="texto ">
                    <?php echo $row['quantidade'] ?>
                </td>
                <td class="text">
                    <input name="checkname[]" type="checkbox" value="<?php echo $id_equipamento ?>">
                    <input name="numero[]" type="number">
                </td>

            </tr>

            <?php } ?>

        </tbody>

    </table>
    <div class="form-group">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-lg">Adicionar equipamento/s à requisição</button>
        </div>

    </div>
    <?php echo form_close() ?>
</div>