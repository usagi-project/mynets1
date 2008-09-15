<?php
/**
 * @copyright 2008 Naoya Shimada
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

require_once './config.inc.php';
require_once OPENPNE_WEBAPP_DIR . '/init.inc';

require_once 'Smarty/Smarty.class.php';
require_once 'smarty_plugins/function.t_assign_news.php';

$smarty = new Smarty();

$params = array(
    'var' => 'news_list',
    'collect' => true
);

smarty_function_t_assign_news($params,$smarty);

?>
