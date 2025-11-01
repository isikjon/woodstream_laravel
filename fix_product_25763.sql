-- ============================================
-- ИСПРАВЛЕНИЕ ТОВАРА 25763 (Арт-И24719)
-- Витрина в стиле венецианского барокко
-- ============================================
-- ВНИМАНИЕ: Этот скрипт ИЗМЕНИТ данные в БД!
-- Запускать ТОЛЬКО после проверки preview_fix_product_25763.sql
-- ============================================

-- Создаем бэкап перед изменениями
CREATE TABLE IF NOT EXISTS products_backup_25763_20251101 AS 
SELECT * FROM products WHERE id=25763;

-- Показываем что было
SELECT '=== ДО ИЗМЕНЕНИЙ ===' as step;
SELECT id, model, avatar, images FROM products WHERE id=25763;

-- Применяем исправления
UPDATE products 
SET 
    avatar = TRIM(LEADING '/' FROM avatar),
    images = JSON_ARRAY(
        'images/uploads/7aef9e1ac88f592884525d0bd9a93ba4.jpg',
        'images/uploads/74c744b223d9c414bca9550a1d0637a0.jpg',
        'images/uploads/4545f90631658704f180197a5b75191f.jpg',
        'images/uploads/6a4708f7cedba8022087cbfb6e3ca71c.jpg',
        'images/uploads/78a44dc04274fcdc6ccedaf8c21fadff.jpg',
        'images/uploads/d2909c5583d87e5bd03e4e58adbd34c4.jpg'
    ),
    updated_at = NOW()
WHERE id=25763;

-- Показываем что стало
SELECT '=== ПОСЛЕ ИЗМЕНЕНИЙ ===' as step;
SELECT id, model, avatar, images FROM products WHERE id=25763;

-- Проверяем бэкап
SELECT '=== БЭКАП (для отката если что-то пошло не так) ===' as step;
SELECT * FROM products_backup_25763_20251101;

SELECT '=== ГОТОВО! ===' as step;
SELECT 'Для отката выполните: UPDATE products SET avatar=(SELECT avatar FROM products_backup_25763_20251101), images=(SELECT images FROM products_backup_25763_20251101) WHERE id=25763;' as rollback_command;

