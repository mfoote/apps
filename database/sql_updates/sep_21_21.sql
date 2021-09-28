ALTER TABLE `contact_notes` CHANGE `status` `category` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Note' AFTER `contact_id`;
ALTER TABLE `contact_notes` CHANGE `user_id` `user_id` BIGINT(20) NOT NULL AFTER `contact_id`, CHANGE `updated_user_id` `updated_user_id` BIGINT(20) NULL DEFAULT NULL AFTER `contact_id`;
ALTER TABLE `contact_notes` CHANGE `user_id` `user_id` BIGINT(20) NOT NULL AFTER `contact_id`;
ALTER TABLE `contact_notes` ADD `follow_up_done` TINYINT(1) NOT NULL DEFAULT '0' AFTER `follow_up_on`, ADD INDEX (`follow_up_done`);
ALTER TABLE `options` ADD `is_unique` TINYINT(1) NOT NULL DEFAULT '0' AFTER `value`, ADD INDEX (`is_unique`);
INSERT INTO `options` (`id`, `table`, `value`, `is_unique`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'contacts', 'Bad Contact Info', 0, 0, '2021-09-21 12:03:20', '2021-09-21 12:03:20'),
(2, 'contacts', 'Call Attempt 1', 1, 1, '2021-09-21 12:03:20', '2021-09-21 12:03:20'),
(3, 'contacts', 'Call Attempt 2', 1, 2, '2021-09-21 12:03:20', '2021-09-21 12:03:20'),
(4, 'contacts', 'Call Attempt 3', 1, 3, '2021-09-21 12:03:20', '2021-09-21 12:03:20'),
(5, 'contacts', 'Emailed', 0, 4, '2021-09-21 12:03:20', '2021-09-21 12:03:20'),
(6, 'contacts', 'New Patient Scheduled', 1, 5, '2021-09-21 12:03:20', '2021-09-21 12:03:20'),
(7, 'contacts', 'Follow Up Scheduled', 0, 6, '2021-09-21 12:03:20', '2021-09-21 12:03:20'),
(8, 'contacts', 'Surgery Scheduled', 1, 7, '2021-09-21 12:03:20', '2021-09-21 12:03:20'),
(9, 'contacts', 'Cannot Treat', 0, 8, '2021-09-21 12:03:20', '2021-09-21 12:03:20'),
(10, 'contacts', 'Medicare/Medicaid', 0, 9, '2021-09-21 12:03:20', '2021-09-21 12:03:20');
-- UPDATE `options` SET `created_at` = NULL, `updated_at` = NULL WHERE `options`.`id` = 1;
-- UPDATE `options` SET `is_unique` = '1', `created_at` = NULL, `updated_at` = NULL WHERE `options`.`id` = 2;
-- UPDATE `options` SET `is_unique` = '1', `created_at` = NULL, `updated_at` = NULL WHERE `options`.`id` = 3;
-- UPDATE `options` SET `is_unique` = '1', `created_at` = NULL, `updated_at` = NULL WHERE `options`.`id` = 4;
-- UPDATE `options` SET `created_at` = NULL, `updated_at` = NULL WHERE `options`.`id` = 5;
-- UPDATE `options` SET `is_unique` = '1', `created_at` = NULL, `updated_at` = NULL WHERE `options`.`id` = 6;
-- UPDATE `options` SET `created_at` = NULL, `updated_at` = NULL WHERE `options`.`id` = 7;
-- UPDATE `options` SET `is_unique` = '1', `created_at` = NULL, `updated_at` = NULL WHERE `options`.`id` = 8;
-- UPDATE `options` SET `created_at` = NULL, `updated_at` = NULL WHERE `options`.`id` = 9;
-- UPDATE `options` SET `created_at` = NULL, `updated_at` = NULL WHERE `options`.`id` = 10;
-- UPDATE `options` SET `created_at` = NOW();
-- UPDATE `options` SET `updated_at` = NOW();
ALTER TABLE `users` ADD `role_ids` JSON NULL DEFAULT NULL AFTER `id`;
ALTER TABLE `contacts` ADD `lop_threshold` DECIMAL(13,2) NULL DEFAULT NULL AFTER `initial_comment`;
