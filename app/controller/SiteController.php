<?php

require_once __DIR__ . '/../core/Rotas.php';

class SiteController {

    public function abrir(string $paginaPadrao = 'home.php'): void {
        $pagina = Rotas::paginaAtual($paginaPadrao);
        $caminho = __DIR__ . '/../view/' . $pagina;

        if (!file_exists($caminho)) {
            $caminho = __DIR__ . '/../view/' . $paginaPadrao;
        }

        require $caminho;
    }
}
