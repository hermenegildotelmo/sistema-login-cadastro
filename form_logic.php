<?php
include("config.php");
session_start();

if(isset($_POST['forBtn'])){
    if(!empty($_POST['nome_usuario']) AND !empty($_POST['email_usuario']) 
    AND !empty($_POST['pass_usuario']) AND !empty($_POST['pass_usuario1']) ){
        
    $nome_usuario = $_POST['nome_usuario'];
    $nome_usuario = filter_var($nome_usuario, FILTER_SANITIZE_STRING);
    $email_usuario = $_POST['email_usuario'];
    $email_usuario = filter_var($email_usuario, FILTER_SANITIZE_STRING);
    $pass_usuario = sha1($_POST['pass_usuario']);
    $pass_usuario = filter_var($pass_usuario, FILTER_SANITIZE_STRING);
    $pass_usuario1 = sha1($_POST['pass_usuario1']);
    $pass_usuario1 = filter_var($pass_usuario1, FILTER_SANITIZE_STRING);

    $selecionar_usuario = $conn->prepare("SELECT * FROM usuario WHERE email = :em AND senha = :se");
    $parametros = [
        ':em' => $email_usuario,
        ':se' => $pass_usuario1
    ];
    $selecionar_usuario->execute($parametros);
    if($selecionar_usuario->rowCount() >0){
        $_SESSION['msg'] = "Usuario já existente!";
            header("location: formulario.php");
    }else{
        if($pass_usuario !== $pass_usuario1){
            $_SESSION['msg'] = "As senhas não são iguais!";
            header("location: formulario.php");
        }else{
            $inserir_usuario = $conn->prepare("INSERT INTO usuario(nome,email,senha,created_at)VALUES(?,?,?,NOW())");
            $inserir_usuario->execute([$nome_usuario,$email_usuario,$pass_usuario1]);
            header("location: login.php");
        }
    }
    }else{
        $_SESSION['msg'] = "Preencha todos os campos!";
        header("location: formulario.php");
    }
}

// [nome_usuario] => Telmo
// [email_usuario] => test.exp09@gmail.com
// [pass_usuario] => 111
// [pass_usuario1] => 111
// [forBtn] => Cadastrar-me