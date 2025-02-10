<?php
include 'db.php';       // Conexão com o MySQL (se necessário)
include 'firebase.php'; // Inclui a conexão com o Firebase

// Recuperar produtos do Firebase
$produtosRef = $database->getReference('produtos');
$produtos = $produtosRef->getValue();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Minha Lojinha</title>
</head>
<body>

    <header class="bg-primary text-white text-center py-4">
        <h1>Minha Lojinha</h1>
        <p>Escolha seus produtos e peça pelo WhatsApp!</p>
    </header>

    <div class="container my-4">
        <div class="row" id="produtos">
            <?php if (!empty($produtos)): ?>
                <?php foreach ($produtos as $id => $produto): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo $produto['foto']; ?>" class="card-img-top" alt="<?php echo $produto['nome']; ?>" data-bs-toggle="modal" data-bs-target="#imageModal<?php echo $id; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $produto['nome']; ?></h5>
                                <p class="card-text">Preço: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                                <a href="https://wa.me/5562999394471?text=Olá, Gostaria de comprar o produto: <?php echo $produto['nome']; ?>" class="btn btn-primary" target="_blank">Clique aqui para entrar em contato pelo WhatsApp</a>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="imageModal<?php echo $id; ?>" tabindex="-1" aria-labelledby="imageModalLabel<?php echo $id; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel<?php echo $id; ?>"><?php echo $produto['nome']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="<?php echo $produto['foto']; ?>" class="img-fluid" alt="<?php echo $produto['nome']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum produto encontrado.</p>
            <?php endif; ?>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3">
        <p>📞 Contato: <a href="https://wa.me/5562999394471" class="text-white text-decoration-none" target="_blank">(62) 99939-4471</a></p>
        <p>📍 <a href="https://www.google.com/maps/place/Rua+Exemplo,+123,+Cidade,+Estado" class="text-white text-decoration-none" target="_blank">Minha Localização</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>