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
 * @chengelog  [2007/04/14] Ver1.0.1Nighty package
 * @chengelog  [2007/04/19] Ver1.0.1+ package by Yamanoi
 * @chengelog  [2007/04/24] Kunitsuji update
 * @chengelog  [2007/12/15] Shima3 update (Added review cmd and modified format)
 * ========================================================================
 */

function smarty_modifier_t_url2pne($string)
{
    // "(&quot;) と '(&#039;) を元に戻す
    $search = array('&quot;', '&#039;');
    $replace = array('"', "'");
    $string = str_replace($search, $replace, $string);
    $url = preg_replace("/https?:/",'https?:', OPENPNE_URL);

    $url_pattern = '#'.$url.'\?((?:[\w\-\.,:;\~\^/?\@=+\$%\#!()*]|&amp;)+)#i';
    return preg_replace_callback($url_pattern, 'smarty_modifier_t_url2pne_callback', $string);
}

function smarty_modifier_t_url2pne_callback($matches)
{
    /*
     * パラメータを分割して$param連想配列に入れる
     *
     * 日記: m=pc&a=page_fh_diary&target_c_diary_id=6636
     * トピック: m=pc&a=page_c_topic_detail&target_c_commu_topic_id=7&comment_count=26
     * トピック検索からのURL（#でナンバーを指定）: m=pc&a=page_c_topic_detail&target_c_commu_topic_id=1&page=1#2
     */
    //2008-10-21 #がついていて場所指定している可能性があるので、それを考慮
    $param = array();
    $page_a = array();
    $page_a = split("#",$matches[1]);
    $d =    split("&amp;",$matches[1]);
    for($i=0;$i<count($d);$i++) {
        $e = explode("=",$d[$i]);
        if (count($e) == 2) {
            $param[$e[0]]=$e[1];
        }
    }

    $mtype = 0;
    $mdevs = 0;
    $link_url="";
    $link_str="";
    // User-Agent判別
    //if (CHECK_KTAI_UA && !isKtaiUserAgent()) {
    //UA判定をしない場合、PCから携帯ページがリンクされてしまうので、カットしてみる。
    if (!isKtaiUserAgent()) {
        $mdevs = 1; // pc
        if ( array_key_exists('target_c_diary_id',$param) ) {
            $link_url = '?m=pc&a=page_fh_diary&target_c_diary_id='.$param['target_c_diary_id'];
            $mtype=1;
        } else if ( array_key_exists('target_c_commu_topic_id',$param) ) {
            //$param['a'] = page_c_event_detail or page_c_topic_detail
            $link_url = '?m=pc&a=' . $param['a'] . '&target_c_commu_topic_id='.$param['target_c_commu_topic_id'];
            $mtype=2;
            //イベントがアクションで指定されている場合は、イベントとする。見つからない時にトピックになってしまうバグ対処
            if ($param['a'] == 'page_c_event_detail') {
                $link_url = '?m=pc&a=' . $param['a'] . '&target_c_commu_topic_id='.$param['target_c_commu_topic_id'];
                $mtype=5;
            }
        } else if ( $param['a']=='page_f_home' && array_key_exists('target_c_member_id',$param) ) {
            $link_url = '?m=pc&a=page_f_home&target_c_member_id='.$param['target_c_member_id'];
            $mtype=3;
        } else if ( $param['a']=='page_c_home' && array_key_exists('target_c_commu_id',$param) ) {
            $link_url = '?m=pc&a=page_c_home&target_c_commu_id='.$param['target_c_commu_id'];
            $mtype=4;
        } else if ( $param['a']=='page_h_review_list_product' && array_key_exists('c_review_id',$param) ) {
            $link_url = '?m=pc&a=page_h_review_list_product&c_review_id='.$param['c_review_id'];
            $mtype=6;
        } else {
            return $matches[0];
        }
    } else {
        $mdevs = 2; // 携帯
        if ( array_key_exists('target_c_diary_id',$param) ) {
            $link_url = '?m=ktai&a=page_fh_diary&target_c_diary_id='.$param['target_c_diary_id'];
            $mtype=1;
        } else if ( array_key_exists('target_c_commu_topic_id',$param) ) {
            $link_url = '?m=ktai&a=page_c_bbs&target_c_commu_topic_id='.$param['target_c_commu_topic_id'];
            $mtype=2;
            if ($param['a'] == 'page_c_event_detail') {
                //$link_url = '?m=ktai&a=' . $param['a'] . '&target_c_commu_topic_id='.$param['target_c_commu_topic_id'];
                //携帯の場合はc_bbsでイベントも実施
                $mtype=5;
            }
        } else if ( $param['a']=='page_f_home' && array_key_exists('target_c_member_id',$param) ) {
            $link_url = '?m=ktai&a=page_f_home&target_c_member_id='.$param['target_c_member_id'];
            $mtype=3;
        } else if ( $param['a']=='page_c_home' && array_key_exists('target_c_commu_id',$param) ) {
            $link_url = '?m=ktai&a=page_c_home&target_c_commu_id='.$param['target_c_commu_id'];
            $mtype=4;
        } else if ( $param['a']=='page_h_review_list_product' && array_key_exists('c_review_id',$param) ) {
            $link_url = '?m=ktai&a=page_h_review_list_product&c_review_id='.$param['c_review_id'];
            $mtype=6;
        } else {
            return $matches[0];
        }
    }

    // 2009-09-22 Add Start
    /*
     *  ログインIDを取得する。PCからアクセスの場合は、外部アクセスか否かも判断する。
     */
    $u = 0;
    $ext_access = 0;
    
    if ($mdevs==1) { // pc
        if (isset($GLOBALS['AUTH'])) {
            $u = $GLOBALS['AUTH']->uid();
        } else {
            // 外部アクセス
            $ext_access = 1;
        }
    } else { // KTAI
        $u = $GLOBALS['KTAI_C_MEMBER_ID'];
    }

    /*
     *  外部アクセスの場合、日記のURLを変更する。
     */
    if (($ext_access==1) && ($mtype==1)) {
        $link_url = '?m=diary&a=page_detail&target_c_diary_id='.$param['target_c_diary_id'];
    }
    // 2009-09-22 Add End

    /*
     * mtype:     1:diary 2:bbs 3:f_home 4:commu_home 5:bbs 6:review
     * mdevs:     1:pc    2:KTAI
     */
    if ( $mtype==1 ) {
        $db_msg = db_diary_get_c_diary4id($param['target_c_diary_id']);
        $member = db_common_c_member4c_member_id_LIGHT($db_msg['c_member_id']);
        if (empty($db_msg['subject'])) {
            $link_str = "【該当する日記はありません】";
        } else {
            $link_str = "【" . h($db_msg['subject']) . "】(" . h($member['nickname']) . "さん-" . $db_msg['r_datetime'] . ")";
        }
    } else if ( $mtype==2 ) {
        $db_msg = _do_c_bbs_c_commu_topic4c_commu_topic_id($param['target_c_commu_topic_id']);
        $member = db_common_c_member4c_member_id_LIGHT($db_msg['c_member_id']);
        if ( $db_msg['event_flag'] == 1 ) {
            //本来なら必要ないかも知れないが、念のためそのまま
            if (empty($db_msg['name'])) {
                $link_str = "【該当するイベントはありません】";
            } else {
                $link_str = "【" . h($db_msg['name']) . "】(開催日:" . $db_msg['open_date'] . " / 募集期間:" . $db_msg['invite_period'] . ")";
            }
        } else {
            if (empty($db_msg['name'])) {
                $link_str = "【該当するトピックはありません】";
            } else {
                $link_str = "【" . h($db_msg['name']) . "】(" . h($member['nickname']) . "さん-" . $db_msg['r_datetime'] . ")";
            }
        }
    } else if ( $mtype==5 ) {
        $db_msg = _do_c_bbs_c_commu_topic4c_commu_topic_id($param['target_c_commu_topic_id']);
        $member = db_common_c_member4c_member_id_LIGHT($db_msg['c_member_id']);
        if (empty($db_msg['name'])) {
            $link_str = "【該当するイベントはありません】";
        } else {
            $link_str = "【" . h($db_msg['name']) . "】(開催日:" . $db_msg['open_date'] . " / 募集期間:" . $db_msg['invite_period'] . ")";
        }
    } else if ( $mtype==3 ) {
        $member = db_common_c_member4c_member_id_LIGHT($param['target_c_member_id']);
        if (empty($member['nickname'])) {
            $link_str = "【該当する方はおられません】";
        } else {
            $link_str = "【" . h($member['nickname']) . "】さんのページ";
        }
    } else if ( $mtype==4 ) {
        $db_msg = _db_c_commu4c_commu_id($param['target_c_commu_id']);
        if (empty($db_msg['name'])) {
            $link_str = "【該当するコミュニティはありません】";
        } else {
            $link_str = "【" . h($db_msg['name']) . "】コミュニティ";
        }
    } else if ( $mtype==6 ) {
        // cmd_plugins でレビュー小窓を生成する
        $file = dirname(__FILE__) . '/../cmd_plugins/cmd_review.php';
        if (is_readable($file)) {
            // cmd_pluginsを呼ぶ
            require_once $file;
            if ($ret = cmd_review_main(array('c_review_id' => $param['c_review_id']))) {
                return $ret;
            }
        }
        // cmd_pluginsにレビュー小窓がない場合やレビュー小窓の生成ができなかった場合
        $db_msg = p_h_review_list_product_c_review4c_review_id($param['c_review_id']);
        if (empty($db_msg['title'])) {
            $link_str = "【該当するレビューはありません】";
        } else {
            // 今のところ携帯にはレビューがないので詳細情報へのリンクとする
            if ($mdevs==2) {
                $link_str = "【" . h($db_msg['title']) . "】の詳細情報";
                $link_url = 'http_://amazon.jp/' . AMAZON_AFFID . '/dp/' . $db_msg['asin'];
                return '<a href="t.php?'.$link_url.'" target="_blank">'.$link_str.'</a>';
            } else {
                $link_str = "【" . h($db_msg['title']) . "】のレビュー";
            }
        }
    }

    // 2009-09-22 Add Start
    /*
     *  日記へのリンク文字列をアクセス権限により編集する
     */
    $cannot_access_str = "【このページの公開は制限されています】";

    if (($mtype==1) && (!empty($db_msg['subject']))) {
        $target_uid   = $member['c_member_id'];
        $public_flag  = $db_msg['public_flag'];
        $diary_access = 0;

        /*
         *  日記の参照権限を確認する
         */
        // 外部アクセスの場合
        if ($ext_access==1) {
            // 外部公開日記のみアクセス可能
            if ($public_flag == 'open') {
                $diary_access = 2;
            }
        // ログインユーザの日記の場合
        } else if ($target_uid == $u) {
            $diary_access = 1;
        // アクセスブロックされている場合
        } else if (p_common_is_access_block($u, $target_uid)) {
            $diary_access = 0;
        // 
        } else if (($public_flag == 'public')
               || ($public_flag == 'open')
               || ($public_flag == 'friend') && db_friend_is_friend($u, $target_uid)) {
            $diary_access = 2;
        } else {
            $diary_access = 0;
        }
        // diary_access:     0: 参照不可  1: 自分の日記  2: 参照可能
        // 自分の日記の場合、敬称を取る。
        if ($diary_access == 1) {
            $link_str = "【" . h($db_msg['subject']) . "】(" . h($member['nickname']) . "-" . $db_msg['r_datetime'] . ")";
        // 参照可能な日記の場合、変更無し
        } else if ($diary_access == 2) {
            $link_str = "【" . h($db_msg['subject']) . "】(" . h($member['nickname']) . "さん-" . $db_msg['r_datetime'] . ")";
        // 参照できない日記の場合
        } else {
            $link_str = $cannot_access_str;
        }
    }
    
    /*
     *  トピックへのリンクの場合、トピック作成者の替わりにコミュ名を表示する
     *  イベントへのリンクの場合、コミュ名を追加表示する
     *  非公開コミュの場合、コミュメンバ以外は、表示を変更する
     */
    if (($mtype==2 || $mtype==5) && (!empty($db_msg['name']))) {
        $commu_access = 0 ;
        $link_str_commu = '';
        $db_msg2 = _db_c_commu4c_commu_id($db_msg['c_commu_id']);

        if (empty($db_msg2['name'])) {
            $link_str_commu = "【該当するコミュニティはありません】"; // 念のため
        } else {
            $link_str_commu = "【" . h($db_msg2['name']) . "】コミュニティ";
            
            if ($db_msg2['public_flag'] == 'auth_commu_member') { // 非公開コミュニティ
                if (($ext_access == 0) && (_db_is_c_commu_member($db_msg['c_commu_id'], $u))) {
                    $commu_access = 1;
                }
            } else {
                $commu_access = 1;
            }
        }
        // commu_access:     0: 参照不可  1: 参照可能
        if ($commu_access==1) {
            // トピックへのリンク
            if ($mtype==2 && ($db_msg['event_flag'] != 1)) {
                // $link_str = "【" . h($db_msg['name']) . "】(" . h($member['nickname']) . "さん-" . $db_msg['r_datetime'] . ")";
                $link_str = "【" . h($db_msg['name']) . "】(" . $link_str_commu . " " . $db_msg['r_datetime'] . ")";
            // イベントへのリンク
            } else {
                // $link_str = "【" . h($db_msg['name']) . "】(開催日:" . $db_msg['open_date'] . " / 募集期間:" . $db_msg['invite_period'] . ")";
                $link_str = "【" . h($db_msg['name']) . "】(" . $link_str_commu . " 開催日:" . $db_msg['open_date'] . " / 募集期間:" . $db_msg['invite_period'] . ")";
            }
        } else {
                $link_str = $cannot_access_str;
        }
    }

    // 2009-09-22 Add End

    /*
     *  トピック・イベントでコメントナンバーが付いたリンクの場合は動的にページを計算してリンクを付ける
     */
    if($mtype==2 || $mtype==5 && $page_a) {
        if(db_c_commu_topic_comment4c_commu_topic_id($param['target_c_commu_topic_id'], intval($page_a[1]))) {
            $cnum = db_commu_count_c_topic_comment4c_topic_id($param['target_c_commu_topic_id']);
            $cnum_self = db_commu_count_c_topic_commentself4c_topic_number($param['target_c_commu_topic_id'], intval($page_a[1]));
            if($cnum_self != 0) {
                if($mdevs == 1) {
                    $link_url .= '&amp;page=' . strval(floor(($cnum-$cnum_self-1)/10)+1) . '#' . strval(intval($page_a[1]));
                    $link_str .= ' - ' . strval(intval($page_a[1])) . '番目のコメント';
                } else {
                    $link_url .= '&amp;page=' . strval(floor(($cnum-$cnum_self-1)/5)+1);
                    $ktai_number = strval($cnum - $cnum_self - 5*(floor(($cnum-$cnum_self-1)/5)));
                    $link_str .= ' - ' . strval(intval($page_a[1])) . '番目のコメント';
                }
            }
        } else {
            $link_str .= ' - 該当するコメントはありません';
        }
    }

    /*
     *  携帯電話の場合、セッションIDを付ける。
     */
    if ( $mdevs==2 ) {
        $link_url .= "&amp;".$GLOBALS['KTAI_URL_TAIL'];
        if($ktai_number) {
            $link_url .= "#" . $ktai_number;
        }
    }

    return '<a href="'.$link_url.'" target="_blank">'.$link_str.'</a>';
}

?>
