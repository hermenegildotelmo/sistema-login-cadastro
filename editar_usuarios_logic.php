<?php
include("config.php");
session_start();

if(isset($_POST['Edit_btn'])){
    if(!empty($_POST['id_ed']) AND !empty($_POST['nome_ed'])
     AND !empty($_POST['email_ed'])){

        try{

            $id = $_POST['id_ed'];
            $nome = $_POST['nome_ed'];
            $email= $_POST['email_ed'];
            
            $editar_usuario = $conn->prepare("UPDATE usuario SET nome = :n, email = :e WHERE id =:i");
            $parametros = [
                ':n' => $nome,
                ':e' => $email,
                ':i' => $id,
            ];
            
            $result = $editar_usuario->execute($parametros);
            if($result){
                $_SESSION['msg'] = "Editado com sucesso";
                header("location: mostrar_usuarios.php");
            }else{
                $_SESSION['msg'] = "Editado com sucesso";
                header("location: mostrar_usuarios.php");
            }
        }catch(PDOException $e){
            $e->getMessage();
        }
        
    }else{
        $_SESSION['msg'] = "Preencha os campos!";
        header("location: mostrar_usuarios.php");
    }       
}