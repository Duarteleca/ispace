<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="registo" class="well well-sm form-horizontal">

                <?php echo form_open('Publico_c/Recuperar_pass') ?>
                <fieldset>
                    <legend class="text-center header">Recuperar Pass</legend>

                    <div class="form-group">
                        <i class="">
                            <span class="col-md-1 col-md-offset-2 text-center">
                                <i class="fas fa-envelope-square bigicon"></i>
                            </span>
                            <div class="col-md-8">
                                <input id="email" name="email" type="text" placeholder="Endereço de Email" class="form-control">
                            </div>
                    </div>

                    <!-- Message body -->




                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <input type="submit" class="btn btn-primary" name="submit" value="Enviar">
                        </div>
                    </div>
                </fieldset>
                <?php echo isset($error) ?  "<div class='alert alert-success' role='alert'>". $error ."</div>" : ''; ?>


                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>