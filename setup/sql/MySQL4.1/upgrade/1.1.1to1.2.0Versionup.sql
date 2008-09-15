--
-- テーブルの構造 `c_member_data`
--

CREATE TABLE `c_member_data` (
  `c_member_data_id` int(11) NOT NULL auto_increment,
  `c_member_id` int(11) NOT NULL default '0',
  `diary_count` int(11) NOT NULL default '0',
  `diary_comment_count` int(11) NOT NULL default '0',
  `commu_count` int(11) NOT NULL default '0',
  `topic_count` int(11) NOT NULL default '0',
  `topic_comment_count` int(11) NOT NULL default '0',
  `event_count` int(11) NOT NULL default '0',
  `event_comment_count` int(11) NOT NULL default '0',
  `message_send_count` int(11) NOT NULL default '0',
  `message_resieve_count` int(11) NOT NULL default '0',
  `image_count` int(11) NOT NULL default '0',
  `movie_count` int(11) NOT NULL default '0',
  `image_size` int(11) NOT NULL default '0',
  `movie_size` int(11) NOT NULL default '0',
  `friend_count` int(11) NOT NULL default '0',
  `block_count` int(11) NOT NULL default '0',
  `login_count` int(11) NOT NULL default '0',
  `chenge_nickname_count` int(11) NOT NULL default '0',
  `chenge_password_count` int(11) NOT NULL default '0',
  `chenge_pcmail_count` int(11) NOT NULL default '0',
  `chenge_mobilemail_count` int(11) NOT NULL default '0',
  `member_rank` tinyint(2) NOT NULL default '0',
  `member_point` int(11) NOT NULL default '0',
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `deleted_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`c_member_data_id`),
  KEY `c_member_id` (`c_member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `c_commu` ADD COLUMN open_flag tinyint(1) NOT NULL default 0;

ALTER TABLE `c_commu_topic` ADD COLUMN open_flag tinyint(1) NOT NULL default 0;
ALTER TABLE `c_etsuran` ADD `c_commu_topic_id` INT( 11 ) NOT NULL DEFAULT '0' AFTER `c_diary_id` ;
ALTER TABLE `c_commu_topic` ADD `etsuran_count` INT( 11 ) NOT NULL DEFAULT '0';

--
-- テーブルの構造 `c_get_access`
--

CREATE TABLE IF NOT EXISTS `c_get_access` (
  `c_get_access_id` int(11) NOT NULL auto_increment,
  `c_member_id_to` int(11) NOT NULL default '0',
  `c_member_id_from` int(11) NOT NULL default '0',
  `access_count` int(11) NOT NULL default '0',
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `deleted_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`c_get_access_id`),
  KEY `c_member_id` (`c_member_id_to`),
  KEY `c_member_from` (`c_member_id_from`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `c_image_commu`
--

CREATE TABLE IF NOT EXISTS `c_image_commu` (
  `c_image_commu_id` int(11) NOT NULL auto_increment,
  `c_member_id` int(11) NOT NULL default '0',
  `filename` text NOT NULL,
  `filesize` int(11) NOT NULL default '0',
  `filetype` char(3) NOT NULL default '',
  `owner_id` int(11) NOT NULL default '0',
  `comment` text,
  `tags` varchar(64) default NULL,
  `image_data` longblob,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `deleted_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`c_image_commu_id`),
  KEY `c_member_id` (`c_member_id`),
  KEY `filename_owner_id_sub` (`filename`(100),`owner_id`),
  KEY `created_at` (`created_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `c_image_diary`
--

CREATE TABLE IF NOT EXISTS `c_image_diary` (
  `c_image_diary_id` int(11) NOT NULL auto_increment,
  `c_member_id` int(11) NOT NULL default '0',
  `filename` text NOT NULL,
  `filesize` int(11) NOT NULL default '0',
  `filetype` char(3) NOT NULL default '',
  `owner_id` int(11) NOT NULL default '0',
  `comment` text,
  `tags` varchar(64) default NULL,
  `image_data` longblob,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `deleted_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`c_image_diary_id`),
  KEY `c_member_id` (`c_member_id`),
  KEY `filename_owner_id_sub` (`filename`(100),`owner_id`),
  KEY `created_at` (`created_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `c_image_diary_comment`
--

CREATE TABLE IF NOT EXISTS `c_image_diary_comment` (
  `c_image_diary_comment_id` int(11) NOT NULL auto_increment,
  `c_member_id` int(11) NOT NULL default '0',
  `filename` text NOT NULL,
  `filesize` int(11) NOT NULL default '0',
  `filetype` char(3) NOT NULL default '',
  `owner_id` int(11) NOT NULL default '0',
  `comment` text,
  `tags` varchar(64) default NULL,
  `image_data` longblob,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `deleted_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`c_image_diary_comment_id`),
  KEY `c_member_id` (`c_member_id`),
  KEY `filename_owner_id_sub` (`filename`(100),`owner_id`),
  KEY `created_at` (`created_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `c_image_topic_comment`
--

CREATE TABLE IF NOT EXISTS `c_image_topic_comment` (
  `c_image_topic_comment_id` int(11) NOT NULL auto_increment,
  `c_member_id` int(11) NOT NULL default '0',
  `filename` text NOT NULL,
  `filesize` int(11) NOT NULL default '0',
  `filetype` char(3) NOT NULL default '',
  `owner_id` int(11) NOT NULL default '0',
  `comment` text,
  `tags` varchar(64) default NULL,
  `image_data` longblob,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `deleted_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`c_image_topic_comment_id`),
  KEY `c_member_id` (`c_member_id`),
  KEY `filename_owner_id_sub` (`filename`(100),`owner_id`),
  KEY `created_at` (`created_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `c_image_message`
--

CREATE TABLE IF NOT EXISTS `c_image_message` (
  `c_image_message_id` int(11) NOT NULL auto_increment,
  `c_member_id` int(11) NOT NULL default '0',
  `filename` text NOT NULL,
  `filesize` int(11) NOT NULL default '0',
  `filetype` char(3) NOT NULL default '',
  `owner_id` int(11) NOT NULL default '0',
  `comment` text,
  `tags` varchar(64) default NULL,
  `image_data` longblob,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `deleted_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`c_image_message_id`),
  KEY `c_member_id` (`c_member_id`),
  KEY `filename_owner_id_sub` (`filename`(100),`owner_id`),
  KEY `created_at` (`created_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `c_image_profile`
--

CREATE TABLE IF NOT EXISTS `c_image_profile` (
  `c_image_profile_id` int(11) NOT NULL auto_increment,
  `c_member_id` int(11) NOT NULL default '0',
  `filename` text NOT NULL,
  `filesize` int(11) NOT NULL default '0',
  `filetype` char(3) NOT NULL default '',
  `owner_id` int(11) NOT NULL default '0',
  `comment` text,
  `tags` varchar(64) default NULL,
  `image_data` longblob,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `deleted_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`c_image_profile_id`),
  KEY `c_member_id` (`c_member_id`),
  KEY `filename_owner_id_sub` (`filename`(100),`owner_id`),
  KEY `created_at` (`created_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `c_image_topic`
--

CREATE TABLE IF NOT EXISTS `c_image_topic` (
  `c_image_topic_id` int(11) NOT NULL auto_increment,
  `c_member_id` int(11) NOT NULL default '0',
  `filename` text NOT NULL,
  `filesize` int(11) NOT NULL default '0',
  `filetype` char(3) NOT NULL default '',
  `owner_id` int(11) NOT NULL default '0',
  `comment` text,
  `tags` varchar(64) default NULL,
  `image_data` longblob,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `deleted_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`c_image_topic_id`),
  KEY `c_member_id` (`c_member_id`),
  KEY `filename_owner_id_sub` (`filename`(100),`owner_id`),
  KEY `created_at` (`created_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
--
-- テーブルの構造 `c_image_album`
--

CREATE TABLE IF NOT EXISTS `c_image_album` (
  `c_image_album_id` int(11) NOT NULL auto_increment,
  `c_member_id` int(11) NOT NULL default '0',
  `filename` text NOT NULL,
  `filesize` int(11) NOT NULL default '0',
  `filetype` char(3) NOT NULL default '',
  `owner_id` int(11) NOT NULL default '0',
  `comment` text,
  `tags` varchar(64) default NULL,
  `image_data` longblob,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `deleted_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`c_image_album_id`),
  KEY `c_member_id` (`c_member_id`),
  KEY `filename_owner_id_sub` (`filename`(100),`owner_id`),
  KEY `created_at` (`created_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
--
-- テーブルの構造 `c_album`
--

CREATE TABLE IF NOT EXISTS `c_album` (
  `c_album_id` int(11) NOT NULL auto_increment,
  `c_member_id` int(11) NOT NULL default '0',
  `subject` text NOT NULL,
  `body` text NOT NULL ,
  `tags` varchar(64) default NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `deleted_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`c_album_id`),
  KEY `c_member_id` (`c_member_id`),
  KEY `created_at` (`created_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `c_one_word` (
    `c_one_word_id` int(11) NOT NULL auto_increment,
    `c_member_id` int(11) NOT NULL ,
    `comment` text NOT NULL ,
    `r_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
    PRIMARY KEY  (`c_one_word_id`),
    KEY `c_member_id_r_datetime` (`c_member_id`,`r_datetime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `c_admin_information`;

CREATE TABLE IF NOT EXISTS `c_admin_information` (
    `c_admin_information_id` int(11) NOT NULL auto_increment,
    `subject` text NOT NULL,
    `body` text NOT NULL,
    `category` varchar(64) NOT NULL,
    `r_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
    `c_view_flag` tinyint(1) NOT NULL default '0',
    `public_flag` tinyint(1) NOT NULL default '0',
    `view_date` date NOT NULL default '0000-00-00',
    PRIMARY KEY (`c_admin_information_id`),
    KEY `category` (`category`),
    KEY `r_datetime_view_date` (`r_datetime`,`view_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `c_review_category`;
CREATE TABLE IF NOT EXISTS `c_review_category` (
  `c_review_category_id` int(11) NOT NULL auto_increment,
  `category` varchar(100) NOT NULL default '',
  `category_disp` varchar(100) NOT NULL default '',
  `sort_order` int(11) NOT NULL default '0',
  PRIMARY KEY  (`c_review_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `c_review_category` VALUES (1,'Books','和書',1);
INSERT INTO `c_review_category` VALUES (2,'ForeignBooks','洋書',2);
INSERT INTO `c_review_category` VALUES (3,'Music','CDポピュラー',3);
INSERT INTO `c_review_category` VALUES (4,'Classical','CDクラシック',4);
INSERT INTO `c_review_category` VALUES (5,'DVD','DVD',5);
INSERT INTO `c_review_category` VALUES (6,'VideoGames','ゲーム',6);
INSERT INTO `c_review_category` VALUES (7,'Software','ソフトウェア',7);
INSERT INTO `c_review_category` VALUES (8,'Electronics','エレクトロニクス',8);
INSERT INTO `c_review_category` VALUES (9,'Kitchen','キッチン',9);
INSERT INTO `c_review_category` VALUES (10,'Toys','おもちゃ＆ホビー',10);
INSERT INTO `c_review_category` VALUES (11,'SportingGoods','スポーツ',11);
INSERT INTO `c_review_category` VALUES (12,'HealthPersonalCare','ヘルス＆ビューティー',12);
INSERT INTO `c_review_category` VALUES (13,'Watches','時計',13);
INSERT INTO `c_review_category` VALUES (14,'Baby','ベビー＆マタニティ',14);
INSERT INTO `c_review_category` VALUES (15,'Apparel','アパレル＆シューズ',15);

ALTER TABLE `c_access_log` ADD INDEX  `target_commu` (`target_c_commu_id`,`r_datetime`);
ALTER TABLE `c_access_log` ADD INDEX  `target_commu_topic` (`target_c_commu_topic_id`,`r_datetime`);
ALTER TABLE `c_access_log` ADD INDEX  `pagename` (`page_name`);

ALTER TABLE `c_commu` ADD COLUMN `topic_authority_role` tinyint(2) NOT NULL default '0';
ALTER TABLE `c_commu_member` ADD COLUMN `c_commu_topic_admin` TINYINT(1) NOT NULL DEFAULT '0';

ALTER TABLE `c_image` ADD COLUMN `c_member_id` int(11) NOT NULL default '0';
ALTER TABLE `c_image` ADD INDEX `c_member_id` (`c_member_id`);

ALTER TABLE `c_one_word` ADD COLUMN `c_one_word_id_to` int(11) NOT NULL default '0';
ALTER TABLE `c_one_word` ADD INDEX `c_one_word_id_to` (`c_one_word_id_to`);

