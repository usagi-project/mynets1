<?php

/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable 
 *              to obtain it through the world-wide-web, please send a note to 
 *              license@php.net so we can mail you a copy immediately.  
 *
 * @category   Application of MyNETS
 * @project    OpenPNE UsagiProject 2006-2007
 * @package    MyNETS
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.0.0
 * @since      File available since Release 1.0.0 Nighty
 * @chengelog  [2007/02/17] Ver1.1.0Nighty package
 * ======================================================================== 
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

// メール文言更新
class admin_page_edit_mail extends OpenPNE_Action
{
    function execute($requests)
    {
        $pc = array(
            'm_pc_ashiato' => 'あしあとお知らせメール',
            'm_pc_bbs_info' => 'コミュニティ書き込み通知メール',
            'm_pc_birthday_mail' => 'マイフレンドの誕生日お知らせメール',
            'm_pc_change_mail' => 'PCメールアドレス変更確認メール',
            'm_pc_daily_news' => 'デイリー・ニュース',
            'm_pc_friend_intro' => 'マイフレンドからの紹介文お知らせメール',
            'm_pc_invite_end' => '登録完了メール',
            'm_pc_join_commu' => 'コミュニティ参加お知らせメール',
            'm_pc_message_event_message' => 'イベントお知らせメッセージお知らせメール',
            'm_pc_message_event_invite' => 'イベント紹介メッセージお知らせメール',
            'm_pc_message_syoukai_commu' => 'コミュニティ紹介メッセージお知らせメール',
            'm_pc_message_sankasya_commu' => 'コミュニティ参加者メッセージお知らせメール',
            'm_pc_message_syoukai_member' => 'メンバー紹介メッセージお知らせメール',
            'm_pc_message_syounin' => '承認メッセージお知らせメール',
            'm_pc_message_zyushin' => 'メッセージお知らせメール',
            'm_pc_password_query' => 'パスワード再発行メール',
            'm_pc_schedule_mail' => 'スケジュールお知らせメール',
            'm_pc_syounin_friend' => 'フレンドリンク承認完了メール',
            'm_pc_syoutai_mail' => 'SNS招待メール',
            'm_pc_taikai_end' => '退会完了メール',
        );
        $ktai = array(
            'm_ktai_ashiato' => 'あしあとお知らせメール',
            'm_ktai_bbs_info' => 'コミュニティ書き込み通知メール',
            'm_ktai_change_ktai' => '携帯メールアドレス変更確認メール',
            'm_ktai_login_get' => '携帯版ログインアドレスお知らせメール',
            'm_ktai_login_regist_end' => '登録完了メール',
            'm_ktai_message_zyushin' => 'メッセージお知らせメール',
            'm_ktai_password_query' => 'パスワード再発行メール',
            'm_ktai_regist_get' => '新規登録メール(オープン制)',
            'm_ktai_regist_invite' => '招待メール',
            'm_ktai_taikai_end' => '退会完了メール',
        );

        $this->set('pc', $pc);
        $this->set('ktai', $ktai);
        $source = get_c_template_mail_source($requests['target']);
        if ($requests['target'] == 'inc_signature') {
            $subject = '';
            $body = $source;
        } else {
            list($subject, $body) = explode("\n", $source, 2);
        }
        $this->set('subject', $subject);
        $this->set('body', $body);
        return 'success';
    }
}

?>
