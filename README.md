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
git clone <your-repo-url>
cd podcast-api

cp .env.example .env
docker-compose up -d --build
docker exec -it podcast-app bash
composer install
php artisan key:generate
php artisan migrate --seed
```
