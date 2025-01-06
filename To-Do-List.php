<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    form {
        display: flex;
        justify-content: space-between;
    }

    input[type="text"] {
        width: 70%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    input[type="submit"] {
        padding: 10px;
        border: none;
        background: #28a745;
        color: #fff;
        border-radius: 3px;
        cursor: pointer;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    li {
        background: #f9f9f9;
        margin: 5px 0;
        padding: 10px;
        border-radius: 3px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .delete {
        background: #dc3545;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>To-Do List</h1>
        <form method="POST">
            <input type="text" name="task" placeholder="New task" required>
            <input type="submit" value="Add">
        </form>
        <ul>
            <?php
            session_start();
            if (!isset($_SESSION['tasks'])) {
                $_SESSION['tasks'] = [];
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['task'])) {
                $_SESSION['tasks'][] = htmlspecialchars($_POST['task']);
            }
            if (isset($_GET['delete'])) {
                unset($_SESSION['tasks'][$_GET['delete']]);
                $_SESSION['tasks'] = array_values($_SESSION['tasks']);
            }
            foreach ($_SESSION['tasks'] as $index => $task) {
                echo "<li>$task <a href='?delete=$index' class='delete'>Delete</a></li>";
            }
            ?>
        </ul>
    </div>
</body>

</html>