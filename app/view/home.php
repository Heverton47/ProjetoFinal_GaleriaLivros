<!--É UMA PARTE MAIS "CENTRAL" DO SITE, ONDE VAI TER ALGUMAS INFORMAÇÕES SOBRE O PROJETO, COMO ELE FUNCIONA, POR QUE A GALERIA DE LIVRO, ETC...

EU IMAGINO TENDO INFORMAÇÕES SOBRE O PROJETO, 
COMO ELE FUNCIONA E QUEM SÃO OS AUTORES(NÓS).

TAMBÉM VAI PERMITIR NAVEGAÇÃO PARA AS OUTRAS PÁGINAS, TAL QUAL O INDEX VAI FAZER INICIALMENTE E O CABEÇALHO VAI PERMITIR DEPOIS.-->

<?php
include 'cabecalho.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn.pixabay.com/photo/2016/09/16/09/20/books-1673578_1280.png" type="image/png">
    <title>Sobre nós</title>

    <link rel="stylesheet" href="../../css/estilo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="lista_livros">

<div class="container-fluid">
<div class="row">

    <div class="col-2 coluna_preta d-none d-md-block"></div>

    <div class="col-8">

        <div class="card shadow-lg mb-4">
                <h2><strong>Sobre a Galeria de Livros</strong></h2>

                <p>
                A Galeria de Livros é um projeto desenvolvido com o objetivo
                de organizar e apresentar obras literárias favoritas das pessoas de maneira simples,
                intuitiva e agradável.
                </p>

                <p>
                O sistema permite visualizar livros, seus autores,categoria 
                e informações detalhadas a respeito desta publicação, facilitando a 
                descoberta de novas leituras e permitindo a você mesmo adicionar suas 
                obras favoritas em nossa galeria.
                </p>
        </div>

        <img class="img-fluid border-black rounded" src="https://img.magnific.com/fotos-premium/pilhas-de-livros-na-biblioteca-muitos-livros-em-uma-grande-estante-lendo-livros-no-sofa-no-quarto_491499-515.jpg" alt=""><br><br>

        <div class="card shadow-lg mb-4">
            <h2><strong>Como Funciona?</strong></h2>

            <ul class="list-group m-2">
                <li class="list-group-item">
                Visualize todos os livros cadastrados.
                </li>

                <li class="list-group-item">
                Filtre livros por categoria, autor, título ou usuário.
                </li>

                <li class="list-group-item">
                Consulte informações detalhadas de cada livro.
                </li>

                <li class="list-group-item">
                Faça login para acessar recursos adicionais de cadastro e manipulação de seus livros no site.
                </li>
            </ul>
        </div>

        <div class="card shadow-lg mb-4">

                <h2><strong>Por que uma galeria de livros?</strong></h2>

                <p>
                Este site foi desenvolvido com o intuito de permitir que pessoas 
                compartilhem seus livros favoritos de forma simples, agradável e 
                intuitiva.
                </p>

                <p>
                A leitura é uma das principais formas de adquirir conhecimento, 
                desenvolver a criatividade e conhecer diferentes culturas e perspectivas. 
                Pensando nisso, a Galeria de Livros foi criada para funcionar como um espaço 
                colaborativo onde cada usuário pode registrar suas leituras, recomendar obras 
                e descobrir novos títulos através das contribuições de outros leitores.    
                </p>

                <p>
                Dessa forma, a plataforma não apenas organiza livros, mas também promove 
                a interação entre pessoas que compartilham o interesse pela literatura.
                </p>
        </div>

        <img class="img-fluid border-black rounded" src="https://blog.unis.edu.br/hubfs/Imported_Blog_Media/15-livros-incriveis-para-todo-estudante-ler.jpeg" alt=""><br><br>

        <div class="card shadow-lg mb-4">
                <h2><strong>Desenvolvedores</strong></h2>

                <div class="row">

                <div class="col-md-6">
                <div class="card m-2">
                    <div class="card-body m-2">
                        <h4><strong>Heverton Ricardo</strong></h4>

                        <p>
                        Responsável pela estrutura geral do sistema, 
                        desenvolvimento da interface visual, estilização 
                        utilizando Bootstrap e CSS, documentação do projeto, 
                        implementação da Programação Orientada a Objetos (POO), 
                        operações CRUD e modelagem do banco de dados.
                        </p>
                    </div>
                </div>
                </div>

                <div class="col-md-6">
                <div class="card m-2">
                    <div class="card-body m-2">
                        <h4><strong>Caio Lamers</strong></h4>

                        <p>
                        Responsável pelas funcionalidades de autenticação e 
                        segurança, implementação de sessões e cookies, gerenciamento 
                        de usuários, validações do sistema e desenvolvimento de recursos 
                        voltados à manipulação e administração da plataforma.
                        </p>
                    </div>
                </div>
                </div>

                </div>
        </div>

            <h2 class="text-white"><strong>Volte para galeria</strong></h2>

            <a href="lista_livros.php" class="btn btn-success btn-lg m-2">Ver galeria</a>

    </div>

    <div class="col-2 coluna_preta d-none d-md-block"></div>

</div>
</div>

<?php include 'rodape.php'; ?>

</body>
</html>