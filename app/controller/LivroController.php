<?php

require_once __DIR__ . '/../model/Conexao.php';
require_once __DIR__ . '/../model/Livro.php';
require_once __DIR__ . '/../model/Categoria.php';
require_once __DIR__ . '/../core/Seguranca.php';
require_once __DIR__ . '/../core/Rotas.php';

class LivroController {

    private Livro $livroModel;
    private Categoria $categoriaModel;

    public function __construct(PDO $pdo) {
        $this->livroModel = new Livro($pdo);
        $this->categoriaModel = new Categoria($pdo);
    }

    public function listar(?int $categoriaId = null, ?int $usuarioId = null): array {
        return $this->livroModel->listar($categoriaId, $usuarioId);
    }

    public function listarCategorias(): array {
        return $this->categoriaModel->listarCategoria();
    }

    public function buscarPorId(int $id): ?array {
        return $this->livroModel->buscarPorId($id);
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

        if ($acao === 'excluir' && $id > 0) {
            $this->livroModel->deletar($id);
            Rotas::redirecionar('admin_livros.php');
        }

        $titulo = trim($_POST['titulo'] ?? '');
        $autor = trim($_POST['autor'] ?? '');
        $categoriaId = ($_POST['categoria_id'] ?? '') !== '' ? (int)$_POST['categoria_id'] : null;
        $imagem = trim($_POST['imagem'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');
        $usuario = Seguranca::usuarioLogado();
        $usuarioId = (int)($usuario['id'] ?? 0);

        if ($titulo === '' || $autor === '' || $descricao === '' || $usuarioId === 0) {
            return 'Preencha titulo, autor e descricao.';
        }

        if ($acao === 'editar' && $id > 0) {
            $this->livroModel->editar($id, $titulo, $autor, $categoriaId, $imagem, $descricao);
            Rotas::redirecionar('admin_livros.php');
        }

        if ($acao === 'cadastrar') {
            $this->livroModel->cadastrar($titulo, $autor, $categoriaId, $imagem, $descricao, $usuarioId);
            Rotas::redirecionar('admin_livros.php');
        }

        return null;
    }
}
