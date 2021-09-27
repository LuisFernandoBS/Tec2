<?php

require_once('../model/contato.php');
session_start();
$associado=$_SESSION['cod'];

$op=$_POST['op'];

$contato = new Contato;

if($op==0){
    $nome=$_POST['nome'];
    $celular=$_POST['celular'];
    $email=$_POST['email'];
    $grupo=$_POST['grupo'];
    $operadora=$_POST['operadora'];
    

    $contato->cadastrarContato($nome, $grupo, $celular, $email, $associado,$operadora);

}elseif ($op==1) {
    $nome=$_POST['nome'];
    $celular=$_POST['celular'];
    $celAnt=$_POST['celAnt'];
    $email=$_POST['email'];
    $grupo=$_POST['grupo'];

    $contato->editarContato($nome,$celular,$celAnt,$email,$grupo,$associado);

}elseif ($op==2) {
    $celular=$_POST['celular'];
    $contato->deletarContato($celular, $associado);
}




?>