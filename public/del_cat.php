<?php require_once("../conexao/conexao.php"); ?>
<?php
    session_start();
    if(!isset($_SESSION["user_portal"])){
        header("Location:adm.php");
    }
    // ====================================
    if(isset($_POST["nomecategoria"])){
      $cID = $_POST["categoriaID"];

      // obj para excluir
      $del = "DELETE FROM categorias ";
      $del .= "WHERE categoriaID = {$cID} ";

      $operacao_deletar = mysqli_query($conn, $del);
      if(!$operacao_deletar){
        die("Erro ao deletar categoria");
      } else {
        header("Location: painel_adm.php?codigo=1");
      }
    }
    
    // consultar categorias
    $cat = "SELECT * ";
    $cat .= "FROM categorias ";
    if(isset($_GET["codigo"])){
      $id = $_GET["codigo"];
      $cat .= "WHERE categoriaID = {$id} ";
    } else {
      $cat .= "WHERE categoriaID = 1 ";
    }

    $con_cat = mysqli_query($conn, $cat);
    if(!$con_cat){
      die("Falha ao buscar categoria");
    }

    $info_categoria = mysqli_fetch_assoc($con_cat);

?>

<?php 
 include_once("_incluir/head.php");
 include_once("_incluir/nav_adm.php");
?>

<div class="container main_cadastro">

    <h5 class="center">Excluir categoria</h5>
    <div class="divider"></div>

    <div class="row">
    <form class="s6 offset-s3" action="del_cat.php" method="post">

      <div class="row">

        <div class="input-field col s12">
          <input id="first_name" name="nomecategoria" value="<?php echo utf8_encode($info_categoria["nomecategoria"])?>" type="text" class="validate">
          <label for="first_name">Nome categoria</label>
        </div>
 
        <div class="input-field col s12">
          <input id="id_t" name="categoriaID" value="<?php echo $info_categoria["categoriaID"]?>" type="hidden">
          <label for="id_t"></label>
        </div>

      </div>

    <button class="btn waves-effect waves-light input-field col s12" type="submit">Excluir categoria
    </button>

    </form>
    <a href="painel_adm.php?codigo=1" class="btn waves-effect waves-light input-field col s12 red">Voltar</a>


  </div>
      

</div>

<?php 
 include_once("_incluir/footer.php");
?>


