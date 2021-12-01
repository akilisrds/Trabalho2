<?php
    if (isset($_POST['alterar'])) {
        try {
            $stmt = $conn->prepare(
                'UPDATE cidades SET codigo = :codigo, estado = :estado, nome = :nome WHERE id = :id');
            $stmt->execute(array('nome' => $_POST['nome'],
                                 'codigo' => $_POST['codigo'],
                                 'estado' => $_POST['estado'],
                                'id' => $_GET['id']));
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
 
    if (isset($_GET['id'])) {
        $stmt = $conn->prepare('SELECT * FROM cidades WHERE id = :id');
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    }
    $stmt->execute();
    $r = $stmt->fetchAll();
 
?>
<form method="post">
    <input type="text" name="codigo" value="<?=$r[0]['codigo']?>">
    <?php
        $stmt = $conn->prepare('SELECT * FROM estados');
        $stmt->execute();
        $result = $stmt->fetchAll();
    ?>
    <div class="form-group">
        <label for="estado">Estado</label>
        <select class="form-control" name="estado" id="estado">
            <option value="">** Selecione **</option>
            <?php
                foreach ($result as $l) {
                    ?>
                        <option selected value="<?=$l['id']?>"><?=$l['sigla']?> - <?=$l['nome']?></option>
                    <?php
                }
            ?>
        </select>
    </div>
    <input type="text" name="nome" value="<?=$r[0]['nome']?>">
    <input type="submit" name="alterar" value="Salvar">
</form>
