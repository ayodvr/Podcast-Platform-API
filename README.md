# 🎙️ Podcast Platform API

A scalable Laravel API backend for a podcast platform. Built with clean architecture, Docker support, Swagger documentation, and best practices.

## 🚀 Tech Stack

-   Laravel 10+
-   PHP 8.x
-   MySQL
-   Docker & Docker Compose
-   Swagger (L5 Swagger)
-   Eloquent API Resources
-   RESTful Architecture

---

## 📦 Getting Started

### Prerequisites

-   Docker
-   Docker Compose

### Setup

```bash
git clone https://github.com/ayodvr/Podcast-Platform-API.git
cd Podcast-Platform-API

cp .env.example .env
docker-compose up -d --build
docker exec -it podcast-app bash
composer install
php artisan key:generate
php artisan migrate --seed
```

# API DOCUMENTATION

# SWAGGER

http://localhost:9000/api/documentation
