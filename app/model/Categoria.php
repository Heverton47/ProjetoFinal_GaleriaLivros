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
}
?>