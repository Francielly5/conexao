<?php
$host="localhost";
$banco="bibliotecaatual";
$usuario="root";
$senha="usbw";

try{
    $pdo = new PDO("mysql:host=$host;port=3307;dbname=$banco;charset=utf8",$usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die("Erro ao conectar: ".$e->getMessage());
}



?>