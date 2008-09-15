<?php
/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @category   MyNETS
 * @project    UsagiProject 2006-2008
 * @package    [[パッケージ名またはスクリプト名]]
 * @author     KUNIHARU Tsujioka <author@example.com>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  KUNIHARU Tsujioka
 * @copyright  2006-2008 UsagiProject <author member ad  http://usagi.mynets.jp/member.html>
 * @version
 * @chengelog
 * ========================================================================
 */

/**
 * [[機能説明]]
 *
 * @access  public
 */

require_once OPENPNE_WEBAPP_DIR . '/components/one_word.class.php';
include_once OPENPNE_LIB_DIR . '/include/Pager/Pager.php';

class ktai_page_f_one_word_list extends OpenPNE_Action
{
    var $page_size = 20;

    function execute($requests)
    {

        $u  = $GLOBALS['KTAI_C_MEMBER_ID'];

        //=======================================
        //request parameters get
        //=======================================
        //ここでリクエストパラメータを取得する
        $page = $requests['page'];
        if (! $page)
        {
            $page = 1;
        }
        $target_c_member_id = $requests['target_c_member_id'];

        //=======================================
        //logic block
        //=======================================
        //ここでビジネスロジックを記述する
        $oneword = new OneWord();
        if ($target_c_member_id)
        {
            $other_word = $oneword->getListMember($target_c_member_id, $this->page_size, $page);
        }
        else
        {   //他人指定のリスト取得
            $other_word = $oneword->getList($this->page_size, $page);
        }
        $total_num  = $oneword->getTotalNum();

        $options = array(
        // 全アイテム数の設定
        "totalItems" => $total_num,
        // 1ページに表示するインデックス数の設定
        "delta"      => 5,
        // 1ページのアイテム数の設定(全アイテム数からこの数字を割った数がページ数になります)
        "perPage"    => $this->page_size,
        // Pager動作モードの設定
        "mode"       => "Jumping",
        // 現在のページ数の設定
        "altFirst"   => "[TOP]",
        "altPrev"    => "[前]",
        "altNext"    => "[次]",
        "altLast"    => "[LAST]",
        "altPage"    => "PAGE",
        "prevImg"    => "< 前",
        "nextImg"    => "次 >",
        // ページ番号ごとにはさむ文字列の設定
        "separator"  => "|",

        // 使用するGET引数の設定
        "urlVar"     => "page",

        // <a>タグのスタイルシートのクラスの設定
        "linkClass"  => "link",
        "curPageLinkClassName"=> "clink",

        // appendを0にすることでfileNameが有効になる
         "append"     => 0,
         "fileName"   => "?m=ktai&a=page_f_one_word_list&page=%d&target_c_member_id="
                            .$target_c_member_id
                            ."&".$GLOBALS['KTAI_URL_TAIL'],
        );

        // Pagerインスタンスの作成
        if (version_compare(phpversion(), '5.0.0') == -1) {
            $pager = new Pager($options);
        } else {
            $pager = Pager::factory($options); //PHP5の場合はこちらで呼び出し
        }
        //ページャーここまで

        //=======================================
        //template assign block
        //=======================================
        //ここでテンプレートへ変数をセットする
        //$this->set('[[パラメータ名]]', [[セットするパラメータ変数]]);
        $this->set('other_word', $other_word);
        $this->set('page_link',$pager->links);
        $this->set('target_c_member_id', $target_c_member_id);
        return 'success';

    }
}
?>
