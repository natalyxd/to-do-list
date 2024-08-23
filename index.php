<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "todo_list";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $id = intval($_POST['id']); // Get the task ID for update, delete, or toggle operations

        if ($action === 'add') {
            // Add a new task
            $title = $conn->real_escape_string($_POST['title']);
            $description = $conn->real_escape_string($_POST['description']);
            $due_date = $conn->real_escape_string($_POST['due_date']);

            $sql = "INSERT INTO tasks (title, description, due_date) VALUES ('$title', '$description', '$due_date')";
            $conn->query($sql);

        } elseif ($action === 'update') {
            // Update an existing task
            $title = $conn->real_escape_string($_POST['title']);
            $description = $conn->real_escape_string($_POST['description']);
            $due_date = $conn->real_escape_string($_POST['due_date']);

            $sql = "UPDATE tasks SET title='$title', description='$description', due_date='$due_date' WHERE id=$id";
            $conn->query($sql);

        } elseif ($action === 'delete') {
            // Delete a task
            $sql = "DELETE FROM tasks WHERE id=$id";
            $conn->query($sql);

        } elseif ($action === 'toggleComplete') {
            // Toggle the completion status of a task
            $sql = "UPDATE tasks SET is_completed = !is_completed WHERE id=$id";
            $conn->query($sql);
        }
    }

    // Redirect to avoid form resubmission
    header("Location: index.php");
    exit();
}

// Fetch tasks from the database
$tasks = [];
$sql = "SELECT * FROM tasks ORDER BY due_date ASC";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>My To-Do List</h1>

        <form method="POST" id="taskForm">
            <input type="hidden" id="task_id" name="id">
            <input type="hidden" name="action" id="formAction" value="add">
            <input type="text" id="title" name="title" placeholder="Task Title" required>
            <textarea id="description" name="description" placeholder="Task Description"></textarea>
            <input type="datetime-local" id="due_date" name="due_date" required>
            <button type="submit" id="submitButton">Add Task</button>
        </form>

        <ul id="taskList">
            <?php foreach ($tasks as $task): ?>
                <li class="<?= $task['is_completed'] ? 'completed' : '' ?>">
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $task['id'] ?>">
                        <input type="hidden" name="action" value="toggleComplete">
                        <div class="custom-checkbox <?= $task['is_completed'] ? 'checked' : '' ?>" onclick="this.parentElement.submit();"></div>
                    </form>
                    <div class="task-content">
                        <div class="task-title"><?= htmlspecialchars($task['title']) ?></div>
                        <div class="task-desc"><?= htmlspecialchars($task['description']) ?> (Due: <?= $task['due_date'] ?>)</div>
                    </div>
                    <div>
                        <button class="edit" onclick="editTask(<?= $task['id'] ?>, '<?= htmlspecialchars($task['title'], ENT_QUOTES) ?>', '<?= htmlspecialchars($task['description'], ENT_QUOTES) ?>', '<?= $task['due_date'] ?>')">Edit</button>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $task['id'] ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" class="delete">Delete</button>
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="app.js"></script>
</body>
</html>