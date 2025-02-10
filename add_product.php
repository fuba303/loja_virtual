<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $foto = $_POST['foto'];

    $sql = "INSERT INTO produtos (nome, preco, foto) VALUES ('$nome', '$preco', '$foto')";
    if ($conn->query($sql) === TRUE) {
        echo "Produto adicionado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
</head>
<body>
    <h1>Adicionar Produto</h1>
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome" required>
        <label>Preço:</label>
        <input type="text" name="preco" required>
        <label>Foto URL:</label>
        <input type="text" name="foto" required>
        <button type="submit">Adicionar</button>
    </form>
    <a href="index.php">Voltar</a>
</body>
</html>

<?php $conn->close(); ?>
