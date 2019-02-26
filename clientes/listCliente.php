<?php
include '../config/header.php';
//Conexão
include_once '../config/db_connect.php';
// Iniciar sessao
session_start();
// Verifica se possui usuario logado
if (!isset($_SESSION['logado'])): 
    header('Location: ../index.php');
endif;
// capturar nome
$id = $_SESSION['id_logado'];
$sql = "SELECT * FROM usuario WHERE id = '$id'";
$dado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($dado);
// Listar dados cadastrados
$sql = "SELECT * FROM cliente";
$dadosC = mysqli_query($connect, $sql);
$qtd = mysqli_num_rows($dadosC);
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
                                    <?php echo $dados['nome']; ?>
                                </span>
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
                            <li class="active"><a href="../clientes/listCliente.php"><i
                                        class="fa
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
                    <li class="active">Listar</li>
                </ol>
            </section>
            <!-- Mensagem de alerta -->
            <div class="box-body">
                <?php 
                    if (isset($_SESSION['mensagem'])): ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i>
                                <?php
                                echo $_SESSION['mensagem'];
                                ?>
                            </h4>
                        </div>
                <?php 
                    endif;
                    unset($_SESSION['mensagem']); ?>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="box-title">Clientes cadastrados</h3>
                            </div>
                            <div class="col-sm-6 text-right">
                                <a class="btn btn-default" href="../clientes/addCliente.php">
                                    Cadastrar +
                                </a>    
                            </div>
                        </div>
                    </div>
                    <!-- Tabela de dados -->
                    <?php
                        if ($qtd > 0): ?>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Cidade</th>
                                    <th>UF</th>
                                    <th>Email</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($lista = mysqli_fetch_array($dadosC)):
                                    ?>
                                <tr>
                                    <td>
                                        <?php echo $lista['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $lista['nome']; ?>
                                    </td>
                                    <td>
                                        <?php echo $lista['cidade']; ?>
                                    </td>
                                    <td>
                                        <?php echo $lista['uf']; ?>
                                    </td>
                                    <td>
                                        <?php echo $lista['email']; ?>
                                    </td>
                                    <!-- Botoes das açoes -->
                                    <td class="text-center">
                                        <a class="btn btn-primary" href="addCliente.php?id=<?php echo $lista['id']; ?>">
                                            Editar
                                        </a>
                                        <!-- Botão excluir com modal -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#deleteModal<?php echo $lista['id']; ?>">
                                            Excluir
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal<?php echo $lista['id']; ?>"
                                            tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="exampleModalLongTitle">Deseja
                                                            realmente
                                                            excluir
                                                            o cliente
                                                            <?php echo $lista['nome']; ?>?
                                                        </h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="../config/delete.php" method="POST">
                                                            <input type="hidden" name="id"
                                                                value="<?php echo $lista['id']; ?>">
                                                            <button type="submit" class="btn btn-success"
                                                                name="btn-delete-cliente">Confirmar</button>
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Cancelar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <!-- Mensagem caso não haja clientes cadastrados -->
                        <?php 
                    else: ?>
                        <hr>
                        <div class=" text-center">
                            Não há clientes cadastrados
                        </div>
                        <hr>
                        <?php endif; ?>
                    </div>
                    <!-- /.box-body -->
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
    <!-- page script -->
    <?php
 // footer
    include '../config/footer.php';
    ?>