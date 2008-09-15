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
 * @version    MyNETS,v 1.1.1
 * @since      File available since Release 1.1.1 Nighty
 * @chengelog  [2007/09/01] Ver1.1.1 Nighty package
 * ======================================================================== 
 */

/**
 * OpenPNE
 * @copyright 2005-2006 OpenPNE Project
 * @link      http://www.tejimaya.com/openpne.shtml
 *
 */

class pc_page_h_sns_news_data extends OpenPNE_Action
{
    function execute($requests)
    {
    
    $source = $requests['source'];
    $type = $requests['type'];
    $keyword = $requests['key'];
    $keyword = str_replace("　", " ", $keyword);
    
    if (defined('NEWS_FEED_MAX') && NEWS_FEED_MAX > 0) {
        $max = NEWS_FEED_MAX;
    } else {
        $max = 10;
    }
    
    // ニュースソースが指定されていない場合は、GoogleNewsでトピック別、またはキーワード検索
    if(empty($source)) {
        if($type == 'f') {
            $words = '';
            $keyword_list = explode(' ', $keyword);
            foreach ($keyword_list as $word) {
                $words .= $word . '|';
            }
            //example http://news.google.com/news?hl=ja&ned=us&ie=UTF-8&oe=UTF-8&output=atom&topic=h
            $url = 'http://news.google.com/news?hl=ja&ned=us&ie=UTF-8&oe=UTF-8&output=atom&q='.$words;
        } else {
            $url = "http://dailynews.yahoo.co.jp/fc/{$type}/rss.xml";
        }
    } else {
        $url = $GLOBALS['NEWS_FEED_URL_LIST'][$source];
    }

    // 取得した記事の結果
    $result = array();

    if($url) {
        require_once('News_RSS.class.php');
        $news = new News_RSS();

        if (!empty($GLOBALS['NEWS_PROXY_CONFIG']) && $GLOBALS['NEWS_PROXY_CONFIG']['ENABLE_PROXY']) {
            $news->setProxy($GLOBALS['NEWS_PROXY_CONFIG']);
        }

        $news->setCacheLocation(defined('NEWS_CACHE_DIR') ? NEWS_CACHE_DIR : OPENPNE_RSS_CACHE_DIR);
        
        $news->setCacheLimit($lifetime);

        $news->setRemoveLinkList($GLOBALS['NEWS_REMOVE_LINK_URL_LIST']);

        $news->setRemoveTitleList($GLOBALS['NEWS_REMOVE_TITLE_LIST']);

        $news->setExtractLinkList($GLOBALS['NEWS_EXTRACT_LINK_URL_LIST']);

        $news->setMax($max);

        // テキストの区切り位置をセット
        if (defined('NEWS_DESCRIPTION_LENGTH')) {
            $news->setBodyLength(NEWS_DESCRIPTION_LENGTH);
        }

        // テキストの省略文字列をセット
        if (defined('NEWS_DESCRIPTION_ETC')) {
            $news->setEtc(NEWS_DESCRIPTION_ETC);
        }

        $result = $news->fetch($url);
        // 省略文がbodyと同等の場合はbodyを削除
        if($result) {
            foreach($result as $key => $value) {
                if(strlen($value['text']) >= strlen(preg_replace(array('/&nbsp;/i', '/\s+/', '/　/'), array('', '', ''), strip_tags($value['body'])))) {
                    $result[$key]['body'] = '';
                }
            }
        }
    } else {
        $result = '';
    }

    $this->set(data, $result);

    return 'success';
    }
}

?>
