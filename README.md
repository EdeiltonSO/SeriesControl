<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## O que é isso?

Uma aplicação feita com Laravel durante as aulas do curso de Laravel da Alura. Ela fornece uma página onde o usuário pode visualizar séries assistidas e também um formulário pra incluir outras. Utiliza PHP 8, Laravel 8, Blade e SQLite.

## Como executar na minha máquina?

Se sua máquina estiver rodando Ubuntu ou algo parecido, a sequência é essa:

1. Faça o `git clone` do repositório;
2. Entre na pasta criada usando `cd SeriesControl`;
3. Caso não tenha, instale o [PHP 8](https://www.php.net/downloads) e o [Composer](https://getcomposer.org/);
4. Execute `composer install`;
5. Execute `cp .env.example .env`;
6. No arquivo .env criado:

    6.1. Substitua `DB_CONNECTION=mysql` por `DB_CONNECTION=sqlite`;
    
    6.2. Comente (usando #) ou apague as 5 linhas seguintes;
7. Execute `php artisan key:g`;
8. Execute `sudo apt-get install php-sqlite3`;
9. Crie o arquivo `database.sqlite` na pasta `database`;
10. Execute `php artisan migrate`;
11. Execute `php artisan serve`;
12. Acesse `localhost:8000/series` (ou outra porta disponibilizada pelo Artisan);
