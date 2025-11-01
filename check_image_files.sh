#!/bin/bash

# Проверка существования файлов изображений отзывов

echo "=== Проверка наличия файлов ==="
echo ""

# Проверяем несколько файлов из новых отзывов
echo "Новые отзывы (468-477):"
ls -lh /var/www/dev.woodstream.online/public/images/content/uploads/d81af37adefe9d2bc363913afd9204cc.jpg 2>/dev/null || echo "❌ d81af37adefe9d2bc363913afd9204cc.jpg - НЕ НАЙДЕН"
ls -lh /var/www/dev.woodstream.online/public/images/content/uploads/a23c811e7fb7d96d78e0b5823ef2ac7c.jpg 2>/dev/null || echo "❌ a23c811e7fb7d96d78e0b5823ef2ac7c.jpg - НЕ НАЙДЕН"
ls -lh /var/www/dev.woodstream.online/public/images/content/uploads/35b8a44e93142516dd15f851b19e2ad9.jpg 2>/dev/null || echo "❌ 35b8a44e93142516dd15f851b19e2ad9.jpg - НЕ НАЙДЕН"

echo ""
echo "Старые отзывы (141-150):"
ls -lh /var/www/dev.woodstream.online/public/images/content/uploads/e96748fd789a9a7746ca53635a1e4c60.jpg 2>/dev/null || echo "❌ e96748fd789a9a7746ca53635a1e4c60.jpg - НЕ НАЙДЕН"
ls -lh /var/www/dev.woodstream.online/public/images/content/uploads/60bb8ea2e63d164ff4d27685aec46f30.jpg 2>/dev/null || echo "❌ 60bb8ea2e63d164ff4d27685aec46f30.jpg - НЕ НАЙДЕН"

echo ""
echo "=== Поиск файлов в других папках ==="
echo ""
echo "Ищем d81af37adefe9d2bc363913afd9204cc.jpg:"
find /var/www/dev.woodstream.online/public/images -name "d81af37adefe9d2bc363913afd9204cc.jpg" 2>/dev/null

echo ""
echo "Ищем a23c811e7fb7d96d78e0b5823ef2ac7c.jpg:"
find /var/www/dev.woodstream.online/public/images -name "a23c811e7fb7d96d78e0b5823ef2ac7c.jpg" 2>/dev/null

echo ""
echo "=== Проверка структуры папок ==="
ls -la /var/www/dev.woodstream.online/public/images/content/ 2>/dev/null | head -20

echo ""
echo "=== Общее количество файлов ==="
echo "В /var/www/dev.woodstream.online/public/images/content/:"
find /var/www/dev.woodstream.online/public/images/content/ -name "*.jpg" 2>/dev/null | wc -l

