<div class="container">

    <!-- Mensagem de err quando não consegue dar login -->
    <?php if ($this->session->flashdata("inseriu_sala_sucesso")) :?>
    <p class="alert alert-success">
        <?= $this->session->flashdata("inseriu_sala_sucesso")   ?>
    </p>
    <?php endif ?>

    <!-- Mensagem de erro ao inserir uma capacidade negativa -->
    <?php if ($this->session->flashdata("inseriu_capacidade_negativa")) :?>
    <p class="alert alert-danger">
        <?= $this->session->flashdata("inseriu_capacidade_negativa")   ?>
    </p>
    <?php endif ?>

    <div class="row">
        <div class="col-md-12">

            <!-- Mensagem de err quando não consegue dar login -->

            <div id="registo" class="well well-sm form-horizontal">

                <?php echo form_open_multipart('Privado_c/inserir_sala') ?>
                <fieldset>

                    <legend class="text-center header">Inserir Sala</legend>
                    <div class="col-md-2">
                        <img alt="brand" height="100%" width="100%" src="<?php echo base_url('assets/img/add.png') ?>"> </div>
                    <div class="col-md-10">

                        <div class="form-group">

                            <span class="col-md-1  text-center">
                                <i class=""></i>
                            </span>
                            <div class="col-md-8">
                                <select style="color:black" name="tiposala" class="form-control">
                                    <option value="" selected>Tipo de sala</option>
                                    <?php foreach ($salas as $rows) {
                                            echo "<option value=".$rows['tipo_sala'].">".$rows['tipo_sala'] ."</option>";
                                            } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1  text-center">
                                <i class=""></i>
                            </span>
                            <div class="col-md-8">
                                <input id="capacidade" name="capacidade" type="Number" placeholder="capacidade" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <i class="">
                                <span class="col-md-1 text-center">
                                    <i class=""></i>
                                </span>
                                <div class="col-md-8">
                                    <select style="color:black" name="disponibilidade" placeholder="disponibilidade" class="form-control">
                                        <option disabled value="">Disponibilidade:</option>
                                        <option value="0">Indisponivel</option>
                                        <option value="1">Disponivel</option>
                                    </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 text-center">
                                <i class=""></i>
                            </span>
                            <div class="col-md-8">
                                <input id="nomesala" name="nomesala" type="text" placeholder="Nome da Sala" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <i class="">
                                <span class="col-md-1 text-center">
                                    <i class=""></i>
                                </span>
                                <div class="col-md-8">
                                    <input type="file" name="postimage" id="fileToUpload">
                                </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>

                            <!-- Mensagem de sucesso -->
                            <?php if ($this->session->flashdata("iseriu_sala_sucesso")) :?>
                            <p class="alert alert-danger">
                                <?= $this->session->flashdata("iseriu_sala_sucesso")   ?>
                            </p>
                            <?php endif ?>

                        </div>
                    </div>
                </fieldset>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>