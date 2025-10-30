#!/bin/bash

echo "=== WOODSTREAM DEPLOY & FIX ==="
echo ""

echo "1. Обновление кода из Git..."
git fetch --all
git reset --hard origin/main
echo "✓ Код обновлен"
echo ""

echo "2. Composer autoload rebuild..."
composer dump-autoload
echo "✓ Автозагрузка пересобрана"
echo ""

echo "3. Очистка всех кешей..."
php artisan optimize:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan event:clear
echo "✓ Кеши очищены"
echo ""

echo "4. Filament компоненты..."
php artisan filament:cache-components
echo "✓ Filament готов"
echo ""

echo "5. Проверка структуры..."
ls -la app/Filament/Resources/ModalResource*
echo ""
ls -la app/Filament/Resources/ModalResource/Pages/
echo ""

echo "=== ГОТОВО! Админка должна работать ==="

