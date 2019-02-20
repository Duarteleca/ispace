<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div id="registo" class="well well-sm form-horizontal">

                <?php echo form_open_multipart('Privado_c/inserir_equipamento') ?>
                <fieldset>
                    
                    <legend class="text-center header">Inserir Equipamento</legend>
                    <div  class="col-md-2"> <img alt="brand" height="100%" width="100%" src="<?php echo base_url('assets/img/add.png') ?>"> </div> 
                    <div  class="col-md-10"> 
                                <div class="form-group">
                                    <span class="col-md-1  text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <input id="nome_Equipamento" name="nome_Equipamento" type="text" placeholder="Nome Equipamento" class="form-control">
                                        </div>
                                </div>
                                        <div class="form-group">
                                            <span class="col-md-1  text-center"><i class=""></i></span>
                                                <div class="col-md-8">
                                                    <input id="quantidade" name="quantidade" type="Number" placeholder="Quantidade" class="form-control">
                                                </div>
                                        </div>

                                            <div class="form-group"><i class="">
                                                <span class="col-md-1 text-center"><i class=""></i></span>
                                                    <div class="col-md-8">
                                                        <input id="disponibilidade" name="disponibilidade" type="text" placeholder="disponibilidade" class="form-control">
                                                    </div>
                                            </div>

                                                        <div class="form-group"><i class="">
                                                                <span class="col-md-1 text-center"><i class=""></i></span>
                                                                    <div class="col-md-8">
                                                                        <input type="file" name="postimage" id="fileToUpload">
                                                                    </div>
                                                        </div>

                                                                <div class="form-group">
                                                                    <div class="col-md-12 text-center">
                                                                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                                                    </div>
                                                                </div>
                        </div> 
                </fieldset>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>