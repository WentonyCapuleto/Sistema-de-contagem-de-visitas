

<?php 

// if(!isset($_SESSION['login'])){

//     header("location: /barhaaram/adm/login.php");

// }

?>  

<?php

include('protect.php');

?>

  <html>

  <head>

    <link rel="shortcut icon" href="../imgs/favicon.ico" type="image/x-icon">

    <style>

        @import url(//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css);

        @import url(https://fonts.googleapis.com/css?family=Titillium+Web:300);

        .fa-2x {

        font-size: 2em;

        }

        .fa {

        position: relative;

        display: table-cell;

        width: 60px;

        height: 36px;

        text-align: center;

        vertical-align: middle;

        font-size:20px;

        }





        .main-menu:hover,nav.main-menu.expanded {

        width:250px;

        overflow:visible;

        }



        .main-menu {

        background:#212121;

        border-right:1px solid #e5e5e5;

        position:absolute;

        top:0;

        bottom:0;

        height:100%;

        left:0;

        width:60px;

        overflow:hidden;

        -webkit-transition:width .05s linear;

        transition:width .05s linear;

        -webkit-transform:translateZ(0) scale(1,1);

        z-index:1000;

        }



        .main-menu>ul {

        margin:7px 0;

        }



        .main-menu li {

        position:relative;

        display:block;

        width:250px;

        }



        .main-menu li>a {

        position:relative;

        display:table;

        border-collapse:collapse;

        border-spacing:0;

        color:#999;

        font-family: arial;

        font-size: 14px;

        text-decoration:none;

        -webkit-transform:translateZ(0) scale(1,1);

        -webkit-transition:all .1s linear;

        transition:all .1s linear;

        

        }



        .main-menu .nav-icon {

        position:relative;

        display:table-cell;

        width:60px;

        height:36px;

        text-align:center;

        vertical-align:middle;

        font-size:18px;

        }



        .main-menu .nav-text {

        position:relative;

        display:table-cell;

        vertical-align:middle;

        width:190px;

        font-family: 'Titillium Web', sans-serif;

        }



        .main-menu>ul.logout {

        position:absolute;

        left:0;

        bottom:0;

        }



        .no-touch .scrollable.hover {

        overflow-y:hidden;

        }



        .no-touch .scrollable.hover:hover {

        overflow-y:auto;

        overflow:visible;

        }



        a:hover,a:focus {

            text-decoration:none;

        }



        nav {

        -webkit-user-select:none;

        -moz-user-select:none;

        -ms-user-select:none;

        -o-user-select:none;

        user-select:none;

        }



        nav ul,nav li {

        outline:0;

        margin:0;

        padding:0;

        }

        .main-menu li:hover>a,nav.main-menu li.active>a,.dropdown-menu>li>a:hover,.dropdown-menu>li>a:focus,.dropdown-menu>.active>a,.dropdown-menu>.active>a:hover,.dropdown-menu>.active>a:focus,.no-touch .dashboard-page nav.dashboard-menu ul li:hover a,.dashboard-page nav.dashboard-menu ul li.active a {

        color:#fff;

        background-color:#5fa2db;

        }

        .area {

        float: left;

        width: 100%;

        height: 100%;

        }

        @font-face {

        font-family: 'Titillium Web';

        font-style: normal;

        font-weight: 300;

        src: local('Titillium WebLight'), local('TitilliumWeb-Light'), url(http://themes.googleusercontent.com/static/fonts/titilliumweb/v2/anMUvcNT0H1YN4FII8wpr24bNCNEoFTpS2BTjF6FB5E.woff) format('woff');

        }

        .table-div{

            margin-left: 5em;

            width: 50%;

            padding: 10px;

        }



    </style>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

    <script>

        $(document).ready(function () {

            

            $.ajax({

                url: "/barhaaram/requisicoes.php?funcao=listartodasreservas", 

                success: function(result){

                    var dataSet = [];

                    result = JSON.parse(result)

                    

                    result.forEach(eachItem);

                    function eachItem(item, index) {

                        dataSet.push({

                            

                            "id": item.id,

                            "nome": item.nome,

                            "telefone": item.telefone,

                            "email": item.email,

                            "data": item.data,

                            "botao-detalhes": '<button type="button" id="btn-editar" onclick=editar('+item.id+') class="btn btn-success btn-sm" data-toggle="modal" data-target="#editarModal">editar</button><button type="button" onclick=excluir('+item.id+') id="btn-excluir" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#modalConfirmacaoExclusao">excluir</button>',

                        });

                    }



                    $('#table_id').DataTable({

                        data: dataSet,

                        columns: [

                            {

                                "data": 'id',

                                "title": "ID",

                                "className": "",

                                "width": "5%",



                            },

                            {

                                "data": 'nome',

                                "title": "Nome",

                                "className": "",

                                "width": "15%",



                            },

                            {

                                "data": 'telefone',

                                "title": "Telefone",

                                "className": "",

                                "width": "15%",



                            },

                            {

                                "data": 'email',

                                "title": "Email",

                                "className": "",

                                "width": "15%",



                            },

                            {

                                "data": 'data',

                                "title": "Horario da reserva",

                                "className": "",

                                "width": "15%",



                            },

                            {

                                "data": 'botao-detalhes',

                                "title": "Ações",

                                "className": "",

                                "width": "15%",



                            },

                        ]

                    });

                }

            });

            

        $(".confirmar-exclusao").click(function() {

            var id = $("#id-exclusao").val()

                $.ajax({

                    url: "/barhaaram/requisicoes.php?funcao=excluirreserva&id="+id, 

                    success: function(result){

                        if(result == 'sucesso'){

                            console.log('sucesso')

                            $('#modalConfirmacaoExclusao').modal('hide');

                            $('#modalConfirmaExclusao').modal('toggle');

                        }else{

                            console.log('falha')

                        }

                        

                    }

                });

        });

        $(".enviar-correcao").click(function() {

            var nome = $("#modal-inputNome").val()

            var data = $("#modal-inputData").val()

            var email = $("#modal-inputEmail").val()

            var cpf = $("#modal-inputCpf").val()

            var telefone = $("#modal-inputTelefone").val()

            var id = $("#id-registro-modal").val()

            data = data.replace("T", " ");



            if($("#inputNome").val() == ''){

                $("#inputNome").css('background-color', '#fd8585');

                $("#inputNome").css('color', 'white');

                $("#inputNome").css('font-weight', 'bold');



            }else if($("#inputTelefone").val() == ''){

                $("#inputTelefone").css('background-color', '#fd8585');

                $("#inputTelefone").css('color', 'white');

                $("#inputTelefone").css('font-weight', 'bold');



            }else if($("#inputEmail").val() == ''){

                $("#inputEmail").css('background-color', '#fd8585');

                $("#inputEmail").css('color', 'white');

                $("#inputEmail").css('font-weight', 'bold');



            }else if($("#inputEmail").val() == ''){

                $("#inputCpf").css('background-color', '#fd8585');

                $("#inputCpf").css('color', 'white');

                $("#inputCpf").css('font-weight', 'bold');



            }else{

                $.ajax({

                    url: "/barhaaram/requisicoes.php?funcao=atualizareserva&id="+id+"&nome="+nome+"&telefone="+telefone+"&email="+email+"&cpf="+cpf+"&data="+data, 

                    success: function(result){

                        if(result == 'sucesso'){

                            console.log('sucesso')

                            $('#editarModal').modal('hide');

                            $('#modalConfirmacao').modal('toggle');

                        }else{

                            console.log('falha')

                        }

                        

                    }

                });

            }

        });

        });

        function editar(id){

            data = '';

            $.ajax({

                url: "/barhaaram/requisicoes.php?funcao=buscareservaporid&id="+id, 

                success: function(result){

                    result = JSON.parse(result)

                    $("#modal-inputNome").val(result.nome)

                    $("#modal-inputTelefone").val(result.telefone)

                    $("#modal-inputEmail").val(result.email)

                    $("#modal-inputData").val(result.data)

                    $("#id-registro-modal").val(result.id)

                }

            });

        };

        function excluir(id){

            $("#id-exclusao").val(id)

            $(".id-para-exclusao").html(id)

        };

        

    </script>   

    </head>

  <body>

    <div class="area">

        <div class="table-div">

        <table id="table_id" class="display">

            <thead>

                <tr>

                <th>id</th>

                <th>nome</th>

                <th>telefone</th>

                <th>email</th>

                <th>data</th>

                <th>acoes</th>

                </tr>

            </thead>

            <tbody>

            </tbody>

        </table>

        </div>

    </div>

    <nav class="main-menu">

            <ul>

                <li>

                <a href="/barhaaram/adm/reservas.php">

                        <i class="fa fa-home fa-2x"></i>

                        <span class="nav-text">

                            Reservas de mesas

                        </span>

                    </a>

                  

                </li>

                <li>

                   <a href="/barhaaram/adm/registrospresenca.php">

                       <i class="fa fa-table fa-2x"></i>

                        <span class="nav-text">

                            Registros de presença

                        </span>

                    </a>

                </li>

                <li>

                   <a href="/barhaaram/adm/senhadodia.php">

                       <i class="fa fa-key fa-2x"></i>

                        <span class="nav-text">

                            Senha do dia

                        </span>

                    </a>

                </li>

            </ul>



            <ul class="logout">

                <li>

                   <a href="logout.php">

                         <i class="fa fa-power-off fa-2x"></i>

                        <span class="nav-text">

                            Logout

                        </span>

                    </a>

                </li>  

            </ul>

        </nav>

        <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="editarModalLabel">Registro de Reserva </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">



                    <form>

                        <div class="form-group">

                            <label for="modal-inputNome">ID</label>

                            <input type="nome" class="form-control" id="id-registro-modal" placeholder="" disabled>

                        </div>

                        <div class="form-group">

                            <label for="modal-inputData">Data</label>

                            <input type="datetime-local" class="form-control" id="modal-inputData">

                        </div>

                        <div class="form-group">

                            <label for="modal-inputNome">Nome</label>

                            <input type="nome" class="form-control" id="modal-inputNome"placeholder="">

                        </div>

                        <div class="form-group">

                            <label for="modal-inputTelefone">Telefone</label>

                            <input type="nome" class="form-control" id="modal-inputTelefone"placeholder="">

                        </div>

                        <div class="form-group">

                            <label for="modal-inputEmail">Email</label>

                            <input type="nome" class="form-control" id="modal-inputEmail" placeholder="">

                        </div>

                    </form>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                    <button type="button" class="btn btn-primary enviar-correcao">Salvar</button>

                </div>

                </div>

            </div>

        </div>  



        <div class="modal fade" id="modalConfirmacao" tabindex="-1" role="dialog" aria-labelledby="modalConfirmacaoLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    Registro salvo com sucesso.

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-primary enviar-correcao" onclick="location.reload();">Fechar</button>

                </div>

                </div>

            </div>

        </div>



        <div class="modal fade" id="modalConfirmacaoExclusao" tabindex="-1" role="dialog" aria-labelledby="modalConfirmacaoExclusaoLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                <input type="hidden" class="form-control" id="id-exclusao" placeholder="">



                    Tem certeza que deseja excluir o registro <i class="id-para-exclusao"></i>?.

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                    <button type="button" class="btn btn-primary confirmar-exclusao">Confirmar</button>

                </div>

                </div>

            </div>

        </div>  

        <div class="modal fade" id="modalConfirmaExclusao" tabindex="-1" role="dialog" aria-labelledby="modalConfirmaExclusaoLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                <input type="hidden" class="form-control" id="id-exclusao" placeholder="">



                    Registro exlcuido

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-primary confirmar-exclusao" onclick="location.reload();">fechar</button>

                </div>

                </div>

            </div>

        </div>  

  </body>

    </html>