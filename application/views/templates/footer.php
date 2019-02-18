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

     
  



</body>

</html>