/*
 Navicat Premium Dump SQL

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80043 (8.0.43)
 Source Host           : localhost:3306
 Source Schema         : revdang

 Target Server Type    : MySQL
 Target Server Version : 80043 (8.0.43)
 File Encoding         : 65001

 Date: 16/04/2026 18:17:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for feedback
-- ----------------------------
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pengaduan_id` bigint unsigned NOT NULL,
  `rating` tinyint unsigned NOT NULL COMMENT 'Rating 1-5',
  `komentar` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `feedback_pengaduan_id_foreign` (`pengaduan_id`),
  CONSTRAINT `feedback_pengaduan_id_foreign` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of feedback
-- ----------------------------
BEGIN;
INSERT INTO `feedback` (`id`, `pengaduan_id`, `rating`, `komentar`, `created_at`, `updated_at`) VALUES (1, 5, 4, 'sfgdfg', '2026-04-14 12:47:24', '2026-04-14 12:47:24');
INSERT INTO `feedback` (`id`, `pengaduan_id`, `rating`, `komentar`, `created_at`, `updated_at`) VALUES (2, 4, 3, 'sdfdsf', '2026-04-14 12:56:06', '2026-04-14 12:56:06');
COMMIT;

-- ----------------------------
-- Table structure for gangguan
-- ----------------------------
DROP TABLE IF EXISTS `gangguan`;
CREATE TABLE `gangguan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_gangguan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of gangguan
-- ----------------------------
BEGIN;
INSERT INTO `gangguan` (`id`, `nama_gangguan`, `deskripsi`, `created_at`, `updated_at`) VALUES (2, 'Meter Error', 'Meteran menampilkan text  Error', '2026-04-14 11:41:32', '2026-04-14 11:41:32');
INSERT INTO `gangguan` (`id`, `nama_gangguan`, `deskripsi`, `created_at`, `updated_at`) VALUES (3, 'Listrik tidak stabil', 'Listrik tidak stabil', '2026-04-14 13:05:51', '2026-04-14 13:05:51');
COMMIT;

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of job_batches
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for log_aktivitas
-- ----------------------------
DROP TABLE IF EXISTS `log_aktivitas`;
CREATE TABLE `log_aktivitas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `aktivitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Deskripsi aktivitas yang dilakukan',
  `modul` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Modul yang diakses (admin, petugas, pelanggan)',
  `IP_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Alamat IP user',
  `user_agent` text COLLATE utf8mb4_unicode_ci COMMENT 'Browser/Device info',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `log_aktivitas_user_id_index` (`user_id`),
  KEY `log_aktivitas_modul_index` (`modul`),
  KEY `log_aktivitas_created_at_index` (`created_at`),
  CONSTRAINT `log_aktivitas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of log_aktivitas
-- ----------------------------
BEGIN;
INSERT INTO `log_aktivitas` (`id`, `user_id`, `aktivitas`, `modul`, `IP_address`, `user_agent`, `created_at`, `updated_at`) VALUES (1, 1, 'User Administrator (admin) logout', 'admin', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-04-14 12:56:18', '2026-04-14 12:56:18');
INSERT INTO `log_aktivitas` (`id`, `user_id`, `aktivitas`, `modul`, `IP_address`, `user_agent`, `created_at`, `updated_at`) VALUES (2, 1, 'User Administrator (admin) berhasil login', 'admin', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-04-14 12:56:24', '2026-04-14 12:56:24');
INSERT INTO `log_aktivitas` (`id`, `user_id`, `aktivitas`, `modul`, `IP_address`, `user_agent`, `created_at`, `updated_at`) VALUES (3, 1, 'Menambah data gangguan baru: Listrik tidak stabil', 'admin', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', '2026-04-14 13:05:51', '2026-04-14 13:05:51');
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4, '2024_01_01_000001_create_petugas_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5, '2024_01_01_000002_create_pelanggan_table', 3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6, '2024_01_01_000003_create_gangguan_table', 4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7, '2024_01_01_000004_create_pengaduan_table', 5);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8, '2024_01_01_000005_create_penanganan_table', 6);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9, '2024_01_01_000006_create_feedback_table', 7);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10, '2024_01_01_000007_create_log_aktivitas_table', 8);
COMMIT;

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE `pelanggan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daya` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_meter` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pelanggan_nik_unique` (`nik`),
  UNIQUE KEY `pelanggan_nomor_meter_unique` (`nomor_meter`),
  KEY `pelanggan_user_id_foreign` (`user_id`),
  CONSTRAINT `pelanggan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pelanggan
-- ----------------------------
BEGIN;
INSERT INTO `pelanggan` (`id`, `nik`, `nama`, `alamat`, `telp`, `daya`, `nomor_meter`, `user_id`, `created_at`, `updated_at`) VALUES (1, '1234567543213243', 'sdhjf', 'kklj', '989798798', '900', '234432423123234', 24, '2026-04-14 11:09:48', '2026-04-14 11:10:48');
COMMIT;

-- ----------------------------
-- Table structure for penanganan
-- ----------------------------
DROP TABLE IF EXISTS `penanganan`;
CREATE TABLE `penanganan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pengaduan_id` bigint unsigned NOT NULL,
  `petugas_id` bigint unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `tindakan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','diproses','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penanganan_pengaduan_id_foreign` (`pengaduan_id`),
  KEY `penanganan_petugas_id_foreign` (`petugas_id`),
  CONSTRAINT `penanganan_pengaduan_id_foreign` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `penanganan_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of penanganan
-- ----------------------------
BEGIN;
INSERT INTO `penanganan` (`id`, `pengaduan_id`, `petugas_id`, `tanggal`, `tindakan`, `hasil`, `status`, `created_at`, `updated_at`) VALUES (1, 1, 1, '2026-04-14', 'fghdfh', 'ghfghfgh', 'diproses', '2026-04-14 12:33:14', '2026-04-14 12:33:14');
COMMIT;

-- ----------------------------
-- Table structure for pengaduan
-- ----------------------------
DROP TABLE IF EXISTS `pengaduan`;
CREATE TABLE `pengaduan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pelanggan_id` bigint unsigned NOT NULL,
  `gangguan_id` bigint unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `keluhan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('menunggu','diproses','selesai','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengaduan_pelanggan_id_foreign` (`pelanggan_id`),
  KEY `pengaduan_gangguan_id_foreign` (`gangguan_id`),
  CONSTRAINT `pengaduan_gangguan_id_foreign` FOREIGN KEY (`gangguan_id`) REFERENCES `gangguan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengaduan_pelanggan_id_foreign` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pengaduan
-- ----------------------------
BEGIN;
INSERT INTO `pengaduan` (`id`, `pelanggan_id`, `gangguan_id`, `tanggal`, `keluhan`, `lokasi`, `status`, `foto`, `created_at`, `updated_at`) VALUES (1, 1, 2, '2026-04-14', 'dfgdfgdfg', 'egdfgfdg', 'diproses', NULL, '2026-04-14 12:02:02', '2026-04-14 12:02:02');
INSERT INTO `pengaduan` (`id`, `pelanggan_id`, `gangguan_id`, `tanggal`, `keluhan`, `lokasi`, `status`, `foto`, `created_at`, `updated_at`) VALUES (2, 1, 2, '2026-04-14', 'dfgdfgdfg', 'egdfgfdg', 'diproses', NULL, '2026-04-14 12:02:11', '2026-04-14 12:02:11');
INSERT INTO `pengaduan` (`id`, `pelanggan_id`, `gangguan_id`, `tanggal`, `keluhan`, `lokasi`, `status`, `foto`, `created_at`, `updated_at`) VALUES (3, 1, 2, '2026-04-14', 'dfgfdgfdg', 'dfgdf', 'menunggu', NULL, '2026-04-14 12:03:26', '2026-04-14 12:03:26');
INSERT INTO `pengaduan` (`id`, `pelanggan_id`, `gangguan_id`, `tanggal`, `keluhan`, `lokasi`, `status`, `foto`, `created_at`, `updated_at`) VALUES (4, 1, 2, '2026-04-08', 'dfgdfg', 'dfg', 'menunggu', NULL, '2026-04-14 12:13:24', '2026-04-14 12:13:24');
INSERT INTO `pengaduan` (`id`, `pelanggan_id`, `gangguan_id`, `tanggal`, `keluhan`, `lokasi`, `status`, `foto`, `created_at`, `updated_at`) VALUES (5, 1, 2, '2026-04-14', 'dfg', 'dfg', 'menunggu', '1776168819_Lambang_Kabupaten_Barito_Kuala.png', '2026-04-14 12:13:39', '2026-04-14 12:13:39');
COMMIT;

-- ----------------------------
-- Table structure for petugas
-- ----------------------------
DROP TABLE IF EXISTS `petugas`;
CREATE TABLE `petugas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `petugas_nik_unique` (`nik`),
  KEY `petugas_user_id_foreign` (`user_id`),
  CONSTRAINT `petugas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of petugas
-- ----------------------------
BEGIN;
INSERT INTO `petugas` (`id`, `nik`, `nama`, `jabatan`, `telp`, `user_id`, `created_at`, `updated_at`) VALUES (1, '6371030807720012', 'andy', 'Teknisi', '43565756463524', 23, '2026-04-14 10:38:23', '2026-04-14 10:38:23');
COMMIT;

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of sessions
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','petugas','pelanggan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pelanggan',
  `status_akun` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'revdang', 'Administrator', 'admin@revdang.co.id', NULL, '$2y$12$v..0SkVdBvDKKbSamudvMulLoz5wRST8fZNQ/rIJq5csoH9wF6JuC', 'admin', 'aktif', NULL, '2026-04-14 09:33:35', '2026-04-14 09:33:35');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (2, 'petugas1', 'Budi Santoso', 'petugas1@revdang.co.id', NULL, '$2y$12$N6izJV4WU.SsifaR3P7FL.6mappM8.GZPDyj9Io7KxJs3qXukSuKK', 'petugas', 'aktif', NULL, '2026-04-14 09:33:35', '2026-04-14 09:33:35');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (3, 'petugas2', 'Ahmad Wijaya', 'petugas2@revdang.co.id', NULL, '$2y$12$lLDFRRq5XQ1OzQELXxcIU.w4n/YwoizAsAxoebTsq2YheyXl6R7nS', 'petugas', 'aktif', NULL, '2026-04-14 09:33:36', '2026-04-14 09:33:36');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (4, 'petugas3', 'Dewi Lestari', 'petugas3@revdang.co.id', NULL, '$2y$12$npBr4aPraX3tYKqovmuEf.GZRrofjJVf6kTTzlR9XcxblMOQUaA2i', 'petugas', 'aktif', NULL, '2026-04-14 09:33:36', '2026-04-14 09:33:36');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (5, 'petugas4', 'Rizky Pratama', 'petugas4@revdang.co.id', NULL, '$2y$12$LfPedn92PFZvCeXd8QurbetLBrC1HW/zK3unkxnDx/DV3nzLnIywe', 'petugas', 'aktif', NULL, '2026-04-14 09:33:36', '2026-04-14 09:33:36');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (6, 'petugas5', 'Siti Nurhaliza', 'petugas5@revdang.co.id', NULL, '$2y$12$RKZKzHgSW9JNPGKgbDczBev.M582r5LaIU9dy1qSIo8/pSMlrRL42', 'petugas', 'aktif', NULL, '2026-04-14 09:33:36', '2026-04-14 09:33:36');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (7, 'petugas6', 'Joko Susilo', 'petugas6@revdang.co.id', NULL, '$2y$12$fx0IwOXZ4yo50vIXFWouMOhL.uTRjztEglwXWqWNYRoKlky8xTECu', 'petugas', 'aktif', NULL, '2026-04-14 09:33:37', '2026-04-14 09:33:37');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (8, 'petugas7', 'Rina Marlina', 'petugas7@revdang.co.id', NULL, '$2y$12$wp7rzRl4mzNQLZaWtLuXKe2fn54gddS4MvggKD5WdN0JmWFOgx/5u', 'petugas', 'aktif', NULL, '2026-04-14 09:33:37', '2026-04-14 09:33:37');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (9, 'petugas8', 'Hendra Kusuma', 'petugas8@revdang.co.id', NULL, '$2y$12$WxVsQSZoeWYpZFkMwJnRLuhFrFOZVQPJFyUWVoiJIxXiZNdWrlEzW', 'petugas', 'aktif', NULL, '2026-04-14 09:33:37', '2026-04-14 09:33:37');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (10, 'petugas9', 'Putri Ayu', 'petugas9@revdang.co.id', NULL, '$2y$12$8hiGzkVCo1EhTDcJZO0vzubNxMwHtKhVxqaAqtPHhryOM8fwIMOau', 'petugas', 'aktif', NULL, '2026-04-14 09:33:38', '2026-04-14 09:33:38');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (11, 'petugas10', 'Dimas Ardiansyah', 'petugas10@revdang.co.id', NULL, '$2y$12$dA2qqp78G.pmOJoAcl3ONu3oRSEnpKHAlHKDR9/myByiIEUcnQ/au', 'petugas', 'aktif', NULL, '2026-04-14 09:33:38', '2026-04-14 09:33:38');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (12, '1658709324', 'Andi Nugroho', 'pelanggan1@email.com', NULL, '$2y$12$Spvib2BB9EN.tuEftH2ENeF.jwdHdjYlV8cCm/zxviYcGsa0323D6', 'pelanggan', 'aktif', NULL, '2026-04-14 09:33:38', '2026-04-14 09:33:38');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (13, '9861720534', 'Maria Natalia', 'pelanggan2@email.com', NULL, '$2y$12$EahzoGlDpYHo1gOnKylOT.QXIttoX6lurcJD4ZaYNa8iIXv1MqjVm', 'pelanggan', 'aktif', NULL, '2026-04-14 09:33:38', '2026-04-14 09:33:38');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (14, '4681753029', 'Fajar Ramadhan', 'pelanggan3@email.com', NULL, '$2y$12$f.vAfZ8gSDnFpsAmNDLjPuzw6kPHfGgkM8Z1F7QgTSeYchzyuPjR6', 'pelanggan', 'aktif', NULL, '2026-04-14 09:33:39', '2026-04-14 09:33:39');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (15, '6405893127', 'Nisa Khoirunnisa', 'pelanggan4@email.com', NULL, '$2y$12$Rrbl6vumhJIlNhMbfFrmiOAO8VZr4KyP.UXKEPKasvv7P9lrbqzUi', 'pelanggan', 'aktif', NULL, '2026-04-14 09:33:39', '2026-04-14 09:33:39');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (16, '8614203975', 'Bayu Firmansyah', 'pelanggan5@email.com', NULL, '$2y$12$fMpcD9tYGLJEyJcrTQR0oOGUfKMvzeht6wrqpMsYilZRiveSFFQaW', 'pelanggan', 'aktif', NULL, '2026-04-14 09:33:39', '2026-04-14 09:33:39');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (17, '8652743190', 'Yuni Sartika', 'pelanggan6@email.com', NULL, '$2y$12$.plg.uJSn3EqM0S.Dr.62uQi/lBJmkmn804LD42VxQ7WFe5Rj1rqO', 'pelanggan', 'aktif', NULL, '2026-04-14 09:33:39', '2026-04-14 09:33:39');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (18, '8362401597', 'Galih Ratna', 'pelanggan7@email.com', NULL, '$2y$12$TXtr8ew0utGqDeDxiblUceQBJJNqeol65gVMRzjnlwQvWNFpnivxi', 'pelanggan', 'aktif', NULL, '2026-04-14 09:33:40', '2026-04-14 09:33:40');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (19, '6149058237', 'Taufik Hidayat', 'pelanggan8@email.com', NULL, '$2y$12$4Cm83ultPg7XGUz29vi4c.jpY81ozAsL0qOBrggvL6WGPHgZphEoO', 'pelanggan', 'aktif', NULL, '2026-04-14 09:33:40', '2026-04-14 09:33:40');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (20, '2385691047', 'Anisa Rahma', 'pelanggan9@email.com', NULL, '$2y$12$60Q.EvnORLKNg5wy0mVMVuoCL64gtDoOluFk0vP5s.wzajjxVMxVu', 'pelanggan', 'aktif', NULL, '2026-04-14 09:33:40', '2026-04-14 09:33:40');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (21, '2964837510', 'Wahyu Setiawan', 'pelanggan10@email.com', NULL, '$2y$12$qay.gx/47Jut5nYPR/wQLOXZqNXxJPmkOBOeszqtAbra4ed75LkF2', 'pelanggan', 'aktif', NULL, '2026-04-14 09:33:40', '2026-04-14 09:33:40');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (22, 'adi', 'adi', 'adi@gmailcom', NULL, '$2y$12$7vG6E3ocjkHt/JI6.ffgSeOHtADNj1pRlyiTXzfrP7/9IpcxGOORq', 'admin', 'aktif', NULL, '2026-04-14 10:25:33', '2026-04-14 10:25:33');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (23, 'andy', 'andy', 'andy@gmail.com', NULL, '$2y$12$V6pIW2c08W/Dy92JC0opluesVnmdJHTqaYA.yoMOm3fi4l1OrqOVq', 'petugas', 'aktif', NULL, '2026-04-14 10:38:23', '2026-04-14 10:38:23');
INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `status_akun`, `remember_token`, `created_at`, `updated_at`) VALUES (24, '234432423123234', 'sdhjf', '1234567543213243@pelanggan.com', NULL, '$2y$12$dAOTolqzX7EbIKZhc0jFKurwtMnoa57u9IBxLoWVly9mf4pBqIXA2', 'pelanggan', 'aktif', NULL, '2026-04-14 11:10:48', '2026-04-14 11:10:48');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
