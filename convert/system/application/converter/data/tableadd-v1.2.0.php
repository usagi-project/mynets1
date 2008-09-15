<?php
//追加されたテーブルの一覧と、そのSQL
$tableaddlist = array(
    'c_tags' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_tags` (
  `c_tags_id` int(11) NOT NULL auto_increment,
  `c_tags_name` varchar(36) NOT NULL ,
  `c_member_id` int(11) NOT NULL default '0',
  `r_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (`c_tags_id`),
  KEY `c_tags_name` (`c_tags_name`),
  KEY `c_member_id` (`c_member_id`)
) ",
            ),

    'c_entry_tag' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_entry_tag` (
  `c_entry_tag_id` int(11) NOT NULL auto_increment,
  `c_entry_id` int(11) NOT NULL default '0',
  `c_entry_flag` tinyint(1) NOT NULL default '0',
  `c_tags_id` int(11) NOT NULL default '0',
  `c_member_id` int(11) NOT NULL default '0',
  `r_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (`c_entry_tag_id`),
  KEY `c_entry_id` (`c_entry_id`),
  KEY `c_entry_id_flag` (`c_entry_id`,`c_entry_flag`)
) ",
            ),

    'c_display_view' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_display_view` (
    `c_display_view_id` int(11) NOT NULL auto_increment,
    `c_display_name` varchar(60) NOT NULL,
    `is_pc` tinyint(1) NOT NULL default '0',
    `is_money_flag` int(11) NOT NULL default '0',
    `template_foldername` text NOT NULL,
    PRIMARY KEY (`c_display_view_id`),
    KEY `is_money_flag` (`is_money_flag`)
)  ",
            ),

    'c_admin_information' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_admin_information` (
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
) ",
            ),

    'c_delete_member_data' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_delete_member_data` (
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
)  ",
            ),

    'c_version' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_version` (
 c_version_id int(11) NOT NULL auto_increment,
 old_version_name text NOT NULL ,
 new_version_name text NOT NULL ,
 r_datetime datetime NOT NULL default '0000-00-00 00:00:00',
 PRIMARY KEY (`c_version_id`)
) ",
            ),

    'c_inquiry' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_inquiry` (
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
) ",
            ),

    'c_one_word' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_one_word` (
    `c_one_word_id` int(11) NOT NULL auto_increment,
    `c_member_id` int(11) NOT NULL ,
    `comment` text NOT NULL ,
    `r_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
    PRIMARY KEY  (`c_one_word_id`),
    KEY `c_member_id_r_datetime` (`c_member_id`,`r_datetime`)
) ",
            ),

    'c_member_data' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_member_data` (
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
) ",
            ),

    'c_get_access' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_get_access` (
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
) ",
            ),

    'c_image_commu' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_image_commu` (
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
) ",
            ),

    'c_image_diary' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_image_diary` (
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
) ",
            ),

    'c_image_diary_comment' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_image_diary_comment` (
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
) ",
            ),

    'c_image_topic_comment' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_image_topic_comment` (
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
) ",
            ),

    'c_image_message' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_image_message` (
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
) ",
            ),

    'c_image_profile' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_image_profile` (
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
) ",
            ),

    'c_image_topic' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_image_topic` (
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
) ",
            ),

    'c_image_album' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_image_album` (
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
) ",
    ),

    'c_album' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_album` (
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
) ",
    ),

    'c_review_category' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_review_category` (
  `c_review_category_id` int(11) NOT NULL auto_increment,
  `category` varchar(100) NOT NULL default '',
  `category_disp` varchar(100) NOT NULL default '',
  `sort_order` int(11) NOT NULL default '0',
  PRIMARY KEY  (`c_review_category_id`)
) ",
    ),

    'c_etsuran' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_etsuran` (
 `c_etsuran_id` int(11) NOT NULL auto_increment,
 `c_member_id_from` int(11) NOT NULL default '0',
 `c_diary_id` int(11) NOT NULL default '0',
 `r_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
 PRIMARY KEY  (`c_etsuran_id`),
 KEY `c_member_id_from` (`c_member_id_from`),
 KEY `c_diary_id` (`c_diary_id`),
 KEY `c_member_from_diary_id` (`c_member_id_from`,`c_diary_id`,`r_datetime`)
) ",
    ),

    'c_dengon_comment' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_dengon_comment` (
  `c_dengon_comment_id` int(11) NOT NULL auto_increment,
  `c_member_id_to` int(11) NOT NULL default '0',
  `c_member_id_from` int(11) NOT NULL default '0',
  `body` text NOT NULL,
  `r_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`c_dengon_comment_id`),
  KEY `c_member_id_to` (`c_member_id_to`,`r_datetime`)
) ",
    ),

    'c_ranking' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_ranking` (
  `c_ranking_id` int(11) NOT NULL auto_increment,
  `ranking_date` date NOT NULL,
  `ranking_flag` int(1) NOT NULL,
  `id` int(11) NOT NULL,
  `ranking_count` int(11) NOT NULL,
  PRIMARY KEY  (`c_ranking_id`),
  KEY `ranking_date` (`ranking_date`,`ranking_count`)
) ",
    ),

    //2008-08-29 OpenPNE2.10からコンバートする場合、c_sns_configがないものがある
    //すでにある場合はスキップするのでOK
        'c_sns_config' => array(
                'sql' => "CREATE TABLE IF NOT EXISTS `" .MYNETS_PREFIX_NAME. "c_sns_config` (
  `c_sns_config_id` int(11) NOT NULL auto_increment,
  `key_name` varchar(100) NOT NULL default '',
  `border_00` text NOT NULL,
  `border_01` text NOT NULL,
  `border_02` text NOT NULL,
  `border_03` text NOT NULL,
  `border_04` text NOT NULL,
  `border_05` text NOT NULL,
  `border_06` text NOT NULL,
  `border_07` text NOT NULL,
  `border_08` text NOT NULL,
  `border_09` text NOT NULL,
  `border_10` text NOT NULL,
  `bg_00` text NOT NULL,
  `bg_01` text NOT NULL,
  `bg_02` text NOT NULL,
  `bg_03` text NOT NULL,
  `bg_04` text NOT NULL,
  `bg_05` text NOT NULL,
  `bg_06` text NOT NULL,
  `bg_07` text NOT NULL,
  `bg_08` text NOT NULL,
  `bg_09` text NOT NULL,
  `bg_10` text NOT NULL,
  `bg_11` text NOT NULL,
  `bg_12` text NOT NULL,
  `bg_13` text NOT NULL,
  `caption` varchar(100) NOT NULL default '',
  `symbol` text NOT NULL,
  PRIMARY KEY  (`c_sns_config_id`)
) ",
    ),


);
?>
