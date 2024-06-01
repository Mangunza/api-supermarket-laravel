## Requisitos

PHP 8.2 ou superior
MYSQL 8 ou superior
composer

## Como rodar o project baixado

Duplicar o arquivo ".env.example" e renomear para ".env".<br>
Alterar no arquivo .env as credenciais do banco de dados<br>

Instalar as dependencias do PHP
...

composer install
...

Gerar a chave do arquivo .env
...

PHP artisan key:generate
...

## Sequencia para criar o projecto

criar o projecto com laravel
...
composer create-project laravel/laravel .
...

Alterar no arquivo .env as credenciais do banco de dados<br>

criar o arquivo de rotas para API
...

php artisan install:api
...
