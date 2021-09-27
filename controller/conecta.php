<?php

    require_once('usuario.php');

    error_reporting(E_ALL);
    ini_set('display_errors', 'On');

    $user = $_POST["user"];
    $senha = $_POST["senha"];
    
    $usuario = new Usuario;

    $infor=$usuario->Valida($user,$senha);
        if ($usuario->Getnome()){
            session_start();
            echo $usuario->Getnome();
            $_SESSION['cod'] = $usuario->Getcod();
            $_SESSION['nome'] = $usuario->Getnome();
        }else{
        }
    
    
?>