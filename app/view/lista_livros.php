<?php require_once __DIR__ . '/../model/conexao.php'; ?>
<?php require_once __DIR__ . '/../model/Livro.php'; ?>
<?php require_once __DIR__ . '/../model/Categoria.php'; ?>
<?php
// Instanciar classes
$livroModel = new Livro($pdo);
$categoriaModel = new Categoria($pdo);

// Pegar categoria selecionada (se houver)
$categoriaId = isset($_GET['categoria_id']) && $_GET['categoria_id'] !== '' ? (int)$_GET['categoria_id'] : null;

// Listar livros (com ou sem filtro)
$livros = $livroModel->listar($categoriaId);

// Listar categorias
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
    </div>

      <div class="row mt-4">
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