<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['descricao'], $_POST['data_vencimento'])) {
        $descricao = $_POST['descricao'];
        $data = $_POST['data_vencimento'];

        if ($descricao && $data) {
            try {
                $stmt = $pdo->prepare("INSERT INTO tarefas (descricao, data_vencimento, concluida) VALUES (?, ?, 0)");
                $stmt->execute([$descricao, $data]);
            } catch (PDOException $e) {
                echo "ERRO: " . $e->getMessage();
                exit;
            }
        }
    }

    if (isset($_POST['concluir_id'])) {
        $id = $_POST['concluir_id'];
        if (is_numeric($id)) {
            try {
                $stmt = $pdo->prepare("UPDATE tarefas SET concluida = 1 WHERE id = ?");
                $stmt->execute([$id]);
            } catch (PDOException $e) {
                echo "ERRO: " . $e->getMessage();
                exit;
            }
        }
    }

    if (isset($_POST['excluir_id'])) {
        $id = $_POST['excluir_id'];
        if (is_numeric($id)) {
            try {
                $stmt = $pdo->prepare("DELETE FROM tarefas WHERE id = ?");
                $stmt->execute([$id]);
            } catch (PDOException $e) {
                echo "ERRO: " . $e->getMessage();
                exit;
            }
        }
    }

    header("Location: index.php");
    exit;
}
?>