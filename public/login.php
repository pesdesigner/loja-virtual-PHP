<?php require_once("../conexao/conexao.php"); ?>
<?php

  // adicionar sessao
  session_start();

  if(isset($_POST["email"])){
    $usuario = $_POST["usuario"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $login = "SELECT * ";
    $login .= "FROM clientes ";
    $login .= "WHERE usuario = '{$usuario}' and senha = '{$senha}'";

    $acesso = mysqli_query($conn, $login);
    if (!$acesso){
      die("Falha na consulta");
    }

    $informacao = mysqli_fetch_assoc($acesso);

    if(empty($informacao)){
      $mensagem = "Login sem sucesso";
    } else {
        $_SESSION["user_portal"] = $informacao["clienteID"];
        header("Location: listagem.php");
    }

  }

?>

<?php 
 include_once("_incluir/head.php");
 include_once("_incluir/nav_home.php");
?>


<div class="container main_form">

    <div class="row">
    <form class="col s12" action="login.php" method="post">

      <div class="row">

      <?php if(isset($mensagem)) { ?>

          <div class="card-panel red darken-2"><span class="white-text"><?php echo $mensagem ?></span></div>
          
      <?php } ?>


        <div class="input-field col s12">
        <i class="material-icons prefix">perm_identity</i>
          <input id="first_name" name="usuario" type="text" class="validate">
          <label for="name">Digite seu nome</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
        <i class="material-icons prefix">mail_outline</i>
          <input id="email" name="email" type="email" class="validate">
          <label for="email">Digite se e-mail</label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
        <i class="material-icons prefix">lock_outline</i>
          <input id="password" name="senha" type="password" class="validate">
          <label for="password">Digite sua senha</label>
        </div>
      </div>

    <button class="btn waves-effect waves-light input-field col s12" type="submit" name="action">Fazer login
    </button>

    <div class="row">
          <div class="input-field col s6 m6 l6">
            <p class="margin left medium-small"><a href="#">Registrar agora!</a></p>
          </div>
          <div class="input-field col s6 m6 l6">
              <p class="margin right-align medium-small"><a href="#">Esquece a senha?</a></p>
          </div>          
        </div>

    </form>
  </div>

</div>


<?php 
 include_once("_incluir/footer.php");
?>


