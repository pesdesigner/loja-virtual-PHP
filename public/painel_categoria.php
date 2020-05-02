<ul class="collection with-header">
            <li class="collection-header"><a href="in_cat.php" class="btn-floating btn-small waves-effect waves-light blue right"><i class="material-icons">add</i></a><h5>Cadastro de categorias</h5></li>
     
            <?php while($registro = mysqli_fetch_assoc($categorias)){ ?>
            
            <li class="collection-item">
         
                <a href="del_cat.php?codigo=<?php echo $registro['categoriaID'] ?>" class="btn-floating btn-small waves-effect waves-light red right">
                    <i class="material-icons">delete</i>
                </a>

                <a href="alt_cat.php?codigo=<?php echo $registro['categoriaID'] ?>" class="btn-floating btn-small waves-effect waves-light green right">
                    <i class="material-icons">mode_edit</i>
                </a>
               
            <p><?php echo(utf8_encode($registro["nomecategoria"]))?></p>
            
            </li>

            <? } ?>
</ul>