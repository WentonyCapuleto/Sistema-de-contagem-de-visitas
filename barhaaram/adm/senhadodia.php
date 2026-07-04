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
            font-size: 20px;
        }




        .main-menu:hover,
        nav.main-menu.expanded {
            width: 250px;
            overflow: visible;
        }


        .main-menu {
            background: #212121;
            border-right: 1px solid #e5e5e5;
            position: absolute;
            top: 0;
            bottom: 0;
            height: 100%;
            left: 0;
            width: 60px;
            overflow: hidden;
            -webkit-transition: width .05s linear;
            transition: width .05s linear;
            -webkit-transform: translateZ(0) scale(1, 1);
            z-index: 1000;
        }


        .main-menu>ul {
            margin: 7px 0;
        }


        .main-menu li {
            position: relative;
            display: block;
            width: 250px;
        }


        .main-menu li>a {
            position: relative;
            display: table;
            border-collapse: collapse;
            border-spacing: 0;
            color: #999;
            font-family: arial;
            font-size: 14px;
            text-decoration: none;
            -webkit-transform: translateZ(0) scale(1, 1);
            -webkit-transition: all .1s linear;
            transition: all .1s linear;


        }


        .main-menu .nav-icon {
            position: relative;
            display: table-cell;
            width: 60px;
            height: 36px;
            text-align: center;
            vertical-align: middle;
            font-size: 18px;
        }


        .main-menu .nav-text {
            position: relative;
            display: table-cell;
            vertical-align: middle;
            width: 190px;
            font-family: 'Titillium Web', sans-serif;
        }


        .main-menu>ul.logout {
            position: absolute;
            left: 0;
            bottom: 0;
        }


        .no-touch .scrollable.hover {
            overflow-y: hidden;
        }


        .no-touch .scrollable.hover:hover {
            overflow-y: auto;
            overflow: visible;
        }


        a:hover,
        a:focus {
            text-decoration: none;
        }


        nav {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
            user-select: none;
        }


        nav ul,
        nav li {
            outline: 0;
            margin: 0;
            padding: 0;
        }

        .main-menu li:hover>a,
        nav.main-menu li.active>a,
        .dropdown-menu>li>a:hover,
        .dropdown-menu>li>a:focus,
        .dropdown-menu>.active>a,
        .dropdown-menu>.active>a:hover,
        .dropdown-menu>.active>a:focus,
        .no-touch .dashboard-page nav.dashboard-menu ul li:hover a,
        .dashboard-page nav.dashboard-menu ul li.active a {
            color: #fff;
            background-color: #5fa2db;
        }

        .area {
            float: left;
            height: 100%;
        }

        @font-face {
            font-family: 'Titillium Web';
            font-style: normal;
            font-weight: 300;
            src: local('Titillium WebLight'), local('TitilliumWeb-Light'), url(http://themes.googleusercontent.com/static/fonts/titilliumweb/v2/anMUvcNT0H1YN4FII8wpr24bNCNEoFTpS2BTjF6FB5E.woff) format('woff');
        }

        .table-div {
            margin: auto;
            width: 60%;
            border: 3px solid #212121;
            padding: 10px;
        }

        .center {
            position: absolute;
            padding: 10px;
        }

        .conteudo {
            position: relative;
            left: 6em;
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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js">
    </script>
    <script>
        $(document).ready(function() {

            // $.ajax({
            //     url: "/barhaaram/requisicoes.php?funcao=mostrasenhadodia",
            //     success: function(result) {
            //         result = JSON.parse(result)[0]
            //         $(".senha-do-dia").html(result.senha)
            //     }
            // });

            $("#buscacliente").click(function(){
                var cpf = $("#inputcpf").val();

                if(cpf.length == 0){
                    alert('Digite um CPF valido')
                }else{
                    var senhaGerada = senhas[Math.floor(Math.random() * 367)];
                    
                    $.ajax({
                        url: "/barhaaram/requisicoes.php?funcao=buscareservaporcpf&cpf="+formataCPF(cpf), 
                        success: function(result){
                            result = JSON.parse(result)
                            console.log(cpf)
                            if(result == 'null'){
                                $("#modal-inputNome").val('')
                                $("#modal-inputTelefone").val('')
                                $("#modal-inputEmail").val('')
                                $("#modal-inputData").val('')
                                $("#id-registro-modal").val('')
                                $("#modal-inputCpf").val(cpf)

                                // $("#modal-inputNome").prop( "disabled", false )
                                // $("#modal-inputTelefone").prop( "disabled", false )
                                // $("#modal-inputEmail").prop( "disabled", false )
                                // $("#modal-inputData").prop( "disabled", false )
                                // $("#modal-inputCpf").prop( "disabled", false )
                            }else{
                                $("#modal-inputNome").val(result.nome)
                                $("#modal-inputTelefone").val(result.telefone)
                                $("#modal-inputEmail").val(result.email)
                                $("#modal-inputData").val(result.data)
                                $("#id-registro-modal").val(result.id)
                                $("#modal-inputCpf").val(result.cpf)

                                $("#modal-inputNome").prop( "disabled", true )
                                $("#modal-inputTelefone").prop( "disabled", true )
                                $("#modal-inputEmail").prop( "disabled", true )
                                $("#modal-inputData").prop( "disabled", true )
                                $("#modal-inputCpf").prop( "disabled", true )
                            }
                            
                            $.ajax({
                                url: "/barhaaram/requisicoes.php?funcao=registrasenhadodia&cpf="+formataCPF(cpf)+"&senhagerada="+senhaGerada, 
                                success: function(result){
                                    console.log(result)
                                }   

                            });
                        }   

                    });
                    $("#senha-gerada-modal").val(senhaGerada);  
                    $('#senhaModal').modal('toggle');
                }
            })
        }); 
        function formataCPF(cpf) { 
            let cpfAtualizado;

            cpfAtualizado = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, 
            function( regex, argumento1, argumento2, argumento3, argumento4 ) {
                    return argumento1 + '.' + argumento2 + '.' + argumento3 + '-' + argumento4;
            })  
            return cpfAtualizado; 
        } 
        var senhas  = ["Bailarina",
                        "Futebol",
                        "Estátua",
                        "Pintor",
                        "Frio",
                        "Bebê",
                        "Mímico",
                        "Escova de dentes",
                        "Lápis",
                        "Livro",
                        "Astronauta",
                        "Finito",
                        "Arroz",
                        "Lixo",
                        "Sombra",
                        "Cadeado",
                        "Massagem",
                        "Borboleta",
                        "Cavalo",
                        "Cachorro",
                        "Caranguejo",
                        "Chimpanzé",
                        "Coelho",
                        "Jacaré",
                        "Elefante",
                        "Galinha",
                        "Girafa",
                        "Leão",
                        "Gato",
                        "Sapo",
                        "Veado",
                        "Tigre",
                        "Grilo",
                        "Formiga",
                        "Abelha",
                        "Hipopótamo",
                        "Golfinho",
                        "Tigre",
                        "Capivara",
                        "Esquilo",
                        "Rato",
                        "Porco",
                        "Maca",
                        "Templo",
                        "Cápsula",
                        "Estrada",
                        "Planeta",
                        "terra",
                        "Estojo",
                        "Paraíso",
                        "Estrela",
                        "Trem",
                        "Infinito",
                        "Amor",
                        "Ódio",
                        "Cego",
                        "Cadeira",
                        "Sacola",
                        "Professor",
                        "Médico",
                        "Calculadora",
                        "Artista",
                        "Vitória",
                        "Pescador",
                        "Internet",
                        "Basquete",
                        "Semente",
                        "Policial",
                        "Amargo",
                        "Bilhete",
                        "Xadrez",
                        "Banana",
                        "Micróbio",
                        "Romance",
                        "Carteira",
                        "Máquina de lavar",
                        "Prancha de surfe",
                        "Debate",
                        "Batata",
                        "Panqueca",
                        "Carvão",
                        "Aluminio",
                        "Furacao",
                        "Stin",
                        "Vaso",
                        "Agua",
                        "Janeiro",
                        "Fereveiro",
                        "Marco",
                        "Abril",
                        "Maio",
                        "Junho",
                        "Julho",
                        "Agosto",
                        "Setembro",
                        "Outubro",
                        "Novembro",
                        "Dezembro",
                        "Aries",
                        "Touro",
                        "Escorpiao",
                        "Aquario",
                        "Libra",
                        "capricornio",
                        "Sagitaio",
                        "Cesta",
                        "Internet",
                        "Afeganistao",
                        "Cabul",
                        "Asia",
                        "Africa do sul",
                        "Petroleo",
                        "Africa",
                        "Albania",
                        "Tirana",
                        "Europa",
                        "Alemanha",
                        "Berlim",
                        "Andorra",
                        "Velha",
                        "Angola",
                        "Luanda",
                        "Antiga",
                        "Barbuda",
                        "Sao Joao",
                        "America",
                        "Arabia Saudita",
                        "Riade",
                        "Argelia",
                        "Argentina",
                        "Buenos Aires",
                        "Australia",
                        "Camberra",
                        "Oceania",
                        "Austria",
                        "Viena",
                        "Viatna",
                        "Bacu",
                        "Balcao",
                        "Bahamas",
                        "Nassau",
                        "Faca",
                        "Colher",
                        "Talher",
                        "Cozinha",
                        "Mesa",
                        "Banho",
                        "Belgica",
                        "Bruxelas",
                        "Belize",
                        "Porto",
                        "Novo",
                        "Russia",
                        "Bolivia",
                        "Bosnia",
                        "Brasil",
                        "Brasilia",
                        "Bar",
                        "Bulgaria",
                        "Botao",
                        "Cabo",
                        "Praia",
                        "Camaroes",
                        "Catar",
                        "Canada",
                        "Chile",
                        "Santiago",
                        "China",
                        "Pequim",
                        "Nicolas",
                        "Colombia",
                        "Coreia",
                        "Marfim",
                        "Costa",
                        "Rica",
                        "Croacia",
                        "Senha",
                        "Linha",
                        "Agulha",
                        "Fio",
                        "Bone",
                        "Cabelo",
                        "Bola",
                        "Volei",
                        "Tenis",
                        "Roupa",
                        "Sapato",
                        "Camisa",
                        "Meia",
                        "Relogio",
                        "Ponteiro",
                        "Nuvem",
                        "Som",
                        "Musica",
                        "Festa",
                        "DJ",
                        "Convidado",
                        "Toalha",
                        "Eletronico",
                        "eletricidade",
                        "Electro",
                        "Aparelho",
                        "Capacete",
                        "Filme",
                        "DVD",
                        "Caderno",
                        "Ferro",
                        "Mae",
                        "Pai",
                        "Padeiro",
                        "Ferrovia",
                        "Copo",
                        "Vodka",
                        "Whisky",
                        "maracuja",
                        "Limao",
                        "Uva",
                        "Pera",
                        "Maca",
                        "Melancia",
                        "Goiaba",
                        "Abacaxi",
                        "Caju",
                        "Caja",
                        "Cacto",
                        "Estrangeiro",
                        "Oceano",
                        "Onda",
                        "Barbeiro",
                        "Barba",
                        "Haaram",
                        "Estrangeira",
                        "Ceu",
                        "Mar",
                        "Horas",
                        "Minutos",
                        "Segundos",
                        "Milesimos",
                        "Algarismo",
                        "Porcento",
                        "Porcentagem",
                        "Cigarro",
                        "Cigarra",
                        "Charuto",
                        "Mangueira",
                        "Piteira",
                        "Lanche",
                        "Suco",
                        "Colar",
                        "Pingente",
                        "Unha",
                        "Palha",
                        "Quadro",
                        "Quadrado",
                        "Pintura",
                        "Molde",
                        "Guitarra",
                        "Baixo",
                        "Bateria",
                        "Teclado",
                        "Sax",
                        "Luz",
                        "Anel",
                        "Alianca",
                        "Juventude",
                        "Junior",
                        "Aplicativo",
                        "Midia",
                        "Celular",
                        "Nariz",
                        "Banana",
                        "Bala",
                        "Armario",
                        "Javali",
                        "Tatuagem",
                        "Motivacao",
                        "Uniforme",
                        "Maquina",
                        "Homem",
                        "Mulher",
                        "Filho",
                        "Neto",
                        "Neta",
                        "Guarda",
                        "Chuva",
                        "Sol",
                        "Luar",
                        "Ouro",
                        "Prata",
                        "Bronze",
                        "Diamante",
                        "Pena",
                        "Azul",
                        "Amarelo",
                        "Vermelho",
                        "Laranja",
                        "Roxo",
                        "Rosa",
                        "Lilas",
                        "Marrom",
                        "Branco",
                        "Preto",
                        "Plateia",
                        "Teia",
                        "Telha",
                        "Telhado",
                        "Tijolo",
                        "Cidade",
                        "Cuba",
                        "Cural",
                        "Havaiana",
                        "Dinamarca",
                        "Egito",
                        "Cairo",
                        "Emirados",
                        "Arabes",
                        "Unidos",
                        "Equador",
                        "Eslovaquia",
                        "Eslovenia",
                        "Espanha",
                        "Madrid",
                        "Lombada",
                        "Estado",
                        "Palestina",
                        "Jerusalem",
                        "Oriental",
                        "Ocidental",
                        "DC",
                        "Marvel",
                        "Latim",
                        "Etiopia",
                        "Oceania",
                        "Franca",
                        "Paris",
                        "Torre",
                        "Italia",
                        "China",
                        "Grecia",
                        "Atena",
                        "Guatemala",
                        "Guiana",
                        "Batman",
                        "Flash",
                        "Mercurio",
                        "Gaviao",
                        "Thor",
                        "Hulk",
                        "Arqueiro",
                        "Loki",
                        "Wolverine",
                        "Equatorial",
                        "Porto",
                        "Principe",
                        "Jacarta",
                        "Roma",
                        "Hungria",
                        "India",
                        "Nova",
                        "Ilha",
                        "Irlanda",
                        "Iraque",
                        "Japao",
                        "Toquio",
                        "Jabuti",
                        "Mexico",
                        "Nigeria",
                        "Wakanda",
                        "Libano"];
    </script>

</head>

<body>

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
    <div class="area center">
        <div class="conteudo">

            <input type="text" id="inputcpf" class="form-control col-md-6" placeholder="Digite o CPF do cliente">
            <button type="button" id="buscacliente" class="btn btn-primary col-md-12">Buscar</button>
        </div>
    </div>
    <div class="modal fade" id="senhaModal" tabindex="-1" role="dialog" aria-labelledby="senhaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="senhaModalLabel">Senha do dia para este CPF</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <form>
                            <div class="form-group">
                                <label for="modal-inputSenhaGerada">Senha gerada (Validado até 00:00)</label>
                                <input type="text" class="form-control" id="senha-gerada-modal" placeholder="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="modal-inputCpf">Cpf</label>
                                <input type="text" class="form-control" id="modal-inputCpf" placeholder="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="modal-inputNome">Nome</label>
                                <input type="text" class="form-control" id="modal-inputNome"placeholder="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="modal-inputTelefone">Telefone</label>
                                <input type="text" class="form-control" id="modal-inputTelefone"placeholder="" disabled>
                            </div>
                            <div class="form-group">
                                <label for="modal-inputEmail">Email</label>
                                <input type="text" class="form-control" id="modal-inputEmail" placeholder="" disabled>
                            </div>
                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalConfirmacao" tabindex="-1" role="dialog" aria-labelledby="modalConfirmacaoLabel"
        aria-hidden="true">
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
                    <button type="button" class="btn btn-primary enviar-correcao"
                        onclick="location.reload();">Fechar</button>
                </div>
            </div>
        </div>
    </div>


</body>

</html>