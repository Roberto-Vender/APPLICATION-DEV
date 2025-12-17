#!/bin/bash

# 1. Fix Permissions (Fixes the Monolog error)
echo "🔧 Fixing permissions..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# 2. Clear the "Ghost" Cache (Fixes the root@localhost error)
echo "🧹 Clearing old configuration..."
php artisan config:clear
php artisan cache:clear

# 3. Re-cache for production (Loads your Render dashboard variables)
php artisan config:cache
php artisan route:cache

# 4. Run migrations
echo "🔄 Running migrations..."
php artisan migrate --force

# 5. Start the server
echo "🚀 Starting Supervisor..."
exec "$@"