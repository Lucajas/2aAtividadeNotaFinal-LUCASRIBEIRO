<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $ano = $_POST['ano'] ?? '';

    if ($titulo && $autor && $ano) {
        try {
            $stmt = $pdo->prepare("INSERT INTO livros (titulo, autor, ano) VALUES (?, ?, ?)");
            $stmt->execute([$titulo, $autor, $ano]);
        } catch (PDOException $e) {
            echo "ERRO: " . $e->getMessage();
            exit;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';

    if ($id && is_numeric($id)) {
        try {
            $stmt = $pdo->prepare("DELETE FROM livros WHERE id = ?");
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "ERRO: " . $e->getMessage();
            exit;
        }
    }
}

header("Location: index.php");
exit;
?>