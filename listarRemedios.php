<?php include "header.php"; ?>

<div class="container text-center mb-3 mt-3" style="padding-top: 300px; padding-bottom: 300px;">

    <?php
    
        if(isset($_GET['idIdoso'])){
            $idIdoso = $_GET['idIdoso']; //Variável PHP recebe o parâmetro GET
        }

    ?>
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-7">

            <h2>Selecione um Remédio:</h2>

            <div class='row'>

                <!-- Coluna para exibir o select para listar Usuários -->
                <div class='col-sm-12'>
                    <div class='form-floating mt-3 mb-3'>
                        <form action="adicionarMedicacao.php" method="POST">
                            
                            <input type="hidden" name="idIdoso" value="<?php echo $idIdoso ?>">

                            <select class='form-select' name='idRemedio'>
                                <?php
                                    include "conexaoBD.php";
                                    $listarRemedios = "SELECT * FROM Remedios";
                                    $res = mysqli_query($conn, $listarRemedios) or die ("Erro ao tentar carregar Remédios!");
                                    while($registro = mysqli_fetch_assoc($res)){
                                        $idRemedio    = $registro['idRemedio'];
                                        $nomeRemedio = $registro['nomeRemedio'];
                                        echo "<option value='$idRemedio'>$nomeRemedio</option>";
                                    }
                                ?>
                            </select>
                            <div class="form-floating mb-3 mt-3">
                                <input type="date" class="form-control" id="dataMedicacao" name="dataMedicacao" required>
                                <label for="dataMedicacao">Data da Medicação:</label>
                            </div>

                            <div class="form-floating mb-3 mt-3">
                                <input type="time" class="form-control" id="horaMedicacao" name="horaMedicacao" required>
                                <label for="horaMedicacao">Hora da Medicação:</label>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success">Adicionar</button>
                        </form>
                    </div>

                    <p>
                        Não encontrou o remédio na lista? <a href="formRemedio.php" title="Cadastrar novo Remédio">Clique aqui!</a>&nbsp<i class="bi bi-emoji-smile"></i>
                    </p>
                </div>

            </div>

            <br>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
