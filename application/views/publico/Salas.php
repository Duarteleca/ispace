<div class="container">

    <br><br><br>
    <h2> Aqui apresentamos a lista de todas as salas do nosso estabelecimento </h2>
    <table name="tabelacarros"  id="tabelacarros" class="table table-bordered table-condensed" >
        <thead>
            <tr id="titulotabela">
                <th>Salas</th>
            
            </tr>
        </thead>


        <tbody>
                  <?php 
                    foreach ($sala as $row){?>

                 
    <tr>



    
                        <td><?php echo $row['tipo_sala'] ?><br>
                        <?php echo $row['nome_sala'] ?><br>
                        <?php echo $row['capacidade'] ?></td>
                        
                        </tr>
                <?php } ?>

              
        </tbody>
    </table>
</div>