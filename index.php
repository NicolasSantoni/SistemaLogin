<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sistema de Login</title>
    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body>
    <!-- USUÁRIO: Info 63B
    SENHA: info63b -->
    <?php
      $arquivo = fopen('arquivo.txt','a+');
      $senhaI="e59870d8c98d55ae3268aab3bc793f8b";
      $usuarioI= "Info 63B";
      $info=$usuarioI."|".$senhaI."\n";
      fwrite($arquivo, $info);
      fclose($arquivo);
    ?>
    <header>
      <div class="titulo">
        <img src="./imagens/cimol.png" alt="cimol" id="img1">
        <center><h1 id="h1">SISTEMA DE LOGIN</h1></center>
        <img src="./imagens/infologo.png" alt="cimol" id="img2">
      </div>
    </header>
    <?php
		session_start();
		date_default_timezone_set("America/Sao_Paulo");
		if(!isset($_SESSION['usuario'])){
    ?>
    <main>
      <form class="login" action="" method="post">
        <p>Indique seu ID de usuário:</p>
        <input type="text" name="usuario"/>
        <p>Indique sua senha:</p>
        <input type="password" name="senha" id="senha">
        <button type="submit" name="enviar">ENTRAR</button>
      </form>
      <?php
        error_reporting(0);
        ini_set(“display_errors”, 0 );
  			if(isset($_POST['enviar'])){
          $user=$_POST['usuario'];
          $sen=$_POST['senha'];
          $arquivo = fopen('arquivo.txt','r');
          $teste=fgets($arquivo);
          $teste=explode('|',$teste);
          $usuarioT=$teste[0];
          $senhaT=$teste[1];
          fclose($arquivo);
          $sen=md5($sen);
          $senhaT=str_replace("\n", "", $senhaT);
          echo "<p>SENHA INCORRETA</p>";
          if ($usuarioT==$user&&$senhaT==$sen) {
            $_SESSION["usuario"]=$user;
            header("location:index.php");
          }
  			}
  		}
      else{
  			   $usuario=$_SESSION['usuario'];
  			   echo "<p>Bem vindo ".$usuario."</p>";
  			   echo "<div id='isso'><a href='index.php?acao=logout'>LOGOUT</a></div>";
  		     if(isset($_GET['acao'])){
            if($_GET['acao']=="logout"){
  				          unset($_SESSION["usuario"]);
  			          header("location:index.php");
  				    }
  			   }
  		    }
      ?>
    </main>
  </body>
</html>
