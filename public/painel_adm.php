<?php require_once("../conexao/conexao.php"); ?>
<?php

    session_start();
    if(!isset($_SESSION["user_portal"])){
        header("Location:adm.php");
    }

    // consulta lista transportadoras
    $consult_trans = "SELECT * ";
    $consult_trans .= " FROM transportadoras";

    $transportadoras = mysqli_query($conn, $consult_trans);

    if(!$transportadoras){
        die("Falha ao consultar transportadoras");
    }

    // consulta lista categorias
    $consult_cat = "SELECT * ";
    $consult_cat .= " FROM categorias";

    $categorias = mysqli_query($conn, $consult_cat);

    if(!$categorias){
        die("Falha ao consultar categorias");
    }

    // consulta lista produtos
    $consult_product = "SELECT * ";
    $consult_product .= " FROM produtos";

    $produtos = mysqli_query($conn, $consult_product);

    if(!$produtos){
        die("Falha ao consultar produtos");
    }

    // consulta lista fornecedores
    $consult_for = "SELECT * ";
    $consult_for .= " FROM fornecedores";

    $fornecedores = mysqli_query($conn, $consult_for);

    if(!$fornecedores){
        die("Falha ao consultar fornecedores");
    }

?>

<?php 
 include_once("_incluir/head.php");
 include_once("_incluir/nav_adm.php");
?>

<?php
if(!isset($_GET["codigo"])){ 
    include_once("menu_painel.php");
    include_once("painel_produto.php"); 

exit();
 }
    $categoria = $_GET["codigo"];

    switch ($categoria) {
        case "1":
            include_once("menu_painel.php");
            include_once("painel_categoria.php"); 
            break;
        case "2":
            include_once("menu_painel.php"); 
            include_once("painel_produto.php");
            break;
        case "3":
            include_once("menu_painel.php"); 
            include_once("painel_fornecedor.php");
            break;
        case "4":
            include_once("menu_painel.php"); 
            include_once("painel_transportadora.php");
            break;
        default:
            include_once("menu_painel.php");     
    }
 
 ?>
    
</div>

<?php 
 include_once("_incluir/footer.php");
?>

