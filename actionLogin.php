<?php
session_start(); // Iniciar sessão

// Conexão com o banco
include("conexaoBD.php");

// Verifica se a conexão foi feita corretamente
if (!isset($link)) {
    die("Erro: conexão com o banco não estabelecida.");
}

// Verificar se os campos do formulário foram enviados
if (isset($_POST["emailUsuario"]) && isset($_POST["senhaUsuario"])) {
    $emailUsuario = mysqli_real_escape_string($link, $_POST["emailUsuario"]);
    $senhaUsuario = mysqli_real_escape_string($link, $_POST["senhaUsuario"]);
} else {
    die("Erro: campos de login não enviados.");
}

// Monta a query de busca
$buscarLogin = "
    SELECT * FROM usuario 
    WHERE emailUsuario = '$emailUsuario'
    AND senhaUsuario = md5('$senhaUsuario')
";

// Executa a query
$efetuarLogin = mysqli_query($link, $buscarLogin);

// Verifica se encontrou algum registro
if ($registro = mysqli_fetch_assoc($efetuarLogin)) {
    $_SESSION["emailUsuario"] = $registro["emailUsuario"];  // Corrigido nome do campo
    $_SESSION["nomeUsuario"] = $registro["nome"];

    header("Location: index.php");
    exit;
} else {
    // Redireciona de volta para o login com erro
    header("Location: FormLogin.php?erroLogin=dadosInvalidos");
    exit;
}
?>

