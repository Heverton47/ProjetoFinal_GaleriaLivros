<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn.pixabay.com/photo/2016/09/16/09/20/books-1673578_1280.png" type="image/png">
    <link rel="stylesheet" href="css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Galeria de Livros</title>
</head>
<body>

<div class="container-fluid">
    <div class="row">

    <div class="col-2 coluna_preta d-none d-md-block"></div>

    <div class="col-8 conteudo_index">
        
    <h1 class="text-white">Galeria de Livros</h1><br>
    <h4 class="text-white">Bem-vindo à nossa pequena galeria de livros!</h4><br>
    <a href="app/view/home.php" class="btn btn-primary btn-lg text-white">Sobre nós</a><br><br>
    <a href="app/view/lista_livros.php" class="btn btn-primary btn-lg text-white">Ver livros</a><br><br>   
    <a href="app/view/login.php" class="btn btn-primary btn-lg text-white">Login/Cadastro</a><br><br>
        <?php if (isset($_SESSION['usuario'])): ?>
            <a href="" class="btn btn-primary btn-lg text-white">CADASTRAR</a><br><br>
            <a href="" class="btn btn-danger btn-lg text-white">LOGOUT</a>
        <?php endif; ?>
    </div>

    <div class="col-2 coluna_preta d-none d-md-block"></div>
    </div>
</div>

</body>
</html>