<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Agenda</title>
  <link rel="icon" type="imagem/png" href="img/agenda.png" />
    <!-- UIkit -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/css/uikit.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit-icons.min.js"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!--SweetAlert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!--Artyon-->
    <script src="js/artyom.js"></script>
    <!--Chart.js-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <!-- Jquery-->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <!-- JS-->
    <script src="js/dash.js"></script>
    <!--CSS-->
    <link rel="stylesheet" href="css/tema.css">
    
</head>
<body onload="Carrega()">
<!--PARTE SUPERIOR-->
<nav id="nav" class="uk-navbar uk-navbar-container uk-margin">
        <div class="uk-navbar-left">
            <a class="uk-navbar-toggle" uk-navbar-toggle-icon uk-toggle="target: #offcanvas-push"></a>
        </div>
        <h3 id="titulo">AGENDA</h3>
    </nav>
<!--ABA LATERAL-->
    <div id="offcanvas-push" uk-offcanvas="mode: push; overlay: true">
            <div id="aba" class="uk-offcanvas-bar">
        
                <button id="BtnA" class="uk-offcanvas-close" type="button" uk-close></button>
                <img id="Iperfil" src="img/user3.png">
                <h3 id="Nome">PERFIL</h3>
                <ul class="uk-nav uk-nav-primary uk-nav-center uk-margin-auto-vertical">
                    
                <li><a class="linhas" onclick="DHome()"><span class="uk-margin-small-right" uk-icon="icon: home;ratio:1.2"></span>HOME</a></li>
                <li><a class="linhas" onclick="Dddd()"><span class="uk-margin-small-right" uk-icon="icon: world;ratio:1.2"></span>DDD</a></li>
                <li><a class="linhas" onclick="DGrafico()"><span class="uk-margin-small-right" uk-icon="icon: bolt;ratio:1.3"></span>GRAFICOS</a></li>
                </ul>
            </div>
        </div>
</div>
<div id="DHOME" style="display:block">
    <!-- Barra de Pesquisa -->
    <nav class="uk-navbar-container" uk-navbar>
        <div class="uk-navbar-left">

            <div class="uk-navbar-item">
                <form class="uk-search uk-search-navbar">
                    <span uk-search-icon></span>
                    <input class="uk-search-input" type="search" id="Buscador" placeholder="Search...">
                </form>
            </div>

        </div>
    </nav>
    <!-- Tabela de Contatos -->
      <table id="TB_contato" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
      <thead >
        <tr id="tituloTabela">
          <td class="th-sm">
          Nome  <span class="uk-margin-small-right" uk-icon="user"></span>
          </td>
          <td class="th-sm">
          Grupo   <span class="uk-margin-small-right" uk-icon="users"></span>
          </td>
          <td class="th-sm">
          Celular  <span class="uk-margin-small-right" uk-icon="phone"></span>
          </td>
          <td class="th-sm">
          Operadora  <span class="uk-margin-small-right" uk-icon="rss"></span>
          </td>
          <td class="th-sm">
          Email   <span class="uk-margin-small-right" uk-icon="mail"></span>
          </td>
          <td class="th-sm" style="text-align:center;">
          Editar
          </td>
          <td class="th-sm" style="text-align:center;">
          Deletar
          </td>
        </tr>
      </thead>
      <tbody id="corpoTabela" >
        
      </tbody>
      <tfoot>
        <tr>
          <th>Nome
          </th>
          <th>Grupo
          </th>
          <th>Celular
          </th>
          <th>Operadora
          </th>
          <th>Email
          </th>
          <th>Editar
          </th>
          <th>Deletar
          </th>
        </tr>
      </tfoot>
    </table>
    <!-------- Modal EDITAR ------------>
    <div id="MEditar" uk-modal>
        <div class="uk-modal-dialog">
            <button id="FEditar" onclick="Limpar('E')" class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Editar</h2>
            </div>
            <div class="uk-modal-body">
            <form class="was-validated">

              <div class="mb-1">
                <label for="Txtnome">Nome:</label>
                <input id="E_nome" type="text" class="form-control is-invalid" onblur="verificado(this)" id="Txtnome" placeholder="" required></input>
                <div class="invalid-feedback">
                Por Favor digite o nome.
                </div>
              </div>

              <label for="Txtcel">Celular:</label>
                  <div class="form-row">
                      <div class="col">
                        <input id="E_celular" type="text" class="form-control is-invalid" onkeypress="MASK(this.id)" onblur="pesquisa(this.id,'respostaE');verificado(this)" style="width: 430px;" required></input>
                        <div class="invalid-feedback">
                        Por Favor digite o numero celular.
                        </div>
                      </div>
                      <div class="col-mb-6">
                        <img src="img/Desconhecida.png" id="respostaE" opr="" style="width: 70px;height: 45px;"></img>
                      </div>
                  </div>

              <div class="mb-1">
                <label for="Txtemail">Email:</label>
                <input id="E_email" type="text" class="form-control is-invalid" onblur="verificado(this)" id="Txtemail" placeholder="" required></input>
                <div class="invalid-feedback">
                Por Favor digite o email.
                </div>
              </div>
              <label for="validationTextarea">Grupo:</label>
                <div class="form-group">
                  <select class="custom-select" id="E_sgrupo" required>
                    <option id="E_grupo" value=""></option>
                    <option value="Familia">Familia</option>
                    <option value="Trabalho">Trabalho</option>
                    <option value="Amigo(a)">Amigo(a)</option>
                    <option value="Escola">Escola</option>
                  </select>
                  <div class="invalid-feedback">Por Favor escolha um Grupo</div>
                </div>
            </form>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" onclick="Limpar('E')" type="button">CANCELAR</button>
                <button id='ESalvar' class="uk-button uk-button-primary" onclick="Edicao()" type="button">SALVAR</button>
            </div>
        </div>
    </div>

      
    <!---------- Button modal ADD ------------>
    <button id="add" type="button"  class="btn btn-outline-info rounded-circle" uk-icon="icon:  plus; ratio: 1.5" data-toggle="modal" data-target="#MADD"></button>

    <!-------- Modal ADD --------------->
    <div class="modal fade" id="MADD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ADICIONAR CONTATO</h5>
            <button id="FADD" type="button" class="close" onclick="Limpar('A')" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form class="was-validated">

                  <div class="col-mb-1">
                    <label for="Txtnome">Nome:</label>
                    <input id="A_nome" type="text" class="form-control is-invalid" onblur="verificado(this)" required></input>
                    <div class="invalid-feedback" style="display:block">
                    Por Favor digite o nome.
                    </div>
                  </div>
                  <label for="Txtcel">Celular:</label>
                  <div class="form-row">
                      <div class="col">
                        <input id="A_celular" type="text" class="form-control is-invalid" onkeypress="MASK(this.id)" onblur="pesquisa(this.id,'resposta');verificado(this)" style="width: 390px;" required></input>
                        <div class="invalid-feedback">
                        Por Favor digite o numero celular.
                        </div>
                      </div>
                      <div class="col-mb-6">
                        <img src="img/Desconhecida.png" id="resposta" opr="" style="width: 66px;height: 45px;"></img>
                      </div>
                  </div>

                  <div>
                    <label for="Txtemail">Email:</label>
                    <input id="A_email" type="text" class="form-control is-invalid" onblur="verificado(this)" required></input>
                    <div class="invalid-feedback">
                    Por Favor digite o email.
                    </div>
                  </div>

                  <label for="validationTextarea">Grupo:</label>
                    <div class="form-group">
                      <select id="A_grupo" class="custom-select" required>
                        <option value="Familia">Familia</option>
                        <option value="Trabalho">Trabalho</option>
                        <option value="Amigo(a)">Amigo(a)</option>
                        <option value="Escola">Escola</option>
                      </select>
                      <div class="invalid-feedback">Por Favor escolha um Grupo</div>
                    </div>
              </form>

          </div>
          <div class="modal-footer">
            <button type="button" onclick="Limpar('A')" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
            <button type="button" onclick="inserir()" class="btn btn-primary">SALVAR</button>
          </div>
        </div>
      </div>
    </div>
</div>
<div id="GRAFICOS" style="display:none">
  <!--GRAFICOS-->
          <div id="DG" class="uk-grid-collapse" uk-grid>
                <div id="tagG" class="uk-child-width-1-1" uk-grid>
                    <div id="GTC">
                        <div class="TT">CONTATOS TOTAL</div>
                        <div id="TV">1000</div>
                    </div>
                    <div id="GTD">
                            <div class="TT">OPERADORAS DESCONHECIDAS</div>
                            <div id="TD">800</div>
                    </div>
                </div>

                <div id="DG1">
                    <div class="TG">GRUPOS</div>
                    <canvas id="G1" width="20" height="20"></canvas>
                </div>
                <div id="DG2">
                    <div class="TG">OPERADORAS</div>
                    <canvas id="G2" width="20" height="20"></canvas>
                </div>
          </div>
</div>
<!--DDD-->
<div id="DDD" style="display:none">
        <select id="estados" class="form-control" onchange="cidades(this.value)">
        <option value="">Escolha a UF</option>
        </select>
  <!-- Barra de Pesquisa -->
  <nav class="uk-navbar-container" uk-navbar>
      <div class="uk-navbar-left">

          <div class="uk-navbar-item">
              <form class="uk-search uk-search-navbar">
                  <span uk-search-icon></span>
                  <input class="uk-search-input" type="search" id="search" placeholder="Search...">
              </form>
          </div>

      </div>
  </nav>
        <!--tabela de cidades-->
        <table id="TB_Cidades" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead >
              <tr id="tituloTabela">
                <td class="th-sm">
                    Cidade  <span class="uk-margin-small-right" uk-icon="user"></span>
                </td>
                <td class="th-sm">
                    DDD   <span class="uk-margin-small-right" uk-icon="users"></span>
                </td>
                
              </tr>
            </thead>
            <tbody id="cidades" >
              
            </tbody>
            <tfoot>
              <tr>
                <th>Cidade
                </th>
                <th>DDD
                </th>
                
            </tfoot>
          </table>

</div>

</body>
