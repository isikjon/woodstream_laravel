#!/bin/bash

DEV_PATH="/var/www/wood/data/www/dev.woodstream.online"

echo "=== Проверка свободного места ДО очистки ==="
df -h /var/www/wood/data/www/

echo ""
echo "=== Удаление скопированных файлов ==="

# Удаляем папки которые создал rsync
if [ -d "$DEV_PATH/public/images/uploads" ]; then
    echo "Удаляем images/uploads..."
    sudo rm -rf $DEV_PATH/public/images/uploads
    echo "✅ images/uploads удалена"
fi

if [ -d "$DEV_PATH/public/img/watermarks_pro" ]; then
    echo "Удаляем watermarks_pro..."
    sudo rm -rf $DEV_PATH/public/img/watermarks_pro
    echo "✅ watermarks_pro удалена"
fi

echo ""
echo "=== Очистка логов Laravel ==="

# Очищаем старые логи
sudo rm -f $DEV_PATH/storage/logs/*.log
sudo rm -f $DEV_PATH/storage/logs/*.log.*
echo "✅ Логи очищены"

echo ""
echo "=== Очистка кэша Laravel ==="

cd $DEV_PATH
sudo -u www-data php artisan cache:clear 2>/dev/null || echo "Cache clear пропущен"
sudo -u www-data php artisan view:clear 2>/dev/null || echo "View clear пропущен"
sudo -u www-data php artisan config:clear 2>/dev/null || echo "Config clear пропущен"

# Очищаем кэш файлы
sudo rm -rf $DEV_PATH/storage/framework/cache/data/*
sudo rm -rf $DEV_PATH/storage/framework/views/*
echo "✅ Кэш очищен"

echo ""
echo "=== Проверка свободного места ПОСЛЕ очистки ==="
df -h /var/www/wood/data/www/

echo ""
echo "=== Топ 10 самых больших папок ==="
sudo du -sh $DEV_PATH/* 2>/dev/null | sort -rh | head -10

echo ""
echo "=== ГОТОВО! ==="
echo "Диск очищен. Теперь изображения будут грузиться с продакшна через модель Review."

