<?php include "header.php" ?>
<?php include "masthead.php" ?>

<div class='container mt-5 mb-5'>
<?php
include "conexaoBD.php";

// Seleciona todos os idosos
$listarIdosos = "SELECT * FROM Idosos ORDER BY nomeIdoso";
$resIdosos = mysqli_query($conn, $listarIdosos);
$totalIdosos = mysqli_num_rows($resIdosos);

if($totalIdosos > 0){
    echo "<div class='alert alert-info text-center'>Há <strong>$totalIdosos</strong> idosos cadastrados!</div>";
} else {
    echo "<div class='alert alert-info text-center'>Não há idosos cadastrados no sistema!</div>";
}
?>

<hr>

<!-- Portfolio Grid Items -->
<div class="row justify-content-center">
    <?php
    $modalCount = 1; // Para gerar modais únicos
    while($idoso = mysqli_fetch_assoc($resIdosos)){
        $idIdoso   = $idoso['idIdoso'];
        $nomeIdoso = $idoso['nomeIdoso'];
        $fotoIdoso = $idoso['fotoIdoso'];

        // Buscar remédios do idoso
        $listarMedicacoes = "
            SELECT 
                r.nomeRemedio,
                r.descricaoRemedio,
                r.fotoRemedio,
                m.dataMedicacao,
                m.horaMedicacao
            FROM medicacoes m
            INNER JOIN remedios r ON m.idRemedio = r.idRemedio
            INNER JOIN usuarios u ON m.idUsuario = u.idUsuario
            INNER JOIN idosos i ON m.idIdoso = i.idIdoso
            WHERE m.idIdoso = $idIdoso   -- Substitua pelo id do idoso atual
            ORDER BY m.dataMedicacao DESC, m.horaMedicacao DESC;

        ";
        $resMedicacoes = mysqli_query($conn, $listarMedicacoes);

        // Portfolio item
        echo "
        <div class='col-md-6 col-lg-4 mb-5'>
            <div class='portfolio-item mx-auto' data-bs-toggle='modal' data-bs-target='#portfolioModal$modalCount'>
                <div class='portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100'>
                    <div class='portfolio-item-caption-content text-center text-white'><i class='fas fa-plus fa-3x'></i></div>
                </div>
                <img class='img-fluid img-idoso d-block mx-auto' src='$fotoIdoso' alt='$nomeIdoso' />
                <a href='listarRemedios.php?idIdoso=$idIdoso' title='Adicionar Remédio'>
                    <i class='bi bi-clipboard-plus' style='font-size:20px;'></i>
                </a>
            </div>
        </div>
        ";

        // Modal para esse idoso
        echo "
        <div class='portfolio-modal modal fade' id='portfolioModal$modalCount' tabindex='-1' aria-hidden='true'>
            <div class='modal-dialog modal-xl'>
                <div class='modal-content'>
                    <div class='modal-header border-0'>
                        <h2 class='modal-title'>$nomeIdoso</h2>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body text-center'>
                        <img class='img-fluid mb-4 d-block mx-auto' src='$fotoIdoso' alt='$nomeIdoso' style='max-width:200px; border-radius:50%;' />
                        <h4>Remédios cadastrados:</h4>
                        <div class='row justify-content-center'>
        ";

        if(mysqli_num_rows($resMedicacoes) > 0){
            while($medicacoes = mysqli_fetch_assoc($resMedicacoes)){
                $nomeRemedio      = $medicacoes['nomeRemedio'];
                $descricaoRemedio = $medicacoes['descricaoRemedio'];
                $fotoRemedio      = $medicacoes['fotoRemedio'];
                $dataMedicacao    = $medicacoes['dataMedicacao'];
                $horaMedicacao    = $medicacoes['horaMedicacao'];

                echo "
                <div class='col-md-4 mb-3'>
                    <div class='card h-100'>
                        <img class='card-img-top' src='$fotoRemedio' alt='$nomeRemedio'>
                        <div class='card-body text-center'>
                            <h5 class='card-title'>$nomeRemedio</h5>
                            <p class='card-text'>$descricaoRemedio</p>
                            <p class='card-text'>$dataMedicacao</p>
                            <p class='card-text'>$horaMedicacao</p>
                        </div>
                    </div>
                </div>
                ";
            }
        } else {
            echo "<p class='text-muted'>Nenhum remédio cadastrado para este idoso.</p>";
        }

        echo "
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ";

        $modalCount++;
    }
    ?>
</div>

</div>

<?php include "footer.php" ?>
