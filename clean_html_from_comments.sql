-- Очистка HTML-тегов и сущностей из поля comment в таблице products
-- Этот скрипт удаляет все HTML-теги и декодирует HTML-сущности

UPDATE products 
SET comment = TRIM(
    REPLACE(
        REPLACE(
            REPLACE(
                REPLACE(
                    REPLACE(
                        REPLACE(
                            REPLACE(comment, '&nbsp;', ' '),
                            '&lt;', '<'
                        ),
                        '&gt;', '>'
                    ),
                    '&amp;', '&'
                ),
                '&quot;', '"'
            ),
            '<p>', ''
        ),
        '</p>', ''
    )
)
WHERE comment LIKE '%<%' 
   OR comment LIKE '%&nbsp;%'
   OR comment LIKE '%&lt;%'
   OR comment LIKE '%&gt;%'
   OR comment LIKE '%&amp;%'
   OR comment LIKE '%&quot;%';

-- Показать результат
SELECT id, name, comment 
FROM products 
WHERE comment IS NOT NULL 
  AND comment != '' 
LIMIT 10;

