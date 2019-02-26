<?php
//Iniciar sessão
session_start();
//Conexão
require_once 'db_connect.php';

//Inserir dados do form
if(isset($_POST['btn-delete-cliente'])):
    $id = mysqli_escape_string($connect, $_POST['id']);

    $sql = "DELETE FROM cliente WHERE id = '$id'";

    if(mysqli_query($connect, $sql)):
        $_SESSION['mensagem'] = "Deletado com sucesso!";
        header('Location: ../clientes/listCliente.php?sucesso');
    else:
        $_SESSION['mensagem'] = "Erro ao deletar!";
        header('Location: ../clientes/listCliente.php?sucesso');
    endif;
endif;

//Inserir dados do form
if(isset($_POST['btn-delete-usuario'])):
    $id = mysqli_escape_string($connect, $_POST['id']);

    $sql = "DELETE FROM usuario WHERE id = '$id'";

    if(mysqli_query($connect, $sql)):
        $_SESSION['mensagem'] = "Deletado com sucesso!";
        header('Location: ../usuarios/listUsuario.php?sucesso');
    else:
        $_SESSION['mensagem'] = "Erro ao deletar!";
        header('Location: ../usuarios/listUsuario.php?sucesso');
    endif;
endif;