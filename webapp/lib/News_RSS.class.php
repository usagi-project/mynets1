<?php
/* ========================================================================
 *
 * @license This source file is subject to version 3.01 of the PHP license,
 *              that is available at http://www.php.net/license/3_01.txt
 *              If you did not receive a copy of the PHP license and are unable
 *              to obtain it through the world-wide-web, please send a note to
 *              license@php.net so we can mail you a copy immediately.
 *
 * @project    UsagiProject 2006-2008
 * @author     Naoya Shimada <info@usagi-project.org>
 * @author     UsagiProject <info@usagi-project.org>
 * @copyright  Naoya Shimada <author member ad http://usagi-project.org/member.html>
 * @copyright  2006-2008 UsagiProject <author member ad http://usagi-project.org/member.html>
 * @chengelog  [2007/11/26] Ver1.1.1Nighty package
 *             [2008/07/26] Add cache merge mode.
 *             [2008/08/16] Add collection mode.
 * ========================================================================
 */

require_once 'simplepie.inc';

/**
 * News_RSS
 * ニュースのRSS/Atom取得・解析ライブラリ
 * @see OpenPNE_RSS
 */
class News_RSS
{
    var $_charset;
    var $_item_max = 10;
    var $_url;
    var $_proxy;
    var $_limit = 3600;
    var $_body_length = 200;
    var $_etc = '...';
    var $_remove_link_list;
    var $_remove_title_list;
    var $_extract_link_list;
    var $_cache_lite;
    var $_cache_group = 'news';
    var $_cache_merge = false;
    var $_cache_id = '';
    var $_cache_name = 'merged_news_cache.xml';
    var $_cache_link = OPENPNE_URL;
    var $_collection = true;
    var $_no_collect = null; //無期限

    /*
     * コンストラクタ
     * @param string $charset 文字コード
     */
    function News_RSS($charset = '')
    {
        $this->_charset = $charset;

        // PEAR::Cache_Lite
        require_once 'Cache/Lite.php';

        // キャッシュ
        $options = array(
            // キャッシュクリーニングはしない
            'automaticCleaningFactor' => 0,
            // 読み込み制御は'strlen'（最速）で。最良なのは'md5'（遅い）、次は'crc32'（デフォ：速い）
            'readControlType' => 'strlen',
            'pearErrorMode' => CACHE_LITE_ERROR_DIE
        );
        $this->_cache_lite = new Cache_Lite($options);
    }

    /*
     * 記事内容を省略した際の末尾の文字列をセット
     * @param string $etc 末尾の文字列
     */
    function setEtc($etc = '...') {
        $this->_etc = $etc;
    }

    /*
     * 記事内容の文字列長をセット
     * @param int $length 文字列長
     */
    function setBodyLength($length = 100) {
        if (isset($length) && $length >= 0) {
            $this->_body_length = $length;
        }
    }

    /*
     * 最大取得項目数をセット
     * @param int $max 最大取得項目数
     */
    function setMax($max = 0) {
        $this->_item_max = intval($max);
    }

    /*
     * キャッシュの出力パスをセット
     * @param string $path 出力パス
     */
    function setCacheLocation($path) {
        if (strcasecmp(substr(PHP_OS, 0, 3),'WIN') == 0) {
            // Windowsの場合
            $path = str_replace('\\', '/', $path);
            $path = str_replace('//', '/', $path);
            // 末尾が「/」で終わっていないなら付加する
            if (!preg_match('@^(.*)/$@', $path, $matches)) {
                $path .= '/';
            }
            $path = str_replace('/', '\\', $path);
        } else {
            // Windows以外の場合
            // 末尾が「/」で終わっていないなら付加する
            if (!preg_match('@^(.*)/$@', $path, $matches)) {
                $path .= '/';
            }
        }
        $this->_cache_lite->setOption('cacheDir', $path);
    }

    /*
     * キャッシュ有効期限をセット
     * @param int $limit 有効期限
     */
    function setCacheLimit($limit) {
        if (!$this->_collection) {
            //収集しない場合
            $this->_cache_lite->setOption('lifeTime', $this->_no_collect);
        } elseif (!empty($limit) && intval($limit) > 0) {
            $this->_cache_lite->setOption('lifeTime', intval($limit));
        } else {
            $this->_cache_lite->setOption('lifeTime', $this->_limit);
        }
    }

    /*
     * URLをセット
     * @param string $url URL
     */
    function setFeedURL($url) {
        $this->_url = $url;
    }

    /*
     * URLを返す
     * @return string $url URL
     */
    function getFeedURL() {
        return $this->_url;
    }

    /*
     * プロキシをセット
     * @param array $proxy プロキシ
     */
    function setProxy($proxy = null) {
        if (!empty($proxy)) {
            $this->_proxy = $proxy;
        }
    }

    /*
     * 除外リンク正規表現リストをセット
     * @param array $list 除外リンク正規表現リスト
     */
    function setRemoveLinkList($list = null) {
        $this->_remove_link_list = $list;
    }

    /*
     * 除外タイトル正規表現リストをセット
     * @param array $list 除外タイトル正規表現リスト
     */
    function setRemoveTitleList($list = null) {
        $this->_remove_title_list = $list;
    }

    /*
     * リンク抽出用正規表現リストをセット
     * @param array $list リンク抽出用正規表現リスト
     */
    function setExtractLinkList($list = null) {
        $this->_extract_link_list = $list;
    }

    /*
     * ニュースをマージした結果をキャッシュするか否か
     * @param boolean $is_merge ニュースをマージした結果をキャッシュするか否か
     */
    function setCacheMerge($is_merge = false) {
        $this->_cache_merge = $is_merge;
    }

    /*
     * ニュースをマージする場合のID
     * 複数個所でマージモードを利用する場合に、一意に特定するためのIDをセットし、
     * キャッシュファイルのバッティングを防ぐために使用します。
     * @param string $id 英数字
     */
    function setCacheMergeID($id = '') {
        $this->_cache_id = $id;
    }

    /*
     * マージ用のファイル名を生成
     */
    function _getCacheName() {
        return $this->_cache_id . $this->_cache_name;
    }

    /*
     * 収集するか否か
     */
    function setCollection($collection = true) {
        $this->_collection = ($collection === false) ? false : true;
        if (!$this->_collection) {
            //収集しない場合
            $this->_cache_lite->setOption('lifeTime', $this->_no_collect);
        }
    }
    function getCollection() {
        return $this->_collection;
    }

    /*
     * フィードのURLリストから一括してデータを取得して返す
     * @param array  $rss_url_list URLのリスト
     * @param array  $proxy プロキシの情報（プロキシ不要なら省略可）
     * @return array 結果
     */
    function fetchAll($rss_url_list = array(), $proxy = array()) {
        if (empty($rss_url_list) || count($rss_url_list)==0) {
            return array();
        }
        if (!empty($proxy)) {
            $this->setProxy($proxy);
        }

        //キャッシュのバッティングを避けるためバッティングしないだろうIDを生成する
        $this->setCacheMergeID(join("",$rss_url_list));

        //マージしてキャッシュを保存する場合は、キャッシュからの取得を試みる
        if ($this->_cache_merge) {
            if ($result = $this->_cache_lite->get($this->_getCacheName(), $this->_cache_group)) {
                return $this->parseFeed($result);
            }
        }

        //全ニュースを取得
        $result = array();
        foreach($rss_url_list as $url) {
            if (preg_match('/^http:\/\//', $url, $matches)) {
                if (!empty($result)) {
                    // ２つ目以降のニュースソースの場合
                    $ret = $this->fetch($url);
                    if (!empty($ret)) {
                        // 既存の結果と取得した結果をマージ
                        $result = array_merge($result, $ret);
                    }
                } else {
                    // １つめのニュースソースの場合
                    $result = $this->fetch($url);
                }
            }
        }

        if ($this->_cache_merge) {
            //マージしてキャッシュを保存する場合は、結合した結果を保存する
            $this->saveNews($result);
        }

        //結果を返す
        return $result;
    }

    /*
     * 指定されたフィードからデータを取得して返す
     * @param string $url   URL（setFeedURLでセット済みなら省略可）
     * @param array  $proxy プロキシの情報（プロキシ不要なら省略可）
     * @return array 結果
     */
    function fetch($rss_url = null, $proxy = array()) {
        if (!empty($rss_url)) {
            $this->setFeedURL($rss_url);
        }
        if (!empty($proxy)) {
            $this->setProxy($proxy);
        }

        //フィードを読み込む
        $result = $this->loadFeed($this->getFeedURL());

        //フィードを解析して返す
        return $this->parseFeed($result);
    }


    /*
     * 指定されたフィードからデータを取得して返す
     */
    function parseFeed($raw_data = null)
    {
        // SimplePieに生データをセットして操作する
        $feed = new SimplePie();
        $feed->set_raw_data($raw_data);

        // Feed初期化
        if (!(@$feed->init())) {
            return false;
        }

        // <item>項目取得
        if (!($items = $feed->get_items())) {
            return false;
        }

        // 記事の最大取得件数を設定
        $len = count($items);
        if ($this->_item_max > 0) {
            $max = ($this->_item_max > $len) ? $len : $this->_item_max;
        } else {
            $max = $len;
        }

        // エスケープされた文字列を元に戻すためのテーブル
        $trans_table = array_flip(get_html_translation_table(HTML_SPECIALCHARS, ENT_QUOTES));
        $trans_table['&#039;'] = "'";
        $trans_table['&apos;'] = "'";

        $result = array();
        for ($i = 0; $i < $len; $i++) {
            // 最大取得件数を超えたら抜ける
            if (count($result) >= $max) {
                break;
            }

            // １項目取り出す
            $item = $items[$i];

            // タイトルを取り出す
            if (!($title = $item->get_title())) {
                $title = '';
            } else {
                // 広告などのタイトルは対象外とする
                if ($this->isRemoveTitle($title)) {
                    continue;
                }
            }

            // URLを取り出す
            if (!($links = $item->get_links())) {
                $link = '';
                $permalink = '';
            } else {
                $link = $links[0];
                if ($this->isRemoveLink($link)) {
                    // 広告などのリンクは対象外とする
                    continue;
                } elseif ($this->isExtractLink($link,$matches)) {
                    // link要素の一部に元記事のURLがある場合にはそれを切り出す
                    $permalink = $matches[2];
                } else {
                    $permalink = $link;
                }
            }

            // 概要を取り出す
            if (!($description = $item->get_description())) {
                $description = '';
            }

            // 日付・日時・時間を取り出す
            if (!($date = @$item->get_date('Y-m-d H:i'))) {
                $date = '';
            }
            if (!($datetime = @$item->get_date('Y-m-d H:i:s O'))) {
                $datetime = '';
            }
            if (!($time = strtotime(@$item->get_date('Y-m-d H:i:s O')))) {
                $date = 0;
            }

            // エスケープされた文字列を元に戻す
            $title = strtr($title, $trans_table);
            $description = strtr($description, $trans_table);

            // カテゴリを取り出す（エスケープから戻しつつ）
            $category = array();
            if (($categories = $item->get_categories())) {
                foreach($categories as $key => $value) {
                    if (!empty($value->term)) {
                        $category[] = strtr($value->term, $trans_table);
                    }
                }
            }

            // 概要からタグを除去してテキストを取り出す
            $body_text = $this->truncate(preg_replace(array('/&nbsp;/i', '/\s+/', '/　/'), array('', '', ''), strip_tags($description)));

            $f_item = array(
                'title' => $this->encode($title),
                'body'  => $this->encode($description),
                'text'  => $this->encode($body_text),
                'link'  => $link,
                'permalink' => $permalink,
                'category' => $category,
                'date'  => $date,
                'datetime'  => $datetime,
                'time'  => $time,
            );
            $result[] = $f_item;
        }

        return $result;
    }

    /*
     * テキストを指定された位置で切る
     * @@aram string $string 概要のテキスト
     * @param int    $length 区切る位置
     * @param string $etc 区切った後に負荷する文字
     * @return string 区切った後の文字列
     */
    function truncate($string, $length = null, $etc = null) {
        $length = is_null($length) ? $this->_body_length : $length;
        // もし、区切り位置が「0」以下だったら、区切らずに全部返す
        if ($length <= 0) {
            return $string;
        }
        $etc = empty($etc) ? $this->_etc : $etc;
        if (strlen($string) > $length) {
            $length -= strlen($etc);
            $string = mb_strimwidth($string, 0, $length, $etc);
        }
        return $string;
    }

    /*
     * 文字列の文字コードを変換して返す
     * @param string $string 文字列
     * @return string 文字コード変換後の文字列
     */
    function encode($string)
    {
        if (!$this->_charset) {
            return $string;
        }
        return mb_convert_encoding($string, $this->_charset, 'UTF-8');
    }

    /*
     * フィードをロードする
     */
    function loadFeed($cache_name, $cache_group = null)
    {
        $_group = empty($cache_group) ? $this->_cache_group : $cache_group;

        // キャッシュが存在するなら、それを取得する
        if ($result = $this->_cache_lite->get($cache_name, $_group)) {
            ;;
        } else {
            // キャッシュが存在しないor有効でないので、データを取得してキャッシュに保存
            $result = $this->sendRequest();
            $this->_cache_lite->save($result, $cache_name, $_group);
        }

        // ニュースを返す
        return $result;
    }

    /*
     * ニュースを結合したものをキャッシュにセーブする
     */
    function saveNews($result = array())
    {
            //フィードとして整形
            $rss = '<?xml version="1.0" encoding="utf-8"?>' . "\n" .
                   '<rss version="2.0" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xml:lang="ja">' .
                   '<channel>' .
                   '<title>News</title>' .
                   '<link>'. $this->_cache_link . '</link>' .
                   '<description>News</description>' .
                   '<lastBuildDate>' . date('r') . '</lastBuildDate>' . "\n";

            foreach($result as $value) {
                $permalink = preg_replace('/&amp;/i','&',$value['permalink']);
                $permalink = preg_replace('/&/','&amp;',$permalink);
                $rss .= '<item>' .
                        '<title>' . htmlspecialchars($value['title']) . '</title>' .
                        '<description><![CDATA[' . "\n" . $value['body'] . "\n" . ']]></description>' .
                        '<link>' . $permalink . '</link>' .
                        '<guid isPermaLink="true">' . $permalink . '</guid>' .
                        (count($value['category'])>0 ? '<category>' . htmlspecialchars(join(",",$value['category'])) . '</category>' : '') .
                        '<pubDate>' . date('r',strtotime($value['datetime'])) . '</pubDate>' .
                        '</item>' . "\n";
            }

            $rss .= '</channel></rss>' . "\n";

            //キャッシュにセーブ
            $this->_cache_lite->save($rss, $this->_getCacheName(), $this->_cache_group);
    }

    /*
     * 指定されたURLにリクエストを投げ、結果を取得して返す
     * @param string $url   URL（setFeedURLでセット済みなら省略可）
     * @param array  $proxy プロキシの情報（プロキシ不要なら省略可）
     * @return string 結果
     */
    function sendRequest($url = null, $proxy = array())
    {
        require_once 'HTTP/Request.php';
        if (!empty($url)) {
            $this->setFeedURL($url);
        }
        $http = &new HTTP_Request($this->getFeedURL());
        $http->addHeader('User-Agent', 'RSS Reader');
        // Proxyを設定
        $proxy = empty($proxy) ? $this->_proxy : $proxy;
        if (!empty($proxy)) {
            if (!empty($proxy['proxy_host']) && !empty($proxy['proxy_port'])) {
                $http->setProxy($proxy['proxy_host'], $proxy['proxy_port'], $proxy['proxy_user'], $proxy['proxy_pass']);
            }
        }
        // リクエスト送信
        $http->sendRequest();

        $status = $http->getResponseCode();
        if ($status >= 200 && $status < 300){
            // ステータスが200番台ならOK
            return $http->getResponseBody();
        } elseif ($status >= 300 && $status < 400) {
            // ステータスが300番台の場合はLocationを取得して、再送信＆再取得
            $nexturl = $http->getResponseHeader("Location");
            $http->setURL($nexturl);
            $http->sendRequest();
            $status = $http->getResponseCode();
            if ($status >= 200 && $status < 300){
                // ステータスが200番台ならOK
                return $http->getResponseBody();
            } elseif ($status >= 300 && $status < 400) {
                // ステータスが300番台の場合はLocationを取得して、再送信＆再取得
                $nexturl = $http->getResponseHeader("Location");
                $http->setURL($nexturl);
                $http->sendRequest();
                $status = $http->getResponseCode();
                // ３回目もダメならあきらめる
                if ($status >= 200 && $status < 300){
                    // ステータスが200番台ならOK
                    return $http->getResponseBody();
                }
            }
        }
        // 取得失敗
        return "";
    }

    /*
     * 広告などのURLに一致する場合は除去したい
     * そこで一致するかチェックする
     * @param $link URL
     * @return boolean
     */
    function isRemoveLink($link)
    {
        // 広告などの除去用URLのリスト（正規表現であること）
        if (empty($this->_remove_link_list)) {
            return false;
        }
        // チェック
        foreach($this->_remove_link_list as $key => $pattern) {
            if (preg_match($pattern, $link, $matches)) {
                return true;
            }
        }
        return false;
    }

    /*
     * 広告などのタイトルに一致する場合は除去したい
     * そこで一致するかチェックする
     * @param $title Title
     * @return boolean
     */
    function isRemoveTitle($title)
    {
        // 広告などの除去用タイトルのリスト（正規表現であること）
        if (empty($this->_remove_title_list)) {
            return false;
        }
        // チェック
        foreach($this->_remove_title_list as $key => $pattern) {
            if (preg_match($pattern, $title, $matches)) {
                return true;
            }
        }
        return false;
    }

    /*
     * 元記事のURLがパラメータの一部と化している場合に切り出したい
     * そこで一致するかチェックする
     * @param $url URL
     * @param &$matches マッチした場合の返り値 array( 0 => 元のURL, 1 => ドメイン, 2 => URLデコード済みの元記事のURL)
     * @return boolean
     */
    function isExtractLink($url,&$matches)
    {
        // 広告などの除去用タイトルのリスト（正規表現であること）
        if (empty($this->_extract_link_list)) {
            return false;
        }
        // チェック
       foreach($this->_extract_link_list as $key => $value) {
            if (preg_match($value['pattern'], $url, $_matches)) {
                if ($value['urldecode']===true) {
                    $matches = array($_matches[0], $_matches[1], urldecode($_matches[2]));
                } else {
                    $matches = array($_matches[0], $_matches[1], $_matches[2]);
                }
                return true;
            }
        }
        return false;
    }
}
?>
