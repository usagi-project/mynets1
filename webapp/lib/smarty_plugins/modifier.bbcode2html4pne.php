<?php
/*
 * ------------------------------------------------------------
 * @license    This source file is subject to version 3.01 of the PHP license,
 *             that is available at http://www.php.net/license/3_01.txt
 *             If you did not receive a copy of the PHP license and are unable
 *             to obtain it through the world-wide-web, please send a note to
 *             license@php.net so we can mail you a copy immediately.
 * @category   BBCode Smarty Plugin
 * @project    OpenPNE Extension Module Project 2007
 * @package    BBCode Input Suppot Module
 * @author     Naoya Shimada
 * @copyright  2007 Naoya Shimada
 * @version    0.1.0
 * @since      File available since Release OpenPNE 2.6.9,2.8.2, MyNETS 1.1.0 Nighty
 * @chengelog  [2007/08/07] Modifier for Special Tags of OpenPNE/MyNETS
 * @chengelog  [2007/12/24] Fix XSS vulnerability
 * ------------------------------------------------------------
 */

function _smarty_modifier_link4pnetags($preg)
{
    //OpenPNE専用タグ [member][topic][event][commu][community][diary][review][docci]
    if (defined('BBCODE_USE_PNE_TAG') && BBCODE_USE_PNE_TAG) {
        $preg['/\[member\]([0-9]+?)\[\/member\]/esi']       = '_smarty_modifier_link4member("\\1")';
        $preg['/\[diary\]([0-9]+?)(,[0-9]+?)?\[\/diary\]/esi']  = '_smarty_modifier_link4diary("\\1","\\2")';
        $preg['/\[topic\]([0-9]+?)(,[0-9]+?)?\[\/topic\]/esi']  = '_smarty_modifier_link4topic("\\1","\\2")';
        $preg['/\[event\]([0-9]+?)(,[0-9]+?)?\[\/event\]/esi']  = '_smarty_modifier_link4event("\\1","\\2")';
        $preg['/\[commu\]([0-9]+?)\[\/commu\]/esi']         = '_smarty_modifier_link4commu("\\1")';
        $preg['/\[community\]([0-9]+?)\[\/community\]/esi'] = '_smarty_modifier_link4commu("\\1")';
        $preg['/\[review\]([0-9]+?)\[\/review\]/esi']       = '_smarty_modifier_link4review("\\1")';
        if (defined('BBCODE_USE_DOCCI_TAG') && BBCODE_USE_DOCCI_TAG) {
            $preg['/\[docci\]([0-9]+?)\[\/docci\]/esi']         = '_smarty_modifier_link4docci("\\1")';
        }
    }

    return $preg;
}

function _smarty_modifier_link4member($member_id) {
    if (isKtaiUserAgent()) {
        $link_url = OPENPNE_URL . '?m=ktai&amp;a=page_f_home&amp;target_c_member_id=' . $member_id;
    } else {
        $link_url = OPENPNE_URL . '?m=pc&amp;a=page_f_home&amp;target_c_member_id=' . $member_id;
    }
    if (function_exists("smarty_modifier_t_url2pne") && (BBCODE_USE_T_URL2PNE || isKtaiUserAgent())) {
        $link_str = $link_url;
    } else {
        if (function_exists(db_common_c_member_with_profile)) {
            $member = db_common_c_member_with_profile($member_id);
        } else {
            $member = db_common_c_member4c_member_id_LIGHT($member_id);
        }
        if (empty($member['nickname'])) {
            if (isKtaiUserAgent()) {
                $link_str = '【該当するメンバーはいません】';
            } else {
                $link_str = '<span title="member=' . $member_id . '" class="bb-red">【該当するメンバーはいません】</span>';
            }
        } else {
            //PCの場合は自動リンク回避のためJavascriptで出力
            if (!isKtaiUserAgent() && preg_match('/(https?)(:\/\/.*)/si',$link_url, $matches)) {
                $link_str = "<script type=\"text/javascript\">document.write('<a href=\"" . $matches[1] . "'+'" . $matches[2] . "\" target=\"_blank\" title=\"" . $matches[1] . "'+'" . $matches[2] . "\" class=\"bb-url\">" . htmlspecialchars($member['nickname'], ENT_QUOTES) . "<'+'/a>');</script><noscript>" . $link_url . "</noscript>";
            } else {
                $link_str = htmlspecialchars($member['nickname'], ENT_QUOTES) . "<br>" . $link_url ."<br>";
            }
        }
    }
    return $link_str;
}

function _smarty_modifier_link4diary($diary_id, $comment_id = 0) {
    if (isKtaiUserAgent()) {
        $link_url = OPENPNE_URL . '?m=ktai&amp;a=page_fh_diary&amp;target_c_diary_id=' . $diary_id;
    } else {
        $link_url = OPENPNE_URL . '?m=pc&amp;a=page_fh_diary&amp;target_c_diary_id=' . $diary_id;
    }
    if (function_exists("smarty_modifier_t_url2pne") && (BBCODE_USE_T_URL2PNE || isKtaiUserAgent())) {
        $link_str = $link_url;
    } else {
        $db_msg = db_diary_get_c_diary4id($diary_id);
        if (function_exists(db_common_c_member_with_profile)) {
            $member = db_common_c_member_with_profile($db_msg['c_member_id']);
        } else {
            $member = db_common_c_member4c_member_id_LIGHT($db_msg['c_member_id']);
        }
        if (empty($db_msg['subject'])) {
            if (isKtaiUserAgent()) {
                $link_str = '【該当する日記はありません】';
            } else {
                $link_str = '<span title="diary=' . $diary_id . '" class="bb-red">【該当する日記はありません】</span>';
            }
        } else {
            //PCの場合は自動リンク回避のためJavascriptで出力
            if (!isKtaiUserAgent() && preg_match('/(https?)(:\/\/.*)/si',$link_url, $matches)) {
                $link_str = "<script type=\"text/javascript\">document.write('【<a href=\"" . $matches[1] . "'+'" . $matches[2] . "\" target=\"_blank\" title=\"" . $matches[1] . "'+'" . $matches[2] . "\" class=\"bb-url\">" . htmlspecialchars($db_msg['subject'], ENT_QUOTES) . "<'+'/a>】（" . htmlspecialchars($member['nickname'], ENT_QUOTES) . "さん）');</script><noscript>" . $link_url . "</noscript>";
            } else {
                $link_str = "【" . htmlspecialchars($db_msg['subject'], ENT_QUOTES) . "】（" . htmlspecialchars($member['nickname'], ENT_QUOTES) . "さん）" . "<br>" . $link_url ."<br>";
            }
        }
    }
    return $link_str;
}

function _smarty_modifier_link4topic($topic_id, $comment_id = 0) {
    if (isKtaiUserAgent()) {
        $link_url = OPENPNE_URL . '?m=ktai&amp;a=page_c_bbs&amp;target_c_commu_topic_id=' . $topic_id;
    } else {
        $link_url = OPENPNE_URL . '?m=pc&amp;a=page_c_topic_detail&amp;target_c_commu_topic_id=' . $topic_id;
    }
    if (function_exists("smarty_modifier_t_url2pne") && (BBCODE_USE_T_URL2PNE || isKtaiUserAgent())) {
        $link_str = $link_url;
    } else {
        $db_msg = _do_c_bbs_c_commu_topic4c_commu_topic_id($topic_id);
        if (empty($db_msg['name']) || $db_msg['event_flag'] == 1) {
            if (isKtaiUserAgent()) {
                $link_str = '【該当するトピックはありません】';
            } else {
                $link_str = '<span title="topic=' . $topic_id . '" class="bb-red">【該当するトピックはありません】</span>';
            }
        } else {
            $db_cmmu = _db_c_commu4c_commu_id($db_msg['c_commu_id']);
            //PCの場合は自動リンク回避のためJavascriptで出力
            if (!isKtaiUserAgent() && preg_match('/(https?)(:\/\/.*)/si',$link_url, $matches)) {
                $link_str = "<script type=\"text/javascript\">document.write('【トピック：<a href=\"" . $matches[1] . "'+'" . $matches[2] . "\" target=\"_blank\" title=\"" . $matches[1] . "'+'" . $matches[2] . "\" class=\"bb-url\">" . htmlspecialchars($db_msg['name'], ENT_QUOTES) . "<'+'/a>】（コミュニティ：" . htmlspecialchars($db_cmmu['name'], ENT_QUOTES) ."）');</script><noscript>" . $link_url . "</noscript>";
            } else {
                $link_str = "【" . htmlspecialchars($db_msg['name'], ENT_QUOTES) . "】トピック（コミュニティ：" . htmlspecialchars($db_cmmu['name'], ENT_QUOTES) ."）<br>" . $link_url ."<br>";
            }
        }
    }
    return $link_str;
}

function _smarty_modifier_link4event($topic_id, $comment_id = 0) {
    if (isKtaiUserAgent()) {
        $link_url = OPENPNE_URL . '?m=ktai&amp;a=page_c_bbs&amp;target_c_commu_topic_id=' . $topic_id;
    } else {
        $link_url = OPENPNE_URL . '?m=pc&amp;a=page_c_event_detail&amp;target_c_commu_topic_id=' . $topic_id;
    }
    if (function_exists("smarty_modifier_t_url2pne") && (BBCODE_USE_T_URL2PNE || isKtaiUserAgent())) {
        $link_str = $link_url;
    } else {
        $db_msg = _do_c_bbs_c_commu_topic4c_commu_topic_id($topic_id);
        if (empty($db_msg['name']) || $db_msg['event_flag'] != 1) {
            if (isKtaiUserAgent()) {
                $link_str = '【該当するイベントはありません】';
            } else {
                $link_str = '<span title="event=' . $topic_id . '" class="bb-red">【該当するイベントはありません】</span>';
            }
        } else {
            $db_cmmu = _db_c_commu4c_commu_id($db_msg['c_commu_id']);
            //PCの場合は自動リンク回避のためJavascriptで出力
            if (!isKtaiUserAgent() && preg_match('/(https?)(:\/\/.*)/si',$link_url, $matches)) {
                $link_str = "<script type=\"text/javascript\">document.write('【イベント：<a href=\"" . $matches[1] . "'+'" . $matches[2] . "\" target=\"_blank\" title=\"" . $matches[1] . "'+'" . $matches[2] . "\" class=\"bb-url\">" . htmlspecialchars($db_msg['name'], ENT_QUOTES) . "<'+'/a>】（コミュニティ：" . htmlspecialchars($db_cmmu['name'], ENT_QUOTES) ."）');</script><noscript>" . $link_url . "</noscript>";
            } else {
                $link_str = "【" . htmlspecialchars($db_msg['name'], ENT_QUOTES) . "】イベント（コミュニティ：" . htmlspecialchars($db_cmmu['name'], ENT_QUOTES) ."）<br>" . $link_url ."<br>";
            }
        }
    }
    return $link_str;
}

function _smarty_modifier_link4commu($commu_id) {
    if (isKtaiUserAgent()) {
        $link_url = OPENPNE_URL . '?m=ktai&amp;a=page_c_home&amp;target_c_commu_id=' . $commu_id;
    } else {
        $link_url = OPENPNE_URL . '?m=pc&amp;a=page_c_home&amp;target_c_commu_id=' . $commu_id;
    }
    if (function_exists("smarty_modifier_t_url2pne") && (BBCODE_USE_T_URL2PNE || isKtaiUserAgent())) {
        $link_str = $link_url;
    } else {
        $db_msg = _db_c_commu4c_commu_id($commu_id);
        if (empty($db_msg['name'])) {
            if (isKtaiUserAgent()) {
                $link_str = '【該当するコミュニティはありません】';
            } else {
                $link_str = '<span title="commu=' . $commu_id . '" class="bb-red">【該当するコミュニティはありません】</span>';
            }
        } else {
            //PCの場合は自動リンク回避のためJavascriptで出力
            if (!isKtaiUserAgent() && preg_match('/(https?)(:\/\/.*)/si',$link_url, $matches)) {
                $link_str = "<script type=\"text/javascript\">document.write('【コミュニティ：<a href=\"" . $matches[1] . "'+'" . $matches[2] . "\" target=\"_blank\" title=\"" . $matches[1] . "'+'" . $matches[2] . "\" class=\"bb-url\">" . htmlspecialchars($db_msg['name'], ENT_QUOTES) . "<'+'/a>】');</script><noscript>" . $link_url . "</noscript>";
            } else {
                $link_str = "【" . htmlspecialchars($db_msg['name'], ENT_QUOTES) . "】コミュニティ<br>" . $link_url ."<br>";
            }
        }
    }
    return $link_str;
}

function _smarty_modifier_link4review($review_id) {
    if (isKtaiUserAgent()) {
        //携帯の場合はレビューはない
        $link_url = "";
    } else {
        $link_url = OPENPNE_URL . '?m=pc&amp;a=page_h_review_list_product&amp;c_review_id=' . $review_id;
    }
    /*
    //MyNETS-1.1.1stableのsmarty_modifier_t_url2pneには存在するが、レビュー小窓を仕様するように
    //なっているので、事前にレビュー小窓の使用の有無を確認して、そこで使わなければ、独自処理とする。
    if (function_exists("smarty_modifier_t_url2pne") && (BBCODE_USE_T_URL2PNE || isKtaiUserAgent())) {
        $link_str = $link_url;
    } else {
    */
        if (function_exists("db_review_list_product_c_review4c_review_id")) {
            $db_msg = db_review_list_product_c_review4c_review_id($review_id);
        } else {
            $db_msg = p_h_review_list_product_c_review4c_review_id($review_id);
        }
        if (empty($db_msg['title'])) {
            if (isKtaiUserAgent()) {
                $link_str = '【該当するレビューはありません】';
            } else {
                $link_str = '<span title="review=' . $review_id . '" class="bb-red">【該当するレビューはありません】</span>';
            }
        } else {
            //PCの場合は自動リンク回避のためJavascriptで出力
            if (!isKtaiUserAgent() && preg_match('/(https?)(:\/\/.*)/si',$link_url, $matches)) {
                $link_str = "<script type=\"text/javascript\">document.write('【レビュー：<a href=\"" . $matches[1] . "'+'" . $matches[2] . "\" target=\"_blank\" title=\"" . $matches[1] . "'+'" . $matches[2] . "\" class=\"bb-url\">" . htmlspecialchars($db_msg['title'], ENT_QUOTES) . "<'+'/a>】');</script><noscript>" . $link_url . "</noscript>";
            } else {
                $link_str = "【" . htmlspecialchars($db_msg['title'], ENT_QUOTES) . "】のレビュー<br>" . $link_url ."<br>";
            }
        }
    //}
    return $link_str;
}

// ドッチを使用する場合に有効
// https://sourceforge.jp/projects/openpneplus
function _smarty_modifier_link4docci($docci_id) {
    if (isKtaiUserAgent()) {
        $link_url = OPENPNE_URL . '?m=ktai_docci&amp;a=page_view&amp;docci_topic_id=' . $docci_id;
    } else {
        $link_url = OPENPNE_URL . '?m=pc_docci&amp;a=page_view&amp;docci_topic_id=' . $docci_id;
    }
    $sql = "SELECT value FROM docci_config where name = 'docci_name'";
    $docci_name = db_get_one($sql);
    if (empty($docci_name)) {
        $docci_name = 'ドッチ';
    }
    $sql = 'SELECT * FROM docci_topic WHERE docci_topic_id = ?';
    $db_msg = db_get_row($sql, array(intval($docci_id)));
    if (empty($db_msg['topic'])) {
        if (isKtaiUserAgent()) {
            $link_str = '【該当する' . htmlspecialchars($docci_name, ENT_QUOTES) . 'はありません】';
        } else {
            $link_str = '<span title="docci=' . $review_id . '" class="bb-red">【該当する' . htmlspecialchars($docci_name, ENT_QUOTES) . 'はありません】</span>';
        }
    } else {
        //PCの場合は自動リンク回避のためJavascriptで出力
        if (!isKtaiUserAgent() && preg_match('/(https?)(:\/\/.*)/si',$link_url, $matches)) {
            $link_str = "<script type=\"text/javascript\">document.write('【" . htmlspecialchars($docci_name, ENT_QUOTES) . "：<a href=\"" . $matches[1] . "'+'" . $matches[2] . "\" target=\"_blank\" title=\"" . $matches[1] . "'+'" . $matches[2] . "\" class=\"bb-url\">" . htmlspecialchars($db_msg['topic'], ENT_QUOTES) . "<'+'/a>】');</script><noscript>" . $link_url . "</noscript>";
        } else {
            $link_str = "【" . htmlspecialchars($db_msg['topic'], ENT_QUOTES) . "】の" . htmlspecialchars($docci_name, ENT_QUOTES) . "<br>" . $link_url ."<br>";
        }
    }

    return $link_str;
}

?>
