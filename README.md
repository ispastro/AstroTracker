<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## AstroTracker

AstroTracker is a full-stack web application built with Laravel + Inertia.js + Vue 3 that helps users track upcoming celestial events and get notified based on their location and interests.

## Features

- User authentication and preferences management
- Celestial event tracking (meteor showers, eclipses, planet transits, etc.)
- Location-based event visibility
- Event subscription and notification system
- Beautiful, responsive UI with dark mode support
- Admin dashboard for event management

## Installation

1. Clone the repository:
```bash
git clone https://github.com/ispastro/Astrotracker.git
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Copy the environment file and configure it:
```bash
cp .env.example .env
```

4. Generate an application key:
```bash
php artisan key:generate
```

5. Run database migrations and seed:
```bash
php artisan migrate
php artisan db:seed
```

6. Build the assets:
```bash
npm run build
```

7. Start the development server:
```bash
php artisan serve
```

## Usage

1. Visit the application in your browser
2. Register or login to access the dashboard
3. Set your preferences for event types and location
4. Browse upcoming events and subscribe to those you're interested in
5. Receive notifications for upcoming events based on your preferences

## Technologies Used

- Backend: Laravel
- Frontend: Inertia.js + Vue 3
- UI: Tailwind CSS
- Database: PostgreSQL/MySQL
- Authentication: Laravel Breeze
- Notifications: Laravel Notifications
- Scheduling: Laravel Scheduler

## Contributing

Thank you for considering contributing to AstroTracker! Please read our contribution guidelines before getting started.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
