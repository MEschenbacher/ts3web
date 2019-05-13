<?php
/**
 * Smarty Internal Plugin Compile Block
 * 
 * Compiles the {block}{/block} tags
 * 
 * @package Smarty
 * @subpackage Compiler
 * @author Uwe Tews 
 */

/**
 * Smarty Internal Plugin Compile Block Class
 */
class Smarty_Internal_Compile_Block extends Smarty_Internal_CompileBase {
    /**
     * Compiles code for the {block} tag
     * 
     * @param array $args array with attributes from parser
     * @param object $compiler compiler object
     * @return boolean true
     */
    public function compile($args, $compiler)
    {
        $this->compiler = $compiler;
        $this->required_attributes = array('name');
        $this->optional_attributes = array('assign', 'nocache'); 
        // check and get attributes
        $_attr = $this->_get_attributes($args);
        $save = array($_attr, $compiler->parser->current_buffer, $this->compiler->nocache, $this->compiler->smarty->merge_compiled_includes);
        $this->_open_tag('block', $save);
        if (isset($_attr['nocache'])) {
            if ($_attr['nocache'] == 'true') {
                $compiler->nocache = true;
            } 
        }
        // set flag for {block} tag
        $compiler->smarty->inheritance = true;
        // must merge includes
        $this->compiler->smarty->merge_compiled_includes = true; 

        $compiler->parser->current_buffer = new _smarty_template_buffer($compiler->parser);
        $compiler->has_code = false;
        return true;
    } 
} 

/**
 * Smarty Internal Plugin Compile BlockClose Class
 */
class Smarty_Internal_Compile_Blockclose extends Smarty_Internal_CompileBase {
    /**
     * Compiles code for the {/block} tag
     * 
     * @param array $args array with attributes from parser
     * @param object $compiler compiler object
     * @return string compiled code
     */
    public function compile($args, $compiler)
    {
        $this->compiler = $compiler;
        $this->smarty = $compiler->smarty;
        $this->compiler->has_code = true; 
        // check and get attributes
        $this->optional_attributes = array('name');
        $_attr = $this->_get_attributes($args);
        $saved_data = $this->_close_tag(array('block')); 
        // if name does match to opening tag
        if (isset($_attr['name']) && $saved_data[0]['name'] != $_attr['name']) {
            $this->compiler->trigger_template_error('mismatching name attributes "' . $saved_data[0]['name'] . '" and "' . $_attr['name'] . '"');
        } 
        $_name = trim($saved_data[0]['name'], "\"'");
        if (isset($compiler->template->block_data[$_name])) {
            $_tpl = $this->smarty->createTemplate('eval:' . $compiler->template->block_data[$_name]['source'], null, null, $compiler->template);
            $_tpl->properties['nocache_hash'] = $compiler->template->properties['nocache_hash'];
            $_tpl->template_filepath = $compiler->template->block_data[$_name]['file'];
            if ($compiler->nocache) {
                $_tpl->forceNocache = 2;
            } else {
                $_tpl->forceNocache = 1;
            } 
            $_tpl->suppressHeader = true;
            $_tpl->suppressFileDependency = true;
            if (strpos($compiler->template->block_data[$_name]['source'], '%%%%SMARTY_PARENT%%%%') !== false) {
                $_output = str_replace('%%%%SMARTY_PARENT%%%%', $compiler->parser->current_buffer->to_smarty_php(), $_tpl->getCompiledTemplate());
            } elseif ($compiler->template->block_data[$_name]['mode'] == 'prepend') {
                $_output = $_tpl->getCompiledTemplate() . $compiler->parser->current_buffer->to_smarty_php();
            } elseif ($compiler->template->block_data[$_name]['mode'] == 'append') {
                $_output = $compiler->parser->current_buffer->to_smarty_php() . $_tpl->getCompiledTemplate();
            } elseif (!empty($compiler->template->block_data[$_name])) {
                $_output = $_tpl->getCompiledTemplate();
            } 
            $compiler->template->properties['file_dependency'] = array_merge($compiler->template->properties['file_dependency'], $_tpl->properties['file_dependency']);
            $compiler->template->properties['function'] = array_merge($compiler->template->properties['function'], $_tpl->properties['function']);
            if ($_tpl->has_nocache_code) {
                $compiler->template->has_nocache_code = true;
            } 
            foreach($_tpl->required_plugins as $code => $tmp1) {
                foreach($tmp1 as $name => $tmp) {
                    foreach($tmp as $type => $data) {
                        $compiler->template->required_plugins[$code][$name][$type] = $data;
                    } 
                } 
            } 
            unset($_tpl);
        } else {
            $_output = $compiler->parser->current_buffer->to_smarty_php();
        } 
        $compiler->parser->current_buffer = $saved_data[1];
        $compiler->nocache = $saved_data[2];
        $compiler->smarty->merge_compiled_includes = $saved_data[3];
        // $_output content has already nocache code processed
        $compiler->suppressNocacheProcessing = true;
        // reset flag
        $compiler->smarty->inheritance = false;
        return $_output;
    } 
} 

?>