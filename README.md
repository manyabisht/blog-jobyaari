# JobYaari Blog Management System

A complete Laravel 12 Blog Management System built for the JobYaari PHP / Laravel Developer Internship Assessment. The application includes a responsive public blog, live AJAX search and filters, admin authentication, dashboard statistics, blog CRUD, category CRUD, image uploads, validation, seed data, tests, and Docker/Render deployment support.

## Features

- Public blog listing with featured image, title, category badge, short description, publish date, pagination, and read-more links.
- Blog detail page with full content, featured image, category, published date, and related posts.
- Live AJAX search by title and content.
- AJAX category and publish-date filters that work together without page reloads.
- Debounced search input and loading spinner.
- Admin login using Laravel session authentication.
- Admin dashboard with total blogs, published blogs, drafts, categories, and recent posts.
- Blog CRUD with slug URLs, validation, featured image upload, image preview, status, and publish date.
- Category CRUD with unique slugs and delete protection when blogs exist.
- Laravel Storage based upload handling.
- Custom 404 page.
- MySQL-ready migrations and sample seeders.
- Feature tests for public listing, AJAX filters, admin login, and image upload.
- Dockerfile and Render blueprint for deployment.

## Technology Stack

- PHP 8.3+
- Laravel 12
- MySQL
- Blade templates
- Bootstrap 5
- jQuery + AJAX
- Laravel Storage
- PHPUnit
- Docker for Render deployment

## Local Installation

1. Clone the repository and enter the project directory.

```bash
git clone <your-repository-url>
cd <project-directory>
```

2. Install PHP dependencies.

```bash
composer install
```

3. Create the environment file and app key.

```bash
cp .env.example .env
php artisan key:generate
```

4. Configure MySQL in `.env`.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jobyaari_blog
DB_USERNAME=root
DB_PASSWORD=
FILESYSTEM_DISK=public
```

5. Create the MySQL database.

```sql
CREATE DATABASE jobyaari_blog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

6. Run migrations and seeders.

```bash
php artisan migrate --seed
```

7. Create the public storage symlink.

```bash
php artisan storage:link
```

8. Start the Laravel development server.

```bash
php artisan serve
```

Open `http://localhost:8000`.

## Admin Credentials

The seeder creates one admin user:

```text
Email: admin@jobyaari.test
Password: password
```

Admin login URL:

```text
http://localhost:8000/admin/login
```

## Useful Commands

Run the full test suite:

```bash
php artisan test
```

Reset and reseed the database:

```bash
php artisan migrate:fresh --seed
```

Clear application caches:

```bash
php artisan optimize:clear
```

## Folder Structure

```text
app/
  Http/Controllers/
    Admin/                 Admin auth, dashboard, blog CRUD, category CRUD
    BlogController.php     Public listing, detail, AJAX endpoints
  Http/Requests/Admin/     Form request validation
  Models/                  Blog, Category, User
  Services/                BlogFilterService query logic
database/
  migrations/              Users, sessions, cache, jobs, categories, blogs
  seeders/                 Admin user, sample categories, sample blogs
public/
  css/site.css             Custom responsive styling
  js/blog-filters.js       jQuery AJAX filtering
  js/admin.js              Slug generation and image preview
resources/views/
  admin/                   Admin panel Blade views
  blogs/                   Public blog views and AJAX partials
  errors/404.blade.php     Custom 404 page
routes/web.php             Public, AJAX, auth, and admin routes
tests/Feature/             Public, AJAX, auth, and CRUD tests
Dockerfile                 PHP 8.3 Apache production image
render.yaml                Render deployment blueprint
```

## AJAX Endpoints

All AJAX endpoints accept `search`, `category`, `date`, and `page` query parameters. They return JSON with rendered blog cards, result count, and result summary.

```text
GET /ajax/blogs/search
GET /ajax/blogs/category
GET /ajax/blogs/date
```

The frontend uses `public/js/blog-filters.js` to debounce search, update filters, intercept pagination clicks, show the spinner, and replace blog cards without reloading.

## Render Deployment Guide

Render currently recommends Docker for Laravel/PHP apps. This project includes a production Dockerfile, Apache config, start script, and `render.yaml` blueprint. Official references:

- [Render Laravel Docker guide](https://render.com/docs/deploy-php-laravel-docker)
- [Render Docker docs](https://render.com/docs/docker)
- [Render web services docs](https://render.com/docs/web-services)

### Render Setup

1. Push this project to GitHub.
2. Create a MySQL database with any MySQL-compatible provider.
3. In Render, create a new **Web Service** from the GitHub repository.
4. Choose **Docker** as the runtime. Render will use the included `Dockerfile`.
5. Set these environment variables in Render:

```env
APP_NAME=JobYaari Blog
APP_ENV=production
APP_DEBUG=false
APP_KEY=<generate locally with: php artisan key:generate --show>
APP_URL=https://your-render-service.onrender.com
LOG_CHANNEL=stderr
DB_CONNECTION=mysql
DB_HOST=<your-mysql-host>
DB_PORT=3306
DB_DATABASE=<your-mysql-database>
DB_USERNAME=<your-mysql-username>
DB_PASSWORD=<your-mysql-password>
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=public
RUN_MIGRATIONS=true
RUN_SEEDERS=true
```

6. Deploy the service.
7. After the first successful deploy, change `RUN_SEEDERS` to `false` unless you want the sample data refreshed on every deploy.

The container start script runs:

```bash
php artisan storage:link --force
php artisan migrate --force
php artisan db:seed --force   # only when RUN_SEEDERS=true
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Storage on Render

Uploaded images are stored on Laravel's `public` disk under `storage/app/public`. For long-lived production uploads on Render, attach a persistent disk and mount it at:

```text
/var/www/html/storage/app/public
```

Then redeploy and keep `FILESYSTEM_DISK=public`.

## Production Notes

- Change the seeded admin password immediately after deployment.
- Keep `APP_DEBUG=false` in production.
- Use a strong generated `APP_KEY`.
- Use a persistent disk or object storage for uploaded images on production.
- Run `php artisan migrate --force` during deployment whenever migrations change.
