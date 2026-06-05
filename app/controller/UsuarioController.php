<?php

require_once __DIR__ . '/../model/Conexao.php';
require_once __DIR__ . '/../model/Usuario.php';
require_once __DIR__ . '/../core/Seguranca.php';
require_once __DIR__ . '/../core/Rotas.php';

class UsuarioController {

    private Usuario $usuarioModel;

    public function __construct(PDO $pdo) {
        $this->usuarioModel = new Usuario($pdo);
    }

    public function login(): ?string {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return null;
        }

        if (!Seguranca::validarTokenCSRF($_POST['csrf_token'] ?? null)) {
            return 'Token de seguranca invalido.';
        }

        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if ($email === '' || $senha === '') {
            return 'Preencha email e senha.';
        }

        $usuario = $this->usuarioModel->login($email, $senha);

        if (!$usuario) {
            return 'Email ou senha invalidos.';
        }

        Seguranca::iniciarSessao();
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'email' => $usuario['email']
        ];

        setcookie('ultimo_email', $email, time() + 60 * 60 * 24 * 30, '', '', false, true);
        setcookie('ultimo_acesso', date('Y-m-d H:i:s'), time() + 60 * 60 * 24 * 30, '', '', false, true);

        Rotas::redirecionar('cadastro_protegido.php');
    }

    public function cadastrarPublico(): ?string {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return null;
        }

        if (!Seguranca::validarTokenCSRF($_POST['csrf_token'] ?? null)) {
            return 'Token de seguranca invalido.';
        }

        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if ($nome === '' || $email === '' || $senha === '') {
            return 'Preencha todos os campos.';
        }

        try {
            $this->usuarioModel->cadastrar($nome, $email, $senha);
            Rotas::redirecionar('login.php?cadastro=ok');
        } catch (PDOException $e) {
            return 'Nao foi possivel cadastrar. Verifique se o email ja existe.';
        }
    }

    public function listar(): array {
        return $this->usuarioModel->listar();
    }

    public function buscarPorId(int $id): ?array {
        return $this->usuarioModel->buscarPorId($id);
    }

    public function salvarAdmin(): ?string {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return null;
        }

        if (!Seguranca::validarTokenCSRF($_POST['csrf_token'] ?? null)) {
            return 'Token de seguranca invalido.';
        }

        $acao = $_POST['acao'] ?? '';
        $id = (int)($_POST['id'] ?? 0);
        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        try {
            if ($acao === 'excluir' && $id > 0) {
                $this->usuarioModel->deletar($id);
                Rotas::redirecionar('admin_usuarios.php');
            }

            if ($nome === '' || $email === '') {
                return 'Preencha nome e email.';
            }

            if ($acao === 'editar' && $id > 0) {
                $this->usuarioModel->editar($id, $nome, $email, $senha !== '' ? $senha : null);
                Rotas::redirecionar('admin_usuarios.php');
            }

            if ($acao === 'cadastrar') {
                if ($senha === '') {
                    return 'Preencha a senha.';
                }
                $this->usuarioModel->cadastrar($nome, $email, $senha);
                Rotas::redirecionar('admin_usuarios.php');
            }
        } catch (PDOException $e) {
            return 'Nao foi possivel salvar o usuario.';
        }

        return null;
    }
}
