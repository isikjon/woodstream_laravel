#!/bin/bash

PROD_PATH="/var/www/wood/data/www/woodstream.online"
FILE="$PROD_PATH/resources/views/shop/product.blade.php"
BACKUP="$PROD_PATH/resources/views/shop/product.blade.php.backup_$(date +%Y%m%d_%H%M%S)"

echo "=== Добавление даты поступления на старый сайт ==="
echo ""

echo "1. Создаем бэкап файла:"
cp "$FILE" "$BACKUP"
echo "✅ Бэкап создан: $BACKUP"
echo ""

echo "2. Добавляем блок 'Дата поступления' после 'Добавлено'"
echo ""

cat > /tmp/arrival_date_block.txt << 'EOF'

                                                        @if($product->arrived_at)
                                                                <div class="row">
                                                                        <div class="name">Дата поступления:</div>
                                                                        <div class="value">{{$product->arrived_at->format('d.m.Y')}}</div>
                                                                </div>
                                                        @endif
EOF

sed -i '/Добавлено:<\/div>/,/@endif/{ 
    /@endif/a\

                                                        @if($product->arrived_at)\
                                                                <div class="row">\
                                                                        <div class="name">Дата поступления:</div>\
                                                                        <div class="value">{{$product->arrived_at->format('\''d.m.Y'\'')}}</div>\
                                                                </div>\
                                                        @endif
}' "$FILE"

echo "✅ Код добавлен"
echo ""

echo "3. Проверяем что изменилось:"
diff -u "$BACKUP" "$FILE" | head -30
echo ""

echo "=== ГОТОВО! ==="
echo ""
echo "Для отката выполните:"
echo "cp $BACKUP $FILE"
echo ""
echo "Проверьте на сайте любой товар с датой поступления"

