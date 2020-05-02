<?php require_once("../conexao/conexao.php"); ?>
<?php
    session_start();
    if(!isset($_SESSION["user_portal"])){
        header("Location:adm.php");
    }
    // ====================================
    if(isset($_POST["nomefornecedor"])){
      $nome = utf8_decode($_POST["nomefornecedor"]);
      $endereco = utf8_decode($_POST["endereco"]);
      $cidade = utf8_decode($_POST["cidade"]);
      $estado = $_POST["estados"];
      $telefone = $_POST["telefone"];
      $tID = $_POST["fornecedorID"];

      // obj para alterar
      $alt = "UPDATE fornecedores ";
      $alt .= "SET ";
      $alt .= "nomefornecedor = '{$nome}', ";
      $alt .= "endereco = '{$endereco}', ";
      $alt .= "cidade = '{$cidade}', ";
      $alt .= "estadoID = {$estado}, ";
      $alt .= "telefone = '{$telefone}' ";
      $alt .= "WHERE fornecedorID = {$tID} ";
      $operacao_alterar = mysqli_query($conn, $alt);
      if(!$operacao_alterar){
        die("Erro ao alterar fornecedor");
      } else {
        header("Location: painel_adm.php?codigo=3");
      }

    }
    // consultar fornecedores
    $tr = "SELECT * ";
    $tr .= "FROM fornecedores ";
    if(isset($_GET["codigo"])){
      $id = $_GET["codigo"];
      $tr .= "WHERE fornecedorID = {$id} ";
    } else {
      $tr .= "WHERE fornecedorID = 1 ";
    }

    $con_for = mysqli_query($conn, $tr);
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

    <h5 class="center">Alterar fornecedor</h5>
    <div class="divider"></div>

    <div class="row">
    <form class="s6 offset-s3" action="alt_for.php" method="post">

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

    <button class="btn waves-effect waves-light input-field col s12" type="submit">Confirmar dados
    </button>

    </form>
    <a href="painel_adm.php?codigo=3" class="btn waves-effect waves-light input-field col s12 red">Voltar</a>
  </div>
</div>

<?php 
 include_once("_incluir/footer.php");
?>


