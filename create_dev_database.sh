#!/bin/bash

PROD_HOST="85.198.119.37"
PROD_USER="new_woodstre"
PROD_PASS="yHQhKKgWh8QbRcXk"
PROD_DB="new_woodstre"

DEV_DB="dev_woodstream"

echo "=== Создание отдельной БД для dev.woodstream.online ==="
echo ""

echo "1. Создаем новую БД: $DEV_DB"
mysql -h $PROD_HOST -u $PROD_USER -p$PROD_PASS -e "
CREATE DATABASE IF NOT EXISTS $DEV_DB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
SHOW DATABASES LIKE '$DEV_DB';
" 2>/dev/null

echo ""
echo "2. Экспортируем структуру всех таблиц (без данных)"
mysqldump -h $PROD_HOST -u $PROD_USER -p$PROD_PASS \
    --no-data \
    --routines \
    --triggers \
    $PROD_DB > /tmp/dev_structure.sql 2>/dev/null

echo ""
echo "3. Импортируем структуру в новую БД"
mysql -h $PROD_HOST -u $PROD_USER -p$PROD_PASS $DEV_DB < /tmp/dev_structure.sql 2>/dev/null

echo ""
echo "4. Копируем ВСЕ данные КРОМЕ products"
mysql -h $PROD_HOST -u $PROD_USER -p$PROD_PASS -N -e "
SELECT TABLE_NAME 
FROM INFORMATION_SCHEMA.TABLES 
WHERE TABLE_SCHEMA='$PROD_DB' 
AND TABLE_NAME != 'products'
AND TABLE_TYPE='BASE TABLE';
" 2>/dev/null | while read table; do
    echo "   Копируем: $table"
    mysqldump -h $PROD_HOST -u $PROD_USER -p$PROD_PASS \
        --no-create-info \
        --skip-triggers \
        $PROD_DB $table 2>/dev/null | \
    mysql -h $PROD_HOST -u $PROD_USER -p$PROD_PASS $DEV_DB 2>/dev/null
done

echo ""
echo "5. Копируем 10 последних товаров"
mysql -h $PROD_HOST -u $PROD_USER -p$PROD_PASS -e "
INSERT INTO $DEV_DB.products 
SELECT * FROM $PROD_DB.products 
ORDER BY id DESC 
LIMIT 10;
" 2>/dev/null

echo ""
echo "6. Копируем связанные данные товаров (категории, стили, материалы)"

# Получаем ID скопированных товаров
PRODUCT_IDS=$(mysql -h $PROD_HOST -u $PROD_USER -p$PROD_PASS -N -e "
SELECT GROUP_CONCAT(id) FROM $DEV_DB.products;
" 2>/dev/null)

echo "   ID товаров: $PRODUCT_IDS"

# Копируем связи товар-категория
mysql -h $PROD_HOST -u $PROD_USER -p$PROD_PASS -e "
INSERT IGNORE INTO $DEV_DB.product_relations 
SELECT * FROM $PROD_DB.product_relations 
WHERE id_product IN ($PRODUCT_IDS);
" 2>/dev/null

# Копируем связи товар-стиль
mysql -h $PROD_HOST -u $PROD_USER -p$PROD_PASS -e "
INSERT IGNORE INTO $DEV_DB.product_styles 
SELECT * FROM $PROD_DB.product_styles 
WHERE product_id IN ($PRODUCT_IDS);
" 2>/dev/null

# Копируем связи товар-материал
mysql -h $PROD_HOST -u $PROD_USER -p$PROD_PASS -e "
INSERT IGNORE INTO $DEV_DB.product_materials 
SELECT * FROM $PROD_DB.product_materials 
WHERE id_product IN ($PRODUCT_IDS);
" 2>/dev/null

echo ""
echo "7. Проверяем результат"
mysql -h $PROD_HOST -u $PROD_USER -p$PROD_PASS -e "
SELECT 
    '$DEV_DB' as database_name,
    (SELECT COUNT(*) FROM $DEV_DB.products) as products_count,
    (SELECT COUNT(*) FROM $DEV_DB.categories) as categories_count,
    (SELECT COUNT(*) FROM $DEV_DB.blog) as blog_count,
    (SELECT COUNT(*) FROM $DEV_DB.users) as users_count;
" 2>/dev/null

echo ""
echo "8. Показываем скопированные товары"
mysql -h $PROD_HOST -u $PROD_USER -p$PROD_PASS -e "
SELECT id, name, model, price 
FROM $DEV_DB.products 
ORDER BY id DESC;
" 2>/dev/null

echo ""
echo "=== ГОТОВО! ==="
echo ""
echo "Теперь измените .env на dev сервере:"
echo "DB_CONNECTION=mysql"
echo "DB_HOST=$PROD_HOST"
echo "DB_PORT=3306"
echo "DB_DATABASE=$DEV_DB"
echo "DB_USERNAME=$PROD_USER"
echo "DB_PASSWORD=$PROD_PASS"

