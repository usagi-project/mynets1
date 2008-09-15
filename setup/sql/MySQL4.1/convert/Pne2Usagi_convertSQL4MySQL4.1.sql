CREATE TABLE IF NOT EXISTS `c_etsuran` (
 `c_etsuran_id` int(11) NOT NULL auto_increment,
 `c_member_id_from` int(11) NOT NULL default '0',
 `c_diary_id` int(11) NOT NULL default '0',
 `r_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
 PRIMARY KEY  (`c_etsuran_id`),
 KEY `c_member_id_from` (`c_member_id_from`),
 KEY `c_diary_id` (`c_diary_id`),
 KEY `c_member_from_diary_id` (`c_member_id_from`,`c_diary_id`,`r_datetime`)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `c_diary` ADD COLUMN `etsuran_count` int(11) NOT NULL default '0';
ALTER TABLE `c_diary` ADD COLUMN `comment_count` int(11) NOT NULL default '0';
ALTER TABLE `c_diary` ADD COLUMN `e_datetime` datetime NOT NULL default '0000-00-00 00:00:00';
ALTER TABLE `c_diary` ADD INDEX `e_datetime` (`c_member_id`,`e_datetime`);

ALTER TABLE `c_member` ADD COLUMN `is_diary_comment_mail` int(1) NOT NULL default '0';
ALTER TABLE `c_ashiato` ADD COLUMN `is_mobile` varchar(8) NOT NULL default 'pc';
ALTER TABLE `c_diary_comment` ADD COLUMN `comment_number` INT( 11 ) NOT NULL DEFAULT '0';
ALTER TABLE `c_member_secure` ADD COLUMN `pc_address_aes` text NOT NULL DEFAULT '';
ALTER TABLE `c_member_secure` ADD COLUMN `ktai_address_aes` text NOT NULL DEFAULT '';
ALTER TABLE `c_member_secure` ADD COLUMN `regist_address_aes` text NOT NULL DEFAULT '';
ALTER TABLE `c_member_secure` ADD COLUMN `easy_access_id_aes` text NOT NULL DEFAULT '';

CREATE TABLE IF NOT EXISTS `c_ranking` (
  `c_ranking_id` int(11) NOT NULL auto_increment,
  `ranking_date` date NOT NULL,
  `ranking_flag` int(1) NOT NULL,
  `id` int(11) NOT NULL,
  `ranking_count` int(11) NOT NULL,
  PRIMARY KEY  (`c_ranking_id`),
  KEY `ranking_date` (`ranking_date`,`ranking_count`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `c_tags` (
  `c_tags_id` int(11) NOT NULL auto_increment,
  `c_tags_name` varchar(36) NOT NULL ,
  `c_member_id` int(11) NOT NULL default '0',
  `r_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (`c_tags_id`),
  KEY `c_tags_name` (`c_tags_name`),
  KEY `c_member_id` (`c_member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `c_tags` (`c_tags_name`,`c_member_id`) VALUES ('その他','1');

CREATE TABLE IF NOT EXISTS `c_entry_tag` (
  `c_entry_tag_id` int(11) NOT NULL auto_increment,
  `c_entry_id` int(11) NOT NULL default '0',
  `c_entry_flag` tinyint(1) NOT NULL default '0',
  `c_tags_id` int(11) NOT NULL default '0',
  `c_member_id` int(11) NOT NULL default '0',
  `r_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (`c_entry_tag_id`),
  KEY `c_entry_id` (`c_entry_id`),
  KEY `c_entry_id_flag` (`c_entry_id`,`c_entry_flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `c_dengon_comment` (
  `c_dengon_comment_id` int(11) NOT NULL auto_increment,
  `c_member_id_to` int(11) NOT NULL default '0',
  `c_member_id_from` int(11) NOT NULL default '0',
  `body` text NOT NULL,
  `r_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`c_dengon_comment_id`),
  KEY `c_member_id_to` (`c_member_id_to`,`r_datetime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;

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

ALTER TABLE `c_member` ADD `mobile_view` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `c_member` ADD `pc_view` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `c_access_log` ADD `ip_address` varchar(16) NOT NULL DEFAULT '';
ALTER TABLE `c_diary` MODIFY COLUMN public_flag enum('public','friend','private','open') NOT NULL default 'public';
CREATE TABLE IF NOT EXISTS `c_display_view` (
    `c_display_view_id` int(11) NOT NULL auto_increment,
    `c_display_name` varchar(60) NOT NULL,
    `is_pc` tinyint(1) NOT NULL default '0',
    `is_money_flag` int(11) NOT NULL default '0',
    `template_foldername` text NOT NULL,
    PRIMARY KEY (`c_display_view_id`),
    KEY `is_money_flag` (`is_money_flag`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
INSERT INTO `c_display_view` (`c_display_name`,`is_pc`,`is_money_flag`,`template_foldername`) values (
    'ノーマル画面','0','0','') ;
INSERT INTO `c_display_view` (`c_display_name`,`is_pc`,`is_money_flag`,`template_foldername`) values (
    'サムネイル付き画面','0','0','new_templates') ;
INSERT INTO `c_display_view` (`c_display_name`,`is_pc`,`is_money_flag`,`template_foldername`) values (
    'Mixi風画面','1','0','new_templates') ;
    INSERT INTO `c_display_view` (`c_display_name`,`is_pc`,`is_money_flag`,`template_foldername`) values (
    '携帯用ライトページ','0','0','light_templates') ;

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

CREATE TABLE IF NOT EXISTS `c_delete_member_data` (
 `c_delete_member_data_id` int(11) NOT NULL auto_increment,
 `c_member_id` int(11) NOT NULL ,
 `nickname` text NOT NULL,
 `pc_address` text NOT NULL,
 `ktai_address` text NOT NULL,
 `regist_address` text NOT NULL,
 `easy_access_id` text NOT NULL,
 `ip_address` text NOT NULL,
 `user_agent` text NOT NULL,
 `delete_comment` text NOT NULL,
 `delete_flag` tinyint(1) NOT NULL default '0',
 `regist_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
 `delete_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `c_member_id_invite` int(11) NOT NULL,
 PRIMARY KEY  (`c_delete_member_data_id`),
 KEY `ktai_address` (`ktai_address`(100)),
 KEY `pc_address` (`pc_address`(100)),
 KEY `regist_address` (`regist_address`(100)),
 KEY `easy_access_id` (`easy_access_id`(50)),
 KEY `delete_datetime` (`delete_datetime`),
 KEY `regist_datetime` (`regist_datetime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8  ;

CREATE TABLE IF NOT EXISTS `c_version` (
 c_version_id int(11) NOT NULL auto_increment,
 old_version_name text NOT NULL ,
 new_version_name text NOT NULL ,
 r_datetime datetime NOT NULL default '0000-00-00 00:00:00',
 PRIMARY KEY (`c_version_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `c_commu_topic` ADD COLUMN `e_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00';
ALTER TABLE `c_commu_topic` ADD INDEX `e_datetime` (`e_datetime`);
CREATE TABLE IF NOT EXISTS `c_inquiry` (
    `c_inquiry_id` int(11) NOT NULL auto_increment,
    `c_member_id` int(11) NOT NULL ,
    `category_flag` tinyint NOT NULL default '0',
    `body` text NOT NULL,
    `data_id` int(11) NOT NULL default '0',
    `data_flag` int(2) NOT NULL default '0',
    `r_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
    PRIMARY KEY  (`c_inquiry_id`),
    KEY `c_member_id_r_datetime` (`c_member_id`,`r_datetime`),
    KEY `category_flag` (`category_flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `c_image` ADD INDEX `r_datetime` (`r_datetime`);

INSERT INTO `c_siteadmin` VALUES ('', 'o_sns_help', '', NOW());
INSERT INTO `c_siteadmin` VALUES ('', 'h_sns_help', '', NOW());
INSERT INTO `c_siteadmin` VALUES ('', 'inc_side_menu', '<img src="skin/default/img/icon_3.gif" align="absmiddle" style="margin-right:5px"><a href="?m=pc&amp;a=page_h_config_prof" target="_top">プロフィールを設定しましょう</a><br>\r\n<img src="skin/default/img/icon_3.gif" align="absmiddle" style="margin-right:5px"><a href="?m=pc&amp;a=page_h_diary_list_all" target="_top">全体の最新日記をチェック</a><br>', NOW());

ALTER TABLE `c_member` MODIFY COLUMN public_flag_diary enum('open','public','friend','private','open') NOT NULL default 'public';

CREATE TABLE IF NOT EXISTS `c_one_word` (
    `c_one_word_id` int(11) NOT NULL auto_increment,
    `c_member_id` int(11) NOT NULL ,
    `comment` text NOT NULL ,
    `r_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
    PRIMARY KEY  (`c_one_word_id`),
    KEY `c_member_id_r_datetime` (`c_member_id`,`r_datetime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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

ALTER TABLE `c_access_log` ADD INDEX  `target_commu` (`target_c_commu_id`,`r_datetime`);
ALTER TABLE `c_access_log` ADD INDEX  `target_commu_topic` (`target_c_commu_topic_id`,`r_datetime`);
ALTER TABLE `c_access_log` ADD INDEX  `pagename` (`page_name`);

ALTER TABLE `c_commu` ADD COLUMN `topic_authority_role` tinyint(2) NOT NULL default '0';
ALTER TABLE `c_commu_member` ADD COLUMN `c_commu_topic_admin` TINYINT(1) NOT NULL DEFAULT '0';

ALTER TABLE `c_image` ADD COLUMN `c_member_id` int(11) NOT NULL default '0';
ALTER TABLE `c_image` ADD INDEX `c_member_id` (`c_member_id`);

ALTER TABLE `c_one_word` ADD COLUMN `c_one_word_id_to` int(11) NOT NULL default '0';
ALTER TABLE `c_one_word` ADD INDEX `c_one_word_id_to` (`c_one_word_id_to`);

