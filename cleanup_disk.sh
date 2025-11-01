#!/bin/bash

DEV_PATH="/var/www/wood/data/www/dev.woodstream.online"

echo "=== Проверка свободного места ДО очистки ==="
df -h /var/www/wood/data/www/

echo ""
echo "=== Удаление ТОЛЬКО скопированных из продакшна папок ==="

# Удаляем ТОЛЬКО папки которые создал rsync
if [ -d "$DEV_PATH/public/images/uploads" ]; then
    echo "Удаляем images/uploads (скопировано с продакшна)..."
    sudo rm -rf $DEV_PATH/public/images/uploads
    echo "✅ images/uploads удалена"
fi

if [ -d "$DEV_PATH/public/img/watermarks_pro" ]; then
    echo "Удаляем img/watermarks_pro (скопировано с продакшна)..."
    sudo rm -rf $DEV_PATH/public/img/watermarks_pro
    echo "✅ watermarks_pro удалена"
fi

echo ""
echo "=== Проверка свободного места ПОСЛЕ очистки ==="
df -h /var/www/wood/data/www/

echo ""
echo "=== ГОТОВО! ==="
echo "Скопированные папки удалены."
echo "Изображения отзывов теперь грузятся напрямую с продакшна (https://woodstream.online/)."

