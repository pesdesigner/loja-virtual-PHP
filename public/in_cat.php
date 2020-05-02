<?php require_once("../conexao/conexao.php"); ?>
<?php
    session_start();
    if(!isset($_SESSION["user_portal"])){
        header("Location: adm.php");
    }
    // ====================================

    // inserção estado
    if(isset($_POST["nomecategoria"])){
        $categoria = utf8_decode($_POST["nomecategoria"]);

        $inserir = "INSERT INTO categorias ";
        $inserir .= "(nomecategoria) ";
        $inserir .= "VALUES ";
        $inserir .= "('$categoria')";

        $operacao_inserir = mysqli_query($conn, $inserir);
        if(!$operacao_inserir){
            die("Erro no banco ao inserir a categoria no banco de dados");
        }
    }

?>

<?php 
 include_once("_incluir/head.php");
 include_once("_incluir/nav_adm.php");
?>

<div class="container main_cadastro">

    <h5 class="center">Cadastrar categoria</h5>
    <div class="divider"></div>

    <div class="row">
    <form class="s6 offset-s3" action="in_cat.php" method="post">

    <div class="row">

        <div class="input-field col s12">
          <input id="first_name" name="nomecategoria" type="text" class="validate">
          <label for="first_name">Nome categoria</label>
        </div>
    
    </div>
    <button class="btn waves-effect waves-light input-field col s12" type="submit">Inserir dados
    </button>

    </form>
    <a href="painel_adm.php?codigo=1" class="btn waves-effect waves-light input-field col s12 red">Voltar</a>

  </div>

</div>

<?php 
 include_once("_incluir/footer.php");
?>


