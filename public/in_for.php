<?php require_once("../conexao/conexao.php"); ?>
<?php
    session_start();
    if(!isset($_SESSION["user_portal"])){
        header("Location:adm.php");
    }
    // ====================================

    // inserção fornecedor
    if(isset($_POST["nomefornecedor"])){
        $nome = utf8_decode($_POST["nomefornecedor"]);
        $endereco = utf8_decode($_POST["endereco"]);
        $cidade = utf8_decode($_POST["cidade"]);
        $estado = $_POST["estados"];
        $telefone = $_POST["telefone"];

        $inserir = "INSERT INTO fornecedores ";
        $inserir .= "(nomefornecedor, endereco, cidade, estadoID, telefone) ";
        $inserir .= "VALUES ";
        $inserir .= "('$nome','$endereco','$cidade',$estado ,'$telefone')";

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

    <h5 class="center">Cadastrar fornecedor</h5>
    <div class="divider"></div>

    <div class="row">
    <form class="s6 offset-s3" action="in_for.php" method="post">

      <div class="row">

        <div class="input-field col s12">
          <input id="first_name" name="nomefornecedor" type="text" class="validate">
          <label for="first_name">Nome fornecedor</label>
        </div>
   
        <div class="input-field col s12">
          <input id="end" name="endereco" type="text" class="validate">
          <label for="end">Endereço</label>
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
          <input id="telefone" name="telefone" type="text" class="validate">
          <label for="telefone">Telefone (11) 00000-0000</label>
        </div>

      </div>

    <button class="btn waves-effect waves-light input-field col s12" type="submit">Inserir dados
    </button>

    </form>
    <a href="painel_adm.php?codigo=3" class="btn waves-effect waves-light input-field col s12 red">Voltar</a>

  </div>

</div>

<?php 
 include_once("_incluir/footer.php");
?>


