<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 *
 * @category
 * @package    CI SSL Action config
 * @author     KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @copyright  Copyright (c) 2008 KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @copyright  Copyright (c) 2006-2008 Usagi Project (URL:http://usagi-project.org)
 * @license    New BSD License
 * @version    2008-04-22 Ver 0.1.0
 */


/*
 * セッション関係の情報を保存する
 * save_path 指定しない場合はデフォルトの保存パスとなる
 */

$config['session'] = array(
                    'save_path' => BASEPATH . '/chache',
                    );

?>
