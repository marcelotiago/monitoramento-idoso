<?php include "header.php"; ?>

<div class="container text-center mb-3 mt-3" style="padding-top: 300px; padding-bottom: 300px;">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-7">

            <h2>Cadastrar Novo Remédio:</h2>

            <div class="row">
                <div class="col-12">
                    <form action="actionRemedio.php" method="POST" class="was-validated" enctype="multipart/form-data">

                        <div class="form-floating mb-3 mt-3">
                            <input type="file" class="form-control" id="fotoRemedio" name="fotoRemedio" required>
                            <label for="fotoRemedio">Foto</label>
                        </div>

                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" id="nomeRemedio" name="nomeRemedio" required>
                            <label for="nomeRemedio">Nome Remédio</label>
                        </div>

                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" id="descricaoRemedio" name="descricaoRemedio" required>
                            <label for="descricaoRemedio">Descrição</label>
                        </div>

                        <button type="submit" name="acao" value="continuar" class="btn btn-success">Cadastrar e adicionar outro</button>
                        <button type="submit" name="acao" value="finalizar" class="btn btn-primary">Finalizar cadastro</button>
                    </form>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
