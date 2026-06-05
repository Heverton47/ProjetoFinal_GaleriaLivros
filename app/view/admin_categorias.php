<?php
require_once __DIR__ . '/../controller/CategoriaController.php';

Seguranca::exigirLogin();

$controller = new CategoriaController($pdo);
$erro = $controller->salvar();
$categoriaEditar = null;

if (isset($_GET['editar'])) {
    $categoriaEditar = $controller->buscarPorId((int)$_GET['editar']);
}

$categorias = $controller->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn.pixabay.com/photo/2016/09/16/09/20/books-1673578_1280.png" type="image/png">
    <link rel="stylesheet" href="../../css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gerenciar Categorias</title>
</head>
<body class="lista_livros">

<?php include 'cabecalho.php'; ?>

<main class="container">
    <section class="card shadow-lg mb-4">
        <div class="card-body">
            <h2><?= $categoriaEditar ? 'Editar categoria' : 'Cadastrar categoria' ?></h2>

            <?php if ($erro): ?>
                <div class="alert alert-danger w-100"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <form method="post" class="w-100 text-start">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Seguranca::gerarTokenCSRF()) ?>">
                <input type="hidden" name="acao" value="<?= $categoriaEditar ? 'editar' : 'cadastrar' ?>">
                <input type="hidden" name="id" value="<?= htmlspecialchars($categoriaEditar['id'] ?? '') ?>">

                <div class="mb-3">
                    <label class="form-label" for="nome">Nome</label>
                    <input class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($categoriaEditar['nome'] ?? '') ?>" required>
                </div>

                <button class="btn btn-primary" type="submit">Salvar</button>
                <?php if ($categoriaEditar): ?>
                    <a class="btn btn-secondary" href="admin_categorias.php">Cancelar</a>
                <?php endif; ?>
            </form>
        </div>
    </section>

    <section class="card shadow-lg">
        <div class="card-body">
            <h2>Categorias cadastradas</h2>
            <div class="table-responsive w-100">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Acoes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorias as $categoria): ?>
                            <tr>
                                <td><?= htmlspecialchars($categoria['nome']) ?></td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="admin_categorias.php?editar=<?= htmlspecialchars($categoria['id']) ?>">Editar</a>
                                    <form method="post" class="d-inline">
                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Seguranca::gerarTokenCSRF()) ?>">
                                        <input type="hidden" name="acao" value="excluir">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($categoria['id']) ?>">
                                        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Excluir esta categoria?')">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

<?php include 'rodape.php'; ?>

</body>
</html>
