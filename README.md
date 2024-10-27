# M&M Consulting - recruitment task

## Main tools

1. PHP 8.2
2. Composer
3. SQLite
4. [Fast Route]([https://artlist.dev/](https://github.com/nikic/FastRoute)
5. [Phinx](https://github.com/cakephp/phinx)
6. [CakePHP/Database](https://github.com/cakephp/database)

## Requirements

1. PHP 8.2 (or newer)
2. Composer
3. SQLite extension

## Installation

Run the following commands:

1. Clone repository

```sh
gh repo clone Wojtazzzz/MM-Consulting mm-consulting && cd mm-consulting
```

2. Install dependencies

```sh
composer install
```

3. Run SQL migrations

```sh
php vendor/bin/phinx migrate
```

4. Run seeders

```sh
php vendor/bin/phinx seed:run
```

5. Run app (http://localhost:8000/)

```sh
php -S localhost:8000 ./index.php
```

You can browse following endpoints:
GET /overpayments/{$client_id}
GET /underpayments/{$client_id}
GET /expired/{$client_id}
