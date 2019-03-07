<!-- Para que um utilizador nao vá diretamento para pagina que colocar no link -->
<?php if ($this->session->userdata("usuario_logado")[0]['tipo'] == 0)
{ 
    redirect(base_url('home'));
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="registo" class="well well-sm form-horizontal">

                <!-- Mensagens -->
                <?php if (isset($erros['mensagens'])) :?>
                <?php echo $erros['mensagens'];  ?>
                <?php endif;?>

                <?php if ($this->session->flashdata("Registo_sucess")) :?>
                <p class="alert alert-success">
                    <?= $this->session->flashdata("Registo_sucess")   ?>
                </p>
                <?php endif ?>

                <!-- Alterar Perfil -->

                <?php echo form_open_multipart('Privado_c/atualizar_perfil') ?>
                <fieldset>
                    <legend class="text-center header">Alterar Perfil</legend>
                    <div class="form-group">

                        <span class="col-md-1 col-md-offset-2 text-center">
                            <i class="far fa-comment bigicon"></i>
                        </span>
                        <div class="col-md-8">
                            <label>Nome</label>
                            <input name="nome" type="text" placeholder="Assunto" value="<?php echo $this->session->userdata(" usuario_logado
                                ")[0]['nome'] ?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <span class="col-md-1 col-md-offset-2 text-center">
                            <i class="fas fa-user bigicon"></i>
                        </span>
                        <div class="col-md-8">
                            <label>User</label>
                            <input id="name" name="username" type="text" value="<?php echo $this->session->userdata(" usuario_logado
                                ")[0]['username'] ?>" readonly placeholder="username" class="form-control">
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
                                    readonly placeholder="Endereço de Email" class="form-control">
                            </div>
                    </div>

                    <div class="form-group">
                        <span class="col-md-1 col-md-offset-2 text-center">
                            <i class="fas fa-key bigicon"></i>
                        </span>
                        <div class="col-md-8">
                            <label>Confirmar Password</label>
                            <input id="Confirm" name="confirm_altera" type="password" placeholder="Confirmar atual Password" class="form-control">
                        </div>
                    </div>

                    <!-- Message body -->

                    <div class="form-group">
                        <span class="col-md-1 col-md-offset-2 text-center">
                            <i class="fas fa-key bigicon"></i>
                        </span>
                        <div class="col-md-8">
                            <label>Password</label>
                            <input id="password" name="password" type="password" placeholder="Nova Password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="col-md-1 col-md-offset-2 text-center">
                            <i class="fas fa-key bigicon"></i>
                        </span>
                        <div class="col-md-8">
                            <label>Repetir nova Password</label>
                            <input id="confirm" name="confirm" type="password" placeholder="Repetir Nova Password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <i class="">
                            <span class="col-md-1 col-md-offset-2 text-center">
                                <i class=""></i>
                            </span>
                            <div class="col-md-8">
                                <img height="60px" width="60px" class="imagem_logo" src="<?php echo base_url($this->session->userdata(" usuario_logado
                                    ")[0]['imagem'])?>">
                                <input type="file" name="postimage" id="fileToUpload">
                            </div>
                    </div>



                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <input type="submit" class="btn btn-primary" name="submit" value="Alterar">
                        </div>
                    </div>
                </fieldset>
                <?php echo isset($error) ?  "<div class='alert alert-success' role='alert'>". $error ."</div>" : ''; ?>



                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>


<!-- Comparar passwords quando vai mudar o perfil -->
<script>

    var password = document.getElementById("password")
        , confirm_password = document.getElementById("confirm");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Password diferente");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

</script>