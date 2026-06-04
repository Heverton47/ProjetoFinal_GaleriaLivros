<!--"Acredito que aqui teria a classe usuário e algumas funções dela que seriam usadas lá no login, como cadastrar um novo
usuário, usar o password_hash para preparar a senha e enviar lá para o banco(provavelmente teriamos que fazer um update nas senhas que já estão lá para usar o hash),
e também uma função para verificar o login, usando o password_verify para comparar a senha digitada com a senha armazenada no banco."

"Eu também sei que precisamos adicionar as questões referentes ao SESSION e os COOKIES para manter o usuário logado, 
e isso provavelmente também seria implementado aqui nessa classe."

"P.S: Eu pensei em criar a função para os usuários cadastrados de colocar o tema escuro no site, mas por enquanto é só uma ideia."-->
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
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function editar($id, $nome, $email): void {

        $sql = "UPDATE usuarios
                SET nome=:nome,
                    email=:email
                WHERE id=:id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':email' => $email
        ]);
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
