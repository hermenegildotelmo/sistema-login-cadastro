<?php 
include("config.php");
session_start();

if(isset($_POST['loginBtn'])){
    if(!empty($_POST['email_login']) AND !empty($_POST['pass_login']) ){
        $email_login = $_POST['email_login'];
        $email_login = filter_var($email_login, FILTER_SANITIZE_STRING);
        $pass_login = sha1($_POST['pass_login']);
        $pass_login = filter_var($pass_login, FILTER_SANITIZE_STRING);

        $selecionar_usuario = $conn->prepare("SELECT * FROM usuario WHERE email = :em and senha = :se");
        $parametros = [
            ':em' => $email_login,
            ':se' => $pass_login
        ];
        $selecionar_usuario->execute($parametros);
        $usuario = $selecionar_usuario->fetch(PDO::FETCH_OBJ);

        if($selecionar_usuario->rowCount() >0){
            echo $_SESSION['usuario'] = $usuario->id;
            header("location: mostrar_usuarios.php");
        }else{
            $_SESSION['erro'] = "Tente novamente";
            header("location: login.php");
        }
        
    }else{
        $_SESSION['erro'] = "Preencha os campos!";
        header("location: login.php");
    }
}


//     [email_login] => te@gamil.com
//     [pass_login] => 111111
//     [loginBtn] => Login

