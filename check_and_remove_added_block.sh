#!/bin/bash

PROD_PATH="/var/www/wood/data/www/woodstream.online"
FILE="$PROD_PATH/resources/views/shop/product.blade.php"
BACKUP="$PROD_PATH/resources/views/shop/product.blade.php.backup_$(date +%Y%m%d_%H%M%S)"

echo "=== Проверка и удаление блока 'Добавлено' ==="
echo ""

echo "1. Сначала покажем текущую структуру с 'Добавлено':"
echo "---"
grep -A 3 -B 3 "Добавлено" "$FILE"
echo "---"
echo ""

read -p "Продолжить удаление? (y/n): " confirm
if [ "$confirm" != "y" ]; then
    echo "Отменено"
    exit 0
fi

echo ""
echo "2. Создаем бэкап файла:"
cp "$FILE" "$BACKUP"
echo "✅ Бэкап создан: $BACKUP"
echo ""

echo "3. Удаляем блок 'Добавлено'..."
echo ""

# Удаляем полный блок с "Добавлено", включая условие @if и закрывающий @endif
# Ищем строку с "Добавлено" и удаляем её вместе с окружающим кодом
sed -i '
    /@if($product->created_at)/,/@endif/ {
        /Добавлено/,/@endif/ {
            /@endif/! d
            /@endif/ d
        }
        /@if($product->created_at)/ d
    }
' "$FILE"

echo "✅ Блок удален"
echo ""

echo "4. Проверяем результат:"
echo "---"
grep -A 3 -B 3 "поступления" "$FILE" || echo "Блок 'Дата поступления' найден"
echo "---"
echo ""

echo "5. Что изменилось:"
diff -u "$BACKUP" "$FILE"
echo ""

echo "=== ГОТОВО! ==="
echo ""
echo "✅ Блок 'Добавлено' удален"
echo "✅ Блок 'Дата поступления' остался"
echo ""
echo "Для отката выполните:"
echo "cp $BACKUP $FILE"
echo ""
echo "Очистите кэш:"
echo "cd $PROD_PATH"
echo "php artisan view:clear"
echo "php artisan cache:clear"

