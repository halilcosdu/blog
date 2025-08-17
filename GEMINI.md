# GEMINI.md

## Project Overview

This is a blog application built with the Laravel framework. It uses Livewire for the frontend components and Filament for the admin panel. The database contains tables for users, posts, and categories. The application is designed to be a modern blog with features like featured posts, latest posts, categories, and top lessons.

## Building and Running

To run this project, you will need to have PHP, Composer, and Node.js installed.

1.  **Install Dependencies:**
    ```bash
    composer install
    npm install
    ```

2.  **Set up Environment:**
    *   Copy the `.env.example` file to `.env`.
    *   Generate an application key: `php artisan key:generate`
    *   Configure your database credentials in the `.env` file.

3.  **Run Migrations and Seeders:**
    ```bash
    php artisan migrate --seed
    ```

4.  **Start the Development Server:**
    ```bash
    npm run dev
    ```
    This will start the Vite development server and the Laravel development server.

5.  **Access the Application:**
    *   The application will be available at `http://localhost:8000`.
    *   The admin panel is available at `http://localhost:8000/hammer`.

## Development Conventions

*   **Code Style:** The project uses Laravel Pint for code styling. You can run `vendor/bin/pint` to format your code.
*   **Testing:** The project uses Pest for testing. You can run `php artisan test` to run the test suite.
*   **Database:** The project uses Laravel's Eloquent ORM. Migrations are used to manage the database schema.
*   **Admin Panel:** The admin panel is built with Filament. Resources are located in `app/Filament/Resources`.
*   **Frontend:** The frontend is built with Livewire components, which are located in `app/Livewire`.
*   **Routes:** Routes are defined in `routes/web.php`.
