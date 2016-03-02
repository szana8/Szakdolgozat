<?php
namespace library;
/**
 * Link: 
 * File: template.php
 * Namespace: library
 * 
 * Description of template
 * 
 * 
 *  Version     Date            Author               Changelog   
 *   1.0.0      2015.11.28.     Pisti              Created
 * 
 */



class Template {

    private static $_templateContent    = "";


    public static function loadTemplate(string $pin_Template) : bool {
        self::$_templateContent = File::getFileContent($pin_Template);
        return true;
    }

    public static function renderTemplate() : string {
        return self::$_templateContent;
    }
}

?>