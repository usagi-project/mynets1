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

class pc_page_h_gmaps_list_data extends OpenPNE_Action
{
    function execute($requests)
    {
        $u = $GLOBALS['AUTH']->uid();

        // --- リクエスト変数
        $d_page = $requests['d_page'];
        $c_page = $requests['c_page'];
        $keyword = $requests['keyword'];
        $area = $requests['area'];
        $d_page_id = $requests['d_page_id'];
        $c_page_id = $requests['c_page_id'];
        $cm_page_id = $requests['cm_page_id'];
        $m_page_id = $requests['m_page_id'];
        // ----------

        //日記一覧
        $page_size = 25;
        
        //バグ回避のため半角空白を全角に統一
        $keyword = str_replace(" ", "　", $keyword);
        
        if($d_page === "1" && $c_page === "1") {
            if($area) {
                $this->area_d_page($area, $page_size, $d_page);
                $this->area_c_page($area, $page_size, $c_page);
            } elseif($m_page_id) {
                $this->mid_d_page($m_page_id, $page_size, $d_page);
                $this->mid_c_page($m_page_id, $page_size, $c_page);
            } else {
                $this->key_d_page($keyword, $page_size, $d_page);
                $this->key_c_page($keyword, $page_size, $c_page);
            }
        } else {
            if($c_page === "1") {
                if($area) {
                    $this->area_d_page($area, $page_size, $d_page);
                } elseif($m_page_id) {
                    $this->mid_d_page($m_page_id, $page_size, $d_page);
                } else {
                    if($d_page_id) {
                        $this->id_d_page($d_page_id, $page_size, $d_page);
                    } else {
                        $this->key_d_page($keyword, $page_size, $d_page);
                    }
                }
            } elseif($d_page === "1") {
                if($area) {
                    $this->area_c_page($area, $page_size, $c_page);
                } elseif($m_page_id) {
                    $this->mid_c_page($m_page_id, $page_size, $c_page);
                } else {
                    if($c_page_id) {
                        $this->id_c_page($c_page_id, $page_size, $c_page);
                    } else {
                        if($cm_page_id) {
                            $this->id_cm_page($cm_page_id, $page_size, $c_page);
                        } else {
                            $this->key_c_page($keyword, $page_size, $c_page);
                        }
                    }
                }
            }
        }

        //---- ページ表示 ----//
        return 'success';
    }
    
    function pages($key_type, $keyword, $total_num, $page_size, $urlVar){
        include_once OPENPNE_LIB_DIR . '/include/Pager/Pager.php';
        $options = array(
            // 全アイテム数の設定
            "totalItems" => $total_num,
            // 1ページに表示するインデックス数の設定
            "delta"      => 5,
            // 1ページのアイテム数の設定(全アイテム数からこの数字を割った数がページ数になります)
            "perPage"    => $page_size,
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
            "urlVar"     => $urlVar,

            // <a>タグのスタイルシートのクラスの設定
            "linkClass"  => "link",
            "curPageLinkClassName"=> "clink",

            // appendを0にすることでfileNameが有効になる
            "append"     => 0,
            "fileName"   => "javascript:pagenetion(\'".$key_type."\',\'".$urlVar."\',\'%d\')",
        );

        // Pagerインスタンスの作成
        if (version_compare(phpversion(), '5.0.0') == -1) {
            $pager = new Pager($options);
        } else {
            $pager = Pager::factory($options); //PHP5の場合はこちらで呼び出し
        }
        
        $Pager_Common = new Pager_Common();
        if($Pager_Common->_path != "/") {
            $pagelink = str_replace($Pager_Common->_path,'',$pager->links);
        } else {
            $pagelink = $pager->links;
        }

        return '<input type="hidden" id="'.$key_type.'" value= "'.$key_type.'='.urlencode($keyword).'">' . $pagelink;
    }
    
    function key_d_page($keyword, $page_size, $d_page) {
        //検索結果
        
        $d_result = p_h_gmaps_list_all_search_c_diary4c_diary($keyword, $page_size, $d_page);
        $this->set('new_diary_list', $d_result[0]);
        //検索に一致した日記数
        $d_total_num = $d_result[1];
        if($d_total_num) {
            $d_total_num2 = "d_total_num = 'トータル数[".$d_total_num."]件';";
        } else {
            $d_total_num2 = "d_total_num = 'トータル数[0]件';";
        }
        $this->set('d_total_num',$d_total_num2);
        $d_links = $this->pages('keyword', $keyword, $d_total_num, $page_size, 'd_page');
        if($d_links) {
            $d_links = "d_page_link = '".$d_links."';";
        } else {
            $d_links = "d_page_link = '';";
        }
        $this->set('d_page_link',$d_links);
    }
    
    function key_c_page($keyword, $page_size, $c_page) {
        $c_result = p_h_gmaps_list_all_search_c_topic4c_topic($keyword, $page_size, $c_page);
        $this->set('new_topic_list', $c_result[0]);
        //検索に一致したトピック数
        $c_total_num = $c_result[1];
        if($c_total_num) {
            $c_total_num2 = "c_total_num = 'トータル数[".$c_total_num."]件';";
        } else {
            $c_total_num2 = "c_total_num = 'トータル数[0]件';";
        }
        $this->set('c_total_num',$c_total_num2);
        $c_links = $this->pages('keyword', $keyword, $c_total_num, $page_size, 'c_page');
        if($c_links) {
            $c_links = "c_page_link = '".$c_links."';";
        } else {
            $c_links = "c_page_link = '';";
        }
        $this->set('c_page_link',$c_links);
    }

    function area_d_page($area, $page_size, $d_page) {
        //検索結果
        $d_result = p_h_gmaps_list_all_search_c_diary4c_diary_area($area, $page_size, $d_page);
        $this->set('new_diary_list', $d_result[0]);
        //検索に一致した日記数
        $d_total_num = $d_result[1];
        if($d_total_num) {
            $d_total_num2 = "d_total_num = 'トータル数[".$d_total_num."]件';";
        } else {
            $d_total_num2 = "d_total_num = 'トータル数[0]件';";
        }
        $this->set('d_total_num',$d_total_num2);
        $d_links = $this->pages('area', $area, $d_total_num, $page_size, 'd_page');
        if($d_links) {
            $d_links = "d_page_link = '".$d_links."';";
        } else {
            $d_links = "d_page_link = '';";
        }
        $this->set('d_page_link',$d_links);
    }

    function area_c_page($area, $page_size, $c_page) {
        //検索結果
        $c_result = p_h_gmaps_list_all_search_c_topic4c_topic_area($area, $page_size, $c_page);
        $this->set('new_topic_list', $c_result[0]);
        //検索に一致したトピック数
        $c_total_num = $c_result[1];
        if($c_total_num) {
            $c_total_num2 = "c_total_num = 'トータル数[".$c_total_num."]件';";
        } else {
            $c_total_num2 = "c_total_num = 'トータル数[0]件';";
        }
        $this->set('c_total_num',$c_total_num2);
        $c_links = $this->pages('area', $area, $c_total_num, $page_size, 'c_page');
        if($c_links) {
            $c_links = "c_page_link = '".$c_links."';";
        } else {
            $c_links = "c_page_link = '';";
        }
        $this->set('c_page_link',$c_links);
    }
    
    function id_d_page($id, $page_size, $d_page) {
        //検索結果
        $d_result = p_h_gmaps_list_all_search_c_diary4c_diary_id($id, $page_size, $d_page);
        $this->set('new_diary_list', $d_result[0]);
        //検索に一致した日記数
        $d_total_num = $d_result[1];
        if($d_total_num) {
            $d_total_num2 = "d_total_num = 'トータル数[".$d_total_num."]件';";
        } else {
            $d_total_num2 = "d_total_num = 'トータル数[0]件';";
        }
        $this->set('d_total_num',$d_total_num2);
        $d_links = $this->pages('d_page_id', $id, $d_total_num, $page_size, 'd_page');
        if($d_links) {
            $d_links = "d_page_link = '".$d_links."';";
        } else {
            $d_links = "d_page_link = '';";
        }
        $this->set('d_page_link',$d_links);
    }

    function id_c_page($id, $page_size, $c_page) {
        //検索結果
        $c_result = p_h_gmaps_list_all_search_c_topic4c_topic_id($id, $page_size, $c_page);
        $this->set('new_topic_list', $c_result[0]);
        //検索に一致したトピック数
        $c_total_num = $c_result[1];
        if($c_total_num) {
            $c_total_num2 = "c_total_num = 'トータル数[".$c_total_num."]件';";
        } else {
            $c_total_num2 = "c_total_num = 'トータル数[0]件';";
        }
        $this->set('c_total_num',$c_total_num2);
        $c_links = $this->pages('c_page_id', $id, $c_total_num, $page_size, 'c_page');
        if($c_links) {
            $c_links = "c_page_link = '".$c_links."';";
        } else {
            $c_links = "c_page_link = '';";
        }
        $this->set('c_page_link',$c_links);
    }
    
    function id_cm_page($cmid, $page_size, $c_page) {
        //検索結果
        $c_result = p_h_gmaps_list_all_search_c_topic4c_commu_id($cmid, $page_size, $c_page);
        $this->set('new_topic_list', $c_result[0]);
        //検索に一致したトピック数
        $c_total_num = $c_result[1];
        if($c_total_num) {
            $c_total_num2 = "c_total_num = 'トータル数[".$c_total_num."]件';";
        } else {
            $c_total_num2 = "c_total_num = 'トータル数[0]件';";
        }
        $this->set('c_total_num',$c_total_num2);
        $c_links = $this->pages('cm_page_id', $cmid, $c_total_num, $page_size, 'c_page');
        if($c_links) {
            $c_links = "c_page_link = '".$c_links."';";
        } else {
            $c_links = "c_page_link = '';";
        }
        $this->set('c_page_link',$c_links);
    }

    function mid_d_page($mid, $page_size, $d_page) {
        //検索結果
        $d_result = p_h_gmaps_list_all_search_c_diary4c_member_id($mid, $page_size, $d_page);
        $this->set('new_diary_list', $d_result[0]);
        //検索に一致した日記数
        $d_total_num = $d_result[1];
        if($d_total_num) {
            $d_total_num2 = "d_total_num = 'トータル数[".$d_total_num."]件';";
        } else {
            $d_total_num2 = "d_total_num = 'トータル数[0]件';";
        }
        $this->set('d_total_num',$d_total_num2);
        $d_links = $this->pages('m_page_id', $mid, $d_total_num, $page_size, 'd_page');
        if($d_links) {
            $d_links = "d_page_link = '".$d_links."';";
        } else {
            $d_links = "d_page_link = '';";
        }
        $this->set('d_page_link',$d_links);
    }

    function mid_c_page($mid, $page_size, $c_page) {
        //検索結果
        $c_result = p_h_gmaps_list_all_search_c_topic4c_member_id($mid, $page_size, $c_page);
        $this->set('new_topic_list', $c_result[0]);
        //検索に一致したトピック数
        $c_total_num = $c_result[1];
        if($c_total_num) {
            $c_total_num2 = "c_total_num = 'トータル数[".$c_total_num."]件';";
        } else {
            $c_total_num2 = "c_total_num = 'トータル数[0]件';";
        }
        $this->set('c_total_num',$c_total_num2);
        $c_links = $this->pages('m_page_id', $mid, $c_total_num, $page_size, 'c_page');
        if($c_links) {
            $c_links = "c_page_link = '".$c_links."';";
        } else {
            $c_links = "c_page_link = '';";
        }
        $this->set('c_page_link',$c_links);
    }
}

?>
