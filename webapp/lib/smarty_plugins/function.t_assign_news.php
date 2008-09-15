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
 * @project    UsagiProject 2006-2008
 * @package    MyNETS
 * @author     Naoya Shimada <info@usagi.mynets.jp>
 * @author     UsagiProject <info@usagi.mynets.jp>
 * @copyright  Naoya Shimada <author member ad http://usagi.mynets.jp/member.html>
 * @copyright  2006-2008 UsagiProject <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.1.1
 * @since      File available since Release 1.1.1 Nighty
 * @chengelog  [2007/11/26] Ver1.1.1Nighty package
 *             [2008/07/26] Add cache merge mode.
 *             [2008/08/16] Add collection mode.
 * ========================================================================
 */

function smarty_function_t_assign_news($params, &$smarty)
{
    // セットするSmarty変数
    if (empty($params['var'])) {
        return;
    }

    // Smarty変数に戻り値セットする際の文字コード
    $charset = $params['charset'];

    // ニュースソースからフィードを収集するか否かのモード。デフォルトは収集する（true）
    // 収集しない（false）場合は常にキャッシュを利用するが、キャッシュが存在しない場合には収集する。
    $collect = true;
    if (!is_null($params['collect'])) {
        $collect = (boolean)$params['collect'];
    } elseif (defined('NEWS_COLLECT_FEED') && !NEWS_COLLECT_FEED) {
        $collect = false;
    }

    // キャッシュの有効時間を（引数なしはNEWS_CACHE_LIMITを利用）
    $lifetime = null;
    if (!empty($params['lifetime']) && intval($params['lifetime']) > 0) {
        $lifetime = intval($params['lifetime']);
    } else {
        if (defined('NEWS_CACHE_LIMIT') && NEWS_CACHE_LIMIT > 0) {
            $lifetime = NEWS_CACHE_LIMIT;
        }
    }

    // 取得するニュース記事の数（最大値）
    if (empty($params['max']) || intval($params['max']) < 1) {
        if (defined('NEWS_FEED_MAX') && NEWS_FEED_MAX > 0) {
            $max = NEWS_FEED_MAX;
        } else {
            return;
        }
    } else {
        $max = intval($params['max']);
    }

    // 取得するニュースのURL（URLエンコードされていること）
    // 未指定の場合は、config.phpで設定してあるリストから取得
    if (!empty($params['url'])) {
        $feed_list = array('News' => urldecode($params['url']));
        $feed_list_count = 1;
    } else {
        if (!empty($GLOBALS['NEWS_FEED_URL_LIST'])) {
            $feed_list = $GLOBALS['NEWS_FEED_URL_LIST'];
            $feed_list_count = count($feed_list);
        } else {
            return;
        }
    }

    // $GLOBALS['NEWS_FEED_URL_LIST'] に複数のURLが設定されているとき、
    // 配列のキーを指定可能
    // （半角英数字の場合は大丈夫だが、それ以外はURLエンコードされていること）
    if (!empty($params['key']) && $feed_list_count > 0) {
        $url_key = urldecode($params['key']);
    }

    // ランダム指定
    $random_item = false;
    if ($feed_list_count > 1 && preg_match('/^random([0-9]*)$/i', $params['type'], $matches)) {
        // $GLOBALS['NEWS_FEED_URL_LIST'] に複数のURLが設定されているとき、
        // リストの中からランダムに選ばれるようにする指定
        if (empty($matches[1]) || intval($matches[1]) == 0) {
            // 'random'のみ、または'random'に続く文字列がゼロのみの場合は1件とする
            $random_max = 1;
        } else {
            // $feed_listの要素数以上が指定されていたら、上限を$feed_listの要素数に合わせる
            $random_max = (intval($matches[1]) > $feed_list_count) ? $feed_list_count : intval($matches[1]);
        }

        // ニュースソースのリストからランダムに$random_max件ニュースソースを選択
        $feed_list = _smarty_function_t_assign_news_random_sampling($feed_list, $random_max);
        $feed_list_count = count($feed_list);

    } elseif (preg_match('/^random_item$/i', $params['type'], $matches)) {
        // 取得したニュース（記事）の中から、ランダムにニュース（記事）を選ぶ場合の指定
        $random_item = true;
    }

    // 取得した記事の結果
    $result = array();

    // ニュースソースが存在する場合は、記事取得
    if ($feed_list_count > 0) {
        require_once('News_RSS.class.php');
        $news = new News_RSS($charset);

        // Proxyの設定があったらセット
        if (!empty($GLOBALS['NEWS_PROXY_CONFIG']) && $GLOBALS['NEWS_PROXY_CONFIG']['ENABLE_PROXY']) {
            $news->setProxy($GLOBALS['NEWS_PROXY_CONFIG']);
        } else {
            // OpenPNE本体のProxy設定を使用する
            if (defined('OPENPNE_USE_HTTP_PROXY') && OPENPNE_USE_HTTP_PROXY) {
                $news->setProxy(array('proxy_host' => OPENPNE_HTTP_PROXY_HOST, 'proxy_port' => OPENPNE_HTTP_PROXY_PORT, 'proxy_user' => '', 'proxy_pass' => ''));
            }
        }

        // キャッシュの保存場所をセット
        $news->setCacheLocation(defined('NEWS_CACHE_DIR') ? NEWS_CACHE_DIR : OPENPNE_RSS_CACHE_DIR);

        // 収集モードセット
        $news->setCollection($collect);

        // キャッシュの有効時間をセット
        //（収集しないモードの場合は無視される）
        $news->setCacheLimit($lifetime);

        // 除去URLリストをセット
        $news->setRemoveLinkList($GLOBALS['NEWS_REMOVE_LINK_URL_LIST']);

        // 除去タイトルリストをセット
        $news->setRemoveTitleList($GLOBALS['NEWS_REMOVE_TITLE_LIST']);

        // 元記事抽出リストをセット
        $news->setExtractLinkList($GLOBALS['NEWS_EXTRACT_LINK_URL_LIST']);

        // ニュース記事の取得数をセット
        $news->setMax($max);

        // テキストの区切り位置をセット
        if (defined('NEWS_DESCRIPTION_LENGTH')) {
            $news->setBodyLength(NEWS_DESCRIPTION_LENGTH);
        }

        // テキストの省略文字列をセット
        if (defined('NEWS_DESCRIPTION_ETC')) {
            $news->setEtc(NEWS_DESCRIPTION_ETC);
        }

        if (!empty($url_key) && $feed_list_count > 1) {
            // ニュース一覧から指定されたキーのニュースソースだけ使用して記事を取得
            if (preg_match('/^http:\/\//', $feed_list[$url_key], $matches)) {
                $result = $news->fetch($feed_list[$url_key]);
            }
        } else {
            // ニュースをマージした結果をキャッシュするか
            if (defined('NEWS_CACHE_MERGE') && NEWS_CACHE_MERGE) {
                $news->setCacheMerge(true);
            }

            // ニュース一覧に設定されているニュースソースを全部使って記事を取得
            $result = $news->fetchAll(array_values($feed_list));

            // ランダムに記事を取得する場合
            if ($random_item) {
                // 記事の配列からランダムに$max件記事を選択
                $result = _smarty_function_t_assign_news_random_sampling($result, $max);
            }
            // 複数のニュースソースから記事を取得した場合、または、
            // ランダムに記事を取得した場合、マルチソートをかける
            if ($feed_list_count > 1 || $random_item) {
                // 時間でマルチソートをかけ、記事の順番を入れ替える
                $time = array();
                foreach($result as $feed) {
                    $time[] = $feed['time'];
                }
                array_multisort($time, SORT_DESC, SORT_REGULAR, $result);
                if ($max > 0 && count($result) > $max) {
                    // 記事の数は、ニュースソースの数×$max 分あるので、$max分に減らす
                    $result = array_slice($result, 0, $max);
                }
            }
        }
    }

    // 指定されたSmarty変数にセットして返す
    $smarty->assign($params['var'], $result);
}

/*
 * ランダム抽出
 * @param array $list  抽出元となる配列
 * @param int   $limit 抽出する数
 * @return array       抽出後の配列（構造は$limitと同じ）
 */
function _smarty_function_t_assign_news_random_sampling($list, $limit = 1)
{
    // 抽出数が1未満の場合や抽出数が元の配列の要素数以上の場合は、そのまま返す
    if ($limit < 1 || $limit > count($list)) {
        return $list;
    }

    // 配列から、ランダムに$limit件のキーを抽出
    srand((double)microtime()*1000000);
    $keys = array_rand($list, $limit);

    if ($limit === 1) {
        // 抽出数が１つの場合は、$keysは配列$listからランダム抽出された１つのキーである。
        // その場合、単純に抽出されたキーで配列を取得し、さらにarrayにして返す
        return array($keys => $list[$keys]);
    } else {
        // 抽出数が複数の場合は、$keysは配列$listからランダム抽出された$limit個のキーの配列である。
        // その場合、配列に格納されたキーを使って、元の配列から値を取り出し、配列に詰め直して返す
        $new_list = array();
        foreach($keys as $key => $value) {
            $new_list[$value] = $list[$value];
        }
        return $new_list;
    }
}
?>
