-- ============================================
-- ПРЕДПРОСМОТР ИСПРАВЛЕНИЙ ДЛЯ ТОВАРА 25763
-- НИЧЕГО НЕ МЕНЯЕТ, ТОЛЬКО ПОКАЗЫВАЕТ ЧТО БУДЕТ
-- ============================================

-- 1. Текущее состояние
SELECT 
    '=== ТЕКУЩЕЕ СОСТОЯНИЕ ===' as info;

SELECT 
    id,
    name,
    model,
    avatar as current_avatar,
    images as current_images,
    updated_at
FROM products 
WHERE id=25763;

-- 2. Что будет после исправления
SELECT 
    '=== ПОСЛЕ ИСПРАВЛЕНИЯ ===' as info;

SELECT 
    id,
    name,
    model,
    TRIM(LEADING '/' FROM avatar) as new_avatar,
    JSON_ARRAY(
        'images/uploads/7aef9e1ac88f592884525d0bd9a93ba4.jpg',
        'images/uploads/74c744b223d9c414bca9550a1d0637a0.jpg',
        'images/uploads/4545f90631658704f180197a5b75191f.jpg',
        'images/uploads/6a4708f7cedba8022087cbfb6e3ca71c.jpg',
        'images/uploads/78a44dc04274fcdc6ccedaf8c21fadff.jpg',
        'images/uploads/d2909c5583d87e5bd03e4e58adbd34c4.jpg'
    ) as new_images
FROM products 
WHERE id=25763;

-- 3. Сравнение путей
SELECT 
    '=== СРАВНЕНИЕ ПУТЕЙ ===' as info;

SELECT 
    'БЫЛО (неправильно)' as status,
    avatar as path
FROM products 
WHERE id=25763
UNION ALL
SELECT 
    'БУДЕТ (правильно)' as status,
    TRIM(LEADING '/' FROM avatar) as path
FROM products 
WHERE id=25763;

-- 4. Проверка формата у других товаров для сравнения
SELECT 
    '=== ПРИМЕРЫ ПРАВИЛЬНЫХ ПУТЕЙ У ДРУГИХ ТОВАРОВ ===' as info;

SELECT 
    id,
    model,
    avatar,
    JSON_LENGTH(images) as images_count
FROM products 
WHERE avatar LIKE 'images/uploads/%'
  AND JSON_LENGTH(images) > 0
ORDER BY id DESC
LIMIT 5;

