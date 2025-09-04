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
                            <!-- ...existing code... -->
                            <!-- ...existing code... -->
                            
                            <input type="hidden" name="idIdoso" value="<?php echo $idIdoso ?>">

                            <div class="mb-3 text-center">
                                <label for="idRemedio" class="form-label w-100">Selecione o Remédio:</label>
                                <select class='form-select w-50 mx-auto' id='idRemedio' name='idRemedio'>
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
                            </div>

                            <div class="mb-3 text-center">
                                <label for="dataMedicacao" class="form-label w-100">Data da Medicação:</label>
                                <input type="date" class="form-control w-50 mx-auto" id="dataMedicacao" name="dataMedicacao" required>
                            </div>

                            <div class="mb-3 text-center">
                                <label for="horaMedicacao" class="form-label w-100">Hora da Medicação:</label>
                                <input type="time" class="form-control w-50 mx-auto" id="horaMedicacao" name="horaMedicacao" required>
                            </div>
                            <div class="mb-3 text-center">
                                <label for="descricaoMedicacao" class="form-label w-100">Descrição (opcional):</label>
                                <textarea class="form-control w-50 mx-auto" id="descricaoMedicacao" name="descricaoMedicacao" rows="2" placeholder="Digite uma observação ou descrição..."></textarea>
                            </div>
                            <br>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Adicionar</button>
                            </div>
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
