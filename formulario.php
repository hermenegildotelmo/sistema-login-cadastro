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
    <title>Formulário</title>
</head>
<body>
    <div class="container-form">
        <span class="heading">Formulário</span>
       <?php if(isset($_SESSION['msg'])):?>
        <div class="message">
            <span><?= $_SESSION['msg'];?></span>
            <?php unset($_SESSION['msg']);?>
        </div>
        <?php endif;?>
    <form action="form_logic.php" method="post">
        <div class="form-group">
        <input type="text" name="nome_usuario" placeholder="Nome">
        </div>
        <div class="form-group">
        <input type="text" name="email_usuario" placeholder="Email">
        </div>
        <div class="form-group">
        <input type="text" name="pass_usuario" placeholder="Password">
        </div>
        <div class="form-group">
        <input type="text" name="pass_usuario1" placeholder="confirmar password">
        </div>
        <div class="form-group">
        <input type="submit" name="forBtn" class="submitbtn" value="Cadastrar-me">
        </div>
    </form>
    <a class="aConta" href="login.php" >Já cadastrou?</a>
    </div>
</body>
</html>