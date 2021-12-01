<?php
    if (isset($_POST['gravar'])) {
        try {
            $stmt = $conn->prepare(
                'INSERT INTO cidades (codigo, estado, nome) values (:codigo, :estado, :nome)');
            $stmt->execute(array('nome' => $_POST['nome'],
                                 'codigo' => $_POST['codigo'],
                                 'estado' => $_POST['estado']));
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
?>
<form method="post">
    <div class="form-group">
        <label for="codigo">Codigo</label>
        <input type="text" class="form-control" name="codigo" id="codigo" placeholder="codigo">
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
        <label for='nome'>Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome">
    </div>
    <input type="submit" name="gravar" value="Gravar">
</form>
