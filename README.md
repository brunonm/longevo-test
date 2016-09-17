longevo-test
============

O teste foi desenvolvimento utilizando Symfony 3 e PHP7. Usei alguns conceitos de CQRS/Command Bus
para diminuir o acoplamento, facilitar os testes e por fim ter um código fonte mais limpo e claro.

Existem alguns testes unitários dentro do diretório /tests.

Antes de instalar as dependências, é necessário que o composer esteja instalado e que o arquivo
app/config/parameters.yml esteja configurado de acordo com a máquina que for executar a aplicação.

Para instalar o projeto, os seguintes comandos devem ser executados:
 - composer install
 - php bin/console doctrine:database:create
 - php bin/console doctrine:schema:create

Configurei o meu arquivo de hosts para usar "dev.longevo.com.br" como dominio, porém esse endereço
pode ser alterado conforme a necessidade.

Após a instalação, é só executar a aplicação em http://dev.longevo.com.br/sac .

A massa de dados está disponível em /data/dump.sql.
