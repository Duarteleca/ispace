<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div id="registo" class="well well-sm form-horizontal">

                <?php echo form_open_multipart('Privado_c/inserir_sala') ?>
                <fieldset>
                    
                    <legend class="text-center header">Inserir Sala</legend>
                    <div  class="col-md-2"> <img alt="brand" height="100%" width="100%" src="<?php echo base_url('assets/img/add.png') ?>"> </div> 
                    <div  class="col-md-10"> 
                                <div class="form-group">
                                    <span class="col-md-1  text-center"><i class=""></i></span>
                                        <div class="col-md-8">
                                            <input id="tiposala" name="tiposala" type="text" placeholder="Tipo Sala" class="form-control">
                                        </div>
                                </div>
                                        <div class="form-group">
                                            <span class="col-md-1  text-center"><i class=""></i></span>
                                                <div class="col-md-8">
                                                    <input id="capaciadade" name="capaciadade" type="Number" placeholder="capaciadade" class="form-control">
                                                </div>
                                        </div>

                                            <div class="form-group"><i class="">
                                                <span class="col-md-1 text-center"><i class=""></i></span>
                                                    <div class="col-md-8">
                                                        <select style="color:black" name="disponibilidade" placeholder="disponibilidade" class="form-control" > 
                                                            <option disabled value="">Disponibilidade:</option> 
                                                            <option value="0">Indisponivel</option> 
                                                            <option value="1">Disponivel</option>     
                                                        </select>
                                                    </div>
                                            </div>
                                            
                                                    <div class="form-group">
                                                        <span class="col-md-1 text-center"><i class=""></i></span>
                                                            <div class="col-md-8">
                                                                <input id="nomesala" name="nomesala" type="text" placeholder="Nome da Sala" class="form-control">
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