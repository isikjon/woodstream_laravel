#!/bin/bash

echo "=== Проверка РЕАЛЬНЫХ путей ==="
echo ""

# Правильные пути
DEV_PATH="/var/www/wood/data/www/dev.woodstream.online"
PROD_PATH="/var/www/wood/data/www/woodstream.online"

echo "Dev: $DEV_PATH"
echo "Prod: $PROD_PATH"
echo ""

echo "=== Проверка БД: какие пути хранятся в reviews ==="
echo ""

# Пробуем разные подключения к БД
mysql -u root woodstream_online -e "SELECT id, image, created_at FROM blog WHERE type='feedback' AND id IN (468, 469, 470, 141, 142, 143) ORDER BY id;" 2>/dev/null || \
mysql -u woodstream woodstream_online -e "SELECT id, image, created_at FROM blog WHERE type='feedback' AND id IN (468, 469, 470, 141, 142, 143) ORDER BY id;" 2>/dev/null || \
mysql woodstream_online -e "SELECT id, image, created_at FROM blog WHERE type='feedback' AND id IN (468, 469, 470, 141, 142, 143) ORDER BY id;" 2>/dev/null || \
echo "Не удалось подключиться к БД. Попробуйте вручную: mysql woodstream_online -e 'SELECT id, image FROM blog WHERE id IN (468,469,470) LIMIT 5;'"

echo ""
echo "=== Поиск изображений отзывов на ПРОДАКШН ==="
echo ""

# Ищем конкретные файлы на продакшне
echo "Ищем d81af37adefe9d2bc363913afd9204cc.jpg:"
find $PROD_PATH -name "d81af37adefe9d2bc363913afd9204cc.jpg" -type f 2>/dev/null

echo ""
echo "Ищем a23c811e7fb7d96d78e0b5823ef2ac7c.jpg:"
find $PROD_PATH -name "a23c811e7fb7d96d78e0b5823ef2ac7c.jpg" -type f 2>/dev/null

echo ""
echo "Ищем 35b8a44e93142516dd15f851b19e2ad9.jpg:"
find $PROD_PATH -name "35b8a44e93142516dd15f851b19e2ad9.jpg" -type f 2>/dev/null

echo ""
echo "Ищем e96748fd789a9a7746ca53635a1e4c60.jpg:"
find $PROD_PATH -name "e96748fd789a9a7746ca53635a1e4c60.jpg" -type f 2>/dev/null

echo ""
echo "Ищем 60bb8ea2e63d164ff4d27685aec46f30.jpg:"
find $PROD_PATH -name "60bb8ea2e63d164ff4d27685aec46f30.jpg" -type f 2>/dev/null

echo ""
echo "=== Все JPG файлы в images/content на ПРОДАКШН ==="
find $PROD_PATH/public/images/content -name "*.jpg" -type f 2>/dev/null | head -20

echo ""
echo "=== Количество JPG в images/content ==="
echo "Продакшн:"
find $PROD_PATH/public/images/content -name "*.jpg" -type f 2>/dev/null | wc -l

echo ""
echo "Dev:"
find $DEV_PATH/public/images/content -name "*.jpg" -type f 2>/dev/null | wc -l

echo ""
echo "=== Структура папок images/content на ПРОДАКШН ==="
ls -la $PROD_PATH/public/images/content/ 2>/dev/null

echo ""
echo "=== Поиск в uploads подпапке ==="
find $PROD_PATH/public/images/content/uploads -name "*.jpg" 2>/dev/null | head -20
find $PROD_PATH/public/images/uploads -name "*.jpg" 2>/dev/null | head -20
find $PROD_PATH/public/uploads -name "*.jpg" 2>/dev/null | head -20

echo ""
echo "=== Поиск в storage ==="
find $PROD_PATH/storage/app/public -name "*.jpg" 2>/dev/null | head -20
find $PROD_PATH/public/storage -name "*.jpg" 2>/dev/null | head -20

echo ""
echo "=== Все JPG на продакшне (первые 50) ==="
find $PROD_PATH/public -name "*.jpg" -type f 2>/dev/null | head -50

