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

require_once 'PNE/SimplePie.php';

/**
 * OpenPNE_RSS
 * RSS/Atom取得ライブラリ
 */
class OpenPNE_RSS
{
    /** @var string 出力文字エンコーディング */
    var $charset;

    function OpenPNE_RSS($charset = '')
    {
        $this->charset = $charset;
    }

    function fetch($rss_url)
    {
        $feed = new PNE_SimplePie();

        /*フィードURLの設定*/
        $feed->feed_url($rss_url);
        /*キャッシュディレクトリの設定*/
        $feed->cache_location(OPENPNE_RSS_CACHE_DIR);

        /*フィード開始*/
        if (!$feed->init()) {
            return false;
        }

//2007-12-14 shima3指摘＆が重複して処理される部分を対応
        $trans_table = array_flip(get_html_translation_table(HTML_SPECIALCHARS, ENT_QUOTES));
        $trans_table['&#039;'] = "'";
        $trans_table['&apos;'] = "'";

        $result = array();
        foreach ($feed->get_items() as $item) {
            $title = $item->get_title();
            $links = $item->get_links();
            $description = $item->get_description();
            $date = @$item->get_date('Y-m-d H:i:s');

            if (!$title) {
                $title = '';
            }

            if (!$description) {
                $description = '';
            }

            if (!$links) {
                $link = '';
            } else {
                $link = $links[0];
            }

            if (!$date) {
                $date = '';
            }

            // エスケープされた文字列を元に戻す
//2007-12-14 shima3指摘＆が重複して処理される部分を対応
            $title       = strtr($title      , $trans_table);
            $description = strtr($description, $trans_table);
            $link        = strtr($link       , $trans_table);
            $link        = strtr($link       , $trans_table);

            $f_item = array(
                'title' => $this->convert_encoding($title),
                'body'  => $this->convert_encoding($description),
                'link'  => $link,
                'date'  => $date,
            );
            $result[] = $f_item;
        }
        return $result;
    }

    function convert_encoding($string)
    {
        if (!$this->charset) {
            return $string;
        }
        return mb_convert_encoding($string, $this->charset, 'UTF-8');
    }

    /**
     * RSS/Atom Auto-Discovery に対応したlinkタグからURLを抽出する(static)
     */
    function auto_discovery($url)
    {
        $feed = new PNE_SimplePie();
        $data = @$feed->get_file($url);

        // htmlを取得できたか調べる
        if (!$data) {
            return false;
        }

        // feedであれば、パラメタをそのまま返す
        if ($feed->is_feed($data, false)) {
            return $url;
        }
        // Auto-Discovery に対応したURLを返す
        return $feed->check_link_elements($data, $url);
    }
}

?>
