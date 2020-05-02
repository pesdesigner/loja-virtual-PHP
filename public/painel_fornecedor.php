<ul class="collection with-header">
            <li class="collection-header"><a href="in_for.php" class="btn-floating btn-small waves-effect waves-light blue right"><i class="material-icons">add</i></a><h5>Cadastro de fornecedores</h5></li>
     
            <?php while($registro = mysqli_fetch_assoc($fornecedores)){ ?>
            
            <li class="collection-item">
         
                <a href="del_for.php?codigo=<?php echo $registro['fornecedorID'] ?>" class="btn-floating btn-small waves-effect waves-light red right">
                    <i class="material-icons">delete</i>
                </a>

                <a href="alt_for.php?codigo=<?php echo $registro['fornecedorID'] ?>" class="btn-floating btn-small waves-effect waves-light green right">
                    <i class="material-icons">mode_edit</i>
                </a>

                <a href="#modal?codigo=<?php echo $registro['fornecedorID'] ?>" class="btn-floating btn-small waves-effect waves-light orange right modal-trigger">
                    <i class="material-icons">assignment</i>
                </a>

            <!-- Modal Structure -->
            <div id="modal?codigo=<?php echo $registro['fornecedorID'] ?>" class="modal">
            <div class="modal-content">
                <ul class="collection with-header">
                    <li class="collection-header">
                         
                    <a href="del_for.php?codigo=<?php echo $registro['fornecedorID'] ?>" class="btn-floating btn-small waves-effect waves-light red right">
                        <i class="material-icons">delete</i>
                    </a>

                    <a href="alt_for.php?codigo=<?php echo $registro['fornecedorID'] ?>" class="btn-floating btn-small waves-effect waves-light green right">
                        <i class="material-icons">mode_edit</i>
                    </a>
                    
                    <h4><?php echo(utf8_encode($registro["nomefornecedor"]))?></h4>
                
                    </li>
                    <li class="collection-item"><strong>Endereço: </strong><?php echo utf8_encode($registro['endereco']) ?></li>
                    <li class="collection-item"><strong>Cidade: </strong><?php echo utf8_encode($registro['cidade']) ?></li>
                    <li class="collection-item"><strong>Estado: </strong>
                    <?php 
                        // selecao estados
                        $select = "SELECT estadoID, nome ";
                        $select .= "FROM estados ";
                        $lista_estados = mysqli_query($conn, $select);
                        if(!$lista_estados){
                            die("Erro ao buscar estados");
                        }
                        $meu_estado = $registro["estadoID"];
                        while($linha = mysqli_fetch_assoc($lista_estados)){
                            $estado_principal = $linha["estadoID"];
                            if($meu_estado == $estado_principal){
                    
                            echo utf8_encode($linha["nome"]);
                            }
                        }
                   ?>
                    </li>
                    <li class="collection-item"><strong>Telefone: </strong><?php echo $registro['telefone'] ?></li>
                </ul>

            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Fechar</a>
            </div>
            </div>

            <!-- Modal Structure -->
               
            <p><?php echo(utf8_encode($registro["nomefornecedor"]))?></p>
            
            </li>

            <? } ?>
</ul>