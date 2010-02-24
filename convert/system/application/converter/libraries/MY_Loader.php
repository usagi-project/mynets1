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

class MY_Loader extends CI_Loader {

    /**
     * Constructor
     * @access  public
     */
    function MY_Loader()
    {
        parent::CI_Loader();

    }


    /**
     * Class Loader
     *
     * This function lets users load and instantiate classes.
     * It is designed to be called from a user's app controllers.
     *
     * @access  public
     * @param   string  the name of the class
     * @param   mixed   the optional parameters
     * @return  void
     *
     * Libraryディレクトリ以下にディレクトリを作成する場合の
     * 独自読み込みに対応
     * CI_Loaderからオーバーロード
     * $this->load->library('test/hoge/testscript');
     * $this->test_hoge_testscript->XXX
     * ファイル名はTestscript.php
     * クラス名はtest_hoge_Testscriptとすること
     *
     */
    function library($library = '', $params = NULL)
    {
        if ($library == '')
        {
            return FALSE;
        }

        if (is_array($library))
        {
            foreach ($library as $class)
            {
                if (strpos($class, '/') !== FALSE)
                {
                    $this->_ci_load_class_my($class, $params);
                }
                else
                {
                    $this->_ci_load_class($class, $params);
                }
            }
        }
        else
        {
            if (strpos($library, '/') !== FALSE)
            {
                $this->_ci_load_class_my($library, $params);
            }
            else
            {
                $this->_ci_load_class($library, $params);
            }
        }

        $this->_ci_assign_to_models();
    }

    /**
     * Load class
     *
     * This function loads the requested class.
     *
     * @access  private
     * @param   string  the item that is being loaded
     * @param   mixed   any additional parameters
     * @return  void
     * Libraryディレクトリ以下にディレクトリを作成する場合の
     * 独自読み込みメソッドを定義
     * ライブラリ読み込みのみ対応
     */
    function _ci_load_class_my($class, $params = NULL)
    {
        // Get the class name
        $class = str_replace(EXT, '', $class);

        //Directoryセパレータで分割
        $subdir = '';
        if (strpos($class, '/') !== FALSE)
        {
            $arrdir = explode('/', $class);
            //階層を確認
            if (count($arrdir) >= 2)
            {
                for ($i=1; $i < count($arrdir); $i++) {
                    $subdir .= $arrdir[$i-1] . '/';
                }
            }
            $class = $arrdir[count($arrdir)-1];
        }

        // We'll test for both lowercase and capitalized versions of the file name
        foreach (array(ucfirst($class), strtolower($class)) as $class)
        {
            $subclass = APPPATH.'libraries/'.config_item('subclass_prefix').$class.EXT;

            // Is this a class extension request?
            if (file_exists($subclass))
            {
                $baseclass = BASEPATH.'libraries/'.ucfirst($class).EXT;

                if ( ! file_exists($baseclass))
                {
                    log_message('error', "Unable to load the requested class: ".$class);
                    show_error("Unable to load the requested class: ".$class);
                }

                // Safety:  Was the class already loaded by a previous call?
                if (in_array($subclass, $this->_ci_classes))
                {
                    $is_duplicate = TRUE;
                    log_message('debug', $class." class already loaded. Second attempt ignored.");
                    return;
                }

                include($baseclass);
                include($subclass);
                $this->_ci_classes[] = $subclass;

                return $this->_ci_init_class($class, config_item('subclass_prefix'), $params);
            }

            // Lets search for the requested library file and load it.
            $is_duplicate = FALSE;
            for ($i = 1; $i < 3; $i++)
            {
                $path = ($i % 2) ? APPPATH : BASEPATH;
                $filepath = $path.'libraries/'.$subdir.$class.EXT;

                // Does the file exist?  No?  Bummer...
                if ( ! file_exists($filepath))
                {
                    continue;
                }

                // Safety:  Was the class already loaded by a previous call?
                if (in_array($filepath, $this->_ci_classes))
                {
                    $is_duplicate = TRUE;
                    log_message('debug', $class." class already loaded. Second attempt ignored.");
                    return;
                }

                include($filepath);
                $this->_ci_classes[] = $filepath;
                if ($subdir)
                {
                    return $this->_ci_init_class_my($class, $subdir, str_replace('/', '_', $subdir), $params);
                }
                else
                {
                    return $this->_ci_init_class($class, '', $params);
                }
            }
        } // END FOREACH

        // If we got this far we were unable to find the requested class.
        // We do not issue errors if the load call failed due to a duplicate request
        if ($is_duplicate == FALSE)
        {
            log_message('error', "Unable to load the requested class: ".$class);
            show_error("Unable to load the requested class: ".$class);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Instantiates a class
     *
     * @access  private
     * @param   string
     * @param   string
     * @param   string
     * @return  null
     * Libraryディレクトリ以下にディレクトリを作成する場合の
     * 独自読み込みメソッドを定義
     * ライブラリ読み込みのみ対応
     */
    function _ci_init_class_my($class, $subdir, $prefix = '', $config = FALSE)
    {
        $class = strtolower($class);
        // Is there an associated config file for this class?
        if ($config === NULL)
        {
            if (file_exists(APPPATH.'config/'.$subdir.$class.EXT))
            {
                include(APPPATH.'config/'.$subdir.$class.EXT);
            }
        }

        if ($prefix == '')
        {
            $name = (class_exists('CI_'.$class)) ? 'CI_'.$class : $class;
            // Set the variable name we will assign the class to
            $classvar = ( ! isset($this->_ci_varmap[$class])) ? $class : $this->_ci_varmap[$class];
        }
        else
        {
            $name = $prefix.$class;
            // Set the variable name we will assign the class to
            $classvar = ( ! isset($this->_ci_varmap[$name])) ? $name : $this->_ci_varmap[$name];

        }


        // Instantiate the class
        $CI =& get_instance();
        if ($config !== NULL)
        {
            $CI->$classvar = new $name($config);
        }
        else
        {
            $CI->$classvar = new $name;
        }
    }

    // --------------------------------------------------------------------

}
?>