<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-07-29 16:17:47 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 16:18:16 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 278
ERROR - 2024-07-29 16:18:18 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 278
ERROR - 2024-07-29 16:18:21 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 278
ERROR - 2024-07-29 16:18:21 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 278
ERROR - 2024-07-29 16:18:21 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 278
ERROR - 2024-07-29 16:18:23 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 278
ERROR - 2024-07-29 16:18:27 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 278
ERROR - 2024-07-29 16:18:28 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 278
ERROR - 2024-07-29 16:18:28 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 278
ERROR - 2024-07-29 16:18:37 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 278
ERROR - 2024-07-29 16:18:59 --> Severity: error --> Exception: Missing header/body separator /Applications/noah/www/html/invenlution/app/application/libraries/Requests.php 553
ERROR - 2024-07-29 16:19:01 --> Severity: error --> Exception: Missing header/body separator /Applications/noah/www/html/invenlution/app/application/libraries/Requests.php 553
ERROR - 2024-07-29 16:19:11 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 16:19:35 --> Severity: error --> Exception: Missing header/body separator /Applications/noah/www/html/invenlution/app/application/libraries/Requests.php 553
ERROR - 2024-07-29 16:19:37 --> Severity: error --> Exception: Missing header/body separator /Applications/noah/www/html/invenlution/app/application/libraries/Requests.php 553
ERROR - 2024-07-29 16:19:37 --> Severity: error --> Exception: Missing header/body separator /Applications/noah/www/html/invenlution/app/application/libraries/Requests.php 553
ERROR - 2024-07-29 16:19:59 --> Severity: error --> Exception: Response could not be parsed /Applications/noah/www/html/invenlution/app/application/libraries/Requests.php 569
ERROR - 2024-07-29 16:20:00 --> Severity: error --> Exception: Response could not be parsed /Applications/noah/www/html/invenlution/app/application/libraries/Requests.php 569
ERROR - 2024-07-29 16:20:01 --> Severity: error --> Exception: Response could not be parsed /Applications/noah/www/html/invenlution/app/application/libraries/Requests.php 569
ERROR - 2024-07-29 16:20:01 --> Severity: error --> Exception: Response could not be parsed /Applications/noah/www/html/invenlution/app/application/libraries/Requests.php 569
ERROR - 2024-07-29 16:20:03 --> Severity: error --> Exception: Response could not be parsed /Applications/noah/www/html/invenlution/app/application/libraries/Requests.php 569
ERROR - 2024-07-29 16:20:03 --> Severity: error --> Exception: Response could not be parsed /Applications/noah/www/html/invenlution/app/application/libraries/Requests.php 569
ERROR - 2024-07-29 16:20:04 --> Severity: error --> Exception: Response could not be parsed /Applications/noah/www/html/invenlution/app/application/libraries/Requests.php 569
ERROR - 2024-07-29 17:04:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '(100) NOT NULL,
	`naver_goods_nm` VARCHAR(20)(200) NOT NULL DEFAULT '',
	`cre...' at line 2 - Invalid query: CREATE TABLE IF NOT EXISTS `cb_naver_goods` (
	`naver_goods_idx` varchar(100)(100) NOT NULL,
	`naver_goods_nm` VARCHAR(20)(200) NOT NULL DEFAULT '',
	`created_at` DATETIME NOT NULL DEFAULT '',
	CONSTRAINT `pk_cb_naver_goods` PRIMARY KEY(`naver_goods_idx`)
) DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci
ERROR - 2024-07-29 17:05:08 --> Query error: Duplicate key name 'brd_key' - Invalid query: ALTER TABLE cb_board ADD UNIQUE KEY `brd_key` (`brd_key`)
ERROR - 2024-07-29 17:05:08 --> Query error: Duplicate key name 'bgr_key' - Invalid query: ALTER TABLE cb_board_group ADD UNIQUE KEY `bgr_key` (`bgr_key`)
ERROR - 2024-07-29 17:05:08 --> Query error: Duplicate key name 'bgr_id_bgm_key' - Invalid query: ALTER TABLE cb_board_group_meta ADD UNIQUE KEY `bgr_id_bgm_key` (`bgr_id`, `bgm_key`)
ERROR - 2024-07-29 17:05:08 --> Query error: Duplicate key name 'brd_id_bmt_key' - Invalid query: ALTER TABLE cb_board_meta ADD UNIQUE KEY `brd_id_bmt_key` (`brd_id`, `bmt_key`)
ERROR - 2024-07-29 17:05:08 --> Query error: Duplicate key name 'cmt_id_cme_key' - Invalid query: ALTER TABLE cb_comment_meta ADD UNIQUE KEY `cmt_id_cme_key` (`cmt_id`, `cme_key`)
ERROR - 2024-07-29 17:05:08 --> Query error: Duplicate key name 'cfg_key' - Invalid query: ALTER TABLE cb_config ADD UNIQUE KEY `cfg_key` (`cfg_key`)
ERROR - 2024-07-29 17:05:08 --> Query error: Duplicate key name 'doc_key' - Invalid query: ALTER TABLE cb_document ADD UNIQUE KEY `doc_key` (`doc_key`)
ERROR - 2024-07-29 17:05:08 --> Query error: Duplicate key name 'fgr_key' - Invalid query: ALTER TABLE cb_faq_group ADD UNIQUE KEY `fgr_key` (`fgr_key`)
ERROR - 2024-07-29 17:05:08 --> Query error: Duplicate key name 'mem_userid' - Invalid query: ALTER TABLE cb_member ADD UNIQUE KEY `mem_userid` (`mem_userid`)
ERROR - 2024-07-29 17:05:08 --> Query error: Duplicate key name 'mem_userid' - Invalid query: ALTER TABLE cb_member_dormant ADD UNIQUE KEY `mem_userid` (`mem_userid`)
ERROR - 2024-07-29 17:05:08 --> Query error: Duplicate key name 'mem_id_mev_key' - Invalid query: ALTER TABLE cb_member_extra_vars ADD UNIQUE KEY `mem_id_mev_key` (`mem_id`, `mev_key`)
ERROR - 2024-07-29 17:05:08 --> Query error: Duplicate key name 'mem_id_mmt_key' - Invalid query: ALTER TABLE cb_member_meta ADD UNIQUE KEY `mem_id_mmt_key` (`mem_id`, `mmt_key`)
ERROR - 2024-07-29 17:05:08 --> Query error: Duplicate key name 'mem_id' - Invalid query: ALTER TABLE cb_member_register ADD UNIQUE KEY `mem_id` (`mem_id`)
ERROR - 2024-07-29 17:05:08 --> Query error: Duplicate key name 'mem_userid' - Invalid query: ALTER TABLE cb_member_userid ADD UNIQUE KEY `mem_userid` (`mem_userid`)
ERROR - 2024-07-29 17:05:08 --> Query error: Duplicate key name 'post_id_pev_key' - Invalid query: ALTER TABLE cb_post_extra_vars ADD UNIQUE KEY `post_id_pev_key` (`post_id`, `pev_key`)
ERROR - 2024-07-29 17:05:08 --> Query error: Duplicate key name 'post_id_pmt_key' - Invalid query: ALTER TABLE cb_post_meta ADD UNIQUE KEY `post_id_pmt_key` (`post_id`, `pmt_key`)
ERROR - 2024-07-29 17:05:08 --> Query error: Duplicate key name 'mem_id_smt_key' - Invalid query: ALTER TABLE cb_social_meta ADD UNIQUE KEY `mem_id_smt_key` (`mem_id`, `smt_key`)
ERROR - 2024-07-29 17:05:08 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '(100) NOT NULL,
	`naver_goods_nm` VARCHAR(200)(200) NOT NULL DEFAULT '',
	`cr...' at line 2 - Invalid query: CREATE TABLE IF NOT EXISTS `cb_naver_goods` (
	`naver_goods_idx` varchar(100)(100) NOT NULL,
	`naver_goods_nm` VARCHAR(200)(200) NOT NULL DEFAULT '',
	`created_at` DATETIME NOT NULL DEFAULT '',
	CONSTRAINT `pk_cb_naver_goods` PRIMARY KEY(`naver_goods_idx`)
) DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci
ERROR - 2024-07-29 17:05:48 --> Query error: Duplicate key name 'brd_key' - Invalid query: ALTER TABLE cb_board ADD UNIQUE KEY `brd_key` (`brd_key`)
ERROR - 2024-07-29 17:05:48 --> Query error: Duplicate key name 'bgr_key' - Invalid query: ALTER TABLE cb_board_group ADD UNIQUE KEY `bgr_key` (`bgr_key`)
ERROR - 2024-07-29 17:05:48 --> Query error: Duplicate key name 'bgr_id_bgm_key' - Invalid query: ALTER TABLE cb_board_group_meta ADD UNIQUE KEY `bgr_id_bgm_key` (`bgr_id`, `bgm_key`)
ERROR - 2024-07-29 17:05:48 --> Query error: Duplicate key name 'brd_id_bmt_key' - Invalid query: ALTER TABLE cb_board_meta ADD UNIQUE KEY `brd_id_bmt_key` (`brd_id`, `bmt_key`)
ERROR - 2024-07-29 17:05:48 --> Query error: Duplicate key name 'cmt_id_cme_key' - Invalid query: ALTER TABLE cb_comment_meta ADD UNIQUE KEY `cmt_id_cme_key` (`cmt_id`, `cme_key`)
ERROR - 2024-07-29 17:05:48 --> Query error: Duplicate key name 'cfg_key' - Invalid query: ALTER TABLE cb_config ADD UNIQUE KEY `cfg_key` (`cfg_key`)
ERROR - 2024-07-29 17:05:48 --> Query error: Duplicate key name 'doc_key' - Invalid query: ALTER TABLE cb_document ADD UNIQUE KEY `doc_key` (`doc_key`)
ERROR - 2024-07-29 17:05:48 --> Query error: Duplicate key name 'fgr_key' - Invalid query: ALTER TABLE cb_faq_group ADD UNIQUE KEY `fgr_key` (`fgr_key`)
ERROR - 2024-07-29 17:05:48 --> Query error: Duplicate key name 'mem_userid' - Invalid query: ALTER TABLE cb_member ADD UNIQUE KEY `mem_userid` (`mem_userid`)
ERROR - 2024-07-29 17:05:48 --> Query error: Duplicate key name 'mem_userid' - Invalid query: ALTER TABLE cb_member_dormant ADD UNIQUE KEY `mem_userid` (`mem_userid`)
ERROR - 2024-07-29 17:05:48 --> Query error: Duplicate key name 'mem_id_mev_key' - Invalid query: ALTER TABLE cb_member_extra_vars ADD UNIQUE KEY `mem_id_mev_key` (`mem_id`, `mev_key`)
ERROR - 2024-07-29 17:05:48 --> Query error: Duplicate key name 'mem_id_mmt_key' - Invalid query: ALTER TABLE cb_member_meta ADD UNIQUE KEY `mem_id_mmt_key` (`mem_id`, `mmt_key`)
ERROR - 2024-07-29 17:05:48 --> Query error: Duplicate key name 'mem_id' - Invalid query: ALTER TABLE cb_member_register ADD UNIQUE KEY `mem_id` (`mem_id`)
ERROR - 2024-07-29 17:05:48 --> Query error: Duplicate key name 'mem_userid' - Invalid query: ALTER TABLE cb_member_userid ADD UNIQUE KEY `mem_userid` (`mem_userid`)
ERROR - 2024-07-29 17:05:48 --> Query error: Duplicate key name 'post_id_pev_key' - Invalid query: ALTER TABLE cb_post_extra_vars ADD UNIQUE KEY `post_id_pev_key` (`post_id`, `pev_key`)
ERROR - 2024-07-29 17:05:48 --> Query error: Duplicate key name 'post_id_pmt_key' - Invalid query: ALTER TABLE cb_post_meta ADD UNIQUE KEY `post_id_pmt_key` (`post_id`, `pmt_key`)
ERROR - 2024-07-29 17:05:48 --> Query error: Duplicate key name 'mem_id_smt_key' - Invalid query: ALTER TABLE cb_social_meta ADD UNIQUE KEY `mem_id_smt_key` (`mem_id`, `smt_key`)
ERROR - 2024-07-29 17:06:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '(100) NOT NULL,
	`naver_goods_nm` VARCHAR(200)(200) NOT NULL DEFAULT '',
	CON...' at line 2 - Invalid query: CREATE TABLE IF NOT EXISTS `cb_naver_goods` (
	`naver_goods_idx` varchar(100)(100) NOT NULL,
	`naver_goods_nm` VARCHAR(200)(200) NOT NULL DEFAULT '',
	CONSTRAINT `pk_cb_naver_goods` PRIMARY KEY(`naver_goods_idx`)
) DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci
ERROR - 2024-07-29 17:06:52 --> Query error: Duplicate key name 'brd_key' - Invalid query: ALTER TABLE cb_board ADD UNIQUE KEY `brd_key` (`brd_key`)
ERROR - 2024-07-29 17:06:52 --> Query error: Duplicate key name 'bgr_key' - Invalid query: ALTER TABLE cb_board_group ADD UNIQUE KEY `bgr_key` (`bgr_key`)
ERROR - 2024-07-29 17:06:52 --> Query error: Duplicate key name 'bgr_id_bgm_key' - Invalid query: ALTER TABLE cb_board_group_meta ADD UNIQUE KEY `bgr_id_bgm_key` (`bgr_id`, `bgm_key`)
ERROR - 2024-07-29 17:06:52 --> Query error: Duplicate key name 'brd_id_bmt_key' - Invalid query: ALTER TABLE cb_board_meta ADD UNIQUE KEY `brd_id_bmt_key` (`brd_id`, `bmt_key`)
ERROR - 2024-07-29 17:06:52 --> Query error: Duplicate key name 'cmt_id_cme_key' - Invalid query: ALTER TABLE cb_comment_meta ADD UNIQUE KEY `cmt_id_cme_key` (`cmt_id`, `cme_key`)
ERROR - 2024-07-29 17:06:52 --> Query error: Duplicate key name 'cfg_key' - Invalid query: ALTER TABLE cb_config ADD UNIQUE KEY `cfg_key` (`cfg_key`)
ERROR - 2024-07-29 17:06:52 --> Query error: Duplicate key name 'doc_key' - Invalid query: ALTER TABLE cb_document ADD UNIQUE KEY `doc_key` (`doc_key`)
ERROR - 2024-07-29 17:06:52 --> Query error: Duplicate key name 'fgr_key' - Invalid query: ALTER TABLE cb_faq_group ADD UNIQUE KEY `fgr_key` (`fgr_key`)
ERROR - 2024-07-29 17:06:52 --> Query error: Duplicate key name 'mem_userid' - Invalid query: ALTER TABLE cb_member ADD UNIQUE KEY `mem_userid` (`mem_userid`)
ERROR - 2024-07-29 17:06:52 --> Query error: Duplicate key name 'mem_userid' - Invalid query: ALTER TABLE cb_member_dormant ADD UNIQUE KEY `mem_userid` (`mem_userid`)
ERROR - 2024-07-29 17:06:52 --> Query error: Duplicate key name 'mem_id_mev_key' - Invalid query: ALTER TABLE cb_member_extra_vars ADD UNIQUE KEY `mem_id_mev_key` (`mem_id`, `mev_key`)
ERROR - 2024-07-29 17:06:52 --> Query error: Duplicate key name 'mem_id_mmt_key' - Invalid query: ALTER TABLE cb_member_meta ADD UNIQUE KEY `mem_id_mmt_key` (`mem_id`, `mmt_key`)
ERROR - 2024-07-29 17:06:52 --> Query error: Duplicate key name 'mem_id' - Invalid query: ALTER TABLE cb_member_register ADD UNIQUE KEY `mem_id` (`mem_id`)
ERROR - 2024-07-29 17:06:52 --> Query error: Duplicate key name 'mem_userid' - Invalid query: ALTER TABLE cb_member_userid ADD UNIQUE KEY `mem_userid` (`mem_userid`)
ERROR - 2024-07-29 17:06:52 --> Query error: Duplicate key name 'post_id_pev_key' - Invalid query: ALTER TABLE cb_post_extra_vars ADD UNIQUE KEY `post_id_pev_key` (`post_id`, `pev_key`)
ERROR - 2024-07-29 17:06:52 --> Query error: Duplicate key name 'post_id_pmt_key' - Invalid query: ALTER TABLE cb_post_meta ADD UNIQUE KEY `post_id_pmt_key` (`post_id`, `pmt_key`)
ERROR - 2024-07-29 17:06:52 --> Query error: Duplicate key name 'mem_id_smt_key' - Invalid query: ALTER TABLE cb_social_meta ADD UNIQUE KEY `mem_id_smt_key` (`mem_id`, `smt_key`)
ERROR - 2024-07-29 17:06:52 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '(100) NOT NULL DEFAULT '',
	`naver_goods_nm` VARCHAR(200)(200) NOT NULL DEFAU...' at line 2 - Invalid query: CREATE TABLE IF NOT EXISTS `cb_naver_goods` (
	`naver_goods_idx` varchar(100)(100) NOT NULL DEFAULT '',
	`naver_goods_nm` VARCHAR(200)(200) NOT NULL DEFAULT '',
	CONSTRAINT `pk_cb_naver_goods` PRIMARY KEY(`naver_goods_idx`)
) DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci
ERROR - 2024-07-29 17:07:43 --> Query error: Duplicate key name 'brd_key' - Invalid query: ALTER TABLE cb_board ADD UNIQUE KEY `brd_key` (`brd_key`)
ERROR - 2024-07-29 17:07:43 --> Query error: Duplicate key name 'bgr_key' - Invalid query: ALTER TABLE cb_board_group ADD UNIQUE KEY `bgr_key` (`bgr_key`)
ERROR - 2024-07-29 17:07:43 --> Query error: Duplicate key name 'bgr_id_bgm_key' - Invalid query: ALTER TABLE cb_board_group_meta ADD UNIQUE KEY `bgr_id_bgm_key` (`bgr_id`, `bgm_key`)
ERROR - 2024-07-29 17:07:43 --> Query error: Duplicate key name 'brd_id_bmt_key' - Invalid query: ALTER TABLE cb_board_meta ADD UNIQUE KEY `brd_id_bmt_key` (`brd_id`, `bmt_key`)
ERROR - 2024-07-29 17:07:43 --> Query error: Duplicate key name 'cmt_id_cme_key' - Invalid query: ALTER TABLE cb_comment_meta ADD UNIQUE KEY `cmt_id_cme_key` (`cmt_id`, `cme_key`)
ERROR - 2024-07-29 17:07:43 --> Query error: Duplicate key name 'cfg_key' - Invalid query: ALTER TABLE cb_config ADD UNIQUE KEY `cfg_key` (`cfg_key`)
ERROR - 2024-07-29 17:07:43 --> Query error: Duplicate key name 'doc_key' - Invalid query: ALTER TABLE cb_document ADD UNIQUE KEY `doc_key` (`doc_key`)
ERROR - 2024-07-29 17:07:43 --> Query error: Duplicate key name 'fgr_key' - Invalid query: ALTER TABLE cb_faq_group ADD UNIQUE KEY `fgr_key` (`fgr_key`)
ERROR - 2024-07-29 17:07:43 --> Query error: Duplicate key name 'mem_userid' - Invalid query: ALTER TABLE cb_member ADD UNIQUE KEY `mem_userid` (`mem_userid`)
ERROR - 2024-07-29 17:07:43 --> Query error: Duplicate key name 'mem_userid' - Invalid query: ALTER TABLE cb_member_dormant ADD UNIQUE KEY `mem_userid` (`mem_userid`)
ERROR - 2024-07-29 17:07:43 --> Query error: Duplicate key name 'mem_id_mev_key' - Invalid query: ALTER TABLE cb_member_extra_vars ADD UNIQUE KEY `mem_id_mev_key` (`mem_id`, `mev_key`)
ERROR - 2024-07-29 17:07:43 --> Query error: Duplicate key name 'mem_id_mmt_key' - Invalid query: ALTER TABLE cb_member_meta ADD UNIQUE KEY `mem_id_mmt_key` (`mem_id`, `mmt_key`)
ERROR - 2024-07-29 17:07:43 --> Query error: Duplicate key name 'mem_id' - Invalid query: ALTER TABLE cb_member_register ADD UNIQUE KEY `mem_id` (`mem_id`)
ERROR - 2024-07-29 17:07:43 --> Query error: Duplicate key name 'mem_userid' - Invalid query: ALTER TABLE cb_member_userid ADD UNIQUE KEY `mem_userid` (`mem_userid`)
ERROR - 2024-07-29 17:07:43 --> Query error: Duplicate key name 'post_id_pev_key' - Invalid query: ALTER TABLE cb_post_extra_vars ADD UNIQUE KEY `post_id_pev_key` (`post_id`, `pev_key`)
ERROR - 2024-07-29 17:07:43 --> Query error: Duplicate key name 'post_id_pmt_key' - Invalid query: ALTER TABLE cb_post_meta ADD UNIQUE KEY `post_id_pmt_key` (`post_id`, `pmt_key`)
ERROR - 2024-07-29 17:07:43 --> Query error: Duplicate key name 'mem_id_smt_key' - Invalid query: ALTER TABLE cb_social_meta ADD UNIQUE KEY `mem_id_smt_key` (`mem_id`, `smt_key`)
ERROR - 2024-07-29 17:07:43 --> Query error: Invalid default value for 'created_at' - Invalid query: CREATE TABLE IF NOT EXISTS `cb_naver_goods` (
	`naver_goods_idx` varchar(100) NOT NULL,
	`naver_goods_nm` VARCHAR(200) NOT NULL DEFAULT '',
	`created_at` DATETIME NOT NULL DEFAULT '',
	CONSTRAINT `pk_cb_naver_goods` PRIMARY KEY(`naver_goods_idx`)
) DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci
ERROR - 2024-07-29 17:08:56 --> Query error: Invalid default value for 'created_at' - Invalid query: CREATE TABLE IF NOT EXISTS `cb_naver_goods` (
	`naver_goods_idx` VARCHAR(100) NOT NULL,
	`naver_goods_nm` VARCHAR(200) NOT NULL DEFAULT '',
	`created_at` DATETIME NOT NULL DEFAULT '',
	CONSTRAINT `pk_cb_naver_goods` PRIMARY KEY(`naver_goods_idx`)
) DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci
ERROR - 2024-07-29 17:12:38 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 17:12:42 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 17:12:49 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 17:12:54 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 17:13:00 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 17:13:14 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 17:13:18 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 17:13:21 --> Severity: error --> Exception: stream_socket_client(): SSL operation failed with code 1. OpenSSL Error messages:
error:1416F086:SSL routines:tls_process_server_certificate:certificate verify failed
stream_socket_client(): Failed to enable crypto
stream_socket_client(): unable to connect to ssl://api.ciboard.co.kr:443 (Unknown error) /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/fsockopen.php 364
ERROR - 2024-07-29 17:13:26 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 17:13:29 --> Non-existent class: Requests
ERROR - 2024-07-29 17:13:31 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 17:13:35 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 17:14:15 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 17:14:30 --> Severity: error --> Exception: Missing header/body separator /Applications/noah/www/html/invenlution/app/application/libraries/Requests.php 553
ERROR - 2024-07-29 17:14:33 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 17:14:47 --> Severity: error --> Exception: stream_socket_client(): SSL operation failed with code 1. OpenSSL Error messages:
error:1416F086:SSL routines:tls_process_server_certificate:certificate verify failed
stream_socket_client(): Failed to enable crypto
stream_socket_client(): unable to connect to ssl://api.ciboard.co.kr:443 (Unknown error) /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/fsockopen.php 364
ERROR - 2024-07-29 17:15:17 --> Non-existent class: Requests
ERROR - 2024-07-29 17:15:19 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 17:16:16 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 17:16:28 --> Severity: error --> Exception: Missing header/body separator /Applications/noah/www/html/invenlution/app/application/libraries/Requests.php 553
ERROR - 2024-07-29 17:16:44 --> Severity: error --> Exception: Response could not be parsed /Applications/noah/www/html/invenlution/app/application/libraries/Requests.php 569
ERROR - 2024-07-29 17:18:55 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 17:19:02 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 277
ERROR - 2024-07-29 17:22:59 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 278
ERROR - 2024-07-29 17:23:05 --> Severity: error --> Exception: cURL error 60: SSL certificate problem: unable to get local issuer certificate /Applications/noah/www/html/invenlution/app/application/libraries/Requests/Transport/cURL.php 278
