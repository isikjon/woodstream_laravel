#!/bin/bash

PROD_PATH="/var/www/wood/data/www/woodstream.online"
FILE="$PROD_PATH/resources/views/shop/product.blade.php"
BACKUP="$PROD_PATH/resources/views/shop/product.blade.php.backup_$(date +%Y%m%d_%H%M%S)"

echo "=== Удаление блока 'Добавлено' на старом сайте ==="
echo ""

echo "1. Создаем бэкап файла:"
cp "$FILE" "$BACKUP"
echo "✅ Бэкап создан: $BACKUP"
echo ""

echo "2. Удаляем блок 'Добавлено'"
echo ""

# Удаляем блок с "Добавлено" (вместе с @if и @endif)
sed -i '/@if($product->created_at)/,/@endif/{
    /Добавлено:/d
    /<div class="name">Добавлено:<\/div>/d
    /<div class="value">{{$product->created_at->format/d
    /@if($product->created_at)/d
    /@endif/d
}' "$FILE"

# Альтернативный вариант - удаляем все строки, содержащие "Добавлено"
sed -i '/Добавлено:/d' "$FILE"
sed -i '/created_at->format/d' "$FILE"

echo "✅ Блок 'Добавлено' удален"
echo ""

echo "3. Проверяем что изменилось:"
echo ""
diff -u "$BACKUP" "$FILE" | head -40
echo ""

echo "=== ГОТОВО! ==="
echo ""
echo "Блок 'Добавлено' удален, блок 'Дата поступления' остался"
echo ""
echo "Для отката выполните:"
echo "cp $BACKUP $FILE"
echo ""
echo "Не забудьте очистить кэш:"
echo "php artisan view:clear"
echo "php artisan cache:clear"

