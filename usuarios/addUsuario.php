<?php
include '../config/header.php';
//Conexão
include_once '../config/db_connect.php';
// Iniciar sessao
session_start();
if (!isset($_SESSION['logado'])): header('Location: ../index.php');
endif;
// capturar nome
$id = $_SESSION['id_logado'];
$sql = "SELECT * FROM usuario WHERE id = '$id'";
$dado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($dado);
//Verificar se possui parametro
if (isset($_GET['id'])):
    //pegando id passado pelo parametro  
    $idParametro = mysqli_escape_string($connect, $_GET['id']);
    //listando dados a partir do id
    $sqlParametro = "SELECT * FROM usuario WHERE id = '$idParametro'";
    $resultado = mysqli_query($connect, $sqlParametro);
    $lista = mysqli_fetch_array($resultado);
endif;
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
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs">
                                    <?php echo $dados['nome']; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                    <p>
                                        <?php echo $dados['nome']; ?>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="../usuarios/addUsuario.php?id=<?php echo $dados['id']; ?>"
                                            class="btn btn-default btn-flat">Configurações</a>
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
                            <?php echo $dados['nome']; ?>
                        </p>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header text-center">MENU</li>
                    <li>
                        <a href="../login/dashboard.php">
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
                            <li><a href="../clientes/listCliente.php"><i
                                        class="fa
                      fa-circle-o"></i> Listar </a></li>
                            <li><a href="../clientes/addCliente.php"><i class="fa fa-circle-o"></i>
                                    Cadastrar </a></li>
                        </ul>
                    </li>
                    <li class="treeview active">
                        <a href="#">
                            <i class="ion ion-person"></i> <span>Usuários</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../usuarios/listUsuario.php"><i
                                        class="fa
                      fa-circle-o"></i> Listar </a></li>
                            <li class="active"><a href="../usuarios/addUsuario.php"><i class="fa fa-circle-o"></i>
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
                    Usuários
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="#">Usuários</a></li>
                    <li class="active">Cadastrar</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cadastro de usuário</h3>
                    </div>
                    <!-- Formulario -->
                    <?php 
                    if (isset($_GET['id'])): 
                        echo "<form action='../config/edit.php' method='POST'>";
                    else: 
                        echo "<form action='../config/create.php' method='POST'>";
                    endif; ?>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-lg-1">
                                <label for="id">ID</label>
                                <input type="text" class="form-control" id="id" name="id"
                                    value="<?php if (isset($_GET['id'])): echo $lista['id']; endif; ?>"
                                    readonly>
                            </div>
                            <div class="form-group col-lg-11">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                    placeholder="Informe seu nome completo"
                                    value="<?php if (isset($_GET['id'])): echo $lista['nome']; endif; ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-7">
                                <label for="login">Login</label>
                                <input type="text" class="form-control" id="login" name="login"
                                    placeholder="Informe um Login"
                                    value="<?php if (isset($_GET['id'])): echo $lista['login']; endif; ?>" required>
                            </div>
                            <div class="form-group col-lg-5">
                                <label for="senha">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha"
                                    placeholder="Informe uma Senha"
                                    value="<?php if (isset($_GET['id'])): echo "***"; endif; ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <?php 
                            if (isset($_GET['id'])): 
                                echo "<button type='submit' name='btn-edit-usuario' class='btn btn-primary'>Atualizar</button>";
                            else: 
                                echo "<button type='submit' name='btn-create-usuario' class='btn btn-primary'>Cadastar</button>";
                            endif;
                            ?>
                            <a class="btn btn-danger ml-3" href="../usuarios/listUsuario.php">
                                Cancelar
                            </a>
                        </div>
                        </form>
                    </div>
                    <!-- /.box -->
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