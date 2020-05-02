<?php require_once("../conexao/conexao.php"); ?>
<?php
    // adicionar sessao
    session_start();

    // localidade
    setlocale(LC_ALL, 'pt_BR');

    // consulta lista categorias
    $consult_categorias = "SELECT categoriaID, nomecategoria ";
    $consult_categorias .= " FROM categorias" ;

    $categorias = mysqli_query($conn, $consult_categorias);

    if(!$categorias){
        die("Falha na consulta categoria");
    }

    if(isset($_GET["codigo"])){

        $categoria_ID = $_GET["codigo"];

        $consult_produtos = "SELECT categoriaID, produtoID, imagemgrande, imagempequena, nomeproduto, tempoentrega, precounitario, descricao, descontinuado ";
        $consult_produtos .= " FROM produtos " ;
        $consult_produtos .= " WHERE categoriaID = {$categoria_ID} ";
       
        if(isset($_GET["produto"])){
            $nome_produto = $_GET["produto"];
            $consult_produtos .= "WHERE nomeproduto LIKE '%{$nome_produto}' ";
        }
    
        $produtos = mysqli_query($conn, $consult_produtos);
    
        if(!$produtos){
            die("Falha na consulta produtos da categoria: ");
        }

    } else {
        $consult_produtos = "SELECT produtoID, imagemgrande, imagempequena, nomeproduto, tempoentrega, precounitario, descricao, descontinuado ";
        $consult_produtos .= " FROM produtos " ;
       
        if(isset($_GET["produto"])){
            $nome_produto = $_GET["produto"];
            $consult_produtos .= "WHERE nomeproduto LIKE '%{$nome_produto}' ";
        }
    
        $produtos = mysqli_query($conn, $consult_produtos);
    
        if(!$produtos){
            die("Falha na consulta produtos");
        }
    }


?>

<?php 
 include_once("_incluir/head.php");
?>

<?php 
 include_once("_incluir/nav_home.php");
?>


<main>

<div class="container">
      
        <ol class="collection with-header">
            <h4>Categorias</h4>
            <?php
            while($registro = mysqli_fetch_assoc($categorias)){ ?>
                
                    <li class="collection-item"><a href="home.php?codigo=<?php echo $registro['categoriaID'] ?>"><?php echo($registro["nomecategoria"])?></a></li>
                
            <?php } ?>
        </ol>
</div>

<div class="container">
<nav>

<div class="nav-wrapper light-blue darken-4">


  <form action="home.php" method="get">
    <div class="input-field">
      <input id="search" type="search" name="produto" required>
      <label class="label-icon" for="search" type="text"><i class="material-icons">search</i></label>

      <i class="material-icons">close</i>
    </div>
  </form>

</div>

</nav>
<br>
</div>

    <div class="container">

    <div class="row">
    <?php while($registro = mysqli_fetch_assoc($produtos)){ ?>   
      <div class="col s4">
      
        <div class="card large">
            <div class="card-image waves-effect waves-block waves-light">
                <a href="detalhe.php?codigo=<?php echo $registro['produtoID'] ?>">
                    <img class="activator" src="<?php echo($registro["imagemgrande"])?>">
                </a>
            </div>
            <div class="card-content">

            <span class="card-title activator grey-text text-darken-4"><?php echo($registro["nomeproduto"])?><i class="material-icons right">more_vert</i></span>
            
            <p>Tempo de entrega: <strong><?php echo($registro["tempoentrega"])?></strong></p>
            <p>Pre&ccedil;o unit&aacute;rio: <strong><?php  echo "R$" , number_format($registro["precounitario"], 2,',','.')?></strong></p>
            <br>
            <br>

                <a class="waves-effect waves-light btn-large" href="detalhe.php?codigo=<?php echo $registro['produtoID'] ?>">Comprar  <i class="material-icons right">local_grocery_store</i></a>

            </div>
            <div class="card-reveal">

            <span class="card-title grey-text text-darken-4"><?php echo($registro["nomeproduto"])?><i class="material-icons right">close</i></span>
            
            <br>
            <a href="detalhe.php?codigo=<?php echo $registro['produtoID'] ?>">
                    <img class="activator" src="<?php echo($registro["imagempequena"])?>">
            </a>

            <p><?php echo($registro["descricao"])?></p>

            </div>
            
        </div>
     </div>

    <?php } ?>

    </div>

    </div>

    <?php 
        //limpar a memória após a listagem
        mysqli_free_result($categorias);
        mysqli_free_result($produtos);
    ?>
</main>


<?php 
 include_once("_incluir/footer.php");
?>


