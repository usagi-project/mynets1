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
 * @author     Shinji Hyodo
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

class mail_sns
{
    var $decoder;
    var $from;
    var $to;

    var $c_member_id;

    function mail_sns(&$decoder)
    {
        $this->decoder =& $decoder;
        $this->from = $decoder->get_from();
        $this->to = $decoder->get_to();

        $this->c_member_id = do_common_c_member_id4ktai_address($this->from);
    }

    function main()
    {
        $matches = array();
        list($from_user, $from_host) = explode('@', $this->from, 2);
        list($to_user, $to_host) = explode('@', $this->to, 2);

        // メンテナンスモード
        if (OPENPNE_UNDER_MAINTENANCE) {
            $this->error_mail('現在メンテナンス中のため、メール投稿はおこなえま>せん。しばらく時間を空けて再度送信してください。');
            m_debug_log('mail_sns::main() maintenance mode');
            return false;
        }

        // from_host が携帯ドメイン以外はエラー
        if (!is_ktai_mail_address($this->from)) {
            m_debug_log('mail_sns::main() from wrong host');
            return false;
        }

        if (MAIL_ADDRESS_PREFIX) {
            if (strpos($to_user, MAIL_ADDRESS_PREFIX) === 0) {
                $to_user = substr($to_user, strlen(MAIL_ADDRESS_PREFIX));
            }
        }

        if (! $this->c_member_id) {
            // 送信者がSNSメンバーでない場合

            if (!IS_CLOSED_SNS) {
                // get 新規登録
                if ($to_user == 'get') {
                    m_debug_log('mail_sns::regist_get()', PEAR_LOG_INFO);
                    return $this->regist_get();
                }
            }
            //空メールによる携帯アドレス登録
            //KUNIHARU Tsujioka 2008/07/29 追加
            if ($to_user == 'mbentry')
            {
                m_debug_log('mail_sns::mobile_mailaddress_entry', PEAR_LOG_INFO);
                return $this->entry_mobileaddress();
            }
            //QRによる会員登録処理
            //KUNIHARU Tsujioka 2008/08/08 追加
            if (preg_match('/^qrm-(\d+)$/', $to_user, $matches)) {
                m_debug_log('mail_sns::regist_qrm_get()'.$matches[1], PEAR_LOG_INFO);
                return $this->regist_qrm_get($matches[1]);
            }
            if (preg_match('/^qrc(\d+)-(\d+)$/', $to_user, $matches)) {

                m_debug_log('mail_sns::regist_qrc_get()', PEAR_LOG_INFO);
                return $this->regist_qrc_get($matches[1],$matches[2]);
            }
            m_debug_log('mail_sns::main() action not found'.$to_user);
            return false;
        }

        //---
        // ログインアドレス通知
        if ($to_user == 'get') {
            m_debug_log('mail_sns::login_get()', PEAR_LOG_INFO);
            return $this->login_get();
        }

        //---
        // コミュニティ掲示板投稿
        elseif (
            preg_match('/^t(\d+)$/', $to_user, $matches) ||
            preg_match('/^t(\d+)-([0-9a-f]{12})$/', $to_user, $matches)
        ) {

            // トピックIDのチェック
            if (!$c_commu_topic_id = $matches[1]) {
                return false;
            }

            if (MAIL_ADDRESS_HASHED) {
                if (empty($matches[2])) return false;

                // メンバーハッシュのチェック
                if ($matches[2] != t_get_user_hash($this->c_member_id)) {
                    return false;
                }
            }

            m_debug_log('mail_sns::add_commu_topic_comment()', PEAR_LOG_INFO);
            return $this->add_commu_topic_comment($c_commu_topic_id);
        }

        //---
        // 日記投稿
        elseif (
            $to_user == 'blog' ||
            preg_match('/^b(\d+)-([0-9a-f]{12})$/', $to_user, $matches)
        ) {

            if (MAIL_ADDRESS_HASHED) {
                if (empty($matches[1]) || empty($matches[2])) return false;

                // メンバーIDのチェック
                if ($matches[1] != $this->c_member_id) {
                    return false;
                }
                // メンバーハッシュのチェック
                if ($matches[2] != t_get_user_hash($this->c_member_id)) {
                    return false;
                }
            }

            m_debug_log('mail_sns::add_diary()', PEAR_LOG_INFO);
            return $this->add_diary();
        }
        //日記コメント投稿
        elseif (
                preg_match('/^c(\d+)$/', $to_user, $matches) ||
                preg_match('/^c(\d+)-([0-9a-f]{12})$/', $to_user, $matches)
                )
                {
            // 日記IDのチェック
            if (!$c_diary_id = $matches[1]) {
                return false;
            }

            if (MAIL_ADDRESS_HASHED) {
                if (empty($matches[2])) return false;

                // メンバーハッシュのチェック
                if ($matches[2] != t_get_user_hash($this->c_member_id)) {
                    return false;
                }
            }

            m_debug_log('mail_sns::add_diary_comment()', PEAR_LOG_INFO);
            return $this->add_diary_comment($c_diary_id);

                }
            //---2006/11/13 KT
            //コミュニティトピック作成メール投稿eventのeとする
        elseif (
                preg_match('/^e(\d+)$/', $to_user, $matches) ||
                preg_match('/^e(\d+)-([0-9a-f]{12})$/', $to_user, $matches)
                )
                {
                // コミュニティのIDチェック
            if (!$c_commu_id = $matches[1]) {
                return false;
            }

            if (MAIL_ADDRESS_HASHED) {
                if (empty($matches[2])) return false;

                // メンバーハッシュのチェック
                if ($matches[2] != t_get_user_hash($this->c_member_id)) {
                    return false;
                }
            }

            m_debug_log('mail_sns::add_commu_topic_entry()', PEAR_LOG_INFO);

                    return $this->add_commu_topic_entry($c_commu_id);
                }
                //---2006/11/13 KT
                //コミュニティトピック編集メール
            elseif (
                preg_match('/^et(\d+)$/', $to_user, $matches) ||
                preg_match('/^et(\d+)-([0-9a-f]{12})$/', $to_user, $matches)
                )
                {
                // コミュニティのIDチェック
            if (!$c_commu_topic_id = $matches[1]) {
                return false;
            }

            if (MAIL_ADDRESS_HASHED) {
                if (empty($matches[2])) return false;

                // メンバーハッシュのチェック
                if ($matches[2] != t_get_user_hash($this->c_member_id)) {
                    return false;
                }
            }

            m_debug_log('mail_sns::add_commu_topic_edit()', PEAR_LOG_INFO);

                    return $this->add_commu_topic_edit($c_commu_topic_id);
                }
        //---

        //プロフィール画像変更
        elseif (
            preg_match('/^p(\d+)$/', $to_user, $matches) ||
            preg_match('/^p(\d+)-([0-9a-f]{12})$/', $to_user, $matches)
        ) {

            // メンバーIDのチェック
            if ($matches[1] != $this->c_member_id) {
                return false;
            }

            if (MAIL_ADDRESS_HASHED) {
                if (empty($matches[2])) return false;

                // メンバーハッシュのチェック
                if ($matches[2] != t_get_user_hash($this->c_member_id)) {
                    return false;
                }
            }

            m_debug_log('mail_sns::add_member_image()', PEAR_LOG_INFO);
            return $this->add_member_image();
        }

        //コミュニティ画像変更
        // Hyodo Shinji 2007/02/13 追加
        elseif (
            preg_match('/^copic(\d+)-(\d+)$/', $to_user, $matches) ||
            preg_match('/^copic(\d+)-(\d+)-([0-9a-f]{12})$/', $to_user, $matches)
        ) {

            // メンバーIDのチェック
            if ($matches[2] != $this->c_member_id) {
                return false;
            }

            if (MAIL_ADDRESS_HASHED) {
                if (empty($matches[3])) return false;
                // メンバーハッシュのチェック
                if ($matches[3] != t_get_user_hash($this->c_member_id)) {
                    return false;
                }
            }
            m_debug_log('mail_sns::add_commu_image()', PEAR_LOG_INFO);
            return $this->add_commu_image($matches[1]);
        }

        //日記画像変更
        // Hyodo Shinji 2007/03/02 追加
        elseif (
        preg_match('/^dpic(\d+)-(\d+)$/', $to_user, $matches) ||
        preg_match('/^dpic(\d+)-(\d+)-([0-9a-f]{12})$/', $to_user, $matches)
        ) {
            m_debug_log('mail_sns::change_diary_image()', 'now_check');
            // 日記のIDチェック
            if (!$matches[1]) {
                return false;
            }

            $image_num = intval($matches[2]);
            if ($image_num < 1||$image_num > 3) {
                return false;
            }

            if (MAIL_ADDRESS_HASHED) {
                if (empty($matches[3])) return false;
                // メンバーハッシュのチェック
                if ($matches[3] != t_get_user_hash($this->c_member_id)) {
                    return false;
                }
            }
            m_debug_log('mail_sns::change_diary_image()', PEAR_LOG_INFO);
            return $this->change_diary_image($matches[1], $image_num);
        }

        m_debug_log('mail_sns::main() action not found(member)');
        return false;
    }

    /**
     * 新規登録のURL取得
     */
    function regist_get()
    {
        // 招待者は c_member_id = 1 (固定)
        $c_member_id_invite = 1;

        // _pre に追加
        $session = create_hash();
        //既にその携帯アドレスが仮登録されているかどうかを判定し、登録する。
        $pre_user = do_common_c_member_ktai_pre4ktai_address($this->from);
        if ($pre_user) {
            //もし既に登録がある場合はそれを削除しておく
            k_do_delete_c_member_ktai_pre4ktai_address($this->from);
        }
        mail_insert_c_member_ktai_pre($session, $this->from, $c_member_id_invite);

        do_common_send_mail_regist_get($session, $this->from);
        return true;
    }

    /**
     * 携帯空メールによる携帯アドレスの登録処理
     * 2008/07/29 KUNIHARU Tsujioka update
     *
     */
    function entry_mobileaddress()
    {
        //メールアドレスを引数として返信メールを送信
        //その返信メールにPCの登録アドレスとパスワードを入力する
        //ためのURLを記述する
        do_common_send_mail_mobile_entry($this->from);
        return true;
    }

    /**
     * 新規登録のURL取得 QR
     */
    function regist_qrm_get($c_member_pre_id)
    {
        require_once OPENPNE_WEBAPP_DIR."/modules/qrentry/lib/qrentry.class.php";
        $qrinsert = new QREntry();
        m_debug_log('mail_sns::qrm_get from = '.$this->from, PEAR_LOG_INFO);
        $result = $qrinsert->addKtaiMail($this->from, $c_member_pre_id);
        m_debug_log('mail_sns::qrm_get from = '.$result, PEAR_LOG_INFO);
        if (!$result) {
            $this->error_mail('エラーのため登録できませんでした。');
            m_debug_log('mail_sns::qr member regist error');
            return false;
        }
        return true ;
    }

    /**
     * 新規登録のURL取得 QRでコミュニティ付き
     */
    function regist_qrc_get($c_commu_id, $c_member_pre_id)
    {
        require_once OPENPNE_WEBAPP_DIR."/modules/qrentry/lib/qrentry.class.php";
        $qrinsert = new QREntry();
        m_debug_log('mail_sns::qrc_get from = '.$this->from, PEAR_LOG_INFO);
        $result = $qrinsert->addKtaiMail($this->from, $c_member_pre_id, $c_commu_id);
        m_debug_log('mail_sns::qrc_get from = '.$c_commu_id, PEAR_LOG_INFO);
        if (!$result) {
            $this->error_mail('エラーのため登録できませんでした。');
            m_debug_log('mail_sns::commu new regist error');
            return false;
        }
        return true ;
    }

    /**
     * ログインページのURL取得
     */
    function login_get()
    {
        do_mail_sns_login_get_mail_send($this->c_member_id, $this->from);
        return true;
    }

    /**
     * コミュニティ掲示板投稿
     */
    function add_commu_topic_comment($c_commu_topic_id)
    {
        if (!$topic = mail_c_commu_topic4c_commu_topic_id($c_commu_topic_id)) {
            return false;
        }

        $c_commu_id = $topic['c_commu_id'];
        if (!_db_is_c_commu_member($c_commu_id, $this->c_member_id)) {
            $this->error_mail('コミュニティに参加していないため投稿できませんでした');
            m_debug_log('mail_sns::add_commu_topic_comment() not a member');
            return false;
        }

        $body = $this->decoder->get_text_body();
        if ($body === '') {
            $this->error_mail('本文が空のため投稿できませんでした');
            m_debug_log('mail_sns::add_commu_topic_comment() body is empty');
            return false;
        }

        // 書き込みをDBに追加
        $ins_id = db_commu_insert_c_commu_topic_comment($c_commu_id, $topic['c_commu_topic_id'], $this->c_member_id, $body);

        // 画像保存
        $images = $this->decoder->get_images();
        $image_num = 1;
        foreach ($images as $image_data) {
            $filename = 'tc_' . $ins_id . '_' . $image_num . '_' . time() . '.jpg';

            db_image_insert_c_image($filename, $image_data, $this->c_member_id);
            mail_update_c_commu_topic_comment_image($ins_id, $filename, $image_num);
            $image_num++;
            if ($image_num > 3) {
                break;
            }
        }

        //お知らせメール送信(携帯へ)
        send_bbs_info_mail($ins_id, $this->c_member_id);
        //お知らせメール送信(PCへ)
        send_bbs_info_mail_pc($ins_id, $this->c_member_id);

        return true;
    }
    /**
     * コミュニティ掲示板トピックの作成 2006/11/13 KT
     */
    function add_commu_topic_entry($c_commu_id)
    {
        $subject = $this->decoder->get_subject();
        $body    = $this->decoder->get_text_body();
        //コミュニティがあるかどうかを判定
        if (!$commu = _db_c_commu4c_commu_id($c_commu_id)) {
        m_debug_log('mail_sns::add_commu_topic_test() not community', PEAR_LOG_INFO);
            return false;
        }

        if (!_db_is_c_commu_member($c_commu_id, $this->c_member_id)) {
            $this->error_mail('コミュニティに参加していないため投稿できませんでした');
            m_debug_log('mail_sns::add_commu_topic_test() not a member', PEAR_LOG_INFO);
            return false;
        }

        if ($body === '') {
            $this->error_mail('本文が空のため投稿できませんでした');
            m_debug_log('mail_sns::add_commu_topic_test() body is empty', PEAR_LOG_INFO);
            return false;
        }
        if ($subject === '') {
            $this->error_mail('題名が空のため投稿できませんでした');
            m_debug_log('mail_sns::add_commu_topic_test() subject is empty', PEAR_LOG_INFO);
            return false;
        }
        // 書き込みをDBに追加
        $ins_id = do_c_topic_add_insert_c_commu_topic($c_commu_id,$this->c_member_id,$subject);

        //トピックの本文の保存
        $insert_c_commu_topic_comment = array(
            "c_commu_id"       => $c_commu_id,
            "c_member_id"      => $this->c_member_id,
            "body"             => $body,
            "number"           => 0,
            "c_commu_topic_id" => $ins_id ,
        );

        $insert_id = do_c_event_add_insert_c_commu_topic_comment($insert_c_commu_topic_comment);
        // 画像保存
        $images = $this->decoder->get_images();
        $image_num = 1;
        foreach ($images as $image_data) {
            $filename = 'e_' . $insert_id . '_' . $image_num . '_' . time() . '.jpg';

            db_image_insert_c_image($filename, $image_data, $this->c_member_id);
            mail_update_c_commu_topic_comment_image($insert_id, $filename, $image_num);
            $image_num++;
            if ($image_num > 3) {
                break;
            }
        }

        return true;
    }

    /**
     * コミュニティ掲示板トピックの編集 2006/11/13 KT
     */
    function add_commu_topic_edit($c_commu_topic_id)
    {
        $subject = $this->decoder->get_subject();
        $body    = $this->decoder->get_text_body();
        //トピックがあるかどうかを判定
        m_debug_log('mail_sns::add_commu_topic_test() image_file_name KT 01', PEAR_LOG_INFO);
        if (!$topic = mail_c_commu_topic4c_commu_topic_id($c_commu_topic_id)) {
            return false;
        }
        $c_commu_id = $topic['c_commu_id'];
        if (!_db_is_c_commu_member($c_commu_id, $this->c_member_id)) {
            $this->error_mail('コミュニティに参加していないため投稿できませんでした');
            return false;
        }
        $c_commu_topic = c_topic_detail_c_topic4c_commu_topic_id($c_commu_topic_id);
        if ($body === '') { //本文が入ってない場合はトピック説明そのまま
            //テーブルからトピックの説明を取ってくる  トピックのコメントから取得する
        $body = $c_commu_topic['body'];
        }
        if ($subject === '') {  //題名が入ってない場合はトピック名はそのまま
            $subject = $c_commu_topic['name'];
        }

        $update_c_commu_topic = array(
            'name'       => $subject,
            'event_flag' => 0,
        );
        do_c_event_edit_update_c_commu_topic($c_commu_topic_id, $update_c_commu_topic);

        $update_c_commu_topic_comment = array(
            'body' => $body,
        );
        do_c_event_edit_update_c_commu_topic_comment($c_commu_topic_id,$update_c_commu_topic_comment);
        // 画像保存
        //画像保存は、c_commu_topic_commentで、c_topic_id指定と、number=0で指定する
        //テーブルから上記内容を取得する関数を作成
        $c_commu_topic_comment_id = db_c_commu_topic_comment4c_commu_topic_id($c_commu_topic_id,$number = 0);
        $images = $this->decoder->get_images();

        $image_num = 1;
        foreach ($images as $image_data) {
            $filename = 'e_' . $insert_id . '_' . $image_num . '_' . time() . '.jpg';

            db_image_insert_c_image($filename, $image_data, $this->c_member_id);
            mail_update_c_commu_topic_comment_image($c_commu_topic_comment_id, $filename, $image_num);
            $image_num++;

            if ($image_num > 3) {
                break;
            }
        }

        //お知らせメール送信(携帯へ)
        //send_bbs_info_mail($ins_id, $this->c_member_id);
        //お知らせメール送信(PCへ)
        //send_bbs_info_mail_pc($ins_id, $this->c_member_id);

        return true;
    }

    /**
     * 日記投稿
     */
    function add_diary()
    {
        $subject = $this->decoder->get_subject();
        $body    = $this->decoder->get_text_body();

        if ($subject === '') {
            $subject = '無題';
        }
        if ($body === '') {
            $this->error_mail('本文が空のため投稿できませんでした');
            m_debug_log('mail_sns::add_diary() body is empty');
            return false;
        }

        $c_member = db_common_c_member4c_member_id($this->c_member_id);
        if (!$ins_id = db_diary_insert_c_diary($this->c_member_id, $subject, $body, $c_member['public_flag_diary'])) {
            return false;
        }

        // 画像登録
        $images = $this->decoder->get_images();
        $image_num = 1;
        foreach ($images as $image_data) {
            $filename = 'd_' . $ins_id . '_' . $image_num . '_' . time() . '.jpg';

            db_image_insert_c_image($filename, $image_data, $this->c_member_id);
            db_diary_update_c_diary_image_filename($ins_id, $filename, $image_num);
            $image_num++;
            if ($image_num > 3) {
                break;
            }
        }

        return true;
    }
    /**
     * 日記コメント投稿
     */
    function add_diary_comment($c_diary_id)
    {
        if (!$diary = db_diary_get_c_diary4id($c_diary_id)) {  //日記IDから日記を検索
            $this->error_mail('該当する日記が見つかりませんでした。');
            m_debug_log('mail_sns::add_diary_comment() diary is not exist');
            return false;
        }

        $body = $this->decoder->get_text_body();
        if ($body === '') {
            $this->error_mail('本文が空のため投稿できませんでした');
            m_debug_log('mail_sns::add_diary_comment() body is empty');
            return false;
        }

        //権限チェック
        $target_c_member_id = $diary['c_member_id'];
        $target_c_member = db_common_c_member4c_member_id($target_c_member_id);

        if ($this->c_member_id != $target_c_member_id) {
            // check public_flag
            if (!pne_check_diary_public_flag($c_diary_id, $this->c_member_id)) {
                $this->error_mail('この日記にコメントを投稿する権限がありません。');
                m_debug_log('mail_sns::add_diary_comment() kengen error (public flag)');
                return false;
            }
            //アクセスブロック設定
            if (p_common_is_access_block($this->c_member_id, $target_c_member_id)) {
                $this->error_mail('この日記にコメントを投稿する権限がありません。');
                m_debug_log('mail_sns::add_diary_comment() kengen error (access block)');
                return false;
            }
        }

        // 書き込みをDBに追加
        $ins_id = db_diary_insert_c_diary_comment($this->c_member_id, $diary['c_diary_id'], $body);

        // 画像保存
        $images = $this->decoder->get_images();
        $image_num = 1;
        foreach ($images as $image_data) {
            $filename = 'dc_' . $ins_id . '_' . $image_num . '_' . time() . '.jpg';
            db_image_insert_c_image($filename, $image_data, $this->c_member_id);
            mail_diary_comment_update_c_diary_comment_image_filename($ins_id, $filename, $image_num);

            $image_num++;
            if ($image_num > 3) {
                break;
            }
        }

        //日記コメントが書き込まれたので日記自体を未読扱いにする
        if ($this->c_member_id != $target_c_member_id) {
            db_diary_update_c_diary_is_checked($c_diary_id, 0);
        }
        m_debug_log('mail_sns::add_diary_comment() ok');
        return true;
    }


    /**
     * プロフィール画像変更
     */
    function add_member_image()
    {
        $c_member = db_common_c_member4c_member_id($this->c_member_id);

        // 登録する画像番号(1-3)を決める
        $target_number = 0;
        if ($c_member['image_filename']) {
            if (!$c_member['image_filename_1']) {
                $target_number = 1;
            } elseif (!$c_member['image_filename_2']) {
                $target_number = 2;
            } elseif (!$c_member['image_filename_3']) {
                $target_number = 3;
            } else {
                $this->error_mail('プロフィール画像の登録は最大三枚までです。');
                m_debug_log('mail_sns::add_diary() image is full');
                return false;
            }
        } else {
            $target_number = 1;
        }

        // 画像登録
        if ($images = $this->decoder->get_images()) {
            $filename = 'm_' .$this->c_member_id.'_'. time() . '.jpg';

            db_image_insert_c_image($filename, $images[0], $this->c_member_id);
            mail_update_c_member_image($this->c_member_id, $filename, $target_number);
            return true;
        } else {
            m_debug_log('mail_sns::add_member_image() no images');
            return false;
        }
    }

    /**
     * コミュニティ画像変更
     * Hyodo Shinji 2007/02/13 追加
     */
    function add_commu_image($c_commu_id) {
        if (!$c_commu = _db_c_commu4c_commu_id($c_commu_id)) {
            $this->error_mail('コミュニティが存在しませんでした。');
            m_debug_log('mail_sns::add_commu_image() commu is not exist');
            return false;
        }
        if (!_db_is_c_commu_admin($c_commu_id, $this->c_member_id)){
            $this->error_mail('コミュニティの管理者でないので、画像を設定できません。');
            m_debug_log('mail_sns::add_commu_image() member is not admin');
            return false;
        }
        // 画像登録
        if ($images = $this->decoder->get_images()) {
            image_data_delete($c_commu['image_filename']);
            $filename = 'c_' .$c_commu_id.'_'. time() . '.jpg';
            db_image_insert_c_image($filename, $images[0], $this->c_member_id);
            db_commu_update_c_commu_image_filename($c_commu_id, $filename);
            return true;
        } else {
            $this->error_mail('画像が添付されていません。');
            m_debug_log('mail_sns::add_commu_image() no images');
            return false;
        }
    }

    /**
     * 日記画像変更
     * Hyodo Shinji 2007/03/02 追加
     */
    function change_diary_image($c_diary_id, $image_num) {
        if (!$c_diary = db_diary_get_c_diary4id($c_diary_id)) {
            $this->error_mail('日記が存在しませんでした。');
            m_debug_log('mail_sns::change_diary_image() diary is not exist');
            return false;
        }
        if ($c_diary['c_member_id'] != $this->c_member_id){
            $this->error_mail('画像を掲載する権限がありません' . $c_diary->c_member_id . "_" . $this->c_member_id);
            m_debug_log('mail_sns::change_diary_image() member is not diary owner');
            return false;
        }

        // 画像登録
        if ($images = $this->decoder->get_images()) {
            image_data_delete($c_diary['image_filename_' . $number]);
            $filename = 'd_' .$c_diary_id.'_' . $image_num . "_" . time() . '.jpg';
            db_image_insert_c_image($filename, $images[0], $this->c_member_id);
            db_diary_update_c_diary_image_filename($c_diary_id, $filename, $image_num);
            return true;
        } else {
            $this->error_mail('画像が添付されていません。');
            m_debug_log('mail_sns::change_diary_image() no images');
            return false;
        }
    }

    /**
     * エラーメールをメール送信者へ返信
     */
    function error_mail($body)
    {
        $subject = '['.SNS_NAME.']メール投稿エラー';
        t_send_email($this->from, $subject, $body);
    }
}

?>
