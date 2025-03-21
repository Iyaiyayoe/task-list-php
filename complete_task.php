<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("UPDATE tasks SET completed = 1 WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: index.php");
?>
