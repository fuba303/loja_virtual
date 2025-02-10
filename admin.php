<?php
include 'db.php';

// Verifique se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenha os dados do formulário
    $nome = $_POST['nome'];
    $preco = str_replace(',', '.', $_POST['preco']);
    $imagem = $_FILES['imagem']['name'];

    // Mova a imagem para o diretório desejado
    move_uploaded_file($_FILES['imagem']['tmp_name'], "uploads/" . $imagem);

    // Insira o produto no banco de dados
    $sql = "INSERT INTO produtos (nome, preco, foto) VALUES ('$nome', '$preco', 'uploads/$imagem')";
    $conn->query($sql);
}

// Busque os produtos cadastrados
$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <div class="container mt-4">
        <h2>Painel de Administração</h2>

        <!-- Formulário para adicionar produtos -->
        <form id="produtoForm" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nome do Produto</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Preço</label>
                <input type="text" name="preco" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Imagem do Produto</label>
                <input type="file" name="imagem" class="form-control" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Produto</button>
        </form>

        <hr>

        <!-- Lista de produtos -->
        <h3>Produtos Cadastrados</h3>
        <div id="listaProdutos" class="row">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="col-md-4 mb-4" id="produto-<?php echo $row['id']; ?>">
                        <div class="card">
                            <img src="<?php echo $row['foto']; ?>" class="card-img-top" alt="<?php echo $row['nome']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['nome']; ?></h5>
                                <p class="card-text">Preço: R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></p>
                                <button class="btn btn-danger" onclick="deletarProduto(<?php echo $row['id']; ?>)">Deletar</button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Nenhum produto cadastrado.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function deletarProduto(id) {
            if (confirm('Tem certeza que deseja excluir este produto?')) {
                $.ajax({
                    url: 'delete_product.php',
                    type: 'GET',
                    data: { id: id },
                    success: function(response) {
                        $('#produto-' + id).remove(); // Remove o produto da lista
                        alert('Produto excluído com sucesso!');
                    },
                    error: function() {
                        alert('Erro ao excluir o produto.');
                    }
                });
            }
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>