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
    $sqlParametro = "SELECT * FROM cliente WHERE id = '$idParametro'";
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
                    <li>
                        <a href="../login/dashboard.php">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="treeview active">
                        <a href="#">
                            <i class="ion ion-android-contacts"></i> <span>Clientes</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class=""><a href="../clientes/listCliente.php"><i
                                        class="fa
                      fa-circle-o"></i> Listar </a></li>
                            <li class="active"><a href="../clientes/addCliente.php"><i class="fa fa-circle-o"></i>
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
                            <li class=""><a href="../usuarios/listUsuario.php"><i
                                        class="fa
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
                    Clientes
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="#">Clientes</a></li>
                    <li class="active">Cadastrar</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cadastro de cliente</h3>
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
                            <div class="form-group col-lg-8">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                    placeholder="Informe seu nome completo"
                                    value="<?php if (isset($_GET['id'])): echo $lista['nome']; endif; ?>" required>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf"
                                    placeholder="Informe seu CPF"
                                    value="<?php if (isset($_GET['id'])): echo $lista['cpf']; endif; ?>"
                                    <?php if (isset($_GET['id'])): echo "readonly"; endif; ?> required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Informe seu e-mail"
                                value="<?php if (isset($_GET['id'])): echo $lista['email']; endif; ?>">
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label for="cep">CEP</label>
                                <input type="text" class="form-control" id="cep" name="cep"
                                    placeholder="Informe seu CEP"
                                    value="<?php if (isset($_GET['id'])): echo $lista['cep']; endif; ?>">
                            </div>
                            <div class="form-group col-lg-9">
                                <label for="endereco">Endereço</label>
                                <input type="text" class="form-control" id="endereco" name="endereco"
                                    placeholder="Informe seu endereço"
                                    value="<?php if (isset($_GET['id'])): echo $lista['endereco']; endif; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-2">
                                <label for="numero">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero"
                                    placeholder="Informe seu numero"
                                    value="<?php if (isset($_GET['id'])): echo $lista['numero']; endif; ?>">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="bairro">Bairro</label>
                                <input type="text" class="form-control" id="bairro" name="bairro"
                                    placeholder="Informe seu bairro"
                                    value="<?php if (isset($_GET['id'])): echo $lista['bairro']; endif; ?>">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="cidade">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade"
                                    placeholder="Informe sua Cidade"
                                    value="<?php if (isset($_GET['id'])): echo $lista['cidade']; endif; ?>">
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="estado">Estado</label>
                                <input type="text" class="form-control" id="estado" name="estado"
                                    placeholder="Informe seu estado"
                                    value="<?php if (isset($_GET['id'])): echo $lista['uf']; endif; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="telefone">Telefone</label>
                                <input type="text" class="form-control" id="telefone" name="telefone"
                                    placeholder="Informe seu telefone"
                                    value="<?php if (isset($_GET['id'])): echo $lista['telefone']; endif; ?>">
                            </div>
                            <div class="form-group col-lg-8">
                                <label for="site">Site</label>
                                <input type="text" class="form-control" id="site" name="site"
                                    placeholder="Informe sua site"
                                    value="<?php if (isset($_GET['id'])): echo $lista['site']; endif; ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <?php 
                            if (isset($_GET['id'])): 
                                echo "<button type='submit' name='btn-edit-cliente' class='btn btn-primary'>Atualizar</button>";
                            else: 
                                echo "<button type='submit' name='btn-create-cliente' class='btn btn-primary'>Cadastar</button>";
                            endif;
                            ?>
                            <a class="btn btn-danger ml-3" href="../clientes/listCliente.php">
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