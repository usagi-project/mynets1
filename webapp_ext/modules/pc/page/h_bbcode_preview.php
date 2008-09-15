<?php
/**
 * @copyright 2008 Naoya Shimada
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class pc_page_h_bbcode_preview extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();
        $target_c_member_id = $u;

        // --- リクエスト変数
        $target_id = $requests['target_id'];
        $page      = $requests['page'];
        $browser   = $requests['browser'];
        $this->set("body",      $requests['body']); // 本文
        $this->set("target_id", $target_id);        // コミュニティ・イベント・トピック・日記・レビューのID
        $this->set("id",        $requests['id']);   // 「<body id="～">」の「～」の部分
        $this->set("page",      $page);             // 「<body id="pc_page_～">」の「～」の部分($INC_HEADER_page_name)
        $this->set("browser",   $browser);          // ブラウザの種類（ie / opera / mozilla / navigator / safari / other）
        // ----------

        unset($type);
        if (preg_match('@^(?:page_)?((?:[a-z]+)_(?:[a-z]+))(.*)$@i',$page, $matches)) {
            $type = $matches[1];
        }

        if ( isset($type) ) {
            switch($type) {
            case 'c_edit' :
            case 'h_com' :
                //コミュニティの場合はコミュニティ情報取得
                //$c_commu = db_commu_c_commu4c_commu_id($target_id);
                //$this->set('c_commu', $c_commu);
                break;
            case 'c_event' :
                //イベントの場合はイベント情報取得
                //$c_topic = db_commu_c_topic4c_commu_topic_id_2($target_id);
                //$this->set('c_topic', $c_topic);
                break;
            case 'c_topic' :
                //トピックの場合はトピック情報取得
                //$c_topic = db_commu_c_topic4c_commu_topic_id_2($target_id);
                //$this->set('c_topic', $c_topic);
                break;
            case 'fh_diary' :
            case 'h_diary' :
                //日記の場合は日記情報取得
                //$c_diary = db_diary_get_c_diary4id($target_id);
                //$this->set('c_diary', $c_diary);
                $type = 'h_diary';
                break;
            case 'h_review' :
                //レビューの場合はレビュー情報取得
                //しなくても問題ないのでそのまま抜ける
                break;
            default:
                $type ='';
                break;
            }
        }

        $this->set("type", $type);
        $this->set("c_member_id", $target_c_member_id);

        $view =& $this->getView();
        $view->ext_display('h_bbcode_preview.tpl');
        exit;
    }
}

?>
