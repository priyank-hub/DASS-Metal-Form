## Installation

Clone the repo locally:

```sh
git clone https://github.com/priyank-hub/DASS-Metal-Form DASS-Metal
cd DASS-Metal
```

Install PHP dependencies:

```sh
composer install
```

Install NPM dependencies:

```sh
npm ci
```

Build assets:

```sh
npm run dev
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Setup the Database credentials in the .env file

Run database migrations:

```sh
php artisan migrate
```

```sh
php artisan serve
```