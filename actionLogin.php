<?php
// Conexão com o banco
$host = "localhost";
$user = "root"; // usuário do MySQL
$pass = "";     // senha do MySQL
$db   = "monitoramento-idoso";

$link = mysqli_connect($host, $user, $pass, $db);

// Verifica a conexão
if (!$link) {
    die("Erro na conexão: " . mysqli_connect_error());
}

// Recebe dados do formulário
$email = mysqli_real_escape_string($link, $_POST['email']);
$senha = mysqli_real_escape_string($link, $_POST['senha']);

// Gera o hash MD5 da senha (igual ao que está no banco)
$senhaHash = md5($senha);

// Consulta SQL
$sql = "SELECT * FROM usuarios WHERE emailUsuario = '$email' AND senhaUsuario = '$senhaHash'";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "Login realizado com sucesso!";
} else {
    echo "E-mail ou senha inválidos!";
}

mysqli_close($link);
?>

