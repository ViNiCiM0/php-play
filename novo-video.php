<?php

$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false) {
    header("Location: index.php?sucesso=0");
    exit();
}

$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
if ($titulo === false) {
    header("Location: index.php?sucesso=0");
    exit();
}

$sql = 'INSERT INTO videos (url, title) VALUES (?, ?)';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $url);
$stmt->bindValue(2, $titulo);

if ($stmt->execute() === false){
    header('location: index.php?sucesso=0');
}else{
    header('location: index.php?sucesso=1');
}