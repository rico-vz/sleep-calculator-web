
# Sleep Calculator Project

Web application for calculating optimal sleep schedule.

## Prerequisites

- [Docker](https://www.docker.com/get-started) and [Docker Compose](https://docs.docker.com/compose/install/)
- [Git](https://git-scm.com/downloads)

## Local Development Setup

### Getting Started

1. Clone the repository:

   ```bash
   git clone https://github.com/rico-vz/sleep-calculator-web.git
   cd sleep-calculator-web
   ```

2. Copy the environment file:

   ```bash
   cp src/.env.example src/.env
   ```

3. Start the Docker environment:

   ```bash
   docker-compose up -d
   ```

4. Install PHP dependencies:

   ```bash
   docker-compose exec app composer install
   ```

5. Generate application key (if not already set):

   ```bash
   docker-compose exec app php artisan key:generate
   ```

6. Install JavaScript dependencies:

   ```bash
   docker-compose exec app npm install
   ```

7. Run Vite development server:

   ```bash
   docker-compose exec app npm run dev
   ```

8. Run database migrations:

   ```bash
   docker-compose exec app php artisan migrate
   ```

9. Access the application at [http://localhost](http://localhost)

### Project Structure

```txt
├── docker/                 # Docker configuration files
│   ├── nginx/              # Nginx configuration
│   └── php/                # PHP configuration and Dockerfile
├── src/                    # Laravel source code
└── docker-compose.yml      # Docker Compose configuration
```

## Docker Environment

The project uses Docker Compose with the following services:

- **app**: PHP application server (PHP 8.4 FPM + Node.js 20.x)
- **nginx**: Web server (Nginx 1.27)
- **mariadb**: Database server (MariaDB 11.4)
- **redis**: Caching server (Redis 7.4)

### Useful Docker Commands

```bash
# Start all containers
docker-compose up -d

# Stop all containers
docker-compose down

# Rebuild containers after Dockerfile changes
docker-compose build

# View logs
docker-compose logs -f

# Execute commands in the app container
docker-compose exec app [command]
```

## Development Workflow

### Running Artisan Commands

```bash
docker-compose exec app php artisan [command]
```

### Front-end Development

```bash
# Build assets for production
docker-compose exec app npm run build
```

### Database Migrations

```bash
# Run migrations
docker-compose exec app php artisan migrate

# Roll back migrations
docker-compose exec app php artisan migrate:rollback

# Create a new migration
docker-compose exec app php artisan make:migration create_table_name
```

## Customization

- Modify PHP configuration in `docker/php/php.ini`
- Adjust Nginx settings in `docker/nginx/default.conf`
- Configure database settings in `src/.env`

## Troubleshooting

- If you encounter connection refused errors to MariaDB, ensure the `DB_HOST` in `src/.env` is set to `mariadb`
- For Redis connection issues, check that `REDIS_HOST` is set to `redis`
- For permission issues with the storage directory, run:

  ```bash
  docker-compose exec app chmod -R 775 storage bootstrap/cache
  ```

## Deployment

### Production Requirements

- Web server with Docker and Docker Compose

### Deployment Steps

1. Clone the repository on your server
2. Create a production `src/.env` file with appropriate settings
3. Build and start the containers:

   ```bash
   docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d --build
   ```

4. Run migrations and optimize:

   ```bash
   docker-compose exec app php artisan migrate --force
   docker-compose exec app php artisan optimize
   docker-compose exec app npm run build
   ```
