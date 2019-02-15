
<div class="container photo_review">
<div class="container ">
        <?php echo form_open('publico/contato/'); ?>
           
            <div class="mapouter" id="map">
                <div class="gmap_canvas"><iframe width="100%" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=acin&t=&z=15&ie=UTF8&iwloc=&output=embed"
                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                </div>
            </div>
            <div class="form-group col-md-12  form_review  ">
            <div class="form-group col-md-12">
            <br> <i class="fa fa-phone">  </i> <label for="">Telefone: 96.......</label><br>
            <i class="fa fa-fax"> <label for="">Fax: 291......</label> </i><br>
            <i class="fa fa-envelope"> </i> <label for="">E-mail: contacto@rentacar.com</label><br>
            <i class="fa fa-map-marker"> </i> <label for="">Morada: ER 104, n.º42 A, 9350-203 Ribeira Brava - Madeira</label><br><br>

            <label >Envie Messagem:</label>

                <br><select style="color:black" name="departamento" required class="form-control">
                <option value="">Departamento:</option>
                <option value="Contabilidade">Contabilidade</option>
                <option value="Desenvolvimento">Desenvolvimento</option>
                <option value="Administração" >Administração</option>
                <option value="Design" >Design</option>
                </select>
                </div>
                <div class="form-group col-md-6">
                <label for="">Titulo</label>
                <input type="text" class="form-control" name="titulo" maxlength="100"  placeholder="Titulo" required >
            </div>

            <div class="form-group col-md-6">
                <label >Email</label>
                <input type="email" class="form-control" name="email"  placeholder="Email" title="ex: teste@rentacar.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" required >
            </div>

            <div class="form-group col-md-12">
                <label for="">Assunto</label>
                <textarea class="form-control" rows="3" name="assunto" maxlength="500" placeholder="Assunto" required ></textarea>
            </div>

            <div class="form-group col-md-12">
      
      <input type="submit" class="btn btn-primary" name="submit" value="Enviar">
      
    </div>
    <div class="form-group">
      
     
      <?php echo isset($error) ?  "<div class='alert alert-success' role='alert'>". $error ."</div>" : ''; ?>

      
      </div>
      </div>
            
        </form>
    </div>
</div>