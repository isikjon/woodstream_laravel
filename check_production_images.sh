#!/bin/bash

# Проверка наличия файлов на продакшн сервере

echo "=== Проверка на ПРОДАКШН сервере ==="
echo ""

# Проверяем несколько файлов из новых отзывов на продакшне
echo "Новые отзывы (468-477) на woodstream.online:"
ls -lh /var/www/woodstream.online/public/images/content/uploads/d81af37adefe9d2bc363913afd9204cc.jpg 2>/dev/null && echo "✅ НАЙДЕН" || echo "❌ НЕ НАЙДЕН"
ls -lh /var/www/woodstream.online/public/images/content/uploads/a23c811e7fb7d96d78e0b5823ef2ac7c.jpg 2>/dev/null && echo "✅ НАЙДЕН" || echo "❌ НЕ НАЙДЕН"
ls -lh /var/www/woodstream.online/public/images/content/uploads/35b8a44e93142516dd15f851b19e2ad9.jpg 2>/dev/null && echo "✅ НАЙДЕН" || echo "❌ НЕ НАЙДЕН"

echo ""
echo "Старые отзывы (141-150) на woodstream.online:"
ls -lh /var/www/woodstream.online/public/images/content/uploads/e96748fd789a9a7746ca53635a1e4c60.jpg 2>/dev/null && echo "✅ НАЙДЕН" || echo "❌ НЕ НАЙДЕН"
ls -lh /var/www/woodstream.online/public/images/content/uploads/60bb8ea2e63d164ff4d27685aec46f30.jpg 2>/dev/null && echo "✅ НАЙДЕН" || echo "❌ НЕ НАЙДЕН"

echo ""
echo "=== Проверка альтернативных путей на продакшне ==="
echo ""
echo "Ищем в /var/www/woodstream.online/public/images/:"
find /var/www/woodstream.online/public/images -name "*.jpg" -path "*/uploads/*" 2>/dev/null | head -10

echo ""
echo "Ищем в /var/www/woodstream.online/public/storage/:"
find /var/www/woodstream.online/public/storage -name "*.jpg" 2>/dev/null | head -10

echo ""
echo "=== Общее количество файлов на продакшне ==="
echo "В images/content/uploads/:"
find /var/www/woodstream.online/public/images/content/uploads/ -name "*.jpg" 2>/dev/null | wc -l

echo ""
echo "В images/ (все подпапки):"
find /var/www/woodstream.online/public/images/ -name "*.jpg" 2>/dev/null | wc -l

echo ""
echo "=== Структура папок продакшн ==="
ls -la /var/www/woodstream.online/public/images/ 2>/dev/null | head -20

