# ProjetoFinal_GaleriaLivros

## Tema

Galeria de Livros.

## Descricao

Sistema web em PHP para visualizar uma galeria de livros, consultar detalhes e permitir que usuarios logados cadastrem, editem e excluam livros, categorias e usuarios.

## Integrantes

- Heverton Ricardo
- Caio Lamers

## Tecnologias e conteudos usados

- PHP
- MySQL
- PDO com prepared statements
- Programacao Orientada a Objetos
- MVC simples
- Sessoes
- Cookies
- CSRF
- HTML, CSS e Bootstrap

## Como rodar

1. Copie o projeto para a pasta do servidor local, por exemplo `htdocs` no XAMPP.
2. Inicie Apache e MySQL.
3. Crie/importe o banco usando o arquivo `sql/galeria.sql` pelo phpMyAdmin.
4. Verifique os dados de conexao em `app/model/Conexao.php`.
5. Acesse `http://localhost/ProjetoFinal_GaleriaLivros/index.php`.

## Como importar o banco

No phpMyAdmin:

1. Acesse a aba Importar.
2. Selecione o arquivo `sql/galeria.sql`.
3. Execute a importacao.

O script cria o banco `galeria_livros` e insere usuarios, categorias e livros de teste.

## Credenciais de teste

- Email: `admin@admin.com`
- Senha: `123456`

## Principais funcionalidades

- Paginas publicas: pagina inicial, sobre, lista de livros e detalhes do livro.
- Cadastro de usuario.
- Login e logout com sessao.
- Cookie de ultimo email e ultimo acesso.
- CRUD de livros.
- CRUD de categorias.
- CRUD de usuarios.
- Formularios sensiveis com token CSRF.

## Observacoes

Este projeto usa uma estrutura MVC simples, mantendo models, controllers e views separados sem framework externo.
