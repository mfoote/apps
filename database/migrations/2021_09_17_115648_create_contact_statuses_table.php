<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_statuses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('status_id')->index();
            $table->bigInteger('contact_id')->index();
            $table->bigInteger('from_status_id')->nullable()->index();
            $table->bigInteger('user_id')->index();
            $table->string('unique_when_ids')->nullable()->index();
            $table->timestamps();
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_statuses');
    }
}

/**
 * SQL to Load
 *
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
`id` bigint(20) UNSIGNED NOT NULL,
`table` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`sort` tinyint(4) NOT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
ALTER TABLE `options`
ADD PRIMARY KEY (`id`),
ADD KEY `options_table_index` (`table`),
ADD KEY `options_sort_index` (`sort`);
ALTER TABLE `options`
MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
INSERT INTO `options` (`table`, `value`, `sort`, `created_at`, `updated_at`) VALUES
('contacts', 'Bad Contact Info', 0, NULL, NULL),
('contacts', 'Call Attempt 1', 1, NULL, NULL),
('contacts', 'Call Attempt 2', 2, NULL, NULL),
('contacts', 'Call Attempt 3', 3, NULL, NULL),
('contacts', 'Emailed', 4, NULL, NULL),
('contacts', 'New Patient Scheduled', 5, NULL, NULL),
('contacts', 'Follow Up Scheduled', 6, NULL, NULL),
('contacts', 'Surgery Scheduled', 7, NULL, NULL),
('contacts', 'Cannot Treat', 8, NULL, NULL),
('contacts', 'Medicare/Medicaid', 8, NULL, NULL);
COMMIT;
 * 
 */
