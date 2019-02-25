<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="registo" class="well well-sm form-horizontal">



                <!-- Mensagem de err quando não consegue dar login -->
                <?php if(isset($erros['mensagens'])) :?>
                
            <?php echo $erros['mensagens'];  ?>
            
            <?php endif;?>
                <?php echo form_open_multipart('Privado_c/perfil') ?>
                    <fieldset>
                        <legend class="text-center header">Editar Perfil</legend>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="far fa-comment bigicon"></i></span>
                            <div class="col-md-8">
                                <input  name="name" type="text"  placeholder="Assunto" value="<?php echo $this->session->userdata("usuario_logado")[0]['nome'] ?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="name" name="username" type="text" value="<?php echo $this->session->userdata("usuario_logado")[0]['username'] ?>" placeholder="username" class="form-control">
                            </div>
                        </div>
                     
                        <div class="form-group"><i class="">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-envelope-square bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="email" name="email" type="text" value="<?php echo $this->session->userdata("usuario_logado")[0]['email'] ?>" placeholder="Endereço de Email" class="form-control">
                            </div>
                        </div>
                   
                        <!-- Message body -->
                
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-key bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="password" name="password" type="text" placeholder="Password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                            <div class="col-md-8">
                                <input id="Confirm" name="confirmar" type="text" placeholder="Confirmar Password" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                            <div class="col-md-8">
                                <img height="100px" width="100px" class="imagem_logo" src="<?php echo base_url($this->session->userdata("usuario_logado")[0]['imagem'])?>">
                                <input type="file" name="postimage" id="fileToUpload">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class=""></i></span>
                            <div class="col-md-8">
                                <input id="Confirm" name="confirm_altera" type="password" placeholder="Password confirmação" class="form-control">
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