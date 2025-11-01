#!/bin/bash

PROD_PATH="/var/www/wood/data/www/woodstream.online/public"

echo "=== Поиск всех изображений товара 25763 (Арт-И24719) ==="
echo ""

echo "1. Проверяем главное изображение:"
MAIN_IMAGE="images/uploads/b8befaae45724e3d482ad478fee5debf.jpg"
if [ -f "$PROD_PATH/$MAIN_IMAGE" ]; then
    echo "✅ Главное фото найдено: $PROD_PATH/$MAIN_IMAGE"
    ls -lh "$PROD_PATH/$MAIN_IMAGE"
else
    echo "❌ Главное фото НЕ найдено: $PROD_PATH/$MAIN_IMAGE"
fi

echo ""
echo "2. Ищем файлы с похожим хешом b8befaae45724e3d482ad478fee5debf:"
find "$PROD_PATH/images/uploads" -type f -name "*b8befaae45724e3d*" 2>/dev/null | while read file; do
    echo "  - $(basename $file) ($(ls -lh "$file" | awk '{print $5}'))"
done

echo ""
echo "3. Ищем все файлы, загруженные 01 ноября 2025:"
find "$PROD_PATH/images/uploads" -type f -newermt "2025-11-01 00:00" ! -newermt "2025-11-01 01:30" 2>/dev/null | while read file; do
    echo "  - $(basename $file) - $(stat -c '%y' "$file" | cut -d'.' -f1)"
done

echo ""
echo "4. Последние 15 загруженных изображений:"
ls -lt "$PROD_PATH/images/uploads"/*.{jpg,jpeg,png,JPG,JPEG,PNG} 2>/dev/null | head -15 | while read line; do
    filename=$(echo "$line" | awk '{print $NF}')
    size=$(echo "$line" | awk '{print $5}')
    date=$(echo "$line" | awk '{print $6, $7, $8}')
    echo "  - $(basename $filename) ($size) - $date"
done

echo ""
echo "5. Информация о товаре в БД:"
mysql -h 85.198.119.37 -u new_woodstre -pyHQhKKgWh8QbRcXk new_woodstre -e "
SELECT 
    id, 
    name, 
    model,
    avatar, 
    images,
    created_at,
    updated_at
FROM products 
WHERE id=25763;
" 2>/dev/null

echo ""
echo "6. Проверяем другие товары с похожими путями:"
mysql -h 85.198.119.37 -u new_woodstre -pyHQhKKgWh8QbRcXk new_woodstre -e "
SELECT 
    id, 
    model,
    avatar,
    LENGTH(images) as images_length
FROM products 
WHERE avatar LIKE '%b8befaae45724e3d%' 
   OR images LIKE '%b8befaae45724e3d%'
ORDER BY id DESC;
" 2>/dev/null

echo ""
echo "7. Статистика путей изображений в БД:"
mysql -h 85.198.119.37 -u new_woodstre -pyHQhKKgWh8QbRcXk new_woodstre -e "
SELECT 
    CASE 
        WHEN avatar LIKE '/images/%' THEN 'Со слэшем: /images/'
        WHEN avatar LIKE 'images/%' THEN 'Без слэша: images/'
        WHEN avatar LIKE '/storage/%' THEN 'Новая админка: /storage/'
        ELSE 'Другое'
    END as path_format,
    COUNT(*) as count
FROM products 
WHERE avatar IS NOT NULL AND avatar != ''
GROUP BY path_format;
" 2>/dev/null

echo ""
echo "=== Проверка завершена ==="

