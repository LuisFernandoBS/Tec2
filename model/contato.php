<?php
include_once 'conexao.php'; 
class Contato{
    public $nome;
    public $celular;
    public $email;
    public $grupo;

    function cadastrarContato($nome, $grupo, $celular, $email, $associado,$operadora){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO tb_agenda (nome,celular,email,grupo,associado,operadora) VALUES(:nome,:cel,:mail,:grupo,:associado,:operadora)');
        $stmt->execute(array(
            ':nome' => $nome,
            ':cel' => $celular,
            ':mail' => $email,
            ':grupo'=> $grupo,
            ':associado'=>$associado,
            ':operadora'=>$operadora
        ));
        $result = $stmt;
        echo 1;
    }
    
    function listarContato($cod){
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("SELECT * FROM tb_agenda WHERE associado=:associado");
        $stmt->execute(['associado' => $cod]);
        $result = $stmt->fetchAll();
        echo json_encode($result);
    }

    function deletarContato($celular,$associado){
       try {
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("DELETE  FROM tb_agenda WHERE celular=:celular and associado=:associado");
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':associado', $associado); 
        $stmt->execute();
         echo 1;
       } catch (\PDOException $e) {
        echo $e;
       }
        
    }
    function editarContato($nome,$celular,$celAnt,$email,$grupo,$associado){
        try {
            $conexao = Conexao::getInstance();
            $stmt = $conexao->prepare('UPDATE tb_agenda SET nome = :nome , celular = :celular , email = :email , grupo = :grupo WHERE celular = :celAnt and associado = :associado');
            $stmt->execute(array(
                ':nome' => $nome,
                ':celular'=> $celular,
                ':email' => $email,
                ':grupo' => $grupo,
                ':associado' => $associado,
                ':celAnt'=> $celAnt
            ));
            echo 1;
        } catch (\PDOException $e) {
            echo $e;
        }
    }

}


?>