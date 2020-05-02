<?php require_once("../conexao/conexao.php"); ?>
<?php
    session_start();
    if(!isset($_SESSION["user_portal"])){
        header("Location:adm.php");
    }
    // ====================================
    if(isset($_POST["nomeproduto"])){
      $pID = $_POST["produtoID"];

      // obj para excluir
      $del = "DELETE FROM produtos ";
      $del .= "WHERE produtoID = {$pID} ";

      $operacao_deletar = mysqli_query($conn, $del);
      if(!$operacao_deletar){
        die("Erro ao deletar produto");
      } else {
        header("Location: painel_adm.php?codigo=2");
      }
    }
    // consulta lista produtos
    $pro = "SELECT * ";
    $pro .= "FROM produtos ";
    if(isset($_GET["codigo"])){
      $id = $_GET["codigo"];
      $pro .= "WHERE produtoID = {$id} ";
    } else {
      $pro .= "WHERE produtoID = 1 ";
    }

    $con_pro = mysqli_query($conn, $pro);
    if(!$con_pro){
        die("Falha ao consultar produtos");
    }
    $info_produto = mysqli_fetch_assoc($con_pro);

    // selecao categorias
    $select = "SELECT categoriaID, nomecategoria ";
    $select .= "FROM categorias ";
    $lista_categorias = mysqli_query($conn, $select);
    if(!$lista_categorias){
        die("Erro ao buscar categorias");
    }
?>

<?php 
 include_once("_incluir/head.php");
 include_once("_incluir/nav_adm.php");
?>

<div class="container main_cadastro">

    <h5 class="center">Excluir produto</h5>
    <div class="divider"></div>
    <br>
    <div class="row">
    <form class="s6 offset-s3" action="del_pro.php" method="post">

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

        <div class="col s12 center-align">
          <br>
        <div class="row valign-wrapper">
          
            <div class="card-image">
                  <img class="activator" src="<?php echo($info_produto["imagemgrande"])?>">
            </div>
        </div>

      </div>

      <div class="input-field col s12">
          <input id="id_t" name="produtoID" value="<?php echo $info_produto["produtoID"]?>" type="hidden">
          <label for="id_t"></label>
        </div>
      </div>

    <button class="btn waves-effect waves-light input-field col s12" type="submit">Excluir dados
    </button>

    </form>
    <a href="painel_adm.php?codigo=2" class="btn waves-effect waves-light input-field col s12 red">Voltar</a>

  </div>

</div>

<?php 
 include_once("_incluir/footer.php");
?>




