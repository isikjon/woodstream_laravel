#!/bin/bash

PROD_PATH="/var/www/wood/data/www/woodstream.online/public"

echo "=== Все фотографии витрины (Арт-И24719) загруженные 01-11-2025 00:06:18 ==="
echo ""

FILES=(
  "7aef9e1ac88f592884525d0bd9a93ba4.jpg"
  "74c744b223d9c414bca9550a1d0637a0.jpg"
  "4545f90631658704f180197a5b75191f.jpg"
  "6a4708f7cedba8022087cbfb6e3ca71c.jpg"
  "b8befaae45724e3d482ad478fee5debf.jpg"
  "78a44dc04274fcdc6ccedaf8c21fadff.jpg"
  "d2909c5583d87e5bd03e4e58adbd34c4.jpg"
)

echo "Проверяем наличие всех 7 файлов:"
for file in "${FILES[@]}"; do
    filepath="$PROD_PATH/images/uploads/$file"
    if [ -f "$filepath" ]; then
        size=$(ls -lh "$filepath" | awk '{print $5}')
        time=$(stat -c '%y' "$filepath" | cut -d'.' -f1)
        echo "✅ $file ($size) - $time"
    else
        echo "❌ $file - НЕ НАЙДЕН!"
    fi
done

echo ""
echo "Открываем фотографии в браузере для проверки:"
echo "Скопируйте эти URL в браузер, чтобы убедиться что это фото витрины:"
echo ""
for file in "${FILES[@]}"; do
    echo "https://woodstream.online/images/uploads/$file"
done

echo ""
echo "=== Текущее состояние в БД ==="
mysql -h 85.198.119.37 -u new_woodstre -pyHQhKKgWh8QbRcXk new_woodstre -e "
SELECT 
    id,
    name,
    model,
    avatar,
    images
FROM products 
WHERE id=25763;
" 2>/dev/null

echo ""
echo "=== Что нужно исправить ==="
echo ""
echo "1. AVATAR: убрать слэш в начале"
echo "   Было:  /images/uploads/b8befaae45724e3d482ad478fee5debf.jpg"
echo "   Будет: images/uploads/b8befaae45724e3d482ad478fee5debf.jpg"
echo ""
echo "2. IMAGES: добавить массив с 6 дополнительными фото"
echo "   Было:  []"
echo "   Будет: [\"images/uploads/7aef9e1ac88f592884525d0bd9a93ba4.jpg\", ...]"
echo ""
echo "=== Проверка завершена ==="

