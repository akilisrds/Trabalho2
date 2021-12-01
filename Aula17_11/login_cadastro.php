<?php
    include "bibliotecas/parametros.php";
    include "bibliotecas/conexao.php";
    include LAYOUTS.'header.php';
    if (isset($_POST['gravar'])) {
        try {
            $stmt = $conn->prepare(
                'INSERT INTO usuarios (nome, login, password, email) values (:nome, :login, md5(:senha), :email)');
            $stmt->execute(array('nome'  => $_POST['nome'],
                                 'login' => $_POST['login'],
                                 'senha' => $_POST['senha'],
                                 'email' => $_POST['email']));
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
?>
<form method="post">
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome">
        <label for="nome">Login</label>
        <input type="text" class="form-control" name="login" id="login" placeholder="Login">
        <label for="nome">Senha</label>
        <input type="text" class="form-control" name="senha" id="senha" placeholder="Senha">
        <label for="nome">E-mail</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="E-mail">
    </div>
    <input type="submit" name="gravar" value="Gravar">
    <a href="index.php">Voltar</a>
</form>