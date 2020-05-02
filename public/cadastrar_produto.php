<?php 
    session_start();
    if(!isset($_SESSION["user_portal"])){
        header("Location:adm.php");
    }
?>
<?php require_once("../conexao/conexao.php"); ?>
<?php include_once("_incluir/funcoes.php"); ?>

<?php
    // conferir se a navegacao veio pelo preenchimento do formulario
    if(isset($_POST["nomeproduto"])){
        $resultado1 = publicarImagem($_FILES['foto_grande']);
        $resultado2 = publicarImagem($_FILES['foto_pequena']);

     //   print_r($_FILES['foto_grande']);
     //   print_r($_FILES['foto_pequena']);
     
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

        $descontinuado = 1;
        $fornecedorID = $_POST["fornecedorID"];
        $categoriaID = $_POST["categoriaID"];
        // Insercao no banco
      $inserir = "INSERT INTO produtos ";
      $inserir .= "(nomeproduto, descricao, codigobarra, tempoentrega, precorevenda, precounitario, estoque, imagemgrande, imagempequena, descontinuado, fornecedorID, categoriaID) ";
      $inserir .= "VALUES ";
      $inserir .= "('$nomeproduto', '$descricao', '$codigobarra', $tempoentrega, $precorevenda, $precounitario, $estoque, '$imagem_grande', '$imagem_pequena', $descontinuado, $fornecedorID, $categoriaID)";

    $qInserir = mysqli_query($conn, $inserir);
        if(!$qInserir){
            die("Erro no banco ao inserir dados");
        } else {
            $mensagem = "Inserção ocorreu com sucesso!";
        }
    }
   
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

    <h5 class="center">Cadastrar produto</h5>
    <div class="divider"></div>

    <div class="row">
    <form class="s6 offset-s3" action="cadastrar_produto.php" method="post" enctype="multipart/form-data">

      <div class="row">

        <div class="input-field col s12">
          <input id="first_name" name="nomeproduto" type="text" class="validate">
          <label for="first_name">Nome do produto</label>
        </div>

        <div class=" col s12">
        <select name="categoriaID" class="browser-default">
            <option value="" disabled selected>Selecione a Categoria</option>
            <?php 
                while($linha = mysqli_fetch_assoc($lista_categorias)){
            ?>
            <option value="<?php echo $linha["categoriaID"]; ?>">
                <?php echo utf8_encode($linha["nomecategoria"]);?>
            </option>

            <?php } ?>
        </select>
        </div>
   
        <div class="input-field col s12">
          <input id="descr" name="descricao" type="text" class="validate">
          <label for="descr">Descriçao</label>
        </div>
  
        <div class="input-field col s12">
          <input id="cod" name="codigobarra" type="text" class="validate">
          <label for="cod">CNPJ: 000000-000000</label>
        </div>
        <!-- tempo de entrega -->

        <div class="col s12">
        <p>Tempo de entrega</p>
            <input class="with-gap" name="tempoentrega" type="radio" id="test1" value="5" />
            <label for="test1">5 dias</label>

            <input class="with-gap" name="tempoentrega" type="radio" id="test2" value="8" />
            <label for="test2">8 dias</label>

            <input class="with-gap" name="tempoentrega" type="radio" id="test3" value="15" checked />
            <label for="test3">15 dias</label>

            <input class="with-gap" name="tempoentrega" type="radio" id="test4" value="30" />
            <label for="test4">30 dias</label>
        </div>
        
        <div class="input-field col s12">
          <input id="precorevenda" name="precorevenda" type="number" class="validate">
          <label for="precorevenda">Preço de venda</label>
        </div>

        <div class="input-field col s12">
          <input id="precounitario" name="precounitario" type="number" class="validate">
          <label for="precounitario">Preço de unitário</label>
        </div>
        
        <div class="input-field col s12">
          <!-- campo escondido para iniciar estoque -->
          <input type="hidden" name="estoque" value="0">
          <input id="estoque" name="estoque" type="number" class="validate">
          <label for="estoque">Estoque</label>
        </div>

        <div class="col s12 space">
        <select name="fornecedorID" class="browser-default">
            <option value="" disabled selected>Selecione o Fornecedor</option>
            <?php 
                while($linha = mysqli_fetch_assoc($lista_fornecedores)){
            ?>
            <option value="<?php echo $linha["fornecedorID"]; ?>">
                <?php echo utf8_encode($linha["nomefornecedor"]);?>
            </option>

            <?php } ?>
        </select>
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
        <input type="checkbox" class="filled-in" id="filled-in-box" name="descontinuado" />
        <label for="filled-in-box">Produto descontinuado</label>
        </div>

      </div>

    <button class="btn waves-effect waves-light input-field col s12" type="submit">Inserir dados
    </button>

    </form>
    <a href="painel_adm.php" class="btn waves-effect waves-light input-field col s12 red">Voltar</a>

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



