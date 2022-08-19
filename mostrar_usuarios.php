<?php 
include('config.php');
session_start(); 

if(isset($_SESSION['usuario'])){
    $usuario =  $_SESSION['usuario']; 
}else{
    $usuario = "";
}

if(isset($_GET['logout'])){
session_destroy();
session_unset();
header("location: login.php");
}

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    $delete_usuario = $conn->prepare("DELETE FROM usuario WHERE id=?");
    $delete_usuario->execute([$delete_id]);
    $_SESSION['delete'] = "ELIMINAR COM SUCESSO?";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Gerir Usuários</title>
</head>
<body>
    <header>
        <div class="usuario-group">
        <div class="usuario">
        <?php 
        $usuarioLogado = $conn->prepare("SELECT * FROM usuario WHERE id = :id_usuario");
        $paramentros = [':id_usuario' => $usuario];
        $usuarioLogado->execute($paramentros);
        if($usuarioLogado->rowCount() > 0){
            while($row = $usuarioLogado->fetch(PDO::FETCH_OBJ)){  
            echo '<span class="nome_usuario">'. $row->nome.'</span>';
            echo '<span class="status">Act.</span>';
            echo '<span class="logout"><a href="mostrar_usuarios.php?logout">Sair</a></span>';
            }
        }else{
          header("location: login.php");  
        };
        ?>
       
        </div>
    </div>
    </header>
    <h1 class="center">Usuarios</h1>
    <div class="table">
        <table>
            <table>
                <?php if(isset($_SESSION['msg'])): ?>
                    <h1><?= $_SESSION['msg']; ?></h1>
                    <?php unset( $_SESSION['msg']); ?>
                <?php endif; ?>
        <caption>Usuários cadastrados</caption>
        <thead>
            <tr>
                <th>id</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Data</th>
            </tr>
        </thead>
        
        <?php 
            $selecionar_usuarios = $conn->prepare("SELECT * FROM usuario");
            $selecionar_usuarios->execute();
            
            if($selecionar_usuarios->rowCount() > 0){
                while($row = $selecionar_usuarios->fetch(PDO::FETCH_OBJ)){
                   
            ?>
            <tbody>
            <tr>
                <td><?= $row->id; ?></td>
                <td><?= $row->nome; ?></td>
                <td><?= $row->email; ?></td>
                <td><?= $row->created_at; ?></td>
                <td><a href="editar_usuarios.php?edit=<?= $row->id;?>">Editar</a></td>
                <td><a href="mostrar_usuarios.php?delete=<?= $row->id;?>"; onclick="return confirm('tens acerteza?')">Eliminar</a></td>
            </tr>
        </tbody>
        <?php     
            }
        }
        ?>
    </table>
    </div>
</body>
</html>