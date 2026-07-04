<?php 
date_default_timezone_set('America/Sao_Paulo');
// $dadosBanco = array(
//     'servername' => "mysql.haaram.com.br",
//     'username' => "haaram",
//     'password' => "Haaram1?",
//     'dbname' => "haaram"
// );
$dadosBanco = array(
    'servername' => "localhost",
    'username' => "root",
    'password' => "",
    'dbname' => "bar_haaram"
);
if(isset($_REQUEST['funcao'])){
    $funcao = $_REQUEST['funcao'];
}else{
    $funcao = '';
}

if($funcao == 'registrapresenca'){
    echo registraPresenca($_REQUEST, $dadosBanco);
}
if($funcao == 'validasenha'){
    echo validaSenha($_REQUEST, $dadosBanco);
}
if($funcao == 'mesasdisponiveisporhorario'){
    echo mesasDisponiveisPorHorario($_REQUEST['horario'], $dadosBanco);
}
if($funcao == 'registrareserva'){
    echo registraReserva($_REQUEST, $dadosBanco);
}
if($funcao == 'registrasenhadodia'){
    echo registrasenhadodia($_REQUEST, $dadosBanco);
}
if($funcao == 'loginadm'){
    loginadm($_REQUEST, $dadosBanco);
}
if($funcao == 'listartodaspresencas'){
    listartodaspresencas($dadosBanco);
}
if($funcao == 'buscapresencaporid'){
    buscapresencaporid($_REQUEST, $dadosBanco);
}
if($funcao == 'atualizapresenca'){
    atualizapresenca($_REQUEST, $dadosBanco);
}
if($funcao == 'atualizareserva'){
    atualizareserva($_REQUEST, $dadosBanco);
}
if($funcao == 'excluirpresenca'){
    excluirpresenca($_REQUEST, $dadosBanco);
}
if($funcao == 'listartodasreservas'){
    listartodasreservas($_REQUEST, $dadosBanco);
}
if($funcao == 'excluirreserva'){
    excluirreserva($_REQUEST, $dadosBanco);
}
if($funcao == 'buscareservaporid'){
    buscareservaporid($_REQUEST, $dadosBanco);
}
if($funcao == 'buscareservaporcpf'){
    buscareservaporcpf($_REQUEST, $dadosBanco);
}
if($funcao == 'mostrasenhadodia'){
    mostrasenhadodia($dadosBanco);
}
if($funcao == 'buscaquantidadedevisitas'){
    buscaquantidadedevisitas($_REQUEST, $dadosBanco);
}


function listartodasreservas($dados, $dadosBanco){
    $con = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);
    $sql = "SELECT * FROM reservas";
    $result = $con->query($sql);

    $resultado = array();
    while($row = $result->fetch_assoc()) {
        array_push($resultado,$row);
    }
    echo json_encode($resultado);
}
function excluirreserva($dados, $dadosBanco){
    $con = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);
    $sql = "DELETE FROM `reservas` WHERE `reservas`.`id` =".$dados['id'];
    
    if ($con->query($sql) === TRUE) {
        echo "sucesso";
    } else {
        echo "Erro: " . $conn->error;
    }
}
function excluirpresenca($dados, $dadosBanco){
    $con = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);
    $sql = "DELETE FROM `visitas` WHERE `visitas`.`id` =".$dados['id'];
    
    if ($con->query($sql) === TRUE) {
        echo "sucesso";
    } else {
        echo "Erro: " . $conn->error;
    }
}
function atualizapresenca($dados, $dadosBanco){
    $con = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);
    // $sql = "UPDATE `visitas` SET `nome` = '".$dados['nome']."', `email` = '".$dados['email']."', `telefone` = '".$dados['telefone']."' WHERE `reservas`.`id` = ".$dados['id'].";";
    $sql = "UPDATE `visitas` SET `nome` = '".$dados['nome']."', `email` = '".$dados['email']."', `telefone` = '".$dados['telefone']."', `data` = '".$dados['data']."' WHERE `visitas`.`id` = ".$dados['id'].";";
    // echo $sql;
    if ($con->query($sql) === TRUE) {
        echo "sucesso";
    } else {
        echo "Erro: " . $conn->error;
    }
}
function atualizareserva($dados, $dadosBanco){
    $con = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);
    // $sql = "UPDATE `reservas` SET `nome` = '".$dados['nome']."', `email` = '".$dados['email']."', `telefone` = '".$dados['telefone']."' WHERE `reservas`.`id` = ".$dados['id'].";";
    $sql = "UPDATE `reservas` SET `nome` = '".$dados['nome']."', `email` = '".$dados['email']."', `telefone` = '".$dados['telefone']."', `data` = '".$dados['data'].":00' WHERE `reservas`.`id` = ".$dados['id'].";";
    // echo $sql;
    if ($con->query($sql) === TRUE) {
        echo "sucesso";
    } else {
        echo "Erro: " . $conn->error;
    }
}
function buscareservaporid($dados, $dadosBanco){
    $con = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);
    $sql = "SELECT * FROM reservas where id = ".$dados['id'];
    // echo $sql;
    $result = $con->query($sql);
    $resultado = array();
    while($row = $result->fetch_assoc()) {
        array_push($resultado,$row);
    }
    echo json_encode($resultado[0]);
}
function buscareservaporcpf($dados, $dadosBanco){
    $con = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);
    $sql = "SELECT * FROM visitas where cpf = '".$dados['cpf']."'";
    // echo $sql;
    $result = $con->query($sql);
    $resultado = array();
    if($result->num_rows == 0){
        echo json_encode('null');
    }else{
        while($row = $result->fetch_assoc()) {
    
            array_push($resultado,$row);
    
        }
    
        echo json_encode($resultado[0]);
    }
}
function buscapresencaporid($dados, $dadosBanco){
    $con = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);
    $sql = "SELECT * FROM visitas where id = ".$dados['id'];
    $result = $con->query($sql);
    $resultado = array();
    while($row = $result->fetch_assoc()) {
        array_push($resultado,$row);
    }
    echo json_encode($resultado[0]);
}
function listartodaspresencas($dadosBanco){
    $con = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);
    $sql = "SELECT * FROM visitas";
    $result = $con->query($sql);
    $resultado = array();
    while($row = $result->fetch_assoc()) {
        array_push($resultado,$row);
    }
    echo json_encode($resultado);
}
function loginadm($dados, $dadosBanco){  
    session_unset();
    session_start();
    // Getting submitted user data from database
    $con = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);
    $sql = "SELECT * FROM usuarios WHERE user = '".$dados['user']."' and pass = '".md5($dados['pass'])."'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_object();
    if(!is_null($user)){
        $_SESSION['user_id'] = $user->id;
        header('Location: /barhaaram/adm/painel.php');
    }
    print_r($_SESSION);
}

function registraPresenca($dados, $dadosBanco){
    // Create connection
    $conn = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    if( $dados['nome'] == '' || $dados['email'] == '' || $dados['cpf'] == ''|| $dados['telefone'] == ''){
        return 'falha';
    }
    
    $sql = "INSERT INTO `visitas` (`nome`, `telefone`, `email`, `cpf`) VALUES ('".$dados['nome']."', '".$dados['telefone']."', '".$dados['email']."', '".$dados['cpf']."');";

    
    
    
    // $sqlSenha = "SELECT * FROM senhas where cpf = '".$dados['cpf']."' order by data desc limit 1;";
    // $result = $conn->query($sqlSenha);
    // $idSenha = $result->fetch_assoc()['id'];
    // $sqlUpdateSenha = "UPDATE `senhas` SET `usada` = '1' WHERE `senhas`.`id` = ".$idSenha.";";
    // $conn->query($sqlUpdateSenha);
    // echo json_encode($sql);

    if ($conn->query($sql) === TRUE) {
        return "sucesso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function registraPresencaComSenha($dados, $dadosBanco){
    // Create connection
    $conn = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    if( $dados['nome'] == '' || $dados['email'] == '' || $dados['cpf'] == ''|| $dados['telefone'] == ''){
        return 'falha';
    }
    
    $sql = "INSERT INTO `visitas` (`nome`, `telefone`, `email`, `cpf`) VALUES ('".$dados['nome']."', '".$dados['telefone']."', '".$dados['email']."', '".$dados['cpf']."');";

    
    
    
    $sqlSenha = "SELECT * FROM senhas where cpf = '".$dados['cpf']."' order by data desc limit 1;";
    $result = $conn->query($sqlSenha);
    $idSenha = $result->fetch_assoc()['id'];
    $sqlUpdateSenha = "UPDATE `senhas` SET `usada` = '1' WHERE `senhas`.`id` = ".$idSenha.";";
    $conn->query($sqlUpdateSenha);
    // echo json_encode($result->fetch_assoc()['id']);

    if ($conn->query($sql) === TRUE) {
        return "sucesso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function registrasenhadodia($dados, $dadosBanco){
    // Create connection
    $conn = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM senhas where cpf = '".$dados['cpf']."' order by data desc limit 1";
    // echo $sql;  
    $result = $conn->query($sql);
    $resultado = array();
    while($row = $result->fetch_assoc()) {
        array_push($resultado,$row);
    }
    // echo "<pre>";
    // print_r($resultado);
    // echo "</pre>";
    $sql2 = "INSERT INTO `senhas` (`senha`, `data`, `cpf`) VALUES ('".$dados['senhagerada']."', '".date("Y-m-d H:i:s")."', '".$dados['cpf']."')";
    // echo $sql;  
    // $sql = "INSERT INTO `reservas`(`nome`, `email`, `telefone`, `data`, `mesa`) VALUES ('".$dados['nome']."','".$dados['email']."','".$dados['telefone']."','".$dados['data']."','".$dados['mesa']."')";
    if ($conn->query($sql2) === TRUE) {
        return "sucesso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
function registraReserva($dados, $dadosBanco){
    // Create connection
    $conn = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO `reservas`(`nome`, `email`, `telefone`, `data`, `mesa`) VALUES ('".$dados['nome']."','".$dados['email']."','".$dados['telefone']."','".$dados['data']."','".$dados['mesa']."')";
    if ($conn->query($sql) === TRUE) {
        return "sucesso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
function mesasDisponiveisPorHorario($horario, $dadosBanco){
    $conn = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $mesas = array(
        '1',
        '2',
        '3',
        '4',
        '5',
        '6'
    );
    // var_dump($horario);
    $horario = new DateTime($horario);
    $anoMesDia = $horario->format('Y-m-d ');
    $horas = intval($horario->format('H'));
    $minutos = intval($horario->format('i'));

    // if($minutos > 45 && $minutos <= 59){
    //     $horas++;
    //     $horaMinutos = $horas.':00';
    // }elseif($minutos <= 45 && $minutos >= 30){
    //     $horaMinutos = $horas.':30';
    // }elseif($minutos < 30 && $minutos > 15){
    //     $horaMinutos = $horas.':30';
    // }elseif($minutos <= 15 && $minutos >= 1){
    //     $horaMinutos = $horas.':00';
    // }
    
    if($minutos >= 30){
        $horaMinutosAntes = $horas.':30';
        $horaMinutosDepois = ++$horas.':00';
    }else{
        $horaMinutosAntes = $horas.':00';
        $horaMinutosDepois = $horas.':30';
    }

    $dataHoraAntes = $anoMesDia.$horaMinutosAntes;
    $dataHoraDepois = $anoMesDia.$horaMinutosDepois;


    $sql = "SELECT DISTINCT mesa FROM `reservas` where data BETWEEN '".$dataHoraAntes."' AND '".$dataHoraDepois."';";
    // echo $sql;
    $result = $conn->query($sql);

    // echo $sql;
    while($row = $result->fetch_assoc()) {
        // echo array_search($row['mesa'], $mesas)."search<br>";
        unset($mesas[array_search($row['mesa'], $mesas)]); 
    }

    
    $conn->close();
    
    return json_encode($mesas); 
}

function validaSenha($dados, $dadosBanco){
    // Create connection
    $conn = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // $sql = "SELECT * FROM `senhas` WHERE data = '".date("Y-m-d")."'";
    $sql = "SELECT * FROM senhas where cpf = '".$dados['cpf']."' order by data desc limit 1;";
    
    
    // echo json_encode($sql);
    
    $result = $conn->query($sql)->fetch_assoc();
    $usada = $result['usada'];
    $senhaBanco = strtoupper($result['senha']);
    $senhaForm = strtoupper($dados['senha']);
    // var_dump($usada);
    if ($result['usada'] == 0 && strtoupper($result['senha']) == strtoupper($dados['senha'])) {
        
        return 'sucesso';
    } else {
        return 'falha';
    }
    $conn->close();

}

function mostrasenhadodia($dadosBanco){
    // Create connection
    $conn = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `senhas` WHERE data = '".date('Y-m-d')."'";
    // echo $sql;
    $result = $conn->query($sql);
    
    $resultado = array();
    while($row = $result->fetch_assoc()) {
        array_push($resultado,$row);
    }

    echo json_encode($resultado);

}

function buscaquantidadedevisitas($dados, $dadosBanco){
    $con = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);
    
    $sql = "SELECT count(*) as quantidade FROM `visitas` WHERE cpf = '".$dados['cpf']."';";
    
    $result = $con->query($sql)->fetch_assoc();
    // print_r($result['quantidade']);
    echo json_encode($result);
}
?>