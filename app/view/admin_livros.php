<?php
require_once __DIR__ . '/../controller/LivroController.php';

Seguranca::exigirLogin();

$controller = new LivroController($pdo);
$erro = $controller->salvar();
$livroEditar = null;

if (isset($_GET['editar'])) {
    $livroEditar = $controller->buscarPorId((int)$_GET['editar']);
}

$categorias = $controller->listarCategorias();
$livros = $controller->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn.pixabay.com/photo/2016/09/16/09/20/books-1673578_1280.png" type="image/png">
    <link rel="stylesheet" href="../../css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gerenciar Livros</title>
</head>
<body class="lista_livros">

<?php include 'cabecalho.php'; ?>

<main class="container-fluid">
    <section class="row">
        <div class="col-12 col-lg-10">
            <div class="card shadow-lg mb-4">
                <div class="card-body">
                    <h2><?= $livroEditar ? 'Editar livro' : 'Cadastrar livro' ?></h2>

                    <?php if ($erro): ?>
                        <div class="alert alert-danger w-100"><?= htmlspecialchars($erro) ?></div>
                    <?php endif; ?>

                    <form method="post" class="w-100 text-start">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Seguranca::gerarTokenCSRF()) ?>">
                        <input type="hidden" name="acao" value="<?= $livroEditar ? 'editar' : 'cadastrar' ?>">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($livroEditar['id'] ?? '') ?>">

                        <div class="mb-3">
                            <label class="form-label" for="titulo">Titulo</label>
                            <input class="form-control" id="titulo" name="titulo" value="<?= htmlspecialchars($livroEditar['titulo'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="autor">Autor</label>
                            <input class="form-control" id="autor" name="autor" value="<?= htmlspecialchars($livroEditar['autor'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="categoria_id">Categoria</label>
                            <select class="form-select" id="categoria_id" name="categoria_id">
                                <option value="">Sem categoria</option>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?= htmlspecialchars($categoria['id']) ?>" <?= isset($livroEditar['categoria_id']) && (int)$livroEditar['categoria_id'] === (int)$categoria['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($categoria['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="imagem">URL da imagem</label>
                            <input class="form-control" id="imagem" name="imagem" value="<?= htmlspecialchars($livroEditar['imagem'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="descricao">Descricao</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="4" required><?= htmlspecialchars($livroEditar['descricao'] ?? '') ?></textarea>
                        </div>

                        <button class="btn btn-primary" type="submit">Salvar</button>
                        <?php if ($livroEditar): ?>
                            <a class="btn btn-secondary" href="admin_livros.php">Cancelar</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            
                    <?php $adm_verify = $_SESSION['usuario']['id'];
                    if ((int)$adm_verify === 1){ ?>

            <div class="card shadow-lg">
                <div class="card-body">
                    <h2>Livros cadastrados</h2>

                    <div class="table-responsive w-100">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Autor</th>
                                    <th>Categoria</th>
                                    <th>Usuario</th>
                                    <th>Acoes</th>
                                </tr>
                            </thead>
                            <tbody>
                                   <?php  foreach ($livros as $livro): ?>
                                     
                                    <tr>
                                        <td><?= htmlspecialchars($livro['titulo']) ?></td>
                                        <td><?= htmlspecialchars($livro['autor']) ?></td>
                                        <td><?= htmlspecialchars($livro['categoria'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($livro['usuario'] ?? '') ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="admin_livros.php?editar=<?= htmlspecialchars($livro['id']) ?>">Editar</a>
                                            <form method="post" class="d-inline">
                                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Seguranca::gerarTokenCSRF()) ?>">
                                                <input type="hidden" name="acao" value="excluir">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars($livro['id']) ?>">
                                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Excluir este livro?')">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; } //fechamento foreach e chaves?> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          
        </div>
    </section>
</main>

<?php include 'rodape.php'; ?>

</body>
</html>
