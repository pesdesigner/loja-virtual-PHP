<?php require_once("../conexao/conexao.php"); ?>
<?php
    session_start();

    if(!isset($_SESSION["user_portal"])){
        header("Location:login.php");
    }

    //======== end log

    if(isset($_GET["codigo"])){
        $produto_ID = $_GET["codigo"];
    } else {
        Header("Location: login.php");
    }

    // consulta
    $consulta = "SELECT *";
    $consulta .= " FROM produtos " ;
    $consulta .= " WHERE produtoID = {$produto_ID} ";

    $detalhe = mysqli_query($conn, $consulta);

    if(!$detalhe){
        die("Falha na consulta produtos");
    } else {
        $dados_detalhe = mysqli_fetch_assoc($detalhe);
        $produtoID = $dados_detalhe["produtoID"];
        $nomeproduto = $dados_detalhe["nomeproduto"];
    }

?>

<?php 
 include_once("_incluir/head.php");
 include_once("_incluir/nav.php");
?>

<nav>
    <div class="nav-wrapper light-blue darken-4">

        <div class="container">
            <div class="col s12">
            <a href="listagem.php" class="breadcrumb">home</a>
            <a href="produto.php?codigo=<?php echo $produtoID ?>" class="breadcrumb"><?php echo $nomeproduto ?></a>
            <a href="carrinho.php?codigo=<?php echo $produtoID ?>"class="breadcrumb">carrinho</a>
            <a href="#!" class="breadcrumb">pedido</a>
        </div>
    </div>

    </div>
  </nav>

<main>

<div class="container">
    <h4 class="center">Pedido realizado</h4>
</div>


</main>

<?php 
        //limpar a memória após a listagem
        mysqli_free_result($detalhe);
    ?>

<?php 
 include_once("_incluir/footer.php");
?>


