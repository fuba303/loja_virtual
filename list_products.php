<?php
include 'db.php';

header("Location: index.php");
?>

<?php $conn->close(); ?>

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Erro na conexão com o banco de dados"]);
    exit;
}

$sql = "SELECT id, nome, preco, imagem FROM produtos";
$result = $conn->query($sql);

$produtos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $produtos[] = $row;
    }
    echo json_encode(["success" => true, "produtos" => $produtos]);
} else {
    echo json_encode(["success" => false, "message" => "Nenhum produto encontrado"]);
}

$conn->close();
?>
