<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task = $_POST['task'];
    $stmt = $conn->prepare("INSERT INTO tasks (task) VALUES (?)");
    $stmt->bind_param("s", $task);
    $stmt->execute();
}

header("Location: index.php");
?>
