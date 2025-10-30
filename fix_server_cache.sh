#!/bin/bash

echo "=== Очистка всех кешей Laravel ==="

php artisan route:clear
echo "✓ Route cache cleared"

php artisan view:clear
echo "✓ View cache cleared"

php artisan cache:clear
echo "✓ Application cache cleared"

php artisan config:clear
echo "✓ Config cache cleared"

php artisan event:clear
echo "✓ Event cache cleared"

php artisan optimize:clear
echo "✓ Optimize cleared"

php artisan filament:cache-components
echo "✓ Filament components cached"

echo ""
echo "=== Все кеши очищены! ==="

