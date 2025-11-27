<?php
// ----------------------------
// Connexion à la base de données
// ----------------------------
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'todolist');
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306');

try {
    $pdo = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// ----------------------------
// Traitement POST
// ----------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'new' && !empty($_POST['title'])) {
        $stmt = $pdo->prepare("INSERT INTO todo (title) VALUES (?)");
        $stmt->execute([$_POST['title']]);
    }

    if ($action === 'delete' && !empty($_POST['id'])) {
        $stmt = $pdo->prepare("DELETE FROM todo WHERE id = ?");
        $stmt->execute([$_POST['id']]);
    }

    if ($action === 'toggle' && !empty($_POST['id'])) {
        $stmt = $pdo->prepare("UPDATE todo SET done = 1 - done WHERE id = ?");
        $stmt->execute([$_POST['id']]);
    }

    // Recharger la page après l'action
    header("Location: index.php");
    exit;
}

// ----------------------------
// Lecture des tâches
// ----------------------------
$stmt = $pdo->query("SELECT * FROM todo ORDER BY created_at DESC");
$taches = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>