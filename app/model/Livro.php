<?php 
class Livro {
    private $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function cadastrar($titulo, $autor, ?int $categoria_id = null, $imagem, $descricao, $id_usuario): void {
        $sql = "INSERT INTO livros (titulo, autor, categoria_id, imagem, descricao, id_usuario) 
                VALUES (:titulo, :autor, :categoria_id, :imagem, :descricao, :id_usuario)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':titulo' => $titulo,
            ':autor' => $autor,
            ':categoria_id' => $categoria_id,
            ':imagem' => $imagem,
            ':descricao' => $descricao,
            ':id_usuario' => $id_usuario
        ]);
    }

    function listar(?int $categoria_id = null, ?int $id_usuario = null): array {
        $sql = "SELECT l.*, c.nome AS categoria, u.nome AS usuario 
                FROM livros l 
                LEFT JOIN categorias c ON l.categoria_id = c.id
                LEFT JOIN usuarios u ON l.id_usuario = u.id";

        $conditions = [];
        $params = [];

        if ($categoria_id !== null) {
            $conditions[] = "l.categoria_id = :categoria_id";
            $params[':categoria_id'] = $categoria_id;
        }

        if ($id_usuario !== null) {
            $conditions[] = "l.id_usuario = :id_usuario";
            $params[':id_usuario'] = $id_usuario;
        }

        if ($conditions) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $sql .= " ORDER BY l.titulo";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    function buscarPorId(int $id): ?array {
        $sql = "SELECT l.*, c.nome AS categoria, u.nome AS usuario
                FROM livros l
                LEFT JOIN categorias c ON l.categoria_id = c.id
                LEFT JOIN usuarios u ON l.id_usuario = u.id
                WHERE l.id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $livro = $stmt->fetch(PDO::FETCH_ASSOC);

        return $livro ?: null;
    }

    function deletar($id): void {
        $sql = "DELETE FROM livros WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
?> 
