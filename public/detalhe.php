<?php require_once("../conexao/conexao.php"); ?>
<?php
    if(isset($_GET["codigo"])){
        $produto_ID = $_GET["codigo"];
    } else {
        Header("Location: home.php");
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
        $descricao = $dados_detalhe["descricao"];
        $codigobarra = $dados_detalhe["codigobarra"];
        $tempoentrega = $dados_detalhe["tempoentrega"];
        $precorevenda = $dados_detalhe["precorevenda"];
        $precounitario = $dados_detalhe["precounitario"];
        $estoque = $dados_detalhe["estoque"];
        $imagemgrande = $dados_detalhe["imagemgrande"];
        $imagempequena = $dados_detalhe["imagempequena"];

    }

?>

<?php 
 include_once("_incluir/head.php");
 include_once("_incluir/nav_home.php");
?>


<nav>
    <div class="nav-wrapper light-blue darken-4">

        <div class="container">
            <div class="col s12">
            <a href="home.php" class="breadcrumb">home</a>
            <a href="#!" class="breadcrumb"><?php echo $nomeproduto ?></a>
        </div>
    </div>

    </div>
  </nav>

<main>
  
<div class="container">
<br>

<div class="row">

<div class="col s6">
          <div class="card">
            <div class="card-image">
            <img class="activator" src="<?php echo $imagemgrande ?>">
            <br>
              <span class="card-title grey-text text-darken-4"><?php echo $nomeproduto ?></span>
            </div>

          </div>
    </div>

  <div class="col s6">
  
    <div class="card large">
       
        <div class="card-content">

        <span class="card-title activator grey-text text-darken-4"><?php echo $nomeproduto ?><i class="material-icons right">more_vert</i></span>
        
        <p><?php echo $descricao ?></p>

        <br>

        <p>Tempo de entrega: <strong><?php echo $tempoentrega ?></strong> dias</p>
        <p>Pre&ccedil;o revenda: <strong><?php  echo "R$" , number_format($precorevenda, 2,',','.')?></strong></p>
        <p>Pre&ccedil;o unit&aacute;rio: <strong><?php  echo "R$" , number_format($precounitario, 2,',','.')?></strong></p>
        <p>Estoque: <strong><?php echo $estoque ?></strong></p>

        <div class="card-action">
            <a class="waves-effect waves-light btn-large" href="login.php">Comprar  <i class="material-icons right">local_grocery_store</i></a>

         </div>
   
        </div>
        <div class="card-reveal">

        <span class="card-title grey-text text-darken-4"><?php echo $nomeproduto ?><i class="material-icons right">close</i></span>
        
        <br>
                <img class="activator" src="<?php echo $imagemgrande ?>">
  
        <p><?php echo $descricao ?></p>

        <p>C&oacute;digo de barras: <strong><?php echo $codigobarra ?></strong></p>

        </div>
        
    </div>
    </div>

</div>

</div>

     <?php 
        //limpar a memória após a listagem
        mysqli_free_result($detalhe);
    ?>


</main>


<?php 
 include_once("_incluir/footer.php");
?>


