<?php
require 'database.php';
$stmt = $pdo->query("SELECT * FROM livros");
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Livraria do Lucas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 50px;
            background:rgb(219, 235, 250);
        }
        .card {
            margin-bottom: 50px;
        }
        h1 {
            font-weight: bold;
            color:rgb(30, 32, 34);
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center mb-5">📚 Livraria do Lucas</h1>
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Livros Cadastrados</div>
        <div class="card-body p-0">
            <table class="table table-striped m-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Ano</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($livros): ?>
                        <?php foreach ($livros as $livro): ?>
                            <tr>
                                <td><?= htmlspecialchars($livro['id']) ?></td>
                                <td><?= htmlspecialchars($livro['titulo']) ?></td>
                                <td><?= htmlspecialchars($livro['autor']) ?></td>
                                <td><?= htmlspecialchars($livro['ano']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">Nenhum livro cadastrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-header bg-success text-white">➕ Adicionar Livro</div>
        <div class="card-body">
            <form action="scripts.php" method="post">
                <div class="mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" name="titulo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Autor</label>
                    <input type="text" name="autor" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ano</label>
                    <input type="number" name="ano" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Adicionar</button>
            </form>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-header bg-danger text-white">🗑️ Excluir Livro</div>
        <div class="card-body">
            <form action="scripts.php" method="post">
                <div class="mb-3">
                    <label class="form-label">ID</label>
                    <input type="number" name="id" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-danger">Excluir</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>