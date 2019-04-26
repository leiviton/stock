
# ApiStock

Api Rest desenvolvida em laravel

# Ambiente

- Mysql 5.7
- PHP 7.2
- Composer

# Como implantar

- Ao clonar o projeto acesse a pasta e execute o comando composer install
- Ao finalizar a instalação execute cp .env.example .env
- Abra o .env coloque as informações do banco de dados
- Execute o comando php artisan key:generate
- Execute o comando php artisan migrate --seed
- Execute o comando php artisan passport:install, esse comando irá gerar os dados do cliente rest, salve essas informaçoes para conectar.

# Executar o server

- Execute na raiz do projeto o comando php artisan serve, caso queira liberar pelo ip na rede execute o comando php artisan serve --host=ipdamaquina
