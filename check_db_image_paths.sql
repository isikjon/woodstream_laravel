-- Проверка путей изображений в БД для отзывов

-- Последние 10 отзывов с изображениями
SELECT id, name, image, created_at 
FROM blog 
WHERE type='feedback' 
ORDER BY id DESC 
LIMIT 10;

-- Конкретные отзывы которые проблемные
SELECT id, name, image, created_at 
FROM blog 
WHERE type='feedback' AND id IN (468, 469, 470, 141, 142, 143)
ORDER BY id;

-- Все уникальные форматы путей изображений
SELECT DISTINCT 
    CASE 
        WHEN image LIKE 'http%' THEN 'Полный URL'
        WHEN image LIKE '/images/%' THEN 'Абсолютный путь /images/'
        WHEN image LIKE 'images/%' THEN 'Относительный путь images/'
        WHEN image LIKE '/img/%' THEN 'Абсолютный путь /img/'
        WHEN image LIKE 'img/%' THEN 'Относительный путь img/'
        WHEN image LIKE 'uploads/%' THEN 'Только uploads/'
        ELSE CONCAT('Другой формат: ', SUBSTRING(image, 1, 20))
    END as path_format,
    COUNT(*) as count
FROM blog 
WHERE type='feedback' AND image IS NOT NULL AND image != ''
GROUP BY path_format;

