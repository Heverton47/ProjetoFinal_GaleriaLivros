<!--ACREDITO QUE A MAIORIA DAS FUNCOES CRUD SEJAM APENAS DISPONÍVEIS PARA O ADMIN-->
<?php 
class Categoria {
    private $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function listarCategoria() {
        $sql = "SELECT * FROM categorias";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function cadastrarCategoria($nome): void {

        $sql = "INSERT INTO categorias(nome)
                VALUES(:nome)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':nome' => $nome
        ]);
    }

    function buscarCategoria($id) {

        $sql = "SELECT *
                FROM categorias
                WHERE id=:id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function editarCategoria($id, $nome): void {

        $sql = "UPDATE categorias
                SET nome=:nome
                WHERE id=:id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([':id' => $id,
            ':nome' => $nome
        ]);
    }

    function deletarCategoria($id): void {

        $sql = "DELETE FROM categorias
                WHERE id=:id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
?>