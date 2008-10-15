手動で実行する場合のバージョンアップ、コンバートについて

DB のテーブルにプレフィックス(PREFIX)を設定している場合は、
手動でテーブル名に PREFIX を追加してから実行してください。

次の種類があります。
１）日記のコメント数の調整。
２）日記のコメントの番号調整
３）あしあと数の調整
４）トピックの更新日付を調整
５）c_imageテーブルにc_member_idをセットする
６）過去のバージョンから追加されたインデックス

OpenPNEからのコンバートで必要なのはすべてです。
ただし、DBがあまりに大きい場合、実行に相当の時間がかかる可能性があります。
MyNETSのバージョンアップにおいては、
２）コメント番号の調整（1.1.0からの場合。1.1.1では実装されています）
４）トピックの更新日付を調整（1.1.0からの場合。1.1.1では実装されています）
５）c_imageテーブルにc_member_idをセットする
が必要となります。
この部分が一番データが大きく、実行に負荷がかかります。
phpmyadminで実行した場合でも途中でメモリ不足で止まる可能性があります。
SSHなどで接続できる場合は、SSHで接続し、sqlコマンドで実行してください。

DBトータル５００M程度であれば実行できることを確認しています。
１Gを超えている場合はサーバーの設定状況によって左右されます。

インデックスの追加においては、すでに実行されている場合はエラーが出ます。
phpmyadminで確認しながらインデックスを調べて実行してください。
※仮にすでにあるインデックスを実行しても影響はありません。

最後にバージョンアップした日付と日時を保存するSQLを実行して終了となります。

↓↓ここから下のSQLを確認しながら実行するようにしてください。↓↓

--
-- 日記コメント処理

CREATE TABLE `convert_diary_commentno_tmp` (
    `c_diary_id` int(11) NOT NULL ,
    `comment_number` int(11) NOT NULL auto_increment,
    `c_diary_comment_id` int(11) NOT NULL,
    primary key (`c_diary_id`,`comment_number`)
);

INSERT INTO `convert_diary_commentno_tmp`
    SELECT c_diary_id,0,c_diary_comment_id FROM `c_diary_comment`
    ORDER BY r_datetime;

UPDATE `c_diary_comment` as c,`convert_diary_commentno_tmp` as t SET c.comment_number = t.comment_number
    WHERE c.c_diary_comment_id = t.c_diary_comment_id ;

DROP TABLE convert_diary_commentno_tmp;
OPTIMIZE TABLE `c_diary_comment` ;
--

--
-- 日記のコメント数を計算し、更新日付を最新のコメントの日付とする
--

CREATE TABLE `convert_diary_commentno_max_tmp` (
    `c_diary_id` int(11) NOT NULL ,
    `comment_count` int(11) NOT NULL,
    `e_datetime` datetime
);

INSERT INTO `convert_diary_commentno_max_tmp`
    SELECT c_diary_id,max(comment_number),max(r_datetime)
    FROM `c_diary_comment`
    GROUP BY c_diary_id;

UPDATE c_diary as c, convert_diary_commentno_max_tmp as t
    SET c.comment_count = t.comment_count,
    c.e_datetime = t.e_datetime
    WHERE c.c_diary_id = t.c_diary_id;

DROP TABLE convert_diary_commentno_max_tmp;

OPTIMIZE TABLE `c_diary`;
--

--
-- 足跡数を計算し、c_memberにデータを保持する
--

CREATE TABLE `convert_ashiato_count_tmp` (
    `c_member_id` int(11) NOT NULL ,
    `ashiato_count` int(11) NOT NULL
);

INSERT INTO convert_ashiato_count_tmp
    SELECT c_member_id_to,count(c_ashiato_id)
    FROM `c_ashiato`
    GROUP BY c_member_id_to;

UPDATE c_member as c, convert_ashiato_count_tmp as t
    SET c.ashiato_count_log = c.ashiato_count_log + t.ashiato_count
    WHERE c.c_member_id = t.c_member_id;

DROP TABLE convert_ashiato_count_tmp;

OPTIMIZE TABLE `c_member`;

--
-- トピックの更新日付を調整する
--

CREATE TABLE `convert_topic_edatetime_tmp` (
    `id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
    `c_commu_topic_id` INT( 11 ) NOT NULL DEFAULT '0',
    `e_datetime` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY ( `id` )
);

INSERT INTO convert_topic_edatetime_tmp
    SELECT '', c.c_commu_topic_id, MAX(c.r_datetime)
    FROM `c_commu_topic_comment` as c, `c_commu_topic` as b
    WHERE c.c_commu_topic_id = b.c_commu_topic_id
    GROUP BY c.c_commu_topic_id;

UPDATE `c_commu_topic` as c,`convert_topic_edatetime_tmp` as t
    SET c.e_datetime = t.e_datetime
    WHERE c.c_commu_topic_id = t.c_commu_topic_id;

DROP TABLE `convert_topic_edatetime_tmp`;

OPTIMIZE TABLE `c_commu_topic`;

--
-- c_imageテーブルにc_member_idをセットする
--

CREATE TABLE `image_convert_tmp` (
    c_member_id int(11) NOT NULL default '0',
    table_name varchar(32) NOT NULL default '',
    key_id int(11) NOT NULL default '0',
    filename text NOT NULL,
    c_image_id int(11) NOT null,
    key `c_image_id` (`c_image_id`)
);

INSERT INTO `image_convert_tmp` SELECT 0,'c_diary',0,filename,c_image_id
    FROM c_image WHERE left(filename,2) = 'd_';

INSERT INTO `image_convert_tmp` SELECT 0,'c_diary_comment',0,filename,c_image_id
    FROM c_image WHERE left(filename,2) = 'dc';

INSERT INTO `image_convert_tmp` SELECT 0,'c_message',0,filename,c_image_id
    FROM c_image WHERE left(filename,2) = 'ms';

INSERT INTO `image_convert_tmp` SELECT 0,'c_commu_topic',0,filename,c_image_id
    FROM c_image WHERE left(filename,2) = 't_';

INSERT INTO `image_convert_tmp` SELECT 0,'c_commu_topic_comment',0,filename,c_image_id
    FROM c_image WHERE left(filename,3) = 'tc_';

INSERT INTO `image_convert_tmp` SELECT 0,'c_commu',0,filename,c_image_id
    FROM c_image WHERE left(filename,2) = 'c_';

INSERT INTO `image_convert_tmp` SELECT 0,'c_member',0,filename,c_image_id
    FROM c_image WHERE left(filename,2) = 'm_';

ALTER TABLE `c_diary` ADD INDEX ( `image_filename_1` ( 64 ));
ALTER TABLE `c_diary` ADD INDEX ( `image_filename_2` ( 64 ));
ALTER TABLE `c_diary` ADD INDEX ( `image_filename_3` ( 64 ));

ALTER TABLE `c_diary_comment` ADD INDEX ( `image_filename_1` ( 64 ));
ALTER TABLE `c_diary_comment` ADD INDEX ( `image_filename_2` ( 64 ));
ALTER TABLE `c_diary_comment` ADD INDEX ( `image_filename_3` ( 64 ));

ALTER TABLE `c_message` ADD INDEX ( `image_filename_1` ( 64 ));
ALTER TABLE `c_message` ADD INDEX ( `image_filename_2` ( 64 ));
ALTER TABLE `c_message` ADD INDEX ( `image_filename_3` ( 64 ));

ALTER TABLE `c_commu_topic_comment` ADD INDEX ( `image_filename1` ( 64 ));
ALTER TABLE `c_commu_topic_comment` ADD INDEX ( `image_filename2` ( 64 ));
ALTER TABLE `c_commu_topic_comment` ADD INDEX ( `image_filename3` ( 64 ));

ALTER TABLE `c_commu` ADD INDEX ( `image_filename` ( 64 ));

ALTER TABLE `c_member` ADD INDEX ( `image_filename_1` ( 64 ));
ALTER TABLE `c_member` ADD INDEX ( `image_filename_2` ( 64 ));
ALTER TABLE `c_member` ADD INDEX ( `image_filename_3` ( 64 ));

UPDATE image_convert_tmp as t,c_diary as c
    SET t.c_member_id = c.c_member_id,t.key_id = c.c_diary_id
    WHERE t.filename = c.image_filename_1;

UPDATE image_convert_tmp as t,c_diary as c
    SET t.c_member_id = c.c_member_id,t.key_id = c.c_diary_id
    WHERE t.filename = c.image_filename_2;

UPDATE image_convert_tmp as t,c_diary as c
    SET t.c_member_id = c.c_member_id,t.key_id = c.c_diary_id
    WHERE t.filename = c.image_filename_3;

UPDATE image_convert_tmp as t,c_diary_comment as c
    SET t.c_member_id = c.c_member_id,t.key_id = c.c_diary_comment_id
    WHERE t.filename = c.image_filename_1;

UPDATE image_convert_tmp as t,c_diary_comment as c
    SET t.c_member_id = c.c_member_id,t.key_id = c.c_diary_comment_id
    WHERE t.filename = c.image_filename_2;

UPDATE image_convert_tmp as t,c_diary_comment as c
    SET t.c_member_id = c.c_member_id,t.key_id = c.c_diary_comment_id
    WHERE t.filename = c.image_filename_3;

UPDATE image_convert_tmp as t,c_message as c
    SET t.c_member_id = c.c_member_id_from,t.key_id = c.c_message_id
    WHERE t.filename = c.image_filename_1;

UPDATE image_convert_tmp as t,c_message as c
    SET t.c_member_id = c.c_member_id_from,t.key_id = c.c_message_id
    WHERE t.filename = c.image_filename_2;

UPDATE image_convert_tmp as t,c_message as c
    SET t.c_member_id = c.c_member_id_from,t.key_id = c.c_message_id
    WHERE t.filename = c.image_filename_3;

UPDATE image_convert_tmp as t,c_commu_topic_comment as c
    SET t.c_member_id = c.c_member_id,t.key_id = c.c_commu_topic_comment_id
    WHERE t.filename = c.image_filename1;

UPDATE image_convert_tmp as t,c_commu_topic_comment as c
    SET t.c_member_id = c.c_member_id,t.key_id = c.c_commu_topic_comment_id
    WHERE t.filename = c.image_filename2;

UPDATE image_convert_tmp as t,c_commu_topic_comment as c
    SET t.c_member_id = c.c_member_id,t.key_id = c.c_commu_topic_comment_id
    WHERE t.filename = c.image_filename3;

UPDATE image_convert_tmp as t,c_commu as c
    SET t.c_member_id = c.c_member_id_admin,t.key_id = c.c_commu_id
    WHERE t.filename = c.image_filename;


UPDATE image_convert_tmp as t,c_member as c
    SET t.c_member_id = c.c_member_id,t.key_id = c.c_member_id
    WHERE t.filename = c.image_filename_1;

UPDATE image_convert_tmp as t,c_member as c
    SET t.c_member_id = c.c_member_id,t.key_id = c.c_member_id
    WHERE t.filename = c.image_filename_2;

UPDATE image_convert_tmp as t,c_member as c
    SET t.c_member_id = c.c_member_id,t.key_id = c.c_member_id
    WHERE t.filename = c.image_filename_3;



UPDATE c_image as c,image_convert_tmp as t
    SET c.c_member_id = t.c_member_id
    WHERE c.c_image_id = t.c_image_id;


ALTER TABLE `c_diary`
    DROP INDEX `image_filename_1`,
    DROP INDEX `image_filename_2`,
    DROP INDEX `image_filename_3`;

ALTER TABLE `c_diary_comment`
    DROP INDEX `image_filename_1`,
    DROP INDEX `image_filename_2`,
    DROP INDEX `image_filename_3`;

ALTER TABLE `c_message`
    DROP INDEX `image_filename_1`,
    DROP INDEX `image_filename_2`,
    DROP INDEX `image_filename_3`;

ALTER TABLE `c_commu_topic_comment`
    DROP INDEX `image_filename1`,
    DROP INDEX `image_filename2`,
    DROP INDEX `image_filename3`;

ALTER TABLE `c_commu`
    DROP INDEX `image_filename`;

ALTER TABLE `c_member`
    DROP INDEX `image_filename_1`,
    DROP INDEX `image_filename_2`,
    DROP INDEX `image_filename_3`;

DROP TABLE image_convert_tmp ;

-- インデックスの追加処理　重複した場合はDuplicate key nameがでるのでスキップする

ALTER TABLE `c_commu_topic` ADD INDEX `e_datetime` (`e_datetime`);

ALTER TABLE `c_image` ADD INDEX `r_datetime` (`r_datetime`);

ALTER TABLE `c_diary` ADD INDEX `e_datetime` (`c_member_id`,`e_datetime`);

ALTER TABLE `c_access_log` ADD INDEX `target_commu` (`target_c_commu_id`,`r_datetime`);
ALTER TABLE `c_access_log` ADD INDEX `target_commu_topic` (`target_c_commu_topic_id`,`r_datetime`);

ALTER TABLE `c_access_log` ADD INDEX `pagename` (`page_name`);

ALTER TABLE `c_image` ADD INDEX `c_member_id` (`c_member_id`);

ALTER TABLE `c_one_word` ADD INDEX `c_one_word_id_to` (`c_one_word_id_to`);

-- バージョン番号を合わせるためのSQL
INSERT INTO `c_version` (old_version_name,new_version_name,r_datetime)
    VALUES  ('','v1.2.0',NOW() );



