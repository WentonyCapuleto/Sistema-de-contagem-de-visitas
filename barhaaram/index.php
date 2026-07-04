<!DOCTYPE html>
<html>
<head>
    <title>Haaram</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/estilo.css">
  <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="jquery.maskedinput.min.js"></script>

    <script>
        $(document).ready(function(){

            $("#inputCpf").mask("999.999.999-99");

            $(".enviar-fidelidade").click(function() {
                var nome = $("#inputNome").val()
                var email = $("#inputEmail").val()
                var cpf = $("#inputCpf").val()
                var telefone = $("#inputTelefone").val()

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

                }else if($("#inputCpf").val() == ''){
                    $("#inputCpf").css('background-color', '#fd8585');
                    $("#inputCpf").css('color', 'white');
                    $("#inputCpf").css('font-weight', 'bold');

                }else{
                    $.ajax({
                        url: "requisicoes.php?funcao=registrapresenca&nome="+nome+"&email="+email+"&cpf="+cpf+"&telefone="+telefone, 
                        success: function(result){
                            if(result == 'sucesso'){
                                $.ajax({
                                    url: "requisicoes.php?funcao=buscaquantidadedevisitas&cpf="+cpf, 
                                    success: function(result){
                                        $(".numero-de-visitas").html(JSON.parse(result).quantidade)
                                    }
                                });
                                $('#modalFidelidade').modal('hide');
                                $('#modalConfirmacaoFidelidade').modal('toggle');
                                
                                setTimeout(function(){
                                    // location.reload();
                                }, 5000)  
                            }else{
                                console.log('falha')
                            }
                            
                        }
                    });
                }
            });

            $(".enviar-reserva").click(function() {
                var nome = $("#inputNomeReserva").val()
                var email = $("#inputEmailReserva").val()
                var telefone = $("#inputTelefoneReserva").val()
                var data = $("#inputDataReserva").val()
                var mesa = $("#inputHiddenMesa").val()

                if($("#inputNomeReserva").val() == ''){

                    $("#inputNomeReserva").css('background-color', '#fd8585');
                    $("#inputNomeReserva").css('color', 'white');
                    $("#inputNomeReserva").css('font-weight', 'bold');

                }else if($("#inputEmailReserva").val() == ''){

                    $("#inputEmailReserva").css('background-color', '#fd8585');
                    $("#inputEmailReserva").css('color', 'white');
                    $("#inputEmailReserva").css('font-weight', 'bold');

                }else if($("#inputTelefoneReserva").val() == ''){

                    $("#inputTelefoneReserva").css('background-color', '#fd8585');
                    $("#inputTelefoneReserva").css('color', 'white');
                    $("#inputTelefoneReserva").css('font-weight', 'bold');

                }else if($("#inputDataReserva").val() == ''){

                    $("#inputDataReserva").css('background-color', '#fd8585');
                    $("#inputDataReserva").css('color', 'white');
                    $("#inputDataReserva").css('font-weight', 'bold');

                }else if($("#inputHiddenMesa").val() == '' || $("#inputHiddenMesa").val() == 'Selecione a mesa'){
                    $("#inputMesa").css('background-color', '#fd8585');
                    $("#inputMesa").css('color', 'white');
                    $("#inputMesa").css('font-weight', 'bold');
                }
                else{
                    $.ajax({
                        url: "requisicoes.php?funcao=registrareserva&nome="+nome+"&email="+email+"&telefone="+telefone+"&data="+data+"&mesa="+mesa, 
                        success: function(result){
                            $('#modalReserva').modal('toggle');
                            $('#modalConfirmacao').modal('toggle');
                            setTimeout(function(){
                                location.reload();
                            }, 5000)  
                        }
                    });
                }
            });

            $(".btnValidarSenha").click(function() {
                var senha = $("#inputSenha").val()
                var cpf = $("#inputCpf").val()
                validaSenhaDoDia(senha, cpf)
            });
            // var htmlMesas = ''
            
            $('#inputMesa').on('click',function() {
                $('#inputHiddenMesa').val($(this).val())
            });

            $('#inputDataReserva').change(function() {
                buscaMesasDisponiveis()
                
            });



        });

        function buscaMesasDisponiveis(){
            // var horario =  $("#inputDataReserva").val().split("T")[0]+" "+$("#inputDataReserva").val().split("T")[1]
            var horario =  $("#inputDataReserva").val();

            var htmlMesas = '<option selected="">Selecione a mesa</option>'
            $("#inputMesa").html(htmlMesas)

            $.ajax({
                url: "requisicoes.php?funcao=mesasdisponiveisporhorario&horario="+horario, 
                success: function(result){
                    result = JSON.parse(result)
                    Object.values(result).forEach(val => {
                        htmlMesas += "<option value='"+val+"'>Mesa "+val+"</option>"
                    });
                    $("#inputMesa").html(htmlMesas)
                }
            });

        }
        function validaSenhaDoDia(senha, cpf){
            $.ajax({
                url: "requisicoes.php?funcao=validasenha&senha="+senha+"&cpf="+cpf, 
                success: function(result){
                    if(result == 'sucesso'){
                        $( ".enviar-fidelidade" ).prop( "disabled", true )
                    }else(
                        $( ".enviar-fidelidade" ).prop( "disabled", false )
                        
                        
                        
                        
                        
                        /*Depois de vendido o sistema, inverter a ordem dessa função
                        .enviar-fidelidade para que na web o problema do "validar senha" seja resolvido.
                        
                        E se ainda der erro por "/bar... ou (nome da empresa)" para dar continuidade nos links de URL: das funções e no winscp ou outro ftp criar uma pasta antes de por os arquivos html e php, para dentro desta pasta criada por os arquivos html, php, bd, css e js e por no ar*/







                    )
                }
            });
        }
    </script>
    <style>
        h1,h2,h3,h4,h5,h6 {
            font-family: "Montserrat", sans-serif;
        }
        body{
            font-family: "Montserrat", sans-serif;
        }
        .w3-row-padding img {margin-bottom: 12px}
        .bgimg {
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-image: url('/barhaaram/imgs/logo.png');
        min-height: 100%;
        }

        @media only screen and (max-width: 500px) {
            .img-mapa{
                width: 20em;
            }
        }

        @media only screen and (min-width: 501px) {
            .img-mapa{
                width: 26em;
            }
        }

    </style>
</head>
<body>
    <!-- Sidebar with image -->
    <nav class="w3-sidebar w3-hide-medium w3-hide-small" style="width:40%">
    <div class="bgimg"></div>
    </nav>
    <!-- Hidden Sidebar (reveals when clicked on menu icon)-->
    <nav class="w3-sidebar w3-black w3-animate-right w3-xxlarge" style="display:none;padding-top:150px;right:0;z-index:2" id="mySidebar">
    <a href="javascript:void(0)" onclick="closeNav()" class="w3-button w3-black w3-xxxlarge w3-display-topright" style="padding:0 12px;">
        <i class="fa fa-remove"></i>
    </a>
    <div class="w3-bar-block w3-center">
        <button type="button" class="w3-bar-item w3-button w3-text-grey w3-hover-black" data-toggle="modal" data-target="#modalFidelidade">Cartao fidelidade</button>
        <button type="button" class="w3-bar-item w3-button w3-text-grey w3-hover-black" data-toggle="modal" data-target="#modalReserva">Reservas</button>
        <button type="button" class="w3-bar-item w3-button w3-text-grey w3-hover-black" data-toggle="modal"> <a href="premiacao.php"  class="w3-bar-item w3-button w3-text-grey w3-hover-black" target="_blank"> Premiacoes de Visitas </a> </button>
        <button type="button" class="w3-bar-item w3-button w3-text-grey w3-hover-black" data-toggle="modal"> <a href="" class="w3-bar-item w3-button w3-text-grey w3-hover-black" target="_blank"> Cardapio </a> </button>
        <button type="button" class="w3-bar-item w3-button w3-text-grey w3-hover-black" data-toggle="modal"> <a href="abouthome.php"  class="w3-bar-item w3-button w3-text-grey w3-hover-black" target="_blank"> Sobre a casa </a> </button>
        <a href="#evento" class="w3-bar-item w3-button w3-text-grey w3-hover-black" onclick="closeNav()">Eventos</a>
        <button type="button" class="w3-bar-item w3-button w3-text-grey w3-hover-black" data-toggle="modal"><a href="/barhaaram/adm" class="w3-bar-item w3-button w3-text-grey w3-hover-black"> Adm </a></button>
    </div>
    </nav>

    <!-- Page Content -->
    <div class="w3-main w3-padding-large" style="margin-left:40%">
    <!-- Menu icon to open sidebar -->
    <span class="w3-button w3-top w3-white spanmenu w3-xxlarge w3-text-grey w3-hover-text-black" style="width:auto;right:0;" onclick="openNav()"><i class="fa fa-bars fonte"></i></span>

    <!-- Header -->
    <header class="w3-container w3-center" style="padding:40px 16px" id="home">
        <img class="ftgrande" src="imgs/ftgrande1.png" alt="" srcset="">
        <h1 class="w3-jumbo"> <img class="sumir" src="imgs/apple-touch-icon160.png"> </h1>
        <p></p>
        <h1 class="letra-foto"> EXPERIENCE</h1>
        <p>HAARAM LOUNGE E BAR</p>
        <!--<img src="imgs/apple-touch-icon.png" class="w3-image w3-hide-large w3-hide-small w3-round" style="display:block;width:40%;margin:auto;">
        <img src="imgs/apple-touch-icon.png" class="w3-image w3-hide-large w3-hide-medium w3-round" width="900" height="1000">-->
        <button class="w3-button botao-fidelidade w3-padding-large w3-margin-top" data-toggle="modal" data-target="#modalFidelidade">
        CARTÃO FIDELIDADE
        </button> 
        <p></p>
        <button class="w3-button botao-fidelidade w3-padding-large w3-margin-top" data-toggle="modal" data-target="#modalReserva">
        RESERVAS
        </button> 
        <p></p>
        <a href="premiacao.php" class="w3-button botao-fidelidade w3-padding-large w3-margin-top botao-evento">
        PREMIAÇÕES
        </a> 
        <P></P>
        <a href="" class="w3-button botao-fidelidade w3-padding-large w3-margin-top botao-evento">
        CARDÁPIO
        </a> 
        <p></p>
        <a href="#evento" class="w3-button botao-fidelidade w3-padding-large w3-margin-top botao-evento" onclick="closeNav()">
        EVENTOS
        </a> 
        <p></p>
        <!--<button class="botao-foto"> <a href="">Baixe aqui as fotos dos eventos</a> </button>-->
    </header>

    <!-- Portfolio Section -->
    <div class="w3-padding-32 w3-content" id="evento">
        <h2 class="letra-evento">Eventos</h2>
        <hr class="w3-opacity">

        <!-- Grid for photos -->
        <div class="w3-row-padding" style="margin:0 -16px">
        <div class="w3-half">
            <img src="imgs/CARTÃO-FIDELIDADE---STORIES.png" style="width:100%">
            <img src="imgs/TERÇA-01.08---STORIES.png" style="width:100%">
            <img src="imgs/QUARTA-02.08---STORIES.png" style="width:100%">
        </div>

        <div class="w3-half">
            <img src="imgs/QUINTA-03.08---STORIES.png" style="width:100%">
            <img src="imgs/SEXTA-04.08---STORIES.png" style="width:100%">
            <img src="imgs/SÁBADO-05.08---STORIES.png" style="width:100%">
            <img src="imgs/DOMINGO-06.08---STORIES.png" style="width:100%">
        </div>
        <!-- End photo grid -->
        </div>
    <!-- End Portfolio Section -->
</div>

<!-- Modals Section-->
<div id="modalFidelidade" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Cartão fidelidade</h4>
        </div>
        <div class="modal-body">
        <form>
            <div class="form-group">
                <label for="inputNome">Nome</label>
                <input type="nome" class="form-control" id="inputNome"placeholder="">
            </div>
            <div class="form-group">
                <label for="inputTelefone">Telefone</label>
                <input type="nome" class="form-control" id="inputTelefone"placeholder="">
            </div>
            <!--<div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="nome" class="form-control" id="inputEmail" placeholder="">
            </div>-->
            <div class="form-group">
                <label for="inputCpf">Cpf</label>
                <input type="nome" class="form-control" id="inputCpf" placeholder="">
            </div>
            <div class="form-group">
                <label for="inputSenha">Senha do dia</label>
                <input type="text" class="form-control" id="inputSenha" >
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-info btnValidarSenha">Validar senha</button>
            </div>
                <a href="premiacao.php" target="_blank"> Premiações de Visitas </a>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-success enviar-fidelidade" disabled>Enviar</button>
        </div>
        </div>

    </div>
</div>
<div id="modalReserva" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Reserva</h4>
            </div>
            <div class="modal-body">
                <form class="row g-3">
                    <div class="col-md-12">
                        <p>Reserve sua mesa e venha curtir com a gente!<p>
                    </div>
                    <div class="col-md-6">
                        <label for="inputNomeReserva" class="form-label">Nome</label>
                        <input type="nome" class="form-control" id="inputNomeReserva">
                    </div>
                    <div class="col-md-6">
                        <label for="inputTelefoneReserva" class="form-label">telefone</label>
                        <input type="text" class="form-control" id="inputTelefoneReserva">
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmailReserva" class="form-label">Email</label>
                        <input type="text" class="form-control" id="inputEmailReserva">
                    </div>
                    <div class="col-md-6">
                        <label for="inputDataReserva" class="form-label">Data</label>
                        <input type="date" class="form-control" id="inputDataReserva">
                    </div>
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <label for="inputMesa" class="form-label">Mesa</label>
                        <select class="form-select form-select-lg mb-3 form-control" id="inputMesa" aria-label=".form-select-lg example">
                            <option selected>Selecione a mesa</option>
                        </select>
                        <input type="hidden" class="form-control" id="inputHiddenMesa">
                    </div>
                    <div class="col-md-12" style=" text-align: center;">
                        <img src="/barhaaram/imgs/mapa.jpg" class="img-mapa">
                    </div>
                </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-success enviar-reserva" >Enviar</button>
                    </div>
            </div>
        </div>
    </div>
</div>

<div id="modalConfirmacao" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registrado</h4>
            </div>
            <div class="modal-body">
                Registro Salvo com Sucesso
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" >Fechar</button>
            </div>
        </div>
    </div>
</div>

<div id="modalConfirmacaoFidelidade" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registrado</h4>
            </div>
            <div class="modal-body">
                Registro Salvo com Sucesso <br>
                Você esta com <span class="numero-de-visitas">0</span> visitas registradas atualmente.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal" >Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- End Modals Section -->
    
    <!-- Footer -->
    <footer class="w3-container w3-padding-64 w3-center w3-opacity w3-xlarge" style="margin:-24px">
        <a href="https://www.facebook.com/haaramloungebar?mibextid=ZbWKwL" target="_blank"><i class="fa fa-facebook-official w3-hover-opacity"  style="color: blue;"></i></a> 
        <a href="https://instagram.com/haaramloungeebar?igshid=YmMyMTA2M2Y=" target="_blank"><i class="fa fa-instagram w3-hover-opacity" style="color: deeppink;"></i></a> 

    <div class="row">
        <div class="col-full cl-copyright">
            <span>Copyright &copy;
                <script>document.write(new Date().getFullYear());</script> | Todos os direitos resevados | Desenvolvido por: <a href="https://www.siteswo.com.br" style="color: black" > Siteswo.com.br </a>
            </span>
        </div>
    </div>
        <!--<i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>-->
        <!-- <p class="w3-medium">Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank" class="w3-hover-text-green">w3.css</a></p> -->
    <!-- End footer -->
    </footer>
    
    <!-- END PAGE CONTENT -->
    </div>

    <script>
    // Open and close sidebar
    function openNav() {
    document.getElementById("mySidebar").style.width = "60%";
    document.getElementById("mySidebar").style.display = "block";
    }

    function closeNav() {
    document.getElementById("mySidebar").style.display = "none";
    }
    </script>

</body>
</html>
