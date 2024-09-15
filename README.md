# Festiris Backend Web

# Introduction

"Festiris is a web-based platform that can provide information and specific events, this platform provides information on events, seminars, conferences, and competitions.

## Installation

To set up this project, please ensure that your system meets the following requirements:

- Laravel 10
- PHP 8.2 or higher
- PostgreSQL 15 or higher
- Node 18 or higher
- Composer 2.5 or higher

After ensuring the system requirements are met, follow these steps to set up the project:

1. Run the following commands in your project directory:

    ```bash
    composer install
    ```

2. Copy the `.env.example` file and rename it as `.env`. Make sure to configure the `.env` file with the necessary
   settings.

3. Generate an application key by running the following command:

    ```bash
    php artisan key:generate
    ```

4. Generate an passport key by running the following command:

    ```bash
    php artisan passport:keys
    ```
    
5. Migrate the database tables by running the following command:

    ```bash
    php artisan migrate
    ```

6. Seed the database with initial data by running the following command:

    ```bash
    php artisan db:seed
    ```

7. Install base data for the application:

    ```bash
    php artisan app:install
    ```
