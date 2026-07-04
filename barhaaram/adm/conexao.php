<?php

// $dadosBanco = array(
//     'servername' => "mysql.haaram.com.br",
//     'username' => "haaram",
//     'password' => "ajpuLGP5mXPwyK@",
//     'dbname' => "haaram"
// );
$dadosBanco = array(
    'servername' => "localhost",
    'username' => "root",
    'password' => "",
    'dbname' => "bar_haaram"
);



$con = new mysqli($dadosBanco['servername'], $dadosBanco['username'], $dadosBanco['password'], $dadosBanco['dbname']);



?>