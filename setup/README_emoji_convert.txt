絵文字コードコンバートスクリプトについて
2010/12/20 KUNIHARU Tsujioka Usagi Project
script write by Shimaさん

MyNETS1.2.0.Xと、MyNETS1.2.1.Xの絵文字コードが変更になりました。
新しい文字コード体系では、OpenPNEの2.14.X系と同じ絵文字コードを採用しており、
MyNETSの新バージョン、MyNETS2でも同じ絵文字コードを使用しております。

【変更方法】
Usagi/setup/
にある、
convert_emoji_database.php
を、ドキュメントルートに設置してください。
※通常SNSが動作するindex.phpのある場所です。
設置後、
http://yourdomain/convert_emoji_database.php
を呼び出してください。

Begin converter
が表示され、終了後
Finish converter
が表示されれば終了となります。

※サーバのスペック、データの量などにより、一括で変更できないことがあります。
殆どの場合、使用するメモリの量が制限されていることでメモリオーバーになり、
PHPがストップします。

このような場合は、
$target = array(
    'c_commu' => array('name', 'info',),
    'c_commu_admin_confirm' => array('message',),
    'c_commu_member_confirm' => array('message',),
    'c_commu_sub_admin_confirm' => array('message',),
    'c_commu_topic' => array('name', 'open_date_comment', 'open_pref_comment',),
    'c_commu_topic_comment' => array('body',),
    'c_diary' => array('subject', 'body',),
    'c_diary_comment' => array('body',),
    'c_friend' => array('intro',),
    'c_friend_confirm' => array('message',),
    'c_member' => array('nickname',),
    'c_member_pre' => array('nickname', 'c_password_query_answer',),
    'c_member_pre_profile' => array('value',),
    'c_member_profile' => array('value',),
    'c_message' => array('body', 'subject',),
    'c_searchlog' => array('searchword',),
    'c_one_word' => array('comment',),
    'c_tags' => array('c_tags_name',),
);

こちらにあるテーブルを順番にループしょりしていますが、
これを一つずつ実行するなどして回避してください。
わからないことがあれば、サポート掲示板等でお問合せ下さい。
