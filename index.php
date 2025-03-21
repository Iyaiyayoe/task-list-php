<?php
include 'db.php';

$tasks = $conn->query("SELECT * FROM tasks ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            margin: 0;
        }

        /* Sidebar (Fixed) */
        .sidebar {
            width: 250px;
            background: maroon;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed; /* Sidebar stays fixed */
            top: 0;
            left: 0;
            box-sizing: border-box;
        }

        .sidebar h2 {
            margin-bottom: 15px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px; /* Prevent overlap with sidebar */
            flex: 1;
            padding: 30px;
            background-color: white;
        }

        h2, h3 {
            margin-bottom: 15px;
        }

        form {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        input {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background: maroon;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        button:hover {
            opacity: 0.8;
        }

        /* Task List */
        ul {
            list-style: none;
            padding: 0;
            margin-top: 15px;
        }

        li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            border-bottom: 1px solid #ccc;
        }

        /* Buttons (Complete & Delete) */
        .button-container {
            display: flex;
            gap: 10px;
        }

        .complete-btn, .delete-btn {
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
            text-decoration: none;
            color: white;
        }

        .complete-btn {
            background: maroon;
        }

        .delete-btn {
            background: maroon;
        }

        .completed {
            text-decoration: line-through;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Todo List</h2>
        <a href="index.php">New Task</a>
    </div>

    <div class="main-content">
        <h2>New Task</h2>
        <form action="add_task.php" method="POST">
            <input type="text" name="task" placeholder="Task" required>
            <button type="submit">Add Task</button>
        </form>

        <h3>Task Lists</h3>
        <ul>
            <?php while ($row = $tasks->fetch_assoc()): ?>
                <?php if (!$row['completed']): ?>
                    <li>
                        <span class="task-text"><?php echo htmlspecialchars($row['task']); ?></span>
                        <div class="button-container">
                            <a href="complete_task.php?id=<?php echo $row['id']; ?>" class="complete-btn">Complete</a>
                            <a href="delete_task.php?id=<?php echo $row['id']; ?>" class="delete-btn">Delete</a>
                        </div>
                    </li>
                <?php endif; ?>
            <?php endwhile; ?>
        </ul>

        <h3>Completed Tasks</h3>
        <ul>
            <?php 
            $completedTasks = $conn->query("SELECT * FROM tasks WHERE completed = 1 ORDER BY id DESC");
            while ($row = $completedTasks->fetch_assoc()): 
            ?>
                <li class="completed"><?php echo htmlspecialchars($row['task']); ?></li>
            <?php endwhile; ?>
        </ul>
    </div>

</body>
</html>
