-- Удаление дублей из booking_managers, оставляем только записи с минимальным ID
DELETE t1 FROM booking_managers t1
INNER JOIN booking_managers t2 
WHERE 
    t1.id > t2.id 
    AND t1.name = t2.name 
    AND t1.email = t2.email;

-- Проверка результата
SELECT * FROM booking_managers ORDER BY `order`, name;

