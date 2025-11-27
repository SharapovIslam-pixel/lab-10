<?php
$host = "127.0.0.1";
$port = "3307";
$user = "root";
$pass = "";
$dbname = "my_lab13";

// Подключение к MySQL
try {
    $pdo = new PDO("mysql:host=$host;port=$port;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Создание базы
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8 COLLATE utf8_general_ci");
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Создание таблиц
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS students (
            id INT AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(100) NOT NULL,
            group_name VARCHAR(50),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS courses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            course_name VARCHAR(100) NOT NULL,
            course_code VARCHAR(20) UNIQUE
        );
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS grades (
            id INT AUTO_INCREMENT PRIMARY KEY,
            student_id INT,
            course_id INT,
            grade VARCHAR(5),
            FOREIGN KEY(student_id) REFERENCES students(id) ON DELETE CASCADE,
            FOREIGN KEY(course_id) REFERENCES courses(id) ON DELETE CASCADE
        );
    ");

} catch(PDOException $e){
    die("Ошибка: " . $e->getMessage());
}

// Добавление нового студента
if(isset($_POST['add_student'])){
    $stmt = $pdo->prepare("INSERT INTO students (full_name, group_name) VALUES (?, ?)");
    $stmt->execute([$_POST['full_name'], $_POST['group_name']]);
}

// Добавление нового курса
if(isset($_POST['add_course'])){
    $stmt = $pdo->prepare("INSERT INTO courses (course_name, course_code) VALUES (?, ?)");
    $stmt->execute([$_POST['course_name'], $_POST['course_code']]);
}

// Добавление оценки
if(isset($_POST['add_grade'])){
    $stmt = $pdo->prepare("INSERT INTO grades (student_id, course_id, grade) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['student_id'], $_POST['course_id'], $_POST['grade']]);
}

// Получение данных для форм
$students = $pdo->query("SELECT * FROM students")->fetchAll(PDO::FETCH_ASSOC);
$courses = $pdo->query("SELECT * FROM courses")->fetchAll(PDO::FETCH_ASSOC);

// HTML
echo "<h2>Добавить студента</h2>
<form method='POST'>
    ФИО: <input type='text' name='full_name' required>
    Группа: <input type='text' name='group_name'>
    <button type='submit' name='add_student'>Добавить</button>
</form>";

echo "<h2>Добавить курс</h2>
<form method='POST'>
    Название курса: <input type='text' name='course_name' required>
    Код курса: <input type='text' name='course_code'>
    <button type='submit' name='add_course'>Добавить</button>
</form>";

echo "<h2>Выставить оценку</h2>
<form method='POST'>
    Студент: <select name='student_id'>";
foreach($students as $s){
    echo "<option value='{$s['id']}'>{$s['full_name']}</option>";
}
echo "</select>";

echo " Курс: <select name='course_id'>";
foreach($courses as $c){
    echo "<option value='{$c['id']}'>{$c['course_name']}</option>";
}
echo "</select>";

echo " Оценка: <input type='text' name='grade'>
<button type='submit' name='add_grade'>Добавить</button>
</form>";

// Вывод всех студентов с курсами и оценками
echo "<h2>Все студенты с курсами и оценками</h2>";
echo "<table border='1' cellpadding='5'>
<tr><th>Студент</th><th>Группа</th><th>Курс</th><th>Оценка</th></tr>";

$stmt = $pdo->query("
    SELECT s.full_name, s.group_name, c.course_name, g.grade
    FROM students s
    LEFT JOIN grades g ON s.id = g.student_id
    LEFT JOIN courses c ON g.course_id = c.id
    ORDER BY s.id
");

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo "<tr>
        <td>{$row['full_name']}</td>
        <td>{$row['group_name']}</td>
        <td>{$row['course_name']}</td>
        <td>{$row['grade']}</td>
    </tr>";
}

echo "</table>";
?>
