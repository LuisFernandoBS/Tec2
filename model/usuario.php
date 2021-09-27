<?php
include_once 'conexao.php'; 
class Usuario{
    public $nome;
    public $cod;

    public function Getcod(){
        return $this->cod;
    }

    public function Setcod($cod){
        $this->cod=$cod;
    }

    public function Getnome(){
        return $this->nome;
    }
    
    public function Setnome($nome){
        $this->nome=$nome;
    }

    public function Valida($usuario,$sen)
    {

        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("SELECT * FROM tb_usuarios WHERE usuario=:usuario");
        $stmt->execute(['usuario' => $usuario]); 
        $result = $stmt->fetch();
        if ($result['usuario'] == $usuario) {
            if ($sen==$result['senha']){
                Usuario::Setcod($result['cod']);
                Usuario::Setnome($result['nome']);
            }else{
                echo("0");
            }
            
        }else{
        return false;
        }
    }
}
?>