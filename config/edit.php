<?php
 //Iniciar sessão
session_start();
//Conexão
require_once 'db_connect.php';

//Inserir dados do form de clientes
if (isset($_POST['btn-edit-cliente'])): 
    $id = mysqli_escape_string($connect, $_POST['id']);
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $email = mysqli_escape_string($connect, $_POST['email']);
    $endereco = mysqli_escape_string($connect, $_POST['endereco']);
    $numero = mysqli_escape_string($connect, $_POST['numero']);
    $bairro = mysqli_escape_string($connect, $_POST['bairro']);
    $cidade = mysqli_escape_string($connect, $_POST['cidade']);
    $cep = mysqli_escape_string($connect, $_POST['cep']);
    $estado = mysqli_escape_string($connect, $_POST['estado']);
    $cpf = mysqli_escape_string($connect, $_POST['cpf']);
    $telefone = mysqli_escape_string($connect, $_POST['telefone']);
    $site = mysqli_escape_string($connect, $_POST['site']);

    $sql = "UPDATE cliente SET nome = '$nome', endereco = '$endereco', numero = '$numero',
     bairro = '$bairro', cidade = '$cidade', uf = '$estado', cep = '$cep', email = '$email', 
     cpf = '$cpf', telefone = '$telefone', site = '$site' WHERE id = '$id'";

    if (mysqli_query($connect, $sql)): 
        $_SESSION['mensagem'] = "Atualizado com sucesso!";
        header('Location: ../clientes/listCliente.php?sucesso');
    else: 
        $_SESSION['mensagem'] = "Erro ao atualizar!";
        header('Location: ../clientes/listCliente.php?sucesso');
    endif;
endif;

//Inserir dados do form de usuarios
if (isset($_POST['btn-edit-usuario'])): 
    $id = mysqli_escape_string($connect, $_POST['id']);
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $login = mysqli_escape_string($connect, $_POST['login']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);
    if ($senha == "***"):
        $sql = "UPDATE usuario SET nome = '$nome', login = '$login' WHERE id = '$id'";
    else:
        $senhaCodificada = md5($senha);

        $sql = "UPDATE usuario SET nome = '$nome', login = '$login', senha = '$senhaCodificada'
            WHERE id = '$id'";
    endif;
    if (mysqli_query($connect, $sql)): 
        $_SESSION['mensagem'] = "Atualizado com sucesso!";
        header('Location: ../usuarios/listUsuario.php?sucesso');
    else: 
        $_SESSION['mensagem'] = "Erro ao atualizar!";
        header('Location: ../usuarios/listUsuario.php?sucesso');
    endif;
endif;
