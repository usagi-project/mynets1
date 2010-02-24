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

class MY_Validation extends CI_Validation{

var $_value = array();

    function MY_Validation()
    {
        parent::CI_Validation();
    }
    // --------------------------------------------------------------------
    /**
     * Minimum Length
     *
     * @access  public
     * @param   string
     * @return  bool
     */
    function min_length($str, $val)
    {
        if (preg_match("/[^0-9]/", $val))
        {
            return FALSE;
        }
        if (function_exists('mb_strlen'))
        {
            return (mb_strlen($str, $this->CI->config->item('charset')) < $val) ? FALSE : TRUE;
        }
        else
        {
            return (strlen($str) < $val) ? FALSE : TRUE;
        }
    }
    // --------------------------------------------------------------------
    /**
     * Max Length
     *
     * @access  public
     * @param   string
     * @return  bool
     */
    function max_length($str, $val)
    {
        if (preg_match("/[^0-9]/", $val))
        {
            return FALSE;
        }
        if (function_exists('mb_strlen'))
        {
            return (mb_strlen($str, $this->CI->config->item('charset')) > $val) ? FALSE : TRUE;
        }
        else
        {
            return (strlen($str) > $val) ? FALSE : TRUE;
        }
    }

    // --------------------------------------------------------------------
    /**
     * Exact Length
     *
     * @access  public
     * @param   string
     * @return  bool
     */
    function exact_length($str, $val)
    {
        if (preg_match("/[^0-9]/", $val))
        {
            return FALSE;
        }
        if (function_exists('mb_strlen'))
        {
            return (mb_strlen($str, $this->CI->config->item('charset')) != $val) ? FALSE : TRUE;
        }
        else
        {
            return (strlen($str) != $val) ? FALSE : TRUE;
        }
    }

    // --------------------------------------------------------------------
    /**
     * Set Fields
     *
     * This function takes an array of field names as input
     * and generates class variables with the same name, which will
     * either be blank or contain the $_POST value corresponding to it
     *
     * @access    public
     * @param    string
     * @param    string
     * @return    void
     */
    /**
     * 2008-05-16 KUNIHARU Tsujioka update
     * no isset($_POST[$key]) NOTICE ERROR skip
     */
    function set_fields($data = '', $field = '')
    {
        if ($data == '')
        {
            if (count($this->_fields) == 0)
            {
                return FALSE;
            }
        }
        else
        {
            if ( ! is_array($data))
            {
                $data = array($data => $field);
            }

            if (count($data) > 0)
            {
                $this->_fields = $data;
            }
        }

        foreach($this->_fields as $key => $val)
        {
            if ( ! isset($_POST[$key]))
            {
                $_POST[$key] = $key;
            }
            $this->_value[$key] = $_POST[$key];
            //2008-05-16 KUNIHARU Tsujioka update

            //$this->_value[$key] = ( ! isset($_POST[$key]) OR is_array($_POST[$key])) ? '' : $this->prep_for_form($_POST[$key]);
            //$this->_value[$key] = $_POST[$key];

            /*
            $error = $key.'_error';
            if ( ! isset($this->$error))
            {
                $this->$error = '';
            }
            */
            // USE INSTEAD: $this->error('username');

        }
    }

    // --------------------------------------------------------------------

    /**
     * Run the Validator
     *
     * This function does all the work.
     *
     * @access    public
     * @return    bool
     */
    function run()
    {
        // Do we even have any data to process?  Mm?
        if (count($_POST) == 0 OR count($this->_rules) == 0)
        {
            return TRUE;
        }

        // Load the language file containing error messages
        $this->CI->lang->load('validation');

        // Cycle through the rules and test for errors
        foreach ($this->_rules as $field => $rules)
        {
            $fieldO = $field; // save the original field name;
            $this->CI->input->brackets_to_index($field);
            //Explode out the rules!
            $ex = explode('|', $rules);

            // Is the field required?  If not, if the field is blank  we'll move on to the next text
            if ( ! in_array('required', $ex, TRUE) AND strpos($rules, 'callback_') === FALSE)
            {
                if ( ! isset($_POST[$field]) OR $_POST[$field] == '')
                {
                    continue;
                }
            }

            /*
             * Are we dealing with an "isset" rule?
             *
             * Before going further, we'll see if one of the rules
             * is to check whether the item is set (typically this
             * applies only to checkboxes).  If so, we'll
             * test for it here since there's not reason to go
             * further
             */
            if ( ! isset($_POST[$field]))
            {
                if (in_array('isset', $ex, TRUE) OR in_array('required', $ex))
                {
                    if ( ! isset($this->_error_messages['isset']))
                    {
                        if (FALSE === ($line = $this->CI->lang->line('isset')))
                        {
                            $line = 'The field was not set';
                        }
                    }
                    else
                    {
                        $line = $this->_error_messages['isset'];
                    }

                    $field = ( ! isset($this->_fields[$field])) ? $field : $this->_fields[$field];
                    $this->_error_array[$field] = sprintf($line, $field);
                }

                continue;
            }

            /*
             * Set the current field
             *
             * The various prepping functions need to know the
             * current field name so they can do this:
             *
             * $_POST[$this->_current_field] == 'bla bla';
             */
            $this->_current_field = $field;

            // Cycle through the rules!
            foreach ($ex As $rule)
            {
                // Is the rule a callback?
                $callback = FALSE;
                if (substr($rule, 0, 9) == 'callback_')
                {
                    $rule = substr($rule, 9);
                    $callback = TRUE;
                }

                // Strip the parameter (if exists) from the rule
                // Rules can contain a parameter: max_length[5]
                $param = FALSE;
                if (preg_match("/(.*?)\[(.*?)\]/", $rule, $match))
                {
                    $rule    = $match[1];
                    $param    = $match[2];
                }

                // Call the function that corresponds to the rule
                if ($callback === TRUE)
                {
                    if ( ! method_exists($this->CI, $rule))
                    {
                        continue;
                    }

                    $result = $this->CI->$rule($_POST[$field], $param);

                    // If the field isn't required and we just processed a callback we'll move on...
                    if ( ! in_array('required', $ex, TRUE) AND $result !== FALSE)
                    {
                        continue 2;
                    }

                }
                else
                {
                    if ( ! method_exists($this, $rule))
                    {
                        /*
                         * Run the native PHP function if called for
                         *
                         * If our own wrapper function doesn't exist we see
                         * if a native PHP function does. Users can use
                         * any native PHP function call that has one param.
                         */
                        if (function_exists($rule))
                        {
                            $_POST[$field] = $rule($_POST[$field]);
                            // $this->$field = $_POST[$field];
                            // USE INSTEAD: $this->value('username');
                            $this->_value[$field] = $_POST[$field];
                        }

                        continue;
                    }

                    $result = $this->$rule($_POST[$field], $param);
                }

                // Did the rule test negatively?  If so, grab the error.
                if ($result === FALSE)
                {
                    if ( ! isset($this->_error_messages[$rule]))
                    {
                        if (FALSE === ($line = $this->CI->lang->line($rule)))
                        {
                            $line = 'Unable to access an error message corresponding to your field name.';
                        }
                    }
                    else
                    {
                        $line = $this->_error_messages[$rule];;
                    }

                    // Build the error message
                    $mfield = ( ! isset($this->_fields[$field])) ? $field : $this->_fields[$field];
                    $mparam = ( ! isset($this->_fields[$param])) ? $param : $this->_fields[$param];
                    $message = sprintf($line, $mfield, $mparam);

                    // Set the error variable.  Example: $this->username_error
                    // $error = $field.'_error';
                    // $this->$error = $this->_error_prefix.$message.$this->_error_suffix;
                    // USE INSTEAD:
                    // $this->error('username');

                    // Add the error to the error array
                    $this->_error_array[$field] = $message;
                    continue 2;
                }
            }

        }

        $total_errors = count($this->_error_array);

        /*
         * Recompile the class variables
         *
         * If any prepping functions were called the $_POST data
         * might now be different then the corresponding class
         * variables so we'll set them anew.
         */
        if ($total_errors > 0)
        {
            $this->_safe_form_data = TRUE;
        }

        $this->set_fields();

        // Did we end up with any errors?
        if ($total_errors == 0)
        {
            return TRUE;
        }

        // Generate the error string
        foreach ($this->_error_array as $val)
        {
            $this->error_string .= $this->_error_prefix.$val.$this->_error_suffix."\n";
        }

        return FALSE;
    }

    // --------------------------------------------------------------------

    /**
     * Return error message of given field name
     *
     * @access    public
     * @param    string
     * @return    string
     */
    /**
     * 2008-05-16 KUNIHARU Tsujioka update
     * no isset$this->_error_array[$field]) NOTICE ERROR skip
     */
    function error($field){

        //return $this->_error_array[$field];

        if (isset($this->_error_array[$field]))
        {
            return $this->_error_array[$field];
        }
        else
        {
            return NULL;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Return passed value of given field name
     *
     * @access    public
     * @param    string
     * @return    string
     */

    function value($field){
        return $this->_value[$field];
    }

    // --------------------------------------------------------------------

    /**
     * Overwrite object values with validation output.
     *
     * @access    public
     * @param    obj
     * @return    obj
     */

     function error_set($field , $error){
         $this->_error_array[$field] .= $error;
     }

}
?>
