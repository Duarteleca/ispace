<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="registo" class="well well-sm form-horizontal">

                <?php echo form_open('Privado_c/inserir_sala') ?>
                    <fieldset>
                        <legend class="text-center header">Inserir Sala</legend>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="tiposala" name="tiposala" type="text" placeholder="Tipo Sala" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                            <div class="col-md-8">
                                <input id="capaciadade" name="capaciadade" type="Number" placeholder="capaciadade" class="form-control">
                            </div>
                        </div>

                        <div class="form-group"><i class="">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-envelope-square bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="disponibilidade" name="disponibilidade" type="text" placeholder="disponibilidade" class="form-control">
                            </div>
                        </div>
                   
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-key bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="foto" name="foto" type="text" placeholder="foto" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                            <div class="col-md-8">
                                <input id="nomesala" name="nomesala" type="text" placeholder="Nome da Sala" class="form-control">
                            </div>
                        </div>

        
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>