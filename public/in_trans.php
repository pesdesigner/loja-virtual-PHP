<?php require_once("../conexao/conexao.php"); ?>
<?php
    session_start();
    if(!isset($_SESSION["user_portal"])){
        header("Location:adm.php");
    }
    // ====================================

    // inserção estado
    if(isset($_POST["nometransportadora"])){
        $nome = utf8_decode($_POST["nometransportadora"]);
        $endereco = utf8_decode($_POST["endereco"]);
        $cidade = utf8_decode($_POST["cidade"]);
        $estado = $_POST["estados"];
        $cep = $_POST["cep"];
        $cnpj = $_POST["cnpj"];
        $telefone = $_POST["telefone"];

        $inserir = "INSERT INTO transportadoras ";
        $inserir .= "(nometransportadora, endereco, cidade, estadoID, cep, cnpj, telefone) ";
        $inserir .= "VALUES ";
        $inserir .= "('$nome','$endereco','$cidade',$estado,'$cep','$cnpj','$telefone')";

        $operacao_inserir = mysqli_query($conn, $inserir);
        if(!$operacao_inserir){
            die("Erro no banco ao inserir dados");
        }
    }

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

    <h5 class="center">Cadastrar transportadora</h5>
    <div class="divider"></div>

    <div class="row">
    <form class="s6 offset-s3" action="in_trans.php" method="post">

      <div class="row">

        <div class="input-field col s12">
          <input id="first_name" name="nometransportadora" type="text" class="validate">
          <label for="first_name">Nome transportadora</label>
        </div>
   
        <div class="input-field col s12">
          <input id="end" name="endereco" type="text" class="validate">
          <label for="end">Endereço</label>
        </div>
  
        <div class="input-field col s12">
          <input id="telefone" name="telefone" type="text" class="validate">
          <label for="telefone">Telefone (11) 00000-0000</label>
        </div>

        <div class="input-field col s12">
          <input id="cidade" name="cidade" type="text" class="validate">
          <label for="cidade">Cidade</label>
        </div>

        <select name="estados" class="browser-default">
            <option value="" disabled selected>Selecione o Estado</option>
            <?php 
                while($linha = mysqli_fetch_assoc($lista_estados)){
            ?>
            <option value="<?php echo $linha["estadoID"]; ?>">
                <?php echo utf8_encode($linha["nome"]);?>
            </option>

            <?php } ?>
        </select>

        <div class="input-field col s12">
          <input id="cep" name="cep" type="text" class="validate">
          <label for="cep">CEP: 00000-000 </label>
        </div>

        <div class="input-field col s12">
          <input id="cnpj" name="cnpj" type="text" class="validate">
          <label for="cnpj">CNPJ: 99.999.000/0001-99</label>
        </div>

      </div>

    <button class="btn waves-effect waves-light input-field col s12" type="submit">Inserir dados
    </button>

    </form>
    <a href="painel_adm.php?codigo=4" class="btn waves-effect waves-light input-field col s12 red">Voltar</a>

  </div>

</div>

<?php 
 include_once("_incluir/footer.php");
?>


