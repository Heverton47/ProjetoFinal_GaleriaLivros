<?php

$host = 'localhost';
$porta = '3306'; 
$banco = 'galeria_livros';
$usuario = 'root';
$senha = '';
try {

$pdo = new PDO(
"mysql:host=$host;port=$porta;dbname=$banco;charset=utf8",
$usuario,
$senha
);

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
echo "Erro na conexão: " . $e->getMessage();
}
