<?php
// Inicia a sessão (para guardar login do usuário)
session_start();

// Dados de conexão
$host = "localhost";
$user = "root"; // Usuário padrão do XAMPP
$pass = "";     // Senha padrão do XAMPP (normalmente vazia)
$db   = "monitoramento-idoso";

// Conectar ao MySQL
$link = mysqli_connect($host, $user, $pass, $db);

// Verificar conexão
if (!$link) {
    die("Erro na conexão com o banco: " . mysqli_connect_error());
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Escapar caracteres perigosos para evitar SQL Injection
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $senha = mysqli_real_escape_string($link, $_POST['senha']);

    // Criptografar senha para comparar com o banco
    $senhaHash = md5($senha);

    // Buscar usuário no banco
    $sql = "SELECT * FROM usuarios 
            WHERE emailUsuario = '$email' 
            AND senhaUsuario = '$senhaHash' 
            LIMIT 1";
    $result = mysqli_query($link, $sql);

    // Verificar se encontrou
    if (mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);

        // Guardar informações na sessão
        $_SESSION['idUsuario']   = $usuario['idUsuario'];
        $_SESSION['nomeUsuario'] = $usuario['nomeUsuario'];
        $_SESSION['emailUsuario']= $usuario['emailUsuario'];

        // Redirecionar para a página inicial
        header("Location: index.php");
        exit;
    } else {
        // Login inválido
        echo "<p style='color:red;'>E-mail ou senha inválidos!</p>";
    }
}

// Fechar conexão
mysqli_close($link);
?>
