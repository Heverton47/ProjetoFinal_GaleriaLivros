<?php

class Seguranca {

    public static function iniciarSessao(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function gerarTokenCSRF(): string {
        self::iniciarSessao();

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    public static function validarTokenCSRF(?string $token): bool {
        self::iniciarSessao();

        return isset($_SESSION['csrf_token'])
            && is_string($token)
            && hash_equals($_SESSION['csrf_token'], $token);
    }

    public static function exigirLogin(): void {
        self::iniciarSessao();

        if (empty($_SESSION['usuario'])) {
            header('Location: login.php');
            exit;
        }
    }

    public static function usuarioLogado(): ?array {
        self::iniciarSessao();

        return $_SESSION['usuario'] ?? null;
    }
}
