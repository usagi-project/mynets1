
INSERT INTO `c_commu_category` VALUES (1,'地域情報',100,1);
INSERT INTO `c_commu_category` VALUES (2,'グルメスポット',200,1);
INSERT INTO `c_commu_category` VALUES (3,'趣味',300,1);

-- --------------------------------------------------------

INSERT INTO `c_commu_category_parent` VALUES (1,'コミュニティカテゴリ',1);
-- --------------------------------------------------------

INSERT INTO `c_member` VALUES (1,'Usagiちゃん',0,1,1,'private','','','','',NOW(),NOW(),'',0,1,1,1,0,1,'public',0,0,0,0,0,0);

-- --------------------------------------------------------

INSERT INTO `c_password_query` VALUES (1,'母または父の旧姓は?');
INSERT INTO `c_password_query` VALUES (2,'運転免許証番号の下 5 桁は?');
INSERT INTO `c_password_query` VALUES (3,'初恋の人の名前は?');
INSERT INTO `c_password_query` VALUES (4,'卒業した小学校の名前は？');
INSERT INTO `c_password_query` VALUES (5,'本籍地の県名は？');

-- --------------------------------------------------------

INSERT INTO `c_profile` VALUES (1,'sex','性別',0,0,'public','select',200,0,1,1,'string','',0,0);
INSERT INTO `c_profile` VALUES (2,'blood_type','血液型',0,1,'public','select',300,0,1,1,'string','',0,0);
INSERT INTO `c_profile` VALUES (3,'pre_addr_pref','現住所',0,1,'public','select',400,0,1,1,'string','',0,0);
INSERT INTO `c_profile` VALUES (4,'old_addr_pref','出身地',0,1,'public','select',500,0,1,1,'string','',0,0);
INSERT INTO `c_profile` VALUES (5,'self_intro','自己紹介',0,0,'public','textarea',600,0,1,1,'string','',0,0);

-- --------------------------------------------------------

INSERT INTO `c_profile_option` VALUES (1,1,'男性',1);
INSERT INTO `c_profile_option` VALUES (2,1,'女性',2);
INSERT INTO `c_profile_option` VALUES (3,2,'A',1);
INSERT INTO `c_profile_option` VALUES (4,2,'B',2);
INSERT INTO `c_profile_option` VALUES (5,2,'O',3);
INSERT INTO `c_profile_option` VALUES (6,2,'AB',4);
INSERT INTO `c_profile_option` VALUES (7,3,'北海道',1);
INSERT INTO `c_profile_option` VALUES (8,3,'青森県',2);
INSERT INTO `c_profile_option` VALUES (9,3,'岩手県',3);
INSERT INTO `c_profile_option` VALUES (10,3,'宮城県',4);
INSERT INTO `c_profile_option` VALUES (11,3,'秋田県',5);
INSERT INTO `c_profile_option` VALUES (12,3,'山形県',6);
INSERT INTO `c_profile_option` VALUES (13,3,'福島県',7);
INSERT INTO `c_profile_option` VALUES (14,3,'茨城県',8);
INSERT INTO `c_profile_option` VALUES (15,3,'栃木県',9);
INSERT INTO `c_profile_option` VALUES (16,3,'群馬県',10);
INSERT INTO `c_profile_option` VALUES (17,3,'埼玉県',11);
INSERT INTO `c_profile_option` VALUES (18,3,'千葉県',12);
INSERT INTO `c_profile_option` VALUES (19,3,'東京都',13);
INSERT INTO `c_profile_option` VALUES (20,3,'神奈川県',14);
INSERT INTO `c_profile_option` VALUES (21,3,'新潟県',15);
INSERT INTO `c_profile_option` VALUES (22,3,'富山県',16);
INSERT INTO `c_profile_option` VALUES (23,3,'石川県',17);
INSERT INTO `c_profile_option` VALUES (24,3,'福井県',18);
INSERT INTO `c_profile_option` VALUES (25,3,'山梨県',19);
INSERT INTO `c_profile_option` VALUES (26,3,'長野県',20);
INSERT INTO `c_profile_option` VALUES (27,3,'岐阜県',21);
INSERT INTO `c_profile_option` VALUES (28,3,'静岡県',22);
INSERT INTO `c_profile_option` VALUES (29,3,'愛知県',23);
INSERT INTO `c_profile_option` VALUES (30,3,'三重県',24);
INSERT INTO `c_profile_option` VALUES (31,3,'滋賀県',25);
INSERT INTO `c_profile_option` VALUES (32,3,'京都府',26);
INSERT INTO `c_profile_option` VALUES (33,3,'大阪府',27);
INSERT INTO `c_profile_option` VALUES (34,3,'兵庫県',28);
INSERT INTO `c_profile_option` VALUES (35,3,'奈良県',29);
INSERT INTO `c_profile_option` VALUES (36,3,'和歌山県',30);
INSERT INTO `c_profile_option` VALUES (37,3,'鳥取県',31);
INSERT INTO `c_profile_option` VALUES (38,3,'島根県',32);
INSERT INTO `c_profile_option` VALUES (39,3,'岡山県',33);
INSERT INTO `c_profile_option` VALUES (40,3,'広島県',34);
INSERT INTO `c_profile_option` VALUES (41,3,'山口県',35);
INSERT INTO `c_profile_option` VALUES (42,3,'徳島県',36);
INSERT INTO `c_profile_option` VALUES (43,3,'香川県',37);
INSERT INTO `c_profile_option` VALUES (44,3,'愛媛県',38);
INSERT INTO `c_profile_option` VALUES (45,3,'高知県',39);
INSERT INTO `c_profile_option` VALUES (46,3,'福岡県',40);
INSERT INTO `c_profile_option` VALUES (47,3,'佐賀県',41);
INSERT INTO `c_profile_option` VALUES (48,3,'長崎県',42);
INSERT INTO `c_profile_option` VALUES (49,3,'熊本県',43);
INSERT INTO `c_profile_option` VALUES (50,3,'大分県',44);
INSERT INTO `c_profile_option` VALUES (51,3,'宮崎県',45);
INSERT INTO `c_profile_option` VALUES (52,3,'鹿児島県',46);
INSERT INTO `c_profile_option` VALUES (53,3,'沖縄県',47);
INSERT INTO `c_profile_option` VALUES (54,3,'その他',48);
INSERT INTO `c_profile_option` VALUES (55,4,'北海道',1);
INSERT INTO `c_profile_option` VALUES (56,4,'青森県',2);
INSERT INTO `c_profile_option` VALUES (57,4,'岩手県',3);
INSERT INTO `c_profile_option` VALUES (58,4,'宮城県',4);
INSERT INTO `c_profile_option` VALUES (59,4,'秋田県',5);
INSERT INTO `c_profile_option` VALUES (60,4,'山形県',6);
INSERT INTO `c_profile_option` VALUES (61,4,'福島県',7);
INSERT INTO `c_profile_option` VALUES (62,4,'茨城県',8);
INSERT INTO `c_profile_option` VALUES (63,4,'栃木県',9);
INSERT INTO `c_profile_option` VALUES (64,4,'群馬県',10);
INSERT INTO `c_profile_option` VALUES (65,4,'埼玉県',11);
INSERT INTO `c_profile_option` VALUES (66,4,'千葉県',12);
INSERT INTO `c_profile_option` VALUES (67,4,'東京都',13);
INSERT INTO `c_profile_option` VALUES (68,4,'神奈川県',14);
INSERT INTO `c_profile_option` VALUES (69,4,'新潟県',15);
INSERT INTO `c_profile_option` VALUES (70,4,'富山県',16);
INSERT INTO `c_profile_option` VALUES (71,4,'石川県',17);
INSERT INTO `c_profile_option` VALUES (72,4,'福井県',18);
INSERT INTO `c_profile_option` VALUES (73,4,'山梨県',19);
INSERT INTO `c_profile_option` VALUES (74,4,'長野県',20);
INSERT INTO `c_profile_option` VALUES (75,4,'岐阜県',21);
INSERT INTO `c_profile_option` VALUES (76,4,'静岡県',22);
INSERT INTO `c_profile_option` VALUES (77,4,'愛知県',23);
INSERT INTO `c_profile_option` VALUES (78,4,'三重県',24);
INSERT INTO `c_profile_option` VALUES (79,4,'滋賀県',25);
INSERT INTO `c_profile_option` VALUES (80,4,'京都府',26);
INSERT INTO `c_profile_option` VALUES (81,4,'大阪府',27);
INSERT INTO `c_profile_option` VALUES (82,4,'兵庫県',28);
INSERT INTO `c_profile_option` VALUES (83,4,'奈良県',29);
INSERT INTO `c_profile_option` VALUES (84,4,'和歌山県',30);
INSERT INTO `c_profile_option` VALUES (85,4,'鳥取県',31);
INSERT INTO `c_profile_option` VALUES (86,4,'島根県',32);
INSERT INTO `c_profile_option` VALUES (87,4,'岡山県',33);
INSERT INTO `c_profile_option` VALUES (88,4,'広島県',34);
INSERT INTO `c_profile_option` VALUES (89,4,'山口県',35);
INSERT INTO `c_profile_option` VALUES (90,4,'徳島県',36);
INSERT INTO `c_profile_option` VALUES (91,4,'香川県',37);
INSERT INTO `c_profile_option` VALUES (92,4,'愛媛県',38);
INSERT INTO `c_profile_option` VALUES (93,4,'高知県',39);
INSERT INTO `c_profile_option` VALUES (94,4,'福岡県',40);
INSERT INTO `c_profile_option` VALUES (95,4,'佐賀県',41);
INSERT INTO `c_profile_option` VALUES (96,4,'長崎県',42);
INSERT INTO `c_profile_option` VALUES (97,4,'熊本県',43);
INSERT INTO `c_profile_option` VALUES (98,4,'大分県',44);
INSERT INTO `c_profile_option` VALUES (99,4,'宮崎県',45);
INSERT INTO `c_profile_option` VALUES (100,4,'鹿児島県',46);
INSERT INTO `c_profile_option` VALUES (101,4,'沖縄県',47);
INSERT INTO `c_profile_option` VALUES (102,4,'その他',48);

INSERT INTO `c_profile_pref` VALUES (1,'北海道',1,43.068612,141.350768,7);
INSERT INTO `c_profile_pref` VALUES (2,'青森県',2,40.828668,140.734738,7);
INSERT INTO `c_profile_pref` VALUES (3,'岩手県',3,39.701547,141.136599,7);
INSERT INTO `c_profile_pref` VALUES (4,'宮城県',4,38.260027,140.882158,7);
INSERT INTO `c_profile_pref` VALUES (5,'秋田県',5,39.716748,140.129931,7);
INSERT INTO `c_profile_pref` VALUES (6,'山形県',6,38.248098,140.327253,7);
INSERT INTO `c_profile_pref` VALUES (7,'福島県',7,37.754123,140.45968,7);
INSERT INTO `c_profile_pref` VALUES (8,'茨城県',8,36.370911,140.47676,7);
INSERT INTO `c_profile_pref` VALUES (9,'栃木県',9,36.559246,139.898389,7);
INSERT INTO `c_profile_pref` VALUES (10,'群馬県',10,36.383399,139.072833,7);
INSERT INTO `c_profile_pref` VALUES (11,'埼玉県',11,35.906439,139.62405,7);
INSERT INTO `c_profile_pref` VALUES (12,'千葉県',12,35.613425,140.112837,7);
INSERT INTO `c_profile_pref` VALUES (13,'東京都',13,35.681391,139.766103,7);
INSERT INTO `c_profile_pref` VALUES (14,'神奈川県',14,35.465941,139.622847,7);
INSERT INTO `c_profile_pref` VALUES (15,'新潟県',15,37.912299,139.060869,7);
INSERT INTO `c_profile_pref` VALUES (16,'富山県',16,36.701384,137.213091,7);
INSERT INTO `c_profile_pref` VALUES (17,'石川県',17,36.578117,136.648166,7);
INSERT INTO `c_profile_pref` VALUES (18,'福井県',18,36.061479,136.223261,7);
INSERT INTO `c_profile_pref` VALUES (19,'山梨県',19,35.667054,138.569015,7);
INSERT INTO `c_profile_pref` VALUES (20,'長野県',20,36.643307,138.189101,7);
INSERT INTO `c_profile_pref` VALUES (21,'岐阜県',21,35.409967,136.756324,7);
INSERT INTO `c_profile_pref` VALUES (22,'静岡県',22,34.971629,138.388579,7);
INSERT INTO `c_profile_pref` VALUES (23,'愛知県',23,35.170694,136.881637,7);
INSERT INTO `c_profile_pref` VALUES (24,'三重県',24,34.734418,136.510581,7);
INSERT INTO `c_profile_pref` VALUES (25,'滋賀県',25,35.002997,135.864651,7);
INSERT INTO `c_profile_pref` VALUES (26,'京都府',26,34.985705,135.758228,7);
INSERT INTO `c_profile_pref` VALUES (27,'大阪府',27,34.702398,135.495188,7);
INSERT INTO `c_profile_pref` VALUES (28,'兵庫県',28,34.679453,135.178221,7);
INSERT INTO `c_profile_pref` VALUES (29,'奈良県',29,34.680482,135.818935,7);
INSERT INTO `c_profile_pref` VALUES (30,'和歌山県',30,34.232436,135.191454,7);
INSERT INTO `c_profile_pref` VALUES (31,'鳥取県',31,35.493953,134.225901,7);
INSERT INTO `c_profile_pref` VALUES (32,'島根県',32,35.463947,133.063871,7);
INSERT INTO `c_profile_pref` VALUES (33,'岡山県',33,34.666572,133.918552,7);
INSERT INTO `c_profile_pref` VALUES (34,'広島県',34,34.397446,132.475593,7);
INSERT INTO `c_profile_pref` VALUES (35,'山口県',35,34.172649,131.48061,7);
INSERT INTO `c_profile_pref` VALUES (36,'徳島県',36,34.074572,134.551391,7);
INSERT INTO `c_profile_pref` VALUES (37,'香川県',37,34.350754,134.046821,7);
INSERT INTO `c_profile_pref` VALUES (38,'愛媛県',38,33.839954,132.751149,7);
INSERT INTO `c_profile_pref` VALUES (39,'高知県',39,33.566758,133.543522,7);
INSERT INTO `c_profile_pref` VALUES (40,'福岡県',40,33.590002,130.420622,7);
INSERT INTO `c_profile_pref` VALUES (41,'佐賀県',41,33.264212,130.297608,7);
INSERT INTO `c_profile_pref` VALUES (42,'長崎県',42,32.753085,129.870515,7);
INSERT INTO `c_profile_pref` VALUES (43,'熊本県',43,32.789207,130.688499,7);
INSERT INTO `c_profile_pref` VALUES (44,'大分県',44,33.232794,131.606595,7);
INSERT INTO `c_profile_pref` VALUES (45,'宮崎県',45,31.915323,131.432083,7);
INSERT INTO `c_profile_pref` VALUES (46,'鹿児島県',46,31.602098,130.564112,7);
INSERT INTO `c_profile_pref` VALUES (47,'沖縄県',47,26.212401,127.680932,7);
INSERT INTO `c_profile_pref` VALUES (50,'その他',50,0,0,0);
-- --------------------------------------------------------

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
-- --------------------------------------------------------

INSERT INTO `c_siteadmin` VALUES (1,'inc_page_footer_before','<a href=\"?m=pc&amp;a=page_o_sns_kiyaku\" target=\"_blank\">利用規約</a> <a href=\"?m=pc&amp;a=page_o_sns_privacy\" target=\"_blank\">プライバシーポリシー</a> <a href=\"?m=pc&amp;a=page_o_sns_help\" target=\"_blank\">ヘルプ</a> <a href=\"http://usagi.mynets.jp/\" target=\"_blank\">Usagi Projectとは</a>',NOW());
INSERT INTO `c_siteadmin` VALUES (2,'inc_page_footer_after','<a href=\"?m=pc&amp;a=page_o_sns_kiyaku\" target=\"_blank\">利用規約</a> <a href=\"?m=pc&amp;a=page_o_sns_privacy\" target=\"_blank\">プライバシーポリシー</a> <a href=\"?m=pc&amp;a=page_h_sns_help\" target=\"_top\">ヘルプ</a>',NOW());
INSERT INTO `c_siteadmin` VALUES (3,'inc_custom_css','/**フォント色変更**/\n\n/*リンク関連*/\na:link    { color: #026CD1; }\na:visited { color: #004A95; }\na:hover   { color: #76AFE6; }\na:active  { color: #76AFE6; }\n\n/*コンテンツ見出しlv1*/\ntd.bg_06 span.b_b,\n.c_00 { color: #222222; }\n\n/*コンテンツ見出しlv2*/\n.c_01 { color: #444444; }\n\n/*強調文字暖色*/\n.c_02 { color: #D92C49; }\n\n/*強調文字寒色*/\n.c_03 { color: #2C65D9; }\n\n/*その他文字色*/\nbody { color: #000000; }',NOW());
INSERT INTO `c_siteadmin` VALUES ('4', 'o_sns_help', '', NOW());
INSERT INTO `c_siteadmin` VALUES ('5', 'h_sns_help', '', NOW());
INSERT INTO `c_siteadmin` VALUES ('6', 'inc_side_menu', '<img src="skin/default/img/icon_3.gif" align="absmiddle" style="margin-right:5px"><a href="?m=pc&amp;a=page_h_config_prof" target="_top">プロフィールを設定しましょう</a><br>\r\n<img src="skin/default/img/icon_3.gif" align="absmiddle" style="margin-right:5px"><a href="?m=pc&amp;a=page_h_diary_list_all" target="_top">全体の最新日記をチェック</a><br>', NOW());

-- --------------------------------------------------------

INSERT INTO `c_skin_filename` VALUES (1,'no_image','skin_no_image.gif');
INSERT INTO `c_skin_filename` VALUES (2,'no_logo','skin_no_logo.gif');
INSERT INTO `c_skin_filename` VALUES (3,'no_logo_small','skin_no_logo_small.gif');

-- --------------------------------------------------------

INSERT INTO `c_sns_config` VALUES (1,'default','FFFFFF','B7B9C6','FFFFFF','FFFFFF','FFFFFF','FFFFFF','FFFFFF','B7B9C6','FFFFFF','FFFFFF','FFFFFF','FFFFFF','B7B9C6','FFFFFF','FFFFFF','B7B9C6','FFFFFF','B7B9C6','B7B9C6','FFFFFF','FFFFFF','B7B9C6','C1C6CF','FFFFFF','E9EAF0','戻す','E9EAF0');
INSERT INTO `c_sns_config` VALUES (2,'red','FFFFFF','DCAA9D','FFFFFF','FFFFFF','FFFFFF','FFFFFF','FFFFFF','DCAA9D','FFFFFF','FFFFFF','FFFFFF','FFFFFF','DCAA9D','FFFFFF','FFFFFF','DCAA9D','FFFFFF','DCAA9D','DCAA9D','FFFFFF','FFFFFF','DCAA9D','E5A6A6','FFFFFF','FAE1DB','赤','E66161');
INSERT INTO `c_sns_config` VALUES (3,'yellow','FFFFFF','E9DC90','FFFFFF','FFFFFF','FFFFFF','FFFFFF','FFFFFF','E9DC90','FFFFFF','FFFFFF','FFFFFF','FFFFFF','E9DC90','FFFFFF','FFFFFF','E9DC90','FFFFFF','E9DC90','E9DC90','FFFFFF','FFFFFF','E9DC90','F2D299','FFFFFF','FFF9D6','黄色','FFDE1E');
INSERT INTO `c_sns_config` VALUES (4,'green','FFFFFF','AEDC9D','FFFFFF','FFFFFF','FFFFFF','FFFFFF','FFFFFF','AEDC9D','FFFFFF','FFFFFF','FFFFFF','FFFFFF','AEDC9D','FFFFFF','FFFFFF','AEDC9D','FFFFFF','AEDC9D','AEDC9D','FFFFFF','FFFFFF','AEDC9D','C5E5A6','FFFFFF','E3FADB','緑','6FDD46');
INSERT INTO `c_sns_config` VALUES (5,'gold','FFFFFF','C6C4B7','FFFFFF','FFFFFF','FFFFFF','FFFFFF','FFFFFF','C6C4B7','FFFFFF','FFFFFF','FFFFFF','FFFFFF','C6C4B7','FFFFFF','FFFFFF','C6C4B7','FFFFFF','C6C4B7','C6C4B7','FFFFFF','FFFFFF','C6C4B7','CFCAC1','FFFFFF','F0EFE9','黄金','DEC079');
INSERT INTO `c_sns_config` VALUES (6,'water','FFFFFF','95CEEA','FFFFFF','FFFFFF','FFFFFF','FFFFFF','FFFFFF','95CEEA','FFFFFF','FFFFFF','FFFFFF','FFFFFF','95CEEA','FFFFFF','FFFFFF','95CEEA','FFFFFF','95CEEA','95CEEA','FFFFFF','FFFFFF','95CEEA','9BE6F0','FFFFFF','D6F2FF','水色','2BD1E7');
INSERT INTO `c_sns_config` VALUES (7,'purple','FFFFFF','C29EE3','FFFFFF','FFFFFF','FFFFFF','FFFFFF','FFFFFF','C29EE3','FFFFFF','FFFFFF','FFFFFF','FFFFFF','C29EE3','FFFFFF','FFFFFF','C29EE3','FFFFFF','C29EE3','C29EE3','FFFFFF','FFFFFF','C29EE3','BCA7EC','FFFFFF','EEDCFE','紫','8A1EEA');
INSERT INTO `c_sns_config` VALUES (8,'default','FFFFFF','B7B9C6','FFFFFF','FFFFFF','FFFFFF','FFFFFF','FFFFFF','B7B9C6','FFFFFF','FFFFFF','FFFFFF','FFFFFF','B7B9C6','FFFFFF','FFFFFF','B7B9C6','FFFFFF','B7B9C6','B7B9C6','FFFFFF','FFFFFF','B7B9C6','C1C6CF','FFFFFF','E9EAF0','初期設定','E9EAF0');
INSERT INTO `mail_queue_seq` VALUES (1);
INSERT INTO `c_tags` (`c_tags_name`,`c_member_id`) VALUES ('その他','1');

INSERT INTO `c_display_view` (`c_display_name`,`is_pc`,`is_money_flag`,`template_foldername`) values (
    'ノーマル画面','0','0','') ;
INSERT INTO `c_display_view` (`c_display_name`,`is_pc`,`is_money_flag`,`template_foldername`) values (
    'サムネイル付き画面','0','0','new_templates') ;
INSERT INTO `c_display_view` (`c_display_name`,`is_pc`,`is_money_flag`,`template_foldername`) values (
    'Mixi風画面','1','0','new_templates') ;
INSERT INTO `c_display_view` (`c_display_name`,`is_pc`,`is_money_flag`,`template_foldername`) values (
    '携帯用ライトページ','0','0','light_templates') ;
INSERT INTO `c_admin_config` (`c_admin_config_id`, `name`, `value`) VALUES ( null, 'SKIN_FOLDER', 'default');

