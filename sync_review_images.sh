#!/bin/bash

PROD_PATH="/var/www/wood/data/www/woodstream.online"
DEV_PATH="/var/www/wood/data/www/dev.woodstream.online"

echo "=== Шаг 1: Проверка БД ==="
echo ""
echo "Попробуйте выполнить вручную для просмотра путей в БД:"
echo "mysql -u root woodstream_online -e \"SELECT id, image, created_at FROM blog WHERE type='feedback' ORDER BY id DESC LIMIT 10;\""
echo ""

echo "=== Шаг 2: Создание папок на DEV ==="
echo ""

# Создаем папки если их нет
sudo mkdir -p $DEV_PATH/public/images/uploads
sudo mkdir -p $DEV_PATH/public/img/watermarks_pro

echo "✅ Папки созданы"
echo ""

echo "=== Шаг 3: Копирование изображений отзывов ==="
echo ""

# Копируем все изображения из uploads
echo "Копируем images/uploads/..."
sudo rsync -av --progress $PROD_PATH/public/images/uploads/ $DEV_PATH/public/images/uploads/

echo ""
echo "Копируем watermarks (если нужны)..."
sudo rsync -av --progress $PROD_PATH/public/img/watermarks_pro/ $DEV_PATH/public/img/watermarks_pro/ 2>/dev/null || echo "Папка watermarks отсутствует, пропускаем"

echo ""
echo "=== Шаг 4: Установка прав доступа ==="
echo ""

sudo chown -R www-data:www-data $DEV_PATH/public/images/uploads
sudo chmod -R 755 $DEV_PATH/public/images/uploads

sudo chown -R www-data:www-data $DEV_PATH/public/img/watermarks_pro 2>/dev/null || true
sudo chmod -R 755 $DEV_PATH/public/img/watermarks_pro 2>/dev/null || true

echo "✅ Права установлены"
echo ""

echo "=== Шаг 5: Проверка результата ==="
echo ""

echo "Файлов на PROD:"
find $PROD_PATH/public/images/uploads -name "*.jpg" -type f 2>/dev/null | wc -l

echo "Файлов на DEV:"
find $DEV_PATH/public/images/uploads -name "*.jpg" -type f 2>/dev/null | wc -l

echo ""
echo "Проверяем конкретные файлы отзывов:"
for file in d81af37adefe9d2bc363913afd9204cc.jpg a23c811e7fb7d96d78e0b5823ef2ac7c.jpg 35b8a44e93142516dd15f851b19e2ad9.jpg; do
    if [ -f "$DEV_PATH/public/images/uploads/$file" ]; then
        echo "✅ $file - скопирован"
    else
        echo "❌ $file - НЕ найден"
    fi
done

echo ""
echo "=== ГОТОВО! ==="
echo ""
echo "Теперь нужно проверить БД и обновить модель Review если нужно."
echo "Запустите: mysql -u root woodstream_online -e \"SELECT id, image FROM blog WHERE type='feedback' AND id IN (468,469,470);\""

