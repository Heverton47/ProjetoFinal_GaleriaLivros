<?php

class Usuario {

    private $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function cadastrar($nome, $email, $senha): void {

        $senhaHash = password_hash(
            $senha,
            PASSWORD_DEFAULT
        );

        $sql = "INSERT INTO usuarios
                (nome,email,senha)
                VALUES
                (:nome,:email,:senha)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senhaHash
        ]);
    }

    function listar(): array {

        $sql = "SELECT id,nome,email
                FROM usuarios";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarPorId($id): ?array {

        $sql = "SELECT id,nome,email
                FROM usuarios
                WHERE id=:id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        return $usuario ?: null;
    }

    function editar($id, $nome, $email, ?string $senha = null): void {

        $params = [
            ':id' => $id,
            ':nome' => $nome,
            ':email' => $email
        ];

        if ($senha !== null && $senha !== '') {
            $sql = "UPDATE usuarios
                    SET nome=:nome,
                        email=:email,
                        senha=:senha
                    WHERE id=:id";
            $params[':senha'] = password_hash($senha, PASSWORD_DEFAULT);
        } else {
            $sql = "UPDATE usuarios
                    SET nome=:nome,
                        email=:email
                    WHERE id=:id";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
    }

    function deletar($id): void {

        $sql = "DELETE FROM usuarios
                WHERE id=:id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    function login($email, $senha) {

        $sql = "SELECT *
                FROM usuarios
                WHERE email=:email";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);
        $usuario = $stmt->fetch();
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return false;
    }
}
