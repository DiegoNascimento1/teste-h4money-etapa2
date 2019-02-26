<?php
//Iniciar sessão
session_start();
//Conexão
require_once 'db_connect.php';

//Inserir dados do form de clientes
if(isset($_POST['btn-create-cliente'])):
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

    $sql = "INSERT INTO cliente (nome, endereco, numero, bairro,
        cidade, uf, cep, email, cpf, telefone, site) VALUES ('$nome', '$endereco',
        '$numero', '$bairro', '$cidade', '$estado', '$cep', '$email', '$cpf', '$telefone', '$site')";

    if(mysqli_query($connect, $sql)):
        $_SESSION['mensagem'] = "Cadastrado com sucesso!";
        header('Location: ../clientes/listCliente.php?sucesso');
    else:
        $_SESSION['mensagem'] = "Erro ao cadastrar!";
        header('Location: ../clientes/listCliente.php?erro');
    endif;
endif;

//Inserir dados do form de usuarios
if(isset($_POST['btn-create-usuario'])):
    $nome = mysqli_escape_string($connect, $_POST['nome']);
    $login = mysqli_escape_string($connect, $_POST['login']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);
    $senhaCodificada = md5($senha);
    $sql = "INSERT INTO usuario (nome, login, senha) 
    VALUES ('$nome', '$login', '$senhaCodificada')";

    if(mysqli_query($connect, $sql)):
        $_SESSION['mensagem'] = "Cadastrado com sucesso!";
        header('Location: ../usuarios/listUsuario.php?sucesso');
    else:
        $_SESSION['mensagem'] = "Erro ao cadastrar!";
        header('Location: ../usuarios/listUsuario.php?erro');
    endif;
endif;