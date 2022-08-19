<?php 
session_start();
if(isset($_SESSION['usuario'])){
    header("location: mostrar_usuarios.php"); 
}else{
    $usuario = "";
}


?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Sistema de login</title>
</head>
<body>
    <div class="container-login">
        <span class="heading">Login</span>
        <?php if(isset($_SESSION['erro'])):?>
        <div class="message">
            <span><?= $_SESSION['erro'];?></span>
            <?php unset($_SESSION['erro']);?>  
        </div>
        <?php endif; ?>
    <form action="login_logic.php" method="post">
        <input type="text" name="email_login" placeholder="Seu email">
        <input type="text" name="pass_login" placeholder="Sua password">
        <input type="submit" name="loginBtn" class="submitbtn" value="Login">
    </form>
    <a href="formulario.php">Ainda não é cadastrado?</a>
    </div>
</body>
</html>