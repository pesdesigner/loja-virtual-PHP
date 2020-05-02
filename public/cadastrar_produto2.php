<?php require_once("../conexao/conexao.php"); ?>
<?php
    session_start();
    if(!isset($_SESSION["user_portal"])){
        header("Location:adm.php");
    }
    // ====================================

    // inserção estado
    if(isset($_POST["nomeproduto"])){
        $nomeproduto = utf8_decode($_POST["nomeproduto"]);
        $descricao = utf8_decode($_POST["descricao"]);
        $codigobarra = $_POST["codigobarra"];
        $tempoentrega = $_POST["tempoentrega"];
        $precorevenda = $_POST["precorevenda"];
        $precounitario = $_POST["precounitario"];
        $estoque = $_POST["estoque"];
        $imagemgrande = utf8_decode($_POST["imagemgrande"]);
        $imagempequena = utf8_decode($_POST["imagempequena"]);
        $descontinuado = $_POST["descontinuado"];
        $fornecedorID = $_POST["fornecedorID"];
        $categoriaID = $_POST["categoriaID"];


        $inserir = "INSERT INTO produtos ";
        $inserir .= "(nomeproduto, descricao, codigobarra, tempoentrega, precorevenda, precounitario, estoque, imagemgrande, imagempequena, descontinuado, fornecedorID, categoriaID) ";
        $inserir .= "VALUES ";
        $inserir .= "('$nomeproduto', '$descricao', '$codigobarra', $tempoentrega, $precorevenda, $precounitario, $estoque, '$imagemgrande', '$imagempequena', $descontinuado, $fornecedorID, $categoriaID)";

        $operacao_inserir = mysqli_query($conn, $inserir);
        if(!$operacao_inserir){
            die("Erro no banco ao inserir dados");
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
    <form class="s6 offset-s3" action="cadastrar_produto.php" method="post">

      <div class="row">

        <div class="input-field col s12">
          <input id="first_name" name="nomeproduto" type="text" class="validate">
          <label for="first_name">Nome do produto</label>
        </div>

        <div class=" col s12">
        <select name="categorias" class="browser-default">
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
          <input id="cod" name="codigobarras" type="text" class="validate">
          <label for="cod">000000-000000</label>
        </div>

        <div class="input-field col s12">
          <input id="entrega" name="tempoentrega" type="number" class="validate">
          <label for="entrega">Prazo de entrega</label>
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
          <input id="estoque" name="estoque" type="number" class="validate">
          <label for="estoque">Estoque</label>
        </div>

        <div class="col s12">
        <select name="fornecedores" class="browser-default">
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
        <div class="file-field input-field">
        <div class="btn btn-large">
        <i class="material-icons right">add_to_photos</i><span>Inserir</span>
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
        <!-- imagem pequena -->
        <div class="file-field input-field">
        <div class="btn btn-large">
        <i class="material-icons right">add_to_photos</i><span>Inserir</span>
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

        <div class="input-field col s12">
          <input id="descontinuado" name="descontinuado" type="number" class="validate">
          <label for="descontinuado">Produto descontinuado</label>
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


