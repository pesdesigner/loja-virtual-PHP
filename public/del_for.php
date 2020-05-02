<?php require_once("../conexao/conexao.php"); ?>
<?php
    session_start();
    if(!isset($_SESSION["user_portal"])){
        header("Location:adm.php");
    }
    // ====================================
    if(isset($_POST["nomefornecedor"])){
      $tID = $_POST["fornecedorID"];

      // obj para excluir
      $del = "DELETE FROM fornecedores ";
      $del .= "WHERE fornecedorID = {$tID} ";

      $operacao_deletar = mysqli_query($conn, $del);
      if(!$operacao_deletar){
        die("Erro ao deletar transporte");
      } else {
        header("Location: painel_adm.php?codigo=3");
      }
    }
    
    // consultar fornecedores
    $for = "SELECT * ";
    $for .= "FROM fornecedores ";
    if(isset($_GET["codigo"])){
      $id = $_GET["codigo"];
      $for .= "WHERE fornecedorID = {$id} ";
    } else {
      $for .= "WHERE fornecedorID = 1 ";
    }

    $con_for = mysqli_query($conn, $for);
    if(!$con_for){
      die("Falha ao buscar fornecedor");
    }

    $info_fornecedor = mysqli_fetch_assoc($con_for);

    // selecao estados
    $select = "SELECT estadoID, nome ";
    $select .= "FROM estados ";
    $lista_estados = mysqli_query($conn, $select);
    if(!$lista_estados){
        die("Erro ao buscar estados");
    }
?>

<?php 
 include_once("_incluir/head.php");
 include_once("_incluir/nav_adm.php");
?>

<div class="container main_cadastro">

    <h5 class="center">Excluir fornecedor</h5>
    <div class="divider"></div>

    <div class="row">
    <form class="s6 offset-s3" action="del_for.php" method="post">

      <div class="row">

        <div class="input-field col s12">
          <input id="first_name" name="nomefornecedor" value="<?php echo utf8_encode($info_fornecedor["nomefornecedor"])?>" type="text" class="validate">
          <label for="first_name">Nome fornecedor</label>
        </div>
   
        <div class="input-field col s12">
          <input id="end" name="endereco" value="<?php echo utf8_encode($info_fornecedor["endereco"])?>" type="text" class="validate">
          <label for="end">Endereço</label>
        </div>

        <div class="input-field col s12">
          <input id="cidade" name="cidade" value="<?php echo utf8_encode($info_fornecedor["cidade"])?>" type="text" class="validate">
          <label for="cidade">Cidade</label>
        </div>

        <select name="estados" class="browser-default">
          <!--  <option value="" disabled selected>Selecione o Estado</option> -->
            <?php 
                $meu_estado = $info_fornecedor["estadoID"];
                while($linha = mysqli_fetch_assoc($lista_estados)){
                  $estado_principal = $linha["estadoID"];
                  if($meu_estado == $estado_principal){
            ?>
                <option value="<?php echo $linha["estadoID"]; ?>" selected>
                   <?php echo utf8_encode($linha["nome"]);?>
                </option>
            <?php
                  } else {
            ?>
                <option value="<?php echo $linha["estadoID"]; ?>">
                    <?php echo utf8_encode($linha["nome"]);?>
                </option>
            <?php } } ?>
        </select>

        <div class="input-field col s12">
          <input id="telefone" name="telefone" value="<?php echo $info_fornecedor["telefone"]?>" type="text" class="validate">
          <label for="telefone">Telefone (11) 00000-0000</label>
        </div>

        <div class="input-field col s12">
          <input id="id_t" name="fornecedorID" value="<?php echo $info_fornecedor["fornecedorID"]?>" type="hidden">
          <label for="id_t"></label>
        </div>

      </div>

    <button class="btn waves-effect waves-light input-field col s12" type="submit">Excluir fornecedor
    </button>

    </form>
    <a href="painel_adm.php?codigo=3" class="btn waves-effect waves-light input-field col s12 red">Voltar</a>


  </div>
      

</div>

<?php 
 include_once("_incluir/footer.php");
?>


