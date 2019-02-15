<!-- inicio do footer -->
<!-- fundo da pagina, deve ter o scripts necessarios para as paginas todas -->
<footer>
                <div class="bg-primary footer">
                        <div class="container">
                            <div class="row m-space">
                                <div class="col-md-6 col-xs-12">
                               
                                    <p>&copy 2019 - Todos os direitos reservados  </p>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <p>	&reg rentacar.com by 
                                    <?php if(($this->session->userdata("login_user_sucesso")) || ($this->session->userdata("login_sucesso"))){ ?> Duarte Leça</p>
                                        <?php } else{?>
                                    <a href="<?php echo base_url('utilizador/login') ?>">Duarte Leça</a></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

        </footer>

            <!-- fim do footer -->

            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  



</body>

</html>