#!/bin/bash

echo "==================================="
echo "WoodStream - Server Setup Script"
echo "==================================="
echo ""

cd /var/www/wood/data/www/dev.woodstream.online

echo "1. Pulling latest changes from git..."
sudo git pull origin main

echo ""
echo "2. Setting permissions..."
sudo chown -R www-data:www-data .
sudo chmod -R 755 .
sudo chmod -R 777 storage bootstrap/cache
sudo chmod 666 .env
sudo chmod 666 database/database.sqlite
sudo chmod 777 database

echo ""
echo "3. Installing/updating composer dependencies..."
sudo composer install --no-dev --optimize-autoloader --ignore-platform-reqs

echo ""
echo "4. Running migrations..."
php artisan migrate --force

echo ""
echo "5. Clearing all caches..."
php artisan cache:clear-all

echo ""
echo "6. Caching for production..."
php artisan cache:all

echo ""
echo "==================================="
echo "✓ Setup completed successfully!"
echo "==================================="
echo ""
echo "Next steps:"
echo "1. Check if PHP opcache is enabled"
echo "2. Restart PHP-FPM: sudo service php8.3-fpm restart"
echo "3. Restart Nginx: sudo service nginx restart"
echo "4. Test the site in browser"
echo ""

