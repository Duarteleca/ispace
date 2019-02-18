<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="registo" class="well well-sm form-horizontal">



                <!-- Mensagem de err quando não consegue dar login -->
                <?php if(isset($erros['mensagens'])) :?>
                
            <?php echo $erros['mensagens'];  ?>
            
            <?php endif;                
        ?>
     


        
                <?php echo form_open('Publico_c/Contacto_form') ?>
                    <fieldset>
                        <legend class="text-center header">Contacte-nos!</legend>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="name" name="name" type="text" placeholder="Nome" class="form-control">
                            </div>
                        </div>
                     
                        <div class="form-group"><i class="">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-envelope-square bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="email" name="email" type="text" placeholder="Endereço de Email" class="form-control">
                            </div>
                        </div>
                   
                        <!-- Message body -->
                
                            <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fas fa-comment-alt bigicon"></i></span>
                            <div class="col-md-9">
                                <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
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