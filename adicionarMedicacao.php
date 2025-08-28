<!-- Inclui o header.php -->
<?php include "header.php" ?>

    <div class="container text-center mb-3 mt-3" style="padding-top: 300px; padding-bottom: 300px;">

        <?php

            //Verifica o método de requisição do servidor
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                //Bloco para declaração de variáveis
                $dataMedicacao = $horaMedicacao = "";
                $idUsuario = 10;
                //Variável booleana para controle de erros de preenchimento
                $erroPreenchimento = false;

                $idIdoso = filtrar_entrada($_POST["idIdoso"]);
                $idRemedio = filtrar_entrada($_POST["idRemedio"]);

                //Validação do campo dataMedicacao
                //Utiliza a função empty() para verificar se o campo está vazio
                if(empty($_POST["dataMedicacao"])){
                    echo "<div class='alert alert-warning text-center'>O campo <strong>DATA</strong> é obrigatório!</div>";
                    $erroPreenchimento = true;
                }
                else{
                    //Armazena valor do formulário na variável
                    $dataMedicacao = filtrar_entrada($_POST["dataMedicacao"]);
                }

                //Validação do campo horaMedicacao
                //Utiliza a função empty() para verificar se o campo está vazio
                if(empty($_POST["horaMedicacao"])){
                    echo "<div class='alert alert-warning text-center'>O campo <strong>HORA</strong> é obrigatório!</div>";
                    $erroPreenchimento = true;
                }
                else{
                    //Armazena valor do formulário na variável
                    $horaMedicacao = filtrar_entrada($_POST["horaMedicacao"]);
                }

                $inserirMedicacao = "INSERT INTO medicacoes (idUsuario, idIdoso, idRemedio, dataMedicacao, horaMedicacao) VALUES ('$idUsuario', '$idIdoso', '$idRemedio', '$dataMedicacao', '$horaMedicacao')";

                //Se não houver erro de preenchimento, exibe alerta de sucesso e uma tabela com os dados informados
                if(!$erroPreenchimento){

                    //Cria uma variável para armazenar a QUERY para realizar a inserção dos dados do Usuário na tabela Idosos
                    $inserirMedicacao = "INSERT INTO medicacoes (idUsuario, idIdoso, idRemedio, dataMedicacao, horaMedicacao) VALUES ('$idUsuario', '$idIdoso', '$idRemedio', '$dataMedicacao', '$horaMedicacao')";

                    //Inclui o arquivo de conexão com o Banco de Dados
                    include("conexaoBD.php");

                    //Se conseguir executar a query para inserção, exibe alerta de sucesso e a tabela com os dados informados
                    if(mysqli_query($conn, $inserirMedicacao)){

                        echo "<div class='alert alert-success text-center'><strong>Medicação</strong> cadastrado(a) com sucesso!</div>";
                        echo "
                            <div class='container mt-3'>
                                <table class='table'>
                                    <tr>
                                        <th>IDOSO:</th>
                                        <td>$$idIdoso</td>
                                    </tr>
                                    <tr>
                                        <th>REMÉDIO</th>
                                        <td>$idRemedio</td>
                                    </tr>
                                    <tr>
                                        <th>DATA DA MEDICAÇÃO</th>
                                        <td>$dataMedicacao</td>
                                    </tr>
                                    <tr>
                                        <th>HORA DA MEDICAÇÃO</th>
                                        <td>$horaMedicacao</td>
                                    </tr>
                                </table>
                            </div>
                        ";
                        mysqli_close($conn); //Essa função encerra a conexão com o Banco de Dados
                    }
                    else{
                        echo "<div class='alert alert-danger text-center'>Erro ao tentar cadastrar <strong>MEDICAÇÃO</strong> no Banco de Dados $database!</div>" . mysqli_error($conn);
                    }
                }
            }
            else{
                //Redireciona o usuário para o formIdoso.php
                echo $inserirMedicacao;
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