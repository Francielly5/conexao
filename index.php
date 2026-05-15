<?php
require 'conexao.php';
session_start();

// Polyfill para password_verify em versões antigas do PHP
if (!function_exists('password_verify')) {
    function password_verify($password, $hash) {
        return crypt($password, $hash) === $hash;
    }
}

echo $mensagem="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
 
    $email =trim($_POST["email"]);
    $senha = trim($_POST["senha"]);
 
 
    $sql = "SELECT * FROM usuarios WHERE email = :email";
$stmt=$pdo->prepare($sql);
 
//$stmt->execute([':email' =>$email]); versão atual de array
$stmt->execute(array(':email' => $email));
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
if($usuario && $senha==$usuario['senha']){
    $_SESSION['usuario'] = $usuario['nome'];
   $_SESSION['tipo'] = $usuario['tipo'];
    header("Location:painel.php");
    exit;
}else{
    $mensagem = "<p class='erro'> Email ou senha inválidos!</p>";
}
 
}
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login - Biblioteca</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Login</h1>
   
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
</div>
</body>
</html>