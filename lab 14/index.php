<?php
// Подключение к базе данных
$host = "localhost";
$user = "stud";   // пользователь MySQL
$pass = "1234";           // пароль MySQL
$db   = "islam";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$error = "";

// --- Добавление ---
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add"])) {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $group_name = trim($_POST["group_name"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Некорректный Email!";
    } else {
        $stmt = $conn->prepare("INSERT INTO students (name, email, group_name) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $group_name);
        $stmt->execute();
        header("Location: index.php");
        exit;
    }
}

// --- Удаление ---
if (isset($_GET["delete"])) {
    $id = (int)$_GET["delete"];
    $conn->query("DELETE FROM students WHERE id = $id");
    header("Location: index.php");
    exit;
}

// --- Редактирование - получение данных для формы ---
$edit_mode = false;
$edit_student = null;

if (isset($_GET["edit"])) {
    $edit_mode = true;
    $edit_id = (int)$_GET["edit"];
    $result = $conn->query("SELECT * FROM students WHERE id = $edit_id");
    $edit_student = $result->fetch_assoc();
}

// --- Обработка отправки редактирования ---
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"])) {
    $id = (int)$_POST["id"];
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $group_name = trim($_POST["group_name"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Некорректный Email!";
        $edit_mode = true;
        $edit_student = ["id"=>$id, "name"=>$name, "email"=>$email, "group_name"=>$group_name];
    } else {
        $stmt = $conn->prepare("UPDATE students SET name=?, email=?, group_name=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $email, $group_name, $id);
        $stmt->execute();
        header("Location: index.php");
        exit;
    }
}

// --- Фильтр по email ---
$email_filter = "";
if (!empty($_GET["email_filter"])) {
    $email_filter = $conn->real_escape_string($_GET["email_filter"]);
    $result = $conn->query("SELECT * FROM students WHERE email LIKE '%$email_filter%' ORDER BY name ASC");
} else {
    $result = $conn->query("SELECT * FROM students ORDER BY name ASC");
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Студенты</title>
<style>
    body { font-family: Arial, sans-serif; margin: 30px; }
    table { border-collapse: collapse; width: 700px; margin-top: 20px; }
    th, td { border: 1px solid #555; padding: 8px; text-align: left; }
    th { background: #f0f0f0; }
    .error { color: red; margin-bottom: 15px; }
    form { margin-bottom: 20px; }
    input[type=text] { width: 300px; padding: 6px; margin-bottom: 10px; }
    button { padding: 6px 12px; cursor: pointer; }
    a { color: blue; text-decoration: none; }
    a:hover { text-decoration: underline; }
</style>
</head>
<body>

<h2><?= $edit_mode ? "Редактировать студента" : "Добавить студента" ?></h2>

<?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
    <input type="hidden" name="id" value="<?= $edit_mode ? $edit_student['id'] : '' ?>">
    ФИО: <br>
    <input type="text" name="name" required value="<?= $edit_mode ? htmlspecialchars($edit_student['name']) : '' ?>"><br>

    Email: <br>
    <input type="text" name="email" required value="<?= $edit_mode ? htmlspecialchars($edit_student['email']) : '' ?>"><br>

    Группа: <br>
    <input type="text" name="group_name" required value="<?= $edit_mode ? htmlspecialchars($edit_student['group_name']) : '' ?>"><br>

    <?php if ($edit_mode): ?>
        <button type="submit" name="update">Сохранить</button>
        <a href="index.php" style="margin-left: 10px;">Отмена</a>
    <?php else: ?>
        <button type="submit" name="add">Добавить</button>
    <?php endif; ?>
</form>

<hr>

<h2>Поиск по Email</h2>
<form method="get">
    <input type="text" name="email_filter" value="<?= htmlspecialchars($email_filter) ?>">
    <button type="submit">Найти</button>
</form>

<h2>Список студентов</h2>

<table>
<tr>
    <th>ID</th>
    <th>ФИО</th>
    <th>Email</th>
    <th>Группа</th>
    <th>Действия</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row["id"] ?></td>
    <td><?= htmlspecialchars($row["name"]) ?></td>
    <td><?= htmlspecialchars($row["email"]) ?></td>
    <td><?= htmlspecialchars($row["group_name"]) ?></td>
    <td>
        <a href="?edit=<?= $row["id"] ?>">Редактировать</a> |
        <a href="?delete=<?= $row["id"] ?>" onclick="return confirm('Удалить запись?')">Удалить</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>