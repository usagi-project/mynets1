ALTER TABLE `c_diary` CHANGE `public_flag` `public_flag` ENUM( 'open', 'public', 'friend', 'private' ) NOT NULL DEFAULT 'public'
ALTER TABLE `c_member` CHANGE `public_flag_diary` `public_flag_diary` ENUM( 'open', 'public', 'friend', 'private' ) NOT NULL DEFAULT 'public'
