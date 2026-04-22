# Cloud Migration Monitor
A senior-level real-time dashboard for tracking VM migrations across AWS environments.

## Tech Stack
- **Backend**: PHP 8.2 (Laravel 10+)
- **Frontend**: Tailwind CSS & Alpine.js
- **Cloud**: AWS SDK (Migration Hub, CloudWatch, SNS)

## Local Setup
1. `composer install`
2. `npm install && npm run build`
3. `cp .env.example .env` (Add your AWS Credentials)
4. `php artisan key:generate`
5. `php artisan serve`

## Railway Deployment
1. Push this folder to a GitHub repository.
2. Create a new project on **Railway.app** and connect the repository.
3. Add the following **Variables** in Railway:
   - `APP_KEY`: (Generated via `php artisan key:generate --show`)
   - `AWS_ACCESS_KEY_ID`: Your AWS Key
   - `AWS_SECRET_ACCESS_KEY`: Your AWS Secret
   - `AWS_REGION`: e.g., us-east-1
4. Railway will automatically detect the Nixpacks/Laravel environment and deploy.
