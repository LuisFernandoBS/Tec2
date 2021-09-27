function LimparF() {
    document.getElementById("user").value="";
    document.getElementById("senha").value="";
}
function Logar() {
    var user=document.getElementById("user").value;
    var senha=document.getElementById("senha").value;
    
    
        $.ajax({
            type: 'POST',
            async:false,
            data:{user:user,senha:senha},
            url: './controller/conecta.php', //caminho do arquivo a ser executado
            dataType: 'json', //tipo do retorno
            complete: function(data){
                console.log(data.responseText);
                   if (data.responseText!=""){
                    if(data.responseText=="0"){
                        UIkit.notification({message: 'Senha invalida!', status: 'danger'});
                    }else{
                        window.location.href = "view/dashboard.php";
                    }
                   }else{
                    UIkit.notification({message: 'Usuario Invalido!', status: 'danger'});
                   }
                }
            
        });

}