<?php require_once("../conexao/conexao.php"); ?>
<?php
    session_start();
    if(!isset($_SESSION["user_portal"])){
        header("Location:adm.php");
    }
    // ====================================
    if(isset($_POST["nometransportadora"])){
      $nome = utf8_decode($_POST["nometransportadora"]);
      $endereco = utf8_decode($_POST["endereco"]);
      $cidade = utf8_decode($_POST["cidade"]);
      $estado = $_POST["estados"];
      $cep = $_POST["cep"];
      $cnpj = $_POST["cnpj"];
      $telefone = $_POST["telefone"];
      $tID = $_POST["transportadoraID"];

      // obj para alterar
      $alt = "UPDATE transportadoras ";
      $alt .= "SET ";
      $alt .= "nometransportadora = '{$nome}', ";
      $alt .= "endereco = '{$endereco}', ";
      $alt .= "cidade = '{$cidade}', ";
      $alt .= "estadoID = {$estado}, ";
      $alt .= "cep = '{$cep}', ";
      $alt .= "cnpj = '{$cnpj}', ";
      $alt .= "telefone = '{$telefone}' ";
      $alt .= "WHERE transportadoraID = {$tID} ";
      $operacao_alterar = mysqli_query($conn, $alt);
      if(!$operacao_alterar){
        die("Erro ao alterar transporte");
      } else {
        header("Location: painel_adm.php?codigo=4");
      }

    }
    // consultar transportadoras
    $tr = "SELECT * ";
    $tr .= "FROM transportadoras ";
    if(isset($_GET["codigo"])){
      $id = $_GET["codigo"];
      $tr .= "WHERE transportadoraID = {$id} ";
    } else {
      $tr .= "WHERE transportadoraID = 1 ";
    }

    $con_trans = mysqli_query($conn, $tr);
    if(!$con_trans){
      die("Falha ao buscar transportadora");
    }

    $info_transportadora = mysqli_fetch_assoc($con_trans);

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

    <h5 class="center">Alterar transportadora</h5>
    <div class="divider"></div>

    <div class="row">
    <form class="s6 offset-s3" action="alt_trans.php" method="post">

      <div class="row">

        <div class="input-field col s12">
          <input id="first_name" name="nometransportadora" value="<?php echo utf8_encode($info_transportadora["nometransportadora"])?>" type="text" class="validate">
          <label for="first_name">Nome transportadora</label>
        </div>
   
        <div class="input-field col s12">
          <input id="end" name="endereco" value="<?php echo utf8_encode($info_transportadora["endereco"])?>" type="text" class="validate">
          <label for="end">Endereço</label>
        </div>
  
        <div class="input-field col s12">
          <input id="telefone" name="telefone" value="<?php echo $info_transportadora["telefone"]?>" type="text" class="validate">
          <label for="telefone">Telefone (11) 00000-0000</label>
        </div>

        <div class="input-field col s12">
          <input id="cidade" name="cidade" value="<?php echo utf8_encode($info_transportadora["cidade"])?>" type="text" class="validate">
          <label for="cidade">Cidade</label>
        </div>

        <select name="estados" class="browser-default">
          <!--  <option value="" disabled selected>Selecione o Estado</option> -->
            <?php 
                $meu_estado = $info_transportadora["estadoID"];
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
          <input id="cep" name="cep" value="<?php echo $info_transportadora["cep"]?>" type="text" class="validate">
          <label for="cep">CEP: 00000-000 </label>
        </div>

        <div class="input-field col s12">
          <input id="cnpj" name="cnpj" value="<?php echo $info_transportadora["cnpj"]?>" type="text" class="validate">
          <label for="cnpj">CNPJ: 99.999.000/0001-99</label>
        </div>

        <div class="input-field col s12">
          <input id="id_t" name="transportadoraID" value="<?php echo $info_transportadora["transportadoraID"]?>" type="hidden">
          <label for="id_t"></label>
        </div>

      </div>

    <button class="btn waves-effect waves-light input-field col s12" type="submit">Confirmar dados
    </button>

    </form>
    <a href="painel_adm.php?codigo=4" class="btn waves-effect waves-light input-field col s12 red">Voltar</a>
  </div>
</div>

<?php 
 include_once("_incluir/footer.php");
?>


