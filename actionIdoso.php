<!-- Inclui o header.php -->
<?php include "header.php" ?>

    <div class="container text-center mb-3 mt-3" style="padding-top: 300px; padding-bottom: 300px;">

        <?php

            //Verifica o método de requisição do servidor
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                //Bloco para declaração de variáveis
                $fotoIdoso = $nomeIdoso = $dataNascimentoIdoso = $telefoneIdoso = $emailIdoso = "";

                //Variável booleana para controle de erros de preenchimento
                $erroPreenchimento = false;

                //Validação do campo nomeIdoso
                //Utiliza a função empty() para verificar se o campo está vazio
                if(empty($_POST["nomeIdoso"])){
                    echo "<div class='alert alert-warning text-center'>O campo <strong>NOME</strong> é obrigatório!</div>";
                    $erroPreenchimento = true;
                }
                else{
                    //Armazena valor do formulário na variável
                    $nomeIdoso = filtrar_entrada($_POST["nomeIdoso"]);    
                }

                //Validação do campo dataNascimentoIdoso
                //Utiliza a função empty() para verificar se o campo está vazio
                if(empty($_POST["dataNascimentoIdoso"])){
                    echo "<div class='alert alert-warning text-center'>O campo <strong>DATA DE NASCIMENTO</strong> é obrigatório!</div>";
                    $erroPreenchimento = true;
                }
                else{
                    //Armazena valor do formulário na variável
                    $dataNascimentoIdoso = filtrar_entrada($_POST["dataNascimentoIdoso"]);

                    //Aplicar a função strlen() para verificar o comprimento da string da dataNascimentoIdoso
                    if(strlen($dataNascimentoIdoso) == 10){

                        //Aplicar a função substr() para gerar substrings para armazenar dia, mês e ano de nascimento do usuário
                        $diaNascimentoIdoso = substr($dataNascimentoIdoso, 8, 2);
                        $mesNascimentoIdoso = substr($dataNascimentoIdoso, 5, 2);
                        $anoNascimentoIdoso = substr($dataNascimentoIdoso, 0, 4);

                        //Aplicar a função checkdate() para verificar se trata-se de uma data válida
                        if(!checkdate($mesNascimentoIdoso, $diaNascimentoIdoso, $anoNascimentoIdoso)){
                            echo "<div class='alert alert-warning text-center'><strong>DATA INVÁLIDA</strong></div>";
                            $erroPreenchimento = true;
                        }
                    }
                    else{
                        echo "<div class='alert alert-warning text-center'><strong>DATA INVÁLIDA</strong></div>";
                        $erroPreenchimento = true;
                    }
                }

                //Validação do campo telefoneIdoso
                //Utiliza a função empty() para verificar se o campo está vazio
                if(empty($_POST["telefoneIdoso"])){
                    echo "<div class='alert alert-warning text-center'>O campo <strong>TELEFONE</strong> é obrigatório!</div>";
                    $erroPreenchimento = true;
                }
                else{
                    //Armazena valor do formulário na variável
                    $telefoneIdoso = filtrar_entrada($_POST["telefoneIdoso"]);
                }

                //Validação do campo emailIdoso
                //Utiliza a função empty() para verificar se o campo está vazio
                if(empty($_POST["emailIdoso"])){
                    echo "<div class='alert alert-warning text-center'>O campo <strong>EMAIL</strong> é obrigatório!</div>";
                    $erroPreenchimento = true;
                }
                else{
                    //Armazena valor do formulário na variável
                    $emailIdoso = filtrar_entrada($_POST["emailIdoso"]);
                }

                //Início da validação da foto do usuário
                $diretorio    = "img/"; //Define para qual diretório as imagens serão movidas
                $fotoIdoso  = $diretorio . basename($_FILES['fotoIdoso']['name']); //img/joaozinho.jpg
                $tipoDaImagem = strtolower(pathinfo($fotoIdoso, PATHINFO_EXTENSION)); //Pega o tipo do arquivo em letras minúsculas
                $erroUpload   = false; //Variável para controle do upload da foto

                //Verifica se o tamanho do arquivo é DIFERENTE DE ZERO
                if($_FILES['fotoIdoso']['size'] != 0){

                    //Verifica se o tamanho do arquivo é maior do que 5 MegaBytes (MB) - Medida em Bytes
                    if($_FILES['fotoIdoso']['size'] > 5000000){
                        echo "<div class='alert alert-warning text-center'>A <strong>FOTO</strong> deve ter tamanho máximo de 5MB!</div>";
                        $erroUpload = true;
                    }

                    //Verifica se a foto está nos formatos JPG, JPEG, PNG ou WEBP
                    if($tipoDaImagem != "jpg" && $tipoDaImagem != "jpeg" && $tipoDaImagem != "png" && $tipoDaImagem != "webp"){
                        echo "<div class='alert alert-warning text-center'>A <strong>FOTO</strong> deve estar nos formatos JPG, JPEG, PNG ou WEBP</div>";
                        $erroUpload = true;
                    }

                    //Verifica se a imagem foi movida para o diretório IMG, utilizando a função move_uploaded_file
                    if(!move_uploaded_file($_FILES['fotoIdoso']['tmp_name'], $fotoIdoso)){
                        echo "<div class='alert alert-danger text-center'>Erro ao tentar mover a <strong>FOTO</strong> para o diretório $diretorio!</div>";
                        $erroUpload = true;
                    }

                }
                else{
                    echo "<div class='alert alert-warning text-center'>O campo <strong>FOTO</strong> é obrigatório!</div>";
                    $erroUpload = true;
                }

                //Se não houver erro de preenchimento, exibe alerta de sucesso e uma tabela com os dados informados
                if(!$erroPreenchimento && !$erroUpload){

                    //Cria uma variável para armazenar a QUERY para realizar a inserção dos dados do Usuário na tabela Idosos
                    $inserirIdoso = "INSERT INTO Idosos (fotoIdoso, nomeIdoso, dataNascimentoIdoso, telefoneIdoso, emailIdoso) VALUES ('$fotoIdoso', '$nomeIdoso', '$dataNascimentoIdoso', '$telefoneIdoso', '$emailIdoso')";

                    //Inclui o arquivo de conexão com o Banco de Dados
                    include("conexaoBD.php");

                    //Se conseguir executar a query para inserção, exibe alerta de sucesso e a tabela com os dados informados
                    if(mysqli_query($conn, $inserirIdoso)){

                        $idIdoso = mysqli_insert_id($conn); // pega o último id inserido

                        // Redireciona para o formulário de remédios, passando o id do idoso
                        header("location:formRemedio.php?idIdoso=$idIdoso");
                        exit;

                        echo "<div class='alert alert-success text-center'><strong>Idoso</strong> cadastrado(a) com sucesso!</div>";
                        echo "
                            <div class='container mt-3'>
                                <div class='container mt-3 text-center'>
                                    <img src='$fotoIdoso' style='width:150px;' title='Foto de $nomeIdoso'>
                                </div>
                                <table class='table'>
                                    <tr>
                                        <th>NOME</th>
                                        <td>$nomeIdoso</td>
                                    </tr>
                                    <tr>
                                        <th>DATA DE NASCIMENTO</th>
                                        <td>$diaNascimentoIdoso/$mesNascimentoIdoso/$anoNascimentoIdoso</td>
                                    </tr>
                                    <tr>
                                        <th>TELEFONE</th>
                                        <td>$telefoneIdoso</td>
                                    </tr>
                                    <tr>
                                        <th>EMAIL</th>
                                        <td>$emailIdoso</td>
                                    </tr>
                                </table>
                            </div>
                        ";
                        mysqli_close($conn); //Essa função encerra a conexão com o Banco de Dados
                    }
                    else{
                        echo "<div class='alert alert-danger text-center'>Erro ao tentar cadastrar <strong>Usuário</strong> no Banco de Dados $database!</div>" . mysqli_error($conn);
                    }
                }
            }
            else{
                //Redireciona o usuário para o formIdoso.php
                header("location:formIdoso.php");
            }

            //Função para filtrar entrada de dados
            function filtrar_entrada($dado){
                $dado = trim($dado); //Remove espaços desnecessários
                $dado = stripslashes($dado); //Remove barras invertidas
                $dado = htmlspecialchars($dado); // Converte caracteres especiais em entidades HTML

                //Retorna o dado após filtrado
                return($dado);
            }

        ?>


    </div>

<!-- Inclui o footer.php -->
<?php include "footer.php" ?>