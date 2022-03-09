
Recruitment Platform
Dependências
docker
docker-compose
make
Instalação
Faça o clone do repositório com git clone git@github.com:vivianequinaia/backend-careers.git.
Copie o arquivo .env.dist para .env cp .env.dist .env.
Utilize o comando docker-compose build para realizar o pull das imagens.
Execute o comando docker network create recruitment-platform-network (utilize o valor variável NETWORK_DEFAULT do seu .env);
Execute seus containers com o comando docker-compose up -d.
Entre no container do php make php e execute o comando composer install.
Ainda dentro do container do passo 6 execute o comando php artisan key:generate para gerar o valor da variável APP_KEY.
execute o comando php artisan migrate para criar as tabelas do banco de dados.
execute o comando php artisan db:seed para criar dados no banco de dados.
Dê permissão para os arquivos da pasta /storage. sudo chmod 777 -R storage/.
Postman
A collection para acessar os endpoints via postman se encontram em:

postman_collection.

Saiba mais sobre o postman em: Postman

Utilize o token gerado no Login nos headers das rotas que não são públicas.

Testes unitários:
Para executar os testes unitários:

make test, fora do container ou, ./vendor/bin/phpunit tests/ após executar make php.

Version
version.

Sobre a arquitetura do código acesse o artigo abaixo
A decoupled PHP architecture inspired by the Clean Architecture.
