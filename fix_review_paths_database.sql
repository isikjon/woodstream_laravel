-- Исправление путей к изображениям отзывов в базе данных
-- Добавляем префикс "images/content/" к файлам которые загружены через форму

-- Обновляем записи где путь это просто имя файла (без слешей)
-- Это новые загруженные отзывы через FileUpload
UPDATE blog 
SET image = CONCAT('images/content/', image)
WHERE type = 'feedback' 
  AND image NOT LIKE '%/%'
  AND image IS NOT NULL 
  AND image != '';

-- Проверяем результат первых страниц (новые записи)
SELECT id, name, image 
FROM blog 
WHERE type = 'feedback' 
ORDER BY id DESC 
LIMIT 10;

-- Проверяем записи с путями uploads/ (если есть)
SELECT id, name, image 
FROM blog 
WHERE type = 'feedback' 
  AND image LIKE '%uploads%'
LIMIT 10;

