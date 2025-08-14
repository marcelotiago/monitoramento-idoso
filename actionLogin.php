<?php
// Inicia a sessão (para guardar login do usuário)
session_start();

include 'conexaoBD.php';
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Escapar caracteres perigosos para evitar SQL Injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    // Criptografar senha para comparar com o banco
    $senhaHash = md5($senha);

    // Buscar usuário no banco
    $sql = "SELECT * FROM usuarios 
            WHERE emailUsuario = '$email' 
            AND senhaUsuario = '$senhaHash' 
            LIMIT 1";
    $result = mysqli_query($conn, $sql);

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
mysqli_close($conn);
?>


