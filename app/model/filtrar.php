<?php

function pegarFiltroTexto(string $campo): string {
    return trim($_GET[$campo] ?? '');
}

function pegarFiltroInteiro(string $campo): ?int {
    if (!isset($_GET[$campo]) || $_GET[$campo] === '') {
        return null;
    }

    return (int)$_GET[$campo];
}

function filtrarLivrosParaCards(array $livros, string $busca): array {
    $busca = mb_strtolower(trim($busca));

    if ($busca === '') {
        return $livros;
    }

    return array_values(array_filter($livros, function (array $livro) use ($busca): bool {
        $titulo = mb_strtolower($livro['titulo'] ?? '');
        $autor = mb_strtolower($livro['autor'] ?? '');
        $usuario = mb_strtolower($livro['usuario'] ?? '');

        return str_contains($titulo, $busca)
            || str_contains($autor, $busca)
            || str_contains($usuario, $busca);
    }));
}
