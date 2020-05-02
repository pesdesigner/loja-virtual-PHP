<?php
    session_start();
    if(!isset($_SESSION["user_portal"])){
        header("Location:adm.php");
    }
?>

<?php require_once("../conexao/conexao.php"); ?>
<?php include_once("_incluir/funcoes.php"); ?>

<?php
    // ====================================
      if(isset($_POST["nomeproduto"])){
        $resultado1 = publicarImagem($_FILES['foto_grande']);
        $resultado2 = publicarImagem($_FILES['foto_pequena']);

        $mensagem1 = $resultado1[0]; 
        $mensagem2 = $resultado2[0];

        $nomeproduto = utf8_decode($_POST["nomeproduto"]);
        $descricao = utf8_decode($_POST["descricao"]);
        $codigobarra = $_POST["codigobarra"];
        $tempoentrega = $_POST["tempoentrega"];
        $precorevenda = $_POST["precorevenda"];
        $precounitario = $_POST["precounitario"];
        $estoque = $_POST["estoque"];

        $imagem_grande  = $resultado1[1];
        $imagem_pequena = $resultado2[1];

        $_POST["descontinuado"]==true? $descontinuado = 1 : $descontinuado = 0; 

        $fornecedor = $_POST["fornecedores"];
        $categoria = $_POST["categorias"];
        $pID = $_POST["produtoID"];

        // obj para alterar
        $alt = "UPDATE produtos ";
        $alt .="SET ";
        $alt .="nomeproduto = '{$nomeproduto}', ";
        $alt .="descricao = '{$descricao}', ";
        $alt .="codigobarra = '{$codigobarra}', ";
        $alt .="tempoentrega = '{$tempoentrega}', ";
        $alt .="precorevenda = '{$precorevenda}', ";
        $alt .="precounitario = '{$precounitario}', ";
        $alt .="estoque = '{$estoque}', ";
        $alt .="imagemgrande = '{$imagem_grande}', ";
        $alt .="imagempequena = '{$imagem_pequena}', ";
        $alt .="descontinuado = '{$descontinuado}', ";
        $alt .="fornecedorID = '{$fornecedor}', ";
        $alt .="categoriaID = '{$categoria}' ";
        $alt .="WHERE produtoID = {$pID} ";

        $op_alt = mysqli_query($conn, $alt);
          if(!$op_alt){
              die("Erro no banco ao alterar dados");
          } else {
              header("Location: painel_adm.php?codigo=2");
          }
      }

    // consulta produtos
    $pr = "SELECT * ";
    $pr .= " FROM produtos ";
    if(isset($_GET["codigo"])){
      $id = $_GET["codigo"];
      $pr .= "WHERE produtoID = {$id} ";
    } else {
      $pr .= "WHERE produtoID = 1 ";
    }

    $con_produtos = mysqli_query($conn, $pr);

    if(!$con_produtos){
        die("Falha ao consultar produtos");
    }

    $info_produto = mysqli_fetch_assoc($con_produtos);

    // selecao categorias
    $select = "SELECT categoriaID, nomecategoria ";
    $select .= "FROM categorias ";
    $lista_categorias = mysqli_query($conn, $select);
    if(!$lista_categorias){
        die("Erro ao buscar categorias");
    }

    // selecao fornecedores
    $select = "SELECT fornecedorID, nomefornecedor ";
    $select .= "FROM fornecedores ";
    $lista_fornecedores = mysqli_query($conn, $select);
    if(!$lista_fornecedores){
        die("Erro ao buscar fornecedores");
    }
?>

<?php 
 include_once("_incluir/head.php");
 include_once("_incluir/nav_adm.php");
?>

<div class="container main_cadastro">

    <h5 class="center">Alterar produto</h5>
    <div class="divider"></div>
    <br>
    <div class="row">
    <form class="s6 offset-s3" action="alt_pro.php" method="post" enctype="multipart/form-data">

      <div class="row">

        <div class="input-field col s12">

          <input id="first_name" name="nomeproduto" value="<? echo utf8_encode($info_produto["nomeproduto"])?>" type="text" class="validate">
          <label for="first_name">Nome do produto</label>
        </div>

        <div class=" col s12">
        <br>
        <select name="categorias" class="browser-default">
            <?php 
                $minha_cat = $info_produto["categoriaID"];
                while($linha = mysqli_fetch_assoc($lista_categorias)){
                  $cat_principal = $linha["categoriaID"];
                if($minha_cat == $cat_principal){
            ?>
            <option value="<?php echo $linha["categoriaID"]; ?>" selected>
                <?php echo utf8_encode($linha["nomecategoria"]);?>
            </option>
            <?php
                } else {
            ?>
              <option value="<?php echo $linha["categoriaID"]; ?>">
                <?php echo utf8_encode($linha["nomecategoria"]);?>
              </option>
            <?php } } ?>
        </select>
        </div>
   
        <div class="input-field col s12">
        <br>
          <input id="descr" name="descricao" value="<? echo utf8_encode($info_produto["descricao"])?>" type="text" class="validate">
          <label for="descr">Descriçao</label>
        </div>
  
        <div class="input-field col s12">
          <input id="cod" name="codigobarra" value="<? echo $info_produto["codigobarra"]?>" type="text" class="validate">
          <label for="cod">CNPJ: 000000-000000</label>
        </div>
        <!-- tempo de entrega -->
        <div class="col s12">
        <p>Tempo de entrega</p>         
          <input class="with-gap" name="tempoentrega" type="radio" id="test1" value="5" <? if($info_produto["tempoentrega"] === "5"){echo 'checked';}?> />
          <label for="test1">5 dias </label>
          <input class="with-gap" name="tempoentrega" type="radio" id="test2" value="8" <? if($info_produto["tempoentrega"] === "8"){echo 'checked';}?> />
          <label for="test2">8 dias </label>
          <input class="with-gap" name="tempoentrega" type="radio" id="test3" value="15" <? if($info_produto["tempoentrega"] === "15"){echo 'checked';}?> />
          <label for="test3">15 dias </label>
          <input class="with-gap" name="tempoentrega" type="radio" id="test4" value="30" <? if($info_produto["tempoentrega"] === "30"){echo 'checked';}?> />
          <label for="test4">30 dias</label>
         
        </div>
        
        <div class="input-field col s12">
          <input id="precorevenda" name="precorevenda" value="<?php  echo "R$ " , number_format($info_produto["precorevenda"], 2,',','.')?>" type="text" class="validate">
          <label for="precorevenda">Preço de venda</label>    
        </div>

        <div class="input-field col s12">
          <input id="precounitario" name="precounitario" value="<?php  echo "R$ " , number_format($info_produto["precounitario"], 2,',','.')?>" type="text" class="validate">
          <label for="precounitario">Preço de unitário</label>
        </div>
        
        <div class="input-field col s12">
          <!-- campo escondido para iniciar estoque -->
          <input id="estoque" name="estoque" value="<? echo $info_produto["estoque"]?>" type="number" class="validate">
          <label for="estoque">Estoque</label>
        </div>

        <div class="col s12 space">
        <select name="fornecedores" class="browser-default">
            <?php 
                $meu_for = $info_produto["fornecedorID"];
                while($linha = mysqli_fetch_assoc($lista_fornecedores)){
                  $for_principal = $linha["fornecedorID"];
                if($meu_for == $for_principal){
            ?>
            <option value="<?php echo $linha["fornecedorID"]; ?>" selected>
                <?php echo utf8_encode($linha["nomefornecedor"]);?>
            </option>
            <?php
                } else {
            ?>
            <option value="<?php echo $linha["fornecedorID"]; ?>" >
                <?php echo utf8_encode($linha["nomefornecedor"]);?>
            </option>
            <?php } } ?>
        </select>
        </div>

        <div class="col s12 center-align">
          <br>
        <div class="row valign-wrapper">
            <div class="col s6">
            <div class="card-image">
                  <img class="activator" src="<?php echo($info_produto["imagemgrande"])?>">
              </div>
            </div>
            
            <div class="col s6">
              <div class="card-image">
                  <img class="activator" src="<?php echo($info_produto["imagempequena"])?>">             
              </div>
            </div>
        </div>
     
        <div class="row">
          <div class="col s6">
                <span class="card-title">Imagem grande</span>
          </div>
          <div class="col s6">
                <span class="card-title">Imagem pequena</span>
          </div>
        </div>
        <div class="divider"></div>
        </div>
     
        <!-- imagem grande -->
        <div class="col s12">
        <div class="file-field input-field">
        <div class="btn">
        <i class="material-icons left">add_to_photos</i><span>IMG</span>
        <input type="hidden" name="MAX_FILE_SIZE" value="614400">
        <input type="file" name="foto_grande" placeholder="Imagem grande">
        </div>

        <div class="file-path-wrapper">
        <input class="file-path validate" type="text" value="<?php
            if( isset($mensagem1) ) {
                echo $mensagem1;
            }    
        ?>"  placeholder="Inserir imagem grande">
        </div>  
        </div>
        </div>
        <!-- imagem pequena -->
        <div class="col s12 space">
        <div class="file-field input-field">
        <div class="btn">
        <i class="material-icons left">add_to_photos</i><span>IMG</span>
        <input type="hidden" name="MAX_FILE_SIZE" value="614400">
        <input type="file" name="foto_pequena">
        </div>

        <div class="file-path-wrapper">
        <input class="file-path validate" type="text" value="<?php
            if( isset($mensagem2) ) {
                echo $mensagem2;
            }    
        ?>" placeholder="Inserir imagem pequena">
        </div>  
        </div>
        </div>

        <div class="col s12">
        <input type="checkbox" class="filled-in" id="filled-in-box" name="descontinuado" <? if($info_produto["descontinuado"]==true){ echo 'checked'; }?> />
        <label for="filled-in-box">Produto descontinuado</label>
        </div>

      </div>

    <button class="btn waves-effect waves-light input-field col s12" type="submit">Inserir dados
    </button>

    </form>
    <a href="painel_adm.php?codigo=2" class="btn waves-effect waves-light input-field col s12 red">Voltar</a>

  </div>

</div>
<?php 
 include_once("_incluir/footer.php");
?>

<?php
  // Fechar as queries
    mysqli_free_result($lista_categorias);
    mysqli_free_result($lista_fornecedores);
?>