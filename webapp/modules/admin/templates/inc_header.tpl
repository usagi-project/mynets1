<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Expires" content="Thu, 01 Dec 1994 16:00:00 GMT">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="shortcut icon" href="favicon.ico">
<title>({$title})</title>
<link rel="stylesheet" href="modules/admin/default.css" type="text/css">
<link rel="stylesheet" href="modules/admin/textdecoration.css" type="text/css">
<link rel="stylesheet" href="./css/adminmenu.css" type="text/css">
<script type="text/javascript" src="./js/javascripts/adminmenu.js"></script>
</head>
<body onload="openPanel();">
<div id="header">
    <div id="banner">
    <h1><a href="?m=({$module_name})" title="({$title})">({$title})</a></h1>
    </div>
</div>
({* ナビバー位置 *})
({if $display_navi})
<div id="container">
    <div id="left">
        <div id="site_navi">
        ({if $auth_type == 'all' || $auth_type == ''})
        <div class="menu">
        <a href="javascript:void(0);" onclick="SwitchMenu(1)" onkeypress="SwitchMenu(1)">
            <img src="./icon/application_form_magnify.gif" width="16" height="16" class="imgtitle" alt="フロント管理">フロント管理
        </a>
    </div>
    <div id="sub1" style="display:none" class="submenu">
        <ul>
        ({if $auth_type == 'all'})
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_member')})" title="メンバーリスト: メンバー登録情報閲覧、メッセージ送信、強制退会"><img src="./icon/user.gif" width="16" height="16" class="imgtitle" alt="メンバー閲覧">メンバーリスト</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_member_check')})" title="メンバーリスト: メンバー登録、詳細情報"><img src="./icon/report_user.gif" width="16" height="16" class="imgtitle" alt="メンバーリスト">メンバー閲覧・詳細</a></li>
        ({/if})
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_image')})" title="画像リスト・管理: SNSに登録されている画像の一覧、登録、削除"><img src="./icon/images.gif" width="16" height="16" class="imgtitle" alt="投稿画像リスト">投稿画像リスト</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_message_check')})" title="画像メッセージ確認"><img src="./icon/page_white_stack.gif" width="16" height="16" class="imgtitle" alt="投稿メッセージ閲覧">投稿メッセージ閲覧</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_diary_check')})" title="投稿日記閲覧"><img src="./icon/page_white.gif" width="16" height="16" class="imgtitle" alt="投稿日記閲覧">投稿日記閲覧</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_diary_comment_check')})" title="投稿日記コメント閲覧"><img src="./icon/page_white_c.gif" width="16" height="16" class="imgtitle" alt="投稿日記コメント閲覧">投稿日記コメント閲覧</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_commu_check')})" title="投稿コミュニティ閲覧"><img src="./icon/group.gif" width="16" height="16" class="imgtitle" alt="コミュニティ閲覧">コミュニティ閲覧</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_topic_check')})" title="投稿トピック閲覧"><img src="./icon/user_comment.gif" width="16" height="16" class="imgtitle" alt="トピック閲覧">トピック閲覧</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_topic_comment_check')})" title="投稿トピックコメント閲覧"><img src="./icon/comments.gif" width="16" height="16" class="imgtitle" alt="トピックコメント閲覧">トピックコメント閲覧</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_inquiry_check')})" title="ユーザー通報"><img src="./icon/flag_red.gif" width="16" height="16" class="imgtitle" alt="問い合わせ・通報閲覧">問い合わせ・通報閲覧</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('delete_kakikomi')})" title="書き込み管理: 日記、コミュニティ、コミュニティトピックの強制削除"><img src="./icon/comment_edit.gif" width="16" height="16" class="imgtitle" alt="書き込み管理">書き込み管理</a></li>
        </ul>
    </div>
    ({/if})
    ({if $ADMIN_INIT_CONFIG})
    <div class="menu">
        <a href="javascript:void(0);" onclick="SwitchMenu(2)" onkeypress="SwitchMenu(2)">
            <img src="./icon/cog.gif" width="16" height="16" class="imgtitle" alt="コンテンツ管理">コンテンツ管理
        </a>
    </div>
    <div id="sub2" style="display:none" class="submenu">
        <ul>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('send_invites')})" title="SNS招待メール送信: 複数のメールアドレス宛に招待メールを送信"><img src="./icon/email_go.gif" width="16" height="16" class="imgtitle" alt="SNS招待メール発送">SNS招待メール発送</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('manage_c_commu')})" title="初期コミュニティ管理: 新規登録時に参加させるコミュニティの設定"><img src="./icon/group_add.gif" width="16" height="16" class="imgtitle" alt="初期登録コミュニティ管理">初期登録コミュニティ管理</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('view_skin_image')})" title="スキン画像表示: スキン画像表示"><img src="./icon/layers.gif" width="16" height="16" class="imgtitle" alt="スキン画像表示">スキン画像表示</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_sns_config')})" title="配色・CSS変更: 配色設定、カスタムCSS"><img src="./icon/css_add.gif" width="16" height="16" class="imgtitle" alt="配色・CSS設定">配色・CSS設定</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_navi')})" title="ナビゲーション変更: ナビゲーションボタンのリンク先、キャプションを変更"><img src="./icon/cursor.gif" width="16" height="16" class="imgtitle" alt="ナビゲーション設定">ナビゲーション設定</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_info')})" title="お知らせHTML挿入"><img src="./icon/html_add.gif" width="16" height="16" class="imgtitle" alt="お知らせHTML挿入">お知らせHTML挿入</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_banner')})" title="バナー管理"><img src="./icon/layout_header.gif" width="16" height="16" class="imgtitle" alt="バナー設定">バナー設定</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_admin_config')})" title="SNS設定変更: SNSの動作に関する詳細設定"><img src="./icon/wrench_orange.gif" width="16" height="16" class="imgtitle" alt="SNS各種設定項目管理">SNS各種設定項目管理</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_category')})" title="コミュニティカテゴリーの設定"><img src="./icon/vcard.gif" width="16" height="16" class="imgtitle" alt="コミュニティカテゴリ設定">コミュニティカテゴリー設定</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_c_profile')})" title="プロフィール項目変更: プロフィール項目の追加、編集、削除、並び替え"><img src="./icon/vcard.gif" width="16" height="16" class="imgtitle" alt="メンバープロフィール管理">メンバープロフィール管理</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_mail_send')})" title="メール設定変更: SNSから送信する各種メールの送信設定、文言変更"><img src="./icon/email_add.gif" width="16" height="16" class="imgtitle" alt="メール設定管理">メール設定管理</a></li>
        </ul>
    </div>
    ({/if})
    <div class="menu">
        <a href="javascript:void(0);" onclick="SwitchMenu(3)" onkeypress="SwitchMenu(3)">
            <img src="./icon/chart_bar.gif" width="16" height="16" class="imgtitle" alt="サイトアクセス管理">サイトアクセス管理
        </a>
    </div>
    <div id="sub3" style="display:none" class="submenu">
        <ul>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('user_analysis_generation')})" title="世代別メンバー数"><img src="./icon/time.gif" width="16" height="16" class="imgtitle" alt="世代別メンバー数">世代別メンバー数</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('user_analysis_date_month')})" title="登録日別メンバー数（月次集計）"><img src="./icon/calendar_view_month.gif" width="16" height="16" class="imgtitle" alt="登録日別メンバー数">登録日別メンバー数<br><img src="./icon/dummy.gif" width="22" height="1" alt="spacer">（月次集計）</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('user_analysis_date_day')})" title="登録日別メンバー数（日次集計）"><img src="./icon/calendar_view_day.gif" width="16" height="16" class="imgtitle" alt="登録日別メンバー数">登録日別メンバー数<br><img src="./icon/dummy.gif" width="22" height="1" alt="spacer">（日次集計）</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_month')})&amp;ktai_flag=0" title="PCページ月次集計"><img src="./icon/computer.gif" width="16" height="16" class="imgtitle" alt="PCページ月次集計">PCページ月次集計</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('access_analysis_month')})&amp;ktai_flag=1" title="携帯ページ月次集計"><img src="./icon/phone.gif" width="16" height="16" class="imgtitle" alt="携帯ページ月次集計">携帯ページ月次集計</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_db_check')})" title="退会者データ閲覧"><img src="./icon/vcard_delete.gif" width="16" height="16" class="imgtitle" alt="退会者データ">退会者データ<br><img src="./icon/dummy.gif" width="22" height="1" alt="spacer">閲覧・エクスポート</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_import_c_member')})" title="メンバーCSVインポート"><img src="./icon/door_in.gif" width="16" height="16" class="imgtitle" alt="メンバーCSVインポート">メンバーCSVインポート</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('ext_csv_download')})" title="メンバーCSVエクスポート"><img src="./icon/door_out.gif" width="16" height="16" class="imgtitle" alt="メンバーCSVエクスポート">メンバーCSVエクスポート</a></li>
        </ul>
    </div>
    <div class="menu">
        <a href="javascript:void(0);" onclick="SwitchMenu(4)" onkeypress="SwitchMenu(4)">
            <img src="./icon/table_gear.gif" width="16" height="16" class="imgtitle" alt="管理ページ設定">管理ページ設定
        </a>
    <div>
    <div id="sub4" style="display:none" class="submenu">
        <ul>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('list_c_admin_user')})" title="アカウント管理: 管理画面ログイン用アカウントの管理"><img src="./icon/status_online.gif" width="16" height="16" class="imgtitle" alt="管理ユーザー設定">管理ユーザー設定</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('edit_admin_password')})" title="パスワード変更: 管理画面ログイン用パスワードの変更"><img src="./icon/key.gif" width="16" height="16" class="imgtitle" alt="パスワード変更">パスワード変更</a></li>
            <li><a href="./?m=({$module_name})&amp;a=page_({$hash_tbl->hash('update_hash_table')})" title="ページ名ランダム生成: 管理画面のページ名を推測不可能なランダム文字列で置換"><img src="./icon/application_cascade.gif" width="16" height="16" class="imgtitle" alt="管理ページランダム生成">管理ページランダム生成</a></li>
            <li><a href="./?m=({$module_name})&amp;a=do_({$hash_tbl->hash('logout','do')})&amp;sessid=({$PHPSESSID})" title="ログアウト: 管理画面からログアウト"><img src="./icon/cancel.gif" width="16" height="16" class="imgtitle" alt="ログアウト">ログアウト</a></li>
        </ul>
    </div>
    </div>
        <a href="./" target="_blank" title="SNS閲覧">
            <img src="./icon/monitor_go.gif" width="16" height="16" class="imgtitle" alt="サイト閲覧">SNSサイト閲覧
        </a>
    </div>
        </div>
    </div>

    <div id="right">
({/if})
