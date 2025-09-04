

<?php
//Função para filtrar entrada de dados
function filtrar_entrada($dado){
    $dado = trim($dado); //Remove espaços desnecessários
    $dado = stripslashes($dado); //Remove barras invertidas
    $dado = htmlspecialchars($dado); // Converte caracteres especiais em entidades HTML
    return($dado);
}

//Verifica o método de requisição do servidor
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Bloco para declaração de variáveis
    $fotoIdoso = $nomeIdoso = $dataNascimentoIdoso = $telefoneIdoso = $emailIdoso = "";
    $erroPreenchimento = false;

    //Validação do campo nomeIdoso
    if(empty($_POST["nomeIdoso"])){
        echo "<div class='alert alert-warning text-center'>O campo <strong>NOME</strong> é obrigatório!</div>";
        $erroPreenchimento = true;
    } else {
        $nomeIdoso = filtrar_entrada($_POST["nomeIdoso"]);
    }

    //Validação do campo dataNascimentoIdoso
    if(empty($_POST["dataNascimentoIdoso"])){
        echo "<div class='alert alert-warning text-center'>O campo <strong>DATA DE NASCIMENTO</strong> é obrigatório!</div>";
        $erroPreenchimento = true;
    } else {
        $dataNascimentoIdoso = filtrar_entrada($_POST["dataNascimentoIdoso"]);
        if(strlen($dataNascimentoIdoso) == 10){
            $diaNascimentoIdoso = substr($dataNascimentoIdoso, 8, 2);
            $mesNascimentoIdoso = substr($dataNascimentoIdoso, 5, 2);
            $anoNascimentoIdoso = substr($dataNascimentoIdoso, 0, 4);
            if(!checkdate($mesNascimentoIdoso, $diaNascimentoIdoso, $anoNascimentoIdoso)){
                echo "<div class='alert alert-warning text-center'><strong>DATA INVÁLIDA</strong></div>";
                $erroPreenchimento = true;
            }
        } else {
            echo "<div class='alert alert-warning text-center'><strong>DATA INVÁLIDA</strong></div>";
            $erroPreenchimento = true;
        }
    }

    //Validação do campo telefoneIdoso
    if(empty($_POST["telefoneIdoso"])){
        echo "<div class='alert alert-warning text-center'>O campo <strong>TELEFONE</strong> é obrigatório!</div>";
        $erroPreenchimento = true;
    } else {
        $telefoneIdoso = filtrar_entrada($_POST["telefoneIdoso"]);
    }

    //Validação do campo emailIdoso
    if(empty($_POST["emailIdoso"])){
        echo "<div class='alert alert-warning text-center'>O campo <strong>EMAIL</strong> é obrigatório!</div>";
        $erroPreenchimento = true;
    } else {
        $emailIdoso = filtrar_entrada($_POST["emailIdoso"]);
    }

    //Validação da foto
    $diretorio = "img/";
    $fotoIdoso = $diretorio . basename($_FILES['fotoIdoso']['name']);
    $tipoDaImagem = strtolower(pathinfo($fotoIdoso, PATHINFO_EXTENSION));
    $erroUpload = false;
    if($_FILES['fotoIdoso']['size'] != 0){
        if($_FILES['fotoIdoso']['size'] > 5000000){
            echo "<div class='alert alert-warning text-center'>A <strong>FOTO</strong> deve ter tamanho máximo de 5MB!</div>";
            $erroUpload = true;
        }
        if($tipoDaImagem != "jpg" && $tipoDaImagem != "jpeg" && $tipoDaImagem != "png" && $tipoDaImagem != "webp"){
            echo "<div class='alert alert-warning text-center'>A <strong>FOTO</strong> deve estar nos formatos JPG, JPEG, PNG ou WEBP</div>";
            $erroUpload = true;
        }
        if(!move_uploaded_file($_FILES['fotoIdoso']['tmp_name'], $fotoIdoso)){
            echo "<div class='alert alert-danger text-center'>Erro ao tentar mover a <strong>FOTO</strong> para o diretório $diretorio!</div>";
            $erroUpload = true;
        }
    } else {
        echo "<div class='alert alert-warning text-center'>O campo <strong>FOTO</strong> é obrigatório!</div>";
        $erroUpload = true;
    }

    if(!$erroPreenchimento && !$erroUpload){
        $inserirIdoso = "INSERT INTO Idosos (fotoIdoso, nomeIdoso, dataNascimentoIdoso, telefoneIdoso, emailIdoso) VALUES ('$fotoIdoso', '$nomeIdoso', '$dataNascimentoIdoso', '$telefoneIdoso', '$emailIdoso')";
        include("conexaoBD.php");
        if(mysqli_query($conn, $inserirIdoso)){
            $idIdoso = mysqli_insert_id($conn);
            echo "<div class='alert alert-success text-center'><strong>Idoso</strong> cadastrado(a) com sucesso!</div>";
            echo "<div class='mt-4 text-center'><a href='index.php' class='btn btn-primary'>Ir para tela inicial</a></div>";
            exit;
        } else {
            echo "<div class='alert alert-danger text-center'>Erro ao tentar cadastrar <strong>Usuário</strong> no Banco de Dados $database!</div>" . mysqli_error($conn);
        }
    }
}
?>

<?php include "header.php" ?>

<div class="container text-center mb-3 mt-3" style="padding-top: 300px; padding-bottom: 300px;">
    <!-- ...restante do código HTML/PHP... -->