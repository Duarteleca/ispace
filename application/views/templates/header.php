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
<<<<<<< HEAD
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
=======
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 
>>>>>>> 3d3c83a437d0fd8e879d9d1d27f1a03a7cee00a6
         <link rel="stylesheet" type="text/css" media="screen" href="/ispace/assets/css/style.css" />
         <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

 

</head>

<body>

<!-- menu de inicio-->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
<<<<<<< HEAD
  <div class="container">

    <!-- log do site -->
    <div class="navbar-header">
        <a href="<?php echo base_url('home')?>">
              <img alt="brand" src="<?php echo base_url('assets/img/logo.png') ?>">
        </a> 
    </div>
              <!-- Menu da nav bar -->
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
                            <a class="nav-link" href="<?php echo base_url('Contacto')?>">Contacto</a>
                          </li>
                  </ul>

                <!-- Colocar o log in à direita -->
                  <ul class="navbar-nav mr-auto navbar-right" >
                        <li class=""><a>
=======
<div class="container">
  <a class="navbar-brand" href="#"><img alt="brand" src="<?php echo base_url('assets/img/logo.png') ?>"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

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
        <a class="nav-link" href="#">Login</a>
      </li>
    </ul>
    
  </div>
>>>>>>> duarte

                          <!-- Se o utilizador tiver com a conta iniciada, mostra o username ao lado direito -->
                          <!-- usando o session->userdata -->
                            <a class="nav-link">
                                <?php
                                        if($this->session->userdata("usuario_logado")){                                     
                                            echo '  
                                            <li id="conta" class="userlogin">Conta : '.$this->session->userdata("usuario_logado")[0]['username'].'</a></li>';
                                        }
                                ?>
                            </a>
                        
                
                        <!-- Se tiver sessão iniciada, esconde o login -->
                        <?php if($this->session->userdata("usuario_logado")==false) { ?>

                              <li class="nav-item">
                                  <li class="dropdown">
                                      <a class="nav-link" href="#" id="login" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span> Login</a>

                                      <div class="dropdown-menu"  style="padding: 15px; padding-bottom: 10px;">
                                          <?php echo form_open('Publico_c/validacao_login') ?>

                                                <input class="form-control login" type="text" name="username" placeholder="Username.." />
                                                <br>
                                                <input class="form-control login" type="password" name="password" placeholder="Password.."/>
                                                <br>
                                                <input class="btn btn-primary" type="submit" name="submit" value="login" /> 
                                                <br>
                                                <a href="<?php echo base_url('Registo')?>">Registar</a>
                                          </form>
                                      </div>     
                                  </li>
                              </li>
                  </ul> 
                  
                  <!-- fecho o php do esconder login -->
                  <?php } ?>

                          <!-- Se tiver sessão inciada, mostra o logout, se não, esconde -->
                          <?php if($this->session->userdata("usuario_logado")==true) { ?> 
                            <!-- Butão de logout, com hred, para ir para o controlador e executar a função logout -->
                            <li><a  class="nav-link" id="logout" href="<?php echo site_url().'Publico_c/logout';?>" ><span  class="glyphicon glyphicon-user"></span> logout</a></li>
                              
                            <?php } ?>  
                          
                </div>  
  </div>
</nav>
<!-- fim do Navigation -->

 <?php if($this->session->flashdata("sucesso")) :?>
    <!-- Mensagem de Sucesso quando dá login -->
    <p class ="alert alert-success"> <?= $this->session->flashdata("sucesso")   ?>  </p>
    <?php endif ?>
    <!-- Mensagem de err quando não consegue dar login -->
    <?php if($this->session->flashdata("erro")) :?>
    <p class ="alert alert-danger"><?= $this->session->flashdata("erro")   ?></p>
    <?php endif ?>