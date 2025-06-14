<?php
require 'database.php';

$stmt = $pdo->query("SELECT * FROM tarefas ORDER BY data_vencimento ASC");
$tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Tarefas do Lucas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background:rgb(219, 230, 255);
        }
        .card {
            border-radius: 20px;
        }
        .card-header {
            font-weight: bold;
        }
    </style>
</head>
<body class="container py-5">

    <h1 class="text-center mb-4">📝Tarefas do Lucas</h1>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">➕ Nova Tarefa</div>
        <div class="card-body">
            <form action="scripts.php" method="POST" class="row g-3">
                <div class="col-md-8">
                    <input type="text" name="descricao" class="form-control" placeholder="Descrição da tarefa" required>
                </div>
                <div class="col-md-3">
                    <input type="date" name="data_vencimento" class="form-control" required>
                </div>
                <div class="col-md-1 d-grid">
                    <button type="submit" class="btn btn-success">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-warning">🕒 Tarefas Pendentes</div>
        <ul class="list-group list-group-flush">
            <?php foreach ($tarefas as $tarefa): ?>
                <?php if (!$tarefa['concluida']): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong><?= htmlspecialchars($tarefa['descricao']) ?></strong><br>
                            <small>Vence em: <?= htmlspecialchars($tarefa['data_vencimento']) ?></small>
                        </div>
                        <div class="d-flex gap-2">
                            <form method="POST" action="scripts.php">
                                <input type="hidden" name="concluir_id" value="<?= $tarefa['id'] ?>">
                                <button class="btn btn-sm btn-success">✔️ Concluir</button>
                            </form>
                            <form method="POST" action="scripts.php">
                                <input type="hidden" name="excluir_id" value="<?= $tarefa['id'] ?>">
                                <button class="btn btn-sm btn-danger">🗑️</button>
                            </form>
                        </div>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">✅ Tarefas Concluídas</div>
        <ul class="list-group list-group-flush">
            <?php
            $temConcluidas = false;
            foreach ($tarefas as $tarefa):
                if ($tarefa['concluida']):
                    $temConcluidas = true;
            ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <del><?= htmlspecialchars($tarefa['descricao']) ?></del><br>
                        <small>Venceu em: <?= htmlspecialchars($tarefa['data_vencimento']) ?></small>
                    </div>
                    <form method="POST" action="scripts.php">
                        <input type="hidden" name="excluir_id" value="<?= $tarefa['id'] ?>">
                        <button class="btn btn-sm btn-outline-danger">🗑️</button>
                    </form>
                </li>
            <?php
                endif;
            endforeach;
            if (!$temConcluidas) {
                echo '<li class="list-group-item text-muted text-center">Nenhuma tarefa concluída ainda.</li>';
            }
            ?>
        </ul>
    </div>
</body>
</html>
