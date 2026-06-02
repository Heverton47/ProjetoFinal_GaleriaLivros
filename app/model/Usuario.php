Acredito que aqui teria a classe usuário e algumas funções dela que seriam usadas lá no login, como cadastrar um novo
usuário, usar o password_hash para preparar a senha e enviar lá para o banco(provavelmente teriamos que fazer um update nas senhas que já estão lá para usar o hash),
e também uma função para verificar o login, usando o password_verify para comparar a senha digitada com a senha armazenada no banco.

Eu também sei que precisamos adicionar as questões referentes ao SESSION e os COOKIES para manter o usuário logado, 
e isso provavelmente também seria implementado aqui nessa classe.

P.S: Eu pensei em criar a função para os usuários cadastrados de colocar o tema escuro no site, mas por enquanto é só uma ideia.