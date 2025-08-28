<?php include "header.php" ?>

<div class="container text-center mb-3 mt-3" style="padding-top: 300px; padding-bottom: 300px;">
    
<?php
        //Verifica se há algum parâmetro chamado 'erroLogin' sendo recebido por GET
        if(isset($_GET['erroLogin'])){
            $erroLogin = $_GET['erroLogin']; //Variável PHP recebe o parâmetro GET

            if($erroLogin == 'dadosInvalidos'){
                echo "<div class='alert alert-warning text-center'><strong>USUÁRIO ou SENHA</strong> inválidos!</div>";
            }

            if($erroLogin == 'naoLogado'){
                echo "<div class='alert alert-warning text-center'><strong>USUÁRIO </strong> não logado!</div>";
            }

            if($erroLogin == 'acessoProibido'){
                //Redireciona para a página index.php
                header('location:index.php');
            }
        }
    ?>

                <div class="row justify-content-center">
                    
                    <div class="col-lg-10 col-xl-7">

                    <h2>Acessar o Sistema:</h2>
                        
                        <form action="actionLogin.php?pagina=formLogin" method="POST" class="was-validated" enctype="multipart/form-data">
                            <!-- Email address input-->
                            <div class="form-floating mb-5">
                                <input class="form-control" id="emailUsuario" name="emailUsuario" type="email" placeholder="teste" required />
                                <label for="emailUsuario">Email</label>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                            </div>
                            <!-- Senha do Usuário -->
                            <div class="form-floating mb-5">
                                <input class="form-control" id="senhaUsuario" name="senhaUsuario" type="password" placeholder="teste" required />
                                <label for="senhaUsuario">Senha</label>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                            </div>
        
                            <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Login</button>
                        </form>

                        <br>

                        <p>
                            Ainda não possui cadastro? <a href="formUsuario.php" title="Cadastrar-se">Clique aqui!</a>&nbsp<i class="bi bi-emoji-smile"></i>
                        </p>
                    </div>
                </div>

</div>

<?php include "footer.php" ?>