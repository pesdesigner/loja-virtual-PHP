<header>
        <nav>
            <div class="nav-wrapper nav teal lighten-2">
                <div class="container">
                <a href="#!" class="brand-logo"><img src="assets/logo_andes.gif"></a>
    
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                   
                <li><a href="painel_adm.php?codigo=2">Administração</a></li>
           
                <?php 
                    if(isset($_SESSION["user_portal"])){
                        $user = $_SESSION["user_portal"];

                        $saudacao = "SELECT nomecompleto ";
                        $saudacao .= "FROM clientes ";
                        $saudacao .= "WHERE clienteID = {$user} ";

                        $saudacao_login = mysqli_query($conn, $saudacao);
                        if(!$saudacao_login){
                            die("falha no banco");
                        }
                        $saudacao_login = mysqli_fetch_assoc($saudacao_login);
                        $nome = $saudacao_login["nomecompleto"];
                    ?>

                    <!-- Dropdown Trigger -->
                    <li>
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-button' data-belowOrigin="true" data-hover="true" href='#' data-activates='dropdown1'>Bem-vindo, <?php echo $nome ?>!</a>

                        <!-- Dropdown Structure -->
                        <ul id='dropdown1' class='dropdown-content'>
                            <li><a href="#!">Meu perfil</a></li>
                            <li><a href="#!">Configurações</a></li>
                        </ul>
                    </li>

                    <li><a href="logout.php"><i class="material-icons right">exit_to_app</i>Sair</a></li>

                     <?php   }
                    
                    ?>
                  
                </ul>
                </div>
            </div>
        </nav>

</header>