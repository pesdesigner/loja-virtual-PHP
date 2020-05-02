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
                <ul class="collection with-header">
                    <li class="collection-header">
                         
                    <a href="del_pro.php?codigo=<?php echo $registro['produtoID'] ?>" class="btn-floating btn-small waves-effect waves-light red right">
                        <i class="material-icons">delete</i>
                    </a>

                    <a href="alt_pro.php?codigo=<?php echo $registro['produtoID'] ?>" class="btn-floating btn-small waves-effect waves-light green right">
                        <i class="material-icons">mode_edit</i>
                    </a>
                    
                    <h4><?php echo(utf8_encode($registro["nomeproduto"]))?></h4>
                    </li>
                    <li class="collection-item">
                        <a href="produto.php?codigo=<?php echo $registro['produtoID'] ?>">
                        <img class="activator" src="<?php echo($registro["imagemgrande"])?>">
                    </a></li>
                    <li class="collection-item">Tempo de entrega:<strong> <?php echo($registro["tempoentrega"])?></strong> dias.</li>
                    <li class="collection-item">Pre&ccedil;o unit&aacute;rio: <strong><?php  echo "R$ " , number_format($registro["precounitario"], 2,',','.')?></strong></li>
                    <li class="collection-item">Produto descontinuado: <strong>
                        <?php
                            echo($registro["descontinuado"] == true ) ? "sim" : "não";
                        ?></strong></li>
                    <br>
                    <li class="collection-item">Descrição:<p> <?php echo utf8_encode($registro["descricao"])?></p></li>


                </ul>

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