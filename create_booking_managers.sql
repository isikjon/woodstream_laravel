-- Создание таблицы booking_managers
CREATE TABLE IF NOT EXISTS `booking_managers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `order` int NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Заполнение таблицы активными менеджерами из текущей таблицы managers
-- Менеджеры, которые НЕ зачеркнуты на скриншоте:
INSERT INTO `booking_managers` (`name`, `phone`, `email`, `is_active`, `order`, `created_at`, `updated_at`) VALUES
('Екатерина Т', '+7-927-771-20-21', 'ekaterinatit1@rambler.ru', 1, 1, NOW(), NOW()),
('Ольга Т', '79171338697', 'olenka.maksimova.1975@inbox.ru', 1, 2, NOW(), NOW()),
('Анна Т', '79397550591', 'vinokurovaanna@inbox.ru', 1, 3, NOW(), NOW()),
('Екатерина Я', '+7 961 162-39-41', '79611623941@woodstream.online', 1, 4, NOW(), NOW()),
('Нина Я', '+7 920 656-46-01', '79206564601@woodstream.online', 1, 5, NOW(), NOW()),
('Наталья О', '+7 953 832-56-06', '79538325606@woodstream.online', 1, 6, NOW(), NOW()),
('Милена О', '+7 903 367-27-10', '79033672710@woodstream.online', 1, 7, NOW(), NOW()),
('Ирина', NULL, 'irina@woodstream.online', 1, 8, NOW(), NOW()),
('Эльвира Т', '+79297147234', '89372164317@mail.ru', 1, 9, NOW(), NOW()),
('Наталья Т', '+79198031303', 'nataci-kim@mail.ru', 1, 10, NOW(), NOW()),
('Глеб', '79649664156', 'gleb@woodstream.online', 1, 11, NOW(), NOW());

