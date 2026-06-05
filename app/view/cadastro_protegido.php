<?php
require_once __DIR__ . '/../core/Seguranca.php';

Seguranca::exigirLogin();
$usuario = Seguranca::usuarioLogado();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn.pixabay.com/photo/2016/09/16/09/20/books-1673578_1280.png" type="image/png">
    <link rel="stylesheet" href="../../css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Area Restrita</title>
</head>
<body class="lista_livros">

<?php include 'cabecalho.php'; ?>

<main class="container">
    <section class="card shadow-lg">
        <div class="card-body">
            <h2>Area Restrita</h2>
            <p>Usuario logado: <?= htmlspecialchars($usuario['nome']) ?></p>
            <?php if (!empty($_COOKIE['ultimo_acesso'])): ?>
                <p>Ultimo acesso salvo em cookie: <?= htmlspecialchars($_COOKIE['ultimo_acesso']) ?></p>
            <?php endif; ?>

            <div class="d-flex flex-wrap gap-2 justify-content-center">
                <a href="admin_livros.php" class="btn btn-primary">Gerenciar livros</a>
                <a href="admin_categorias.php" class="btn btn-primary">Gerenciar categorias</a>
                <a href="admin_usuarios.php" class="btn btn-primary">Gerenciar usuarios</a>
                <a href="lista_livros.php" class="btn btn-secondary">Ver galeria</a>
                <a href="logout.php" class="btn btn-danger">Sair</a>
            </div>
        </div>
    </section>
</main>

<?php include 'rodape.php'; ?>

</body>
</html>
