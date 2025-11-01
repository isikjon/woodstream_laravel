#!/bin/bash

echo "=== Проверка БД: какие пути хранятся в reviews ==="
echo ""

# Подключаемся к БД и смотрим пути
mysql -u woodstream -p'Z5jgRPQl*Ml' woodstream_online <<EOF
SELECT id, image, created_at FROM reviews WHERE id IN (468, 469, 470, 141, 142, 143) ORDER BY id;
EOF

echo ""
echo "=== Поиск ВСЕХ jpg файлов в /var/www/ ==="
echo ""

# Ищем все jpg в продакшн
echo "На продакшне woodstream.online:"
find /var/www/woodstream.online -name "*.jpg" -type f 2>/dev/null | grep -E "(d81af37|a23c811|35b8a44|e96748|60bb8ea)" | head -20

echo ""
echo "На dev сервере:"
find /var/www/dev.woodstream.online -name "*.jpg" -type f 2>/dev/null | grep -E "(d81af37|a23c811|35b8a44|e96748|60bb8ea)" | head -20

echo ""
echo "=== Проверка папок storage ==="
echo ""

echo "Продакшн storage:"
ls -la /var/www/woodstream.online/storage/app/public/ 2>/dev/null | head -20

echo ""
echo "Dev storage:"
ls -la /var/www/dev.woodstream.online/storage/app/public/ 2>/dev/null | head -20

echo ""
echo "=== Поиск по всему /var/www (первые 10 jpg) ==="
find /var/www -name "*.jpg" -type f 2>/dev/null | head -10

echo ""
echo "=== Проверка структуры папок public ==="
echo ""

echo "Продакшн public/images:"
ls -la /var/www/woodstream.online/public/images/ 2>/dev/null

echo ""
echo "Dev public/images:"
ls -la /var/www/dev.woodstream.online/public/images/ 2>/dev/null

echo ""
echo "Продакшн public/storage:"
ls -la /var/www/woodstream.online/public/storage/ 2>/dev/null

echo ""
echo "Dev public/storage:"
ls -la /var/www/dev.woodstream.online/public/storage/ 2>/dev/null

echo ""
echo "=== Проверка img/products ==="
find /var/www/woodstream.online/public/img/products -name "*.jpg" 2>/dev/null | head -20

