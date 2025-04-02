<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $autor = $_POST['autor'];
    $qrcode = $_POST['qrcode'];
    
    $stmt = $conn->prepare("INSERT INTO livros (nome, autor, qrcode) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $autor, $qrcode);
    
    if ($stmt->execute()) {
        header("Location: read.php");
        exit();
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
}
?>

<form method="POST">
    <label>Nome do Livro:</label>
    <input type="text" name="nome" required>
    <label>Autor:</label>
    <input type="text" name="autor" required>
    <label>QR Code:</label>
    <input type="text" name="qrcode" required>
    <button type="submit">Adicionar</button>
</form>
