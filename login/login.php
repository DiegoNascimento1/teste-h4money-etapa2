<?php
include '../config/header.php';
//Conexão
include_once '../config/db_connect.php';
// Iniciar sessao
session_start();
//preenchendo tentativas
if (!isset($_SESSION['tentativa'])): 
  $_SESSION['tentativa'] = 0;
endif;
//pegando valor do recaptcha
if (isset($_POST['g-recaptcha-response'])): 
  $recaptcha = $_POST['g-recaptcha-response'];
endif;
// botao entrar
if (isset($_POST['btn-entrar'])): 
  $erros = array();
  $tratamento = mysqli_escape_string($connect, $_POST['login']);
  $login = preg_replace('/[^[:alpha:]_]/', '', $tratamento);
  $senha = mysqli_escape_string($connect, $_POST['senha']);

  if (empty($login) or empty($senha)): 
    $erros[] = "<p class='login-box-msg text-danger '><strong> Login e senha precisam ser preenchidas! </strong></p>";
    //Quantidade de tentativas
    $_SESSION['tentativa']++;

  else:
    $sql = "SELECT login FROM usuario WHERE login = '$login'";
    $dado = mysqli_query($connect, $sql);

    if (mysqli_num_rows($dado) > 0): 
      $senha = md5($senha);
      $sql = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'";
      $dado = mysqli_query($connect, $sql);

      if (mysqli_num_rows($dado) == 1 && $_SESSION['tentativa'] < 5): 
        $dados = mysqli_fetch_array($dado);
        $_SESSION['id_logado'] = $dados['id'];
        $_SESSION['logado'] = true;
        header('Location: dashboard.php');

      elseif (mysqli_num_rows($dado) == 1 && $_SESSION['tentativa'] >= 5): 
        if ($recaptcha <> 0): 
          $dados = mysqli_fetch_array($dado);
          $_SESSION['id_logado'] = $dados['id'];
          $_SESSION['logado'] = true;
          header('Location: dashboard.php');
        else: 
          $erros[] = "<p class='login-box-msg text-danger '><strong> Confirme o reCAPTCHA! </strong></p>";
          //Quantidade de tentativas
          $_SESSION['tentativa']++;
        endif;

      else: 
        $erros[] = "<p class='login-box-msg text-danger '><strong> Usuário e senha não conferem! </strong></p>";
        //Quantidade de tentativas
        $_SESSION['tentativa']++;
      endif;

    else: $erros[] = "<p class='login-box-msg text-danger '><strong> Usuário não existe! </strong></p>";
      //Quantidade de tentativas
      $_SESSION['tentativa']++;
    endif;
  endif;
endif;
?>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Etapa </b>2</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Bem vindo! Informe seus dados para entrar no sistema.</p>
            <?php 
            if (!empty($erros)): 
              foreach ($erros as $erro): 
                echo $erro;
              endforeach;
            endif;
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group has-feedback">
                    <input name="login" type="text" class="form-control" placeholder="Login">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input name="senha" type="password" class="form-control" placeholder="Senha">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <?php if ($_SESSION['tentativa'] >= 5): ?>
                <div class="row">
                    <div style="margin: 0px 15px 15px 25px">
                        <div class="g-recaptcha" data-sitekey="6Ld9nJMUAAAAAIIASy65CZNfiy14MhIKfRIj2A7w"></div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-xs-8">
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button name="btn-entrar" type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
    </div>
    <!--js-->
    <script src='https://www.google.com/recaptcha/api.js?hl=pt-BR'></script>
    <?php
 // footer
    include '../config/footer.php';
    ?> 