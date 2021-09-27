<html>
<head>
  <title>Login</title>
  <link rel="icon" type="imagem/png" href="view/img/log.png" />
<!-- UIkit CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.2.2/dist/css/uikit.min.css" />

<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.2.2/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.2.2/dist/js/uikit-icons.min.js"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="view/js/jquery-3.4.1.min.js"></script>
<script src="view/js/FormJ.js"></script>

</head>

<body>
    <div class="uk-card uk-card-default uk-width-1-2@s uk-position-center">
    <div class="uk-card-header">
        <div class="uk-grid-small uk-flex-middle" uk-grid>
            <div class="uk-width-auto">
            <!-- ___________IMAGEM DO FORMULARIO__________________  -->
                <img class="uk-border-circle" width="40" height="40" src="view/img/user.jpg">
            </div>
            <div class="uk-width-expand">
            <!-- ___________TITULO DO FORMULARIO__________________  -->
                <h3 class="uk-card-title uk-margin-remove-bottom">LOGIN</h3>
            </div>
        </div>
    </div>
    <div class="uk-card-body">
    <!-- ___________CAMPOS DO FORMULARIO__________________  -->
        <form>

        <div class="uk-margin">
            <div class="uk-inline">
                <span class="uk-form-icon" uk-icon="icon: user"></span>
                <input id="user" class="uk-input" type="text" >
            </div>
        </div>

        <div class="uk-margin">
            <div class="uk-inline">
                <span class="uk-form-icon uk-form-icon" uk-icon="icon: lock"></span>
                <input id="senha" type="password" class="uk-input" type="text">
            </div>
        </div>

    </form>
    </div>
    <div class="uk-card-footer">
    <!-- ___________BUTÕES DO FORMULARIO__________________  -->
        <button id="cad" style="margin-right: 39px;" type="button" class="btn btn-outline-success" onclick="Logar()" uk-icon="icon: sign-in">Entrar</button>
        <button type="button" class="btn btn-outline-info" onclick="LimparF()"  uk-icon="icon: trash">Limpar</button>
    </div>
</div>

    
</body>

</html>