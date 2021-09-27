<?php
session_start();
if(isset($_SESSION["cod"])){
$nome = $_SESSION["nome"];

echo $nome;
}
?>