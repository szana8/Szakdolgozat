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

################################################################################
# 1. Constants #################################################################
################################################################################
    const   errLoadTemplate   =   'xtmp0001';

################################################################################
# 2. Public Properties #########################################################
################################################################################

################################################################################
# 3. Protected Properties ######################################################
################################################################################

    private static $_templateName       = "";

    private static $_templateSource     = array();

    private static $_templateCompile    = array();

    private static $_templateVariables  = array();

    private static $_templateLanguage   = array();

    private static $_templateCache      = false;

################################################################################
# 4. Public Methods ############################################################
################################################################################

    public static function loadTemplate(string $pin_Template) : bool {
        try{
            self::$_templateName = md5($pin_Template);
            self::$_templateSource[self::$_templateName] = File::getFileContent($pin_Template);
            return true;
        }
        catch(\Exception $ex) {
            Debug::setDebugMessage(array(__METHOD__, $ex->getCode(), $ex->getMessage(), $pin_Template));
            return false;
        }

    }


    public static function renderTemplate() : \stdClass {
        self::_templateCompile(self::$_templateName);
        return self::$_templateCompile[self::$_templateName];
    }





################################################################################
# 5. Protected Methods #########################################################
################################################################################


################################################################################
# 6. Private Methods ###########################################################
################################################################################

    private static function _getTemplateInfo(string $pin_Template) : \stdClass {
        $loc_Info = new \stdClass();
        $loc_Info->time = date('Y-m-d H:i:s');
        $loc_Info->cache = self::$_templateCache;
        return $loc_Info;
    }

    private static function _getVariables(string $pin_Template) : array {

    }

    private static function _getLanguageElements(string $pin_Template) : array {

    }

    private static function _getType(string $pin_Template) : string {

    }

    private static function _getCache(string $pin_Template) : bool {

    }

    private static function _setCache(string $pin_Mode) : bool {

    }

    private static function _isCache(string $pin_Mode) : bool {

    }

    private static function _addComment() {

    }

    private static function _setTemplateInfo(string $pin_Template) {

    }

    private static function _templateCompile(string $pin_Template) {
        self::$_templateCompile[$pin_Template] = new \stdClass();
        self::$_templateCompile[$pin_Template]->raw = self::$_templateSource[$pin_Template];
        self::$_templateCompile[$pin_Template]->compiled = self::$_templateSource[$pin_Template];
        self::$_templateCompile[$pin_Template]->info = self::_getTemplateInfo($pin_Template);
    }

}

?>