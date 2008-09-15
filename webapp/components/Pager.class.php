<?php
/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @project    UsagiProject 2006-2007
 * @author     Kunitsuji <kunitsuji@gmail.com>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  2006-2007 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @chengelog  [2007/12/17]
 * ========================================================================
 */

//ページャークラス
include_once OPENPNE_LIB_DIR . '/include/Pager/Pager.php';

class Usagi_Pager
{

    function __construct()
    {
    }

    function Usagi_Pager()
    {
        $this->__construct();
    }

    function set($num, $pagesize, $returnurl)
    {
        $options = array(
        // 全アイテム数の設定
        "totalItems" => $num,
        // 1ページに表示するインデックス数の設定
        "delta"      => 10,
        // 1ページのアイテム数の設定(全アイテム数からこの数字を割った数がページ数になります)
        "perPage"    => $pagesize,
        // Pager動作モードの設定
        "mode"       => "Jumping",
        // 現在のページ数の設定
        "altFirst"   => "最初",
        "altPrev"    => "前へ",
        "altNext"    => "次へ",
        "altLast"    => "最後",
        "altPage"    => "ページ",
        "prevImg"    => "[前へ]",
        "nextImg"    => "[次へ]",
        // ページ番号ごとにはさむ文字列の設定
        "separator"  => "|",

        // 使用するGET引数の設定
        "urlVar"     => "page",

        // <a>タグのスタイルシートのクラスの設定
        "linkClass"  => "link",
        "curPageLinkClassName"=> "clink",

        // appendを0にすることでfileNameが有効になる
         "append"     => 0,
         "fileName"   => $returnurl,
        );
        // Pagerインスタンスの作成
        if (version_compare(phpversion(), '5.0.0') == -1) {
            $pager = new Pager($options);
        } else {
            $pager = Pager::factory($options); //PHP5の場合はこちらで呼び出し
        }
        return $pager->links;
    }
}
?>
