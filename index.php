<?php
// Conexão com o banco de dados
include 'config.php';

// Adicionar livro
if (isset($_POST['add'])) {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $qrcode = $_POST['qrcode'];
    
    $stmt = $conn->prepare("INSERT INTO livros (titulo, autor, qrcode) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $titulo, $autor, $qrcode);
    $stmt->execute();
    header("Location: index.php");
    exit();
}

// Atualizar livro
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $qrcode = $_POST['qrcode'];
    
    $stmt = $conn->prepare("UPDATE livros SET titulo=?, autor=?, qrcode=? WHERE id=?");
    $stmt->bind_param("sssi", $titulo, $autor, $qrcode, $id);
    $stmt->execute();
    header("Location: index.php");
    exit();
}

// Excluir livro
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM livros WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: index.php");
    exit();
}

// Buscar livros
$result = $conn->query("SELECT * FROM livros");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Livros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2 class="mb-4">Gerenciamento de Livros</h2>
    
    <!-- Formulário de Adição -->
    <form method="POST" class="mb-4">
        <div class="mb-3">
            <label class="form-label">Título do Livro</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Autor</label>
            <input type="text" name="autor" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">QR Code</label>
            <input type="text" name="qrcode" class="form-control" required>
        </div>
        <button type="submit" name="add" class="btn btn-primary">Adicionar Livro</button>
    </form>
    
    <!-- Lista de Livros -->
    <h3>Livros Cadastrados</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>QR Code</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['titulo']) ?></td>
                    <td><?= htmlspecialchars($row['autor']) ?></td>
                    <td><?= htmlspecialchars($row['qrcode']) ?></td>
                    <td>
                        <a href="index.php?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="index.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
