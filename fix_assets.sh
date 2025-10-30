#!/bin/bash

echo "=== Fixing Woodstream Assets ==="

cd ~/www/dev.woodstream.online

echo "1. Git pull..."
sudo git pull origin main

echo "2. Clear all caches..."
php artisan optimize:clear
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear

echo "3. Rebuild Filament assets..."
php artisan filament:assets

echo "4. Optimize..."
php artisan config:cache
php artisan route:cache

echo "5. Fix permissions..."
sudo chown -R wood:www-data storage/
sudo chmod -R 775 storage/
sudo chown -R wood:www-data public/storage
sudo chmod -R 775 public/storage

echo "=== Done! ==="

