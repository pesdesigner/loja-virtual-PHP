<ul class="collection with-header">
            <li class="collection-header"><a href="in_pro.php" class="btn-floating btn-small waves-effect waves-light blue right"><i class="material-icons">add</i></a><h5>Cadastro de produtos</h5></li>
     
            <?php while($registro = mysqli_fetch_assoc($produtos)){ ?>
            
            <li class="collection-item">
         
                <a href="del_pro.php?codigo=<?php echo $registro['produtoID'] ?>" class="btn-floating btn-small waves-effect waves-light red right">
                    <i class="material-icons">delete</i>
                </a>

                <a href="alt_pro.php?codigo=<?php echo $registro['produtoID'] ?>" class="btn-floating btn-small waves-effect waves-light green right">
                    <i class="material-icons">mode_edit</i>
                </a>

                <a href="#modal?codigo=<?php echo $registro['produtoID'] ?>" class="btn-floating btn-small waves-effect waves-light orange right modal-trigger">
                    <i class="material-icons">assignment</i>
                </a>

            <!-- Modal Structure -->
            <div id="modal?codigo=<?php echo $registro['produtoID'] ?>" class="modal">
            <div class="modal-content">
            <div class="container">

<div class="row">
<?php while($registro = mysqli_fetch_assoc($produtos)){ ?>   
  <div class="col s4">
  
    <div class="card large">
        <div class="card-image waves-effect waves-block waves-light">
            <a href="produto.php?codigo=<?php echo $registro['produtoID'] ?>">
                <img class="activator" src="<?php echo($registro["imagemgrande"])?>">
            </a>
        </div>
        <div class="card-content">

        <span class="card-title activator grey-text text-darken-4"><?php echo utf8_encode($registro["nomeproduto"])?><i class="material-icons right">more_vert</i></span>
        
        <p>Tempo de entrega: <strong><?php echo($registro["tempoentrega"])?></strong></p>
        <p>Pre&ccedil;o unit&aacute;rio: <strong><?php  echo "R$" , number_format($registro["precounitario"], 2,',','.')?></strong></p>
        <p>Produto descontinuado: <strong>
            <?php
                echo($registro["descontinuado"] == true ) ? "sim" : "não";
            ?></strong></p>
        <br>
     
        <a class="waves-effect waves-light btn-large" href="produto.php?codigo=<?php echo $registro['produtoID'] ?>">Comprar  <i class="material-icons right">local_grocery_store</i></a>

        </div>
        <div class="card-reveal">

        <span class="card-title grey-text text-darken-4"><?php echo utf8_encode($registro["nomeproduto"])?><i class="material-icons right">close</i></span>
        
        <br>
        <a href="produto.php?codigo=<?php echo $registro['produtoID'] ?>">
                <img class="activator" src="<?php echo($registro["imagempequena"])?>">
        </a>

        <p><?php echo utf8_encode($registro["descricao"])?></p>

        </div>
        
    </div>
 </div>

<?php } ?>

</div>

</div>

            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
            </div>
            </div>

            <!-- Modal Structure -->
               
            <p><?php echo(utf8_encode($registro["nomeproduto"]))?></p>
            
            </li>

            <? } ?>
</ul>