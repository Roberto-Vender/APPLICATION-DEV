#!/bin/bash

# 1. Fix Permissions (Fixes the Monolog/laravel.log error)
echo "🔧 Fixing permissions..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# 2. Clear old cached config (Fixes the root@localhost error)
echo "🧹 Clearing old configuration..."
php artisan config:clear
php artisan cache:clear

# 3. Re-cache for production (Forces Render variables to load)
php artisan config:cache
php artisan route:cache

# 4. Run migrations
echo "🔄 Running migrations..."
php artisan migrate --force

# 5. Start the server
echo "🚀 Starting application..."
exec "$@"