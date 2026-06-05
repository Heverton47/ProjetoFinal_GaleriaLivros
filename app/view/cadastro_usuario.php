<?php
require_once __DIR__ . '/../controller/UsuarioController.php';

Seguranca::iniciarSessao();

$controller = new UsuarioController($pdo);
$erro = $controller->cadastrarPublico();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn.pixabay.com/photo/2016/09/16/09/20/books-1673578_1280.png" type="image/png">
    <link rel="stylesheet" href="../../css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro de Usuario</title>
</head>
<body class="lista_livros">

<?php include 'cabecalho.php'; ?>

<main class="container">
    <section class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2>Criar conta</h2>

                    <?php if ($erro): ?>
                        <div class="alert alert-danger w-100"><?= htmlspecialchars($erro) ?></div>
                    <?php endif; ?>

                    <form method="post" class="w-100 text-start">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Seguranca::gerarTokenCSRF()) ?>">

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                        <a href="login.php" class="btn btn-secondary">Voltar para login</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'rodape.php'; ?>

</body>
</html>
