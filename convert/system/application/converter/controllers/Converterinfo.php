<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 *
 * @category
 * @package    Session Class
 * @author     KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @copyright  Copyright (c) 2008 KUNIHARU Tsujioka <kunitsuji@gmail.com>
 * @copyright  Copyright (c) 2006-2008 Usagi Project (URL:http://usagi-project.org)
 * @license    New BSD License
 */

class Converterinfo extends Controller
{
    function Converterinfo()
    {
        parent::Controller();
    }
    function index()
    {
        $this->load->helper('form');
        $vData = array(
                'header'   => 'header/header.html',
                'footer'   => 'header/footer.html',
        );
        $this->load->view('menu.html', $vData);
    }

}
?>
