<?php 
session_start();
include("config.php");
if(!isset($_SESSION['usuario'])){
    header("location: mostrar_usuarios.php"); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Editar usuários</title>
</head>
<body>
    <div class="container">
        <div class="editar_">
            <span class="heading">Editar usuário</span>
        <?php 
        
        if(isset($_GET['edit'])){
           $editar = $_GET['edit'];

           $selecionar_usuarios = $conn->prepare("SELECT * FROM usuario WHERE id = :id_editar");
           $parametros = [
            ':id_editar' => $editar
           ];
           $selecionar_usuarios->execute($parametros);
         $result = $selecionar_usuarios->fetch(PDO::FETCH_OBJ);
        }
        ?>
        <form action="editar_usuarios_logic.php" method="post">
            <input type="hidden" name="id_ed" value="<?= $result->id;?>">
            <input type="text" name="nome_ed" value="<?= $result->nome;?>">
            <input type="email" name="email_ed" value="<?= $result->email;?>">
            <input type="submit" class="submitbtn" name="Edit_btn" value="Editar">
        </form>

        </div>
    </div>
</body>
</html>