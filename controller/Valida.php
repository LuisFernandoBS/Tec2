<?php

    require_once('../model/contato.php');

    session_start();
    if(isset($_SESSION["cod"])){
    $cod = $_SESSION["cod"];
    $nome = $_SESSION["nome"];
    
    $contato = new Contato;

    $infor=$contato->listarContato($cod);
    
    echo $infor;


    }
?>