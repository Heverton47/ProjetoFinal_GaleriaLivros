<?php

require_once __DIR__ . '/../model/Conexao.php';
require_once __DIR__ . '/../model/Categoria.php';
require_once __DIR__ . '/../core/Seguranca.php';
require_once __DIR__ . '/../core/Rotas.php';

class CategoriaController {

    private Categoria $categoriaModel;

    public function __construct(PDO $pdo) {
        $this->categoriaModel = new Categoria($pdo);
    }

    public function listar(): array {
        return $this->categoriaModel->listarCategoria();
    }

    public function buscarPorId(int $id): ?array {
        $categoria = $this->categoriaModel->buscarCategoria($id);

        return $categoria ?: null;
    }

    public function salvar(): ?string {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return null;
        }

        if (!Seguranca::validarTokenCSRF($_POST['csrf_token'] ?? null)) {
            return 'Token de seguranca invalido.';
        }

        $acao = $_POST['acao'] ?? '';
        $id = (int)($_POST['id'] ?? 0);
        $nome = trim($_POST['nome'] ?? '');

        try {
            if ($acao === 'excluir' && $id > 0) {
                $this->categoriaModel->deletarCategoria($id);
                Rotas::redirecionar('admin_categorias.php');
            }

            if ($nome === '') {
                return 'Preencha o nome da categoria.';
            }

            if ($acao === 'editar' && $id > 0) {
                $this->categoriaModel->editarCategoria($id, $nome);
                Rotas::redirecionar('admin_categorias.php');
            }

            if ($acao === 'cadastrar') {
                $this->categoriaModel->cadastrarCategoria($nome);
                Rotas::redirecionar('admin_categorias.php');
            }
        } catch (PDOException $e) {
            return 'Nao foi possivel salvar a categoria. Verifique se ela esta vinculada a livros.';
        }

        return null;
    }
}
