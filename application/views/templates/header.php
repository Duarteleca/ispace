<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>iSpace</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <link rel="stylesheet" type="text/css"  href="https://bootswatch.com/4/flatly/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">
         <link rel="stylesheet" type="text/css" media="screen" href="/ispace/assets/css/style.css" />
   

</head>

<body>

<!-- menu de inicio-->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">


    <!-- log do site -->
    <div class="navbar-header">
        <a href="<?php echo base_url('home')?>">
              <img alt="brand" src="<?php echo base_url('assets/img/logo.png') ?>">
        </a> 
    </div>
          <div class="collapse navbar-collapse" id="navbarColor01">
              <ul class="navbar-nav mr-auto">
                      <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url('home')?>">Inicial <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('Equipamento')?>">Equipamento</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('Salas')?>">Salas</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('Salas')?>">Contacto</a>
                      </li>
              </ul>


            <!-- Colocar o log in à direita -->
              <ul class="navbar-nav mr-auto navbar-right" >
                    <li class=""><a>

                    <!-- Login -->
                      <li class="nav-item">
                          <li class="dropdown">
                              <a class="nav-link" href="#" id="login" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span> Login</a>

                            <div class="dropdown-menu"  style="padding: 15px; padding-bottom: 10px;">
                                <?php echo form_open('Privado_c/validacao_login') ?>

                                      <input class="form-control login" type="text" name="username" placeholder="Username.." />
                                      <br>
                                      <input class="form-control login" type="password" name="password" placeholder="Password.."/>
                                      <br>
                                      <input class="btn btn-primary" type="submit" name="submit" value="login" /> 
                                      <br>
                                      <a href="<?php echo base_url('Registo')?>">Registar</a>
                                      <br>
                                      <a href="<?php echo base_url('RecuperarPass')?>">Recuperar Pass</a>
                                </form>
                            </div>     
                        </li>
              </ul>           
        </div>  
  </div>
</nav>
<!-- fim do Navigation -->