<?php require_once __DIR__ . '/../model/Conexao.php'; ?>
<?php require_once __DIR__ . '/../model/Livro.php'; ?>
<?php require_once __DIR__ . '/../model/Categoria.php'; ?>
<?php require_once __DIR__ . '/../model/Usuario.php'; ?>
<?php require_once __DIR__ . '/../model/filtrar.php'; ?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$livroModel = new Livro($pdo);
$categoriaModel = new Categoria($pdo);
$usuarioModel = new Usuario($pdo);

$categoriaId = pegarFiltroInteiro('categoria_id');
$usuarioId = pegarFiltroInteiro('usuario_id');
$busca = pegarFiltroTexto('search');

$livros = filtrarLivrosParaCards($livroModel->listar($categoriaId, $usuarioId), $busca);

$usuarios = $usuarioModel->listar();
$categorias = $categoriaModel->listarCategoria();
include 'cabecalho.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn.pixabay.com/photo/2016/09/16/09/20/books-1673578_1280.png" type="image/png">
    <link rel="stylesheet" href="../../css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Galeria de Livros</title>
</head>
<body class="lista_livros">

<div class="container-fluid">
<div class="row">

    <div class="col-2 coluna_preta d-none d-md-block"></div>

    <div class="col-8 conteudo">
    <div class="text-center mb-4">
	      <form method="get">
	        <?php if ($usuarioId !== null): ?>
	          <input type="hidden" name="usuario_id" value="<?= htmlspecialchars($usuarioId) ?>">
	        <?php endif; ?>
	        <?php if ($busca !== ''): ?>
	          <input type="hidden" name="search" value="<?= htmlspecialchars($busca) ?>">
	        <?php endif; ?>
	        <label class="text-white"> <strong>FILTRAR POR CATEGORIA:</strong></label>
        <select name="categoria_id" onchange="this.form.submit()">
          <option value="">Todos</option>
          <?php foreach ($categorias as $categoria): ?>
            <option value="<?php echo $categoria['id']; ?>" 
              <?php if ($categoriaId == $categoria['id']) echo 'selected'; ?>>
              <?php echo htmlspecialchars($categoria['nome']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </form>

	      <form method="get">
	        <?php if ($categoriaId !== null): ?>
	          <input type="hidden" name="categoria_id" value="<?= htmlspecialchars($categoriaId) ?>">
	        <?php endif; ?>
	        <?php if ($busca !== ''): ?>
	          <input type="hidden" name="search" value="<?= htmlspecialchars($busca) ?>">
	        <?php endif; ?>
	        <label class="text-white"> <strong>FILTRAR POR USUÁRIO:</strong></label>
        <select name="usuario_id" onchange="this.form.submit()">
          <option value="">Todos</option>
          <?php foreach ($usuarios as $usuario): ?>
            <option value="<?php echo $usuario['id']; ?>" 
              <?php if ($usuarioId == $usuario['id']) echo 'selected'; ?>>
              <?php echo htmlspecialchars($usuario['nome']); ?>
            </option>
          <?php endforeach; ?>
        </select>
	      </form>

        <form method="get" class="mt-3">
          <?php if ($categoriaId !== null): ?>
            <input type="hidden" name="categoria_id" value="<?= htmlspecialchars($categoriaId) ?>">
          <?php endif; ?>
          <?php if ($usuarioId !== null): ?>
            <input type="hidden" name="usuario_id" value="<?= htmlspecialchars($usuarioId) ?>">
          <?php endif; ?>
          <label class="text-white"> <strong>BUSCAR POR TITULO, AUTOR OU USUARIO:</strong></label>
          <input type="text" name="search" value="<?= htmlspecialchars($busca) ?>" placeholder="Pesquisar...">
          <button type="submit" class="btn btn-secondary">Pesquisar</button>
          <?php if ($busca !== '' || $categoriaId !== null || $usuarioId !== null): ?>
            <a href="lista_livros.php" class="btn btn-outline-light">Limpar filtros</a>
          <?php endif; ?>
        </form>

	    </div>

	      <div class="row mt-4">
	        <?php if (!$livros): ?>
	          <div class="col-12">
	            <div class="alert alert-warning">Nenhum livro encontrado para os filtros informados.</div>
	          </div>
	        <?php endif; ?>
	        <?php foreach ($livros as $livro): ?>
          <div class="col-12 col-md-4 mb-4">
            <div class="card h-100">
              <div class="card-body shadow-sm">
                <img src="<?= htmlspecialchars($livro['imagem']) ?>" class="card-img-top">
                <h3><?= htmlspecialchars($livro['titulo']) ?></h3>
                <h4><?= htmlspecialchars($livro['autor']) ?></h4>
                <h4><?= htmlspecialchars($livro['categoria']) ?></h4>
                <a href="detalhe_livro.php?id=<?= htmlspecialchars($livro['id']) ?>" class="btn btn-primary btn-lg">Ver mais</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>  
    </div>

    <div class="col-2 coluna_preta d-none d-md-block"></div>
  </div>
</div>
<?php include 'rodape.php'; ?>
</body>
</html>
