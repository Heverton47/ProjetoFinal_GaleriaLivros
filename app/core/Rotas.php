<?php

class Rotas {

    public static function redirecionar(string $pagina): void {
        header('Location: ' . $pagina);
        exit;
    }

    public static function paginaAtual(string $padrao = 'home.php'): string {
        $pagina = $_GET['pagina'] ?? $padrao;
        $pagina = basename($pagina);

        return $pagina ?: $padrao;
    }
}
