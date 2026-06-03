<!-- ESTA PROVAVELMENTE SERIA A PRÓXIMA PARTE FEITA, COM O NOME E O LOGO, E PROVAVELMENTE UM MENU DE NAVEGAÇÃO PARA AS PÁGINAS PRINCIPAIS, COMO A GALERIA DE LIVROS, 
A PÁGINA DE LOGIN/CADASTRO, HOME E UM FILTRO DE PESQUISA. ESTA É A PARTE QUE VAI PERMITIR UMA MELHOR NAVEGAÇÃO PELO SITE. -->

<header class="bg-dark text-white p-3 mb-4 fixed-top">
<div class="container d-flex justify-content-between align-items-center">   
    <div>
        <?php if (isset($_SESSION['usuario'])): ?>
            <a href="" class="btn btn-primary btn-lg">CADASTRAR</a>
            <a href="" class="btn btn-danger btn-lg">LOGOUT</a>
            <a href="../view/home.php" class="btn btn-primary btn-lg text-white">SOBRE NÓS</a>
        <?php else: ?>
            <a href="login.php" class="btn btn-primary btn-lg">LOGIN</a>
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