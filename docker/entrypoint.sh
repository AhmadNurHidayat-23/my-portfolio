#!/bin/sh
set -e

# Default port to 80 if PORT is not set by environment
PORT="${PORT:-80}"

echo "Starting container on port $PORT..."

# Substitute PORT_PLACEHOLDER with real port in Nginx configuration
sed -i "s/PORT_PLACEHOLDER/${PORT}/g" /etc/nginx/http.d/default.conf

# Ensure storage and bootstrap cache directories exist with appropriate permissions
mkdir -p /app/storage/framework/cache/data \
         /app/storage/framework/sessions \
         /app/storage/framework/views \
         /app/storage/logs \
         /app/bootstrap/cache

chmod -R 777 /app/storage /app/bootstrap/cache

# Cache configuration, routes, and views if APP_KEY is set
if [ -n "$APP_KEY" ]; then
    echo "Warming Laravel caches..."
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
fi

# Start PHP-FPM in background
echo "Starting PHP-FPM..."
php-fpm -D

# Start Nginx in foreground
echo "Starting Nginx..."
exec nginx -g "daemon off;"

