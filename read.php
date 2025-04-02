<?php
include 'config.php';
$sql = "SELECT * FROM livros";
$result = $conn->query($sql);
?>

<h2>Lista de Livros</h2>
<ul>
<?php while ($row = $result->fetch_assoc()): ?>
    <li>
        <?= htmlspecialchars($row['nome']) ?> - <?= htmlspecialchars($row['autor']) ?>
        <img src="<?= htmlspecialchars($row['qrcode']) ?>" alt="QR Code">
        <a href='update.php?id=<?= htmlspecialchars($row['id']) ?>'>Editar</a> |
        <a href='delete.php?id=<?= htmlspecialchars($row['id']) ?>'>Excluir</a>
    </li>
<?php endwhile; ?>
</ul>
