#!/bin/sh
set -e

echo "Running database migrations..."
php artisan migrate --force

echo "Seeding database (first time only)..."
php artisan db:seed --force || true

echo "Starting application..."
exec /usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf
