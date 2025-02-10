<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM produtos WHERE id='$id'";
    $result = $conn->query($sql);
    $produto = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $foto = $_POST['foto'];

    $sql = "UPDATE produtos SET nome='$nome', preco='$preco', foto='$foto' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Produto atualizado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
</head>
<body>
    <h1>Editar Produto</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" required>
        <label>Preço:</label>
        <input type="text" name="preco" value="<?php echo $produto['preco']; ?>" required>
        <label>Foto URL:</label>
        <input type="text" name="foto" value="<?php echo $produto['foto']; ?>" required>
        <button type="submit">Atualizar</button>
    </form>
    <a href="index.php">Voltar</a>
</body>
</html>

<?php $conn->close(); ?>
