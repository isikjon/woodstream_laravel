-- Исправление путей к изображениям в отзывах
-- Убираем дублирование "images/content/images/" и исправляем пути

-- 1. Исправляем дублирование images/content/images/ -> images/
UPDATE blog 
SET image = REPLACE(image, 'images/content/images/', 'images/')
WHERE type = 'feedback' 
  AND image LIKE '%images/content/images/%';

-- 2. Исправляем images/uploads/ -> images/content/uploads/
UPDATE blog 
SET image = REPLACE(image, 'images/uploads/', 'images/content/uploads/')
WHERE type = 'feedback' 
  AND image LIKE 'images/uploads/%'
  AND image NOT LIKE 'images/content/%';

-- 3. Исправляем uploads/ -> images/content/uploads/
UPDATE blog 
SET image = CONCAT('images/content/', image)
WHERE type = 'feedback' 
  AND image LIKE 'uploads/%'
  AND image NOT LIKE 'images/%';

-- 4. Убираем обратные слэши если есть
UPDATE blog 
SET image = REPLACE(image, '\\', '/')
WHERE type = 'feedback' 
  AND image LIKE '%\\%';

-- Показать результат
SELECT id, name, image 
FROM blog 
WHERE type = 'feedback' 
  AND image IS NOT NULL 
  AND image != ''
LIMIT 10;

