<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="bg-dark text-white p-3 mb-4 fixed-top">
<div class="container d-flex justify-content-between align-items-center">   
    <div>
        <?php if (isset($_SESSION['usuario'])): ?>
            <a href="cadastro_protegido.php" class="btn btn-primary btn-lg">ADMIN</a>
            <a href="logout.php" class="btn btn-danger btn-lg">LOGOUT</a>
            <a href="../view/home.php" class="btn btn-primary btn-lg text-white">SOBRE NÓS</a>
        <?php else: ?>
            <a href="login.php" class="btn btn-primary btn-lg">LOGIN</a>
            <a href="cadastro_usuario.php" class="btn btn-primary btn-lg">CADASTRO</a>
            <a href="../view/home.php" class="btn btn-primary btn-lg text-white">SOBRE NÓS</a>
        <?php endif; ?>
    </div>    

        <h1>GALERIA DE LIVROS</h1>

    <div>
        <form method="get" class="d-flex">
            <input type="text" name="search" placeholder="Pesquisar...">
            <button type="submit" class="btn btn-secondary">Pesquisar</button>
        </form>
    </div>
</div>    
</header>
