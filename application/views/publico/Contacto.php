
<?php if ($this->session->userdata("usuario_logado"))  { 
    redirect(base_url('home'));
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="registo" class="well well-sm form-horizontal">

                <!-- Mensagem de erro -->
                <?php if (isset($erros['mensagens'])) :?>
                <?php echo $erros['mensagens'];  ?>
                <?php endif; ?>


                <?php echo form_open('Publico_c/Contacto') ?>
                <fieldset>
                    <legend class="text-center header">Contacte-nos!</legend>
                    <div class="form-group">
                        <span class="col-md-1 col-md-offset-2 text-center">
                            <i class="far fa-comment bigicon"></i>
                        </span>
                        <div class="col-md-8">
                            <label>Assunto</label>
                            <input name="assunto" type="text" placeholder="Assunto" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <span class="col-md-1 col-md-offset-2 text-center">
                            <i class="fas fa-user bigicon"></i>
                        </span>
                        <div class="col-md-8">
                            <label>Nome</label>
                            <input id="name" name="name" type="text" value="<?php echo $this->session->userdata(" usuario_logado ")[0]['nome'] ?>" placeholder="Nome"
                                class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <i class="">
                            <span class="col-md-1 col-md-offset-2 text-center">
                                <i class="fas fa-envelope-square bigicon"></i>
                            </span>
                            <div class="col-md-8">
                                <label>Email</label>
                                <input id="email" name="email" type="text" value="<?php echo $this->session->userdata(" usuario_logado ")[0]['email'] ?>"
                                    placeholder="Endereço de Email" class="form-control">
                            </div>
                    </div>

                    <!-- Message body -->

                    <div class="form-group">
                        <span class="col-md-1 col-md-offset-2 text-center">
                            <i class="fas fa-pen-nib bigicon"></i>
                        </span>
                        <div class="col-md-8">
                            <textarea class="form-control" id="message" name="message" placeholder="Introduza sua mensagem aqui..." rows="5"></textarea>
                        </div>
                    </div>


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