<?php

/**
 * Smarty Internal Plugin Data
 * 
 * This file contains the basic classes and methodes for template and variable creation
 * 
 * @package Smarty
 * @subpackage Templates
 * @author Uwe Tews 
 */

/**
 * Base class with template and variable methodes
 */
class Smarty_Internal_Data {
    // class used for templates
    public $template_class = 'Smarty_Internal_Template';

    /**
     * assigns a Smarty variable
     * 
     * @param array $ |string $tpl_var the template variable name(s)
     * @param mixed $value the value to assign
     * @param boolean $nocache if true any output of this variable will be not cached
     * @param boolean $scope the scope the variable will have  (local,parent or root)
     */
    public function assign($tpl_var, $value = null, $nocache = false, $scope = SMARTY_LOCAL_SCOPE)
    {
        if (is_array($tpl_var)) {
            foreach ($tpl_var as $_key => $_val) {
                if ($_key != '') {
                    $this->tpl_vars[$_key] = new Smarty_variable($_val, $nocache, $scope);
                } 
            } 
        } else {
            if ($tpl_var != '') {
                $this->tpl_vars[$tpl_var] = new Smarty_variable($value, $nocache, $scope);
            } 
        } 
    } 
    /**
     * assigns a global Smarty variable
     * 
     * @param string $varname the global variable name
     * @param mixed $value the value to assign
     * @param boolean $nocache if true any output of this variable will be not cached
     */
    public function assignGlobal($varname, $value = null, $nocache = false)
    {
        if ($varname != '') {
            $this->smarty->global_tpl_vars[$varname] = new Smarty_variable($value, $nocache);
        } 
    } 
    /**
     * assigns values to template variables by reference
     * 
     * @param string $tpl_var the template variable name
     * @param mixed $ &$value the referenced value to assign
     * @param boolean $nocache if true any output of this variable will be not cached
     * @param boolean $scope the scope the variable will have  (local,parent or root)
     */
    public function assignByRef($tpl_var, &$value, $nocache = false, $scope = SMARTY_LOCAL_SCOPE)
    {
        if ($tpl_var != '') {
            $this->tpl_vars[$tpl_var] = new Smarty_variable(null, $nocache, $scope);
            $this->tpl_vars[$tpl_var]->value = &$value;
        } 
    } 
    /**
     * wrapper function for Smarty 2 BC
     * 
     * @param string $tpl_var the template variable name
     * @param mixed $ &$value the referenced value to assign
     * @param boolean $nocache if true any output of this variable will be not cached
     * @param boolean $scope the scope the variable will have  (local,parent or root)
     */
    public function assign_by_ref($tpl_var, &$value, $nocache = false, $scope = SMARTY_LOCAL_SCOPE)
    {
        trigger_error("function call 'assign_by_ref' is unknown or deprecated, use 'assignByRef'", E_USER_NOTICE);
        $this->assignByRef($tpl_var, $value, $nocache, $scope);
    } 
    /**
     * appends values to template variables
     * 
     * @param array $ |string $tpl_var the template variable name(s)
     * @param mixed $value the value to append
     * @param boolean $merge flag if array elements shall be merged
     * @param boolean $nocache if true any output of this variable will be not cached
     * @param boolean $scope the scope the variable will have  (local,parent or root)
     */
    public function append($tpl_var, $value = null, $merge = false, $nocache = false, $scope = SMARTY_LOCAL_SCOPE)
    {
        if (is_array($tpl_var)) {
            // $tpl_var is an array, ignore $value
            foreach ($tpl_var as $_key => $_val) {
                if ($_key != '') {
                    if (!isset($this->tpl_vars[$_key])) {
                        $tpl_var_inst = $this->getVariable($_key, null, true, false);
                        if ($tpl_var_inst instanceof Undefined_Smarty_Variable) {
                            $this->tpl_vars[$_key] = new Smarty_variable(null, $nocache, $scope);
                        } else {
                            $this->tpl_vars[$_key] = clone $tpl_var_inst;
                            if ($scope != SMARTY_LOCAL_SCOPE) {
                                $this->tpl_vars[$_key]->scope = $scope;
                            } 
                        } 
                    } 
                    if (!(is_array($this->tpl_vars[$_key]->value) || $this->tpl_vars[$_key]->value instanceof ArrayAccess)) {
                        settype($this->tpl_vars[$_key]->value, 'array');
                    } 
                    if ($merge && is_array($_val)) {
                        foreach($_val as $_mkey => $_mval) {
                            $this->tpl_vars[$_key]->value[$_mkey] = $_mval;
                        } 
                    } else {
                        $this->tpl_vars[$_key]->value[] = $_val;
                    } 
                } 
            } 
        } else {
            if ($tpl_var != '' && isset($value)) {
                if (!isset($this->tpl_vars[$tpl_var])) {
                    $tpl_var_inst = $this->getVariable($tpl_var, null, true, false);
                    if ($tpl_var_inst instanceof Undefined_Smarty_Variable) {
                        $this->tpl_vars[$tpl_var] = new Smarty_variable(null, $nocache, $scope);
                    } else {
                        $this->tpl_vars[$tpl_var] = clone $tpl_var_inst;
                        if ($scope != SMARTY_LOCAL_SCOPE) {
                            $this->tpl_vars[$tpl_var]->scope = $scope;
                        } 
                    } 
                } 
                if (!(is_array($this->tpl_vars[$tpl_var]->value) || $this->tpl_vars[$tpl_var]->value instanceof ArrayAccess)) {
                    settype($this->tpl_vars[$tpl_var]->value, 'array');
                } 
                if ($merge && is_array($value)) {
                    foreach($value as $_mkey => $_mval) {
                        $this->tpl_vars[$tpl_var]->value[$_mkey] = $_mval;
                    } 
                } else {
                    $this->tpl_vars[$tpl_var]->value[] = $value;
                } 
            } 
        } 
    } 

    /**
     * appends values to template variables by reference
     * 
     * @param string $tpl_var the template variable name
     * @param mixed $ &$value the referenced value to append
     * @param boolean $merge flag if array elements shall be merged
     */
    public function appendByRef($tpl_var, &$value, $merge = false)
    {
        if ($tpl_var != '' && isset($value)) {
            if (!isset($this->tpl_vars[$tpl_var])) {
                $this->tpl_vars[$tpl_var] = new Smarty_variable();
            } 
            if (!@is_array($this->tpl_vars[$tpl_var]->value)) {
                settype($this->tpl_vars[$tpl_var]->value, 'array');
            } 
            if ($merge && is_array($value)) {
                foreach($value as $_key => $_val) {
                    $this->tpl_vars[$tpl_var]->value[$_key] = &$value[$_key];
                } 
            } else {
                $this->tpl_vars[$tpl_var]->value[] = &$value;
            } 
        } 
    } 
    /**
     * wrapper function for Smarty 2 BC
     * 
     * @param string $tpl_var the template variable name
     * @param mixed $ &$value the referenced value to append
     * @param boolean $merge flag if array elements shall be merged
     */
    public function append_by_ref($tpl_var, &$value, $merge = false)
    {
        trigger_error("function call 'append_by_ref' is unknown or deprecated, use 'appendByRef'", E_USER_NOTICE);
        $this->appendByRef($tpl_var, $value, $merge);
    } 
    /**
     * Returns a single or all template variables
     * 
     * @param string $varname variable name or null
     * @return string variable value or or array of variables
     */
    function getTemplateVars($varname = null, $_ptr = null, $search_parents = true)
    {
        if (isset($varname)) {
            $_var = $this->getVariable($varname, $_ptr, $search_parents);
            if (is_object($_var)) {
                return $_var->value;
            } else {
                return null;
            } 
        } else {
            $_result = array();
            if ($_ptr === null) {
                $_ptr = $this;
            } while ($_ptr !== null) {
                foreach ($_ptr->tpl_vars AS $key => $var) {
                    $_result[$key] = $var->value;
                } 
                // not found, try at parent
                if ($search_parents) {
                    $_ptr = $_ptr->parent;
                } else {
                    $_ptr = null;
                } 
            } 
            if ($search_parents && isset($this->global_tpl_vars)) {
                foreach ($this->global_tpl_vars AS $key => $var) {
                    $_result[$key] = $var->value;
                } 
            } 
            return $_result;
        } 
    } 

    /**
     * clear the given assigned template variable.
     * 
     * @param string $ |array $tpl_var the template variable(s) to clear
     */
    public function clearAssign($tpl_var)
    {
        if (is_array($tpl_var)) {
            foreach ($tpl_var as $curr_var) {
                unset($this->tpl_vars[$curr_var]);
            } 
        } else {
            unset($this->tpl_vars[$tpl_var]);
        } 
    } 

    /**
     * clear all the assigned template variables.
     */
    public function clearAllAssign()
    {
        $this->tpl_vars = array();
    } 

    /**
     * load a config file, optionally load just selected sections
     * 
     * @param string $config_file filename
     * @param mixed $sections array of section names, single section or null
     */
    public function configLoad($config_file, $sections = null)
    { 
        // load Config class
        $config = new Smarty_Internal_Config($config_file, $this->smarty);
        $config->loadConfigVars($sections, $this);
    } 

    /**
     * gets the object of a Smarty variable
     * 
     * @param string $variable the name of the Smarty variable
     * @param object $_ptr optional pointer to data object
     * @param boolean $search_parents search also in parent data
     * @return object the object of the variable
     */
    public function getVariable($variable, $_ptr = null, $search_parents = true, $error_enable = true)
    {
        if ($_ptr === null) {
            $_ptr = $this;
        } while ($_ptr !== null) {
            if (isset($_ptr->tpl_vars[$variable])) {
                // found it, return it
                return $_ptr->tpl_vars[$variable];
            } 
            // not found, try at parent
            if ($search_parents) {
                $_ptr = $_ptr->parent;
            } else {
                $_ptr = null;
            } 
        } 
        if (isset($this->smarty->global_tpl_vars[$variable])) {
            // found it, return it
            return $this->smarty->global_tpl_vars[$variable];
        } 
        if ($this->smarty->error_unassigned && $error_enable) {
            throw new SmartyException('Undefined Smarty variable "' . $variable . '"');
        } else {
            return new Undefined_Smarty_Variable;
        } 
    } 
    /**
     * gets  a config variable
     * 
     * @param string $variable the name of the config variable
     * @return mixed the value of the config variable
     */
    public function getConfigVariable($variable)
    {
        $_ptr = $this;
        while ($_ptr !== null) {
            if (isset($_ptr->config_vars[$variable])) {
                // found it, return it
                return $_ptr->config_vars[$variable];
            } 
            // not found, try at parent
            $_ptr = $_ptr->parent;
        } 
        if ($this->smarty->error_unassigned) {
            throw new SmartyException('Undefined config variable "' . $variable . '"');
        } else {
            return '';
        } 
    } 
    /**
     * gets  a stream variable
     * 
     * @param string $variable the stream of the variable
     * @return mixed the value of the stream variable
     */
    public function getStreamVariable($variable)
    {
        $_result = '';
        if ($fp = fopen($variable, 'r+')) {
            while (!feof($fp)) {
                $_result .= fgets($fp);
            } 
            fclose($fp);
            return $_result;
        } 

        if ($this->smarty->error_unassigned) {
            throw new SmartyException('Undefined stream variable "' . $variable . '"');
        } else {
            return '';
        } 
    } 

    /**
     * Returns a single or all config variables
     * 
     * @param string $varname variable name or null
     * @return string variable value or or array of variables
     */
    function getConfigVars($varname = null)
    {
        if (isset($varname)) {
            if (isset($this->config_vars[$varname])) {
                return $this->config_vars[$varname];
            } else {
                return '';
            } 
        } else {
            return $this->config_vars;
        } 
    } 

    /**
     * Deassigns a single or all config variables
     * 
     * @param string $varname variable name or null
     */
    function clearConfig($varname = null)
    {
        if (isset($varname)) {
            unset($this->config_vars[$varname]);
            return;
        } else {
            $this->config_vars = array();
            return;
        } 
    } 

} 

/**
 * class for the Smarty data object
 * 
 * The Smarty data object will hold Smarty variables in the current scope
 * 
 * @param object $parent tpl_vars next higher level of Smarty variables
 */
class Smarty_Data extends Smarty_Internal_Data {
    // array of variable objects
    public $tpl_vars = array(); 
    // back pointer to parent object
    public $parent = null; 
    // config vars
    public $config_vars = array(); 
    // Smarty object
    public $smarty = null;
    /**
     * create Smarty data object
     */
    public function __construct ($_parent = null, $smarty = null)
    {
        $this->smarty = $smarty;
        if (is_object($_parent)) {
            // when object set up back pointer
            $this->parent = $_parent;
        } elseif (is_array($_parent)) {
            // set up variable values
            foreach ($_parent as $_key => $_val) {
                $this->tpl_vars[$_key] = new Smarty_variable($_val);
            } 
        } elseif ($_parent != null) {
            throw new SmartyException("Wrong type for template variables");
        } 
    } 
} 
/**
 * class for the Smarty variable object
 * 
 * This class defines the Smarty variable object
 */
class Smarty_Variable {
    // template variable
    public $value;
    public $nocache;
    public $scope;
    /**
     * create Smarty variable object
     * 
     * @param mixed $value the value to assign
     * @param boolean $nocache if true any output of this variable will be not cached
     * @param boolean $scope the scope the variable will have  (local,parent or root)
     */
    public function __construct ($value = null, $nocache = false, $scope = SMARTY_LOCAL_SCOPE)
    {
        $this->value = $value;
        $this->nocache = $nocache;
        $this->scope = $scope;
    } 

    public function __toString ()
    {
        return $this->value;
    } 
} 

/**
 * class for undefined variable object
 * 
 * This class defines an object for undefined variable handling
 */
class Undefined_Smarty_Variable {
    // return always false
    public function __get ($name)
    {
        if ($name == 'nocache') {
            return false;
        } else {
            return null;
        } 
    } 
} 

?>