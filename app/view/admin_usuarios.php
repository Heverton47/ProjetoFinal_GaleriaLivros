<?php
require_once __DIR__ . '/../controller/UsuarioController.php';

Seguranca::exigirLogin();
Seguranca::validarAdmin();

$controller = new UsuarioController($pdo);
$erro = $controller->salvarAdmin();
$usuarioEditar = null;

if (isset($_GET['editar'])) {
    $usuarioEditar = $controller->buscarPorId((int)$_GET['editar']);
}

$usuarios = $controller->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn.pixabay.com/photo/2016/09/16/09/20/books-1673578_1280.png" type="image/png">
    <link rel="stylesheet" href="../../css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gerenciar Usuarios</title>
</head>
<body class="lista_livros">

<?php include 'cabecalho.php'; ?>

<main class="container">

    <section class="card shadow-lg mb-4">
        <div class="card-body">
            <h2><?= $usuarioEditar ? 'Editar usuario' : 'Cadastrar usuario' ?></h2>

            <?php if ($erro): ?>
                <div class="alert alert-danger w-100"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <form method="post" class="w-100 text-start">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Seguranca::gerarTokenCSRF()) ?>">
                <input type="hidden" name="acao" value="<?= $usuarioEditar ? 'editar' : 'cadastrar' ?>">
                <input type="hidden" name="id" value="<?= htmlspecialchars($usuarioEditar['id'] ?? '') ?>">

                <div class="mb-3">
                    <label class="form-label" for="nome">Nome</label>
                    <input class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($usuarioEditar['nome'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" value="<?= htmlspecialchars($usuarioEditar['email'] ?? '') ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="senha">Senha <?= $usuarioEditar ? '(preencha apenas se quiser alterar)' : '' ?></label>
                    <input class="form-control" type="password" id="senha" name="senha" <?= $usuarioEditar ? '' : 'required' ?>>
                </div>

                <button class="btn btn-primary" type="submit">Salvar</button>
                <?php if ($usuarioEditar): ?>
                    <a class="btn btn-secondary" href="admin_usuarios.php">Cancelar</a>
                <?php endif; ?>
            </form>
        </div>
    </section>
    <section class="card shadow-lg">
        <div class="card-body">
            <h2>Usuarios cadastrados</h2>
            <div class="table-responsive w-100">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <?php if ($usuario['email'] === 'admin@admin.com') continue; ?>
                            <tr>
                                <td><?= htmlspecialchars($usuario['nome']) ?></td>
                                <td><?= htmlspecialchars($usuario['email']) ?></td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="admin_usuarios.php?editar=<?= htmlspecialchars($usuario['id']) ?>">Editar</a>
                                    <form method="post" class="d-inline">
                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Seguranca::gerarTokenCSRF()) ?>">
                                        <input type="hidden" name="acao" value="excluir">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">
                                        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Excluir este usuario?')">Excluir</button>
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
