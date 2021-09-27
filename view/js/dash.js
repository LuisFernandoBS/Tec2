function geradorLinha(pessoa) {
  let titulos = document.querySelector("#tituloTabela")
  let tr = document.createElement("tr")
  let childrens = titulos.children

  for (let i = 0; i < childrens.length; i++) {

    let td = document.createElement("td")

    if (childrens[i].textContent.trim() !== "Editar" && childrens[i].textContent.trim() !== "Deletar") {

      td.textContent = pessoa[childrens[i].textContent.trim().toLowerCase()]

    } else {
      let button = document.createElement("a")
      button.title = childrens[i].textContent.trim()
      if(childrens[i].textContent.trim() =="Editar"){

        button.setAttribute("uk-icon","icon: pencil")
        button.setAttribute("href","#MEditar")
        let att = document.createAttribute("uk-toggle")
        button.setAttributeNode(att);

      }else{
        button.setAttribute("uk-icon","icon: trash")
      }
      td.style.textAlign="center";

      button.addEventListener("click", () => {
        executarFuncao(pessoa, childrens[i].textContent.trim(),button)
      })
      td.appendChild(button)
    }

    tr.appendChild(td)
  }

  return tr
}

function executarFuncao(pessoa, filtro,btn) {
  switch (filtro) {
    case "Editar":
      editar(pessoa)
      break
    case "Deletar":
      deletar(pessoa,btn)
      break
  }
}

function editar(pessoa) {

  console.log(pessoa)
  let chaves = Object.keys(pessoa);
  chaves.forEach((elemento) => {
    let campo = document.querySelector("#E_"+elemento);
    if (campo!=null) {
      if (elemento!='grupo') {
        campo.setAttribute("placeholder",pessoa[elemento])
      } else if (elemento=='grupo')  {
        campo.value=pessoa[elemento]
        campo.innerHTML=pessoa[elemento]
      }
    }
  })
  document.querySelector("#respostaE").src="img/"+pessoa['operadora']+".png"
  document.querySelector("#respostaE").setAttribute("opr",pessoa['operadora'])



}

function Edicao() {
  let nome = document.getElementById("E_nome");
  let celular = document.getElementById("E_celular");
  let email = document.getElementById("E_email");
  let grupo = document.getElementById("E_sgrupo");
  let celAnt = celular.getAttribute("placeholder")

  let dados = [nome,celular,email,grupo]
  
  dados.forEach((elementos,index)=>{
    if(elementos.value==""){
      dados[index]=elementos.getAttribute("placeholder")
    }else{
      dados[index]=elementos.value
    }
  })
  operadora=document.querySelector("#respostaE").getAttribute("opr")

  dados.push(celAnt);

  console.log(dados)

  $.ajax({
    type: 'POST',
    async: false,
    data:{op:1,nome:dados[0],celular:dados[1],email:dados[2],grupo:dados[3],celAnt:dados[4],operadora:operadora},
    url: '../controller/operacoes.php', //caminho do arquivo a ser executado
    dataType: 'json', //tipo do retorno
    complete: function (data) {
      console.log(data);
    }

  });
  deletarLinhasTB()
  Carrega()
  Limpar("E")
  document.querySelector("#FEditar").click()
  UIkit.notification(dados[0]+" editado(a) com sucesso", {status:'success'})

}

function deletarLinhasTB(){
  let tabela = document.querySelector('#corpoTabela')
  let tamanhoTB = tabela.childElementCount
  for (let index = tamanhoTB-1; index >= 0; index--) {
    tabela.deleteRow(index);
  }

}

function deletar(pessoa,btn) {

 let celular = pessoa['celular']

  Swal.fire({
    title: 'Apagar contato?',
    text: "Você não poderá reverter isso!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, Exclua-o!',
    cancelButtonText: 'Cancelar!',
  }).then((result) => {
    if (result.value) {

      $.ajax({
        type: 'POST',
        async: false,
        data:{op:2,celular:celular},
        url: '../controller/operacoes.php', //caminho do arquivo a ser executado
        dataType: 'json', //tipo do retorno
        complete: function (data) {
          if (data.responseText==1){
            Swal.fire(
              'Deletado!',
              'Seu contato foi deletado.',
              'success'
            )
            $(btn).parents('tr').remove();
          }
        }
    
      });

    }
  })


  
}


function Carrega() {
  let Lista;

  $.ajax({
    type: 'POST',
    async: false,
    url: '../controller/Valida.php', //caminho do arquivo a ser executado
    dataType: 'json', //tipo do retorno
    complete: function (data) {
      if (data.responseJSON) {
        Lista = data.responseJSON;
      }else{
        window.location.href = "../index.php";
      }
      
    }

  });

  let titulos = document.querySelector("#tituloTabela")


  Lista.forEach((elemento) => {

    let tabela = document.querySelector("#corpoTabela");

    tabela.appendChild(geradorLinha(elemento))

  })


}
function Nome() {
  let nome
  $.ajax({
    type: 'POST',
    async: false,
    url: '../controller/info.php', //caminho do arquivo a ser executado
    dataType: 'json', //tipo do retorno
    complete: function (data) {
        if (data.responseText!="") {
          document.querySelector("#Nome").innerText=data.responseText
        }
    }

  });

}



function inserir() {
  let nome = document.querySelector("#A_nome").value
  let celular = document.querySelector("#A_celular").value
  let operadora=document.querySelector("#resposta").getAttribute("opr")
  let email = document.querySelector("#A_email").value
  let grupo = document.querySelector("#A_grupo").value
  let ok = true;
  let lista=[nome,celular,email,grupo]

  lista.forEach((elemento)=>{

    if (elemento=="") {
      ok = false;
    }

  })

  if (ok==true) {
    $.ajax({
      type: 'POST',
      async: false,
      data:{op:0,nome:nome,celular:celular,email:email,grupo:grupo,operadora:operadora},
      url: '../controller/operacoes.php', //caminho do arquivo a ser executado
      dataType: 'json', //tipo do retorno
      complete: function (data) {
        
      }
  
    });
  
  deletarLinhasTB()
  Carrega()
  Limpar("A")
  document.querySelector("#FADD").click()
  Swal.fire({
    icon: 'success',
    title: 'Contato adicionado com sucesso',
    showConfirmButton: false,
    timer: 1500
  })
}else{
  UIkit.notification("Campo Vazio", {status:'warning',pos: 'bottom-center'})
}
  
}


$(document).ready(function () {
  $("#Buscador").on("keyup", function () {
    let value = $(this).val().toLowerCase();
    $("#TB_contato tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

function pesquisa(id,local) {
  celular=document.querySelector("#"+id).value
  celular=UnMask(celular)
  let operadoras={55351:"Nextel",55314:"Oi",55331:"Oi",55320:"Vivo",55323:"Vivo",55341:"TIM",55321:"Claro",55321:"Claro",55377:"Nextel" }
  let cod;
  $.ajax({
  type: 'POST',
  async: false,
  data:{celular:celular},
  url: 'http://consultas.portabilidadecelular.com/painel/consulta_numero.php?user=stealus&pass=luis123475&search_number='+celular, //caminho do arquivo a ser executado
  dataType: 'json', //tipo do retorno
  complete: function (data) {
      cod = data.responseText
  }
  })

  if(operadoras[cod]!=undefined){
      document.querySelector("#"+local).src="img/"+operadoras[cod]+".png"
      document.querySelector("#"+local).setAttribute("opr",operadoras[cod])
  }else{
      document.querySelector("#"+local).src="img/Desconhecida.png"
      document.querySelector("#"+local).setAttribute("opr","Desconhecida")
  }

}

function MASK(id) {
  $("#"+id).mask("(00) 00009-0000");
}

function UnMask(puro) {
  puro = puro.replace('(', '');
  puro = puro.replace(')', '');
  puro = puro.replace('-', '');
  puro = puro.replace(' ', '');
  return puro
}

function Limpar(Modal){
  document.querySelector("#"+Modal+"_nome").value=""
  document.querySelector("#"+Modal+"_celular").value=""
  document.querySelector("#resposta").setAttribute("opr","Desconhecida")
  document.querySelector("#respostaE").setAttribute("opr","Desconhecida")
  document.querySelector("#resposta").src="img/Desconhecida.png"
  document.querySelector("#respostaE").src="img/Desconhecida.png"
  document.querySelector("#"+Modal+"_email").value=""
  document.querySelector("#"+Modal+"_grupo").value=""
}

function verificado(campo) {
  if (campo.value.trim() != ""){
    $( campo ).next().css( "display", "none" );
  }else{
    $( campo ).next().css( "display", "block" );
  }
}

//Graficos---------------------------------------------

function Charts(dados1,dados2) {

  var ctx = document.getElementById('G1');
  var myChart = new Chart(ctx, {
      type: 'horizontalBar',
      data: {
          labels: ['Familia', 'Amigo(a)', 'Trabalho', 'Escola'],
          datasets: [{
              label: 'Todos',
              data: [dados1['Familia'],dados1['Amigo(a)'],dados1['Trabalho'],dados1['Escola']],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)'
              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
  var ctx = document.getElementById('G2');
  var myChart = new Chart(ctx, {
      type: 'polarArea',
      data: {
          labels: ['Claro', 'Tim', 'Desconhecida', 'Oi', 'Vivo', 'Nextel'],
          datasets: [{
              label: 'Todos',
              data: [dados2['Claro'],dados2['TIM'],dados2['Desconhecida'],dados2['Oi'],dados2['Vivo'],dados2['Nextel']],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
}
function CarregaG(){
  let dados;

  $.ajax({
    type: 'POST',
    async: false,
    url: '../controller/Valida.php', //caminho do arquivo a ser executado
    dataType: 'json', //tipo do retorno
    complete: function (data) {
      dados = data.responseJSON;
    }

  });

  let dados1={'Familia':0,'Amigo(a)':0,'Trabalho':0,'Escola':0}
  let dados2={'Claro':0,'TIM':0,'Desconhecida':0,'Oi':0,'Vivo':0,'Nextel':0}
  dados.forEach((elemento) => {
    let grupo = elemento['grupo']
    dados1[grupo]+=1;    
    let operadora = elemento['operadora']
    dados2[operadora]+=1;    

  })
  document.querySelector("#TV").innerHTML=dados.length
  document.querySelector("#TD").innerHTML=dados2['Desconhecida']

  Charts(dados1,dados2)

}



function DGrafico() {
  let grafico=  document.querySelector("#GRAFICOS").style.display
  if(grafico=="none"){
  document.querySelector("#DHOME").style.display="none"
  document.querySelector("#DDD").style.display="none"
  document.querySelector("#GRAFICOS").style.display="block"
  CarregaG()
  document.querySelector("#BtnA").click()
  }
}
function Dddd() {
  let DDD=  document.querySelector("#DDD").style.display
  if(DDD=="none"){
  document.querySelector("#DHOME").style.display="none"
  document.querySelector("#GRAFICOS").style.display="none"
  document.querySelector("#DDD").style.display="block"
  estados()
  document.querySelector("#BtnA").click()
  }
}
function DHome() {
  let home=  document.querySelector("#DHOME").style.display
  if(home=="none"){
  document.querySelector("#DDD").style.display="none"
  document.querySelector("#GRAFICOS").style.display="none"
  document.querySelector("#DHOME").style.display="block"
  document.querySelector("#BtnA").click()
  }
}

//DDD-----------------------------------------------------

function estados() {
  let estados
  LimparEstados()
  $.ajax({
  type: 'GET',
  async: false,
  url: 'http://ddd.pricez.com.br/estados.json',
  dataType: 'json', //tipo do retorno
  complete: function (data) {
      estados = data.responseJSON['payload']
  }
  })
  estados.forEach(elementos => {
      var x = document.querySelector("#estados");
      var option = document.createElement("option");
      option.value = elementos;
      option.text=elementos;
      x.add(option);
  });
}
function cidades(estado) {
  LimparDDD()
  if (estado!="") {
    let cidades
      $.ajax({
      type: 'GET',
      async: false,
      url: 'http://ddd.pricez.com.br/estados/'+estado+'.json',
      dataType: 'json', //tipo do retorno
      complete: function (data) {
          cidades = data.responseJSON['payload']
      }
      })
      cidades.forEach(element => {
          document.querySelector('#cidades').appendChild(CriaL(element))
      });
  }
}
function CriaL(cidade) {
  let rowCD = document.createElement('td')
  rowCD.innerText=cidade['cidade']
  let rowDDD = document.createElement('td')
  rowDDD.innerText=cidade['ddd']
  let linha = document.createElement('tr')
  linha.appendChild(rowCD)
  linha.appendChild(rowDDD)
  return linha
}
function LimparEstados() {
  let select=document.querySelector("#estados");
  var length = select.options.length;
  for (i = 1; i < length; i++) {
    select.options[i] = null;
  }
}
function LimparDDD() {
  $("#TB_Cidades tr").remove();
}

$(document).ready(function () {
    $("#search").on("keyup", function () {
      let value = $(this).val().toLowerCase();
      $("#TB_Cidades tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
  });
});

//Artyon-------------------------------------------------

var configA=({
  lang:"pt-PT",// A linguagem !
  continuous:true,// reconhece 1 comando e para de escutar!
  listen:true, // Comece a reconhecer
  debug:true, // Mostra tudo no console
  speed:1 // conversa normalmente
});
artyom.initialize(configA);

var comandoBuscaCT = {
  description:"BuscaContato",
  indexes:["buscar *","procurar o nome de *","pesquisar o nome de *","pesquisar por *"],
  smart:true ,
  action:function(i,texto){
    let home=  document.querySelector("#DHOME").style.display
    if(home=="block"){
      document.getElementById("Buscador").value= texto;
      CBuscar()
    }else{
      document.getElementById("search").value= texto;
      CBuscarD()
    }
  }
};

artyom.addCommands(comandoBuscaCT);

var comandoLimpaB = {
  description:"LimpaBusca",
  indexes:["limpar busca","limpar"],
  action:function(){
    let home=  document.querySelector("#DHOME").style.display
    if(home=="block"){
      document.getElementById("Buscador").value= "";
      CBuscar()
    }else{
      document.getElementById("search").value= "";
      CBuscarD()
    }
  }
};

artyom.addCommands(comandoLimpaB);

function CBuscar() {
  let value = document.getElementById("Buscador").value;
      $("#TB_contato tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
  
}
function CBuscarD() {
  let value = document.getElementById("search").value;
      $("#TB_Cidades tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
  
}


var comandoGraficos = {
  description:"Grafico",
  indexes:["ver gráficos","gráficos","ir para gráficos","ir para os gráficos"],
  action:function(){
    DGrafico()
  }
};

artyom.addCommands(comandoGraficos);

var comandoDDD = {
  description:"DDD",
  indexes:["procurar ddd","ddd","ir para ddd"],
  action:function(){
    Dddd()
  }
};

artyom.addCommands(comandoDDD);

var comandoHome = {
  description:"Home",
  indexes:["ver home","home","voltar pro home","voltar para o inicio","ir para o inicio","ir para home","inicio","voltar para o home","voltar pro inicio"],
  action:function(){
    DHome()
  }
};

artyom.addCommands(comandoHome);

var comandoUF = {
  description:"UF",
  indexes:["procurar estado *","estado *","ir para estado *","selecionar estado *","selecione estado *","selecione a estado *"],
  smart:true,
  action:function(i,texto){
    let ddd=document.querySelector("#DDD").style.display
    if(ddd=="block"){
      BuscaUF(texto)
    }
  }
};

artyom.addCommands(comandoUF);


function BuscaUF(uf) {
  uf = uf.toUpperCase()
  let ok = false
  let estados=document.querySelector('#estados')
  for (var i = 0; i < estados.length; i++) {
    if(estados.options[i].value==uf){
      estados.options[i].selected = true
      cidades(estados.options[i].value)
      ok = true
    }
  }
  if (ok==false) {
    UIkit.notification("Não encontrei está UF", {status:'danger'})
    artyom.say('Não encontrei esta   UF')
  }
}