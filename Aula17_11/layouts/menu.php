<?php
    $stmt = $conn->prepare('SELECT * FROM menu order by ordem,descricao');
    $stmt->execute();
 
    $resultado = $stmt->fetchAll();
?>
<div class="row">
 
    <?php
        foreach ($resultado as $linha) {
            ?>
                <a href="<?=$linha['endereco']?>"
                class="<?=$linha['classe']?>">
                <?=$linha['descricao']?></a>
            <?php
        }
    ?>
    <form method="POST">
        <input class="btn btn-danger mx-2 mt-2" type="submit" name="desconectar" value="Desconetar-se">
    </form>
    </div>
<hr>
