<?php include "header.php" ?>

<div class="container text-center mb-3 mt-3" style="padding-top: 300px; padding-bottom: 300px;">
    

    <div class="row justify-content-center">
                    
        <div class="col-lg-10 col-xl-7">

        <h2>Cadastrar Novo Idoso:</h2>

            <div class="row">
                <div class="col-12">
                    <form action="actionIdoso.php?pagina=formIdoso" method="POST" class="was-validated" enctype="multipart/form-data">
                        <div class="form-floating mb-3 mt-3">
                            <input type="file" class="form-control" id="fotoIdoso" name="fotoIdoso" required>
                            <label for="fotoIdoso">Foto</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" id="nomeIdoso" placeholder="Nome" name="nomeIdoso" required>
                            <label for="nomeIdoso">Nome Completo</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-floating mb-3 mt-3">
                            <input type="date" class="form-control" id="dataNascimentoIdoso" placeholder="Data de Nascimento do Idoso" name="dataNascimentoIdoso" required>
                            <label for="dataNascimentoIdoso">Data de Nascimento do Idoso</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                    
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" id="telefoneIdoso" placeholder="Telefone" name="telefoneIdoso" required>
                            <label for="Telefone">Telefone</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-floating mb-3 mt-3">
                            <input type="email" class="form-control" id="emailIdoso" placeholder="Email" name="emailIdoso" required>
                            <label for="emailIdoso">Email</label>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                        <button type="submit" class="btn btn-success">Cadastrar</button>
                    </form>
                </div>
            </div>
        <br>
        </div>
    </div>
</div>
                

<?php include "footer.php" ?>