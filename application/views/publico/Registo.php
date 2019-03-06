<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="registo" class="well well-sm form-horizontal">
                <!-- Mensagem de err quando não consegue dar login -->
                <?php if(isset($erros['mensagens'])) :?>
                <?php echo $erros['mensagens'];  ?>
                <?php endif;  ?>
                <?php echo form_open_multipart('Publico_c/registar_user') ?>
                <fieldset>
                    <legend class="text-center header">Registe-se!</legend>
                    <div class="form-group">
                        <span class="col-md-1 col-md-offset-2 text-center">
                            <i class="fas fa-user bigicon"></i>
                        </span>
                        <div class="col-md-8">
                            <label>Primeiro Nome</label>
                            <input id="name" name="name" type="text" value="<?php echo set_value('name'); ?>" placeholder="Primeiro Nome" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="col-md-1 col-md-offset-2 text-center">
                            <i class="fas fa-user bigicon"></i>
                        </span>
                        <div class="col-md-8">
                        <label>Nome Usuário</label>
                            <input id="Username" name="username" type="text" value="<?php echo set_value('username'); ?>" placeholder="Username" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <i class="">
                            <span class="col-md-1 col-md-offset-2 text-center">
                                <i class="fas fa-envelope-square bigicon"></i>
                            </span>
                            <div class="col-md-8">
                                <input id="email" name="email" type="text" value="<?php echo set_value('email'); ?>" placeholder="Endereço de Email" class="form-control">
                            </div>
                    </div>

                    <div class="form-group">
                        <span class="col-md-1 col-md-offset-2 text-center">
                            <i class="fas fa-key bigicon"></i>
                        </span>
                        <div class="col-md-8">
                            <label>Paswwrod</label>
                            <input id="password" name="password" type="password" placeholder="Password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="col-md-1 col-md-offset-2 text-center">
                            <i class="fas fa-key bigicon"></i>
                        </span>
                        <div class="col-md-8">
                            <label>Confirme a Password</label>
                            <input id="Confirm" name="confirm" type="password" placeholder="Confirmar Password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <i class="">
                            <span class="col-md-1 col-md-offset-2 text-center">
                                <i class=""></i>
                            </span>
                            <div class="col-md-8">
                                <input type="file" name="postimage" id="fileToUpload">
                                <div name="g-recaptcha" class="g-recaptcha" data-sitekey="6LdKr5AUAAAAABlVEsRPoI9TBtGkGnk2kHmX0kSv"></div>
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


<script>

var password = document.getElementById("password")
  , confirm_password = document.getElementById("Confirm");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Password diferente");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

</script>