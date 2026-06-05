<!--AQUI VAI GUIAR O USUÁRIO PARA ALGUMAS DESCRIÇÕES MAIS ESPECÍFICAS SOBRE O LIVRO, COMO A DESCRIÇÃO E O USUÁRIO QUE ADICIONOU O LIVRO POR EXEMPLO.
IMAGINO QUE VAI TER UM BOTÃO PARA VOLTAR PARA A GALERIA DE LIVROS, E TALVEZ UM BOTÃO PARA EDITAR O LIVRO, MAS ESSE BOTÃO SÓ VAI APARECER SE O USUÁRIO ESTIVER LOGADO
E FOR O USUÁRIO QUE ADICIONOU O LIVRO, POR EXEMPLO. -->
<?php require_once __DIR__ . '/../model/Conexao.php'; ?>
<?php require_once __DIR__ . '/../model/Livro.php'; ?>
<?php require_once __DIR__ . '/../model/Usuario.php'; ?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$livroModel = new Livro($pdo);

$livroId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($livroId === 0) {
    header('Location: lista_livros.php');
    exit;
}

$livro = $livroModel->buscarPorId($livroId);

if (!$livro) {
    header('Location: lista_livros.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn.pixabay.com/photo/2016/09/16/09/20/books-1673578_1280.png" type="image/png">
    <link rel="stylesheet" href="../../css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalhe do Livro</title>
</head>
<body>

<?php include 'cabecalho.php'; ?>

<div class="container-fluid" style="margin-top:120px;">
  <div class="row">
    <div class="col-2 coluna_preta d-none d-md-block"></div>

    <div class="col-8 conteudo">
    <div class="text-center mb-4">
        <?php if ($livro): ?>
            <div class="text-center mb-4">
            <img class="text-white w-25 img-thumbnail" src="<?= htmlspecialchars($livro['imagem']) ?>" alt="<?= htmlspecialchars($livro['titulo']) ?>"><br><br>
            </div>

            <div class="text-center mb-4">
            <h1 class="text-white"><?= htmlspecialchars($livro['titulo']) ?></h1>
            <h2 class="text-white"><?= htmlspecialchars($livro['categoria']) ?></h2>
            <h2 class="text-white"><?= htmlspecialchars($livro['autor']) ?></h2>
            <h2 class="text-white">Adicionado por: <?= htmlspecialchars($livro['usuario']) ?></h2>
            <p class="text-white"> <?= htmlspecialchars($livro['descricao']) ?></p>
            </div>

        <?php else: ?>
            <div class="text-center mb-4">
                <h1 class="text-white">Livro não encontrado</h1>
            </div>
        <?php endif; ?>
        <a href="lista_livros.php" class="btn btn-primary btn-lg mb-4">Voltar para a Galeria</a>
    </div>
    </div>

    <div class="col-2 coluna_preta d-none d-md-block"></div>
  </div>
</div>

<?php include 'rodape.php'; ?>

</body>
</html>
