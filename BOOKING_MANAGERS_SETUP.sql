-- Создание таблицы для менеджеров брони
CREATE TABLE IF NOT EXISTS `booking_managers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_is_active` (`is_active`),
  KEY `idx_order` (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Заполнение начальными данными (10 захардкоженных менеджеров)
INSERT INTO `booking_managers` (`id`, `name`, `phone`, `email`, `is_active`, `order`, `created_at`, `updated_at`) VALUES
(6, 'Екатерина Т', NULL, NULL, 1, 1, NOW(), NOW()),
(19, 'Ольга Т', NULL, NULL, 1, 2, NOW(), NOW()),
(21, 'Анна Т', NULL, NULL, 1, 3, NOW(), NOW()),
(22, 'Екатерина Я', NULL, NULL, 1, 4, NOW(), NOW()),
(23, 'Нина Я', NULL, NULL, 1, 5, NOW(), NOW()),
(25, 'Наталья О', NULL, NULL, 1, 6, NOW(), NOW()),
(26, 'Милена О', NULL, NULL, 1, 7, NOW(), NOW()),
(27, 'Ирина', NULL, NULL, 1, 8, NOW(), NOW()),
(29, 'Эльвира Т', NULL, NULL, 1, 9, NOW(), NOW()),
(30, 'Наталья Т', NULL, NULL, 1, 10, NOW(), NOW());

