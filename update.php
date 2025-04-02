<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $conn->query("SELECT * FROM livros WHERE id = $id");
    $livro = $query->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome_livro = $_POST['nome_livro'];
    $autor = $_POST['autor'];
    $qrcode = $_POST['qrcode'];

    $stmt = $conn->prepare("UPDATE livros SET nome_livro=?, autor=?, qrcode=? WHERE id=?");
    $stmt->bind_param("sssi", $nome_livro, $autor, $qrcode, $id);
    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>

<form method="POST">
    <input type="hidden" name="id" value="<?= $livro['id'] ?>">
    <label>Nome do Livro:</label>
    <input type="text" name="nome_livro" value="<?= $livro['nome_livro'] ?>" required>
    <label>Autor:</label>
    <input type="text" name="autor" value="<?= $livro['autor'] ?>" required>
    <label>QRCode:</label>
    <input type="text" name="qrcode" value="<?= $livro['qrcode'] ?>" required>
    <button type="submit">Atualizar</button>
</form>