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
 * @project    Usagi Project
 * @package    MyNETS
 * @author     Usagi Project <info@usagi.mynets.jp>
 * @copyright  2009 Usagi Project <author member ad http://usagi.mynets.jp/member.html>
 * @version    MyNETS,v 1.2.1
 * @since      File available since Release 1.2.1 Nighty
 * @chengelog  [2009/08/11] import from OpenPNE 2.10.9 and require mhash
 * ========================================================================
 */

/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

require_once 'Services/Amazon.php';
require_once 'PHP/Compat/Function/mhash.php';

/**
 * OpenPNEでAmazonECSを利用するためのクラス
 * 
 * @package OpenPNE
 * @author Kousuke Ebihara <ebihara@tejimaya.com>
 */
class OpenPNE_Amazon extends Services_Amazon
{
    /**
     * Category(AmazonECS3)とSearchIndexの変換テーブル
     *
     * @var array
     */
    var $_categoryToSearchIndex = array(
        'books-jp' => 'Books', 
        'books-us' => 'ForeignBooks', 
        'music-jp' => 'Music', 
        'classical-jp' => 'Classical', 
        'dvd-jp' => 'DVD', 
        'videogames-jp' => 'VideoGames', 
        'software-jp' => 'Software', 
        'electronics-jp' => 'Electronics', 
        'kitchen-jp' => 'Kitchen', 
        'toys-jp' => 'Toys', 
        'sporting-goods-jp' => 'SportingGoods', 
        'hpc-jp' => 'HealthPersonalCare', 
    );

    function ItemSearch($search_index, $options = array())
    {
        // SearchIndex ではなく Category が渡された
        if (array_key_exists($search_index, $this->_categoryToSearchIndex)) {
            $search_index = $this->_categoryToSearchIndex[$search_index];
        }

        $result =  parent::ItemSearch($search_index, $options);
        return $result;
    }
}

?>
