# Cloud Migration Monitor

Real-time dashboard tracking VM migration status and health metrics from AWS Migration Hub.

## Prerequisites
- PHP 8.2+
- Composer
- AWS Account with Migration Hub permissions

## Installation
1. Navigate to directory:
    cd cloud-migration-monitor
2. Install dependencies:
    composer install
3. Configure Environment:
    cp .env.example .env
    php artisan key:generate
4. Set your AWS Credentials in `.env`:
    AWS_ACCESS_KEY_ID=...
    AWS_SECRET_ACCESS_KEY=...
    AWS_DEFAULT_REGION=...

## Running the app
Start the built-in Laravel server:
    php artisan serve

Access the dashboard at `http://localhost:8000`.

## Project Structure
- `app/Services/AwsMigrationService.php`: Core logic for AWS SDK integration.
- `app/Http/Controllers/DashboardController.php`: Handles view rendering and API data.
- `resources/views/dashboard.blade.php`: Tailwind CSS UI for migration tracking.
