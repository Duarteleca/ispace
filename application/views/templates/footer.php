<!-- inicio do footer -->
<!-- fundo da pagina, deve ter o scripts necessarios para as paginas todas -->
<footer>
                <div class="appendix text-center">
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

        <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

            <!-- Include jQuery -->
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script> -->



<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
  



</body>

</html>