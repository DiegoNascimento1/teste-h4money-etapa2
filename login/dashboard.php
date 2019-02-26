<?php
include '../config/header.php';
//Conexão
include_once '../config/db_connect.php';
// Iniciar sessao
session_start();
if(!isset($_SESSION['logado'])):
    header('Location: ../index.php');
endif;
//Verificar quantidade de clientes
$sqlC = "SELECT * FROM cliente";
$dadosC = mysqli_query($connect, $sqlC);
$qtdCliente = mysqli_num_rows($dadosC);
//Verificar quantidade de usuarios
$sqlU = "SELECT * FROM usuario";
$dadosU = mysqli_query($connect, $sqlU);
$qtdUsuario = mysqli_num_rows($dadosU);
// capturar nome
$id = $_SESSION['id_logado'];
$sql = "SELECT * FROM usuario WHERE id = '$id'";
$dado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($dado);
?>
<body class="sidebar-mini skin-black">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>E</b>2</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Etapa</b> 2</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu"
            role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../dist/img/user2-160x160.jpg" class="user-image"
                    alt="User Image">
                  <span class="hidden-xs"><?php echo $dados['nome']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../dist/img/user2-160x160.jpg" class="img-circle"
                      alt="User Image">
                    <p>
                      <?php echo $dados['nome']; ?>
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="../usuarios/addUsuario.php?id=<?php echo $dados['id']; ?>" class="btn btn-default btn-flat">Configurações</a>
                    </div>
                    <!-- logout -->
                    <div class="pull-right">
                      <a href="../config/logout.php" class="btn btn-default btn-flat">Sair</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <!-- logout -->
                <a href="../config/logout.php"><i class="fa fa-sign-out"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User
                Image">
            </div>
            <div class="pull-left info">
              <p>
                Bem vindo,
              </p>
              <p>
                <?php echo $dados['nome']; ?>
              </p>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header text-center">MENU</li>
            <li class="active">
              <a href="dashboard.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="ion ion-android-contacts"></i> <span>Clientes</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="../clientes/listCliente.php"><i class="fa
                      fa-circle-o"></i> Listar </a></li>
                <li><a href="../clientes/addCliente.php"><i class="fa fa-circle-o"></i>
                    Cadastrar </a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="ion ion-person"></i> <span>Usuários</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="../usuarios/listUsuario.php"><i class="fa
                      fa-circle-o"></i> Listar </a></li>
                <li><a href="../usuarios/addUsuario.php"><i class="fa fa-circle-o"></i>
                    Cadastrar </a></li>
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
          </h1>
          <!-- <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          </ol> -->
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-5 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <!-- AQUI QUANTIDADE DE CLIENTES -->
                  <h3><?php echo $qtdCliente ?></h3>
                  <p>Clientes Cadastrados</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-contacts"></i>
                </div>
                <a href="../clientes/listCliente.php" class="small-box-footer">Saiba mais <i class="fa
                    fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-5 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-orange">
                <div class="inner">
                  <!-- AQUI QUANTIDADE DE USUARIOS -->
                  <h3><?php echo $qtdUsuario ?></h3>
                  <p>Usuários Cadastrados</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="../usuarios/listUsuario.php" class="small-box-footer">Saiba mais <i class="fa
                    fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          <!-- /.row -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.4.1
        </div>
        <strong>Copyright &copy; 2019 Etapa </strong>2
      </footer>

      <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <?php
// footer
include '../config/footer.php';
?>