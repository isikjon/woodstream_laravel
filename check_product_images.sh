#!/bin/bash

PROD_PATH="/var/www/wood/data/www/woodstream.online"
DEV_PATH="/var/www/wood/data/www/dev.woodstream.online"

echo "=== Проверка путей изображений товаров ==="
echo ""

# Проверяем несколько товаров в БД
echo "Проверяем пути изображений в БД:"
mysql -h 85.198.119.37 -u new_woodstre -pyHQhKKgWh8QbRcXk new_woodstre -e "SELECT id, name, avatar, images FROM products ORDER BY id DESC LIMIT 5;" 2>/dev/null

echo ""
echo "=== Проверка наличия img/products на продакшне ==="
if [ -d "$PROD_PATH/public/img/products" ]; then
    echo "✅ Папка существует"
    echo "Количество файлов:"
    find $PROD_PATH/public/img/products -name "*.jpg" -o -name "*.png" | wc -l
    echo ""
    echo "Первые 10 файлов:"
    find $PROD_PATH/public/img/products \( -name "*.jpg" -o -name "*.png" \) | head -10
else
    echo "❌ Папка НЕ существует!"
fi

echo ""
echo "=== Проверка images/ на продакшне ==="
if [ -d "$PROD_PATH/public/images" ]; then
    echo "✅ Папка существует"
    ls -la $PROD_PATH/public/images/ | head -20
else
    echo "❌ Папка НЕ существует!"
fi

echo ""
echo "=== Что есть на DEV сервере ==="
ls -la $DEV_PATH/public/ | grep -E "img|images"

