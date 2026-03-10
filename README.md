# Symfony Test Project

Учебное приложение на базе PHP фреймворка **Symfony 7.4**, развернутое с использованием **Docker**. Проект демонстрирует современные подходы к разработке на Symfony, включая работу с API, JWT-аутентификацию, Doctrine ORM и мониторинг.

## 🚀 Стек технологий

- **PHP 8.4** (FPM)
- **Symfony 7.4**
- **MySQL 8.0** (База данных)
- **Redis** (Кеширование и очереди)
- **Nginx** (Веб-сервер)
- **Docker & Docker Compose** (Инфраструктура)
- **LexikJWTAuthenticationBundle** (Аутентификация через JWT)
- **Doctrine ORM** (Работа с БД)
- **Prometheus & Grafana** (Мониторинг)

## 🛠 Установка и запуск

### 1. Требования
- Docker и Docker Compose
- Git

### 2. Клонирование и настройка
```bash
git clone <repository-url>
cd symfony_test
```

Скопируйте пример файла окружения и настройте его при необходимости:
```bash
cp .env .env.local
```

### 3. Запуск контейнеров
```bash
docker-compose up -d --build
```

### 4. Установка зависимостей и миграции
Зайдите в контейнер PHP:
```bash
docker-compose exec php bash
```
Внутри контейнера:
```bash
composer install
php bin/console doctrine:migrations:migrate --no-interaction
# (Опционально) Загрузка тестовых данных
php bin/console doctrine:fixtures:load --no-interaction
```

## 📖 Структура проекта

- `src/` — Исходный код приложения.
    - `Controller/` — Обработка HTTP-запросов.
    - `Entity/` — Сущности Doctrine (модели данных).
    - `Service/` — Бизнес-логика.
    - `DTO/` — Объекты переноса данных (Data Transfer Objects).
    - `ApiResponseBuilder/` — Логика формирования ответов API.
- `config/` — Конфигурация приложения и пакетов.
- `docker/` — Конфигурационные файлы Docker (Nginx, Prometheus и т.д.).
- `migrations/` — Миграции базы данных.
- `templates/` — Twig шаблоны.
- `tests/` — Тесты PHPUnit.

## 🔌 API Endpoints

### Аутентификация
- `POST /api/auth/register` — Регистрация нового пользователя.
- `POST /api/auth/login` — Получение JWT токена.
- `POST /api/auth/refresh` — Обновление JWT токена.
- `GET /api/auth/me` — Получение данных текущего пользователя (требуется JWT).

### Посты (Posts)
- `GET /api/post` — Список всех постов.
- `GET /api/post/{id}` — Получение конкретного поста.
- `POST /api/post` — Создание поста (требуется JWT).
- `PATCH /api/post/{id}` — Редактирование поста (требуется JWT).
- `DELETE /api/post/{id}` — Удаление поста (требуется JWT).

## 📊 Мониторинг

В проекте настроены инструменты мониторинга (доступны по умолчанию в Docker-окружении):
- **Prometheus**: Сбор метрик приложения.
- **Grafana**: Визуализация метрик.
- **Adminer**: Управление базой данных через веб-интерфейс.

## 📝 Дополнительная информация

- Подробный план разработки доступен в [DEVELOP.md](./DEVELOP.md).
- Описание структуры приложения Symfony в [APP_STRUCTURE.md](./APP_STRUCTURE.md).
